<?php namespace App\Models;

use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Notifications\Notifiable;
use Str;

class User extends EloquentUser
{

    use Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */

    protected $table = 'users';

    /**
     * The attributes to be fillable from the model.
     *
     * A dirty hack to allow fields to be fillable by calling empty fillable array
     *
     * @var array
     */
    use Taggable;

    protected $fillable = [];
    protected $guarded = ['id'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
    * To allow soft deletes
    */
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return Str::limit($this->first_name . ' ' . $this->last_name, 30);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function usereducation()
    {
        return $this->hasMany('App\Models\Education', 'user_id', 'id');
    }

    public function usercertificate()
    {
        return $this->hasMany('App\Models\Certificate', 'user_id', 'id');
    }

    public function userprofessionalexp()
    {
        return $this->hasOne('App\Models\ProfessionalExperience', 'user_id', 'id');
    }

    public function userprojects()
    {
        return $this->hasMany('App\Models\UserProject', 'user_id', 'id');
    }

    public function useremployers()
    {
        return $this->hasMany('App\Models\Employers', 'user_id', 'id');
    }
}
