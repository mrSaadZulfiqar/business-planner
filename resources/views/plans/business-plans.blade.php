@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('Business Plans')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/write-business-plan" type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">  {{__('Write your Business Plan')}}</a>

        </div>
    </div>
    <div class="row " data-masonry='{"percentPosition": true }'>

        @foreach($plans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header bg-gradient-dark">
                        <div class="text-end">
                            <div class="dropstart">
                                <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                    aria-labelledby="dropdownMarketingCard">
                                    <li><a class="dropdown-item border-radius-md"
                                           href="/write-business-plan?id={{$plan->id}}">{{__('Edit')}}</a></li>

                                    <li><a class="dropdown-item border-radius-md"
                                           href="/view-business-plan?id={{$plan->id}}">{{__('See Details')}}</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item border-radius-md text-danger"
                                           href="/delete/business-plan/{{$plan->id}}">{{__('Delete')}}</a></li>
                                </ul>
                            </div>
                        </div>

                        @if(!empty($plan->logo))
                            <img src="{{PUBLIC_DIR}}/uploads/{{$plan->logo}}" class="w-30">
                        @endif



                        <h5 class="mt-3 text-white"> @if(!empty($plan->company_name))
                                {{$plan->company_name}}
                            @endif
                        </h5>

                        <h5 class="text-white fw-bolder mt-2 mb-2">
                            {{__('Business Plan')}}</h5>
                        <h6 class="text-success">
                            @if(!empty($plan->date))

                                {{(\App\Supports\DateSupport::parse($plan->date))->format(config('app.date_format'))}}

                            @endif</h6>


                    </div>

                    <div class=" card-body ">
                        <div class="col-9">
                            <p class="text-muted text-sm">{{__('Written by')}}</p>
                            <h6>{{$plan->name}}</h6>
                            <h6 class="text-muted">{{$plan->email}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Write your Business Plan')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/business-plan-post">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">
                                    {{__('Business/Company Name')}}
                                </label><label class="text-danger">*</label>
                                <input class="form-control" name="company_name" id="company_name">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea2">
                                    {{__('Your Name')}}
                                </label><label class="text-danger">*</label>
                                <input class="form-control" name="name" id="name">
                            </div>
                        </div>

                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                        <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">{{__('Close')}}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
