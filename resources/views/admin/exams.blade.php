
<script type="text/javascript">
    
$(function() {

        $('select.action').change(function () {
           if($(this).val() == 'confirmOfExam') {
               $(this).parent().parent().find('.action-exam').show();
           } else {
               $(this).parent().parent().find('.action-exam').hide();
           }
        });
});

</script>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Exams</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            @if(count($exams) < 1)

                <p class="text-center w-100">{{__('messages.noexams')}}</p>

            @endif
            @foreach($exams as $examContainer)

                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">

                                <p class="unic_number">{{__('messages.nameExam')}}: <b>{{$examContainer->exam()->name}}</b></p>
                                <p>Status: @if($examContainer->paid) Paid @else Not paid @endif</p>


                            </h5>
                            <p class="card-text">

                            <p class="start_date">{{__('messages.start')}}: <b>@dateFormat($examContainer->exam()->start_date)</b></p>
                            
                            

                            @if($examContainer->status == 'pending')
                                <div class="alert alert-warning" role="alert">
                                    {{__('messages.waitexam')}}
                                </div>
                            @elseif($examContainer->status == 'closed')
                                <div class="alert alert-success" role="alert">
                                    {{__('messages.finishexam')}}
                                </div>
                                <p><a class="btn btn-primary" href="/admin/examResultCancel/{{$examContainer->id}}">Cancel examen result</a></p>
                                @endif
                                
                                <h5>Actions:</h5>
                                <form method="post" action="/admin/examActionsAll">
                                <div class="col-md-5">
                                    {{csrf_field()}}
                                    <select class="form-control action" style="width: 100%;" name="action" data-value="" >
                                        <option>Select action</option>
                                        <option value="confirmOfExam">Confirm exam participation</option>
                                        <option value="confirmPaid">Confirm pay</option>
                                        <option value="clearResults">Reset results</option>
                                        <option value="clearOral">Reset oral</option>
                                    </select>
                                </div>

                                <div class="col-md-4 action-exam" style="display: none;">
                                    <input type="text" class="form-control" name="exam_name" placeholder="Exam name"   value="">
                                    <input type="text" class="form-control" name="date" placeholder="Date"   value="">
                                </div>

                                <div class="col-md-2">
                                    <input type="hidden" name="exam_contrainer_id" value="{{$examContainer->id}}">
                                    <button class="btn btn-primary">Apply</button>
                                </div>
                                </form>
    <br><br>

                                @if(count($examContainer->documents()) > 0)
                                    <hr>
                                    <h6>Documents:</h6>
                                    <ul>
                                        @foreach($examContainer->documents() as $document)

                                            <li><a target="_blank" href="{{route('downloadPdf', ['name'=>$document->name]) }}">Download {{$document->name}}</a></li>

                                        @endforeach

                                    </ul>
                                @endif


                                @if($examContainer->status == 'pending')

                                @if($examContainer->user_text) 
                                    <h5>User text:</h5>

                                    <textarea class="form-control" disabled="">{{$examContainer->user_text}}</textarea>
                                @endif

                                <h5>Exam points:</h5>
                                <form method="post" action="/admin/examActions">
                                    @csrf
                                    <div class="col-md-2">
                                        <input type="number" required class="form-control" name="hv" placeholder="HV" value="{{$examContainer->hv_prev}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" required class="form-control" name="lv" placeholder="LV" value="{{$examContainer->lv_prev}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" required class="form-control" name="sa" placeholder="SA" value="{{$examContainer->sa_prev}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" required class="form-control" name="ma" placeholder="MA" value="{{$examContainer->ma_prev}}">
                                    </div>
                                    <div class="col-md-2">
                                        <input type="hidden" name="container_id" value="{{$examContainer->id}}">
                                        <button class="btn btn-primary">Save</button>
                                    </div>
                                </form>

                                @endif
                                @if($examContainer->status == 'closed')
                                <form method="post" action="/admin/examActionsRepeatSend" style="margin-top: 20px">
                                    @csrf
                                    <div class="col-md-12">
                                        <input type="hidden" name="container_id" value="{{$examContainer->id}}">
                                        <button class="btn btn-primary">Repeat send exam points</button>
                                    </div>
                                </form>
                                @endif
                                <div class="row">
                                    <? $audio_files = json_decode($examContainer->oral1); ?>
                                    @if($audio_files)
                                        @foreach($audio_files as $key => $audio_file)
                                        <?
//                                            $id_question = explode('audio_', $audio_file);
//                                            $id_question = explode('.mp3', $id_question[1]);
//                                            $id_question = explode('_', $id_question[0]);
//                                            $audio_file = @file_get_contents($audio_file);
//                                            $audio_file = $audio_file ?? null;
                                        ?>
                                        @if(!empty($audio_file))
                                        <div class="col-md-6">
                                            <label id="audio1" style="margin-top: 20px;display: block;">Audio question #{{$key+1}}</label>
                                            <audio id="audio1" controls src="{{$audio_file}}"  type="audio/wav" >
                                            </audio>
                                        </div>
                                        @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                    <h5><b>Hv answers</b></h5>
                                    <? $hv_datas = json_decode($examContainer->hv_data); ?>
                                    @if($hv_datas)
                                        @foreach($hv_datas as $key => $hv_data)
                                            <div class="col-md-6">
                                                <p><b>{{$hv_data->question}}</b></p>
                                                <p>{{$hv_data->answer}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                    <hr>
                                </div>
                                <div class="row">
                                    <h5><b>Lv answers</b></h5>
                                    <? $lv_datas = json_decode($examContainer->lv_data); ?>
                                    @if($lv_datas)
                                        @foreach($lv_datas as $key => $lv_data)
                                            <div class="col-md-6">
                                                <p><b>{{$lv_data->question}}</b></p>
                                                <p>{{$lv_data->answer}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                    <hr>
                                </div>
                                <div class="row">
                                    <h5><b>Sa answers</b></h5>
                                    <? $sa_datas = json_decode($examContainer->sa_data); ?>
                                    @if($sa_datas)
                                        @foreach($sa_datas as $key => $sa_data)
                                            <div class="col-md-6">
                                                <p><b>{{$sa_data->question}}</b></p>
                                                <p>{{$sa_data->answer}}</p>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- /.box-body -->
    </div>
</div>