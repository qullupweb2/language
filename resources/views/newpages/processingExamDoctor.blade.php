@extends('layouts.newapp', ['title' => 'Examen', 'description' => ""])

@section('content')

<div class="inner-banner">
    <div class="container">
        <h1 class="inner-banner__headline">
            Proccessing Examen (Level {{$examen->name}})
        </h1>
    </div>
</div>

<div class="lesson-list">
    <div class="container">
        <h1 class="timer">Time Left: <i id="time">...</i></h1>
        <div class="text-instruction">
            {!! $examen->text_instruction !!}
        </div>
    </div>

    <div class="container">
        <div class="course-tests__test w100 examen-doctor">
            @if($questions !== false && session('step') == 1)
                <h4 class="course-tests__test-headline">
                    {{ __('test.question') }} - {{$timeleft/60}} Minuten
                    <span>{{ __('test.question') }} <i class="current">1</i> / {{count($questions)}}</span>
                </h4>
                <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
                <form id="res-fr" method="post" action="" style="padding-top: 130px;">
                    @csrf
                    <?php $i = 0; ?>
                    <div style="padding: 0 40px;">{!! $stage1[0]->text !!}</div>
                    @foreach($questions as $question)
                        <?php $i++; ?>
                        <div class="course-tests__test-question doctors_test">
                            <p style="float: none">{{$question['question']}}</p>
                            <div style="display: flex;">
                                <label style="padding-left: 0px; width: 20%;">Antworten:</label>
                                <input type="text" name="question{{$question->id}}" id="input{{$question->id}}{{$i}}" style="border: 1px solid #EAEAEA;width: 100%;height: 34px;">
                            </div>
                        </div>
                    @endforeach
            @endif
            @if($questions_listen !== false)
                <h4 class="course-tests__test-headline">
                    Hoeren  - {{$timeleft/60}} Minuten
                    <span>{{ __('test.question') }} <i class="current">1</i> / {{count($questions_listen)}}</span>
                </h4>
                <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
                <form id="res-fr" method="post" action="">
                    @csrf
					<?php $i = 1;
                        $question_listen = $questions_listen[0]
                    ?>
                    @if (session('step') == 2)
                    <div data-audio="{{$question_listen->listen1}}" class="course-tests__test-question audio_stage doctors_test">
                        {!! $question_listen->audio1 !!}

                        <p>{!! $question_listen['text1'] !!}</p>

                        <input id="radio{{$question_listen->id}}-a" @if($question_listen['answer'] == 'test_a') class="correct_item" @endif  type="radio" name="question1" >
                        <label for="radio{{$question_listen->id}}-a">{{$question_listen['test_a']}}</label>
                        <input id="radio{{$question_listen->id}}-b" @if($question_listen['answer'] == 'test_b') class="correct_item" @endif  type="radio" name="question1">
                        <label for="radio{{$question_listen->id}}-b">{{$question_listen['test_b']}}</label>
                        @if(isset($question_listen['test_d']))
                            <input id="radio{{$question_listen->id}}-c" @if($question_listen['answer'] == 'test_c') class="correct_item" @endif  type="radio" name="question1">
                            <label for="radio{{$question_listen->id}}-c">{{$question_listen['test_c']}}</label>
                        @endif
                        @if(isset($question_listen['test_c']))
                            <input id="radio{{$question_listen->id}}-d" @if($question_listen['answer'] == 'test_d') class="correct_item" @endif  type="radio" name="question1">
                            <label for="radio{{$question_listen->id}}-d">{{$question_listen['test_d']}}</label>
                        @endif
                    </div>
                    @endif
                    @if (session('step') == 2.2)
                    <div data-audio="{{$question_listen->listen2}}" class="course-tests__test-question audio_stage doctors_test">
                        {!! $question_listen->audio2 !!}

                        <p>{!! $question_listen['text2'] !!}</p>
                        <label style="padding-left: 0px; width: 20%;">Antworten:</label>
                        <textarea name="answer" rows="5" style="width:100%;border: 1px solid #EAEAEA"></textarea>
                    </div>
                    @endif
            @endif
            @if($test !== false && $stage3 !== false)
                <h4 class="course-tests__test-headline">
                    {{ __('test.question') }} - {{$timeleft/60}} Minuten
                    <span>{{ __('test.question') }} <i class="current">1</i> / {{count($test->value)}}</span>
                </h4>
                <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
                <form id="res-fr" method="post" action="">
                    @csrf
                    <div style="padding: 0 40px;">{!! $stage3[0]->text !!}</div>
					<?php $i = 0; ?>
                    @foreach($groups as $id => $questions)
						<?php $group = App\Models\QuestionGroup::find($id);  ?>
                        @foreach($questions as $question)
							<?php $i++; ?>
                            <div class="course-tests__test-question @if($i > 10) hide-question @endif @if($group->combine == 1) group @endif" data-group="{{$group->id}}">
                                <p>{{$question['question']}}</p>

                                <input id="radio{{$test->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
                                <label for="radio{{$test->id}}{{$i}}-a">{{$question['a']}}</label>
                                <input id="radio{{$test->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
                                <label for="radio{{$test->id}}{{$i}}-b">{{$question['b']}}</label>
                                @if(isset($question['c']))
                                    <input id="radio{{$test->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
                                    <label for="radio{{$test->id}}{{$i}}-c">{{$question['c']}}</label>
                                @endif
                                @if(isset($question['d']))
                                    <input id="radio{{$test->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
                                    <label for="radio{{$test->id}}{{$i}}-d">{{$question['d']}}</label>
                                @endif
                            </div>
                        @endforeach
                    @endforeach
            @endif
            @if(session('step') == 5)
                <h4 class="course-tests__test-headline">
                    {{ __('test.question') }} - {{$timeleft/60}} Minuten
                </h4>
                <div style="margin-bottom: 31px;" class="course-tests__test-zadanie"><div class="content-zadanie">{!! $text_final !!}</div></div>
                <form id="res-fr" method="post" action="">
                    @csrf
					<?php $i = 0; ?>
                    @foreach($questions as $question)
						<?php $i++; ?>
                        <div class="course-tests__test-question doctors_test">
                            <p style="float: none">{{$question['question']}}</p>
                            <div style="display: flex;">
                                <input type="text" name="question{{$question->id}}" id="input{{$question->id}}{{$i}}" style="border: 1px solid #EAEAEA;width: 100%;height: 34px;">
                            </div>
                        </div>
                    @endforeach
                   <div class="course-tests__test-buttons">
                       <button style="display: block;" class="send-result finish-question">{{ __('test.finish_btn') }} examen</button>
                   </div>
               </form>
           @else
                <div class="course-tests__test-buttons">
                    <input type="hidden" name="current" value="1">
                    <input type="hidden" name="score" value="0">
                    <input type="hidden" name="total" value="@if(session('step') == 1 || session('step') == 3.2){{count($questions)}}@endif
                    @if(session('step') == 2 || session('step') == 2.2){{count($questions_listen)}}@endif
                    @if(session('step') == 3) {{count($test->value)}}@endif">
                    <button class="next-question">{{ __('test.next') }}</button>
                    <button class="send-result finish-question">{{ __('test.finish_btn') }}</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>




<script type="text/javascript">
    function startTimer(duration, display) {
        var timer = duration, minutes, seconds;

        var ints = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            if(minutes == 0 && seconds == 0) {
				//$('#res-fr').submit();
				$('.next-question').click();

                clearInterval(ints);
            }

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }

    window.onload = function () {
        display = document.querySelector('#time');
        startTimer({{$timeleft}}, display);
    };

	document.ondragstart = noselect;
	document.onselectstart = noselect;
	document.oncontextmenu = noselect;
	function noselect() {return false;}
</script>
<style type="text/css">
    h1.timer {
        font-size: 25px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>
@endsection
