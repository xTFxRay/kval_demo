<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'buildID',
        'userID',
        'specification',
        'value'
    ];

    public function build()
    {
        return $this->belongsTo(Build::class, 'buildID');
    }
}
