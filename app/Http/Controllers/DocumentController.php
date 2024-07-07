<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Setting;
use App\Models\Workspace;
use App\Models\Document;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DocumentController extends BaseController
{

    public function documents()
    {
        if ($this->modules && !in_array("documents", $this->modules)) {
            abort(401);
        }

        $documents = Document::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();

        return \view("documents", [
            "selected_navigation" => "documents",
            "documents" => $documents,
        ]);
    }

    public function documentPost(Request $request)
    {
        if ($this->modules && !in_array("documents", $this->modules)) {
            abort(401);
        }

        if (config("app.environment") === "demo") {
            return;
        }
        $max_file_upload_size = 1024 * 1024 * 10;
        
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

        }
        
        if(!$this->user->super_admin && $trial_will_expire && $trial_will_expire->isPast()){
            if(!$this->plan)
            {
                return \redirect()->back()->with("error", __('You need to choose a plan to upload documents.'));
            }

            $max_file_upload_size = $this->plan->max_file_upload_size ?? 2000;
            $file_space_limit = $this->plan->file_space_limit ?? 0;
            $file_space_limit = $file_space_limit * 1000000; # convert to bytes

            $total_space_consumed = Document::where(
                "workspace_id",
                $this->user->workspace_id
            )->sum("size");

            if($total_space_consumed + $request->file("file")->getSize() > $file_space_limit)
            {
                return \redirect()->back()->with("error", __('You have exceeded the file space limit.'));
            }
        }



        $request->validate([
            "file" => "required|mimes:jpeg,bmp,png,gif,svg,pdf|max:$max_file_upload_size",
        ]);
        $path = false;
        if ($request->file) {
            $path = $request->file("file")->store("media", "uploads");
        }

        $document = new Document();
        $document->uuid = Str::uuid();
        $document->workspace_id = $this->user->workspace_id;
        $document->name = $path;
        $document->path = $path;
        $document->name = $request->file("file")->getClientOriginalName();
        $document->size = $request->file("file")->getSize();
        $document->save();
    }
}
