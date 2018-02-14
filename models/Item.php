<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string  $name
 * @property integer $show_count
 */
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
}