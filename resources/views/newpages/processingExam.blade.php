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
        <div class="course-tests__test w100">
        	@if($test !== false)
            <h4 class="course-tests__test-headline">
                {{$test->level}}
                <span>{{ __('test.question') }} <i class="current">1</i> / {{count($test->value)}}</span>
            </h4>
            <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
            <form id="res-fr" method="post" action="">
                @csrf
                <?php $i = 0; ?>
                @foreach($groups as $id => $questions)
                <?php $group = App\Models\QuestionGroup::find($id);  ?>
                @foreach($questions as $question)
                <?php $i++; ?>
                <div data-audio="{{$group->audio}}" data-html='{!! str_replace("'", "\"", $group->text) !!}' class="course-tests__test-question @if($i != 1) hide-question @endif @if($group->combine == 1) group @endif" data-group="{{$group->id}}">
                    <p style="margin-bottom: 30px;">{{$question['question']}}</p>

                    <input id="radio{{$test->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" style="display: none;">
                    <label for="radio{{$test->id}}{{$i}}-a">{{$question['a']}}</label>
                    <input id="radio{{$test->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}" style="display: none;">
                    <label for="radio{{$test->id}}{{$i}}-b">{{$question['b']}}</label>
                    @if(isset($question['c']))
                    <input id="radio{{$test->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}" style="display: none;">
                    <label for="radio{{$test->id}}{{$i}}-c">{{$question['c']}}</label>
                    @endif
                    @if(isset($question['d']))
                    <input id="radio{{$test->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}" style="display: none;">
                    <label for="radio{{$test->id}}{{$i}}-d">{{$question['d']}}</label>
                    @endif
                </div>
                @endforeach
                @endforeach
                <div class="course-tests__test-buttons">
                <input type="hidden" name="current" value="1">
                <input type="hidden" name="score" value="0">
                <input type="hidden" name="test_answers">
                <input type="hidden" name="total" value="{{count($test->value)}}">
                <button class="next-question">{{ __('test.next') }}</button>
                <button class="send-result finish-question" onclick="localStorage.clear()">{{ __('test.finish_btn') }}</button>

                </div>
            </form>
            @elseif($test_oral !== false)
                <h4 class="course-tests__test-headline">

                    <span>{{ __('test.question') }} <i class="current">1</i> / 2</span>
                </h4>
                <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
                <form id="res-fr" method="post" action="">
                    @csrf
                    <div data-audio="{{$test_oral['audio']}}" class="course-tests__test-question audio_stage doctors_test">
                         {!! $test_oral['text'] !!}

                        <div style="max-width: 28em;">
                            <div id="controls">
                                <button type="button" id="recordButton" style="padding: 10px 20px;margin-right: 20px;background: red;color: #fff;">Record</button>
                                <button type="button" id="pauseButton" style="padding: 10px 20px;margin-right: 20px;" disabled>Pause</button>
                                <button type="button" id="stopButton" style="padding: 10px 20px;" disabled>Stop</button>
                            </div>
                            <div style="display: none" id="formats"></div>
                            <p style="display: none"><strong>Recordings:</strong></p>
                            <ol style="display: none" id="recordingsList"></ol>
                        </div>
                    </div>
                    <div class="course-tests__test-buttons">
                        <input type="hidden" name="current" value="1">
                        <input type="hidden" name="score" value="0">
                        <input type="hidden" name="total" value="1">
                        <input type="hidden" name="audio">
                        <button class="next-question">{{ __('test.next') }}</button>
                        <button class="send-result finish-question" onclick="localStorage.clear()">{{ __('test.finish_btn') }}</button>
                    </div>
                </form>
            @else
			<h4 class="course-tests__test-headline">
                Schreiben - {{$examen->minutes}} Minuten
            </h4>
            <div style="margin-bottom: 31px;" class="course-tests__test-zadanie"><div class="content-zadanie">{!! $text_final !!}</div></div>
            <form id="res-fr" method="post" action="">
                @csrf
                <textarea style="width: 93%;
    height: 212px;
    background: #F7F7F7;
    border-radius: 5px;
    padding: 14px 25px;
    font-size: 16px;
    color: #222;
    margin: 0 0 10px 0;
    resize: none;
    margin: 0 auto;
    display: block;" required="" placeholder="Letter*" name="letter"></textarea>
                <div class="course-tests__test-buttons">
                <button style="display: block;" onclick="localStorage.clear()" class="send-result finish-question">{{ __('test.finish_btn') }} examen</button>

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

    $(function () {
        $('[type="radio"]').change(function () {
            localStorage.setItem('array_test', (localStorage.getItem('array_test') ? localStorage.getItem('array_test') + ',#' : '#')
                + $(this).attr('id') + '/[name=' + $(this).attr('name') + "]");
        });

        $('[name="letter"]').keyup(function () {
            localStorage.setItem('text_test', $(this).val());
        });
    });

    if(localStorage.getItem('text_test') !== null) {
        $('[name="letter"]').val(localStorage.getItem('text_test'));
    }
    if(localStorage.getItem('array_test') !== null) {
        let array_test = localStorage.getItem('array_test').split(',');

        $(array_test).each(function(key, index) {

            let arr = index.split('/');
            $(arr).each(function(key, index) {
                if(key == 0) {
                    $(index).addClass('correct_item');
                    $(index).attr('checked', 'checked');
                } else $(index).attr('disabled', 'disabled');
            });
        });
    }
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