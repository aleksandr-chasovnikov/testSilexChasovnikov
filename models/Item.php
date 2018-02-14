<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Item extends Model
{
    /**
     * @var string
     */
    protected $table = 'item';

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
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'item_tag_link',
            'item_id',
            'tag_id'
        );
    }
}