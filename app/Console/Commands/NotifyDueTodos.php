<?php

namespace App\Console\Commands;

use App\Models\Todo;
use App\Notifications\TodoDueNotification;
use Illuminate\Console\Command;

class NotifyDueTodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'todos:notify-due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '期限が近いTodoの通知を送信する';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $todos = Todo::query()
            ->where('is_complete', false)
            ->whereBetween('due_date', [today(), today()->addDay()])
            ->with('user')
            ->get();

        foreach($todos as $todo) {
            $todo->user->notify(new TodoDueNotification($todo));
        }

        $this->info("{$todos->count()}件の通知を送信しました。");
    }
}
