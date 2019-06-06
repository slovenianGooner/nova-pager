<?php

namespace Sloveniangooner\NovaPager\Nova\Fields;

use Laravel\Nova\Fields\Field;
use Sloveniangooner\NovaPager\NovaPager;
use Sloveniangooner\NovaPager\Models\Page;
use Sloveniangooner\NovaPager\Models\Region;

class TemplateField extends Field
{
    /**
     * Component
     *
     * @var string
     */
    public $component = 'template-field';

    /**
     * Constructor method
     *
     * @param [type] $name
     * @param [type] $attribute
     * @param [type] $resolveCallback
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $resourceName = rtrim(request()->route('resource'), 's');

        $templates = collect(NovaPager::getTemplates())
            ->filter(function ($template) use ($resourceName) {
                return $template::$type === $resourceName;
            })
            ->map(function ($template) {
                return [
                    'label' => $template::$name,
                    'value' => $template::$name
                ];
            });

        $this->withMeta([
            'asHtml' => true,
            'templates' => $templates,
            'resourceTemplates' => collect(Page::all(), Region::all())->flatten()->pluck('template', 'id')
        ]);

        $templates = array_map(function ($template) {
            return $template::$name;
        }, NovaPager::getTemplates());
        $this->rules('required', 'in:' . implode(',', $templates));
    }
}
