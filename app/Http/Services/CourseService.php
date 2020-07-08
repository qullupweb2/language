<?php
/**
 * Created by PhpStorm.
 * User: imac
 * Date: 01.11.2018
 * Time: 12:12
 */

namespace App\Http\Services;



use App\Models\Category;
use App\Models\Contract;
use App\Models\Course;
use Carbon\Carbon;
use App\Support\Dates;

class CourseService extends BaseService {

    public function __construct(Course $course) {

        $this->model = $course;

    }

    /**
     * Get all categories of courses
     */
    public function getCategories() {

        return Category::where('online', 0)->get();

    }

    /**
     * Get courses by category
     */
    public function getByCategory($id, $uniq = true) {

        $uniqCourses = [];
        $courses = Course::where('category_id', $id)->where('start_date', '>', Carbon::now())->orderBy('start_date', 'asc')->get();

        foreach ($courses as $course) {

            if(!array_key_exists($course->name, $uniqCourses)) {
                $uniqCourses[$course->name] = $course;
            }

        }

        ksort($uniqCourses);

        if($uniq) {
            return $uniqCourses;
        } else {
            return $courses;
        }



    }

    /**
     * Get courses by category
     */
    public function getByCategoryAll($id, $uniq = true) {

        $uniqCourses = [];
        $courses = Course::where('category_id', $id)->orderBy('start_date', 'asc')->get();

        foreach ($courses as $course) {

            if(!array_key_exists($course->name, $uniqCourses)) {
                $uniqCourses[$course->name] = $course;
            }

        }

        //ksort($uniqCourses);

        if($uniq) {
            return $uniqCourses;
        } else {
            return $courses;
        }



    }

    /**
     * Retruns category of single course
     */
    public function getCategory($id) {
        return Course::find($id)->category();
    }

    /**
     * Returns array courses by name and not expired
     *
     * @return array(Course)
     */
    public function getManyByName($name, $limit = 999) {

        return Course::where('start_date', '>', Carbon::now())->where('name',$name)->where('status', 'open')->orderBy('start_date', 'asc')->limit($limit)->get();
    }

    /**
     * Return next lever course
     *
     * @return Course
     */
    public function getNextLevel($name) {

        $course = Course::where('name',$name)->first();


        $found = false;
        $levels = ['A 1.1','A 1.2','A 2.1','A 2.2','B 1.1','B 1.2','B 2.1','B 2.2','C1-TestDaf'];

        foreach ($levels as $level) {

            if($found) {
                return Course::where('name', $level)->first();
            }

            if($course->name == $level) {
                $found = true;
            }

        }

        return null;

    }

    /**
     * Generate course names for register email
     *
     * @return string
     */
    public static function generateCoursesNames($items)
    {
        $names = '';

        for ($i = 0; $i <= count($items)-1; $i++) {

            $names.= $items[$i]->course()->name;

            if($i !== count($items)-1) $names.=', ';

        }

        return $names;
    }

    /**
     * Generate course dates for register email
     *
     * @return string
     */
    public static function generateCoursesDates($items, $enablehourse = false)
    {


        $course = $items[0]->course();
        
        if(count($items) > 1) {
            $courseLast = $items[count($items)-1]->course();
            $dates = Dates::dateFormat($course->start_date).' - '.Dates::dateFormat($courseLast->end_date);
        } else {
            $dates = Dates::dateFormat($course->start_date).' - '.Dates::dateFormat($course->end_date);
        }
        



        if($enablehourse) {
            return $dates. '<br><u>'.$course->lessons_count.' Unterrichtsstunden pro Woche</u>';
        } else {
            return $dates. '<br><span></span>';
        }
    }

    /**
     * Return lesson count by items
     *
     * @return int
     */
    public static function getLessonCount($items)
    {
        $count = 0;
        foreach ($items as $item) {

            $count = $count+$item->course()->lessons_count;

        }
        return $items[0]->course()->lessons_count;
        return $count;
    }


    /**
     * Generate books from items
     *
     * @return string
     */
    public static function generateBooks($items)
    {
        $books = '';
        if(count($items) > 1) {
            $c = 1;
        } else {
            $c = 0;
        }
        for ($i = 0; $i <= $c; $i++) {

            $course = $items[$i]->course();

            $books.= $course->book;

            if($i !== count($items)-1) $books.=', ';

        }

        return $books;
    }
    /**
     * Return oftens  by items
     *
     * @return string
     */
    public static function generateCoursesOften($items, $needconfirmed = false)
    {
       

        $course = $items[0]->course();

        if($needconfirmed) {
            $how_often = $course->how_often2;
        } else {
            $how_often = $course->how_often;
        }

        return $how_often;
    }

}