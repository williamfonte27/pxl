@extends('layout.base')
@section('title', 'Shortener Blue | Shorten Your Link')
@section('content')

    <div class="container">
        <h1 class="title text-warning mt-5 mb-5 text-center">Import Your File Here</h1>

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <form
            class="text-center"
            method="post"
            action="{{ route('import.store') }}"
            enctype="multipart/form-data"
        >
        @csrf
        <!-- File input -->
            <div class="form-outline mb-4">
                <input type="file"
                       class="form-control"
                       name="fileUploaded"
                       placeholder="Upload your link here"
                       aria-label="fileUploaded"
                       required="required"
                >
            </div>
            <!-- Submit button -->
            <button type="submit"
                    class="btn btn-warning btn-block text-center"
                    style="width: 350px"
            >
                Import File
            </button>
        </form>
    </div>

@endsection
