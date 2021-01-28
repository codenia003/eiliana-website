<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalExperience extends Model
{
    protected $table = 'professional_experience';

    protected $primaryKey = 'professional_experience_id';

    protected $guarded = [];

    public function setModelEngagementAttribute($value)
    {
        $this->attributes['model_engagement'] = json_encode($value);
    }

    public function currentlocation()
    {
        return $this->belongsTo('App\Models\Location', 'current_location', 'location_id');
    }

    public function preferredlocation()
    {
        return $this->belongsTo('App\Models\Location', 'preferred_location', 'location_id');
    }
}
