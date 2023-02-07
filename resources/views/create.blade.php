@extends('layout.master')
@section('content')
<h1>Create</h1>
<form action="{{ route('posts.store') }}" class="w-50" method="post" enctype="multipart/form-data" enctype="multipart/form-data">
    @csrf
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
    <div class="mb-3">
        <label for="images" class="form-label">Description</label>
        <input type="file" name="image" class="form-control" id="images">
        @error('image')
        <div class="text-danger">{{ $message }}</div>

        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
