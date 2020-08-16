<?php

namespace App\Console\Commands;

use App\{User, Post};
use App\Mail\PostPublishedNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class PostPublishedEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:published';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Users about the new post published';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::subscriber()->get();
        $posts = Post::unnotified()->get();
        
        $bar = $this->output->createProgressBar($users->count() * $posts->count());
        
        $this->info("Sending notifications for  {$posts->count()} Posts!");

        $bar->start();
        $posts->each(function ($post) use ($users, $bar) {
            foreach($users as $subscriber) {
                Mail::to($subscriber)
                    ->send(new PostPublishedNotification($post));

                $post->update(['notified' => true]);
                $bar->advance();
            }
        });
        $bar->finish();

    }
}
