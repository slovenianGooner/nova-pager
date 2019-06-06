<?php

namespace Sloveniangooner\NovaPager\Traits;

use Sloveniangooner\LocaleAnywhere\HasTranslations as LocaleAnywhereTrait;

trait HasTranslations
{
    use LocaleAnywhereTrait {}

    /**
     * Set the attribute
     *
     * @param [type] $key
     * @param [type] $value
     * @return void
     */
    public function setAttribute($key, $value)
    {
        if (str_contains($key, "data->")) {
            $key = str_replace("data->", "", $key);
            return parent::setAttribute("data->".$this->getLocale()."->".$key, $value);
        }

        // Pass arrays and untranslatable attributes to the parent method.
        if (! $this->isTranslatableAttribute($key) || is_array($value)) {
            return parent::setAttribute($key, $value);
        }

        // If the attribute is translatable and not already translated, set a
        // translation for the current app locale.
        return $this->setTranslation($key, $this->getLocale(), $value);
    }

    /**
     * Get data from the database
     *
     * @return void
     */
    public function getDataAttribute()
    {
        $data = json_decode($this->attributes["data"]);
        return $data->{app()->getLocale()};
    }
}
