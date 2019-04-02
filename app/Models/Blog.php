<?php

namespace App\Models;


class Blog extends BaseModel
{
    protected $fillable = ['user_id','title','content','blog_thumbnail','age_limit', 'gender_limit'];

}
