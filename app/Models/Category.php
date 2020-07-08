<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $casts = [
        'prices' => 'json',
        'short_description' => 'json',
    ];
    public $timestamps = false;

    /**
     * Метод возвращает объекты категории
     *
     * @return models
     */
    public function courses() {
        return $this->hasMany('App\Models\Course');
    }

	public function CourseMainStartDate() {
		$uniqCourses = $this->uniqCourses();

		if($uniqCourses) {
			ksort($uniqCourses);
			foreach ($uniqCourses as $uniq_c) foreach ($uniq_c->similars() as $u_c) return $u_c->start_date;
		}
	}

    public function uniqCourses()
    {
        $uniq = true;
        $uniqCourses = [];
        $courses = Course::where('category_id', $this->id)->where('start_date', '>', Carbon::now())->orderBy('name', 'asc')->get();

        foreach ($courses as $course) {

            if(!array_key_exists($course->name, $uniqCourses)) {
                $uniqCourses[$course->name] = $course;
            }

        }


        if($uniq) {
            //ksort($uniqCourses);
            return $uniqCourses;
        } else {
            return $courses;
        }
    }


    public function fisrtCourse()
    {
        
        $course = Course::where('category_id', $this->id)->where('start_date', '>', Carbon::now())->orderBy('id', 'desc')->first();
        return $course;
        
    }
}
