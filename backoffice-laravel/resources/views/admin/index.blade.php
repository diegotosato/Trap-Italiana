@extends('layouts.admin')

@section('title')
    Manage Artists
@endsection


@section('page-title')
    <div id="page-title" class="bg-dark text-white py-3">
        <div class="container-fluid">
            <h1 class="m-0 p-0"><i class="bi bi-mic-fill"></i> Manage Artists</h1>
        </div>
    </div>
@endsection

@section('content')
    <form action="{{ route('admin.artists.index') }}" method="GET" class="row mb-3">
        <div class="col-3">
            <input type="text" name="search" id="search" class="form-control" placeholder="Search artist...">
        </div>

        <button type="submit" class="col-1 btn btn-dark">
            Search
        </button>
    </form>

    <table class="w-100 table table-striped border-collapse">
        <thead>
            <tr>
                <th><i class="bi bi-person-circle"></i> Name</th>
                <th class="text-primary"><i class="bi bi-person-badge-fill"></i> Slug</th>
                <th style="color: #1DB954"><i class="bi bi-spotify"></i> Spotify ID</th>
                <th class="text-secondary text-center"><i class="bi bi-list-task"></i> Actions</th>
            </tr>
        </thead>
        <tbody class="align-middle">
            @foreach ($artists as $artist)
                <tr>
                    <td>{{ $artist->name }}</td>
                    <td class="fst-italic text-primary">{{ $artist->slug }}</td>
                    <td style="color: #1DB954">{{ $artist->spotify_id }}</td>
                    <td class="text-secondary d-flex align-items-center justify-content-center gap-3">
                        <a href="{{ route('admin.artists.show', $artist) }}">See artist</a>
                        <a href="{{ route('admin.artists.edit', $artist) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#exampleModal-{{ $artist->id }}">
                            <i class="bi bi-trash3-fill"></i>
                        </button>

                        {{-- bootstrap modal --}}
                        <div class="modal fade" id="exampleModal-{{ $artist->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Delete artist</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure to delete this artist?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('admin.artists.destroy', $artist->slug) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.artists.create') }}" class="btn btn-info text-white">
        <i class="bi bi-person-plus-fill"></i> Add new artist
    </a>

    {{ $artists->links() }}
@endsection
