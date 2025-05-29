<?php

namespace App\Jobs;

use App\Mail\PostStatusMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;


class SendPostStatusEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $post;

    public function __construct($user, $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function handle(): void
    {
        Mail::to($this->user->email)->send(new PostStatusMail($this->user, $this->post));
    }
}
