@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Article Detail') }}</div>

                    <div class="card-body">
                        <span><b>{{$article->title}}</b><i>  by: {{$article->user->name}}</i></span>
                        <br><br>
                        <p>{{$article->description}}</p>
                    </div>

                </div>

                <div class="card bg-transparent mb-1 border-light">
                    <div class="mt-2">
                        <div class="btn-group float-right">
                            @auth
                                <a class="btn btn-success" href="/comment/create/{{$article->id}}"><i
                                        class="fas fa-comment"></i>
                                    Comment</a>
                            @endauth
                            <a class="btn btn-primary ml-2" href="/article"><i
                                    class="fas fa-arrow-circle-up"></i>
                                Back</a>
                        </div>
                    </div>
                </div>


                <div class="card ">

                    @guest()
                        <div class="card-header">Register to Join the Discussion</div>
                    @endguest

                    @auth
                        <div class="card-header">Article Comments ({{$article->comments->count()}})</div>


                        @foreach($article->comments as $comment)
                            <div class="card-body">
                                <span><b>{{$comment->user->name}}</b> - {{ $comment->created_at->diffForHumans() }}</span>
                                <p>{{$comment->commentary}}</p>

                                @auth
                                    <a class="btn btn-sm btn-outline-primary float-right ml-2"
                                       href="/comment/{{ $comment->id }}/edit">
                                        <i class="fas fa-edit"></i> Edit</a>

                                    <form class="float-right" style="display: inline"
                                          action="/comment/{{ $comment->id }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-sm btn-outline-danger" type="submit"
                                               value="Delete">
                                    </form>
                                @endauth

                            </div>
                        @endforeach
                    @endauth

                </div>


            </div>
        </div>
    </div>
@endsection
