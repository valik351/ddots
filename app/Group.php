<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'description'];

    public static function getValidationRules(){
        return [
            'name' => 'required|max:255|alpha_dash',
            'description' => 'max:255|alpha_dash',
        ];
    }

    public static function sortable($list = false)
    {
        $columns = [
            'id', 'name'
        ];

        return ($list ? implode(",", $columns) : $columns);
    }
    
    public function users(){
        return $this->belongsToMany(User::class, 'group_user', 'group_id')->withTimestamps();
    }
}