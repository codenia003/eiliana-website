<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MilestoneWisePayment extends Model
{
    public $table = 'milestone_wise_project_payment';
    protected $primaryKey = 'milestone_payment_id';
}
