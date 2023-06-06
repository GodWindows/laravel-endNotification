<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function addProject(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'number' => ['required', 'numeric'],
            'time' => ['required', 'numeric', 'min:1', 'max:3'],
            'warning_message' => ['required', ],
            'end_message' => ['required', ],
            'email' => ['required', 'email', ],
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->warning_message = $request->warning_message;
        $project->end_message = $request->end_message;
        $project->email = $request->email;

        switch ($request->time) {
            case 1:
                $weeks = $request->number;
                $endDate = Carbon::now()->addWeeks($weeks);
                $project->end_date = $endDate;
                $project->save();

                break;

            case 2:
                $months = $request->number;
                $endDate = Carbon::now()->addMonths($months);
                $project->end_date = $endDate;
                $project->save();

                break;

            case 3:
                $years = $request->number;
                $endDate = Carbon::now()->addYears($years);
                $project->end_date = $endDate;
                $project->save();

                break;


            default:
                # code...
                break;
        }
        return redirect()->route('dashboard')->with('success', 'Project created successfully');
    }

    public function tasks($code)
    {
        if($code=="1d24e57x1eXEe8xe7e8e7xeX")
        {
            manageProjects();
        }
    }
}
