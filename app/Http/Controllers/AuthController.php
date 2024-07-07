<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Mail\WelcomeEmail;
use App\Models\Setting;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\Notifications\UserRegistered;
use App\Notifications\UserWelcomeEmail;

class AuthController extends Controller
{
    //
    protected $settings;
    protected $super_settings;
    public static $state = 0;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            $super_settings = [];

            $super_settings_data = Setting::where('workspace_id',1)->get();
            foreach ($super_settings_data as $super_setting)
            {
                $super_settings[$super_setting->key] = $super_setting->value;
            }

            $this->super_settings = $super_settings;
            $language = $super_settings['language'] ?? 'en';
            \App::setLocale($language);
            View::share("super_settings", $super_settings);
            return $next($request);
        });
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect("/dashboard");
        }

        return \view("auth.login");
    }
	
	public function superAdminlogin()
    {
        return \view("auth.super-admin-login");
    }

    public function passwordReset(Request $request)
    {
        $request->validate([
            "id" => "required|integer",
            "token" => "required|uuid",
        ]);

        $user = User::find($request->id);

        if (!$user) {
            return redirect("/")->withErrors([
                "key" => "Invalid user or link expired",
            ]);
        }

        if ($user->password_reset_key !== $request->token) {
            return redirect("/")->withErrors([
                "key" => "Invalid key",
            ]);
        }

        return \view("auth.reset-password", [
            "id" => $request->id,
            "password_reset_key" => $request->token,
        ]);
    }

    public function signup()
    {
        return \view("auth.signup");
    }
	
	public function verifyOtp(Request $request)
    {
        $storedOtp = session('otp');
        $phoneNumber = session('phone');

        $validator = Validator::make($request->all(), [
            'otp' => 'required|string|max:6',
        ]);

        if ($validator->fails()) {
            return \view("auth.verify-phone",[
                'message' => "+".$phoneNumber,
                'status' => "You entered Invalid OTP!"
            ]);
        }


        if ($request->otp == $storedOtp) {
            $workspace = new Workspace();

            $workspace->name = session('firstname') . "'s workspace";
            $workspace->save();

            $user = new User();

            $password = Hash::make(session('password'));

            $user->password = $password;

            $user->first_name = session('firstname');
            $user->last_name = session('lastname');

            $user->email = session('email');
            $user->is_email_verified = 0;
            $user->email_verification_token = Str::uuid();
            $user->phone_number = session('phone');
            $user->workspace_id = $workspace->id;

            $user->save();

            $workspace->owner_id = $user->id;
            $workspace->save();

            try{
                Mail::to($user)->send(new WelcomeEmail($user));
                
                $admin = User::where('super_admin', 1)->first();
                $admin->notify(new UserRegistered($user));
                
            } catch (\Exception $e) {
                Log::error($e->getMessage());
                ray($e->getMessage());
            }

            session()->forget(['otp', 'phone', 'firstname', 'lastname', 'email', 'password']);

            return redirect(config("app.url") . "/login")->with(
                "status",
                __("Phone verify finished and your account has been created successfully. Please check your email for verification link.")
            );
        } else {
            return \view("auth.verify-phone",[
                'message' => "+".$phoneNumber,
                'status' => "You entered Invalid OTP!"
            ]);
        }
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'token' => 'required|uuid'
        ]);

        $user = User::find($request->user_id);

        $verified = false;

        if (!$user) {
            $message = __('Invalid user or link expired');
        }
        else{
            if ($user->email_verification_token !== $request->query('token')) {
                $message = __('Invalid key');
            }
            else{
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->email_verification_token = null;
                $user->is_email_verified = 1;
                $user->save();
                $verified = true;
                $message = __('Email verified successfully');
				
				$user->notify(new UserWelcomeEmail($user));
            }
        }

        return \view("auth.verify-email",[
            'verified' => $verified,
            'message' => $message
        ]);

    }

    public function forgotPassword()
    {
        return \view("auth.forgot-password");
    }

    public function resetPasswordPost(Request $request)
    {
        $request->validate([
            "email" => "required|email",
        ]);

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withErrors([
                    "email" => "No account found with this email",
                ]);
        }

        $user->password_reset_key = Str::uuid();
        $user->save();

        if(!empty($this->super_settings['smtp_host']))
        {
            try{
                Mail::to($user->email)->send(new PasswordReset($user));
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }


        session()->flash(
            "status",
            "We sent you an email with the instruction to reset the password."
        );

        return redirect("/");
    }

    public function newPasswordPost(Request $request)
    {
        $request->validate([
            "password" => "required|confirmed",
            "id" => "required|integer",
            "password_reset_key" => "required|uuid",
        ]);

        $user = User::find($request->id);

        if (!$user) {
            return redirect()
                ->back()
                ->withErrors([
                    "email" => "No account found with this email",
                ]);
        }

        if ($user->password_reset_key !== $request->password_reset_key) {
            return redirect()
                ->back()
                ->withErrors([
                    "key" => "Invalid key",
                ]);
        }

        $user->password = Hash::make($request->password);

        $user->password_reset_key = null;

        $user->save();

        session()->flash(
            "status",
            "Your password has been reset, login with the new password."
        );

        return redirect("/");
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //Verify recaptcha v2
        if(!empty($this->super_settings['config_recaptcha_in_user_login']))
        {
            $recaptcha = $request->get('g-recaptcha-response');
            $secret = $this->super_settings['recaptcha_api_secret'] ?? '';

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}");
            $captcha_success = json_decode($verify);



            if ($captcha_success->success == false) {
                return redirect()->back()->withErrors([
                    'key' => 'Invalid captcha',
                ]);
            }
        }

        $remember = false;

        if($request->remember)
        {
            $remember = true;
        }

        if (Auth::attempt($credentials, $remember)) {
            $user = User::where('email',$request->email)->first();
            if($user)
            {
                if($user->is_email_verified == 0)
                {
                    Auth::logout();
					Mail::to($user)->send(new WelcomeEmail($user));
                    return back()->withErrors([
                        'email' => __('Your email is not verified. Please check your email for verification link'),
                    ]);
                }

                $workspace = Workspace::find($user->workspace_id);

                if($workspace && $workspace->id != 1 && $workspace->trial == 1)
                {

                    $super_admin_settings = Setting::getSuperAdminSettings();

                    if(!empty($super_admin_settings['free_trial_days']))
                    {
                        $free_trial_days = $super_admin_settings['free_trial_days'];
                        $free_trial_days = (int) $free_trial_days;
                        $workspace_creation_date = $workspace->created_at;
                        $trial_will_expire = strtotime($workspace_creation_date) + ($free_trial_days*24*60*60);

                        if($trial_will_expire < time())
                        {
                //                            Auth::logout();
                //                            return back()->withErrors([
                //                                'trial_expired' => __('Your trial has been expired.'),
                //                            ]);

                            $freePlan = SubscriptionPlan::where(function ($query) {
                                $query->whereNull('price_monthly')
                                    ->orWhere('price_monthly', 0);
                            })->first();

                            if($freePlan)
                            {
                                $workspace->subscribed = 1;
                                $workspace->term = $request->term;
                                $workspace->subscription_start_date = date("Y-m-d");
                                $workspace->next_renewal_date = date("Y-m-d", strtotime("+1 month"));
                                $workspace->price = 0;
                                $workspace->trial = 0;
                                $workspace->plan_id = $freePlan->id;
                                $workspace->save();
                            }
                        }
                    }
                }



            }
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function superAdminAuthenticate(Request $request)
    {
        $request->validate([
            "email" => ["required", "email"],
            "password" => ["required"],
        ]);

        //Verify recaptcha v2
        if(!empty($this->super_settings['config_recaptcha_in_admin_login']))
        {
            $recaptcha = $request->get('g-recaptcha-response');
            $secret = $this->super_settings['recaptcha_api_secret'] ?? '';

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}");
            $captcha_success = json_decode($verify);
            if ($captcha_success->success == false) {
                return redirect()->back()->withErrors([
                    'key' => 'Invalid captcha',
                ]);
            }
        }

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                "email" => __("User not found!"),
            ]);
        }

        if (!$user->super_admin) {
            return back()->withErrors([
                "email" => __("Invalid user."),
            ]);
        }

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user, true);
            $request->session()->regenerate();

            return redirect(config("app.url") . "/super-admin/dashboard");
        }

        return back()->withErrors([
            "email" => __("Invalid user."),
        ]);
    }
	
	function generateOtp() {
		return rand(100000, 999999);
	}
	
	function sendOtp() {        
		$otp = $this->generateOtp();
        session([
            'otp' => $otp
        ]);
		$message = "Your OTP code is: " . $otp;
        $basic  = new \Vonage\Client\Credentials\Basic(env('VONAGE_API_KEY'), env('VONAGE_API_SECRET'));
        $client = new \Vonage\Client($basic);

        $phoneNumber  =session('phone');

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS($phoneNumber, env('BRAND_NAME'), $message)
        );
        $message = $response->current();
        
		if ($message->getStatus() == 0) {
            $status = "The OTP code is successfully transfered in your phone!";
        } else {
            $status = "Your phone or Server is exceeded. Try another phone!";
        }
        if(self::$state == 1){
            self::$state = 0;
            return $status;
        }
        else{
            return \view("auth.verify-phone",[
                'message' => "+".$phoneNumber,
                'status' => $status
            ]);
        }
	}
	
    public function signupPost(Request $request)
    {
        $request->validate([
            "email" => ["required", "email"],
            "first_name" => ["required"],
            "last_name" => ["required"],
            "password" => ["required"],
            "phone" => ["required"],
        ]);

        if(!empty($this->super_settings['config_recaptcha_in_user_signup']))
        {
            $recaptcha = $request->get('g-recaptcha-response');
            $secret = $this->super_settings['recaptcha_api_secret'] ?? '';

            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptcha}");
            $captcha_success = json_decode($verify);
            if ($captcha_success->success == false) {
                return redirect()->back()->withErrors([
                    'key' => 'Invalid captcha',
                ]);
            }
        }


        $check = User::where("email", $request->email)->first();
        if ($check) {
            return back()->withErrors([
                "email" => "User already exist",
            ]);
        }
		if (strpos($request->phone, "+") === false) {
			return back()->withErrors([
                "phone" => "Input your phoneNumber correctly.",
            ]);
		}
		$phone = substr($request->phone, 1, strlen($request->phone)-1);
		$check = User::where("phone_number", $phone)->first();
		if ($check) {
            return back()->withErrors([
                "phone" => "Your phonenumber must be unique",
            ]);
        }
        session([
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'password' => $request->password,
            'email' => $request->input("email"),
            'phone' => $phone
        ]);
        self::$state = 1;
        $status = $this->sendOtp($phone);

		return \view("auth.verify-phone",[
            'message' => "+".$phone,
            'status' => $status
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect("/");
    }
}
