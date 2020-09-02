@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">Create New Comment</div>
                    <div class="card-body">
                        <form action="/comment" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="commentary">Commentary</label>
                                <textarea class="form-control{{ $errors->has('commentary') ? ' border-danger' : '' }}"
                                          id="commentary" name="commentary" rows="5">{{old('commentary')}}</textarea>
                                <small class="form-text text-danger">{!! $errors->first('commentary') !!}</small>
                            </div>
                            <input class="btn btn-primary mt-4" type="submit" value="Save Comment">
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
