@extends('layouts.primary')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{__('Write your Business plan')}}</h3>
        </div>
        <div class="card-body multisteps-form">
            <form action="/business-plan-post" class="multisteps-form__form mb-8" enctype="multipart/form-data" method="post">
                @if ($errors->any())
                    <div class="alert bg-pink-light text-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error => $error_message)
                                <li>{{ $error_message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="example-text-input" class="form-control-label">{{__('Business Name')}}</label><label class="text-danger">*</label>
                    <input class="form-control" type="text" name="company_name"
                        value="{{$plan->company_name ?? old('company_name') ?? ''}}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">{{__('Your Name')}}</label><label class="text-danger">*</label>
                            <input class="form-control" name="name" type="text"
                                   value="{{$plan->name ?? old('name') ?? ''}}">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-search-input" class="form-control-label">{{__('Date')}}</label>
                            <input class="form-control" name="date" id="date" @if(!empty($plan))
                            value="{{$plan->date}}"
                                   @else
                                   value="{{date('Y-m-d')}}"
                                @endif >
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-email-input" class="form-control-label">{{__('Email')}}</label>
                            <input class="form-control" type="email" name="email"
                                   @if(!empty($plan))value="{{$plan->email}}"@endif>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="example-tel-input" class="form-control-label">{{__('Phone')}}</label>
                            <input class="form-control" type="tel" name="phone"
                                   @if(!empty($plan))value="{{$plan->phone}}"@endif>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="logo_file" class="form-label mt-4">{{__('Upload Logo')}}</label>
                        <input class="form-control" name="logo" type="file" id="logo_file">
                    </div>
                <div class="form-group">
                    <label for="example-url-input" class="form-control-label">{{__('Website')}}</label>
                    <input class="form-control" name="website"
                           @if(!empty($plan))value="{{$plan->website}}"@endif>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Executive Summary')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('A snapshot of your business')}}
                    </p>
                    <textarea class="form-control" name="ex_summary" id="ex_summary"
                              rows="10">@if (!empty($plan)){{$plan->ex_summary}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_ex_summary">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Company description')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Describe what you do')}}
                    </p>
                    <textarea class="form-control" name="description" id="com_description"
                              rows="10">@if(!empty($plan)){{$plan->description}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_com_description">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Market Analysis')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Rsesearch on your industry, market and competitors')}}
                    </p>
                    <textarea class="form-control" name="m_analysis" id="market_analysis"
                              rows="10">@if(!empty($plan)){{$plan->m_analysis}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_market_analysis">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Organization & Management')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Your business and management structure')}}
                    </p>
                    <textarea class="form-control" name="management" id="organization"
                              rows="10">@if(!empty($plan)){{$plan->management}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_organization">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Service or product')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('The products or services you’re offering')}}
                    </p>
                    <textarea class="form-control" name="product" id="service_product"
                              rows="10">@if(!empty($plan)){{$plan->product}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_service_product">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Marketing and sales')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('How you’ll market your business and your sales strategy')}}
                    </p>
                    <textarea class="form-control" name="marketing" id="marketing_sale"
                              rows="10">@if(!empty($plan)){{$plan->marketing}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_marketing_sale">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Budget')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Budget of your company for next 2 years with source of the moneys')}}
                    </p>
                    <textarea class="form-control" name="budget" id="budget"
                              rows="10">@if(!empty($plan)){{$plan->budget}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_budget">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Investment/Funding request')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('How much money you’ll need for next 3 to 5 years')}}
                    </p>
                    <textarea class="form-control" name="investment" id="investment"
                              rows="10">@if(!empty($plan)){{$plan->investment}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_investment">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Financial projections')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('Supply information like balance sheets')}}
                    </p>
                    <textarea class="form-control" name="finance" id="financial_projections"
                              rows="10">@if(!empty($plan)){{$plan->finance}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_financial_projections">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">
                        {{__('Appendix')}}

                    </label>
                    <p class="form-text text-muted text-xs ms-1">
                        {{__('An optional section that includes résumés and permits')}}
                    </p>
                    <textarea class="form-control" name="appendix" id="appendix"
                              rows="10">@if(!empty($plan)){{$plan->appendix}}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_appendix">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                    <div class="form-group mb-4">
                        <label for="logo_file" class="form-label mt-3 ">{{__('Upload file')}}</label>
                        <p class="form-text text-muted text-xs ms-1">
                            {{__('Upload résumés and permits')}}
                        </p>
                        <input class="form-control" name="file" type="file" id="logo_file">
                    </div>

                @csrf
                @if($plan)
                    <input type="hidden" name="id" value="{{$plan->id}}">
                @endif
                <button type="submit" class="btn bg-gradient-dark">{{__('Save')}}</button>

            </form>
        </div>
    </div>

@endsection

@section('script')

    <script>

        $(function () {
            "use strict";

            flatpickr("#date", {

                dateFormat: "Y-m-d",
            });

        });

    </script>
    <script>
        (function(){
            "use strict";

            tinymce.init({
                selector: '#ex_summary',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,

            });
            tinymce.init({
                selector: '#com_description',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,

            });
            tinymce.init({
                selector: '#market_analysis',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#organization',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#service_product',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#marketing_sale',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#budget',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#investment',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,


            });
            tinymce.init({
                selector: '#financial_projections',

                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',

                    'insertdatetime media table paste code  wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                branding: false,
            });
            tinymce.init({
                selector: '#appendix',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,

            });
            @if(!empty($super_settings['openai_api_key']))

            let generate_ex_summary = document.getElementById('generate_ex_summary');
            let ex_summary = document.getElementById('ex_summary');

            generate_ex_summary.addEventListener('click',function (e) {
                e.preventDefault();

                generate_ex_summary.disabled = true;
                generate_ex_summary.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'ex_summary',
                }).then(function (response) {
                    tinymce.get("ex_summary").setContent(response.data.message);

                    generate_ex_summary.disabled = false;
                    generate_ex_summary.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_com_description = document.getElementById('generate_com_description');
            let com_description = document.getElementById('com_description');

            generate_com_description.addEventListener('click',function (e) {
                e.preventDefault();

                generate_com_description.disabled = true;
                generate_com_description.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'com_description',
                }).then(function (response) {
                    tinymce.get("com_description").setContent(response.data.message);

                    generate_com_description.disabled = false;
                    generate_com_description.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_market_analysis = document.getElementById('generate_market_analysis');
            let market_analysis = document.getElementById('market_analysis');

            generate_market_analysis.addEventListener('click',function (e) {
                e.preventDefault();

                generate_market_analysis.disabled = true;
                generate_market_analysis.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'market_analysis',
                }).then(function (response) {
                    tinymce.get("market_analysis").setContent(response.data.message);

                    generate_market_analysis.disabled = false;
                    generate_market_analysis.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_organization = document.getElementById('generate_organization');
            let organization = document.getElementById('organization');

            generate_organization.addEventListener('click',function (e) {
                e.preventDefault();

                generate_organization.disabled = true;
                generate_organization.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'organization',
                }).then(function (response) {
                    tinymce.get("organization").setContent(response.data.message);

                    generate_organization.disabled = false;
                    generate_organization.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_service_product = document.getElementById('generate_service_product');
            let service_product = document.getElementById('service_product');

            generate_service_product.addEventListener('click',function (e) {
                e.preventDefault();

                generate_service_product.disabled = true;
                generate_service_product.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'service_product',
                }).then(function (response) {
                    tinymce.get("service_product").setContent(response.data.message);

                    generate_service_product.disabled = false;
                    generate_service_product.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });


            let generate_marketing_sale = document.getElementById('generate_marketing_sale');
            let marketing_sale = document.getElementById('marketing_sale');

            generate_marketing_sale.addEventListener('click',function (e) {
                e.preventDefault();

                generate_marketing_sale.disabled = true;
                generate_marketing_sale.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'marketing_sale',
                }).then(function (response) {
                    tinymce.get("marketing_sale").setContent(response.data.message);

                    generate_marketing_sale.disabled = false;
                    generate_marketing_sale.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_budget = document.getElementById('generate_budget');
            let budget = document.getElementById('budget');

            generate_budget.addEventListener('click',function (e) {
                e.preventDefault();

                generate_budget.disabled = true;
                generate_budget.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'budget',
                }).then(function (response) {
                    tinymce.get("budget").setContent(response.data.message);

                    generate_budget.disabled = false;
                    generate_budget.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_investment = document.getElementById('generate_investment');
            let investment = document.getElementById('investment');

            generate_investment.addEventListener('click',function (e) {
                e.preventDefault();

                generate_investment.disabled = true;
                generate_investment.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'investment',
                }).then(function (response) {
                    tinymce.get("investment").setContent(response.data.message);

                    generate_investment.disabled = false;
                    generate_investment.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_financial_projections = document.getElementById('generate_financial_projections');
            let financial_projections = document.getElementById('financial_projections');

            generate_financial_projections.addEventListener('click',function (e) {
                e.preventDefault();

                generate_financial_projections.disabled = true;
                generate_financial_projections.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'financial_projections',
                }).then(function (response) {
                    tinymce.get("financial_projections").setContent(response.data.message);

                    generate_financial_projections.disabled = false;
                    generate_financial_projections.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_appendix = document.getElementById('generate_appendix');
            let appendix = document.getElementById('appendix');

            generate_appendix.addEventListener('click',function (e) {
                e.preventDefault();

                generate_appendix.disabled = true;
                generate_appendix.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/plans-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$plan->company_name ?? ''}}',
                    action: 'appendix',
                }).then(function (response) {
                    tinymce.get("appendix").setContent(response.data.message);

                    generate_appendix.disabled = false;
                    generate_appendix.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            @endif
        })();
    </script>

@endsection










