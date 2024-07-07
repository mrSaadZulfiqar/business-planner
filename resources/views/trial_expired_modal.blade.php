@extends('layouts.primary')
@section('content')
    @php
        $user = auth()->user();
    @endphp
    
    <div class="card mt-md-5 mx-md-5">
      <div class="card-body">
        <h4 class="card-title">Your Current Subscription Plan Has Expired</h4>
        <p class="card-text mt-4">To renew your subscription. Please choose one of our pricing options.</p>
        <p class="card-text">Either <a href="https://www.app.getbusinessplanner.com/billing" class="text-primary">Click Here</a> or scroll down to <strong>“My Plan”</strong> in your control panel.</p>
        <p class="text-muted mt-5">Thank you <br />GetBusinessPlanner.Com-Support Team</p>
      </div>
    </div>

@endsection