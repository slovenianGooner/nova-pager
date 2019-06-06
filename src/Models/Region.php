<?php

namespace Sloveniangooner\NovaPager\Models;

use Sloveniangooner\NovaPager\NovaPager;
use Sloveniangooner\NovaPager\Traits\HasTranslations;

class Region extends TemplateModel
{
    use HasTranslations;

    /**
     * Define translatable fields as per Spatie
     *
     * @var array
     */
    public $translatable = ["name", "data"];

    /**
     * Constructor method
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTable(NovaPager::getRegionsTableName());
    }
}
