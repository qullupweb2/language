
<div class="card-header">
    @if(!isset($exams))
        {{__('messages.course')}}
    @else
        {{__('messages.exam')}}
    @endif {{$category->name}}</div>

<div class="card-body">
    @include('course.courses')
</div>