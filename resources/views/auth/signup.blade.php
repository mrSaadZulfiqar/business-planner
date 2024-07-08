<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{__('Signup')}}-{{config('app.name')}}
    </title>
    @if(!empty($super_settings['favicon']))

        {{-- <link rel="icon" type="image/png" href="{{PUBLIC_DIR}}/uploads/{{$super_settings['favicon']}}"> --}}
        <link rel="icon" type="image/png" href="{{ asset('uploads/' . $super_settings['favicon']) }}">
    @endif
    {{-- <link id="pagestyle" href="{{PUBLIC_DIR}}/css/app.css" rel="stylesheet"/> --}}
    <link id="pagestyle" href="{{ asset('css/app.css') }}" rel="stylesheet"/>

    @if(!empty($super_settings['config_recaptcha_in_user_signup']))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
</head>
<body class="g-sidenav-show  bg-gray-100">
@if(($super_settings['landingpage'] ?? null) === 'Default')
    <nav class="navbar navbar-expand-lg top-0 z-index-3 w-100 shadow-blur  bg-gray-100 fixed-top ">
        <div class="container mt-1">

            <a class="navbar-brand text-dark bg-transparent fw-bolder" href="/" rel="tooltip" title="" data-placement="bottom">
                @if(!empty($super_settings['logo']))
                    {{-- <img src="{{PUBLIC_DIR}}/uploads/{{$super_settings['logo']}}" class="navbar-brand-img h-100" style="max-height: {{$super_settings['frontend_logo_max_height'] ?? '30'}}px;" alt="..."> --}}
                    <img src="{{ asset('uploads/' . $super_settings['logo']) }}" class="navbar-brand-img h-100" style="max-height: {{ $super_settings['frontend_logo_max_height'] ?? '30' }}px;" alt="...">

                @else
                    <span class=" font-weight-bold">{{config('app.name')}}</span>
                @endif
            </a>

            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon mt-2">
<span class="navbar-toggler-bar bar1"></span>
<span class="navbar-toggler-bar bar2"></span>
<span class="navbar-toggler-bar bar3"></span>
</span>
            </button>

            <div class="collapse  navbar-collapse w-100 pt-3 pb-2 py-lg-0 ms-lg-12 " id="navigation">
                <ul class="navbar-nav bg-transparent navbar-nav-hover w-100">

                    <li class="nav-item float-end ms-5 ms-lg-auto">
                        <a  href="/" class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center">
                            {{__('Home')}}

                        </a>
                    </li>

                    <li class="nav-item float-end ms-5 ms-lg-auto">
                        <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/pricing" target="_blank">
                            {{__('Pricing')}}

                        </a>
                    </li>
                    <li class="nav-item float-end ms-5 ms-lg-auto">
                        <a class=" fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-2" href="/blog" target="_blank">
                            {{__('Blog')}}

                        </a>
                    </li>
                    <li class="nav-item float-end ms-5 ms-lg-auto">
                        <a class="fw-bolder h6 ps-2 d-flex justify-content-between cursor-pointer align-items-center me-5" href="/login" target="_blank">

                            {{__('Login')}}

                        </a>
                    </li>

                    <li class="nav-item my-auto ms-3 ms-lg-0">
                        <a href="/signup" class="btn bg-dark text-white mb-0 me-1 mt-2 mt-md-0">{{__('Sign Up for free')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@endif

<section class="min-vh-100">
    <div class="row my-6">
        <div class="col-md-7">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="text-center mx-auto">
                        <h1 class=" text-purple mb-4 mt-10">{{__('“Play by the rules, but be ferocious.” ')}}</h1>
                        <h6 class="text-lead text-success">{{__('– Phil Knight')}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="container">
                <div class=" card z-index-0 mt-5">
                    <div class="card-header text-start pt-4">
                        <h4>{{__('SignUp')}}</h4>
                    </div>
                    <div class="card-body">
                        <form role="form text-left" method="post" action="/signup">
                            @if (session()->has('status'))
                                <div class="alert alert-success">
                                    {{session('status')}}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert bg-pink-light text-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <label>{{__('First Name')}}</label>
                            <div class="mb-3">
                                <input name="first_name" class="form-control" type="text" placeholder="First name"
                                       aria-describedby="email-addon">
                            </div>
                            <label>{{__('Last Name')}}</label>
                            <div class="mb-3">
                                <input type="text" name="last_name" class="form-control" placeholder="Last name"
                                       aria-describedby="email-addon">
                            </div>
                            <label>{{__('Email')}}</label>
                            <div class="mb-3">
                                <input type="email" placeholder="Email" name="email" class="form-control"
                                       aria-label="Email" aria-describedby="email-addon">
                            </div>
							
							<label>{{__('Phone Number')}}</label>							
							<div class="mb-3 row">
								<div class="col-md-5">
									<select class="form-select" autocomplete="tel-country-code" name="countrycode" id="countrycode" 
										data-target="two-factor-setup-verification.countryCodeSelect">
										<option value="+1">United States +1</option>
										<option value="+358">Aland Islands +358</option>
										<option value="+213">Algeria +213</option>
										<option value="+244">Angola +244</option>
										<option value="+1264">Anguilla +1264</option>
										<option value="+61">Australia +61</option>
										<option value="+43">Austria +43</option>
										<option value="+1">Bahamas +1</option>
										<option value="+973">Bahrain +973</option>
										<option value="+880">Bangladesh +880</option>
										<option value="+375">Belarus +375</option>
										<option value="+32">Belgium +32</option>
										<option value="+229">Benin +229</option>
										<option value="+591">Bolivia +591</option>
										<option value="+387">Bosnia and Herzegovina +387</option>
										<option value="+673">Brunei +673</option>
										<option value="+359">Bulgaria +359</option>
										<option value="+257">Burundi +257</option>
										<option value="+855">Cambodia +855</option>
										<option value="+1">Canada +1</option>
										<option value="+238">Cape Verde +238</option>
										<option value="+1345">Cayman Islands +1345</option>
										<option value="+61">Christmas Island +61</option>
										<option value="+61">Cocos +61</option>
										<option value="+243">Congo, Dem Rep +243</option>
										<option value="+385">Croatia +385</option>
										<option value="+357">Cyprus +357</option>
										<option value="+420">Czech Republic +420</option>
										<option value="+45">Denmark +45</option>
										<option value="+1767">Dominica +1767</option>
										<option value="+1">Dominican Republic +1</option>
										<option value="+593">Ecuador +593</option>
										<option value="+240">Equatorial Guinea +240</option>
										<option value="+372">Estonia +372</option>
										<option value="+358">Finland/Aland Islands +358</option>
										<option value="+33">France +33</option>
										<option value="+220">Gambia +220</option>
										<option value="+995">Georgia +995</option>
										<option value="+49">Germany +49</option>
										<option value="+233">Ghana +233</option>
										<option value="+350">Gibraltar +350</option>
										<option value="+30">Greece +30</option>
										<option value="+502">Guatemala +502</option>
										<option value="+592">Guyana +592</option>
										<option value="+36">Hungary +36</option>
										<option value="+354">Iceland +354</option>
										<option value="+62">Indonesia +62</option>
										<option value="+91">India +91</option>
										<option value="+353">Ireland +353</option>
										<option value="+972">Israel +972</option>
										<option value="+39">Italy +39</option>
										<option value="+225">Ivory Coast +225</option>
										<option value="+1876">Jamaica +1876</option>
										<option value="+81">Japan +81</option>
										<option value="+962">Jordan +962</option>
										<option value="+7">Kazakhstan +7</option>
										<option value="+965">Kuwait +965</option>
										<option value="+371">Latvia +371</option>
										<option value="+218">Libya +218</option>
										<option value="+423">Liechtenstein +423</option>
										<option value="+370">Lithuania +370</option>
										<option value="+352">Luxembourg +352</option>
										<option value="+261">Madagascar +261</option>
										<option value="+265">Malawi +265</option>
										<option value="+60">Malaysia +60</option>
										<option value="+960">Maldives +960</option>
										<option value="+223">Mali +223</option>
										<option value="+356">Malta +356</option>
										<option value="+230">Mauritius +230</option>
										<option value="+52">Mexico +52</option>
										<option value="+377">Monaco +377</option>
										<option value="+382">Montenegro +382</option>
										<option value="+1664">Montserrat +1664</option>
										<option value="+258">Mozambique +258</option>
										<option value="+264">Namibia +264</option>
										<option value="+31">Netherlands +31</option>
										<option value="+599">Netherlands Antilles +599</option>
										<option value="+64">New Zealand +64</option>
										<option value="+234">Nigeria +234</option>
										<option value="+47">Norway +47</option>
										<option value="+63">Philippines +63</option>
										<option value="+48">Poland +48</option>
										<option value="+351">Portugal +351</option>
										<option value="+974">Qatar +974</option>
										<option value="+40">Romania +40</option>
										<option value="+250">Rwanda +250</option>
										<option value="+221">Senegal +221</option>
										<option value="+381">Serbia +381</option>
										<option value="+248">Seychelles +248</option>
										<option value="+65">Singapore +65</option>
										<option value="+421">Slovakia +421</option>
										<option value="+386">Slovenia +386</option>
										<option value="+27">South Africa +27</option>
										<option value="+82">South Korea +82</option>
										<option value="+34">Spain +34</option>
										<option value="+94">Sri Lanka +94</option>
										<option value="+1758">St Lucia +1758</option>
										<option value="+249">Sudan +249</option>
										<option value="+46">Sweden +46</option>
										<option value="+41">Switzerland +41</option>
										<option value="+886">Taiwan +886</option>
										<option value="+255">Tanzania +255</option>
										<option value="+228">Togo +228</option>
										<option value="+1868">Trinidad and Tobago +1868</option>
										<option value="+1649">Turks and Caicos Islands +1649</option>
										<option value="+256">Uganda +256</option>
										<option value="+971">United Arab Emirates +971</option>
										<option value="+44">United Kingdom +44</option>
										<option value="+1">United States +1</option>
										<option value="+998">Uzbekistan +998</option>
										<option value="+58">Venezuela +58</option>
									</select>	
								</div>
								<div class="col-md-7">
									<input type="text" name="phone" id="phone" class="form-control"  placeholder="enter your phone number" 
										aria-label="Password" aria-describedby="password-addon">
								</div>
							</div>
                            <label>{{__('Choose Password')}}</label>
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                       aria-label="Password" aria-describedby="password-addon">
                            </div>
                                @if(!empty($super_settings['config_recaptcha_in_user_signup']))
                                    <div class="g-recaptcha" data-sitekey="{{$super_settings['recaptcha_api_key']}}">

                                    </div>
                                @endif
                            @csrf
                            <div class="text-start">
                                <button type="submit" id="signup" class="btn btn-info  my-4 mb-2">{{__('Sign up')}}</button>
                            </div>
                            <p class="text-sm mt-3 mb-0">{{__('Already have an account?')}} <a href="/login"
                                                                                               class="text-dark font-weight-bolder">{{__('Sign in')}}</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>

    (function(){
        "use strict";
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
		
        document.getElementById("countrycode").addEventListener("change", function(){
            document.getElementById("phone").value = document.getElementById("countrycode").value;
        })
		
        document.getElementById("signup").addEventListener("click", function(){
			var inputPhoneNumber = document.getElementById("phone").value;
			var countryCode = document.getElementById("countrycode").value;
			if(inputPhoneNumber.indexOf(countryCode) == -1)
				alert("You must input phoneNumber correctly");
		})
		
    })();
</script>

</body>

</html>
