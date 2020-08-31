@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ __('Article Detail') }}</div>

                    <div class="card-body">
                        <b>{{$article->title}}</b>
                        <p>{{$article->description}}</p>
                    </div>

                </div>

                <div class="mt-2">
                    <a class="btn btn-primary float-right" href="{{URL::previous()}}"><i
                            class="fas fa-arrow-circle-up"></i>
                        Back</a>
                </div>

            </div>
        </div>
    </div>
@endsection
