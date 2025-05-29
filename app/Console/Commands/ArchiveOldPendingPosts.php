<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Console\Command;

class ArchiveOldPendingPosts extends Command
{
    protected $signature = 'posts:archive';
    protected $description = 'Archive posts which are pending for more than 3 days';

    protected $postRepo;

    public function __construct(PostRepositoryInterface $postRepo)
    {
        parent::__construct();
        $this->postRepo = $postRepo;
    }

    public function handle()
    {
        $count = $this->postRepo->archiveOldPendingPosts();
        $this->info("Archived {$count} posts which were pending for more than 3 days.");
    }

}
