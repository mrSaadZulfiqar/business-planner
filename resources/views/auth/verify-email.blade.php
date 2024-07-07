<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>
</head>
<body class="bg-pink-light">

<main class="main-content main-content-bg mt-0">
    <section class="min-vh-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mt-sm-12 mt-9 mb-4">
                        <div class="card-header text-center pt-4 pb-1">
                            <h4 class="font-weight-bolder mb-1">{{__('Verify Email')}}</h4>
                        </div>
                        <div class="card-body">
                            @if($verified)
                                <div class="alert alert-success mb-3">
                                    {{$message}}
                                </div>
                                <a href="/login" class="btn btn-primary">{{__('Go to Login')}}</a>
                            @else
                                <div class="alert alert-danger mb-3">
                                    {{$message}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
</body>
</html>
