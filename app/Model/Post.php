<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{

    protected $connection = 'wordpress_db';    
    protected $table = 'posts';
    protected $primaryKey = 'ID';
    
    // adding a global scoope in yoour post model
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('post_type', function (Builder $builder) {
            $builder->where('post_type','post');
            
        });
    }

} 
