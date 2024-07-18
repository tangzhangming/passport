<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;


use Intervention\Image\Laravel\Facades\Image;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            exit('创建用户');
        });
        static::updated(function ($user) {
            $events = [];

            if( $user->isDirty('name') ){
                $events[] = 'update.name';
            }
            if( $user->isDirty('avatar') ){
                $events[] = 'update.avatar';
            }

            if( count($events) > 0 ){
                \App\Jobs\UserEventPush::dispatch($user, $events);
            }
        });
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    /**
     * 设置头像
     * 本初不控制头像源文件
     */
    public function setProfilePicture(\Illuminate\Http\UploadedFile $file)
    {
        $image = Image::read( $file->getPathName() );
        $image->scale(300, 300);
        $file = $image->toWebp()->toString();

        $storage = Storage::disk('public');
        // 不同用户相同的头像只保存一份 md5 + size 来减少可能发生的hash碰撞 
        // $dir = sprintf('picture/%s/%s%s', date('Y'), date('m'), date('d'));
        $dir = 'picture';
        $asname = sprintf('%s_%s.webp', md5($file), strlen($file));
        $path = string_storege_as($storage, $dir, $file, $asname);

        return $this->avatar = $storage->url($path);
    }
}
