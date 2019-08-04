<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpressionModel extends Model
{
    protected $table = "expressions";
    public $timestamps = true;

    protected $fillable = [
        'expression',
        'result'
    ];
}
