<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property integer   $id
 * @property string    $name
 *
 * @property Item[]    $items
 */
class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tag';

    public $timestamps = false;

    /**
     * Атрибуты, для которых запрещено массовое назначение.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(
            Item::class,
            'item_tag_link',
            'tag_id',
            'item_id'
        );
    }
}