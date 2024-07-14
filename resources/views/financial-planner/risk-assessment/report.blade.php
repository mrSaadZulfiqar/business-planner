@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-body mb-4">
                <h4 class="font-weight-bolder">{{ __('Risk Assessment Report') }}</h4>
                <hr>
                <div class="content">
                    {!! $report !!}
                </div>
            </div>
        </div>
    </div>
@endsection
