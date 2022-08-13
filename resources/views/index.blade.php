@extends('layout.master')

@section('content')
    <h1 class="text-danger"> Index Page</h1>

    <a href="{{ route('posts.create') }}" class="btn btn-outline-success">Create</a>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Operations</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($posts as $post)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('posts.edit' , ['post' => $post->id]) }}" method="GET">
                                @csrf
                                <button class="btn btn-sm btn-info">Edit</button>
                            </form>


                            <form class="ms-2" action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-danger">Delete</button>

                            </form>
                        </div>
                    </td>
                </tr>
            @empty

            @endforelse

        </tbody>
    </table>
@endsection
