<?php

namespace App\Rules;

use App\Models\Contract;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class ValidCourse implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $id)
    {
        //Course form vaildation



            $course = Course::find($id);

            //if course not exist
            if($course === null) {

                return false;

            }

            //if course not available
            if(!$course->available) {

                return false;

            }


            //if course was activated
            if(Auth::check()) {

                $contracts = Contract::where('user_id', Auth::id())->get();

                foreach ($contracts as $contract) {

                    foreach ($contract->items() as $item) {
                        if($item->course_id == $id) {
                            return false;
                        }
                    }


                }


            }

            return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You are already registered for this course.';
    }
}
