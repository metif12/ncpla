<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function task_attributes()
    {
        return $this->hasMany(TaskAttribute::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function progress()
    {
//        return 45;
        $required = $this->task_attributes()->where('name', $this->line->progress_attribute)->value('value');
        $done = DB::table('report_outputs')->whereIn('report_id', $this->reports()->pluck('id'))->sum('progress');

        return intval(($done/$required)*100);
    }
}
