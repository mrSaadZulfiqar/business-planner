@extends('layouts.primary')
@section('content')

    <div class=" row">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('Sales Tool Repository')}}
            </h5>
        </div>
    </div>
    <div class="row pt-5">
            @foreach($files as $file)
                <div class="card col-md-2 col-12 m-2 mb-4">
                    <img class="card-img-top mx-auto pt-3" style="width:80px; height:auto;" src="{{asset($file['path'])}}" alt="Download file">
                    <div class="card-body p-0 mx-auto mt-3 text-center">
                    <h6 class="card-title">{{$file['name']}}</h6>
                    <a href="{{$file['file_name']}}" download="{{$file['name']}}" class="btn btn-info">Download</a>
                    </div>
                </div>
            @endforeach
    </div>

@endsection