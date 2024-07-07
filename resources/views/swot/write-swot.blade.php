@extends('layouts.primary')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder">{{__('SWOT Analysis')}}</h4>
                    <hr>
                    <form method="post" action="/save-swot">
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
                        <div class="row mt-4">
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Strengths')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the strengths?')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="strengths"
                                                  name="strengths">@if (!empty($model)){{$model->strengths}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_strengths">{{__('Generate with AI')}}</button>
                                        @endif
                                        <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Weaknesses')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the weaknesses?')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="weaknesses"
                                              name="weaknesses">@if (!empty($model)){{$model->weaknesses}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_weaknesses">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">
                                <div class="col align-self-end">
                                    <div class="col align-self-center">
                                        <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Opportunities')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('What are the opportunities?')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="opportunities"
                                                  name="opportunities">@if(!empty($model)){{$model->opportunities}}@endif</textarea>
                                            @if(!empty($super_settings['openai_api_key']))
                                                <button class="btn btn-info mt-4" type="submit" id="generate_opportunities">{{__('Generate with AI')}}</button>
                                            @endif
                                            <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Threats')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('What are the Threats?')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="threats"
                                              name="threats">@if(!empty($model)){{$model->threats}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_threats">{{__('Generate with AI')}}</button>
                                    @endif
                                    <button class="btn bg-success-light text-success shadow-none mt-4" type="submit">{{__('Save')}}</button>
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
                selector: '#strengths',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#weaknesses',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#threats',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#opportunities',
                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });

            @if(!empty($super_settings['openai_api_key']))

            let generate_strengths = document.getElementById('generate_strengths');
            let strengths = document.getElementById('strengths');

            generate_strengths.addEventListener('click',function (e) {
                e.preventDefault();

                generate_strengths.disabled = true;
                generate_strengths.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/swot-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'strengths',
                }).then(function (response) {
                    tinymce.get("strengths").setContent(response.data.message);

                    generate_strengths.disabled = false;
                    generate_strengths.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });


            let generate_weaknesses = document.getElementById('generate_weaknesses');
            let weaknesses = document.getElementById('weaknesses');

            generate_weaknesses.addEventListener('click',function (e) {
                e.preventDefault();

                generate_weaknesses.disabled = true;
                generate_weaknesses.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/swot-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'weaknesses',
                }).then(function (response) {
                    tinymce.get("weaknesses").setContent(response.data.message);

                    generate_weaknesses.disabled = false;
                    generate_weaknesses.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });


            let generate_opportunities = document.getElementById('generate_opportunities');
            let opportunities = document.getElementById('value_propositions');

            generate_opportunities.addEventListener('click',function (e) {
                e.preventDefault();

                generate_opportunities.disabled = true;
                generate_opportunities.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/swot-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'opportunities',
                }).then(function (response) {
                    tinymce.get("opportunities").setContent(response.data.message);

                    generate_opportunities.disabled = false;
                    generate_opportunities.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_threats = document.getElementById('generate_threats');
            let threats = document.getElementById('threats');

            generate_threats.addEventListener('click',function (e) {
                e.preventDefault();

                generate_threats.disabled = true;
                generate_threats.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/swot-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'threats',
                }).then(function (response) {
                    tinymce.get("threats").setContent(response.data.message);

                    generate_threats.disabled = false;
                    generate_threats.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });



            @endif




        })();
    </script>
@endsection
