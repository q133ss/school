<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'phone',
        'lang',
        'target',
        'avg_rate',
        'percent',
        'main_course'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'target' => 'array',
        ];
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function students(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'student_teacher', 'teacher_id', 'student_id');
    }

    public function isStudent(int $student_id): bool
    {
        return DB::table('student_teacher')
        ->where('student_id', $student_id)
        ->where('teacher_id', $this->id)
        ->exists();
    }

    public function homework()
    {
        return $this->hasMany(Homework::class, 'student_id', 'id')
            ->where('teacher_id', Auth()->guard('sanctum')->id());
    }

    public function teacherLessons()
    {
        return $this->hasMany(Lesson::class, 'teacher_id', 'id');
    }

    public function scopeWithFilter($query, Request $request)
    {
        return $query->when(
            $request->query('role_id'),
            function (Builder $query, $role_id) {
                return $query->where('role_id', $role_id);
            }
        );
    }
}
