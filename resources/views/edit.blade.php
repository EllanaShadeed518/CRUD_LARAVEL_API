@extends('layout.master')
@section('content')
<h1>Edit</h1>
<form action="{{ route('posts.update', ['post' => $post->id]) }}" class="w-50" method="post">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Title</label>
        <input type="text" name="title" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('title')
        <div class="text-danger">{{ $message }}</div>

        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="exampleInputPassword1">
        @error('description')
        <div class="text-danger">{{ $message }}</div>

        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
