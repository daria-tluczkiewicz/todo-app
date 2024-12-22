<?php

namespace App\Console\Commands;

use App\Mail\TaskDueReminder;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTaskDueReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-due-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder one day before the task is due';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $tasks = Task::where('date_due', Carbon::tomorrow()->toDateString())->get();

      foreach ($tasks as $task) {
        var_dump($task->title, $task->user->email);
        Mail::to($task->user->email)->send(new TaskDueReminder($task));
      }

      $this->info('Task due reminder emails have been sent.');
    }
}
