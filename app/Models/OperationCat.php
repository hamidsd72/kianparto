<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
class OperationCat extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];


    public function joins()
    {
        return $this->hasMany('App\Models\OperationJoin', 'operation_id');
    }
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

    public function sliders()
    {
        return $this->hasMany('App\Models\OperationSlider', 'operation_cat_id')->where('status','active')->orderBy('sort', 'ASC');
    }
    public function articles()
    {
        return $this->hasMany('App\Models\OperationArticle', 'operation_cat_id')->where('status','active');
    }  public function topContents()
    {
        return $this->hasMany('App\Models\OperationTopContent', 'operation_cat_id')->where('status','active');
    }
    public function tabs()
    {
        return $this->hasMany('App\Models\OperationTab', 'operation_cat_id')->where('status','active');
    }

    public function stories()
    {
        return $this->hasMany('App\Models\OperationStory', 'operation_cat_id')->where('status','active');
    }

    public function faqs()
    {
        return $this->hasMany('App\Models\OperationFaq', 'operation_cat_id')->where('status','active');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\OperationComment', 'operation_cat_id')->where('status','active');
    }
    public function contents()
    {
        return $this->hasMany('App\Models\OperationTopContent', 'operation_cat_id')->where('status','active');
    }
    public function getBeforeAndAfterStories(){

        return $this->stories()->where('type','B/A Photos')->first()?? 0;

    }

    public function children(){

        return $this->hasMany(OperationCat::class, 'parent_id');
    }


}