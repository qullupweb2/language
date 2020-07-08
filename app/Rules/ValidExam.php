<?php

namespace App\Rules;

use App\Examen;
use App\ExamenContainer;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ValidExam implements Rule
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



        $exam = Examen::find($id);

        //if course not exist
        if($exam === null) {

            return false;

        }

        //if course not available
        if(!$exam->available) {

            return false;

        }


        //if course was activated
        if(Auth::check()) {

            $containers = ExamenContainer::where('user_id', Auth::id())->get();

            foreach ($containers as $container) {

                if($container->exam_id == $id) {
                    return false;
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
        return 'You are already registered for this exam.';
    }
}
