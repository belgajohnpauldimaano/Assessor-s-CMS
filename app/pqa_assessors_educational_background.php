<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pqa_assessors_educational_background extends Model
{
    public $timestamps = false;
    protected $table = 'pqa_assessors_educational_background';

    public function assessors ()
    {
                                                            // local to educ, from parent or assessor_info
        return $this->belongsTo(pqa_assessors_info::class, 'assessors_ID', 'assessors_ID');
    }
}
