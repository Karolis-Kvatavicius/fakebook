@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ Route::currentRouteName() === 'posts.create' ? __('Create Post') : __('Edit Post') }}</div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ Route::currentRouteName() === 'posts.create' ? route('posts.store') : route('posts.update', $post->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (Route::currentRouteName() === 'posts.edit')
                                @method('PUT')
                            @endif
                            <div class="form-group row">
                                <label for="content"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                    <textarea type="input" required style="resize: none;" name="content" id="content"
                                        cols="42" rows="10"
                                        class="form-control @error('content') is-invalid @enderror">{{ isset($post) ? $post->content : old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="'image"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Profile picture') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" value="{{ isset($post) ? $post->image : old('image') }}" autofocus>
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Post') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
