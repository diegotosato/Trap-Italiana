@extends('layouts.admin')

@section('title')
    Add new artist
@endsection


@section('page-title')
    <div id="page-title" class="bg-dark text-white py-3">
        <div class="container-fluid">
            <h1 class="m-0 p-0">
                <i class="bi bi-mic-fill"></i> Manage Artist - Add new artist
            </h1>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.artists.store') }}" id="add-artist" class="bg-white p-5 rounded rounded-3" method="POST">

        @csrf

        <div class="row mb-3">
            <div class="col-6">
                <label for="name" class="form-label fw-bold">Artist name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Insert artist name"
                    value="{{ old('name') }}">

                @error('name')
                    <b class="d-block text-danger mt-2">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </b>
                @enderror
            </div>

            <div class="col-6">
                <label for="spotify_id" class="form-label fw-bold" style="color: #1DB954">Spotify ID</label>
                <input type="text" class="form-control" name="spotify_id" id="spotify_id"
                    placeholder="Insert artist Spotify ID" value="{{ old('spotify_id') }}">

                @error('spotify_id')
                    <b class="d-block text-danger mt-2">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </b>
                @enderror
            </div>

            <div class="col-12 mt-3">
                <label for="description" class="form-label fw-bold d-block">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control" style="resize: none"
                    placeholder="Insert artist description"></textarea>
                @error('description')
                    <b class="d-block text-danger mt-2">
                        <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
                    </b>
                @enderror
            </div>
        </div>

        <div id="buttons" class="d-flex align-items-start justify-content-between gap-5">
            <a href="{{ route('admin.artists.index') }}" class="text-primary">Back</a>

            <button type="submit" class="btn btn-info text-white">
                <i class="bi bi-person-plus-fill"></i> Add new artist
            </button>
        </div>

    </form>
@endsection
