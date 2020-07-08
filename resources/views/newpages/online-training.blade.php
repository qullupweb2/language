@extends('layouts.newapp', ['title' => __('learn_online.meta_title'), 'description' => __('learn_online.meta_description')])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
		</style>
	@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{__('learn_online.h1')}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{__('top_navigation.menu3')}}</li>
		</ul>
	</div>
</div>

<div class="online-training">
	<div class="container">
		<div class="online-training-details__redtext">
			<div class="online-training-details__redtext-inner">
				<h2 class="online-training-details__redtext-inner__headline">{{__('learn_online.title_red')}}</h2>
				<hr>
				<p>
					{{__('learn_online.p1')}}
				</p>
				<p>
					{{__('learn_online.p2')}}
				</p>
			</div>
		</div>
		<div class="main-courses__button" style="margin-bottom: 60px;">
			<a href="{{trim_locale(app()->getLocale())}}/pruefung-anmelden#checkLevel">{{ __('main_page.test_lvl_btn') }}</a>
		</div>
		<div class="online-training__list">
			<?php $i = 1; ?>
			@foreach($categories as $category)
			<div class="main-courses__course">
				<div class="main-courses__course-photo">
					<a href="{{request()->getPathInfo()}}/{{strtolower($category->name)}}">
						<img src="{{ asset('new/images/course'.$i.'.jpg') }}" alt="">
						<span class="main-courses__course-photo__shorttext">
							@if(app()->getLocale() == 'de')
							{{$category->description}}
							@else
								{{$category['description_'.app()->getLocale()]}}
							@endif
						</span>
					</a>
					<span class="main-courses__course-level">
						@if($category->level == 1)
							{{ __('courses.level1') }}
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
				<div class="main-courses__course-information">
					<h3><a href="{{request()->getPathInfo()}}/{{strtolower($category->name)}}" class="main-courses__course-name">{{ __('courses.course_name_online') }} {{$category->name}}</a></h3>

					<div class="main-courses__course-details">
						<span class="main-courses__course-lections">35 Lektionen</span>
						<span class="main-courses__course-time">{{$category->hourses}} Stunden</span>
					</div>
				</div>
			</div>
			<?php $i++; ?>
			@endforeach

		</div>


	</div>
</div>

<div class="online-training-details">
	<div class="container">
		<div class="online-training-details__text">
			@include('newpages.partial.content')
		</div>
	</div>
</div>
@endsection