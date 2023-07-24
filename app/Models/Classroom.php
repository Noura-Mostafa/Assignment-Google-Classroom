<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    
    public static string $disk = 'uploads';

    protected $fillable =[
       'name' , 'section' , 'subject' , 'room' , 'theme' , 'cover_image_path' , 'code'
    ];
    

    public function getRouteKeyName()
    {
        return 'id';
    }

    public static function uploadCoverImage($file)
    {
        $path = $file->store('/covers', [
            'disk' => static::$disk,
        ]);

        return $path;
    }

    public static function deleteCoverImage($path)
    {
        return Storage::disk(Classroom::$disk)->delete($path);
    }}
