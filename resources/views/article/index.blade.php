@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">


                <div class="card">
                    <div class="card-header">{{ __('Articles') }}</div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach($articles as $article)
                                <li class="list-group-item">
                                    <b><a title="Show Details" href="/article/{{ $article->id }}">{{ $article->title }}</a></b>
                                    <span class="mx-2">Posted by: {{ $article->user->name }} </span>
                                    <span class="mx-2">( x Comments )</span>
                                    <span class="">{{ $article->created_at->diffForHumans() }}</span>

                                    @auth
                                        <a class="btn btn-sm btn-outline-primary float-right ml-2"
                                           href="/article/{{ $article->id }}/edit"><i
                                                class="fas fa-edit"></i> Edit</a>
                                        <form class="float-right" style="display: inline"
                                              action="/article/{{ $article->id }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-sm btn-outline-danger" type="submit"
                                                   value="Delete">
                                        </form>
                                    @endauth

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-3">
                    {{ $articles->links() }}
                </div>

                @auth
                    <div class="mt-2">
                        <a class="btn btn-success btn-sm" href="/article/create">
                            <i class="fas fa-newspaper"></i>
                            Create new Article
                        </a>
                    </div>
                @endauth

            </div>
        </div>
    </div>
@endsection
