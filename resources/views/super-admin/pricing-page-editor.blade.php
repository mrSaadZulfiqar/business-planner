@extends('layouts.super-admin-portal')
@section('content')
    <h5 class="mb-3">{{__('Pricing Page Text Editor')}}</h5>

    <div class="btn-group mt-2">
        <button type="button" class="btn ms-auto btn-dark btn-icon-only " data-bs-toggle="offcanvas" data-bs-target="#hero" aria-controls="offcanvasRight">
        <span class="btn-inner--icon">
<svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" mb-2 feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
        </span>
        </button>
        <a href="/pricing" target="_blank" type="button" class="btn btn-success btn-icon-only">
            <span class="btn-inner--icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>
                </svg>
            </span>
        </a>

    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="hero" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">{{__('Hero Section ')}}</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <form action="/save-pricing-hero-section" method="post" enctype="multipart/form-data">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="offcanvas-body">

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Title')}}</label>
                    <input type="text" name="hero_title" class="form-control" id="title"  value="{{$landingpage->hero_title ?? old('hero_title') ?? ''}}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">{{__('Subtitle')}}</label>
                    <input type="text" name="hero_subtitle" value="{{$landingpage->hero_subtitle ?? old('hero_subtitle') ?? ''}}" class="form-control" id="title">
                </div>

                @csrf

                @if (!empty($landingpage))
                    <input type="hidden" name="id" value="{{$landingpage->id}}">
                @endif
                <div class="button-row text-left mt-4">
                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next" type="submit" title="Next">{{__('Save')}}</button>
                </div>

            </div>
        </form>
    </div>

    <section class="">
        <div class="bg-dark position-relative">
            <img src="" class="position-absolute start-0 top-md-0 w-100 opacity-6">
            <div class="pb-lg-9 pb-7 pt-7 postion-relative z-index-2">
                <div class="row mt-4">
                    <div class="col-md-8 mx-auto text-center">
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
        <div class="">
            <div class="mt-sm-n5 mt-n4">
                <div class="container">
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
                                                {{formatCurrency($plan->price_monthly,getWorkspaceCurrency($settings))}}<small class="text-sm text-secondary font-weight-bold">/ {{__(' month')}}</small>
                                            </h2>

                                            <h2 class=" font-weight-bolder mt-3">
                                                {{formatCurrency($plan->price_yearly,getWorkspaceCurrency($settings))}} <small class="text-sm text-secondary font-weight-bold">/ {{__(' year')}}</small>
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

    </section>



@endsection
