@extends('layouts.newapp', ['title' => __('sprachschule.meta_title'), 'description' => __('sprachschule.meta_description')])

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
                    {{ __('sprachschule.h1_title') }}
                </h1>
                <p class="main-banner__details-text">
                    {{ __('sprachschule.h1_description') }}
                </p>
                <div class="main-banner__details-buttons">
                    <a href="/#courses" class="main-banner__button-course">{{ __('sprachschule.order_btn') }}</a>
                    <a href="/#contacts" class="main-banner__button-contact">{{ __('sprachschule.contact_btn') }}</a>
                </div>
                <div class="main-banner__telc">
                    <img class="lozad" data-src="{{ asset('new/images/telc-logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
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
            </div>
        </div>
    </div>


    <div class="main-map">
        <div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=DKH%20Sprachschule%20Hannover%20Georgstra%C3%9Fe%2011&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
    </div>

    <div class="main-details">
        <div class="container">
            @include('newpages.partial.content')
        </div>
    </div>


        <script>
			$(function () {
				$('.main-slider__block a').simpleLightbox();
			});
        </script>
@endsection