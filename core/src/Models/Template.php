<?php

namespace MMX\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use MMX\Database\Models\Casts\Serialize;

/**
 * @property int $id
 * @property string $templatename
 * @property int $source
 * @property string $description
 * @property int $category
 * @property string $icon
 * @property string $content
 * @property array $properties
 * @property bool $static
 * @property string $static_file
 *
 * @property-read Resource[] $Resources
 * @property-read TVTemplate[] $TVTemplates
 */
class Template extends Model
{
    use Traits\StaticElement;

    public $timestamps = false;
    protected $table = 'site_templates';
    protected $guarded = ['id'];
    protected $casts = [
        'static' => 'boolean',
        'properties' => Serialize::class,
    ];
    protected string $contentField = 'content';

    public function Resources(): HasMany
    {
        return $this->hasMany(Resource::class, 'template');
    }

    public function TVTemplates(): HasMany
    {
        return $this->hasMany(TVTemplate::class, 'templateid');
    }
}