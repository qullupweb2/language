@extends('layouts.newapp', ['title' => __('main_page.meta_title'), 'description' => __('main_page.meta_description')])

@section('content')
@if(app()->getLocale() == 'ru')
	<style>
		.main-banner__details-headline {
			font-size: 63px;
		}
	</style>
@endif
<div class="main-banner">
	<div class="container">
		<div class="main-banner__details">
			<h1 class="main-banner__details-headline">
				{{ __('main_page.h1_title') }}
			</h1>
			<p class="main-banner__details-text">
				{{ __('main_page.h1_description') }}
			</p>
			<div class="main-banner__details-buttons">
				<a href="#" target="#courses" class="main-banner__button-course leap">{{ __('main_page.order_btn') }}</a>
				<a href="#" target="#contacts" class="main-banner__button-contact leap">{{ __('main_page.contact_btn') }}</a>
				<a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos" class="main-banner__button-online leap">{{ __('main_page.learn_btn') }}</a>
			</div>
			<div class="main-banner__telc">
				<img class="lozad" data-src="{{ asset('new/images/telc-logo.png') }}" alt="">
			</div>
		</div>
	</div>
</div>

<div class="main-courses" id="courses">



	<div class="container">
		<p class="main-courses__headline">{{ __('main_page.couses_heading') }}</p>
		<div class="main-courses__button">
			<a href="{{trim_locale(app()->getLocale())}}/pruefung-anmelden#checkLevel">{{ __('main_page.test_lvl_btn') }}</a>
		</div>
		<div class="main-courses__list">
				<?php $i = 1; $url_test_h = 'testdaf-hannover'; $slug = 'deutschkurse-hannover-'; $url_deut = 'deutschkurs-fuer-aerzte'?>
                @foreach($categories as $category)
				@if($category->difficult == 4)
				<div class="course-slick">
					<div class="main-courses__course">
						<div class="main-courses__course-photo">
							<a href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}">
								<img src="{{ asset('new/images/course_c1.jpg') }}" alt="{{str_replace('TestDaf', '',$category->name)}}">
								<span class="main-courses__course-photo__shorttext">
									@if(app()->getLocale() == 'de')
									{!! $category->desc_view !!}
									@else
									<? $desc_view = 'desc_view_'.trim_locale(app()->getLocale());?>
									{!! $category->$desc_view !!}
									@endif
								</span>
							</a>
					<span class="main-courses__course-level">
						{{ __('courses.level4') }}
                	</span>
					</div>
						<div class="main-courses__course-information">
							@if($category->difficult != 0)
								<h2><a  href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}" class="main-courses__course-name">{{str_replace('TestDaf', '',$category->name)}} - {{ __('courses.course_name') }}</a></h2>
							@else
								<h2><a href="{{trim_locale(app()->getLocale())}}/deutschkurs-fuer-aerzte" class="main-courses__course-name">{{ __('courses.doctor_course') }}</a></h2>
							@endif
							<div class="main-courses__course-details">
								<span class="main-courses__course-date">@dateFormat($category->CourseMainStartDate())</span>
								<span class="main-courses__course-time">{{$category->short_description['duration']}} {{ __('courses.weeks') }}</span>
								<span class="main-courses__course-price">€ @if($category->difficult == 0) 650 @else {{$category->fisrtCourse()->price}} @endif</span>
							</div>
						</div>
					</div>
				</div>
				@endif
				<div class="course-slick">
					<div class="main-courses__course">
						<div class="main-courses__course-photo">
							<a href="{{trim_locale(app()->getLocale())}}/@if($category->difficult == 4){{$url_test_h}}@elseif($category->difficult == 0){{$url_deut}}@else{{$slug}}{{$category->slug}}@endif">
								<img src="{{ asset('new/images/course'.$i.'.jpg') }}" alt="@if($category->difficult == 4) {{str_replace('C1', '',$category->name)}} @else {{$category->name}} @endif">
								<span class="main-courses__course-photo__shorttext">
									@if($category->difficult == 4)
										{{ __('main_page.desc_view_test') }}
									@else
										@if(app()->getLocale() == 'de')
											{!! $category->desc_view !!}
										@else
											<? $desc_view = 'desc_view_'.trim_locale(app()->getLocale());?>
											{!! $category->$desc_view !!}
										@endif
									@endif
								</span>
							</a>
							<span class="main-courses__course-level">
                                @if($category->difficult == 1)
                                    {{ __('courses.level05') }}
                                @elseif($category->difficult == 05)
                                    {{ __('courses.level1') }}
                                @elseif($category->difficult == 2)
                                    {{ __('courses.level2') }}
                                @elseif($category->difficult == 3)
                                    {{ __('courses.level3') }}
                                @elseif($category->difficult == 4)
                                    {{ __('courses.level4') }}    
                                @else
                                    {{ __('courses.level5') }}
                                @endif
                            </span>
						</div>
						<div class="main-courses__course-information">
                            @if($category->difficult != 0)
							<h2><a  href="{{trim_locale(app()->getLocale())}}/@if($category->difficult == 4){{$url_test_h}}@elseif($category->difficult == 0){{$url_deut}}@else{{$slug}}{{$category->slug}}@endif"
									class="main-courses__course-name">@if($category->difficult == 4) {{str_replace('C1', '',$category->name)}}
									@else {{$category->name}} @endif - {{ __('courses.course_name') }}</a></h2>
                            @else
                            <h2><a href="{{trim_locale(app()->getLocale())}}/deutschkurs-fuer-aerzte" class="main-courses__course-name">{{ __('courses.doctor_course') }}</a></h2>
                            @endif
							<div class="main-courses__course-details">
								<span class="main-courses__course-date">@dateFormat($category->CourseMainStartDate())</span>
								<span class="main-courses__course-time">{{$category->short_description['duration']}} {{ __('courses.weeks') }}</span>
								<span class="main-courses__course-price">€ @if($category->difficult == 0) 650 @else {{$category->fisrtCourse()->price}} @endif</span>
							</div>
						</div>
					</div>
				</div>
				<? $i++; ?>
                @endforeach
		</div>
	</div>
</div>
<?/*?>
<div class="main-categories">
	<div class="container">
		<div class="main-categories__banner main-categories__banner-videos">
			<div class="main-categories__banner-details">
				<b>{{ __('main_page.videos_title') }}</b>
				<p>{{ __('main_page.videos_description') }}</p>
				<a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{ __('main_page.read_more_btn') }}</a>
			</div>
		</div>

		<div class="main-categories__banner main-categories__banner-lections">
			<div class="main-categories__banner-details">
				<b>{{ __('main_page.lections_title') }}</b>
				<p>{{ __('main_page.lections_description') }}</p>
				<a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{ __('main_page.read_more_btn') }}</a>
			</div>
		</div>

		<div class="main-categories__banner main-categories__banner-practice">
			<div class="main-categories__banner-details">
				<b>{{ __('main_page.exercises_title') }}</b>
				<p>{{ __('main_page.exercises_description') }}</p>
				<a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{ __('main_page.read_more_btn') }}</a>
			</div>
		</div>

		<div class="main-categories__banner main-categories__banner-tests">
			<div class="main-categories__banner-details">
				<b>{{ __('main_page.tests_title') }}</b>
				<p>{{ __('main_page.tests_description') }}</p>
				<a href="{{trim_locale(app()->getLocale())}}/online-tests-deutschkurs-hannover">{{ __('main_page.read_more_btn') }}</a>
			</div>
		</div>
	</div>
</div>
<?*/?>
<div class="main-slider">
	<div class="container">
		<div class="main-slider__block">
			<div class="flex_d">
				<div class="small_photo">
					<a href="/new/images/slides/Deutsch lernen hannover.jpg" title="Deutsch lernen hannover"><img src="/new/images/slides/Deutsch lernen hannover.jpg" alt="Deutsch lernen hannover" /></a>
					<a href="/new/images/slides/Deutschkurs hannover.jpg" title="Deutschkurs hannover"><img src="/new/images/slides/Deutschkurs hannover.jpg" alt="Deutschkurs hannover" /></a>
				</div>
				<a class="big_photo" href="/new/images/slides/Deutschkurse Hannover.jpg" title="Deutschkurse Hannover"><img  src="/new/images/slides/Deutschkurse Hannover.jpg" alt="Deutschkurse Hannover" /></a>
			</div>
			<div class="flex_d">
				<a class="big_photo" style="margin-left: initial; margin-right: 0.5%" href="/new/images/slides/Sprachschule Hannover.jpg" title="Sprachschule Hannover"><img src="/new/images/slides/Sprachschule Hannover.jpg" alt="Sprachschule Hannover" /></a>
				<div class="small_photo">
					<a href="/new/images/slides/DKH Sprachschule.jpg" title="DKH Sprachschule"><img src="/new/images/slides/DKH Sprachschule.jpg" alt="DKH Sprachschule" /></a>
					<a href="/new/images/slides/Sprachkurs Hannover.jpg" title="Sprachkurs Hannover"><img src="/new/images/slides/Sprachkurs Hannover.jpg" alt="Sprachkurs Hannover" /></a>
				</div>
			</div>
			<div class="flex_d">
				<div class="small_photo">
					<a href="/new/images/slides/Sprachschule in hannover.jpg" title="Sprachschule in hannover"><img src="/new/images/slides/Sprachschule in hannover.jpg" alt="Sprachschule in hannover" /></a>
					<a href="/new/images/slides/Beste Sprachschule.jpg" title="Beste Sprachschule"><img src="/new/images/slides/Beste Sprachschule.jpg" alt="Beste Sprachschule" /></a>
				</div>
				<a class="big_photo" href="/new/images/slides/Sprachschulen Hannover.jpg" title="Sprachschulen Hannover"><img src="/new/images/slides/Sprachschulen Hannover.jpg" alt="Sprachschulen Hannover" /></a>
			</div>
			<div class="flex_d">
				<a class="big_photo" style="margin-left: initial; margin-right: 0.5%" href="/new/images/slides/slidenew1.jpg" title="Deutsch lernen"><img src="/new/images/slides/slidenew1.jpg" alt="Deutsch lernen" /></a>
				<div class="small_photo">
					<a href="/new/images/slides/slidenew3.jpg" title="Sprachschule in Hannover"><img src="/new/images/slides/slidenew3.jpg" alt="Sprachschule in Hannover" /></a>
					<a href="/new/images/slides/slidenew2.jpg" title="DKH Sprachschule"><img src="/new/images/slides/slidenew2.jpg" alt="DKH Sprachschule" /></a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="main-contacts" id="contacts">
	<div class="container">
		<div class="main-contacts__address">
			<p class="main-contacts__headline">{{ __('main_page.contact_title') }}</p>

			<div class="main-contacts__address-details">
				<p class="main-contacts__phone">
					<b>{{ __('contacts_info.phone_title') }}:</b>
					<a href="tel:+491788709218">+49178 870 92 18</a>
				</p>
				<p class="main-contacts__mail">
					<b>{{ __('contacts_info.email_title') }}:</b>
					<a href="mailto:info@deutsch-kurs-hannover.com">info@deutsch-kurs-hannover.com</a>
				</p>
				<p class="main-contacts__position">
					<b>{{ __('contacts_info.adress_title') }}:</b>
					Hamburger Allee 42, 30161 Hannover
				</p>
				<p class="main-contacts__worktime">
					<b>{{ __('contacts_info.working_days_title') }}:</b>
					{{ __('contacts_info.work_days') }}: 11.00 - 14.00
				</p>
			</div>
		</div>

		<div class="main-contacts__tell-us">
			<p class="main-contacts__headline">{{ __('main_page.tell_title') }}</p>

			<div class="main-contacts__form">
				<form>
					<span>
						<input required type="text" placeholder="{{ __('forms.name') }}">
						<input required type="text" placeholder="{{ __('forms.email') }}">
						<input type="text" placeholder="{{ __('forms.phone') }}">
					</span>
					<span>
						<textarea required placeholder="{{ __('forms.message') }}"></textarea>
						<input type="submit" value="{{ __('forms.send_btn') }}">
					</span>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="main-details">
	<div class="container">
		@include('newpages.partial.content')
	</div>
</div>

<div class="main-map">
	<div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=DKH%20Sprachschule%20Hannover%20Georgstra%C3%9Fe%2011&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
</div>

<script>
    $(function () {
	    $('.main-slider__block a').simpleLightbox();
	});
</script>
@endsection