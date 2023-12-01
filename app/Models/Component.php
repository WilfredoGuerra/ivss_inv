<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'serial',
        'asset_number',
        'categories_id',
        'brands_id',
        'departments_id',
        'locations_id',
        'states_id',
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'categories_id');
    }
    public function brands(){
        return $this->belongsTo(Brand::class, 'brands_id');
    }
    public function departments(){
        return $this->belongsTo(Department::class, 'departments_id');
    }
    public function locations(){
        return $this->belongsTo(Location::class, 'locations_id');
    }
    public function states(){
        return $this->belongsTo(State::class, 'states_id');
    }
}
