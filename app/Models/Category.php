<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class Category extends Model
{
    protected $fillable = [
        'title',
    ];
    
    protected static $_resourceId = 'category';
    
    protected $table = 'category';
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    public static function tableName()
    {
        return static::$_resourceId;
    }
    
    public static function resourceId()
    {
        return static::$_resourceId;
    }
}
