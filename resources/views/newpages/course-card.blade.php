<? $url_register = request()->getPathInfo(); ?>

@if($category->difficult != 0 && $category->name != 'C1  TestDaf')
    <?php $title =  __('courses.course_meta_title_1').$category->name.__('courses.course_meta_title_2').$category->name.__('courses.course_meta_title_3').$category->name.__('courses.course_meta_title_4'); ?>
@elseif($category->name == 'C1  TestDaf')
	<? $title =  __('courses.course_meta_title_testdaft');
	$url_register = trim_locale(app()->getLocale()) . '/deutschkurse-hannover-c1'; ?>
@elseif($category->name == 'Deutschkurs für Ärzte')
	<? $title =  __('courses.doctor_meta_title');
	$url_register = trim_locale(app()->getLocale()) . '/deutschkurse-hannover-fuer-aerzte'; ?>
@else
    <?php $title =  __('courses.doctor_course').' '.__('courses.course_meta_title2'); ?>
@endif

<?php $description = __('courses.c1meta_description'); ?>

@if($category->name == 'A1')
	<?php $description = __('courses.a1meta_description'); ?>
@endif

@if($category->name == 'A2')
    <?php $description = __('courses.a2meta_description'); ?>
@endif

@if($category->name == 'B1')
    <?php $description = __('courses.b1meta_description'); ?>
@endif

@if($category->name == 'B2')
    <?php $description = __('courses.b2meta_description'); ?>
@endif



@if($category->name == 'Deutschkurs für Ärzte')
    <?php $description = __('courses.doctor_meta_description'); ?>
@endif


@extends('layouts.newapp', ['title' => $title, 'description' => $description])


@section('content')
	@if(app()->getLocale() == 'ru')
		<style>

		</style>
	@endif
<div class="inner-banner">
	<div class="container">
		@if($category->difficult != 0)
			<h1 class="inner-banner__headline">
			@if(request()->path() == 'deutschkurse-hannover-c1') C1 {{ __('courses.course_name') }}
			@elseif(request()->path() == 'testdaf-hannover') {{ __('courses.testdaf_course') }}
			@else {{$category->name}} {{ __('courses.course_name') }}
			@endif
			</h1>
		@else
			<h1 class="inner-banner__headline">{{ __('courses.doctor_course') }}</h1>
		@endif

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
			@if($category->difficult != 0)
				<li class="inner-banner__breadcrumbs__item">{{$category->name}} {{ __('courses.course_name') }}</li>
			@else
				<li class="inner-banner__breadcrumbs__item">{{ __('courses.doctor_course') }}</li>
			@endif

		</ul>
	</div>
</div>

<div class="course-schedule">
	<div class="container">
		<div class="course-schedule__details">
			<div class="course-schedule__details-block">
				<div class="course-schedule__details-block__icon visa"></div>
				{{ __('course_category_card.card1') }}
				<span class="main-courses__course-photo__shorttext">{{ __('course_category_card.card1_desc') }}</span>
			</div>
			<div class="course-schedule__details-block">
				<div class="course-schedule__details-block__icon doc"></div>
				{{ __('course_category_card.card2') }}
				<span class="main-courses__course-photo__shorttext">{{ __('course_category_card.card2_desc') }}</span>
			</div>
			<div class="course-schedule__details-block">
				<div class="course-schedule__details-block__icon time"></div>
				{{ __('course_category_card.card3') }}
				<span class="main-courses__course-photo__shorttext">{{ __('course_category_card.card3_desc') }}</span>
			</div>
			<div class="course-schedule__details-block">
				<div class="course-schedule__details-block__icon price"></div>
				@if($category->difficult == 0)
					650 Euro
				@elseif($category->difficult == 4)
					380 Euro
				@else
					350 Euro
				@endif
				<span class="main-courses__course-photo__shorttext">{{ __('course_category_card.card4_desc') }}</span>
			</div>
		</div>
		<div class="course-category-desc">
			<? if(app()->getLocale() == 'de') {
				$cc = 'course_desc_de';
				$text_testdaf = 'desc_view_test_li';
			} else {
				$cc = 'course_desc_'.trim_locale(app()->getLocale());
				$text_testdaf = 'desc_view_test_li_'.trim_locale(app()->getLocale());
			}?>
			@if(request()->path() == 'testdaf-hannover' || request()->path() == app()->getLocale().'/testdaf-hannover')
				{!! $category->$text_testdaf !!}
			@else
				{!!$category->$cc!!}
			@endif
		</div>
		<?php $r = 1; ?>
		@foreach($category->uniqCourses() as $course)
		<div class="course-schedule__course @if(count($category->uniqCourses()) == 1) w100 @endif">
			@if($category->difficult != 0)
				<h2 class="course-schedule__course-headline">{{$course->name}} {{ __('courses.course_name_menu') }}</h2>
			@else
				<h2 class="course-schedule__course-headline">{{ __('courses.doctor_course') }}</h2>
			@endif

			<span class="course-schedule__course-start">{{ __('course_category_card.start_date') }}:</span>


            <?php $i = 0; ?>
			@foreach($course->similars() as $similar)
                <?php $i++; ?>
                <?php if($i > 10) continue; ?>
				@if($similar->price !== null && $similar->available)

						<div class="course-schedule__time-row @if($i > 3) hide-row @endif">
							<a href="{{$url_register}}/register?type={{$r}}&date={{$similar->id}}"><span>@dateFormat($similar->start_date)</span>
							@if(app()->getLocale() !== 'de')
								{{$similar['how_often_'.app()->getLocale()]}}
							@else
							{{$similar->how_often}}
							@endif</a>
						</div>

				@endif
			@endforeach
			<div class="course-schedule__next-date">
				<a href="#"><span>{{ __('course_category_card.next_date') }}</span></a>
			</div>
			<div class="course-schedule__register">
				<a href="{{$url_register}}/register?type={{$r}}">{{ __('course_category_card.reg_btn') }}</a>
			</div>
		</div>
			<?php $r++; ?>
		@endforeach

	</div>
</div>


<div class="course-tests" style="padding: 85px 0 185px 0;">
	<div class="container">
		<p class="course-tests__headline">{{ __('course_category_card.test_title') }}</p>

		@foreach($tests as $test)
		<div class="course-tests__test">
			<p class="course-tests__test-headline">
				{{$test->level}}
				<span>{{ __('test.question') }} <i class="current">1</i> / {{count($test->value)}}</span>
			</p>
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
					<button class="finish-question finish-question-st"  data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

				</div>
			</form>
		</div>
		@endforeach
		@if ($category->difficult == 4)
			<div class="exam-single-test" id="checkLevel"  style="padding: 0;">
				<div class="container">
					<div class="course-tests__test fullwidth">
						<h4 class="course-tests__test-headline">
							{{ __('test.title') }}
							@if (request()->path() == 'deutschkurse-hannover-c1' || request()->path() == app()->getLocale().'/deutschkurse-hannover-c1')
							{{$test_one->name}}
							@else
							TestDaf
							@endif
							<span>{{ __('test.question') }} <i class="current">1</i> / {{count($test_one->value)}}</span>
						</h4>
						<form>
							<?php $i = 0; ?>
							@foreach($test_one->value as $question)
								<?php $i++; ?>
								<div class="course-tests__test-question @if($i != 1) hide-question @endif">
									<p>{{$question['question']}}</p>

									<input id="radio{{$test_one->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
									<label for="radio{{$test_one->id}}{{$i}}-a">{{$question['a']}}</label>
									<input id="radio{{$test_one->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$test_one->id}}{{$i}}-b">{{$question['b']}}</label>
									<input id="radio{{$test_one->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$test_one->id}}{{$i}}-c">{{$question['c']}}</label>
									<input id="radio{{$test_one->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$test_one->id}}{{$i}}-d">{{$question['d']}}</label>
								</div>
							@endforeach
							<div class="course-tests__test-buttons">
								<input type="hidden" name="current" value="1">
								<input type="hidden" name="score" value="0">
								<input type="hidden" name="total" value="{{count($test_one->value)}}">
								<button class="next-question-st">{{ __('test.next') }}</button>
								<button class="finish-question finish-question-st" data-rating="{{__('test.your_rating')}}" data-r1="A1" data-r2="A2" data-r3="B1" data-r4="B2" data-r5="C1" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

							</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	</div>
</div>

<div class="main-details" style="margin-top: initial;">
	<div class="container">
		@include('newpages.partial.content')
	</div>
</div>

@endsection

