<?php

namespace App\Models;

use App\Models\BaseModel as Model;

class News extends Model
{
    protected static $_resourceId = 'news';
    
    protected $table = 'news';
    
    protected $fillable = [
        'title',
        'text',
        'category_id',
    ];
    
    public static function tableName()
    {
        return static::$_resourceId;
    }
    
    public static function resourceId()
    {
        return static::$_resourceId;
    }
    
    public function Category()
    {
        return $this->belongsTo( Category::class );
    }
}
