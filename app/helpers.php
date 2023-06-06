<?php

use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;

if (!function_exists('progress')) {
    function progress($project) : int
    {
        $startDate = Carbon::parse($project->created_at);
        $endDate = Carbon::parse($project->end_date);
        $currentDate = Carbon::now();

        $totalDuration = $startDate->diffInDays($endDate);
        $elapsedDuration = $startDate->diffInDays($currentDate);

        $progress = intval(($elapsedDuration / $totalDuration) * 100);

        return $progress;
    }
}

if (!function_exists('endIn3Days')) {
    function endIn3Days($project)
    {
        $endDate = Carbon::parse($project->end_date);
        $threeDaysBeforeEndDate = $endDate->subDays(3);
        $today = Carbon::now();

        return $threeDaysBeforeEndDate->isSameDay($today);
    }
}

if (!function_exists('endToday')) {
    function endToday($project)
    {
        $endDate = Carbon::parse($project->end_date)->endOfDay();
        $today = Carbon::now();

        return $endDate->isSameDay($today);
    }
}

if (!function_exists('manageProjects')) {
    function manageProjects()
    {
        $admin = "sakigbe95@gmail.com";
        $projects = Project::all();
        foreach ($projects as $project) {
            if (endIn3Days($project)) {
                $toEmail = $project->email;
                $subject = 'Message de l\'admin';
                $content = $project->warning_message;
                Mail::raw($content, function ($message) use ($toEmail, $subject) {
                    $message->to($toEmail)->subject($subject);
                });
                Mail::raw($content, function ($message) use ($admin, $subject) {
                    $message->to($admin)->subject($subject);
                });
            }
            elseif (endToday($project)) {
                $toEmail = $project->email;
                $subject = 'Message de l\'admin';
                $content = $project->end_message;
                Mail::raw($content, function ($message) use ($toEmail, $subject) {
                    $message->to($toEmail)->subject($subject);
                });
                Mail::raw($content, function ($message) use ($admin, $subject) {
                    $message->to($admin)->subject($subject);
                });
            }
        }
        $toEmail = "kanlinsougodwin@gmail.com";
        $subject = 'Test cron job';
        $content = ' Test cron job message content';
        Mail::raw($content, function ($message) use ($toEmail, $subject) {
            $message->to($toEmail)->subject($subject);
        });
    }
}
?>

