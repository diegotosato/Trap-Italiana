<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $artists = Artist::when($request->search, fn($q) => $q->where('name', 'like', "%{$request->search}%"))
            ->paginate(10)
            ->withQueryString();

        return view('admin.index', compact('artists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);

        $request->validate([
            'name' => 'required|string|max:50',
            'spotify_id' => 'required|string|min:22|max:50',
            'description' => 'required|string',
        ]);

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

        $imageCall = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token
        ])->get("https://api.spotify.com/v1/artists/" . $request->spotify_id)->json();

        $imageUrl = $imageCall['images'][0]['url'];
        $artistName = ucwords($request->name);
        $slug = Str::slug($request->name);


        $newArtist = Artist::create([
            'name' => $artistName,
            'slug' => $slug,
            'spotify_id' => $request->spotify_id,
            'image_url' => $imageUrl,
            'description' => $request->description
        ]);

        return redirect()->route('admin.artists.index')->with('success', 'Artist added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Artist $artist)
    {
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
        ])->get('https://api.spotify.com/v1/artists/' . $artist->spotify_id)->json();

        $artistImage = $imagesResponse['images'][0]['url'];

        return view('admin.show', compact('artist', 'artistImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Artist $artist)
    {
        return view('admin.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Artist $artist)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'spotify_id' => 'required|string|min:22|max:50',
        ]);

        $slug = Str::slug($request->name);

        $artist->name = $request->name;
        $artist->slug = $slug;
        $artist->spotify_id = $request->spotify_id;

        $artist->save();

        return redirect()->route('admin.artists.index')->with('success', 'Artist modified successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        return redirect()->route('admin.artists.index')->with('success', 'Artist deleted successfully');
    }
}
