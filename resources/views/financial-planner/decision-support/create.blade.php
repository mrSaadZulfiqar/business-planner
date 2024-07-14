@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-decision-support') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Decision Support') }}</h5>
                                <p>{{ __('Assist in making informed decisions based on financial data and scenarios.') }}
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
                                    <h6>{{ __('Objectives') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Objective') }}</label>
                                            <input name="objective" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Determine the best investment strategy for the upcoming year."
                                                value="{{ old('objective') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Goal') }}</label>
                                            <input name="goal" class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: Maximize ROI while managing risk."
                                                value="{{ old('goal') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Financial Data') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Historical ROI on investments') }}</label>
                                            <input name="historical_roi" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: 10% average annually."
                                                value="{{ old('historical_roi') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Budget for new investments') }}</label>
                                            <input name="budget" class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: $1,000,000" value="{{ old('budget') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Key Variables') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Market growth rate') }}</label>
                                            <input name="market_growth_rate" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Critical variable affecting investment returns."
                                                value="{{ old('market_growth_rate') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Investment risk level') }}</label>
                                            <input name="investment_risk_level" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: High-risk investments have a potential ROI of 20%, while low-risk investments offer a 5% ROI."
                                                value="{{ old('investment_risk_level') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Financial Scenarios') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <label>{{ __('Best-case Scenario') }}</label>
                                            <input name="best_case_scenario" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Market grows by 10%, favoring high-risk investments."
                                                value="{{ old('best_case_scenario') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Worst-case Scenario') }}</label>
                                            <input name="worst_case_scenario" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Market declines by 5%, favoring low-risk investments."
                                                value="{{ old('worst_case_scenario') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Most Likely Scenario') }}</label>
                                            <input name="most_likely_scenario" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: Market grows by 5%, a balanced approach to investment risk."
                                                value="{{ old('most_likely_scenario') }}" />
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
