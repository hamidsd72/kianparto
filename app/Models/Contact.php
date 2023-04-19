<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Contact extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public static function expload_function($item)
    {
        $items=explode(',',$item);
        return $items;
    }

    public function col_name($col_name) {
        $lang   = strtoupper(app()->getLocale());
        $item   = $this->langs()->where('lang', $lang)->where('col_name', $col_name)->first();
        return $item ? $item->text : $this->text;
    }
    
    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($item) {
            if(count($item->langs))
            {
                foreach ($item->langs as $lang)
                {
                    $lang->delete();
                }
            }

        });
    }
}