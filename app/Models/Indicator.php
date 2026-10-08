<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
    use HasFactory;

    protected $fillable = [
        'competency_id',
        'assessment',
        'code',
        'entry',
        'rate_option',
        'categorical_percentage',
        'link_info',
        'activity_category',
        'percentage_option',
        'participant',
        'activity_year',
    ];

    public function competency()
    {
        return $this->belongsTo(Competency::class);
    }

    public function formAudits()
    {
        return $this->hasMany(FormAudit::class);
    }
}
