<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskMaterial extends Model
{
    use HasFactory;

    protected $table = 'task_materials';

    protected $guarded = ['id'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
