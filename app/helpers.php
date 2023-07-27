<?php

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageMail;

if (!function_exists('progress')) {
    function progress($project) : int
    {
       try {
        $startDate = Carbon::parse($project->start_date);
        $currentDate = Carbon::now();

        $totalDuration = $project->duration;
        $elapsedDuration = $startDate->diffInDays($currentDate);

        $progress = intval(($elapsedDuration / $totalDuration) * 100);
        if ($progress<0) {
            return 0;
        }
        if ($progress>100) {
            return 100;
        }
        return $progress;

       } catch (\Throwable $th) {
        return 0 ;
       }
    }
}

if (!function_exists('endIn3Days')) {
    function endIn3Days($project)
    {
        $startDate = Carbon::parse($project->start_date);
        $currentDate = Carbon::now();
        $elapsedDuration = $startDate->diffInDays($currentDate);
        return ($elapsedDuration +3 )== $project->duration;;
    }
}

if (!function_exists('endToday')) {
    function endToday($project)
    {
        $startDate = Carbon::parse($project->start_date);
        $currentDate = Carbon::now();
        $elapsedDuration = $startDate->diffInDays($currentDate);
        return $elapsedDuration == $project->duration;
    }
}

if (!function_exists('isRunning')) {
    function isRunning($project)
    {
        $startDate = Carbon::parse($project->start_date);
        $currentDate = Carbon::now();
        $elapsedDuration = $startDate->diffInDays($currentDate);
        return ($currentDate->gt($startDate)) && ($elapsedDuration <= ($project->duration));
    }
}

if (!function_exists('isReminderdate')) {
    function isReminderdate($project)
    {
        $startDate = Carbon::parse($project->start_date);
        $currentDate = Carbon::now();
        $elapsedDuration = $startDate->diffInDays($currentDate);
        $reminderDayMatches = ( $elapsedDuration % $project->frequency )== 0;
        return  $reminderDayMatches;
    }
}

if (!function_exists('manageProjects')) {
    function manageProjects()
    {
        $projects = Project::all();
        foreach ($projects as $project) {
            if (isRunning($project) && ($project->is_active==1)) {
                if (isReminderDate($project)) {
                    Mail::to($project->email)->send(new MessageMail(
                        ['subject' => 'Message venant de ' . $project->user->name ,
                         'title' => 'Vous avez reçu un message de ' . $project->user->name .'.',
                         'content' => $project->reminder_message
                        ]
                    ));
                }
                if (endIn3Days($project)) {
                    Mail::to($project->email)->send(new MessageMail(
                        ['subject' => 'Message venant de ' . $project->user->name ,
                         'title' => "Ceci est un message d'avertissement de " . $project->user->name .'.',
                         'content' => $project->warning_message
                        ]
                    ));
                }else
                if (endToday($project)) {
                    Mail::to($project->email)->send(new MessageMail(
                        ['subject' => 'Message venant de ' . $project->user->name ,
                         'title' => 'Vous avez reçu un message de ' . $project->user->name .'.',
                         'content' => $project->end_message
                        ]
                    ));
                }
            }
        }
    }
}
if (!function_exists('myConvertDate')) {
    function myConvertDate($date)
    {
        $convertedDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

        return $convertedDate;
    }
}
if (!function_exists('reverseConvertDate')) {
    function reverseConvertDate($date)
    {
        $convertedDate = Carbon::createFromFormat('Y-m-d', $date)->format('d/m/Y');

        return $convertedDate;
    }
}



?>

