@extends('layouts.primary')
@section('content')
    <div class="card bg-purple-light mb-3 mt-4">
        <div class="card-header bg-purple-light pb-0 p-3">
            <div class="row">
                <div class="col-md-8 ">
                    <h6>{{ __('Sensitivity Analysis Reports') }} </h6>
                </div>
                <div class="col-md-4 text-right">
                    <a class="btn bg-gradient-dark" href="/add-sensitivity-analysis"><i class="fas fa-plus"></i>&nbsp;&nbsp;
                        {{ __(' New Report ') }}
                    </a>
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
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        {{ __('Name') }}</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                        {{ __('Creation Date') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        {{ __('Format') }}</th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                        {{ __('Status') }}</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $reports = [];
                                ?>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <h6 class="mb-0">{{ $report->name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $report->created_at }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span
                                                class="text-secondary font-weight-bold text-sm">{{ $report->format }}</span>
                                        </td>
                                        <td class="align-middle text-center text-xs">
                                            @if ($report->status == 'Approved')
                                                <span class="badge bg-info font-weight-bold"> {{ $report->status }}</span>
                                            @else
                                                <span class="badge bg-warning">{{ $report->status }}</span>
                                            @endif
                                        </td>
                                        <td class="align-middle text-right">
                                            <div class="ms-auto">
                                                <a class="btn btn-link text-success text-gradient px-3 mb-0"
                                                    href="/view-report?id={{ $report->id }}">
                                                    <i class="far fa-file-alt me-2"></i>{{ __('View') }}
                                                </a>
                                                <a class="btn btn-link text-dark px-3 mb-0"
                                                    href="/edit-report?id={{ $report->id }}">
                                                    <i class="fas fa-pencil-alt text-dark me-2"
                                                        aria-hidden="true"></i>{{ __('Edit') }}
                                                </a>
                                                <a class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                    href="/delete-report/{{ $report->id }}">
                                                    <i class="far fa-trash-alt me-2"></i>{{ __('Delete') }}
                                                </a>
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
        $(document).ready(function() {
            $('#cloudonex_table').DataTable();
        });
    </script>
@endsection
