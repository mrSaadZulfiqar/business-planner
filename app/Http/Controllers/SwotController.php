<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\SwotAnalysis;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class SwotController extends BaseController
{

    public function writeSwot(Request $request)
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }
        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();

        return \view("swot.write-swot", [
            "selected_navigation" => "swot",
            "model" => $model,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function swotList()
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $models = SwotAnalysis::where(
            "workspace_id",
            $this->user->workspace_id
        )->get();
        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();
        return \view("swot.list", [
            "selected_navigation" => "swot",
            "models" => $models,
            "products" => $products,
            "users" => $users,
        ]);
    }

    public function swotPost(Request $request)
    {
        $request->validate([
            "company_name" => "required|max:150",
            "id" => "nullable|integer",
        ]);

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }

        if (!$model) {
            $model = new SwotAnalysis();
            $model->uuid = Str::uuid();
            $model->workspace_id = $this->user->workspace_id;
        }

        $model->weaknesses = clean($request->weaknesses);
        $model->company_name = $request->company_name;
        $model->product_id = $request->product_id;
        $model->threats = clean($request->threats);
        $model->strengths = clean($request->strengths);
        $model->opportunities = clean($request->opportunities);

        $model->save();

        return redirect("/write-swot?id=" . $model->id);


    }

    public function viewSwot(Request $request)
    {
        if ($this->modules && !in_array("swot", $this->modules)) {
            abort(401);
        }

        $model = false;

        if ($request->id) {
            $model = SwotAnalysis::where(
                "workspace_id",
                $this->user->workspace_id
            )
                ->where("id", $request->id)
                ->first();
        }
        abort_unless($model, 401);

        return \view("swot.view-swot", [
            "selected_navigation" => "swot",
            "model" => $model,
        ]);
    }
}
