<?php

namespace App\Traits\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    private function processData(FormRequest $request,$method = 'create')
    {
        $data = $request->validated();
        if ($method === 'create') {
            $data['password'] = Hash::make($data['password']);
            $data['created_at'] = now();
        } elseif ($method === 'update') {
            $data['updated_at'] = now();
            unset($data['password']);
        }

        return $data;
    }

}
