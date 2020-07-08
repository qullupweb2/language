@extends('layouts.newapp', ['title' => __('lesson_list.meta_title').' '.$category->name.'-'.__('lesson_list.kurs'), 'description' => __('lesson_list.meta_description')])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
		</style>
	@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline"> {{__('lesson_list.h1')}} {{$category->name}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{__('top_navigation.menu3')}}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('courses.course_name_online') }} {{$category->name}}</li>
		</ul>
	</div>
</div>

<div class="lesson-list">
	<div class="container">
		<div class="main-courses__button" style="margin-bottom: 60px;">
			<a style="width: 340px;" href="{{$link_register}}">{{__('lesson_list.link_register')}}</a>
		</div>
		@foreach($lessons as $lesson)
		<a href="{{request()->getPathInfo()}}/{{$lesson->slug}}" class="lesson-list__item">
			<div class="lesson-list__item__photo">
				<img src="{{$lesson->img_cdn_url}}" alt="{{$lesson->title}}">
			</div>
			<div class="lesson-list__item__detailed">
				<h6 class="lesson-list__item__headline">
					<span class="lesson-list__span">
						@if(app()->getLocale() == 'de')
							{{$lesson->title}}
						@else
							{{$lesson['title_'.app()->getLocale()]}}
						@endif
					</span>

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
				</h6>
				<div class="lesson-list__item_desc">

					@if(app()->getLocale() == 'de')

						{!!$lesson->description!!}
					@else
						{!!$lesson['description_'.app()->getLocale()]!!}
					@endif

				</div>

			</div>
		</a>
		@endforeach


	</div>
</div>
@endsection