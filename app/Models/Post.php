<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    //Hides the title from the JsonResponse
    // protected $hidden = [
    //     'title'
    // ];

    protected $fillable = [
        'title',
        'body'
    ];

    //The opposite of $fillable
    // protected $guarded = [
    //     'title',
    //     'body'
    // ];
    
    protected $casts = [
        'body' => 'array',
    ];

    //implements accesor or mutator and adds the treated attribute to the JsonResponse
    // protected $appends = [
    //     'title_upper_case'
    // ];


    /**
    * Accessors and mutators transform values when we retrieve/set model attributes. 
    */
    //Accessor
    public function getTitleUpperCaseAttribute()
    {
        return strtoupper($this->title);
    }

    //Mutator
    public function setTitleAttribute($value){
        $this->attributes['title'] = strtolower($value);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id');
    }
}
