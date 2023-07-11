<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    // const CREATED_AT ='created_at';

    // const UPDATED_AT ='updated_at';

    // protected $connection = 'mysql';

    // protected $table = 'topics';

    // protected $primaryKey = 'id'; //default

    // protected $keyType = 'int'; //default

    // public $incrementing = true;

    public $timestamps = false;

    protected $fillable =[
        'name' 
     ];
}
