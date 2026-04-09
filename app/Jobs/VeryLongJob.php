<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewArticleNotification;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle(): void
    {
        // Отправляем письмо модератору
        $moderator = User::whereHas('role', function($q) {
            $q->where('slug', 'moderator');
        })->first();

        if ($moderator && $moderator->email) {
            Mail::to($moderator->email)->send(new NewArticleNotification($this->article));
        }
    }
}
