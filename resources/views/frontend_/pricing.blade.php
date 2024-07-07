
@extends('frontend.layout')
@section('title','Pricing')
@section('content')
    <section class="py-3">
        <div class="bg-dark position-relative">
            <img src="" class="position-absolute start-0 top-md-0 w-100 opacity-6">
            <div class="container pb-lg-9 pb-7 pt-7 postion-relative z-index-2">
                <div class="row mt-4">

                    <div class="col-md-8 mx-auto text-center mt-4">
                        <span class="badge bg-gradient-info mb-2">{{__('Pricing')}}</span>
                        <h1 class="text-white">
                            @if (!empty($landingpage))
                                {{$landingpage->hero_title}}
                            @endif
                        </h1>
                        <p class="text-white mb-4">
                            @if (!empty($landingpage))
                                {{$landingpage->hero_subtitle}}
                            @endif
                        </p>


                    </div>
                </div>
            </div>
        </div>
        <div class=" ">
            <div class="mt-n8 ">
                <div class="container mb-10">

                    <div class="">
                        <div class="row">
                            @foreach($plans as $plan)

                                <div class="@if(count($plans) == 3) @if($loop->iteration == 1) col-lg-3 mb-lg-auto mb-4 my-auto p-md-0 ms-auto @elseif($loop->iteration == 2) col-lg-3 p-md-0 mb-lg-auto mb-4 z-index-2 @elseif($loop->iteration == 3) col-lg-3 mb-lg-auto mb-4 my-auto p-md-0 me-auto @endif @endif">
                                    <div class="card @if(count($plans) == 3) @if($loop->iteration == 1) bg-white @elseif($loop->iteration == 2) bg-purple-light @elseif($loop->iteration == 3) bg-white @endif @endif">
                                        <div class="card-header mt-4 @if(count($plans) == 3) @if($loop->iteration == 1) bg-white @elseif($loop->iteration == 2) bg-purple-light @elseif($loop->iteration == 3) bg-white @endif @endif text-center ">
                                            <h6 class="text-dark opacity-8 text mb-0">{{$plan->name}}</h6>
{{--                                            <h4 class=" text mb-2">{{$plan->name}}</h4>--}}
                                            <p>{!! $plan->description !!}</p>

                                            <h2 class=" font-weight-bolder mt-3">
                                                {{formatCurrency($plan->price_monthly,getWorkspaceCurrency($super_settings))}}<small class="text-sm text-secondary font-weight-bold">/ {{__(' month')}}</small>
                                            </h2>

                                                <h2 class=" font-weight-bolder mt-3">
                                        {{formatCurrency($plan->price_yearly,getWorkspaceCurrency($super_settings))}} <small class="text-sm text-secondary font-weight-bold">/ {{__(' year')}}</small>
                                    </h2>

                                        </div>
                                        <div class="card-body mx-auto pt-0">
                                            @if($plan->features)

                                                @foreach(json_decode($plan->features) as $feature)

                                                    <div class=" justify-content-start d-flex px-2 py-1">
                                                        <div>
                                                            <i class="fas fa-check text-purple text-sm"></i>
                                                        </div>
                                                        <div class="ps-2">
                                                            <span class="text-sm">{{$feature}}</span>
                                                        </div>
                                                    </div>


                                                @endforeach

                                            @endif
                                        </div>
                                        <div class="card-footer text-center pt-0">
                                            <a href="/signup" type="button"
                                               class="btn w-100  @if($loop->iteration == 1) btn-dark @elseif($loop->iteration == 2) btn-info @elseif($loop->iteration == 3) col-lg-3 btn-dark @endif
                                                mb-0 ">{{__('Get Started')}}</a>

                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                    </div>
                </div>
            </div>

        </div>










@endsection













