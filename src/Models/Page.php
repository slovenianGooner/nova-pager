<?php

namespace Sloveniangooner\NovaPager\Models;

use Sloveniangooner\NovaPager\NovaPager;
use Sloveniangooner\NovaPager\Traits\HasTranslations;

class Page extends TemplateModel
{
    use HasTranslations;

    /**
     * Set translatable fields as per Spatie's docs
     *
     * @var array
     */
    public $translatable = ["name", "slug", "seo_title", "seo_description", "data"];

    /**
     * Define if we should use fallback or not
     *
     * @var boolean
     */
    public $useFallback = true;
    
    /**
     * Constructor method
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(NovaPager::getPagesTableName());
    }

    /**
     * Get slug of the page - based on slugsRepo config option on the frontend
     *
     * @return void
     */
    public function getSlug($slugs)
    {
        if (isset($slugs[$this->id])) {
            return $slugs[$this->id];
        }

        return "/";
    }

    /**
     * Get parent relationship
     *
     * @return void
     */
    public function parent()
    {
        return $this->belongsTo(Page::class);
    }
}
