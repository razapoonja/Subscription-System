<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Notifications\PostCreatedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::with('website')
            ->where('notified', false)
            ->latest()
            ->chunkById(50, function ($posts) {
                foreach ($posts as $post) {
                    Notification::send($post->website->subscribers, new PostCreatedNotification($post));

                    $post->update([
                        'notified' => true
                    ]);
                }
            });

        return Command::SUCCESS;
    }
}
