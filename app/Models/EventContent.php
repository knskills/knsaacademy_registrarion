<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventContent extends Model
{
    use HasFactory;

    /**
     * Mass assignable
     * @var array
     */
    protected $fillable = [
        'event_id',
        'title',
        'contanor1_heading',
        'contanor1_sub_heading',
        'contanor1_col1_contant_type',
        'contanor1_col1_contant',
        'contanor2_heading',
        'contanor2_sub_heading',
        'contanor2_data',
        'contanor3_heading',
        'contanor3_sub_heading',
        'contanor3_data',
        'contanor4_heading',
        'contanor4_sub_heading',
        'contanor4_data',
        'contanor5_heading',
        'contanor5_sub_heading',
        'contanor5_data',
        'contanor6_heading',
        'contanor6_sub_heading',
        'contanor6_data',
        'trainer_heading',
        'trainer_sub_heading',
        'trainer_data',
        'bonus_heading',
        'bonus_sub_heading',
        'bonus_price',
        'bonus_data',
        'learn_heading',
        'learn_sub_heading',
        'learn_data',
        'achivers_heading',
        'achivers_sub_heading',
        'achivers_paragraph',
        'achivers_data',
        'review_heading',
        'review_sub_heading',
        'review_paragraph',
        'review_data',
    ];

    /**
     * Casts
     * @var array
     */
    protected $casts = [
        'contanor2_data' => 'array',
    ];

    /**
     * Get Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
