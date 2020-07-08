<?php

namespace App\Http\Controllers;

use App\ExamenDoctorListen;
use App\ExamenDoctorStage3;
use App\ExamenDoctorAnswer;
use App\ExamenOral;
use Illuminate\Http\Request;
use App\Models\ExamenTest;
use App\Models\ExamenSession;
use Carbon\Carbon;
use App\Test;
use App\ExamenDoctorQuestions;
use App\User;
use App\ExamenContainer;
use Mail;

class ExamenController extends Controller
{
    public function start($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        $examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();
        return view('newpages.startExam', ['examen' => $examen, 'oral' => null]);
    }

    public function startOral($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        $examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();
        return view('newpages.startExam', ['examen' => $examen, 'oral' => '1']);
    }

    public function startForm($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        $examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();
        $examenContainer = ExamenSession::where('user_email', request('email'))->where('exam_id', $examen->examen2_id)->first();
        $examenContainer2 = ExamenSession::where('user_email', request('email'))->where('exam_id', $examen->examen_id)->first();

        //Определяем есть ли у пользователя экзамен
        $user = User::where('email', request('email'))->first();
        if($user === null) dd('User with your E-mail not found');

        $examC = ExamenContainer::where('user_id', $user->id)->where('exam_id', $examen->examen2_id)->first();
        $examC2 = ExamenContainer::where('user_id', $user->id)->where('exam_id', $examen->examen_id)->first();

        if($examC === null && $examC2 === null) die('You must to be register to this exam');
        if(
        	($examC2 !== null && $user->status != 'paid' && $user->status != 'prepaid' && $user->status != 'cash_paid' && $user->status != 'cash_pre_paid')
			||
			($examC !== null && $examC['paid'] == 0)
		) {
			die('You did not pay for this exam');
		}

        if($examenContainer !== null || $examenContainer2 !== null) {
            if ($examenContainer['step_exam'] === 0 || $examenContainer2['step_exam'] === 0) die('Der Fehler. Sie haben die Prüfung bereits bestanden.');
            else {
				if($examC === null) {
					session(['examen_container' => $examC2->id]);
				} else {
					session(['examen_container' => $examC->id]);
				}

				session(['email' => request('email')]);
				session(['session_id' => ($examenContainer['id'] ? $examenContainer['id'] : $examenContainer2['id'])]);
				session(['step'=> ($examenContainer['step_exam'] ? $examenContainer['step_exam'] : $examenContainer2['step_exam'])]);

				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
		} else {
			$this->newExamenSession($examC, $examC2, $examen);

			if ($exam_lvl == 'Prüfung für Ärzte') {
				$doctor_email = ExamenDoctorAnswer::where('user_email', request('email'))->get();

				if(empty($doctor_email->id)) {
					$doctors_answer = new ExamenDoctorAnswer;
					$doctors_answer->user_email = $examenContainer->user_email;
					$doctors_answer->save();
				}
				else die('Der Fehler. Sie haben die Prüfung Doctor bereits bestanden.');
			}

			return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
        }
    }

    public function startFormOral($locale = 'de', $exam_lvl = 'none', $oral = 'oral') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        $examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();
        $examenContainer = ExamenSession::where('user_email', request('email'))->where('exam_id', $examen->examen2_id)->where('type','oral')->first();
        $examenContainer2 = ExamenSession::where('user_email', request('email'))->where('exam_id', $examen->examen_id)->where('type','oral')->first();

        //Определяем есть ли у пользователя экзамен
        $user = User::where('email', request('email'))->first();
        if($user === null) dd('User with your E-mail not found');

        $examC = ExamenContainer::where('user_id', $user->id)->where('exam_id', $examen->examen2_id)->first();
        $examC2 = ExamenContainer::where('user_id', $user->id)->where('exam_id', $examen->examen_id)->first();

        if($examC === null && $examC2 === null) dd('You must to be register to this exam');

        if($examenContainer !== null || $examenContainer2 !== null) {
            if ($examenContainer['step_exam'] === 0 || $examenContainer2['step_exam'] === 0) die('Der Fehler. Sie haben die Prüfung bereits bestanden.');
            else {
				if($examC === null) {
					session(['examen_oral_container' => $examC2->id]);
				} else {
					session(['examen_oral_container' => $examC->id]);
				}

				session(['email' => request('email')]);
				session(['session_id' => ($examenContainer['id'] ? $examenContainer['id'] : $examenContainer2['id'])]);
				session(['step_oral' => ($examenContainer['step_exam'] ? $examenContainer['step_exam'] : $examenContainer2['step_exam'])]);

				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl . '/oral');
			}
		} else {
			
			$this->newExamenSession($examC, $examC2, $examen, true);
			return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl . '/oral');
        }
    }

    private function newExamenSession($examC, $examC2, $examen, $oral = false) {
		$examenContainer = new ExamenSession();
		if($oral) {
			$examenContainer->type = 'oral';
		}
		$examenContainer->user_email = request('email');
		$examenContainer->end_at = Carbon::now()->addMinutes($examen->duration);
		if ($examC === null) {
			$examenContainer->exam_id = $examen->examen_id;
		} else {
			$examenContainer->exam_id = $examen->examen2_id;
		}

		$examenContainer->save();

		if($examC === null) {
			session(['examen_container' => $examC2->id]);
		} else {
			session(['examen_container' => $examC->id]);
		}

		session(['email' => request('email')]);
		session(['session_id' => $examenContainer->id]);
		session(['step'=> 1]);
	}

    public function processingExam($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        if(session()->has('session_id') && session()->has('step')) {

			$examen_type = 'base';
			if($exam_lvl == 'Prüfung für Ärzte') $examen_type = 'doctors';

            $examenContainer = ExamenSession::findOrFail(session('session_id'));
            $examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();

            if($examenContainer->end_at < Carbon::now()) {
                return redirect(trim_locale(app()->getLocale()).'/finish_exam');
            }
            
            $timeleft = Carbon::parse($examenContainer->end_at)->diffInSeconds(Carbon::now());

            $text_final = "";
			$questions_listen = $questions = $stage1 = $stage3 = $test = $test_oral = false;

			if ($examen_type == 'doctors') $test = false;

            if(session('step') == 1) {
                if ($examen_type == 'base') $test = Test::find($examen->basic_test_id);
                if ($examen_type == 'doctors') {
                	$questions = ExamenDoctorQuestions::where('stage', 1)->get();

					$stage1 = ExamenDoctorStage3::where('stage', 1)->get();
					$timeleft = $stage1[0]->time*60;
				}
            }

            if(session('step') == 2) {
				if ($examen_type == 'base') $test = Test::find($examen->read_test_id);
				if ($examen_type == 'doctors') {
					$questions_listen = ExamenDoctorListen::where('stage', '2.2')->get();

					$timeleft = $questions_listen[0]->time1*60;
				}
            }

            if(session('step') == 2.2) {
				$test = false;

				$questions_listen = ExamenDoctorListen::where('stage', '2.2')->get();
				$timeleft = $questions_listen[0]->time2*60;
            }

            if(session('step') == 3) {
				if ($examen_type == 'base') $test = Test::find($examen->listen_test_id);
				if ($examen_type == 'doctors') {

					$test = Test::find($examen->read_test_id);
					$stage3 = ExamenDoctorStage3::where('stage', 3)->get();
					$timeleft = $stage3[0]->time*60;
				}
            }

            if(session('step') == 5) {
				if ($examen_type == 'base') {
					$test = false;
					$text_final = $examen->text_final;
				}
				if ($examen_type == 'doctors') {
					$questions = ExamenDoctorQuestions::where('stage', 4)->get();

					$stage4 = ExamenDoctorStage3::where('stage', 4)->get();
					$timeleft = $stage4[0]->time*60;
				}
            }

            if(!isset($test) && $examen_type != 'doctors') die('session expired');

            $groups = [];

            if($test !== false) {
                   foreach ($test->value as $q) {
                        if(!isset($groups[$q['continiues']])) {
                            $groups[$q['continiues']] = [];
                        }
                        array_push($groups[$q['continiues']], $q);
                    } 
            }


			if ($examen_type == 'base') return view('newpages.processingExam', [
																					'examen'=> $examen,
																					'examenContainer'=>$examenContainer,
																					'test'=>$test,
																					'test_oral'=>$test_oral,
																					'timeleft'=>$timeleft,
																					'groups'=>$groups,
																					'text_final'=> $text_final
			]);

			if ($examen_type == 'doctors') {

				return view('newpages.processingExamDoctor', [
															'examen'			=> $examen,
															'examenContainer'	=> $examenContainer,
															'questions'			=> $questions,
															'questions_listen'  => $questions_listen,
															'stage1'  			=> $stage1,
															'stage3'  			=> $stage3,
															'test'  			=> $test,
															'groups'  			=> $groups,
															'timeleft'			=> $timeleft,
															'text_final'		=> $text_final
				]);
			}


        } else {
            die('Wrong session');
        }
    }


	public function processingExamOral($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

		if(session()->has('session_id')) {

			$examenContainer = ExamenSession::findOrFail(session('session_id'));
			$examen = ExamenTest::where('name', $exam_lvl)->firstOrFail();

			$count = ExamenOral::where('exam_id', $examenContainer->exam_id)->count('id');

			if($examenContainer->end_at < Carbon::now()) {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			}

			if(session('step') >= 1) {
				$test_oral = ExamenOral::where('exam_id', $examenContainer->exam_id)->get();
				$test_oral = $test_oral[session('step') - 1];
				$timeleft = $test_oral['time']*60;
			} else {
				dd('Der Fehler. Sie haben die Prüfung bereits bestanden.');
			}



			return view('newpages.processingExamOral', [
				'examen'			=> $examen,
				'exam_lvl'			=> $exam_lvl,
				'examenContainer'	=> $examenContainer,
				'timeleft'			=> $timeleft,
				'test_oral'			=> $test_oral,
				'count' 			=> $count
			]);

		} else {
			die('Wrong session');
		}
	}


	public function saveAnswerOral($locale = 'de') {

		app()->setLocale($locale);

		$examenContainer = ExamenSession::findOrFail(session('session_id'));
		$test_oral_count = ExamenOral::where('exam_id', $examenContainer->exam_id)->count('id');


		if(session('step') == $test_oral_count) {
			$this->save_audio();

			session(['step'=>null]);
			echo trim_locale(app()->getLocale()).'/finish_exam';
		}

		if(session('step') >= 1 && session('step') != $test_oral_count) {
			$this->save_audio();

			session(['step' => session('step') + 1]);

			if($examenContainer->end_at < Carbon::now()) echo trim_locale(app()->getLocale()).'/finish_exam';
			else echo trim_locale(app()->getLocale()).'/proccessing_exam/' . request('exam_lvl') . '/oral';
		}
	}


	private function save_audio() {
		$examC = ExamenContainer::find(session('examen_container'));

		if(request()->hasfile('data'))
		{
			$file = request()->file('data');
			$extension = $file->getClientOriginalExtension();
			$filename =time().'.'.$extension;
			file_put_contents('audio/'.$filename.'wav', file_get_contents($file));

			$json_audio = array();
			$json_audio = json_decode($examC->oral1);
			$json_audio[] = '/audio/'.$filename.'wav';
			$examC->oral1 = json_encode($json_audio);
			$examC->save();
		}
	}


    public function sendAnswer($locale = 'de', $exam_lvl = 'none') {

		if($exam_lvl == 'none') {
			$exam_lvl = $locale;
			$locale = 'de';
		}

		app()->setLocale($locale);

        $examenContainer = ExamenSession::findOrFail(session('session_id'));
		$examC = ExamenContainer::find(session('examen_container'));

		$examen_type = 'base';
		if($exam_lvl == 'Prüfung für Ärzte') $examen_type = 'doctors';


        if(session('step') == 1) {
            $sc = 20 / trim(request('total'));
            $examenContainer->hv = (int)(request('score')*$sc);
			$examenContainer->step_exam = 2;
            $examenContainer->save();

			$examC->hv_data = request('test_answers');
			$examC->save();
            session(['step'=>2]);

			if ($examen_type == 'doctors') ExamenDoctorAnswer::where('user_email', $examenContainer->user_email)->update(['stage1' => json_encode(request()->all())]);

            if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
                return redirect(trim_locale(app()->getLocale()).'/finish_exam');
            } else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
            }
            
        }

        if(session('step') == 2) {
            if ($examen_type == "doctors") {
            	session(['step'=>2.2]);
				ExamenDoctorAnswer::where('user_email', $examenContainer->user_email)->update(['stage2' => json_encode(request()->all())]);
				$sc = 15 / trim(request('total'));
			}
            else {
				session(['step' => 3]);
				$sc = 25 / request('total');
			}

			$examenContainer->lv = (int)(request('score') * $sc);
			$examenContainer->step_exam = 3;
			$examenContainer->save();

			$examC->lv_data = request('test_answers');
			$examC->save();

            if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			} else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
        }

        if(session('step') == 2.2) {
			if ($examen_type != "doctors") {
				$sc = 25 / request('total');
				$examenContainer->lv = (int)(request('score') * $sc);
				$examenContainer->step_exam = 4;
				$examenContainer->save();
			}
            session(['step'=>3]);

			if ($examen_type == 'doctors') ExamenDoctorAnswer::where('user_email', $examenContainer->user_email)->update(['stage2_2' => json_encode(request()->all())]);

			if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			} else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
        }

        if(session('step') == 3) {
			$sc = 25 / trim(request('total'));
			$examenContainer->sa = (int)(request('score') * $sc);
			$examenContainer->step_exam = 5;
            $examenContainer->save();

			$examC->sa_data = request('test_answers');
			$examC->save();

			if ($examen_type == 'doctors') {
				ExamenDoctorAnswer::where('user_email', $examenContainer->user_email)->update(['stage3' => json_encode(request()->all())]);
				session(['step'=>5]);
			}
			else session(['step'=>5]);

            if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			} else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
        }

        if(session('step') == 4) {
			$examC->oral1 = request('audio');
			$examC->save();

			session(['step'=>4.2]);

            if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			} else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
        }

        if(session('step') == 4.2) {
			$examC->oral2 = request('audio');
			$examC->save();

			session(['step'=>5]);

            if($examenContainer->end_at < Carbon::now() && session('examen_type') != 'doctros') {
				return redirect(trim_locale(app()->getLocale()).'/finish_exam');
			} else {
				return redirect(trim_locale(app()->getLocale()).'/proccessing_exam/' . $exam_lvl);
			}
        }

        if(session('step') == 5) {

            //Определяем карточку экзамена и начисляем баллы туда
            $user = User::where('email', $examenContainer->user_email)->first();

            $examC->hv_prev = $examenContainer->hv;
            $examC->lv_prev = $examenContainer->lv;
            $examC->sa_prev = $examenContainer->sa;
            $examC->user_text = request('letter');
            $examC->save();
			$examenContainer->step_exam = 0;
			$examenContainer->save();

			if ($examen_type == 'doctors') ExamenDoctorAnswer::where('user_email', $examenContainer->user_email)->update(['stage4' => json_encode(request()->all())]);

            Mail::raw('Link for result:  https://test.deutsch-kurs-hannover.de/admin/users/'.$user->id, function ($message) {
              //$message->to('admin@deutsch-kurs-hannover.com')
              $message->to('pruefung@deutsch-kurs-hannover.com')
                ->subject('User finished examen');
            });


            session(['step'=>-1]);
			return redirect(trim_locale(app()->getLocale()).'/finish_exam');
        }

        
    }


    public function finish($locale = 'de') {
		app()->setLocale($locale);

		session(['step'=>null]);
        return view('newpages.finishExam');
    }
}
