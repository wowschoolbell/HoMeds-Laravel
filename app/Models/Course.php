<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'text_languages', 'course_items', 'benefits', 'curriculum',
        'category_id', 'related_courses', 'user_id', 'sub_category_id', 'status'
    ];

    protected $casts = [
        'curriculum' => 'array',
    ];

    const APPROVED  = 'A';
    const PENDING   = 'P';

    public static $status = [Self::APPROVED => 'APPROVED' , Self::PENDING => 'PENDING'];

    public function Category()
    {
        return $this->belongsTo('App\Models\CourseCategory', 'category_id');
    }

    public function SubCategory()
    {
        return $this->belongsTo('App\Models\SubCourseCategory', 'sub_category_id');
    }

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public static function coursesCountBasedOnSubCategory($subCourseCategoryId)
    {
        return app('firebase.firestore')->database()->collection('courses')
            ->where('sub_category_id', '==', $subCourseCategoryId)->documents();
    }
}
