@extends('layouts.primary')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="font-weight-bolder"> {{__(' McKinsey\'s 7-S Model')}}</h4>
                    <p>{{__('The McKinsey 7-S Model is a change framework based on a company’s organizational design. It aims to depict how change leaders can effectively manage organizational change by strategizing around the interactions of seven key elements: structure, strategy, system, shared values, skill, style, and staff.
')}}</p>
                    <hr>
                    <form method="post" action="/save-mckinsey-model">
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
                                            {{__('Structure')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Structure is the way in which a company is organized – chain of command and accountability relationships that form its organizational chart.')}}

                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="structure"
                                                  name="structure">@if (!empty($model)){{$model->structure}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_structure">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Strategy')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Strategy refers to a well-curated business plan that allows the company to formulate a plan of action to achieve a sustainable competitive advantage, reinforced by the company’s mission and values.')}}

                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="strategy"
                                              name="strategy">@if (!empty($model)){{$model->strategy}}@endif</textarea>
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
                                            {{__('System')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Systems entail the business and technical infrastructure of the company that establishes workflows and the chain of decision-making.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="system"
                                                  name="system">@if(!empty($model)){{$model->system}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_system">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Style')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('The attitude of senior employees in a company establishes a code of conduct through their ways of interactions and symbolic decision-making, which forms the management style of its leaders.')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="style"
                                              name="style">@if(!empty($model)){{$model->style}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_style">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">

                            <div class="col align-self-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">
                                        {{__('Staff')}}
                                    </label>
                                    <p class="form-text text-muted text-xs ms-1">
                                        {{__('Staff involves talent management and all human resources related to company decisions, such as training, recruiting, and rewards systems')}}
                                    </p>
                                    <textarea class="form-control mt-4" rows="10" id="staff"
                                              name="staff">@if(!empty($model)){{$model->staff}}@endif</textarea>
                                    @if(!empty($super_settings['openai_api_key']))
                                        <button class="btn btn-info mt-4" type="submit" id="generate_staff">{{__('Generate with AI')}}</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col align-self-end">
                                <div class="col align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Skill')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('Skills form the capabilities and competencies of a company that enables its employees to achieve its objectives.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="skill"
                                                  name="skill">@if(!empty($model)){{$model->skill}}@endif</textarea>
                                        @if(!empty($super_settings['openai_api_key']))
                                            <button class="btn btn-info mt-4" type="submit" id="generate_skill">{{__('Generate with AI')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row mt-4">

                                <div class="col-md-12 align-self-center">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">
                                            {{__('Shared Values')}}
                                        </label>
                                        <p class="form-text text-muted text-xs ms-1">
                                            {{__('The mission, objectives, and values form the foundation of every organization and play an important role in aligning all key elements to maintain an effective organizational design.')}}
                                        </p>
                                        <textarea class="form-control mt-4" rows="10" id="shared"
                                                  name="shared_values">@if(!empty($model)){{$model->shared_values}}@endif</textarea>
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

                axios.post('/mckinsey-ai',{
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

                axios.post('/mckinsey-ai',{
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

                axios.post('/mckinsey-ai',{
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

            let generate_skill = document.getElementById('generate_skill');
            let skill = document.getElementById('skill');

            generate_skill.addEventListener('click',function (e) {
                e.preventDefault();

                generate_skill.disabled = true;
                generate_skill.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/mckinsey-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'skill',
                }).then(function (response) {
                    tinymce.get("skill").setContent(response.data.message);

                    generate_skill.disabled = false;
                    generate_skill.innerHTML = '{{__('Generate')}}';

                }).catch(function (error) {
                    console.log(error);
                });
            });

            let generate_staff = document.getElementById('generate_staff');
            let staff = document.getElementById('staff');

            generate_staff.addEventListener('click',function (e) {
                e.preventDefault();

                generate_staff.disabled = true;
                generate_staff.innerHTML = '<i class="fa fa-spinner fa-spin"></i> {{__('Generating')}}';

                axios.post('/mckinsey-ai',{
                    _token:'{{csrf_token()}}',
                    company_name:'{{$model->company_name ?? ''}}',
                    action: 'staff',
                }).then(function (response) {
                    tinymce.get("staff").setContent(response.data.message);

                    generate_staff.disabled = false;
                    generate_staff.innerHTML = '{{__('Generate')}}';

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

                axios.post('/mckinsey-ai',{
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

                axios.post('/mckinsey-ai',{
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