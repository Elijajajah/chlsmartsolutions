<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Console\Command;
use App\Services\NotificationService;

class CheckTaskExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $expiredTasks = Task::whereDate('expiry_date', '<', $today)->where('status', 'pending')->get();
        $notifier = app(NotificationService::class);

        foreach ($expiredTasks as $task) {
            $task->status = 'missed';
            $task->save();

            $notifier->createNotif(
                $task->user_id,
                'Order Expired',
                "The order {$task->title} has expired.",
                ['technician'],
            );

            $this->info("Task ID {$task->id} has expired.");
        }

        $oneWeekAgo = Carbon::now()->subWeek();

        $overdueTasks = Task::where('status', 'unassigned')
            ->where('created_at', '<=', $oneWeekAgo)
            ->get();

        foreach ($overdueTasks as $task) {
            $task->status = 'overdue';
            $task->save();

            $notifier->createNotif(
                null,
                'Task Overdue',
                "The task '{$task->title}' created by {$task->customer_name} has been marked as overdue.",
                ['cashier', 'admin_officer'],
            );

            $this->info("Task ID {$task->id} has been marked as overdue.");
        }

        $this->info('Checked for expired and overdue tasks.');
    }
}
