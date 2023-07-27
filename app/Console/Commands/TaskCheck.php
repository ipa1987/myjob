<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\TrialEndNotification;
use Illuminate\Support\Facades\Mail;

class TaskCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trial:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to check user trial expiry date';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $users = User::whereNotNull('user_trial')->get();
            $today = Carbon::today('Europe/London');
            foreach ($users as $user) {
                $trialEnd = Carbon::parse($user->user_trial);
    
                if ($trialEnd->isSameDay($today)) {
                    Mail::to($user->email)->send(new TrialEndNotification($user->name));
                    $this->info('Trial ended email sent to: ' .$user->email);
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
