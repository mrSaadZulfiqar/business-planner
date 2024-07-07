@extends('layouts.primary')
@section('content')
    <div class="row d-print-none">


        <div class="col text-center">
            <h5 class="mb-2 text-secondary fw-bolder">
                {{__('One Page Marketing plan of')}}
                @if (!empty($model))
                    {{$model->company_name}}
                @endif

            </h5>
        </div>

    </div>
    <div class="row mt-3">
        <div class="col-lg-1 col-md-1 pt-5 pt-lg-0 ms-lg-2 text-center d-print-none">


            <a href="/write-marketing-plan?id={{$model->id}}" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="right" title="Edit">
                <i class="fas fa-pen p-2"></i>
            </a>
            <a href="#" onclick="window.print()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="Print">
                <i class="fas fa-print p-2"></i>
            </a>
            <a href="#" onclick="generatePDF()" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="PDF">
                <i class="fa fa-file-pdf-o p-2"></i>
            </a>
            <a href="/marketing-plans" class="btn btn-white border-radius-lg p-2 mt-2" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="List">
                <i class="fas fa-ellipsis-h p-2"></i>
            </a>
        </div>
        <div class="col-sm-10">
            <div class="card" id="marketingPDF">
                <div class="card-body">
                    <div class="card mb-3 shadow-none">
                        <div class="card-body bg-yellow-light">
                            <h6 class="text-dark fw-bolder"> {{__('Business Summary')}}</h6>
                            <p class="text-sm">
                                @if (!empty($model))
                                    {!! $model->summary !!}
                                @endif
                            </p>


                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card mb-3 shadow-none">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Company Description')}}</h6>

                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->description !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-3 shadow-none">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Team')}}</h6>

                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->team !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ">
                            <div class="card mb-3 shadow-none ">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Business Initiatives')}}</h6>
                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->business_initiatives !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-3 shadow-none">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Target Market')}}</h6>
                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->target_market !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="card mb-3 shadow-none">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Budget')}}</h6>
                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->budget !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-3 shadow-none">
                                <div class="card-body bg-yellow-light">
                                    <h6 class="text-dark fw-bolder">{{__('Marketing Channels')}}</h6>
                                    <p class="text-sm">
                                        @if (!empty($model))
                                            {!! $model->marketing_channels !!}
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

@endsection
@section('script')
<script>
    function generatePDF() {
        const { jsPDF } = window.jspdf;
        
        // Create a new jsPDF instance with custom size
        const doc = new jsPDF();

        // Get the HTML content
        const element = document.getElementById('marketingPDF'); // Replace 'content' with the ID of your HTML element
      
        // Convert HTML to PDF using html2pdf
        html2pdf(element, {
            margin: 10,
            filename: 'Marketing Plan of {{$model->company_name}}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },

        });
    }
</script>
@endsection