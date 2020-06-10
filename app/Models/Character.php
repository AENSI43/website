<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'web_characters';

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'valid' => false,
        'active' => false
    ];
}
