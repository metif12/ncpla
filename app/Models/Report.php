<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return $this->belongsToMany(Product::class, 'report_inputs')->withPivot(['code'])->withTimestamps();
    }

    public function outputs()
    {
        return $this->belongsToMany(Product::class, 'report_outputs')->withPivot(['code','progress','input_id'])->withTimestamps();
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'report_materials')->withPivot(['value'])->withTimestamps();
    }

    public function interrupts()
    {
        return $this->belongsToMany(Interrupt::class, 'report_interrupts')->withPivot(['length'])->withTimestamps();
    }

    public function confirms()
    {
        return $this->belongsToMany(User::class, 'report_confirms');
    }

    public function performance()
    {
        return $this->progress() / $this->shift->length();
    }

    public function progress()
    {
        return DB::table('report_outputs')->where('report_id', $this->id)->sum('progress');
    }

    public function interrupt()
    {
        return DB::table('report_interrupts')->where('report_id', $this->id)->sum('length');
    }
}
