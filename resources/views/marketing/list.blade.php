@extends('layouts.primary')
@section('content')
    <div class=" row">
        <div class="col">
            <h5 class="text-secondary fw-bolder">
                {{__('One Page Marketing Plan')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/write-marketing-plan" type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#exampleModal">  {{__('Create Marketing Plan')}}</a>

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach($models as $model)
                    <div class="col-lg-4 col-md-6 col-12 mt-lg-0 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-md-9">
                                        <h5 class="text-dark fw-bolder">{{$model->company_name}}</h5>


                                        <p class="text-sm">{{__('Related Product')}}:<span class="text-dark fw-bolder"> @if(!empty($products[$model->product_id]))
                                                    @if(isset($products[$model->product_id]))
                                                        {{$products[$model->product_id]->title}}
                                                    @endif
                                                @endif</span></p>

                                        <p class="text-sm">{{__('Created At')}}:
                                            <span class="badge bg-secondary">{{(\App\Supports\DateSupport::parse($model->created_at))->format(config('app.date_format'))}}</span></p>

                                    </div>
                                    <div class="col-3 text-end">
                                        <div class="dropstart">
                                            <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                               data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                aria-labelledby="dropdownMarketingCard">
                                                <li><a class="dropdown-item border-radius-md"
                                                       href="/write-marketing-plan?id={{$model->id}}">{{__('Edit')}}</a>
                                                </li>
                                                <li><a class="dropdown-item border-radius-md"
                                                       href="/view-marketing-plan?id={{$model->id}}">{{__('See Details')}}</a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item border-radius-md text-danger"
                                                       href="/delete/marketing-plan/{{$model->id}}">{{__('Delete')}}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Create Marketing Plan')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/save-marketing-plan">
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

                        </div>
                        <div class="">

                            <label for="exampleFormControlInput1" class="form-label">{{__('Select Product')}}</label>
                            <select class="form-select form-select-solid fw-bolder" id="contact"
                                    aria-label="Floating label select example" name="product_id">
                                <option value="0">{{__('None')}}</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}"
                                            @if (!empty($model))
                                            @if ($model->product_id === $product->id)
                                            selected
                                        @endif
                                        @endif
                                    >{{$product->title}}</option>
                                @endforeach
                            </select>
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
