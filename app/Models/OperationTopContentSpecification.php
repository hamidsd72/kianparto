<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class OperationTopContentSpecification extends Model
{
    protected $table = 'operation_top_contents_specifications';
    
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','photo');
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
            if(count($item->joins))
            {
                foreach ($item->joins as $join)
                {
                    $join->delete();
                }
            }
            if($item->photo)
            {
                if(is_file($item->photo->path))
                {
                    File::delete($item->photo->path);
                }
                $item->photo->delete();
            }
        });
    }

    public function col_name($col_name) {
        $lang   = strtoupper(app()->getLocale());
        $item   = $this->langs()->where('lang', $lang)->where('col_name', $col_name)->first();
        return $item ? $item->text : $this->text;
    }

    public function content(){

        return $this->belongsTo('App\Models\OperationTopContent', 'operation_content_id', 'id');
    }


}