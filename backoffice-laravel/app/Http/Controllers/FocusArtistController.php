<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FocusArtistController extends Controller
{
    public function getArtist(string $slug)
    {
        $artist = DB::table('artists')->where('slug', '=', $slug)->get();
        $artistSpotifyID = $artist[0]->spotify_id;

        // get token from the browser cache
        $token = Cache::remember('spotify_token', 3500, function () {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode(
                    env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET')
                ),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'client_credentials',
            ]);

            return $response->json()['access_token'];
        });

        // get artist cover
        $imagesResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/artists/' . $artistSpotifyID)->json();

        $artistImage = $imagesResponse['images'][0]['url'];


        // get artist albums
        $albumsResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/artists/' . $artistSpotifyID . '/albums', [
            'include_groups' => 'album',
            'market' => 'IT',
            'limit' => 10,
            'offset' => 0,
        ])->json();

        // if the total albums number is major than 10, then do a second call for the remains
        if ($albumsResponse['total'] > 10) {
            $albumsResponseSecondPage = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://api.spotify.com/v1/artists/' . $artistSpotifyID . '/albums', [
                'include_groups' => 'album',
                'market' => 'IT',
                'limit' => 10,
                'offset' => 10,
            ])->json();
        }

        // if the total albums number is major than 20, then do a third call for the remains
        if ($albumsResponse['total'] > 20) {
            $albumsResponseThirdPage = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://api.spotify.com/v1/artists/' . $artistSpotifyID . '/albums', [
                'include_groups' => 'album',
                'market' => 'IT',
                'limit' => 10,
                'offset' => 20,
            ])->json();
        }


        // get album infos like: name, id for frontend iframe and cover image
        $artistAlbums = [];

        foreach ($albumsResponse['items'] as $album) {
            $artistAlbums[] = [
                'name' => $album['name'],
                'id' => $album['id'],
                'image' => $album['images'][0]['url'],
            ];
        }

        // if the total albums number is major than 10, add also the second group infos
        if (isset($albumsResponseSecondPage)) {
            foreach ($albumsResponseSecondPage['items'] as $album) {
                $artistAlbums[] = [
                    'name' => $album['name'],
                    'id' => $album['id'],
                    'image' => $album['images'][0]['url'],
                ];
            }
        }

        // if the total albums number is major than 20, add also the third group infos
        if (isset($albumsResponseThirdPage)) {
            foreach ($albumsResponseThirdPage['items'] as $album) {
                $artistAlbums[] = [
                    'name' => $album['name'],
                    'id' => $album['id'],
                    'image' => $album['images'][0]['url'],
                ];
            }
        }

        $data = [
            'artist_name' => $artist[0]->name,
            'description' => $artist[0]->description,
            'artist_image' => $artistImage,
            'artist_albums' => $artistAlbums,
            'artist_spotify_ID' => $artistSpotifyID,
        ];

        return response()->json($data);
    }

    /**
     * Return list of artists filtered per name.
     */
    public function getFilteredArtists(Request $request)
    {
        $name = $request->input('name');

        $artists = Artist::when($name, fn($q) => $q->where('name', 'like', "%{$name}%"))
            ->paginate(10)
            ->withQueryString();

        return response()->json($artists);
    }
}
