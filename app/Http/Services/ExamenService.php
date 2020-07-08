<?php


namespace App\Http\Services;


use App\Examen;
use App\ExamenCat;
use App\ExamenContainer;
use Carbon\Carbon;
use PDF;
use App\User;

class ExamenService extends BaseService
{

    public function __construct(Examen $examen) {

        $this->model = $examen;

    }

    /**
     * Get all categories of courses
     */
    public function getCategories() {

        return Examen::groupBy('name')->get(['id','name','short_description', 'description']);

    }


    /**
     * Get courses by category
     */
    public function getByCategory($id, $uniq = true) {

        $uniqCourses = [];
        $courses = Examen::where('cat_id', $id)->where('start_date', '>', Carbon::now())->orderBy('start_date', 'asc')->get();

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

    public function getCategory($id) {

        return Examen::find($id)->category();

    }

    /**
     * Returns array courses by name and not expired
     *
     * @return array(Course)
     */
    public function getManyByName($name) {

        return Examen::where('start_date', '>', Carbon::now())->where('name',$name)->get();
    }


    public function createContainer($user_id, $exam_id)
    {

        $container = new ExamenContainer();
        $container->user_id = $user_id;
        $container->number = time().$user_id;
        $container->exam_id = $exam_id;
        $container->save();

        return $container;

    }

    /**
     * Create pdf break document
     *
     * @return file_path
     */
    public function createPdfExam($exam, $user, $container_id) {


        $container = ExamenContainer::find($container_id);


        $filepath = storage_path().'/app/exam_serts/'.$container_id.'.pdf';
        $filepath2 = storage_path().'/app/exam_serts/'.$container_id.'_front.pdf';
        PDF::loadView('admin.sert', ['container'=>$container, 'exam'=>$exam, 'user'=>$user])
            ->save($filepath);
        PDF::loadView('admin.sert_front', ['container'=>$container, 'exam'=>$exam, 'user'=>$user])
            ->save($filepath2);

        $this->createExamDocument('Exam#'.$container_id,$container, $filepath, $filepath2);

        return $filepath;

    }

    /**
     * Create pdf exam document for email
     *
     * @return file_path
     */
    public function createPdfExamForMail($exam, $user, $container_id) {


        $container = ExamenContainer::find($container_id);


        $filepath = storage_path().'/app/exam_serts/'.$container_id.'-mail.pdf';
        PDF::loadView('admin.sert_pdf', ['container'=>$container, 'exam'=>$exam, 'user'=>$user])
            ->save($filepath);

        return $filepath;

    }



    /**
     * Create contract document
     *
     * @return void
     */
    public static function createExamDocument($name, $container, $filepath, $filepath2)
    {
        $document = new \App\Models\Document(['name'=>$name, 'exam_id'=>$container->id, 'file_path'=>$filepath, 'file_path_front'=>$filepath2, 'front' => 1]);
        $document->save();
    }

            /**
     * confirm of exam participation
     *
     * @return void
     */
    public function sendConfirmExam($exam_contrainer, $data)
    {


            $filepath = storage_path().'/app/exam_participations/'.$exam_contrainer->id.'.pdf';
            $user = User::find($exam_contrainer->user_id);

            $data['first_name'] = $user->name;
            $data['last_name'] = $user->last_name;
            $data['date'] = $data['date'];
            $data['exam_name'] = $data['exam_name'];

            PDF::loadView('admin.exam_confirmation_pdf', $data)
            ->save($filepath);

            $user->notify(new \App\Notifications\ConfirmExamParticipation($exam_contrainer, $filepath));

            PDF::loadView('admin.exam_confirmation', $data)
            ->save($filepath);

            $this->createExamDocument('ExamParticipation#'.$exam_contrainer->id,$exam_contrainer, $filepath);

       
    }

    public function confirmPaid($exam_contrainer) {
        $exam_contrainer->paid = 1;
        $exam_contrainer->save();
    }

    public function getExamByPassport($pass_data) {

        $user = User::where('passport_number', $pass_data)->first();
        if($user === null) {
            return null;
        }

        $container = ExamenContainer::where('user_id', $user->id)->where('status', 'closed')->first();
        if($container !== null) {
            return $user;
        }
 
    }
}