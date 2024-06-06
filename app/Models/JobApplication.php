<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    CONST APPLIED = 0;
    CONST VIEWED = 1;
    CONST SHORTLISTED = 2;
    CONST CONTACTED = 3;
    CONST ACCEPTED = 4;
    CONST REJECTED = -1;
    
    protected $table = 'job_applications';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function job() {
        return $this->belongsTo(Job::class);
    }

}
