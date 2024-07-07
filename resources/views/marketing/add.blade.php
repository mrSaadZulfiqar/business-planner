@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('Write Marketing Plan')}}</h4>
                    <hr>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Business/Company Name')}}
                                        </label><label class="text-danger">*</label>
                                        <input class="form-control" name="company_name" id="company_name"
                                               @if (!empty($model))
                                               value="{{$model->company_name}}"
                                            @endif
                                        >
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                            </div>
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Business Summary')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Companny name and mission statement')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="summary"
                                                  name="summary">@if (!empty($model)){{$model->summary}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_summary">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Company Description')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What does your company do? What challanges your company solve?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="description"
                                                  name="description">@if (!empty($model)){{$model->description}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_description">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Team')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who is involved in this journey? List who is enacting different stages of the plan.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="team"
                                              name="team">@if (!empty($model)){{$model->team}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_team">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Business Initiatives')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Summary of your marketing goals and initiatives to achieve them. Who are your competitors?Include marketing strategies.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="business_initiatives"
                                                  name="business_initiatives">@if(!empty($model)){{$model->business_initiatives}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_business_initiatives">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Target Market')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Who are you targeting? Who makes up your target market? Who are your target buyer, personas, and ideal customers?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="target_market"
                                              name="target_market">@if(!empty($model)){{$model->target_market}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_target_market">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div>
                                <div class="row mt-4">
                                    <div class="col align-self-center">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">
                                                {{__('Budget')}}
                                            </label>
                                            <p class="form-text text-muted text-xs ms-1">
                                                {{__('An overview of the amount you will spend to reach your marketing goals.')}}
                                            </p>
                                            <textarea class="form-control mt-4" rows="10" id="budget"
                                                      name="budget">
                                                @if(!empty($model)){{$model->budget}}@endif
                                            </textarea>
                                            @if(!empty($super_settings['openai_api_key']))
                                                <button class="btn btn-info mt-4" type="submit" id="generate_budget">{{__('Generate with AI')}}</button>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col align-self-center">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">
                                                {{__('Marketing Channels')}}
                                            </label>
                                            <p class="form-text text-muted text-xs ms-1">
                                               {{__('Which Channels and platforms you use to reach your audience and achieve your goals?')}}
                                            </p>
                                            <textarea class="form-control mt-4" rows="10" id="marketing"
                                                      name="marketing_channels">
                                                @if(!empty($model)){{$model->marketing_channels}}@endif
                                            </textarea>
                                            @if(!empty($super_settings['openai_api_key']))
                                                <button class="btn btn-info mt-4" type="submit" id="generate_marketing">{{__('Generate with AI')}}</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @if($model)
                            <input type="hidden" name="id" value="{{$model->id}}">
                        @endif
                        @csrf
                        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        (function(){
            "use strict";
            tinymce.init({
                selector: '#budget',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#target_market',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#marketing',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#business_initiatives',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#team',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#description',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#summary',
                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });

            @if(!empty($super_settings['openai_api_key']))

            let generate_budget = document.getElementById('generate_budget');
            let budget = document.getElementById('budget');

            generate_budget.addEventListener('click',function (e) {
                e.preventDefault();

                generate_budget.disabled = true;
                generate_budget.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'budget',
                }).then(function (response) {
                    tinymce.get("budget").setContent(response.data.message);

                    generate_budget.disabled = false;
                    generate_budget.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_target_market = document.getElementById('generate_target_market');
            let target_market = document.getElementById('target_market');

            generate_target_market.addEventListener('click',function (e) {
                e.preventDefault();

                generate_target_market.disabled = true;
                generate_target_market.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'target_market',
                }).then(function (response) {
                    tinymce.get("target_market").setContent(response.data.message);

                    generate_target_market.disabled = false;
                    generate_target_market.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_marketing = document.getElementById('generate_marketing');
            let marketing = document.getElementById('marketing');

            generate_marketing.addEventListener('click',function (e) {
                e.preventDefault();

                generate_marketing.disabled = true;
                generate_marketing.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'marketing',
                }).then(function (response) {
                    tinymce.get("marketing").setContent(response.data.message);

                    generate_marketing.disabled = false;
                    generate_marketing.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_business_initiatives = document.getElementById('generate_business_initiatives');
            let business_initiatives = document.getElementById('business_initiatives');

            generate_business_initiatives.addEventListener('click',function (e) {
                e.preventDefault();

                generate_business_initiatives.disabled = true;
                generate_business_initiatives.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'business_initiatives',
                }).then(function (response) {
                    tinymce.get("business_initiatives").setContent(response.data.message);

                    generate_business_initiatives.disabled = false;
                    generate_business_initiatives.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_team = document.getElementById('generate_team');
            let team = document.getElementById('team');

            generate_team.addEventListener('click',function (e) {
                e.preventDefault();

                generate_team.disabled = true;
                generate_team.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'team',
                }).then(function (response) {
                    tinymce.get("team").setContent(response.data.message);

                    generate_team.disabled = false;
                    generate_team.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_description = document.getElementById('generate_description');
            let description = document.getElementById('description');

            generate_description.addEventListener('click',function (e) {
                e.preventDefault();

                generate_description.disabled = true;
                generate_description.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'description',
                }).then(function (response) {
                    tinymce.get("description").setContent(response.data.message);

                    generate_description.disabled = false;
                    generate_description.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_summary = document.getElementById('generate_summary');
            let summary = document.getElementById('summary');

            generate_summary.addEventListener('click',function (e) {
                e.preventDefault();

                generate_summary.disabled = true;
                generate_summary.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/marketing-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'summary',
                }).then(function (response) {
                    tinymce.get("summary").setContent(response.data.message);

                    generate_summary.disabled = false;
                    generate_summary.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });
            @endif
        })();
    </script>
@endsection
