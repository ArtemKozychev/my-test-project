<?php

namespace Domain\Callboard\Models;

use Domain\Callboard\Models\Concerns\HasEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callboard extends Model
{
    use HasFactory;
    use HasEvent;

    protected $guarded = [];

    protected $casts = [
        'is_publish' => 'boolean'
    ];

    public function isPublished(): bool
    {
        return $this->is_publish;
    }
}
