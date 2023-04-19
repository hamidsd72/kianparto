<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class OperationTopContent extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function langs()
    {
        return $this->morphMany('App\Models\Lang', 'langs');
    }
    public function col_name($col_name) {
        $lang   = strtoupper(app()->getLocale());
        $item   = $this->langs()->where('lang', $lang)->where('col_name', $col_name)->first();
        return $item ? $item->text : $this->text;
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

    public function allSpecifications(){
        return $this->hasMany('App\Models\OperationTopContentSpecification', 'operation_content_id');
    }

    public function specifications(){
        return $this->hasMany('App\Models\OperationTopContentSpecification', 'operation_content_id')->where('type', 'specification');
    }

    public function versions(){
        return $this->hasMany('App\Models\OperationTopContentSpecification', 'operation_content_id')->where('type', 'version');
    }

    public function accessoriess(){
        return $this->hasMany('App\Models\OperationTopContentSpecification', 'operation_content_id')->where('type', 'accessories');
    }

}