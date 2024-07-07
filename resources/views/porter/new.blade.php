@extends('layouts.primary')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('Porter\'s Five Forces Model')}}</h4>
                    <p>{{__('The Porter\'s Five Forces Model is *a framework for analyzing a company\'s
competitive environment*.
')}}</p>
                    <hr>
                    <form method="post" action="/save-porter-model">
                        @if ($errors->any())
                            <div class="alert bg-pink-light text-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

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
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Threat of New Entry')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Profitable markets attract new entrants, which erodes profitability. Unless incumbents have strong and durable barriers to entry, for example, patents, economies of scale, capital requirements or government policies, then profitability will decline to a competitive rate.')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="structure"
                                                  name="entrants">@if (!empty($model)){{$model->entrants}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_structure">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Competitive rivalry')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('The main driver is the number and capability of competitors in the market. Many competitors, offering undifferentiated products and services, will reduce market attractiveness.')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="strategy" name="rivals">@if (!empty($model)){{$model->rivals}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_strategy">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Bargaining Power of Supplier')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('An assessment of how easy it is for suppliers to drive up prices. This is driven by the: number of suppliers of each essential input; uniqueness of their product or service; relative size and strength of the supplier; and cost of switching from one supplier to another.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="system"
                                                  name="suppliers">@if(!empty($model)){{$model->suppliers}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_system">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Bargaining Power of Buyers/Customers.')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('An assessment of how easy it is for buyers to drive prices down. This is driven by the: number of buyers in the market; importance of each individual buyer to the organisation; and cost to the buyer of switching from one supplier to another. If a business has just a few powerful buyers, they are often able to dictate terms.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="style"
                                              name="customers">@if(!empty($model)){{$model->customers}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_style">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">

                            <div class="col-md-12 align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Threat of substitution')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Where close substitute products exist in a market, it increases the likelihood of customers switching to alternatives in response to price increases. This reduces both the power of suppliers and the attractiveness of the market.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="shared"
                                              name="substitute">@if(!empty($model)){{$model->substitute}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_shared">{{__('Generate with AI')}}</button>
                                    @endif
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
                selector: '#structure',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#strategy',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#system',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#skill',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#staff',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#style',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });
            tinymce.init({
                selector: '#shared',
                plugins: 'lists,table',
                toolbar: 'numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
            });

            @if(!empty($super_settings['openai_api_key']))

            let generate_structure = document.getElementById('generate_structure');
            let structure = document.getElementById('structure');

            generate_structure.addEventListener('click',function (e) {
                e.preventDefault();

                generate_structure.disabled = true;
                generate_structure.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/porter-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'structure',
                }).then(function (response) {
                    tinymce.get("structure").setContent(response.data.message);

                    generate_structure.disabled = false;
                    generate_structure.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_strategy = document.getElementById('generate_strategy');
            let strategy = document.getElementById('strategy');

            generate_strategy.addEventListener('click',function (e) {
                e.preventDefault();

                generate_strategy.disabled = true;
                generate_strategy.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/porter-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'strategy',
                }).then(function (response) {
                    tinymce.get("strategy").setContent(response.data.message);

                    generate_strategy.disabled = false;
                    generate_strategy.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_system = document.getElementById('generate_system');
            let system = document.getElementById('system');

            generate_system.addEventListener('click',function (e) {
                e.preventDefault();

                generate_system.disabled = true;
                generate_system.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/porter-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'system',
                }).then(function (response) {
                    tinymce.get("system").setContent(response.data.message);

                    generate_system.disabled = false;
                    generate_system.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_style = document.getElementById('generate_style');
            let style = document.getElementById('style');

            generate_style.addEventListener('click',function (e) {
                e.preventDefault();

                generate_style.disabled = true;
                generate_style.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/porter-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'style',
                }).then(function (response) {
                    tinymce.get("style").setContent(response.data.message);

                    generate_style.disabled = false;
                    generate_style.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_shared = document.getElementById('generate_shared');
            let shared = document.getElementById('shared');

            generate_shared.addEventListener('click',function (e) {
                e.preventDefault();

                generate_shared.disabled = true;
                generate_shared.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/porter-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'shared',
                }).then(function (response) {
                    tinymce.get("shared").setContent(response.data.message);

                    generate_shared.disabled = false;
                    generate_shared.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });
            @endif
        })();
    </script>
@endsection

