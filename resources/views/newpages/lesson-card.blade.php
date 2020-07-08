@if(app()->getLocale() == 'de')
    <?php $title = $lesson->title; ?>
@else
    <?php $title = $lesson['title_'.app()->getLocale()]; ?>
@endif
@extends('layouts.newapp', ['title' => $title, 'description' => ""])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
		</style>
	@endif
<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">
			@if(app()->getLocale() == 'de')
				{{$lesson->title}}
			@else
				{{$lesson['title_'.app()->getLocale()]}}
			@endif
		</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{__('top_navigation.menu3')}}</a></li>
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos/{{strtolower($category->name)}}">{{ __('courses.course_name_online') }} {{$category->name}}</a></li>
			<li class="inner-banner__breadcrumbs__item">
				@if(app()->getLocale() == 'de')
					{{$lesson->title}}
				@else
					{{$lesson['title_'.app()->getLocale()]}}
				@endif
			</li>
		</ul>
	</div>
</div>

<div class="lesson-card">
	<div class="container">
		<div class="lesson-card__about">
			<h4 class="lesson-card__about__headline">
				@if(app()->getLocale() == 'de')
					{{$lesson->title}}
				@else
					{{$lesson['title_'.app()->getLocale()]}}
				@endif
				<div class="lesson-card__about__headline__level">
					<span>{{__('lesson_list.diffucult')}}</span>
					<span>
						@if($category->level == 1)
							{{__('courses.level1') }}
						@elseif($category->level == 2)
							{{ __('courses.level2') }}
						@elseif($category->level == 3)
							{{ __('courses.level3') }}
						@elseif($category->level == 4)
							{{ __('courses.level4') }}
						@else
							{{ __('courses.level5') }}
						@endif
						</span>
				</div>
			</h4>

			@if(app()->getLocale() == 'de')

				{!!$lesson->description!!}
			@else
				{!!$lesson['description_'.app()->getLocale()]!!}
			@endif
		</div>

		<ul class="lesson-card__tabs">
			<li><a href="#lessoncard1" class="active">{{__('lesson_list.video')}}</a></li>
			<li><a href="#lessoncard2">{{__('lesson_list.vortag')}}</a></li>
			<li><a href="#lessoncard3">{{__('lesson_list.testen')}}</a></li>
		</ul>

		<div class="lesson-card__content" id="lessoncard1">
			{!! $lesson->video_html !!}
		</div>

		<div class="lesson-card__content" id="lessoncard2" style="display: none">
			{!! $lesson->lection_html !!}
		</div>

		<div class="lesson-card__content" id="lessoncard3" style="display: none">
			<h4 class="course-tests__test-headline">
				{{$test->level}}
				<span>{{ __('test.question') }} <i class="current">1</i> / {{count($test->value)}}</span>
			</h4>
			<form>
                <?php $i = 0; ?>
				@foreach($test->value as $question)
                    <?php $i++; ?>
					<div class="course-tests__test-question @if($i != 1) hide-question @endif">
						<p>{{$question['question']}}</p>

						<input id="radio{{$test->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
						<label for="radio{{$test->id}}{{$i}}-a">{{$question['a']}}</label>
						<input id="radio{{$test->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
						<label for="radio{{$test->id}}{{$i}}-b">{{$question['b']}}</label>
						<input id="radio{{$test->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
						<label for="radio{{$test->id}}{{$i}}-c">{{$question['c']}}</label>
						<input id="radio{{$test->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
						<label for="radio{{$test->id}}{{$i}}-d">{{$question['d']}}</label>
					</div>
				@endforeach
				<div class="course-tests__test-buttons">
					<input type="hidden" name="current" value="1">
					<input type="hidden" name="score" value="0">
					<input type="hidden" name="total" value="{{count($test->value)}}">
					<button class="next-question-st">{{ __('test.next') }}</button>
					<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

				</div>
			</form>
		</div>
	</div>
</div>

@endsection