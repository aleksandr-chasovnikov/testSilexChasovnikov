<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ItemTagLink extends Model
{
    /**
     * @var string
     */
    protected $table = 'item_tag_link';

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Атрибуты, для которых запрещено массовое назначение.
     *
     * @var array
     */
    protected $guarded = [];
}