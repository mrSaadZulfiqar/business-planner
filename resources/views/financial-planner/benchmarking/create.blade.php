@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-benchmarking') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3 js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{ __('Benchmarking') }}</h5>
                                <p>{{ __('Benchmark your financial metrics against industry and peer averages.') }}</p>
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
                                    <h6>{{ __('Benchmarking Metrics') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <label>{{ __('Metrics') }}</label>
                                            <input name="metrics" class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: Revenue Growth Rate, Profit Margin, and Operating Expenses Ratio"
                                                value="{{ old('metrics') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Gather Financial Data') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Revenue') }}</label>
                                            <input name="revenue" class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: $500,000" value="{{ old('revenue') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Net Profit') }}</label>
                                            <input name="net_profit" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $50,000"
                                                value="{{ old('net_profit') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Operating Expenses') }}</label>
                                            <input name="operating_expenses" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $300,000"
                                                value="{{ old('operating_expenses') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Revenue Growth Rate') }}</label>
                                            <input name="revenue_growth_rate" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: Not applicable for Year 1"
                                                value="{{ old('revenue_growth_rate') }}" />
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{ __('Profit Margin') }}</label>
                                            <input name="profit_margin" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: $50,000 / $500,000 = 10%"
                                                value="{{ old('profit_margin') }}" />
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{ __('Operating Expenses Ratio') }}</label>
                                            <input name="operating_expenses_ratio"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: $300,000 / $500,000 = 60%"
                                                value="{{ old('operating_expenses_ratio') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Industry Benchmarks') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <label>{{ __('Average Revenue Growth Rate') }}</label>
                                            <input name="avg_revenue_growth_rate"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 15%" value="{{ old('avg_revenue_growth_rate') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Average Profit Margin') }}</label>
                                            <input name="avg_profit_margin" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: 12%"
                                                value="{{ old('avg_profit_margin') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Average Operating Expenses Ratio') }}</label>
                                            <input name="avg_operating_expenses_ratio"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 55%" value="{{ old('avg_operating_expenses_ratio') }}" />
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{ __('Peer Group') }}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <label>{{ __('Average Revenue Growth Rate') }}</label>
                                            <input name="peer_avg_revenue_growth_rate"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 20%" value="{{ old('peer_avg_revenue_growth_rate') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Average Profit Margin') }}</label>
                                            <input name="peer_avg_profit_margin" class="multisteps-form__input form-control"
                                                type="text" placeholder="e.g: 8%"
                                                value="{{ old('peer_avg_profit_margin') }}" />
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{ __('Average Operating Expenses Ratio') }}</label>
                                            <input name="peer_avg_operating_expenses_ratio"
                                                class="multisteps-form__input form-control" type="text"
                                                placeholder="e.g: 50%"
                                                value="{{ old('peer_avg_operating_expenses_ratio') }}" />
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
