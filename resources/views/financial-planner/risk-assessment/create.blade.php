@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-risk-assessment') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Risk Assessment') }}</h5>
                                <p>{{ __('Identify and analyze potential risks that could impact the financial health of the company.') }}
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
                                    <h6>{{ __('Financial Risks') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Interest Rate Risk') }}</label>
                                            <input name="interest_rate_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: The risk that changes in interest rates will affect the company's profits."
                                                value="{{ old('interest_rate_risk') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Credit Risk') }}</label>
                                            <input name="credit_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: The risk of loss due to customers' failure to make payments."
                                                value="{{ old('credit_risk') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Operational Risks') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Supply Chain Risk') }}</label>
                                            <input name="supply_chain_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: The risk of disruption in the supply chain affecting operations."
                                                value="{{ old('supply_chain_risk') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('IT System Risk') }}</label>
                                            <input name="it_system_risk" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: The risk associated with system failures or cybersecurity threats."
                                                value="{{ old('it_system_risk') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Financial Risks Data') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Interest Rate Risk') }}</label>
                                            <input name="interest_rate_risk_data"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: Historical data shows a potential profit fluctuation of up to 5% due to interest rate changes."
                                                value="{{ old('interest_rate_risk_data') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Credit Risk') }}</label>
                                            <input name="credit_risk_data" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Historical default rates indicate a potential loss of up to 3% of annual revenue."
                                                value="{{ old('credit_risk_data') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Operational Risks Data') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Supply Chain Risk') }}</label>
                                            <input name="supply_chain_risk_data" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Analysis shows potential for up to a 4% increase in costs due to supply chain disruptions."
                                                value="{{ old('supply_chain_risk_data') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('IT System Risk') }}</label>
                                            <input name="it_system_risk_data" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Historical data indicates potential for up to a 2% loss in revenue due to IT system downtime."
                                                value="{{ old('it_system_risk_data') }}" />
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
