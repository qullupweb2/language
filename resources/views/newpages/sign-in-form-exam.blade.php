@extends('layouts.newapp', ['title' => __('course_reg.registration_exam').' '.$exam->name, 'description' => ""])

@section('content')
@if(app()->getLocale() == 'ru')
	<style>
	</style>
@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{__('course_reg.registration_exam').' '.$exam->name}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/pruefung-anmelden">{{ __('top_navigation.menu2') }}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('course_reg.registration_exam') }}</li>
		</ul>
	</div>
</div>

<div class="lesson-list">
	<div class="container">

		<div class="course-table__details">
			@if(app()->getLocale() == 'de')
				{!! $exam['description'] !!}
			@else
				<?= $exam['description_'.trim_locale(app()->getLocale())];?>
			@endif
		</div>

		<div class="course-table__button">
			<a class="course-pick">{{__('messages.register')}}</a>
		</div>

	</div>
</div>

<div class="g-hidden">
	<div class="g-hidden">
		<div class="box-modal course-subscribe" id="modal-subscribe">
			<div class="box-modal_close arcticmodal-close"></div>
			<div class="headline">
				{{__('messages.formtitle')}}
			</div>
			@guest
				<form action="{{route('registerFormExam')}}" id="register-form" method="post">
			@else
				<form action="{{route('registerFormExamClient')}}" id="register-client-form" method="post">
			@endguest
				@csrf
				<div class="form-stripe">
					<span class="field-name">{{__('messages.whenStartExam')}}</span>
					<select name="whenStart"  class="orig-select">
						@foreach($similars as $similar)

							<option value="{{$similar->id}}">
								@if($similar->start_date == '2022-06-06 00:00:00')
									Bald
								@else
									@dateFormat($similar->start_date)
								@endif
							</option>

						@endforeach
					</select>
				</div>
				@guest
				<div class="form-stripe">
					<span class="field-name">{{title_case(__('messages.firstname'))}}</span>
					<input type="text" placeholder=""  name="name" required>
					<span class="field-name">{{title_case(__('messages.lastname'))}}</span>
					<input type="text" placeholder="" name="last_name" required>
					<span class="field-name">{{title_case(__('messages.phone'))}}</span>
					<input type="text" name="phone" required style="padding-left: 50px">
					<span class="field-name">{{title_case(__('messages.birthday'))}}</span>
					<input type="text" class="date" placeholder="25.01.1990" name="birthDay" required>
					<span class="field-name">{{title_case(__('messages.email'))}}</span>
					<input type="email" placeholder="example@gmail.com" name="email" required>
					<span class="comment">{{__('messages.emailhelp')}}</span>
					<label for="passnum">{{title_case(__('messages.passport_number'))}}</label>
					<input type="text" required class="form-control" name="passport_number">
				</div>
				@endguest

				<div class="form-stripe">
					@guest
					<span class="field-name">{{title_case(__('messages.adress'))}}</span>
					<input type="text" name="country" required placeholder="{{__('messages.land')}}">
					<input type="text" name="street" required placeholder="{{__('messages.street')}}">
					<input type="text" name="city" required placeholder="{{__('messages.city')}}">
					<input type="text" name="zip" required placeholder="{{__('messages.zip')}}">
					@endguest
					<input required id="check4" type="checkbox" name="subs1">
					<label for="check4">{{__('messages.accept')}} <a href="/agb" target="_blank">{{__('messages.schoolrules')}}</a></label>
					<input required id="check5" type="checkbox" name="subs1">
					<label for="check5">{!! __('messages.getrulest') !!}</label>
					<input required id="check6" type="checkbox" name="subs1">
					<label for="check6">{!! __('messages.noback_rules') !!}</label>
				</div>

				<div class="form-buttons">
					<button>{{__('messages.register')}}</button>
					<button class="cancel">{{__('messages.cancel')}}</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection