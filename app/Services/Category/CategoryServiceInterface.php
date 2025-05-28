<?php

namespace App\Services\Category;

use Illuminate\Foundation\Http\FormRequest;

interface CategoryServiceInterface
{
    public function getAllCategories(array $data);

    public function storeCategory(FormRequest $request);

    public function getCategoryById($id);

    public function updateCategory(FormRequest $request, $id);

    public function delete($id);

    public function getCategoryDropdownData();
}
