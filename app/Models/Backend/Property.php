<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }
}
