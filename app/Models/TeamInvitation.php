<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    public $table = 'team_invitation';

    protected $primaryKey = 'team_invitation_id';

    protected $guarded = [];
}
