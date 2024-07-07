<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projects;
use Illuminate\Http\Request;

class SalesRepositoryController extends BaseController
{
    public function index(){

        $files = $this->files();

        $products = Projects::where("workspace_id", $this->user->workspace_id)
            ->get()
            ->keyBy("id")
            ->all();
        $users = User::all()
            ->keyBy("id")
            ->all();

        return \view("sales_repository", [
            "selected_navigation" => "sales-repository",
            "products" => $products,
            "users" => $users,
            "files" => $files,
        ]);
    }

    function files(){
        $files = [
            [
                'name' => '3 Years Sales Forecasting Template',
                'file_name' => 'public/sales_tools_repository/3 Year Sales Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/3 Years Sales Forecasting Template.jpg',
            ],
            [
                'name' => '5 Year Sales Forecast Template',
                'file_name' => 'public/sales_tools_repository/5 Year Sales Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/5 Year Sales Forecast Template.jpg',
            ],
            [
                'name' => 'Basic Sales Forecast Template',
                'file_name' => 'public/sales_tools_repository/Basic Sales Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Basic Excel Forecast Template.jpg',
            ],
            [
                'name' => 'Deal Based Sales Forecast Template',
                'file_name' => 'public/sales_tools_repository/Deal Based Sales Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Deal Based Sales Forecast Template.jpg',
            ],
            [
                'name' => 'E-Commerce Sales Forecast Template',
                'file_name' => 'public/sales_tools_repository/E-Commerce Sales Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/E-Commerce Sales Forecast Template.jpg',
            ],
            [
                'name' => 'Monthly Sales Projection Template',
                'file_name' => 'public/sales_tools_repository/Monthly Sales Projection Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Monthly Sales Projection Template.jpg',
            ],
            [
                'name' => 'Single Employee TimesheeT',
                'file_name' => 'public/sales_tools_repository/Monthly TimesheeT.xlsx',
                'path' => 'public/sales_tools_repository/images/Single Monthly Employee Timesheet Template.jpg',
            ],
            [
                'name' => 'Multiple Employee Timesheet',
                'file_name' => 'public/sales_tools_repository/Multiple Employee Timesheet.xlsx',
                'path' => 'public/sales_tools_repository/images/Multiple Employee Timesheet Template.jpg',
            ],
            [
                'name' => 'New Startup Checklist',
                'file_name' => 'public/sales_tools_repository/New Startup Checklist.pdf',
                'path' => 'public/sales_tools_repository/images/New Start-Up Company Checklist .jpg',
            ],
            [
                'name' => 'Sales Forecast Presentation Taemplate',
                'file_name' => 'public/sales_tools_repository/Sales Forecast Presentation Taemplate.pptx',
                'path' => 'public/sales_tools_repository/images/Sales Forecast Presentation Template.jpg',
            ],
            [
                'name' => 'Sales Forecasting by Lead Stage Template',
                'file_name' => 'public/sales_tools_repository/Sales Forecasting by Lead Stage Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Sales Forecasting by Lead Stage Template.jpg',
            ],
            [
                'name' => 'Sales & Budget Forecast Template',
                'file_name' => 'public/sales_tools_repository/Sales& Budget Forecast Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Sales & Budget Forecast Template.jpg',
            ],
            [
                'name' => 'Short Risk Assesment Q & A Report',
                'file_name' => 'public/sales_tools_repository/Short Risk Assesment Q & A Report.pdf',
                'path' => 'public/sales_tools_repository/images/A Short Risk Business Assessment Report.jpg',
            ],
            [
                'name' => 'Weekly Project Timesheet Template',
                'file_name' => 'public/sales_tools_repository/Weekly Project Timesheet.xlsx',
                'path' => 'public/sales_tools_repository/images/Weekly Project Timesheet Template.jpg',
            ],
            [
                'name' => 'Weekly Timesheet Template',
                'file_name' => 'public/sales_tools_repository/Weekly Timesheet Template.xlsx',
                'path' => 'public/sales_tools_repository/images/Single Weekly Employee Timesheet Template.jpg',
            ]
            
        ];

        return $files;
    }
}
