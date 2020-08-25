@extends('layouts.app')

@section('page_title', 'Info')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Info') }}</div>

                <div class="card-body">


                    {{ __('University project, Web System Development') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
