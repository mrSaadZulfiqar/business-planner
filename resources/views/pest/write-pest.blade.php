@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('PEST Analysis')}}</h4>
                    <hr>
                    <form method="post" action="/save-pest">
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
                                            {{__('Political')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the political factors relate to how the government intervenes in the economy?')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="political"
                                                  name="political">@if (!empty($model)){{$model->political}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_political">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Economic')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the economic factors include economic growth, exchange rates, inflation rate, and interest rates. ')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="economic"
                                              name="economic">@if (!empty($model)){{$model->economic}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_economic">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Social')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the social factors include the cultural aspects and health consciousness, population growth rate, age distribution, career attitudes and emphasis on safety?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="social"
                                                  name="social">@if(!empty($model)){{$model->social}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_social">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Technological')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the technological factors include technological aspects like R&D activity, automation, technology incentives and the rate of technological change?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="technological"
                                              name="technological">@if(!empty($model)){{$model->technological}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_technological">{{__('Generate with AI')}}</button>
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
                selector: '#political',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#social',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#technological',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#economic',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });

            @if(!empty($super_settings['openai_api_key']))

            let generate_political = document.getElementById('generate_political');
            let political = document.getElementById('political');

            generate_political.addEventListener('click',function (e) {
                e.preventDefault();

                generate_political.disabled = true;
                generate_political.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/pest-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'political',
                }).then(function (response) {
                    tinymce.get("political").setContent(response.data.message);

                    generate_political.disabled = false;
                    generate_political.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_economic = document.getElementById('generate_economic');
            let economic = document.getElementById('economic');

            generate_economic.addEventListener('click',function (e) {
                e.preventDefault();

                generate_economic.disabled = true;
                generate_economic.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/pest-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'economic',
                }).then(function (response) {
                    tinymce.get("economic").setContent(response.data.message);

                    generate_economic.disabled = false;
                    generate_economic.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_social = document.getElementById('generate_social');
            let social = document.getElementById('social');

            generate_social.addEventListener('click',function (e) {
                e.preventDefault();

                generate_social.disabled = true;
                generate_social.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/pest-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'social',
                }).then(function (response) {
                    tinymce.get("social").setContent(response.data.message);

                    generate_social.disabled = false;
                    generate_social.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_technological = document.getElementById('generate_technological');
            let technological = document.getElementById('technological');

            generate_technological.addEventListener('click',function (e) {
                e.preventDefault();

                generate_technological.disabled = true;
                generate_technological.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/pest-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'technological',
                }).then(function (response) {
                    tinymce.get("technological").setContent(response.data.message);

                    generate_technological.disabled = false;
                    generate_technological.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });
            @endif
        })();
    </script>
@endsection
