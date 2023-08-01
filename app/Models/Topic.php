<?php

namespace App\Models;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'created_at';

    const UPDATED_AT = 'updated_at';

    protected $connection = 'mysql';

    protected $table = 'topics';

    protected $primaryKey = 'id'; 

    protected $keyType = 'int'; 

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'classroom_id',
        'user_id',
    ];


    public function classworks(): HasMany
    {
        return $this->hasMany(Classwork::class , 'topic_id' , 'id');
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class , 'topic_id' , 'id');
    }


    // protected static function booted()
    // {
    //     static::addGlobalScope(new UserClassroomScope);
    // }
}
