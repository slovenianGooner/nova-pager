<?php

namespace Sloveniangooner\NovaPager\Nova;

use Laravel\Nova\Resource;
use Sloveniangooner\NovaPager\NovaPager;

abstract class TemplateResource extends Resource
{

    /**
     * Template class
     *
     * @var [type]
     */
    protected $templateClass;

    /**
     * Get the template class
     *
     * @return void
     */
    protected function getTemplateClass()
    {
        if (isset($this->templateClass)) {
            return $this->templateClass;
        }

        $templates = $this->type === 'page'
            ? NovaPager::getPageTemplates()
            : NovaPager::getRegionTemplates();

        if (isset($this->template)) {
            foreach ($templates as $template) {
                if ($template::$name == $this->template) {
                    $this->templateClass = new $template;
                }
            }
        }

        return $this->templateClass;
    }

    /**
     * Get the template fields
     *
     * @return array
     */
    protected function getTemplateFields(): array
    {
        $templateClass = $this->getTemplateClass();
        if (isset($templateClass)) {
            return $templateClass->_getTemplateFields(request());
        }
        return [];
    }
}
