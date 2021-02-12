<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function inputs()
    {
        return $this->belongsToMany(Product::class, 'report_inputs')->withPivot(['code']);
    }

    public function outputs()
    {
        return $this->belongsToMany(Product::class, 'report_outputs')->withPivot(['code']);
    }

    public function confirms()
    {
        return $this->belongsToMany(User::class, 'report_confirms');
    }
}
