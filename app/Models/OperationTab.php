<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class OperationTab extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }
    public function joins()
    {
        return $this->hasMany('App\Models\OperationJoin', 'operation_id');
    }
    public function photo()
    {
        return $this->morphOne('App\Models\Photo', 'pictures')->where('status','active')->where('type','photo');
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

    public function operation_cat(){

        return $this->belongsTo(OperationCat::class);
    }


}