<?php

namespace Sloveniangooner\NovaPager\Nova;

use Laravel\Nova\Fields\Text;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Panel;
use Sloveniangooner\NovaPager\Nova\Fields\RegionField;
use Sloveniangooner\LocaleAnywhere\Language;

class Region extends TemplateResource
{

    /**
     * Title of the resource
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * Model instance
     *
     * @var string
     */
    public static $model = 'Sloveniangooner\NovaPager\Models\Region';

    /**
     * Whether to display in navigation
     *
     * @var boolean
     */
    public static $displayInNavigation = false;

    /**
     * Type
     *
     * @var string
     */
    protected $type = 'region';

    /**
     * Fields
     *
     * @param Request $request
     * @return void
     */
    public function fields(Request $request)
    {
        // Get base data
        $templateFields = $this->getTemplateFields();

        // Create fields array
        $fields = [
            ID::make()->sortable(),
            Language::make("Language"),
            Text::make('Name', 'name')->rules('required'),
            RegionField::make('Region'),
            new Panel('Region data', $templateFields),
        ];

        return $fields;
    }

    /**
     * Title
     *
     * @return void
     */
    public function title()
    {
        return $this->name;
    }
}
