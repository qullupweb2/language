@extends('layouts.newapp', ['title' => __('zimmer_buche.meta_title'), 'description' => __('zimmer_buche.meta_description')])

@section('content')
@if(app()->getLocale() == 'ru')
	<style>
	.booking-details__text__headline {
		font-size: 51px;
	}
	</style>
@endif
<script type="text/javascript">
	 window.mindateM = '{{$min_date_m}}';
	 window.mindateF = '{{$min_date_f}}';
	 window.flatM = '{{$room_m}}';
	 window.flatF = '{{$room_f}}';
</script>
<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{ __('zimmer_buche.h1') }}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('top_navigation.menu4') }}</li>
		</ul>
	</div>
</div>

<div class="booking">
	<div class="container">
		<div class="booking__list">
			<div class="booking__list-block">
				<div class="booking__list-block-icon visa"></div>
				{{ __('zimmer_buche.card_1') }}
			</div>
			<div class="booking__list-block">
				<div class="booking__list-block-icon bed"></div>
				{{ __('zimmer_buche.card_2') }}
			</div>
			<div class="booking__list-block">
				<div class="booking__list-block-icon price"></div>
				{{ __('zimmer_buche.card_3') }}
			</div>
		</div>
		<div class="booking__list-block-button">
			<a class="course-pick">{{ __('zimmer_buche.reservation_btn') }}</a>
		</div>
	</div>
</div>

<div class="booking-details">
	<div class="container">
		<div class="booking-details__photo">
			<img src="/new/images/contact-i.png" alt="">
		</div>

		<div class="booking-details__text">
			<h2 class="booking-details__text__headline">{{ __('zimmer_buche.title') }}</h2>
			<div class="pre-wrap">{!!   __('zimmer_buche.description') !!}</div>
			<div class="booking-details__text__button">
				<a class="course-pick">{{ __('zimmer_buche.reservation_btn') }}</a>
			</div>
		</div>
	</div>
</div>

<div class="g-hidden">
	<div class="g-hidden">
		<div class="box-modal course-subscribe" id="modal-subscribe">
			<div class="box-modal_close arcticmodal-close"></div>
			<div class="headline">
				{{ __('zimmer_buche.reservation_btn') }}
			</div>
			@guest
				<form action="{{route('registerFormRoom')}}" id="register-form" method="post">
			@else
				<form action="{{route('registerFormRoomClient')}}" id="register-client-form" method="post">
			@endguest
				@csrf
				<div class="form-stripe">
					<select class="sex">
						<option value="1">{{__('zimmer_buche.male')}}</option>
						<option value="2">{{__('zimmer_buche.female')}}</option>
					</select>
					<span class="field-name">{{__('zimmer_buche.ReservationDate')}}</span>
					<input type="text" class="date date-range" placeholder="" name="date_start" required>
					<input type="hidden" name="price" value="400">
					<input type="hidden" name="room_id" value="{{$room_m}}">
					<span class="price">{{__('messages.priceforyou')}}: <b class="price_reservation">400</b> €</span>
				</div>
				@guest
				<div class="form-stripe">
					<span class="field-name">{{title_case(__('messages.firstname'))}}</span>
					<input type="text" placeholder=""  name="name" required>
					<span class="field-name">{{title_case(__('messages.lastname'))}}</span>
					<input type="text" placeholder="" name="last_name" required>
					<span class="field-name">{{title_case(__('messages.phone'))}}</span>
					<input type="text" placeholder="_ ___ ___ __ __" name="phone" required>
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
					@endguest
					<input required id="check4" type="checkbox" name="subs1">
					<label for="check4">{{__('messages.accept')}} <a href="https://www.deutsch-kurs-hannover.com/agb" target="_blank">{{__('messages.schoolrules')}}</a></label>
					<input required id="check5" type="checkbox" name="subs1">
					<label for="check5">{!! __('messages.getrulest') !!}</label>
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