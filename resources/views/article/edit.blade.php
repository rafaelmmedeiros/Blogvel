@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">Edit Article</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/article/{{$article->id}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text"
                                       class="form-control{{ $errors->has('title') ? ' border-danger' : '' }}"
                                       id="title" name="title" value="{{$article->title ?? old('title')}}">
                                <small class="form-text text-danger">{!! $errors->first('title') !!}</small>
                            </div>

                            @if(file_exists('img/articles/' . $article->id . '_large.jpg'))
                                <div class="mb-2">

                                    <img style="max-width: 280px; max-height: 210px"
                                         src="/img/articles/{{ $article->id }}_large.jpg" alt="">
                                    <a class="btn btn-sm btn-outline-danger float-right" href="/image/delete/{{$article->id}}">Delete Picture</a>

                                </div>
                            @endif

                            <div class="form-group">
                                <label for="image">Image: (max: 2MB)</label>
                                <input type="file"
                                       class="form-control{{ $errors->has('image') ? ' border-danger' : '' }}"
                                       id="image" name="image" value="">
                                <small class="form-text text-danger">{!! $errors->first('image') !!}</small>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control{{ $errors->has('description') ? ' border-danger' : '' }}"
                                          id="description" name="description"
                                          rows="5">{{$article->description ??old('description')}}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('description') !!}</small>
                            </div>

                            <input class="btn btn-primary mt-4" type="submit" value="Save Article">

                        </form>

                    </div>
                </div>

                <div class="mt-2">
                    <a class="btn btn-primary float-right" href="/article"><i class="fas fa-arrow-circle-up"></i>
                        Back</a>
                </div>

            </div>
        </div>
    </div>
@endsection
