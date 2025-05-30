<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function categoryAdd($data, $id);
    public function tagAdd($data, $id);
    public function trashList(array $data = []);
    public function trashRestore($id);
    public function forceDelete($id);
    public function archivedList(array $data = []);
    public function archive($id);
    public function archiveRestore($id);
    public function findOnlyTrashed($id);
    public function updateStatus($id, $status);
    public function archiveOldPendingPosts(): int;
    public function getAllApprovedPosts($data);
    public function getPostBySlug($slug);
}
