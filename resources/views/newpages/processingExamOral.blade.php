@extends('layouts.newapp', ['title' => 'Examen', 'description' => ""])

@section('content')

<div class="inner-banner">
    <div class="container">
        <h1 class="inner-banner__headline">
            Proccessing Examen (Level {{$examen->name}})
        </h1>
    </div>
</div>
<script type="text/javascript">
    setInterval(function() {
        if($('#time').text() == '00:00') {
            $('.send-result').click();
        }
    }, 1000);

    setTimeout(function() {
        startRecording();
    }, 180000)
</script>
<div class="lesson-list">
    <div class="container">
        <h1 class="timer">Time Left: <i id="time">...</i></h1>
        <div class="text-instruction">
            {!! $examen->text_instruction_oral !!}
        </div>
    </div>

    <div class="container">
        <div class="course-tests__test w100 test_oral">
            @if($test_oral !== false)
                <h4 class="course-tests__test-headline">

                    <span>{{ __('test.question') }} <i class="current">{{session('step')}}</i> / {{$count}}</span>
                </h4>
                <div class="course-tests__test-zadanie"><div class="content-zadanie"  style="overflow: hidden;"></div></div>
                <form id="res-fr" method="post" action="">
                    @csrf
                    <div data-audio="{{$test_oral['audio']}}" class="course-tests__test-question audio_stage doctors_test">
                         {!! $test_oral['text'] !!}

                        <div style="max-width: 28em;">
                            <div id="controls" style="margin-top: 20px;">
                                <button type="button" id="recordButton" style="padding: 10px 20px;margin-right: 20px;background: red;color: #fff;">Record</button>
                                <button type="button" id="stopButton2" style="padding: 10px 20px;margin-right: 20px;">Stop</button>
                            </div>
                            <p style="display: none">Recording is in progress <span id="time_record" style="color:brown; float: initial;width: initial;"></span> sec</p>
                            <div style="display: none" id="formats"></div>
                            <p style="display: none"><strong>Recordings:</strong></p>
                            <ol style="display: none" id="recordingsList"></ol>
                            <pre style="display: none" id="log"></pre>
                        </div>
                    </div>
                    <div class="course-tests__test-buttons">
                        <input type="hidden" name="exam_lvl" value="{{$exam_lvl}}">
                        <input type="hidden" name="audio">
                        <button class="send-result finish-question2" type="button" id="stopButton">{{ __('test.finish_btn') }}</button>
                        <p style="display: none">Loading audio file <img src="/new/images/wait.gif" style="width:40px;margin-bottom: -16px;margin-left: 10px;"></p>
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
                //$('.next-question').click();

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