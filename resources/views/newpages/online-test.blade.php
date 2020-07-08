@extends('layouts.newapp', ['title' =>  __('test.meta_title') , 'description' => __('test.meta_description')])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
		</style>
	@endif
<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{__('test.plural_title')}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{__('test.plural_title')}}</li>
		</ul>
	</div>
</div>

<div class="online-test">
	<div class="container">
		<div class="online-test__list">

			<div class="exam-type__test">
				<span>Test</span>
				<h5 class="exam-type__test-name">A1</h5>
				<a href="#test1" class="exam-type__test-button">Test starten</a>
			</div>
			<div class="exam-type__test">
				<span>Test</span>
				<h5 class="exam-type__test-name">A2</h5>
				<a href="#test2" class="exam-type__test-button">Test starten</a>
			</div>
			<div class="exam-type__test">
				<span>Test</span>
				<h5 class="exam-type__test-name">B1</h5>
				<a href="#test3" class="exam-type__test-button">Test starten</a>
			</div>
			<div class="exam-type__test">
				<span>Test</span>
				<h5 class="exam-type__test-name">B2</h5>
				<a href="#test4" class="exam-type__test-button">Test starten</a>
			</div>
			<div class="exam-type__test">
				<span>Test</span>
				<h5 class="exam-type__test-name">C1</h5>
				<a href="#test5" class="exam-type__test-button">Test starten</a>
			</div>

		</div>

		<div class="tests-tabs">

			<div class="course-tests__test fullwidth top-margin tab-for-test" id="test1">
					<h4 class="course-tests__test-headline">
						{{$testa1->level}}
						<span>{{ __('test.question') }} <i class="current">1</i> / {{count($testa1->value)}}</span>
					</h4>
					<form>
                        <?php $i = 0; ?>
						@foreach($testa1->value as $question)
                            <?php $i++; ?>
							<div class="course-tests__test-question @if($i != 1) hide-question @endif">
								<p>{{$question['question']}}</p>

								<input id="radio{{$testa1->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
								<label for="radio{{$testa1->id}}{{$i}}-a">{{$question['a']}}</label>
								<input id="radio{{$testa1->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
								<label for="radio{{$testa1->id}}{{$i}}-b">{{$question['b']}}</label>
								<input id="radio{{$testa1->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
								<label for="radio{{$testa1->id}}{{$i}}-c">{{$question['c']}}</label>
								<input id="radio{{$testa1->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
								<label for="radio{{$testa1->id}}{{$i}}-d">{{$question['d']}}</label>
							</div>
						@endforeach
						<div class="course-tests__test-buttons">
							<input type="hidden" name="current" value="1">
							<input type="hidden" name="score" value="0">
							<input type="hidden" name="total" value="{{count($testa1->value)}}">
							<button class="next-question">{{ __('test.next') }}</button>
							<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

						</div>
					</form>
			</div>

			<div class="course-tests__test fullwidth top-margin tab-for-test" id="test2">
						<h4 class="course-tests__test-headline">
							{{ __('test.title') }} {{$testa2->level}}
							<span>{{ __('test.question') }} <i class="current">1</i> / {{count($testa2->value)}}</span>
						</h4>
						<form>
                            <?php $i = 0; ?>
							@foreach($testa2->value as $question)
                                <?php $i++; ?>
								<div class="course-tests__test-question @if($i != 1) hide-question @endif">
									<p>{{$question['question']}}</p>

									<input id="radio{{$testa2->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
									<label for="radio{{$testa2->id}}{{$i}}-a">{{$question['a']}}</label>
									<input id="radio{{$testa2->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testa2->id}}{{$i}}-b">{{$question['b']}}</label>
									<input id="radio{{$testa2->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testa2->id}}{{$i}}-c">{{$question['c']}}</label>
									<input id="radio{{$testa2->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testa2->id}}{{$i}}-d">{{$question['d']}}</label>
								</div>
							@endforeach
							<div class="course-tests__test-buttons">
								<input type="hidden" name="current" value="1">
								<input type="hidden" name="score" value="0">
								<input type="hidden" name="total" value="{{count($testa2->value)}}">
								<button class="next-question">{{ __('test.next') }}</button>
								<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

							</div>
						</form>
			</div>

			<div class="course-tests__test fullwidth top-margin tab-for-test" id="test3">
						<h4 class="course-tests__test-headline">
							{{ __('test.title') }} {{$testb1->level}}
							<span>{{ __('test.question') }} <i class="current">1</i> / {{count($testb1->value)}}</span>
						</h4>
						<form>
                            <?php $i = 0; ?>
							@foreach($testb1->value as $question)
                                <?php $i++; ?>
								<div class="course-tests__test-question @if($i != 1) hide-question @endif">
									<p>{{$question['question']}}</p>

									<input id="radio{{$testb1->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
									<label for="radio{{$testb1->id}}{{$i}}-a">{{$question['a']}}</label>
									<input id="radio{{$testb1->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb1->id}}{{$i}}-b">{{$question['b']}}</label>
									<input id="radio{{$testb1->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb1->id}}{{$i}}-c">{{$question['c']}}</label>
									<input id="radio{{$testb1->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb1->id}}{{$i}}-d">{{$question['d']}}</label>
								</div>
							@endforeach
							<div class="course-tests__test-buttons">
								<input type="hidden" name="current" value="1">
								<input type="hidden" name="score" value="0">
								<input type="hidden" name="total" value="{{count($testb1->value)}}">
								<button class="next-question">{{ __('test.next') }}</button>
								<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

							</div>
						</form>
			</div>

			<div class="course-tests__test fullwidth top-margin tab-for-test" id="test4">
						<h4 class="course-tests__test-headline">
							{{ __('test.title') }} {{$testb2->level}}
							<span>{{ __('test.question') }} <i class="current">1</i> / {{count($testb2->value)}}</span>
						</h4>
						<form>
                            <?php $i = 0; ?>
							@foreach($testb2->value as $question)
                                <?php $i++; ?>
								<div class="course-tests__test-question @if($i != 1) hide-question @endif">
									<p>{{$question['question']}}</p>

									<input id="radio{{$testb2->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
									<label for="radio{{$testb2->id}}{{$i}}-a">{{$question['a']}}</label>
									<input id="radio{{$testb2->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb2->id}}{{$i}}-b">{{$question['b']}}</label>
									<input id="radio{{$testb2->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb2->id}}{{$i}}-c">{{$question['c']}}</label>
									<input id="radio{{$testb2->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testb2->id}}{{$i}}-d">{{$question['d']}}</label>
								</div>
							@endforeach
							<div class="course-tests__test-buttons">
								<input type="hidden" name="current" value="1">
								<input type="hidden" name="score" value="0">
								<input type="hidden" name="total" value="{{count($testb2->value)}}">
								<button class="next-question">{{ __('test.next') }}</button>
								<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

							</div>
						</form>
			</div>

			<div class="course-tests__test fullwidth top-margin tab-for-test" id="test5">
						<h4 class="course-tests__test-headline">
							{{ __('test.title') }} {{$testc1->level}}
							<span>{{ __('test.question') }} <i class="current">1</i> / {{count($testc1->value)}}</span>
						</h4>
						<form>
                            <?php $i = 0; ?>
							@foreach($testc1->value as $question)
                                <?php $i++; ?>
								<div class="course-tests__test-question @if($i != 1) hide-question @endif">
									<p>{{$question['question']}}</p>

									<input id="radio{{$testc1->id}}{{$i}}-a" @if($question['answer'] == 'a') class="correct_item" @endif  type="radio" name="question{{$i}}" >
									<label for="radio{{$testc1->id}}{{$i}}-a">{{$question['a']}}</label>
									<input id="radio{{$testc1->id}}{{$i}}-b" @if($question['answer'] == 'b') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testc1->id}}{{$i}}-b">{{$question['b']}}</label>
									<input id="radio{{$testc1->id}}{{$i}}-c" @if($question['answer'] == 'c') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testc1->id}}{{$i}}-c">{{$question['c']}}</label>
									<input id="radio{{$testc1->id}}{{$i}}-d" @if($question['answer'] == 'd') class="correct_item" @endif  type="radio" name="question{{$i}}">
									<label for="radio{{$testc1->id}}{{$i}}-d">{{$question['d']}}</label>
								</div>
							@endforeach
							<div class="course-tests__test-buttons">
								<input type="hidden" name="current" value="1">
								<input type="hidden" name="score" value="0">
								<input type="hidden" name="total" value="{{count($testc1->value)}}">
								<button class="next-question">{{ __('test.next') }}</button>
								<button class="finish-question" data-rating="{{__('test.your_rating')}}" data-r1="{{__('test.rating1')}}" data-r2="{{__('test.rating2')}}" data-r3="{{__('test.rating3')}}" data-r4="{{__('test.rating4')}}" data-r5="{{__('test.rating5')}}" data-result="{{ __('test.result') }}">{{ __('test.finish_btn') }}</button>

							</div>
						</form>
			</div>

		</div>

	</div>
</div>

<div class="main-details-inner">
	<div class="container">
		@include('newpages.partial.content')
	</div>
</div>
@endsection