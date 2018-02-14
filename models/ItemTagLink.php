<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ItemTagLink extends Model
{
    /**
     * @var string
     */
    protected $table = 'item_tag_link';

    public $timestamps = false;

    /**
     * Атрибуты, для которых запрещено массовое назначение.
     *
     * @var array
     */
    protected $guarded = [];
}