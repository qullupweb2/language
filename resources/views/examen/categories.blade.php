<div class="card exams">
<div class="card-header">{{__('messages.exams')}}</div>

    <div class="card-body">

        <div class="row">
            @foreach ($examens as $examen)


                <div class="course-category card col-lg-2dot4 col-md-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $examen->name }}</h5>
                        <a href="{{ route('examen', ['id'=>$examen->id]) }}" class="btn btn-primary">{{__('messages.readmore')}}</a>
                    </div>
                </div>


            @endforeach
        </div>

    </div>
</div>