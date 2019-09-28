<?php

namespace App;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasSlug;

    protected $fillable = ['created_at', 'updated_at', 'title', 'slug', 'description', 'small_logo', 'large_logo', 'font_awesome_icon', 'status'];
    
    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
