<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }
    // user 

    public function user()
    {
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }
}
