<?php

namespace App\Console\Commands;

use App\Models\SharedTask;
use Illuminate\Console\Command;

class DeleteExpiredSharedTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-expired-shared-tasks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes tasks shared more than 24 hours ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        SharedTask::where('created_at', '<', now()->subDay())->delete();

      $this->info('Expired shared tasks have been deleted.');

    }
}
