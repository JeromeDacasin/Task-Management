<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function scopeStatus($query, $status) {
        return $query->where('status', $status);
    }

    public function scopePriority($query, $priority) {
        return $query->where('priority', $priority);
    }
}
