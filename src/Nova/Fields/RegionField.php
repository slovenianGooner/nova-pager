<?php

namespace Sloveniangooner\NovaPager\Nova\Fields;

use Laravel\Nova\Fields\Field;
use Sloveniangooner\NovaPager\Models\Region;
use Sloveniangooner\NovaPager\NovaPager;

class RegionField extends Field
{
    /**
     * Component
     *
     * @var string
     */
    public $component = 'region-field';

    /**
     * Constructor method
     *
     * @param [type] $name
     * @param [type] $attribute
     * @param [type] $resolveCallback
     */
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, 'template', $resolveCallback);
    }

    /**
     * Resolve the field
     *
     * @param [type] $resource
     * @param [type] $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);

        $regions = $this->getAvailableRegions($resource);

        $this->withMeta([
            'asHtml' => true,
            'regions' => $regions,
            'existingRegions' => Region::all()->pluck('template', 'id'),
        ]);

        $regionsTableName = NovaPager::getRegionsTableName();
        $locale = request()->get('locale');
        $this->rules('required', "unique:$regionsTableName,template,{{resourceId}},id");
    }

    /**
     * Get available regions
     *
     * @param Region $region
     * @return array
     */
    public function getAvailableRegions(Region $region = null): array
    {
        if (isset($region) && isset($region->id) && isset($region->template)) {
            return [$region->template];
        }

        return collect(NovaPager::getRegionTemplates())
            ->filter(function ($template) {
                return !Region::where('template', $template::$name)->exists();
            })
            ->map(function ($template) {
                return $template::$name;
            })
            ->toArray();
    }
}
