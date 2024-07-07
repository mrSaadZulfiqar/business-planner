@component('mail::layout')
{{-- Header --}}
@slot('header')
    @component('mail::header', ['url' => config('app.url')])
        {{-- Add your logo URL here --}}
        <img src="https://www.app.getbusinessplanner.com/public/img/Banner.jpg" alt="Logo">
    @endcomponent
@endslot

{{-- Body --}}

I wanted to take a moment to extend a warm welcome to you as a new user of Get Business Planner! Thank you for registering with us.

We're thrilled to have you join our community of entrepreneurs and business enthusiasts. Get Business Planner is designed to be your go-to resource for all things related to business planning, strategy, and growth.

Whether you're just starting out or looking to take your existing business to new heights, our platform offers a wealth of tools, templates, and insights to support you on your journey.

As you explore our platform, please don't hesitate to reach out if you have any questions or need assistance. Our support team is here to help you make the most out of your experience with Get Business Planner.

Once again, thank you for choosing Get Business Planner. We're excited to be a part of your entrepreneurial journey and look forward to seeing your business thrive.

{{-- Signature --}}
@component('mail::subcopy')
    Best regards,<br>
    Shevon McDonald, <br>  
    CEO-Founder Get Business Planner
@endcomponent

{{-- Footer --}}
@slot('footer')
    @component('mail::footer')
        © {{ date('Y') }} Get Business Planner. All rights reserved.
    @endcomponent
@endslot
@endcomponent
