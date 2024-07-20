<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class JobApplication extends Pivot
{
    use HasFactory;

    CONST statuses = [
        '0' => 'APPLIED',
        '1' => 'VIEWED',
        '2' => 'SHORTLISTED',
        '5' => 'CONTACTED',
        '4' => 'ACCEPTED',
        '-1' => 'REJECTED'
    ];
    
    protected $table = 'job_applications';

    public function getStatus()
    {
        return self::statuses[$this->status];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function job() {
        return $this->belongsTo(Job::class);
    }

}
