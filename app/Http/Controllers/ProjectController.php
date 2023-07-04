<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name' => ['required', 'string', 'max:50'],
    //         'email' => ['required', 'email', ],
    //         'end_date' => ['required', 'date_format:d/m/Y' ],
    //         'warning_message' => ['required', ],
    //         'end_message' => ['required'],
    //     ]);

    //     $project = new Project();
    //     $project->name = $request->name;
    //     $project->user_id = Auth::user()->id;
    //     $project->warning_message = $request->warning_message;
    //     $project->end_message = $request->end_message;
    //     $project->email = $request->email;
    //     $project->end_date = myConvertDate($request->end_date) ;
    //     $project->save();

    //     return redirect()->route('dashboard')->with('success', 'Project created successfully');
    // }


    public function create(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', ],
            'start_date' => ['required'],
            'time' => ['required'],
            'dmy' => ['required'],
            'freq_time' => ['required'],
            'freq_dmy' => ['required'],
            'warning_message' => ['required'],
            'end_message' => ['required'],
        ]);

        echo(' ');
        echo($request->time);
        echo($request->dmy);
        echo(' ');
        echo($request->freq_time);
        echo($request->freq_dmy);
        // echo($request->date);

        // $pro = new Carbon($request->date);

        $start_date = new Carbon($request->start_date);

        echo(' ');

        echo($start_date)->format('d/m/Y');

        $date = clone $start_date;
        if($request->dmy == 'day'){
            $end_date = $date->addDay($request->time);
        }elseif($request->dmy == 'month'){
            $end_date = $date->addMonth($request->time);
        }elseif($request->dmy == 'year'){
            $end_date = $date->addYear($request->time);
        }

        echo(' ');
        echo($end_date->format('d/m/Y'));

        echo(' ');


        $reminder_date = clone $start_date; // Cloner la date de départ pour éviter les modifications inattendues
        $tab = array(); // Initialiser le tableau des dates

        $i = 0;

        echo(' ');
        echo($reminder_date->format('d/m/Y'));
        echo(' ');

        do {
            if ($request->freq_dmy == 'day') {
                $reminder_date->addDays($request->freq_time);
                $i++;
            } elseif ($request->freq_dmy == 'month') {
                $reminder_date->addMonths($request->freq_time);
                $i++;
            } elseif ($request->freq_dmy == 'year') {
                $reminder_date->addYears($request->freq_time);
                $i++;
            }
            if ($reminder_date > $end_date) {
                break;
            }
            $tab[$i] = clone $reminder_date;// Cloner la date pour éviter les modifications inattendues
        } while ($reminder_date < $end_date);

        echo ('les dates sont : ');
        foreach ($tab as $date) {
            echo $date->format('d/m/Y') . "\n";
        }

        $project = new Project();
        $project->name = $request->name;
        $project->user_id = Auth::user()->id;
        $project->email = $request->email;
        $project->start_date = $start_date;
        $project->end_date = $end_date;
        $project->reminders_dates = json_encode($tab);
        $project->warning_message = $request->warning_message;
        $project->end_message = $request->end_message;
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

    public function update(Request $request)
    {
        $project = Project::where('id', $request->id)
        ->where('user_id', auth()->id())
        ->firstOrFail();
        $project->name = $request->name;
        $project->warning_message = $request->warning_message;
        $project->end_message = $request->end_message;
        $project->email = $request->email;
        $project->end_date = myConvertDate($request->end_date) ;
        $project->save();

        return redirect()->back()->with('success', 'Project updated successfully');
    }
}
