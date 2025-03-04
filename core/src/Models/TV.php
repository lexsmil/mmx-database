<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use MMX\Database\Models\Casts\Serialize;

/**
 * @property int $id
 * @property int $source
 * @property string $type
 * @property string $name
 * @property string $caption
 * @property string $description
 * @property int $category
 * @property string $display
 * @property string $default_text
 * @property array $properties
 * @property array $input_properties
 * @property array $output_properties
 * @property bool $static
 * @property string $static_file
 *
 * @property-read Resource $Resources
 * @property-read TVResource $ResourceValues
 */
class TV extends Model
{
    use Traits\StaticElement;

    public $timestamps = false;
    protected $table = 'site_tmplvars';
    protected $guarded = ['id'];
    protected $casts = [
        'active' => 'bool',
        'properties' => Serialize::class,
        'input_properties' => Serialize::class,
        'output_properties' => Serialize::class,
        'static' => 'bool',
    ];
    protected string $contentField = 'default_text';

    public function ResourceValues(): HasMany
    {
        return $this->hasMany(TVResource::class, 'tmplvarid');
    }

    public function Resources(): HasManyThrough
    {
        return $this->HasManyThrough(Resource::class, TVResource::class, 'tmplvarid', 'id', 'id', 'contentid');
    }
}