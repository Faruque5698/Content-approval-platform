<?php

namespace App\Repositories\Contracts;

interface TagRepositoryInterface extends RepositoryInterface
{
    public function getTagDropdownData();
}
