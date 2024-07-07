<?php
namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Workspace;

class TrialExpirationCheck
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $trial_will_expire = $this->calculateTrialExpiration($user);

            if ($trial_will_expire && $trial_will_expire->isPast()) {
                // Redirect to a route that shows the Bootstrap modal
                return redirect()->route('show.expired.modal');
              
            }
        }

        return $next($request);
    }

    protected function calculateTrialExpiration($user)
    {
        $super_admin_settings = Setting::getSuperAdminSettings();
        $workspace = Workspace::where('owner_id',auth()->user()->id)->first();
        $trial_will_expire = null;
        if(!empty($super_admin_settings['free_trial_days']) && $workspace && $workspace->trial == 1)
        {
            $free_trial_days = $super_admin_settings['free_trial_days'];
            $free_trial_days = (int) $free_trial_days;
            $workspace_creation_date = $workspace->created_at;
            $trial_will_expire = strtotime($workspace_creation_date) + ($free_trial_days*24*60*60);
            $trial_will_expire = Carbon::createFromTimestamp($trial_will_expire);
            
            return $trial_will_expire;

        }

    }
}
