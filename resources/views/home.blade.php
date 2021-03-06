@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        @if (Route::currentRouteName() === 'posts.index' || Route::currentRouteName() === 'posts.search')
            <div class="row justify-content-center">
                <form class="d-inline-block" action="{{ route('posts.search') }}" method="get">
                    {{-- @csrf --}}
                    <div class="input-group mb-2">
                        <input id="keyword" type="text" class="form-control @error('keyword') is-invalid @enderror"
                            name="keyword" value="{{ old('keyword') }}" required autocomplete="keyword"
                            placeholder="Search keyword here...">
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-search" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @if ($errors->has('keyword'))
                        <span class="invalid-feedback mb-3" style="display: block;" role="alert">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                    @endif
                    <div class="input-group mb-2">
                        <select name="searchBy" class="custom-select @error('searchBy') is-invalid @enderror" id="searchBy">
                            <option selected value="">Choose search criteria...</option>
                            <option value="1">Search by author name</option>
                            <option value="2">Search by content fragment</option>
                        </select>
                    </div>
                    @if ($errors->has('searchBy'))
                        <span class="invalid-feedback" style="display: block;" role="alert">
                            <strong>{{ $errors->first('searchBy') }}</strong>
                        </span>
                    @endif
                </form>
            </div>
        @endif
        <div class="row justify-content-center mt-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Posts') }}
                        @if (Route::currentRouteName() === 'my-posts')
                            <a class="btn btn-create-post" href="{{ route('posts.create') }}">Create Post</a>
                        @endif
                    </div>
                    <div id="posts_list" class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @isset($posts)
                            <div class="row">
                                @foreach ($posts as $post)
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                        <div class="card my-3">
                                            <div class="card-header"><img class="rounded-circle"
                                                    src="{{ asset($post->user->profile_picture) }}" alt="Profile picture"
                                                    width="30" height="30">{{ ' ' . $post->user->name }}
                                                @if (Route::currentRouteName() === 'my-posts')
                                                    <a class="btn btn-link" href="{{ route('posts.edit', $post->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path
                                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd"
                                                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg>
                                                    </a>
                                                    <form class="d-inline-block"
                                                        action="{{ route('posts.destroy', $post->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-link" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path
                                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd"
                                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <img class="card-img-top" src={{ asset($post->image) }} alt="Post image">
                                            <div class="card-body">
                                                {{ $post->content }}
                                                <div>
                                                    <a class="btn btn-link" href="{{ route('comments', $post->id) }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                            fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                            <path
                                                                d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                                                            <path
                                                                d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z" />
                                                        </svg>
                                                    </a>
                                                    {{ $post->commentsCount() }}
                                                    <form class="d-inline-block"
                                                        action={{ route('like', ['user' => Auth::id(), 'post' => $post->id]) }}
                                                        method="post">
                                                        @csrf
                                                        <button class="btn btn-link" type="submit"> <svg
                                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                fill="currentColor" class="bi bi-hand-thumbs-up"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M8.864.046C7.908-.193 7.02.53 6.956 1.466c-.072 1.051-.23 2.016-.428 2.59-.125.36-.479 1.013-1.04 1.639-.557.623-1.282 1.178-2.131 1.41C2.685 7.288 2 7.87 2 8.72v4.001c0 .845.682 1.464 1.448 1.545 1.07.114 1.564.415 2.068.723l.048.03c.272.165.578.348.97.484.397.136.861.217 1.466.217h3.5c.937 0 1.599-.477 1.934-1.064a1.86 1.86 0 0 0 .254-.912c0-.152-.023-.312-.077-.464.201-.263.38-.578.488-.901.11-.33.172-.762.004-1.149.069-.13.12-.269.159-.403.077-.27.113-.568.113-.857 0-.288-.036-.585-.113-.856a2.144 2.144 0 0 0-.138-.362 1.9 1.9 0 0 0 .234-1.734c-.206-.592-.682-1.1-1.2-1.272-.847-.282-1.803-.276-2.516-.211a9.84 9.84 0 0 0-.443.05 9.365 9.365 0 0 0-.062-4.509A1.38 1.38 0 0 0 9.125.111L8.864.046zM11.5 14.721H8c-.51 0-.863-.069-1.14-.164-.281-.097-.506-.228-.776-.393l-.04-.024c-.555-.339-1.198-.731-2.49-.868-.333-.036-.554-.29-.554-.55V8.72c0-.254.226-.543.62-.65 1.095-.3 1.977-.996 2.614-1.708.635-.71 1.064-1.475 1.238-1.978.243-.7.407-1.768.482-2.85.025-.362.36-.594.667-.518l.262.066c.16.04.258.143.288.255a8.34 8.34 0 0 1-.145 4.725.5.5 0 0 0 .595.644l.003-.001.014-.003.058-.014a8.908 8.908 0 0 1 1.036-.157c.663-.06 1.457-.054 2.11.164.175.058.45.3.57.65.107.308.087.67-.266 1.022l-.353.353.353.354c.043.043.105.141.154.315.048.167.075.37.075.581 0 .212-.027.414-.075.582-.05.174-.111.272-.154.315l-.353.353.353.354c.047.047.109.177.005.488a2.224 2.224 0 0 1-.505.805l-.353.353.353.354c.006.005.041.05.041.17a.866.866 0 0 1-.121.416c-.165.288-.503.56-1.066.56z" />
                                                            </svg></button>
                                                    </form>
                                                    {{ $post->likes() }}
                                                </div>
                                                <div class="text-muted">{{ $post->created_at }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endisset
                        @if ($posts->count() === 0)
                            <h3 class="text-center">There are no posts yet.</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
