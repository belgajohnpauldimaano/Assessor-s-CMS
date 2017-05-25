<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class pqa_assessors_info extends Authenticatable
{
    public $timestamps = false;
    protected $table = 'pqa_assessors_info';
    protected $primaryKey = 'assessors_ID';

    public function educations ()
    {
        return $this->hasMany(pqa_assessors_educational_background::class, 'assessors_ID', 'assessors_ID');
    }

    public function trainings ()
    {
        return $this->hasMany(pqa_assessors_trainings::class, 'assessors_ID', 'assessors_ID');
    }
    
    public function details ()
    {
        return $this->hasOne(pqa_assessors_detail::class, 'assessors_ID', 'assessors_ID');
    }
    
    public function setAttribute($key, $value)
  	{
    	$isRememberTokenAttribute = $key == $this->getRememberTokenName();
    	if (!$isRememberTokenAttribute)
   	 	{
     		parent::setAttribute($key, $value);
    	}
  	}
}
