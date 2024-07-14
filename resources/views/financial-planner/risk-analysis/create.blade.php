@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-risk-analysis') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Risk Analysis') }}</h5>
                                <p>{{ __('Analyze various risk factors that could impact the financial health of the company.') }}
                                </p>
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
                                    <h6>{{ __('Risk Factors') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Credit Risk') }}</label>
                                            <input name="credit_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Probability of customers defaulting on payments."
                                                value="{{ old('credit_risk') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Market Risk') }}</label>
                                            <input name="market_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Potential for investment losses due to market fluctuations."
                                                value="{{ old('market_risk') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Data Collection') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Credit Risk Data (Customer A)') }}</label>
                                            <input name="credit_risk_data_customer_a"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 10% default probability"
                                                value="{{ old('credit_risk_data_customer_a') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Credit Risk Data (Customer B)') }}</label>
                                            <input name="credit_risk_data_customer_b"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 5% default probability"
                                                value="{{ old('credit_risk_data_customer_b') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Credit Risk Data (Customer C)') }}</label>
                                            <input name="credit_risk_data_customer_c"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 15% default probability"
                                                value="{{ old('credit_risk_data_customer_c') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Market Risk Data (Stock Price Fluctuations Over the Last Year)') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Average fluctuation') }}</label>
                                            <input name="market_risk_avg_fluctuation"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 8%" value="{{ old('market_risk_avg_fluctuation') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Maximum fluctuation') }}</label>
                                            <input name="market_risk_max_fluctuation"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 20%" value="{{ old('market_risk_max_fluctuation') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Minimum fluctuation') }}</label>
                                            <input name="market_risk_min_fluctuation"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: -12%" value="{{ old('market_risk_min_fluctuation') }}" />
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
