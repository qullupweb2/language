@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">



<div class="card-header">{{__('messages.myexams')}}</div>

<div class="card-body">
    <div class="row">

        @if(count($exams) < 1)

            <p class="text-center w-100">{{__('messages.noexams')}}</p>

        @endif
        @foreach($exams as $examContainer)

            <div class="col-sm-6">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">

                            <p class="unic_number">{{__('messages.nameExam')}}: <b>{{$examContainer->exam()->name}}</b></p>


                        </h5>
                        <p class="card-text">

                        <p class="start_date">{{__('messages.start')}}: <b>@dateFormat($examContainer->exam()->start_date)</b></p>

                        @if($examContainer->status == 'pending')
                            <div class="alert alert-warning" role="alert">
                                {{__('messages.waitexam')}}
                            </div>
                            </p>
                        @elseif($examContainer->status == 'closed')
                            <div class="alert alert-success" role="alert">
                                {{__('messages.finishexam')}}
                            </div>
                        <h4>Results:</h4>
                            <br>
                        <p>
                            <b>LESERVERSTEHEN</b>: {{$examContainer->lv}}
                        </p>
                            <hr>
                            <p>
                                <b>HÖRVERSTEHEN</b>: {{$examContainer->hv}}
                            </p>
                            <hr>
                            <p>
                                <b>SCHRIFTLICHER AUSDRUCK</b>: {{$examContainer->sa}}
                            </p>
                            <hr>
                            <p>
                                <b>MÜNDLICHER AUSDRUCK</b>: {{$examContainer->ma}}
                            </p>
                            <hr>
                            <p>
                                <b>LINSGESAMT</b>: {{$examContainer->hv+$examContainer->lv+$examContainer->sa+$examContainer->ma}}
                            </p>
                            @endif
                            </p>


                    </div>
                </div>
            </div>

        @endforeach



    </div>
</div>
                </div>
            </div>
        </div>
    </div>
@endsection