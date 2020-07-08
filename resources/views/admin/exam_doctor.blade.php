<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Doctor examen</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">


                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <h5 class="card-title">
                                    <p class="unic_number">Stage 1: <b></b></p>
                                </h5>

                                @foreach ($questions_answer as $id => $question_answer)
                                    <p><label>{{$question_answer}}:</label> {{$id}}</p>
                                @endforeach
                            </div>
                            <div class="row">
                                <h5 class="card-title">
                                    <p class="unic_number">Stage 2.1: <b></b></p>
                                </h5>

                                <p>Answer: {{$stage2['score']}}</p>
                            </div>
                            <div class="row">
                                <h5 class="card-title">
                                    <p class="unic_number">Stage 2.2: <b></b></p>
                                </h5>

                                {!! $question_text3->text !!}
                                <p>Answer: {$stage2_2['answer']}}</p>
                            </div>
                            <div class="row">
                                <h5 class="card-title">
                                    <p class="unic_number">Stage 3: <b></b></p>
                                </h5>

                                <p>Answer: {{$stage3['score']}}</p>
                            </div>
                            <div class="row">
                                <h5 class="card-title">
                                    <p class="unic_number">Stage 4: <b></b></p>
                                </h5>

                                @foreach ($questions_answer2 as $id => $question_answer2)
                                    <p><label>{{$question_answer2}}:</label> {{$id}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


        </div>
        <!-- /.box-body -->
    </div>
</div>