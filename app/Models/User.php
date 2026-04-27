<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\Prediction;
use App\Models\Recommendation;
use App\Models\StudentAnalytics;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function examsCreated()
    {
        return $this->hasMany(Exam::class, 'created_by');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class, 'student_id');
    }

    public function analytics()
    {
        return $this->hasOne(StudentAnalytics::class, 'student_id');
    }

    public function predictions()
    {
        return $this->hasMany(Prediction::class, 'student_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'student_id');
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
