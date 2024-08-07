@extends('layouts.super-admin-portal')
@section('content')

    <div class=" row mb-2">
        <div class="col">
            <h5 class=" text-secondary fw-bolder">
                {{__('Workspaces')}}
            </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            
            
            <div class="card card-body mb-4">
                <div class="form-group row">
                    <label for="filterSelect" class="col-lg-2 col-form-label text-secondary">Filters:</label>
                    <div class="col-lg-2">
                      <select id="filterSelect" class="form-control-plaintext form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option value="">All</option>
                        <option value="subscribed">Paid Subscribers</option>
                        <option value="not subscribed">Non Subscribers</option>
                        <option value="free trial">Free Trials</option>
                    </select>
                    </div>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="cloudonex_table">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Workspace Name')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Created_at')}}</th>
                                <th class=" text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">{{__('Plan')}}</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Status')}}</th>  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">{{__('Account Status')}}</th>

                                <th class=" text-uppercase text-secondary text-xxs opacity-7">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workspaces as $workspace)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{$workspace->name}} </h6>
                                                <p class="text-xs text-secondary mb-0"></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">
                                            {{(\App\Supports\DateSupport::parse($workspace->created_at))->format(config('app.date_time_format'))}}
                                        </p>

                                    </td>
                                    <td class="text-xs text-purple text-uppercase font-weight-bold mb-0">    @if($workspace->id !== $user->workspace_id)
                                            @if(isset($plans[$workspace->plan_id]))
                                                {{$plans[$workspace->plan_id]->name}}
                                            @endif
                                        @else
                                            <p class="text-xs font-weight-bold mb-0">{{__('super admin')}}</p>
                                        @endif

                                    </td>
                                    <td class="align-middle text-sm">
                                        @php
                                            $trial_will_expire = null;
                                            if(!empty($free_trial_days) && $workspace->trial == 1){
                                                $trial_will_expire = strtotime($workspace->created_at) + ($free_trial_days*24*60*60);
                                                $trial_will_expire = \Carbon\Carbon::createFromTimestamp($trial_will_expire);
                                            }
                                        @endphp
                                        @if($workspace->id !== $user->workspace_id)
                                            @if($workspace->subscribed)
                                                <span class="badge badge-sm bg-success-light text-success">{{__('Subscribed')}}</span>
                                            @elseif($trial_will_expire >= \Carbon\Carbon::now())
                                                <span class="badge badge-sm bg-info-light text-info">{{__('Free Trial')}}</span>
                                            @else
                                                <span class="badge badge-sm bg-pink-light text-danger">{{__('Not Subscribed')}}</span>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="align-middle text-sm">
                                        @if($workspace->id !== $user->workspace_id)
                                            @if($workspace->active)
                                                <span class="badge badge-sm bg-gradient-success">{{__('Active')}}</span>
                                            @else
                                                <span class="badge badge-sm bg-warning">{{__('Suspended')}}</span>


                                            @endif
                                        @endif


                                    </td>
                                    <td class="align-middle">
                                        @if($workspace->id !== $user->workspace_id)
                                            <a class="btn btn-link text-dark px-3 mb-0"
                                               href="/view-workspace?id={{$workspace->id}}"><i
                                                    class="text-dark fas fa-eye me-2"></i>{{__('View')}}
                                            </a>
                                        @endif
                                        @if($workspace->id !== $user->workspace_id)
                                            <a class="btn btn-link text-dark px-3 mb-0"
                                               href="/edit-workspace?id={{$workspace->id}}"><i
                                                    class=" text-dark fas fa-pencil-alt me-2"></i>{{__('Edit')}}</a>


                                        @endif

                                        @if($workspace->id !== $user->workspace_id)

                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                               href="/delete-workspace/{{$workspace->id}}"><i
                                                    class="far fa-trash-alt me-2"></i>{{__('Delete')}}</a>
                                        @endif
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
           var table = $('#cloudonex_table').DataTable({
            // Add Select extension options
            select: {
                    style: 'multi'
                    }
                }
            );

      
            $('#filterSelect').change(function() {
                var filterValue = $(this).val();
                if (filterValue === '') {
                    // Clear the filter
                    table.column(3).search('').draw();
                } else {
                    // Apply filter
                    table.columns(3).search('^' + filterValue + '$', true, false).draw();
                }
            });
        });

    </script>
@endsection
