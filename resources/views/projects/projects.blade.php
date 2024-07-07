@extends('layouts.primary')
@section('content')

    <div class=" row">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Product Ideas')}}
            </h5>
        </div>
        <div class="col text-end">
            <a href="/create-project" type="button" class="btn btn-info text-white">{{__('Plan Product ')}}</a>
        </div>
    </div>
    <div class="card ">
        <div class=" card-body table-responsive">
            <table class="table align-items-center mb-0" id="cloudonex_table">
                <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Product Name')}}</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Members')}}</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Due Date')}}</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Status')}}</th>

                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Action')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                        <td>
                            <a href="/view-project?id={{$project->id}}">
                                <div class="d-flex px-2">
                                    @php
                                        $initial = $project->title['0'];
                                        $bgColors = ['primary', 'secondary', 'success', 'warning', 'info', 'dark'];
                                        $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                        $bgColor = $bgColors[$bgIndex]
                                    @endphp

                                    <div class="avatar avatar-sm me-3 bg-{{$bgColor}}  border-radius-md p-2">
                                        <h5 class="mt-2 text-white text-uppercase">{{$initial}}</h5>
                                    </div>

                                    <div class="my-auto">

                                        <h6 class="text-sm mb-0 ms-1">{{$project->title}}</h6>
                                    </div>
                                </div>
                            </a>

                        </td>
                        <td class="">

                            <div class="avatar-group d-flex mt-2">
                                @if($project->members)
                                    @foreach(json_decode($project->members) as $member)
                                        @if(isset($users[$member]))

                                            @if(!empty($users[$member]->photo))
                                                <a href="javascript:" class="avatar avatar-sm rounded-circle"
                                                   data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                   title="{{$users[$member]->first_name}}">
                                                    <img src="{{PUBLIC_DIR}}/uploads/{{$users[$member]->photo}}"
                                                         alt="team1">
                                                </a>

                                            @else
                                                @php
                                                    $initial = $users[$member]->first_name[0];
                                                    $bgColors = ['light', 'purple-light','pink-light','success-light', ];
                                                    $bgIndex = array_search($initial, range('A', 'Z')) % count($bgColors);
                                                    $bgColor = $bgColors[$bgIndex]
                                                @endphp
                                                <div class="avatar avatar-sm  rounded-circle bg-{{$bgColor}}">
                                                    <p class="mt-3 text-dark fw-bold text-uppercase"><span>{{$initial}}</span>
                                                    </p>
                                                </div>

                                            @endif

                                        @endif
                                    @endforeach


                                @endif


                            </div>
                        </td>

                        <td>
                            <p class="text-xs font-weight-bold mb-0">

                                @if(!empty($project->end_date))
                                    {{(\App\Supports\DateSupport::parse($project->end_date))->format(config('app.date_format'))}}

                                @endif
                            </p>
                        </td>

                        <td>
                            <span class="badge badge-dot me-4">
                            <i class="bg-info"></i>
                                @if($project->status == 'Started')
                                    <span class="badge bg-primary font-weight-bold"> {{$project->status}}</span>

                                @elseif($project->status == 'Pending')
                                    <span class="badge bg-warning">{{$project->status}}</span>
                                @elseif($project->status == 'Finished')
                                    <span class="badge bg-success">{{$project->status}}</span>
                                @endif

                            </span>
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
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li>
                                            <a class="dropdown-item border-radius-md text-danger"
                                               href="/delete/project/{{$project->id}}">{{__('Delete')}}
                                            </a>
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

@endsection


@section('script')

    <script>
        "use strict";
        $(document).ready(function () {
            $('#cloudonex_table').DataTable(
            );

        });
    </script>

@endsection
