<?php

namespace App\Models;

use App\Observers\ModelCacheObserver;
use App\Traits\Observer\ObserverTrait;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use ObserverTrait;
}
