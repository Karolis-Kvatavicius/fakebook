@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Leave Comment') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.store', $commentsPost->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="content"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>
                                <div class="col-md-6">
                                    <textarea type="input" required style="resize: none;" name="content" id="content"
                                        cols="42" rows="10"
                                        class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                                    @if ($errors->has('content'))
                                        <span class="invalid-feedback" style="display: block;" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="form-group row">
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
                            </div> --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Comment') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Comments') }}
                    </div>
                    <div id="posts_list" class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @isset($comments)
                            <div class="row">
                                @foreach ($comments as $comment)
                                    <div class="col-3">
                                        <div class="card my-3">
                                            <div class="card-header"><img class="rounded-circle"
                                                    src="{{ asset($comment->user->profile_picture) }}" alt="Profile picture"
                                                    width="30" height="30">{{ ' ' . $comment->user->name }}
                                            </div>
                                            <div class="card-body">
                                                {{ $comment->content }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                        @if ($comments->count() === 0)
                            <h3 class="text-center">There are no comments yet.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
