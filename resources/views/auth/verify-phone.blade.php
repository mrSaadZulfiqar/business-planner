<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/>
	<style>
		.card-content{
			padding:20px;
		}
		.card-content label{
			font-size:14px;
		}
	</style>
</head>
<body class="bg-pink-light">
<main class="main-content main-content-bg mt-0">
    <section class="min-vh-45">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mt-sm-8 mt-9 mb-4">
                        <div class="card-header text-center pt-4 pb-1">
                            <h4 class="font-weight-bolder mb-1">{{__('Verify Your Phonenumber ')}}</h4>
                        </div>
						<div class="card-content">
							<form method="POST" action="/verify-phone">
								<br/>
								@csrf
								<h5 class="mb-1">{{__('Enter Code ')}}</h5>
								<br/>
								<div class="text-center">
									<label>We just sent a code to {{$message}}</label>
									<br/>
									<input type="phone" name="otp" placeholder="XXXXXX" required>
									<br/>
									<label>{{$status}}</label>
								</div>
								<br/>
								<p>Didn't receive it? Please wait for a few minutes and <a href = "{{ route('resend.phonecode') }}">Resend</a> the code.</p>
								<button class="btn btn-primary w-100 mt-4 mb-0" type="submit">
									Verify
								</button>
							</form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>
</body>
</html>
