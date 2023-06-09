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
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', ],
            'end_date' => ['required', 'date_format:d/m/Y' ],
            'warning_message' => ['required', ],
            'end_message' => ['required', ],
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->user_id = Auth::user()->id;
        $project->warning_message = $request->warning_message;
        $project->end_message = $request->end_message;
        $project->email = $request->email;
        $project->end_date = myConvertDate($request->end_date) ;
        $project->save();

        return redirect()->route('dashboard')->with('success', 'Project created successfully');
    }

    public function view($id)
    {
        $project = Project::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();
        return view('profile.project', ['project'=>$project]);
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
