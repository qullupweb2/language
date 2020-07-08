@extends('layouts.newapp', ['title' => __('contact_page.meta_title'), 'description' => __('contact_page.meta_description')])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>

		</style>
	@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{ __('contact_page.h1') }}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('contact_page.h1') }}</li>
		</ul>
	</div>
</div>

<div class="contact-content">
	<div class="container">
		<div class="contact-content__left">
			<h3 class="contact-content__left__headline">{{ __('contact_page.h3')  }}</h3>
			<p>{{ __('contact_page.description')  }}</p>
		</div>

		<div class="contact-content__form">
			<form>
				<input required type="text" placeholder="{{ __('forms.name') }}" class="contact-content__form__input">
				<input required type="text" placeholder="{{ __('forms.email') }}" class="contact-content__form__input">
				<textarea required placeholder="{{ __('forms.message') }}" class="contact-content__form__textarea"></textarea>
				<input type="submit" value="{{ __('forms.send_btn') }}" class="contact-content__form__button">
			</form>
		</div>
	</div>
</div>

<div class="contact-details">
	<div class="container">
		<div class="contact-details__block">
			<div class="contact-details__block__icon">
				<span class="phone"></span>
			</div>
			<div class="contact-details__block__text">
				<b>{{ __('contacts_info.phone_title') }}:</b>
				<a href="tel:+491788709218">+49178 870 92 18</a>
			</div>
		</div>

		<div class="contact-details__block">
			<div class="contact-details__block__icon">
				<span class="email"></span>
			</div>
			<div class="contact-details__block__text">
				<b>{{ __('contacts_info.email_title') }}:</b>
				<a href="mailto:Example@gmail.com">info@deutsch-kurs-hannover.com</a>
			</div>
		</div>

		<div class="contact-details__block">
			<div class="contact-details__block__icon">
				<span class="geo"></span>
			</div>
			<div class="contact-details__block__text">
				<b>{{ __('contacts_info.adress_title') }}:</b>
				Georgstraße 11 30159
			</div>
		</div>
	</div>
</div>
@endsection
