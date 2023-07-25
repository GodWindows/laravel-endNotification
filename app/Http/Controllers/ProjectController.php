<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
     public function create(Request $request)
     {
        $nbDays = ["day"=> 1, "month"=> 30, "year"=> 365];
         $request->validate([
             'name' => ['required', 'string', 'max:50'],
             'email' => ['required', 'email', ],
             'start_date' => ['required',/*  'date_format:d/m/Y'  */],
             'reminder_message' => ['required', ],
             'warning_message' => ['required', ],
             'end_message' => ['required'],
             'freq_time' => ['required'],
             'time' => ['required'],
             'freq_dmy' => ['required'],
             'dmy' => ['required'],
         ]);

         $project = new Project();
         $project->name = $request->name;
         $project->user_id = Auth::user()->id;
         $project->warning_message = $request->warning_message;
         $project->end_message = $request->end_message;
         $project->reminder_message = $request->reminder_message;
         $project->email = $request->email;
         $project->start_date = ($request->start_date) ;
         $project->duration = ($request->time * $nbDays[$request->dmy]);
         $project->frequency = ($request->freq_time * $nbDays[$request->freq_dmy]);
         $project->frequency_dmy = $nbDays[$request->freq_dmy];
         $project->duration_dmy = $nbDays[$request->dmy];
         $project->save();

         return redirect()->route('dashboard')->with('success', 'Project created successfully');
     }

    public function view($id)
    {
        $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();
        $remindersDates = json_decode($project->reminders_dates);
        return view('profile.project', ['project'=>$project, 'remindersDates'=>$remindersDates]);
    }

    public function tasks($code)
    {
        if($code=="1d24e57x1eXEe8xe7e8e7xeX")
        {
            manageProjects();
        }
    }

    public function delete($id)
    {
        $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        $project->delete();
        return redirect()->route('dashboard')->with('success', 'Project deleted successfully');
    }

    public function edit(Request $request)
    {
        $nbDays = ["day"=> 1, "month"=> 30, "year"=> 365];
        $request->validate([
             'name' => ['required', 'string', 'max:50'],
             'email' => ['required', 'email', ],
             'start_date' => ['required'],
             'reminder_message' => ['required', ],
             'warning_message' => ['required', ],
             'end_message' => ['required'],
             'freq_time' => ['required'],
             'time' => ['required'],
             'freq_dmy' => ['required'],
             'dmy' => ['required'],
         ]);
        $project = Project::where('id', $request->id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

         $project->name = $request->name;
         $project->user_id = Auth::user()->id;
         $project->warning_message = $request->warning_message;
         $project->end_message = $request->end_message;
         $project->reminder_message = $request->reminder_message;
         $project->email = $request->email;
         $project->start_date = ($request->start_date) ;
         $project->duration = ($request->time * $nbDays[$request->dmy]);
         $project->frequency = ($request->freq_time * $nbDays[$request->freq_dmy]);
         $project->frequency_dmy = $nbDays[$request->freq_dmy];
         $project->duration_dmy = $nbDays[$request->dmy];

         if ($project->frequency > $project->duration) {
            return redirect()->back()->with('error', 'frequency greater than duration');
         }
         $project->save();

        return redirect()->back()->with('success', 'Project updated successfully');
    }
}
