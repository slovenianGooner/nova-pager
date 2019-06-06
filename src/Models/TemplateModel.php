<?php

namespace Sloveniangooner\NovaPager\Models;

use Illuminate\Database\Eloquent\Model;

class TemplateModel extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['parent_id'];

    /**
     * Casts for the props
     *
     * @var array
     */
    protected $casts = [
        'data' => 'object'
    ];
}
