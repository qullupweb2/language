<div class="row">

@foreach($courses as $course)

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$course->name}}</h5>
                <p class="card-text">
                    <p>{{$category->short_description['how_often']}}</p>
                    <p>{{__('messages.duration')}}: {{$category->short_description['duration']}} {{__('messages.weeks')}}</p>
                    <p>{{__('messages.pricefrom')}}: {{$category->prices['price_1']}} Euro</p>
                    <p>{{__('messages.start')}}: @dateFormat($course->start_date)</p>
                </p>
                <a href="{{ route('course',['id'=> $course->id]) }}" class="btn btn-primary">{{__('messages.register')}}</a>
            </div>
        </div>
    </div>

@endforeach




@foreach($exams ?? [] as $exam)

    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$exam->name}}</h5>
                <p class="card-text">
                <p>{{$category->short_description}}</p>
                <p>{{__('messages.startfrom')}}: @dateFormat($exam->start_date)</p>
                </p>
                <a href="{{ route('examen',['id'=> $exam->id]) }}" class="btn btn-primary">{{__('messages.register')}}</a>
            </div>
        </div>
    </div>

@endforeach

</div>