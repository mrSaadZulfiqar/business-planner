@component('mail::message')
# {{__('Verify your email')}} {{$user->first_name}}!

{{__('Thanks For Signing Up. Please verify your email to start using')}} {{config('app.name')}}.

@component('mail::button', ['url' => config('app.url').'/verify-email?user_id='.$user->id.'&token='.$user->email_verification_token])
        {{__('Verify Email')}}
@endcomponent

{{__('Thanks')}},<br>
{{ config('app.name') }}
@endcomponent
