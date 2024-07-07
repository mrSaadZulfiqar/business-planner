@extends('layouts.primary')

@section('content')

    <form method="post" action="/save-startup-canvas">

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4 class="font-weight-bolder">{{__('Startup Model Canvas')}}</h4>
                </div>
                <div class="col text-end ">
                    <button class="btn btn-info  text-end" type="submit">{{__('Save')}}</button>
                </div>

            </div>

            <p><strong>{{__('One Page Business Plan')}}</strong></p>
            <p>{{__('The Lean Startup Canvas is a version of the Business Model Canvas and it is specially designed for StartUps and Entrepreneurs. The Lean Canvas focuses on addressing broad customer problems, solutions, key metrics, competitive advantages and delivering them to customer segments through a unique value proposition.
')}}</p>
            <hr>

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
                                            @if (!empty($investor))
                                            @if ($investor->product_id === $product->id)
                                            selected
                                        @endif
                                        @endif
                                    >{{$product->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>




            <div class="row">
                <div class="col-md-6">
                    <h6>{{__('Problems')}}</h6>
                    <textarea  class="bg-purple-light" name="problems" cols="10" rows="10" id="problems">@if(!empty($model)){!! $model->problems !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_problems">{{__('Generate with AI')}}</button>
                    @endif
                </div>

                <div class="col-md-6">
                    <h6>{{__('Solutions')}}</h6>
                    <textarea name="solutions" cols="10" rows="10"  id="solutions">@if(!empty($model)){!! $model->solutions !!}@endif
                    </textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_solutions">{{__('Generate with AI')}}</button>
                    @endif
                </div>


            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <h6>{{__('Unique Value Proposition')}}</h6>

                    <textarea name="value_propositions" cols="10" rows="10" id="value">@if(!empty($model)){!! $model->value_propositions !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_value">{{__('Generate with AI')}}</button>
                    @endif

                </div>
                <div class="col-md-6">
                    <h6>{{__('Unfair Advantage')}}</h6>
                    <textarea name="unfair_advantage" cols="10" rows="10" id="advantage">@if(!empty($model)){!! $model->unfair_advantage !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_advantage">{{__('Generate with AI')}}</button>
                    @endif
                </div>


        </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <h6>{{__('Customer Segments')}}</h6>

                    <textarea name="customer_segments" cols="10" rows="10" id="customer_segments">@if(!empty($model)){!! $model->customer_segments !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_customer_segments">{{__('Generate with AI')}}</button>
                    @endif
                </div>

            </div>

            <div class="row mt-3">

                <div class="col-md-6">
                    <h6>{{__('Key Metrics')}}</h6>

                    <textarea name="key_matrices" cols="10" rows="10" id="metrics">@if(!empty($model)){!! $model->key_matrices !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_metrics">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6>{{__('Channels')}}</h6>

                    <textarea name="channels" cols="10" rows="10" id="channels">@if(!empty($model)){!! $model->channels !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_channels">{{__('Generate with AI')}}</button>
                    @endif
                </div>
            </div>


            <div class="row mt-3">
                <div class="col-md-6">
                    <h6>{{__('Cost Structure')}}</h6>

                    <textarea name="cost_structure" cols="10" rows="10" id="cost_structure">@if(!empty($model)){!! $model->cost_structure !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_cost_structure">{{__('Generate with AI')}}</button>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6>{{__('Revenue Streams')}}</h6>

                    <textarea name="revenue_stream" cols="10" rows="10" id="revenue_stream">@if(!empty($model)){!! $model->revenue_stream !!}@endif</textarea>
                    @if(!empty($super_settings['openai_api_key']))
                        <button class="btn btn-info mt-4" type="submit" id="generate_revenue_stream">{{__('Generate with AI')}}</button>
                    @endif

                </div>
            </div>

            <!-- /Canvas -->
        </div>

        @if($model)
            <input type="hidden" name="id" value="{{$model->id}}">
            <input type="hidden" name="admin_id" value="{{$model->admin_id}}">
        @endif
        @csrf


    </div>
        <button class="btn btn-info mt-4" type="submit">{{__('Save')}}</button>
    </form>
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
                selector: '#problems',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',

                lists_indent_on_tab: false,

                branding: false,
                menubar: false,

            });
            tinymce.init({
                selector: '#solutions',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#value',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#advantage',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#metrics',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#cost_structure',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#customer_segments',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#channels',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#value_propositions',

                plugins: 'lists,table',
                toolbar: 'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });
            tinymce.init({
                selector: '#revenue_stream',

                plugins: 'lists,table',
                toolbar:'styleselect | forecolor | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code | undo redo|numlist bullist',
                lists_indent_on_tab: false,
                branding: false,
                menubar: false,
            });

            @if(!empty($super_settings['openai_api_key']))

            let generate_problems = document.getElementById('generate_problems');
            let problems = document.getElementById('problems');

            generate_problems.addEventListener('click',function (e) {
                e.preventDefault();

                generate_problems.disabled = true;
                generate_problems.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'problems',
                }).then(function (response) {
                    tinymce.get("problems").setContent(response.data.message);

                    generate_problems.disabled = false;
                    generate_problems.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_solutions = document.getElementById('generate_solutions');
            let solutions = document.getElementById('solutions');

            generate_solutions.addEventListener('click',function (e) {
                e.preventDefault();

                generate_solutions.disabled = true;
                generate_solutions.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'solutions',
                }).then(function (response) {
                    tinymce.get("solutions").setContent(response.data.message);

                    generate_solutions.disabled = false;
                    generate_solutions.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_value = document.getElementById('generate_value');
            let value = document.getElementById('value');

            generate_value.addEventListener('click',function (e) {
                e.preventDefault();

                generate_value.disabled = true;
                generate_value.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'value',
                }).then(function (response) {
                    tinymce.get("value").setContent(response.data.message);

                    generate_value.disabled = false;
                    generate_value.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_advantage = document.getElementById('generate_advantage');
            let advantage = document.getElementById('advantage');

            generate_advantage.addEventListener('click',function (e) {
                e.preventDefault();

                generate_advantage.disabled = true;
                generate_advantage.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'advantage',
                }).then(function (response) {
                    tinymce.get("advantage").setContent(response.data.message);

                    generate_advantage.disabled = false;
                    generate_advantage.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_metrics = document.getElementById('generate_metrics');
            let metrics = document.getElementById('metrics');

            generate_metrics.addEventListener('click',function (e) {
                e.preventDefault();

                generate_metrics.disabled = true;
                generate_metrics.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'metrics',
                }).then(function (response) {
                    tinymce.get("metrics").setContent(response.data.message);

                    generate_metrics.disabled = false;
                    generate_metrics.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_cost_structure = document.getElementById('generate_cost_structure');
            let cost_structure = document.getElementById('cost_structure');

            generate_cost_structure.addEventListener('click',function (e) {
                e.preventDefault();

                generate_cost_structure.disabled = true;
                generate_cost_structure.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'cost_structure',
                }).then(function (response) {
                    tinymce.get("cost_structure").setContent(response.data.message);

                    generate_cost_structure.disabled = false;
                    generate_cost_structure.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_customer_segments = document.getElementById('generate_customer_segments');
            let customer_segments = document.getElementById('customer_segments');

            generate_customer_segments.addEventListener('click',function (e) {
                e.preventDefault();

                generate_customer_segments.disabled = true;
                generate_customer_segments.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'customer_segments',
                }).then(function (response) {
                    tinymce.get("customer_segments").setContent(response.data.message);

                    generate_customer_segments.disabled = false;
                    generate_customer_segments.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_channels = document.getElementById('generate_channels');
            let channels = document.getElementById('channels');

            generate_channels.addEventListener('click',function (e) {
                e.preventDefault();

                generate_channels.disabled = true;
                generate_channels.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'channels',
                }).then(function (response) {
                    tinymce.get("channels").setContent(response.data.message);

                    generate_channels.disabled = false;
                    generate_channels.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });


            let generate_revenue_stream = document.getElementById('generate_revenue_stream');
            let revenue_stream = document.getElementById('revenue_stream');

            generate_revenue_stream.addEventListener('click',function (e) {
                e.preventDefault();

                generate_revenue_stream.disabled = true;
                generate_revenue_stream.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/startup-canvas-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'revenue_stream',
                }).then(function (response) {
                    tinymce.get("revenue_stream").setContent(response.data.message);

                    generate_revenue_stream.disabled = false;
                    generate_revenue_stream.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });
            @endif
        })();
    </script>

@endsection
