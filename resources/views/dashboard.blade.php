@extends('layouts.primary')
@section('content')
    <div class="row mb-3">

        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Dashboard')}}
            </h5>
        </div>

        @if($trial_will_expire >= now())
            <!--<div class="col text-end">-->
            <!--    <span class="badge bg-pink-light text-danger">{{__('Trial Expiring in')}} {{$trial_will_expire->diffForHumans()}}</span>-->

            <!--</div>-->
            <div class="col text-end">
                <span class="badge bg-pink-light text-danger">You have {{$trial_will_expire->diffInDays()}} days before your trial ends</span>

            </div>
        @endif

    </div>
    @if(!empty($recent_notice->title))
        @if($recent_notice->status !='Draft')
            <div class="row ">
                <div class="col-md-12 mb-3">
                    <div class="card bg-pink-light border-secondary">
                        <div class="card-body">
                            <h6>{{__('Notice')}}: {{$recent_notice->title}}  </h6>
                            {!! $recent_notice->notes !!}
                        </div>
                    </div>
                </div>

            </div>
        @endif

    @endif


    <div class="row">



        <div class="col-md-6">
            <div class="card bg-purple-light">
                <div class="card-body">
                    <div class="">
                        <div class="">
                            <h4 class="fw-bolder">{{__('Hello,')}}</h4>   <h5
                                class="text-dark fw-bolder d-sm-inline d-none ">@if (!empty($user)) {{$user->first_name}} {{$user->last_name}}@endif</h5>
                            <p class="text-purple fw-bold mt-3">{{__('Welcome Back to Your Dashboard')}}!</p>

                        </div>


                    </div>
                    <a href="/admin/tasks/list" type="button"
                       class="btn btn-dark fw-bolder mt-2">{{__('Add Task')}}</a>
                    <a href="/create-project" type="button"
                       class="btn btn-info fw-bolder mt-2">{{__('Plan for your Product')}}</a>

                </div>

            </div>
        </div>

        <div class="col-md-6">
            <div class=" ">
                <div class="">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('Product Plans')}}</p>

                                                <h5 class="font-weight-bolder mt-4 ">
                                                    <a href="/projects">
                                                        {{$total_projects}}

                                                    </a>

                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class=" icon icon-shape bg-purple-light  text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class=" text-purple feather feather-hard-drive mt-2">
                                                    <line x1="22" y1="12" x2="2" y2="12"></line>
                                                    <path
                                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                                                    <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                                    <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                                </svg>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="card bg-info">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm text-white mb-0 text-capitalize font-weight-bold">{{__('Total Notes')}}</p>
                                                <h5 class=" mt-4  ">
                                                    <a href="/notes" class="text-white">
                                                        {{$total_notes}}

                                                    </a>

                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-purple-light ms-auto text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class=" text-purple feather feather-edit mt-2">
                                                    <path
                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path
                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-gradient-dark">
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="text-sm mb-0 text-white text-capitalize font-weight-bold">{{__('Business Models')}}</p>
                                                <h5 class="font-weight-bolder text-white mt-4">
                                                    {{$total_models}}

                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-purple-light ms-auto text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class=" text-purple feather feather-briefcase mt-2">
                                                    <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                                    <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 mb-xl-0 mb-4">
                            <div class="card">
                                <div class="card-body  p-3">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers ">
                                                <p class="text-sm mb-0 text-capitalize font-weight-bold">{{__('Total Users')}}</p>
                                                <h5 class="font-weight-bolder text-dark mt-4">
                                                    {{$total_users}}
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-end">
                                            <div class="icon icon-shape bg-purple-light ms-auto text-center">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-user text-purple mt-2">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">

        @if(!empty($recent_note))

            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column h-100">
                                    @if(!empty($recent_note->topic))
                                        <p class="pt-2 mb-2 text-purple fw-bolder">{{$recent_note->topic}}</p>
                                    @endif

                                    @if(!empty($recent_note->title))
                                        <h5 class="fw-bolder">{{$recent_note->title}}</h5>

                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @if(!empty($users[$recent_note->admin_id]->photo))
                                                        <a href="javascript:" class=" mt-2 avatar avatar-sm border border-secondary">
                                                            <img alt="" class="p-1" src="{{PUBLIC_DIR}}/uploads/{{$users[$recent_note->admin_id]->photo}}">
                                                        </a>
                                                    @else
                                                        @if(!empty($users[$recent_note->admin_id]))
                                                            <div class="avatar bg-info avatar-sm border-radius-md p-2 mt-2">
                                                                <h6 class="text-white mt-2">

                                                                    {{$users[$recent_note->admin_id]->first_name[0]}}

                                                                </h6>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <p class="mb-0 text-md fw-bolder text-dark">{{$users[$recent_note->admin_id]->first_name}} {{$users[$recent_note->admin_id]->last_name}}</p>
                                                    <small class="mb-3 text-xs">{{$recent_note->created_at->diffForHumans()}}</small>

                                                </div>
                                            </div>

                                    @endif

                                    @if(!empty($recent_note->id))
                                        <a class="text-body font-weight-bold mt-3 mb-2 icon-move-right mt-auto"
                                           href="/view-note?id={{$recent_note->id}}">

                                            @if(!empty($recent_note->notes))
                                              <p class=""> {!! substr($recent_note->notes,70) !!} </p>
                                                <p class="text-sm text-success">{{__(' Read More')}}
                                                    <i class="fas fa-arrow-right text-sm ms-1 mt-2"
                                                       aria-hidden="true"></i></p>


                                            @endif
                                        </a>
                                        @endif
                                </div>
                            </div>

                            <div class="col-md-6 ms-auto text-center mt-6 mt-lg-0">
                                <div class="">
                                    @if(!empty($recent_note->cover_photo))
                                        <img src="{{PUBLIC_DIR}}/uploads/{{$recent_note->cover_photo}}"
                                             class="img-fluid border-radius-lg" alt="">
                                    @endif
                                    <div class="position-relative d-flex align-items-center justify-content-center h-100"> <img class="w-100 position-relative z-index-2 pt-4" src="" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

        <div class="col-md-5">
            <div class="row">
                <div class="col-12">
                    <div class="card  mb-4">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">{{__('Recent Users')}}</h6>
                            </div>
                        </div>
                        <div class="card-body  p-3">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="cloudonex_table">
                                    <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Name')}}</th>

                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Edit')}}</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($recent_users as $staff)

                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        @if(empty($staff['photo']))

                                                                       @php
                                                                                                                $initial = $staff->first_name['0'];
                                                                                                                $bgColors = ['primary', 'secondary', 'success', 'warning', 'info', 'dark'];
                                                                                                                $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                                                                                                $bgColor = $bgColors[$bgIndex]
                                                                                                            @endphp
                                <div class="avatar avatar-sm bg-{{ $bgColor }}  border-radius-md">

                                    <h6 class="mt-1 text-white ">{{ $initial }}</h6>
                                                            </div>
                                                        @else

                                                            <img src="{{PUBLIC_DIR}}/uploads/{{$staff->photo}}" alt="" class="avatar avatar-md shadow-sm">
                                                        @endif
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <h6 class="mb-0 text-sm">{{$staff->first_name}} {{$staff->last_name}}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{$staff->email}}</p>
                                                    </div>
                                                </div>
                                            </td>

{{--                                            <td class="align-middle text-center">--}}
{{--                                        <span--}}
{{--                                            class="text-secondary text-xs font-weight-bold">{{$staff->mobile_number}}</span>--}}
{{--                                            </td>--}}
                                            <td class="align-middle text-right">
                                                <div class="ms-auto">



                                                    @if($staff->super_admin== 0)
                                                        <a class="btn btn-link text-dark px-3 mb-0"
                                                           href="/user-edit/{{$staff->id}}"><i
                                                                class="fas fa-pencil-alt text-dark me-2"
                                                                aria-hidden="true"></i></a>
                                                    @endif

                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{--        <div class="col-lg-5">--}}
{{--            @if(empty($modules) || in_array('to_dos',$modules))--}}
{{--                <div class="card ">--}}
{{--                    <div class="card-header pb-0 p-3">--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <h6 class="mb-0">{{__('Recent Tasks')}}</h6>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table class="table align-items-center mb-0">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">--}}
{{--                                    {{__('Task')}}--}}
{{--                                </th>--}}

{{--                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">--}}
{{--                                    {{__('Assigned to')}}--}}

{{--                                </th>--}}
{{--                                <th></th>--}}

{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}

{{--                            @foreach($todos as $todo)--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        <div class="d-flex px-2 py-1">--}}
{{--                                            <div class="">--}}
{{--                                                <p class="mb-0">{{$todo->subject}}</p>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}

{{--                                    <td>--}}
{{--                                        <div class="d-flex">--}}
{{--                                            <div class="avatar avatart-sm rounded-circle">--}}
{{--                                                @if(isset($users[$todo->contact_id]))--}}
{{--                                                    @if(!empty($users[$todo->contact_id]->photo))--}}
{{--                                                        <a href="javascript:" class="avatar avatar-sm rounded-circle"--}}
{{--                                                           data-bs-toggle="tooltip" data-bs-placement="bottom"  title="{{$users[$todo->contact_id]->first_name}}">--}}
{{--                                                            <img src="{{PUBLIC_DIR}}/uploads/{{$users[$todo->contact_id]->photo}}">--}}
{{--                                                        </a>--}}

{{--                                                    @else--}}
{{--                                                        <div class="avatar  avatar-sm rounded-circle bg-indigo"><p class=" mt-3 text-white text-uppercase">{{$users[$todo->contact_id]->first_name[0]}}{{$users[$todo->contact_id]->last_name[0]}}</p>--}}
{{--                                                        </div>--}}
{{--                                                   @endif--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                            <div class="text-sm fw-bold mt-2 ms-3 ">--}}
{{--                                                @if(isset($users[$todo->contact_id]))--}}
{{--            {{$users[$todo->contact_id]->first_name}} {{$users[$todo->contact_id]->last_name}}--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--           @endif--}}
{{--        </div>--}}
    </div>



    <div class="row">
        <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
            @if(empty($modules) || in_array('projects',$modules))
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">{{__('Recent Product Plans')}}</h6>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Product Name')}}</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Members')}}</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Due Date')}}</th>

                                <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">{{__('Status')}}</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recent_projects as $project)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            @php
                                                $initial = $project->title[0];
                                                $bgColors = ['primary', 'secondary', 'success', 'warning', 'info', 'dark'];
                                                $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                                $bgColor = $bgColors[$bgIndex]
                                            @endphp

                                            <div class="avatar avatar-sm me-3 bg-{{ $bgColor }}  border-radius-md p-2"><h6 class="mt-2 text-white text-uppercase">{{ $initial }}</h6>
                                            </div>
                                            <a href="/view-project?id={{$project->id}}"
                                               class="">
                                                <p class="mb-0 text-sm text-dark fw-bold">{{$project->title}}</p>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="avatar-group d-flex mt-2">
                                            @if($project->members)
                                                @foreach(json_decode($project->members) as $member)
                                                    @if(isset($users[$member]))
                                                        @if(!empty($users[$member]->photo))
                                                            <a href="javascript:" class="avatar avatar-sm rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                               title="{{$users[$member]->first_name}}">
                                                                <img src="{{PUBLIC_DIR}}/uploads/{{$users[$member]->photo}}" alt="team1">
                                                            </a>
                                                        @else
                                                            @php
                                                                $initial = $users[$member]->first_name[0];
                                                                $bgColors = ['light', 'purple-light','pink-light','success-light', ];
                                                                $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                                                $bgColor = $bgColors[$bgIndex]
                                                            @endphp
                                                            <div class="avatar avatar-sm rounded-circle bg-{{ $bgColor }}">
                                                                <p class="mt-3 text-dark fw-bold text-uppercase  ">{{$users[$member]->first_name[0]}}</p>
                                                            </div>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-xs">

                                        @if(!empty($project->end_date))
                                            <span class="badge bg-danger-light font-weight-bold">
                                            {{$project->end_date->format(config('app.date_format'))}}
                                            </span>
                                        @endif

                                    </td>
                                    <td class="align-middle text-center text-xs">
                                        @if($project->status == 'Started')
                                            <span class="badge bg-primary font-weight-bold"> {{$project->status}}</span>

                                        @elseif($project->status == 'Pending')
                                            <span class="badge bg-warning">{{$project->status}}</span>
                                        @elseif($project->status == 'Finished')
                                            <span class="badge bg-success">{{$project->status}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <div class="dropstart">
                                                <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                    aria-labelledby="dropdownMarketingCard">
                                                    <li><a class="dropdown-item border-radius-md"
                                                           href="/create-project?id={{$project->id}}">{{__('Edit')}}</a></li>

                                                    <li><a class="dropdown-item border-radius-md"
                                                           href="/view-project?id={{$project->id}}">{{__('See Details')}}</a>
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="">
        <div class=" mt-4">
            @if(empty($modules) || in_array('to_dos',$modules))
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0">{{__('Recent Tasks')}}</h6>
                        </div>
                    </div>

                    <div class="card-body  table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    {{__('Task')}}
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Due Date')}}</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ">
                                    {{__('Assigned to')}}

                                </th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($todos as $todo)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="">
                                                <p class="mb-0 text-sm text-dark fw-bold ">{{$todo->subject}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">

                                            @if(!empty($todo->due_date))
                                                <span class="badge bg-danger-light font-weight-bold">
                                         {{(\App\Supports\DateSupport::parse($todo->due_date))->format(config('app.date_format'))}}s
                                            </span>

                                            @endif
                                        </p>
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <div class="avatar avatart-sm rounded-circle">
                                                @if(isset($users[$todo->contact_id]))
                                                    @if(!empty($users[$todo->contact_id]->photo))
                                                        <a href="javascript:" class="avatar avatar-sm rounded-circle"
                                                           data-bs-toggle="tooltip" data-bs-placement="bottom"  title="{{$users[$todo->contact_id]->first_name}}">
                                                            <img src="{{PUBLIC_DIR}}/uploads/{{$users[$todo->contact_id]->photo}}">
                                                        </a>

                                                    @else
                                                        <div class="avatar  avatar-sm rounded-circle bg-primary"><p class=" mt-3 text-white text-uppercase">{{$users[$todo->contact_id]->first_name[0]}}</p>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="text-sm fw-bold mt-2 ms-3 ">
                                                @if(isset($users[$todo->contact_id]))
                                                    {{$users[$todo->contact_id]->first_name}} {{$users[$todo->contact_id]->last_name}}
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if(empty($modules) || in_array('investors',$modules))
        <div class="row my-4">
            <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
                @if(empty($modules) || in_array('projects',$modules))
                    <div class="card ">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0">{{__('Recent Investors')}}</h6>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Name')}}</th>

                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Email')}}</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Product Name')}}</th>


                                    <th class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">{{__('Status')}}</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($recent_investors as $investor)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    @php
                                                        $initial = $investor->first_name['0'];
                                                        $bgColors = ['primary', 'secondary', 'success', 'warning', 'info', 'dark'];
                                                        $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                                        $bgColor = $bgColors[$bgIndex]
                                                    @endphp
                                                    <div
                                                        class="avatar avatar-sm bg-{{$bgColor}}  border-radius-md p-2 ">
                                                        <h6 class="mt-1 text-white">{{$initial}}</h6>
                                                    </div>
                                                </div>
                                                <a href="/view-investor?id={{$investor->id}}"
                                                   class="d-flex flex-column justify-content-center">
                                                    <div class="">
                                                        <p class="mb-0 ms-3 text-sm text-dark fw-bold">{{$investor->first_name}}{{$investor->last_name}}</p>
                                                    </div>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm fw-bold text-dark mb-0">{{$investor->email}}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                    <p class="text-sm text-dark fw-bold">
                                        @if(!empty($products[$investor->product_id]))
                                            @if(isset($products[$investor->product_id]))
                                                {{$products[$investor->product_id]->title}}
                                            @endif
                                        @endif
                                    </p>
                                        </td>
                                        <td class="align-middle text-center text-xs">
                                            @if($investor->status == 'Approved')
                                                <span class="badge bg-info font-weight-bold"> {{$investor->status}}</span>
                                            @else($investor->status == 'Pending')
                                                <span class="badge bg-warning">{{$investor->status}}</span>
                                            @endif

                                        </td>
                                        <td>
                                            <div>
                                                <div class="dropstart">
                                                    <a href="javascript:" class="text-secondary" id="dropdownMarketingCard"
                                                       data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                        aria-labelledby="dropdownMarketingCard">
                                                        <li><a class="dropdown-item border-radius-md"
                                                               href="/add-investor?id={{$investor->id}}">{{__('Edit')}}</a></li>

                                                        <li><a class="dropdown-item border-radius-md"
                                                               href="/view-investor?id={{$investor->id}}">{{__('See Details')}}</a>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif




@endsection






