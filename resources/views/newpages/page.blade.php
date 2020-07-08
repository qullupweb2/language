@if(app()->getLocale() == 'de')
    <?php $title = $page->title; ?>
@else
    <?php $title = $page['title_'.app()->getLocale()]; ?>
@endif
@extends('layouts.newapp', ['title' => $title, 'description' => ""])

@section('content')

<div class="inner-banner">
    <div class="container">
        <h1 class="inner-banner__headline">
            @if(app()->getLocale() == 'de')
                {{$page->title}}
            @else
                {{$page['title_'.app()->getLocale()]}}
            @endif

        </h1>

        <ul class="inner-banner__breadcrumbs">
            <li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{ __('main_page.title') }}</a></li>
            <li class="inner-banner__breadcrumbs__item">
                @if(app()->getLocale() == 'de')
                    {{$page->title}}
                @else
                    {{$page['title_'.app()->getLocale()]}}
                @endif
            </li>
        </ul>
    </div>
</div>

<div class="lesson-list">
    <div class="container">
        @if(app()->getLocale() == 'de')
            {!! $page->content !!}
        @else
            {!! $page['content_'.app()->getLocale()] !!}
        @endif
    </div>
</div>
@endsection
