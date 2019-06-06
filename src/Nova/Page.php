<?php

namespace Sloveniangooner\NovaPager\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Sloveniangooner\NovaPager\NovaPager;
use Sloveniangooner\NovaPager\Nova\Fields\ParentField;
use Sloveniangooner\NovaPager\Nova\Fields\TemplateField;
use Sloveniangooner\LocaleAnywhere\Language;

class Page extends TemplateResource
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
    public static $model = 'Sloveniangooner\NovaPager\Models\Page';

    /**
     * Display in navigation option
     *
     * @var boolean
     */
    public static $displayInNavigation = false;

    /**
     * Type
     *
     * @var string
     */
    protected $type = 'page';

    /**
     * Fields method
     *
     * @param Request $request
     * @return void
     */
    public function fields(Request $request)
    {
        // Get base data
        $tableName = NovaPager::getPagesTableName();
        $templateClass = $this->getTemplateClass();
        $templateFields = $this->getTemplateFields();

        $fields = [
            ID::make()->sortable(),
            Language::make("Language"),
            Text::make('Name', 'name')->rules('required'),
            Text::make('Slug', 'slug'),
            ParentField::make('Parent', 'parent_id'),
            TemplateField::make('Template', 'template')
        ];

        if (isset($templateClass) && $templateClass::$seo) {
            $fields[] = new Panel('SEO', $this->getSeoFields());
        }

        $fields[] = new Panel('Page data', $templateFields);

        return $fields;
    }

    /**
     * Get SEO fields
     *
     * @return void
     */
    protected function getSeoFields()
    {
        return [
            Heading::make('SEO')->hideFromIndex()->hideWhenCreating()->hideFromDetail(),
            Text::make('SEO Title', 'seo_title')->hideFromIndex()->hideWhenCreating(),
            Text::make('SEO Description', 'seo_description')->hideFromIndex()->hideWhenCreating(),
            Image::make('SEO Image', 'seo_image')->hideFromIndex()->hideWhenCreating()
        ];
    }

    /**
     * Get the title
     *
     * @return void
     */
    public function title()
    {
        return $this->name . ' (' . $this->slug . ')';
    }
}
