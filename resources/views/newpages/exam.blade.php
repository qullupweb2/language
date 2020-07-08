@extends('layouts.newapp', ['title' => __('exam_page.meta_title'), 'description' => __('exam_page.meta_description')])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
			h1.main-courses__headline {
				font-size: 43px !important;
			}
		</style>
	@endif

<div class="inner-banner">
	<div class="container">
		@if (Request::path() == 'pruefung-anmelden')
		<span class="inner-banner__headline">{{__('exam_page.title')}}</span>
		@else
		<h1 class="inner-banner__headline">{{__('exam_page.title')}}</h1>
		@endif
		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('top_navigation.menu2') }}</li>
		</ul>
	</div>
</div>

<div class="exam-type">
	<div class="container">
		<h1 style="font-size: 51px;" class="main-courses__headline">{{__('exam_page.h3')}}</h1>

		<div class="exam-type__block type1">
			<div class="exam-type__block-name">
				{{__('exam_page.card1_title')}}
			</div>
			<div class="exam-type__block-button">
				<a href="#testscat1">{{__('exam_page.card1_btn')}}</a>
			</div>
			<div class="exam-type__block-price">
				<span>
					{{__('exam_page.card1_description')}}
				</span>
				{{__('exam_page.price')}}: 80 €
			</div>
		</div>

		<div class="exam-type__block type2">
			<div class="exam-type__block-name">
				{{__('exam_page.card1_title')}}
			</div>
			<div class="exam-type__block-button">
				<a href="#testscat2">{{__('exam_page.card2_btn')}}</a>
			</div>
			<div class="exam-type__block-price">
				{{__('exam_page.price')}}: {{__('exam_page.free')}}
			</div>
		</div>

		<div class="exam-type__tests-tabs">
			<div class="exam-type__tests" id="testscat1">
				<div class="exam-type__test">
					<div class="exam-type__test-name">A1</div>
					<a href="{{request()->getPathInfo()}}/5" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">A2</div>
					<a href="{{request()->getPathInfo()}}/6" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">B1</div>
					<a href="{{request()->getPathInfo()}}/7" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">B2</div>
					<a href="{{request()->getPathInfo()}}/8" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">C1</div>
					<a href="{{request()->getPathInfo()}}/9" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
			</div>

			<div class="exam-type__tests" id="testscat2">
				<div class="exam-type__test">
					<div class="exam-type__test-name">A1</div>
					<a href="{{request()->getPathInfo()}}/10" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">A2</div>
					<a href="{{request()->getPathInfo()}}/16" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">B1</div>
					<a href="{{request()->getPathInfo()}}/17" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">B2</div>
					<a href="{{request()->getPathInfo()}}/18" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
				<div class="exam-type__test">
					<div class="exam-type__test-name">C1</div>
					<a href="{{request()->getPathInfo()}}/19" class="exam-type__test-button">{{__('exam_page.register')}}</a>
				</div>
			</div>
		</div>

	</div>
</div>

<div class="exam-information">
	<div class="container">
		<p style="margin-bottom: 174px" class="main-courses__headline">{{__('exam_page.telc_title')}}</p>
		<div class="clear"></div>
	
				@include('newpages.partial.content')
		

		</div>
	</div>
</div>

<div class="exam-single-test" id="checkLevel">
	<div class="container">
		<div class="course-tests__test fullwidth">
			<h4 class="course-tests__test-headline">
				{{$test->name}}
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
					<button class="finish-question finish-question-st" data-test="pruefung" data-rating="{{__('test.your_rating')}}" data-r1="A1" data-r2="A2" data-r3="B1" data-r4="B2" data-r5="C1" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

				</div>
			</form>
		</div>
	</div>
</div>
@endsection