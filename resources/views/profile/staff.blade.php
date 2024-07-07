@extends('layouts.primary')
@section('content')
    <div class="card bg-purple-light mb-3 mt-4">
        <div class="card-header bg-purple-light pb-0 p-3">
            <div class="row">
                <div class="col-md-8">
                    <h6>{{__('Users')}} ({{$users_count_on_this_workspace}})</h6>

                    @if($maximum_allowed_users)
                        <p>{{__('Current plan maximum allowed users:')}} {{$maximum_allowed_users}}</p>
                    @endif
                </div>
                <div class="col-md-4 text-right">

                    @if($users_count_on_this_workspace < $maximum_allowed_users || $trial_will_expire <= now())
                        <a class="btn bg-gradient-dark mb-0" href="/new-user"><i class="fas fa-plus"></i>&nbsp;&nbsp;
                            {{__(' Add New User')}}
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card card-body mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="cloudonex_table">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Name')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Email')}}</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Phone')}}</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                            <tbody>
                            @foreach($staffs as $staff)

                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                @if(empty($staff['photo']))
                                                    <div
                                                        class="avatar avatar-md bg-success-light  border-radius-md p-2 ">
                                                        <h6 class="text-success ">{{$staff->first_name['0']}}{{$staff->last_name['0']}}</h6>
                                                    </div>
                                                @else

                                                    <img src="{{PUBLIC_DIR}}/uploads/{{$staff->photo}}"
                                                         alt="" class="avatar avatar-md shadow-sm">
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <h6 class="mb-0 text-sm">{{$staff->first_name}} {{$staff->last_name}}</h6>
                                                <p class="text-xs text-secondary mb-0">{{$staff->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{$staff->email}}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span
                                            class="text-secondary text-xs font-weight-bold">{{$staff->mobile_number}}</span>
                                    </td>
                                    <td class="align-middle text-right">
                                        <div class="ms-auto">

                                            @if($staff->super_admin == 0)
                                                @if(auth()->user()->id == $workspace->owner_id || auth()->user()->id == $staff->id)
                                                    <a class="btn btn-link delete-user text-danger text-gradient px-3 mb-0"
                                                       href="/delete/staff/{{$staff->id}}"><i
                                                            class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
                                                @endif
                                            @endif

                                                @if($staff->super_admin== 0)
                                                    <a class="btn btn-link text-dark px-3 mb-0"
                                                       href="/user-edit/{{$staff->id}}"><i
                                                            class="fas fa-pencil-alt text-dark me-2"
                                                            aria-hidden="true"></i>{{__('Edit')}}</a>
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

@endsection
@section('script')
    <script>
        "use strict";
        $(document).ready(function () {
            $('#cloudonex_table').DataTable(
            );

            $('#cloudonex_table').on('click', '.delete-user', function (e) {
               
               e.preventDefault();
               runSwal($(this).attr("href"));
   
           });

        });

    function runSwal($link_to_delete)
        {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                window.location = $link_to_delete;
            }
        });

        } 
    </script>
@endsection