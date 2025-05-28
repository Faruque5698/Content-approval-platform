<?php

namespace App\Services\Tag;

use Illuminate\Foundation\Http\FormRequest;

interface TagServiceInterface
{
    public function getAllTags(array $data);

    public function storeTag(FormRequest $request);

    public function getTagById($id);

    public function updateTag(FormRequest $request, $id);

    public function delete($id);

    public function getTagDropdownData();
}
