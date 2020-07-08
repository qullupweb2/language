@extends('layouts.newapp', ['title' => __('course_reg.registration').' '.$course->name, 'description' => ""])

@section('content')
@if(app()->getLocale() == 'ru')
	<style>
	</style>
@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{__('course_reg.registration').' '.$course->name}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
			@if($category->difficult != 0)
				<li class="inner-banner__breadcrumbs__item"><a href="{{str_replace('register', '', request()->getPathInfo())}}">{{$category->name}} {{ __('courses.course_name') }}</a></li>
			@else
				<li class="inner-banner__breadcrumbs__item">{{ __('courses.doctor_course') }}</li>
			@endif
			<li class="inner-banner__breadcrumbs__item">{{ __('course_reg.registration') }}</li>
		</ul>
	</div>
</div>

<div class="lesson-list">
	<div class="container">

		<table class="course-table">
			<thead>
				<tr>
					<td>{{__('course_reg.start_date')}}</td>
					<td>{{__('course_reg.course_time')}}</td>
					<td>{{__('course_reg.duration')}}</td>
					<td>{{__('course_reg.price')}}</td>
				</tr>
			</thead>
			<?php $i = 0; ?>
			@foreach($course->similars() as $similar)
                <?php $i++; ?>
                <?php if($i > 10) continue; ?>
				@if($similar->price !== null && $similar->available)

						<tr>
							<td>@dateFormat($similar->start_date)</td>
							<td>
								@if(app()->getLocale() !== 'de')
									{{$similar['how_often_'.app()->getLocale()]}}
								@else
									{{$similar->how_often}}
								@endif
							</td>
							<td>{{$similar->duration}} {{__('courses.weeks')}}</td>
							<td>@if($course->category_id < 6) <strike>400</strike> @endif {{$similar->price}} Euro</td>
						</tr>

				@endif
			@endforeach

		</table>
<? $url = explode('/', $_SERVER['REQUEST_URI']); echo $url[2] ?>
		<div class="course-table__button">
			<a class="course-pick">{{__('messages.register')}}</a>
		</div>

		<div class="course-table__details">
			{!! $category['description_'.app()->getLocale()] ?? $category['description_en'] !!}
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
				<form action="{{route('registerForm')}}" id="register-form" method="post">
			@else
				<form action="{{route('registerFormClient')}}" id="register-client-form" method="post">
			@endguest
				@csrf
				<div class="form-stripe">
					<span class="field-name">{{__('messages.whenStart')}} ({{$course->name}})</span>
					<select class="next0 orig-select" name="whenStart[]" data-pricetext="<h5>{{$course->name}}</h5>{{$similars[0]->category()->price_description}}" class="orig-select">
						@foreach($similars as $similar)
							@if($similar->price !== null && $similar->available)
								<option @if(request('date') == $similar->id) selected @endif data-price="{{$similar->price}}" value="{{$similar->id}}" data-date="@toUnix($similar->start_date)"
 									data-date_end="@toUnix($similar->end_date)">@dateFormat($similar->start_date) |
									@if(app()->getLocale() !== 'de')
										{{$similar['how_often_'.app()->getLocale()]}}
									@else
										{{$similar->how_often}}
									@endif
								</option>
							@endif
						@endforeach
					</select>


					<style type="text/css">
						b {
							font-weight: bold !important;
						}
						.hidden {
							display: none;
						}
					</style>

					<!-- DOP DAYS -->


					@if($next1Courses !== null)
					<div class="check1_class">
						<input id="check1" type="checkbox" class="show_select">
						<label for="check1">{{__('messages.nextCourseText')}} (<b>{{$next1Courses[0]->name}}</b>)</label>
						<select class="form-control hidden next1"  aria-describedby="whenStartHelp" name="" data-pricetext="<h5>{{$next1Courses[0]->name}}</h5>{{$next1Courses[0]->category()->price_description}}">
							@foreach($next1Courses as $next1)
								@if($next1->price !== null && $next1->available)
									<option data-price="{{$next1->price}}" data-date="@toUnix($next1->start_date)" value="{{$next1->id}}"
											data-date_end="@toUnix($next1->end_date)">@dateFormat($next1->start_date) |
										@if(app()->getLocale() !== 'de')
											{{$next1['how_often_'.app()->getLocale()]}}
										@else
											{{$next1->how_often}}
										@endif
									</option>
								@endif
							@endforeach
						</select>
					</div>
					@endif

					@if($next2Courses !== null)
					<div class="check2_class hidden">
					<input id="check2" type="checkbox" class="show_select2">
					<label for="check2">{{__('messages.nextCourseText')}} (<b>{{$next2Courses[0]->name}}</b>)</label>
					<select class="form-control hidden next2"  aria-describedby="whenStartHelp" name="" data-pricetext="<h5>{{$next2Courses[0]->name}}</h5>{{$next2Courses[0]->category()->price_description}}">
						@foreach($next2Courses as $next2)
							@if($next2->price !== null && $next2->available)
								<option data-price="{{$next2->price}}" value="{{$next2->id}}" data-date="@toUnix($next2->start_date)">@dateFormat($next2->start_date) |
									@if(app()->getLocale() !== 'de')
										{{$next2['how_often_'.app()->getLocale()]}}
									@else
										{{$next2->how_often}}
									@endif
								</option>
							@endif
						@endforeach
					</select>
					</div>
					@endif
					<?
						$desc = 'price_description';
						if(app()->getLocale() != 'de') $desc = 'price_description_' . trim_locale(app()->getLocale());
					?>

					<span class="price">{{__('messages.priceforyou')}}: @if($course->category_id < 6) <strike style="color: #424242;" class="strike">400</strike> @endif <b>{{ $similars[0]->price }}</b> € <a class="question" data-tooltip="<h5>{{$course->name}}</h5>{{$similars[0]->category()->$desc}}">?</a></span>
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
				</div>
				@endguest

				<div class="form-stripe">
					@guest
					<span class="field-name">{{title_case(__('messages.adress'))}}</span>
					<input type="text" name="country" required placeholder="{{__('messages.land')}}">
					<input type="text" name="street" required placeholder="{{__('messages.street')}}">
					<input type="text" name="city" required placeholder="{{__('messages.city')}}">
					<input type="text" name="zip" required placeholder="{{__('messages.zip')}}">

					<input id="check23" type="checkbox" name="subs1">
					<label for="check23">{!!__('messages.ifrom')!!}</label>

					<div class="ifrom hidden">
						<label style="padding-left:0">{{title_case(__('messages.passport_data'))}}</label>
						<input type="text" name="passport_data" placeholder="passport data">
					</div>

					@endguest

					<input id="check3" type="checkbox" name="consul">
					<label for="check3">{!!__('messages.ineedconfirmed')!!}</label>
					<input required id="check4" type="checkbox" name="subs1">
					<label for="check4">{{__('messages.accept')}} <a href="/agb" target="_blank">{{__('messages.schoolrules')}}</a></label>
					<input required id="check5" type="checkbox" name="subs1">
					<label for="check5">{!! __('messages.getrulest') !!}</label>
					<input required id="check6" type="checkbox" name="subs1">
					<label for="check6">{!! __('messages.noback_rules') !!}</label>
					<input id="check7" type="checkbox" name="send_sms_confrim">
					<label for="check7">{!! __('messages.send_sms_confrim') !!}</label>
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