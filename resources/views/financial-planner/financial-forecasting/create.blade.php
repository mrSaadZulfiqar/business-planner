@extends('layouts.primary')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-5">
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-10 m-auto">
                        <form action="{{ route('save-financial-forecast') }}" method="post" class="multisteps-form__form mb-8">
                            @csrf
                            <div class="card card-body p-3  js-active" data-animation="FadeIn">
                                <h5 class="font-weight-bolder mb-0">{{__('Financial Forecasting')}}</h5>
                                <p>{{__('Financial forecasting is the process of using past financial data and current market trends to make educated assumptions for future periods')}}</p>
                                <hr>

                                <div class="multisteps-form__content">
                                    <h6>{{__('Historical Financial Data For The Past Year')}}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Revenue')}}</label>
                                            <input name="revenue" class="multisteps-form__input form-control" type="text" placeholder="e.g: $1,000,000"/>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Cost of Goods Sold (COGS)')}}</label>
                                            <input name="cogs" class="multisteps-form__input form-control" type="text" placeholder="e.g: $400,000"/>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Operating Expenses')}}</label>
                                            <input name="operating_expenses" class="multisteps-form__input form-control" type="text" placeholder="e.g: $300,000"/>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Net Profit')}}</label>
                                            <input name="net_profit" class="multisteps-form__input form-control" type="text" placeholder="e.g: $300,000"/>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{__('Market Analysis')}}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Market Growth')}}</label>
                                            <input name="market_growth" class="multisteps-form__input form-control" type="text" placeholder="e.g: 10% year-over-year"/>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Company\'s Expected Growth')}}</label>
                                            <input name="expected_growth" class="multisteps-form__input form-control" type="text" placeholder="e.g: Company\'s expected growth in line with the market"/>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{__('Scenario-Specific Variables')}}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-4">
                                            <label>{{__('Best-case')}}</label>
                                            <input name="best_case" class="multisteps-form__input form-control" type="text" placeholder="e.g: Higher market demand, more efficient cost management"/>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{__('Worst-case')}}</label>
                                            <input name="worst_case" class="multisteps-form__input form-control" type="text" placeholder="e.g: Lower market demand, increased competition"/>
                                        </div>
                                        <div class="col-12 col-sm-4 mt-3 mt-sm-0">
                                            <label>{{__('Most likely')}}</label>
                                            <input name="most_likely" class="multisteps-form__input form-control" type="text" placeholder="e.g: Market growth at expected rates, stable competition"/>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{__('Business Model Description')}}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Revenue Streams')}}</label>
                                            <input name="revenue_streams" class="multisteps-form__input form-control" type="text" placeholder="e.g: Software sales, subscription services"/>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Cost Structure')}}</label>
                                            <input name="cost_structure" class="multisteps-form__input form-control" type="text" placeholder="e.g: Primarily fixed costs (salaries, rent)"/>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>{{__('Growth Projections and Assumptions')}}</h6>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-6">
                                            <label>{{__('Sales growth assumption')}}</label>
                                            <input name="sales_growth_assumption" class="multisteps-form__input form-control" type="text" placeholder="e.g: 10% (most likely), 20% (best-case), 5% (worst-case)"/>
                                        </div>
                                        <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                            <label>{{__('Expense Forecasts')}}</label>
                                            <input name="expense_forecasts" class="multisteps-form__input form-control" type="text" placeholder="e.g: expected to increase by 5% (most likely), 3% (best-case), 10% (worst-case)"/>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-12 text-right">
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit">{{__('Create')}}</button>
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
