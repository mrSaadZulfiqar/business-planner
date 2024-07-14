@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-scenario-modeling') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Scenario Modeling') }}</h5>
                                <p>{{ __('Create different scenarios based on various parameters to predict financial outcomes.') }}
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
                                    <h6>{{ __('Scenario Parameters') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Sales Growth Rate') }}</label>
                                            <input name="sales_growth_rate" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: -5% (Worst Case), 5% (Most Likely), 15% (Best Case)"
                                                value="{{ old('sales_growth_rate') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Expense Growth Rate') }}</label>
                                            <input name="expense_growth_rate" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: 10% (Worst Case), 5% (Most Likely), 0% (Best Case)"
                                                value="{{ old('expense_growth_rate') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Historical Financial Data (Last Year)') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Revenue') }}</label>
                                            <input name="revenue" class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: $500,000" value="{{ old('revenue') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Operating Expenses') }}</label>
                                            <input name="operating_expenses" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $300,000"
                                                value="{{ old('operating_expenses') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Net Profit') }}</label>
                                            <input name="net_profit" class="multisteps-form__input form-control"
                                                type="text"
                                                placeholder="e.g: $200,000 (Calculated as Revenue - Operating Expenses)"
                                                value="{{ old('net_profit') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Parameter Range Definition') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Sales Growth') }}</label>
                                            <input name="sales_growth" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: can range from -10% to 20%"
                                                value="{{ old('sales_growth') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Expense Growth') }}</label>
                                            <input name="expense_growth" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: can range from 0% to 15%"
                                                value="{{ old('expense_growth') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Scenario Creation Logic') }}</h6>
                                    <p>{{ __('Linear impact on revenue and expenses based on the growth rates.') }}</p>

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
