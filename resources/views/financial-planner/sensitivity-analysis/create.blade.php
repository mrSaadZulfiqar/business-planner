@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-sensitivity-analysis') }}" method="post"
                            class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Sensitivity Analysis') }}</h5>
                                <p>{{ __('Analyze the impact of variable changes on financial outcomes.') }}</p>
                                <hr>

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="multisteps-form__content">
                                    <h6>{{ __('Financial Outcomes') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Primary Financial Outcome') }}</label>
                                            <input name="primary_financial_outcome"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: Net Profit"
                                                value="{{ old('primary_financial_outcome') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Key Variables') }}</label>
                                            <input name="key_variables" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: Sales Volume and COGS"
                                                value="{{ old('key_variables') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Range of Variable Changes') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Sales Volume') }}</label>
                                            <input name="sales_volume_change" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: Analyze a +/- 10% change"
                                                value="{{ old('sales_volume_change') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('COGS') }}</label>
                                            <input name="cogs_change" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: Analyze a +/- 10% change"
                                                value="{{ old('cogs_change') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Current Variable Values') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Current Sales Volume') }}</label>
                                            <input name="current_sales_volume" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: 10,000 units"
                                                value="{{ old('current_sales_volume') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Current COGS') }}</label>
                                            <input name="current_cogs" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $50 per unit"
                                                value="{{ old('current_cogs') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Selling Price per Unit') }}</label>
                                            <input name="selling_price_per_unit" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $100"
                                                value="{{ old('selling_price_per_unit') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Current Net Profit') }}</label>
                                            <input name="current_net_profit" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: (100 - 50) * 10,000 = $500,000"
                                                value="{{ old('current_net_profit') }}" />
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <button class="btn bg-gradient-dark ms-auto mb-0"
                                                type="submit">{{ __('Create') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
