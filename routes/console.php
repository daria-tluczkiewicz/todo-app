<?php

use App\Console\Commands\DeleteExpiredSharedTasks;
use App\Console\Commands\SendTaskDueReminder;
use Illuminate\Support\Facades\Schedule;

Schedule::command(SendTaskDueReminder::class)->dailyAt('17:47')->timezone('Europe/Warsaw');

Schedule::command(DeleteExpiredSharedTasks::class)->dailyAt('17:47')->timezone('Europe/Warsaw');
