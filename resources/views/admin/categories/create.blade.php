@extends('layouts.app')

@section('content')
<div class="create-category">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a>Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">Create</li>
    </ol>
  </nav>
  <div class="container-fluid">
    <h2>Create Category</h2>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name" class="form-control
            @error('name') is-invalid @enderror @if(old('name')) is-valid @endif" value="{{ old('name') }}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="Image">Image</label>
            <div class="file-info">
              <button type="button" class="btn btn-info btn-block" id="selectBtn">Select Image</button>
              <input type="file" hidden name="image" id="file">
              <img hidden src="" alt="">
            </div>
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <label for="about">About</label>
            <textarea name="about"placeholder="About" class="form-control
            @error('about') is-invalid @enderror @if(old('about')) is-valid @endif">{{ old('about') }}</textarea>
            @error('about')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-success">Create</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('script')
@parent
<script>
  @if(Session::has('message'))
    toastr.success("{{ session('message') }}", "{{ session('heading') }}")
  @endif
</script>
@endsection
