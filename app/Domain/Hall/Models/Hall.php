<?php

namespace Domain\Hall\Models;

use Domain\Hall\Models\Concerns\HasEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
    use HasFactory;
    use HasEvent;

    protected $guarded = [];
}
