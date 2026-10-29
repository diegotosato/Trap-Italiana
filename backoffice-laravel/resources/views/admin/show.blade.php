@extends('layouts.admin')

@section('title')
    {{ $artist->name }}
@endsection


@section('page-title')
    <div id="page-title" class="bg-dark text-white py-3">
        <div class="container-fluid">
            <h1 class="m-0 p-0">
                <i class="bi bi-mic-fill"></i> Manage Artist - {{ $artist->name }}
            </h1>
        </div>
    </div>
@endsection

@section('content')
    <div id="artist-card" class="bg-white py-5 rounded rounded-3">
        <div id="artist-image" class="d-flex flex-column align-items-center">
            <img src="{{ $artistImage }}" alt="artist_image" class="d-block w-25 rounded rounded-3">
        </div>

        <div id="artist-infos" class="my-3 d-flex flex-column align-items-center justify-content-center">
            <p class="m-0 text-primary fw-bold d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-person-badge-fill fs-4"></i> Slug: <span
                    class="fw-normal fst-italic">{{ $artist->slug }}</span>
            </p>

            <p class="m-0 fw-bold d-flex align-items-center justify-content-center gap-2" style="color: #1DB954">
                <i class="bi bi-spotify fs-4"></i> Spotify ID: <span
                    class="fw-normal fst-italic">{{ $artist->spotify_id }}</span>
            </p>

            <p class="m-0 fw-bold d-flex align-items-center justify-content-center gap-2 w-50">
                <i class="bi bi-info-square-fill"></i> Description:
            <p class="fw-normal fst-italic w-50 text-center">{{ $artist->description }}</p>
            </p>
        </div>

        <div id="buttons" class="d-flex align-items-center justify-content-center gap-5">
            <a href="{{ route('admin.artists.index') }}" class="text-primary">Back</a>
            <a href="{{ route('admin.artists.edit', $artist) }}" class="btn btn-warning">
                <i class="bi bi-pencil-square"></i>
            </a>
        </div>
    </div>
@endsection
