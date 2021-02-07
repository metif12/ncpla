<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAttribute extends Model
{
    use HasFactory;

    protected $table = 'task_attributes';

    protected $guarded = ['id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }
}
