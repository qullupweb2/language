<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <title>{{$title}}</title>
    <meta name="description" content="{{$description}}">
    <meta name="format-detection" content="telephone=no">
    <link rel="canonical" href="https://www.deutsch-kurs-hannover.com{{request()->getPathInfo()}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('new/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700&display=swap&subset=cyrillic,latin-ext" rel="stylesheet">
    <link href="{{ asset('new/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('new/fonts/fonts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('new/css/slick.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('new/css/jquery.arcticmodal-0.3.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('new/dist/simpleLightbox.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{ asset('build/css/intlTelInput.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="{{ asset('new/dist/simpleLightbox.min.js') }}"></script>
    <script src="{{ asset('new/js/slick.min.js') }}"></script>
    <script src="{{ asset('new/js/init.js') }}"></script>
    <script src="{{ asset('new/js/jquery.arcticmodal-0.3.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
    <script src="{{ asset('build/js/intlTelInput.js') }}"></script>


    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "url": "https://www.deutsch-kurs-hannover.com/",
      "contactPoint": [
        { "@type": "ContactPoint",
          "telephone": "+491788709218",
          "contactType": "customer service"
        }
      ]
    }
    </script>
    <script type="application/ld+json">{"@context":"http://www.schema.org","@type":"LocalBusiness","name":"DKH Sprachschule","email":"info@deutsch-kurs-hannover.com","image":"https://static.wixstatic.com/media/9d4fb8_a016a9f2a3cc406891da13ec49e98519~mv2.jpg/v1/fill/w_45,h_43,al_c,q_80,usm_0.66_1.00_0.01/9d4fb8_a016a9f2a3cc406891da13ec49e98519~mv2.webp","telephone":"+491788709218","url":"https://www.deutsch-kurs-hannover.com/","priceRange":"320 - 380 Euro","description":"Deutschkurse Hannover, Sprachschule Hannover, Deutschkurs Hannover, - A1 bis C1 -, Deutschkurse in Hannover, Deutschkurs in Hannover, Sprachschule in Hannover, TELC","contactPoint":[{"@type":"ContactPoint","telephone":"+491788709218","contactType":"customer service","email":"info@deutsch-kurs-hannover.com","areaServed":["Hannover"],"availableLanguage":["German"]}],"sameAs":["https://www.youtube.com/channel/UCTBcdgaucLwbLNDW3f7PvfA","https://vk.com/moment_mal","https://www.instagram.com/dkh_sprachschule/","https://www.facebook.com/DeutschKursHannover"],"address":[{"@type":"PostalAddress","addressLocality":"Hannover","addressRegion":"Niedersachsen","addressCountry":"Deutschland","postalCode":"30161","streetAddress":"Hamburger Allee 42"}],"geo":{"@type":"GeoCoordinates","latitude":52.3826443,"longitude":9.7378308},"openingHoursSpecification":{"@type":"OpeningHoursSpecification","dayOfWeek":["Monday","Tuesday","Wednesday","Thursday","Friday"],"opens":"09:00","closes":"17:00"},"aggregateRating":{"@type":"AggregateRating","ratingValue":"5","bestRating":"5","ratingCount":"134"}}</script>
</head>

<body>

<!-- Mobile Menu (START) -->

<div class="mobile-menu-body">
    <div class="container">

        <div class="mobile-menu-body__user">
            

            <a class="mobile-menu-body__user-login header__login">{{ __('top_navigation.login') }}</a>
        </div>

        <ul class="mobile-menu-body__main-list">
            <li>
                <a href="javascript:void(0);" class="mobile-menu-open-sub parent">{{ __('top_navigation.menu1') }}</a>

                <div class="mobile-menu-body__sub-list">
                    <div class="container">
                        <?php 
                        $courseSerivce = new App\Http\Services\CourseService(new App\Models\Course());
                        $categories = $courseSerivce->getCategories();

                        ?>
                        <ul>
                            <li><a class="mobile-menu-back">Back</a></li>
                            @foreach($categories as $category)
                            @if($category->id == 5)
                            <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}">

                                {{str_replace('TestDaf', '',$category->name)}} - {{ __('courses.course_name') }}

                            </a></li>

                            <li><a href="{{trim_locale(app()->getLocale())}}/testdaf-hannover">

                                {{str_replace('C1', '',$category->name)}} - {{ __('courses.course_name') }}

                            </a></li>
                            @elseif($category->id == 6)
                            <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurs-fuer-aerzte">
                            @if($category->difficult != 0)
                                {{$category->name}} - {{ __('courses.course_name') }}
                            @else
                                {{ __('courses.doctor_course') }}
                            @endif
                            </a></li>
                            @else
                            <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}">
                            @if($category->difficult != 0)
                                {{$category->name}} - {{ __('courses.course_name') }}
                            @else
                                {{ __('courses.doctor_course') }}
                            @endif
                            </a></li>
                            @endif
                            @endforeach
                            
                            
                        </ul>
                    </div>
                </div>
            </li>

            <li><a href="{{trim_locale(app()->getLocale())}}/pruefung-anmelden">{{ __('top_navigation.menu2') }}</a></li>
            <li><a href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{ __('top_navigation.menu3') }}</a></li>
            <li><a href="{{trim_locale(app()->getLocale())}}/zimmer-buchen">{{ __('top_navigation.menu4') }}</a></li>
        </ul>

    </div>
</div>


<!-- Mobile Menu (END) -->

<header class="header">
    <div class="container">
        <a href="{{trim_locale(app()->getLocale())}}/" class="header__logo">
            DKH Sprachschule
            <b>Hannover</b>
        </a>

        <ul class="header__menu">
            <li class="menu__item"><a class="menu__link" href="{{trim_locale(app()->getLocale())}}/#courses">{{ __('top_navigation.menu1') }}</a>
            <ul>
                @foreach($categories as $category)
                @if($category->id == 5)
                <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}">

                    {{str_replace('TestDaf', '',$category->name)}} - {{ __('courses.course_name_menu') }}

                </a></li>

                <li><a href="{{trim_locale(app()->getLocale())}}/testdaf-hannover">

                    {{str_replace('C1', '',$category->name)}} - {{ __('courses.course_name_menu') }}

                </a></li>
                @elseif($category->id == 6)
                <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurs-fuer-aerzte">
                        @if($category->difficult != 0)
                            {{$category->name}} - {{ __('courses.course_name_menu') }}
                        @else
                            {{ __('courses.doctor_course') }}
                        @endif
                </a></li>
                @else
                <li><a href="{{trim_locale(app()->getLocale())}}/deutschkurse-hannover-{{$category->slug}}">
                @if($category->difficult != 0)
                    {{$category->name}} - {{ __('courses.course_name_menu') }}
                @else
                    {{ __('courses.doctor_course') }}
                @endif
                </a></li>
                @endif
                @endforeach
            </ul>
            </li>
            <li class="menu__item"><a class="menu__link" href="{{trim_locale(app()->getLocale())}}/pruefung-anmelden">{{ __('top_navigation.menu2') }}</a></li>
            <li class="menu__item"><a class="menu__link" href="{{trim_locale(app()->getLocale())}}/deutsch-lernen-online-kostenlos">{{ __('top_navigation.menu3') }}</a></li>
            <li class="menu__item"><a class="menu__link" href="{{trim_locale(app()->getLocale())}}/zimmer-buchen">{{ __('top_navigation.menu4') }}</a></li>
        </ul>
        <style>
            li.li-{{app()->getLocale()}} {
                display: none;
            }
        </style>
        <div class="header__account">
            <div class="header__lang">
                <a class="header__lang-select">
                    @if(app()->getLocale() != 'ar')
                        <i class="flag flag-{{app()->getLocale()}}"></i>
                    @else
                    <svg width="20" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 512 512" style="margin-bottom: -6px;enable-background:new 0 0 512 512;" xml:space="preserve">
                    <circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/>
                        <path d="M144.696,345.043l22.261,151.036C194.689,506.37,224.686,512,256,512c110.07,0,203.906-69.472,240.076-166.957H144.696z"/>
                        <path style="fill:#6DA544;" d="M144.696,166.957l22.261-151.036C194.689,5.63,224.686,0,256,0
	c110.07,0,203.906,69.472,240.076,166.957H144.696z"/>
                        <path style="fill:#A2001D;" d="M0,256c0,110.071,69.473,203.906,166.957,240.077V15.923C69.473,52.094,0,145.929,0,256z"/></svg>
                    @endif
                    {{app()->getLocale()}}
                </a>
                <ul class="header__lang-dropdown">
                    <li class="li-de"><a href="{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-de"></i>DE</a></li>
                    <li class="li-en"><a href="/en{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-en"></i>EN</a></li>
                    <li class="li-ru"><a href="/ru{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-ru"></i>RU</a></li>
                    <li class="li-tr"><a href="/tr{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-tr"></i>TR</a></li>
                    <li class="li-es"><a href="/es{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-es"></i>ES</a></li>
                    <li class="li-zh"><a href="/zh{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-zh"></i>ZH</a></li>
                    <li class="li-fr"><a href="/fr{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-fr"></i>FR</a></li>
                    <li class="li-vi"><a href="/vi{{trim_lang(request()->getPathInfo())}}"><i class="flag flag-vi"></i>VI</a></li>
                    <li class="li-vi"><a href="/ar{{trim_lang(request()->getPathInfo())}}">
                            <svg width="20" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 512 512" style="margin-bottom: -6px;enable-background:new 0 0 512 512;" xml:space="preserve">
<circle style="fill:#F0F0F0;" cx="256" cy="256" r="256"/>
                                <path d="M144.696,345.043l22.261,151.036C194.689,506.37,224.686,512,256,512c110.07,0,203.906-69.472,240.076-166.957H144.696z"/>
                                <path style="fill:#6DA544;" d="M144.696,166.957l22.261-151.036C194.689,5.63,224.686,0,256,0
	c110.07,0,203.906,69.472,240.076,166.957H144.696z"/>
                                <path style="fill:#A2001D;" d="M0,256c0,110.071,69.473,203.906,166.957,240.077V15.923C69.473,52.094,0,145.929,0,256z"/></svg>
                            AR
                        </a>
                    </li>
                </ul>
            </div>
            @guest
                <a class="header__login">{{ __('top_navigation.login') }}</a>
            @else
                <a href="{{trim_locale(app()->getLocale())}}/personal" class="header__my-select">{{ __('top_navigation.personal') }}</a>
            @endguest
        </div>

        <div class="mobile-menu">
            <a class="mobile-menu-button"></a>
        </div>
    </div>
</header>

@yield('content')

<footer class="footer">
    <div class="footer_top">
        <div class="container">
            <div style="float: left">
                <a href="#" class="footer__logo" style="float: none; display: block;margin-bottom: 20px">
                    DKH Sprachschule
                    <b>Hannover</b>
                </a>
                <div class="social">
                    <a href="https://www.facebook.com/DeutschKursHannover" target="_blank" data-content="https://www.facebook.com/DeutschKursHannover" data-type="external" rel="noopener" id="comp-imomo2yb0imagelink" class="lb1imageItemlink">
                        <img alt="Sprachschule Hannover" data-type="image" itemprop="image" style="width: 22px; height: 22px; object-fit: cover;" src="/new/images/fb.jpg">
                    </a>
                    <a href="https://www.youtube.com/channel/UCTBcdgaucLwbLNDW3f7PvfA" target="_blank" data-content="https://www.youtube.com/channel/UCTBcdgaucLwbLNDW3f7PvfA" data-type="external" rel="noopener" id="comp-imomo2yb1imagelink" class="lb1imageItemlink">
                        <img alt="Sprachschulen Hannover" data-type="image" itemprop="image" style="width: 22px; height: 22px; object-fit: cover;" src="/new/images/youtube.jpg">
                    </a>
                    <a href="https://vk.com/moment_mal" target="_blank" data-content="https://vk.com/moment_mal" data-type="external" rel="noopener" id="comp-imomo2yb2imagelink" class="lb1imageItemlink">
                        <img alt="Deutschkurs Hannover" data-type="image" itemprop="image" style="width: 22px; height: 22px; object-fit: cover;" src="/new/images/vk.jpg">
                    </a>
                    <a href="https://www.instagram.com/dkh_sprachschule" target="_blank" data-content="https://www.instagram.com/dkh_sprachschule" data-type="external" rel="noopener" id="comp-imomo2yb3imagelink" class="lb1imageItemlink">
                        <img alt="Deutschkurs in Hannover" data-type="image" itemprop="image" style="width: 22px; height: 22px; object-fit: cover;" src="/new/images/in.jpg">
                    </a>
                </div>
            </div>
            <div class="footer__contacts">
                <p class="footer__phone">
                    <b>{{ __('contacts_info.phone_title') }}:</b>
                    <a href="tel:+491788709218">+49178 870 92 18</a>
                </p>
                <p class="footer__mail">
                    <b>{{ __('contacts_info.email_title') }}:</b>
                    <a href="mailto:info@deutsch-kurs-hannover.com">info@deutsch-kurs-hannover.com</a>
                </p>
                <p class="footer__position">
                    <b>{{ __('contacts_info.adress_title') }}:</b>
                    Hamburger Allee 42, 30161 Hannover
                </p>
            </div>
            <ul class="footer__links">
                <li><a href="{{trim_locale(app()->getLocale())}}/agb">{{ __('footer_nav.menu1') }}</a></li>
                <li><a href="{{trim_locale(app()->getLocale())}}/impressum">{{ __('footer_nav.menu2') }}</a></li>
                <li><a href="{{trim_locale(app()->getLocale())}}/datenschutz">{{ __('footer_nav.menu3') }}</a></li>
            </ul>
        </div>
    </div>

    <div class="footer__copyright">
        <div class="container">&copy; 2020 Deutsch Kurs Hannover - DKH - All rights reserved.</div>
    </div>
</footer>



<!-- popups -->

<div class="g-hidden">
    <div class="g-hidden">
        <div class="box-modal" id="modal-login">
            <div class="box-modal_close arcticmodal-close"></div>
            <div class="box-modal__headline">
                {{ __('top_navigation.login') }}
            </div>
            <form class="box-modal__form login-form" method="post" action="/login">
                @csrf
                <input name="email" type="email" placeholder="{{ __('forms.email') }}" class="modal-form__input">
                <input name="password" type="password" placeholder="{{ __('forms.password') }}" class="modal-form__input">
                <input type="hidden" name="remember" value="on">
                <div class="wrong_data">
                    {{ __('forms.wrong_data') }}
                </div>
                <input type="submit" value="{{ __('forms.login') }}" class="modal-form__button">
            </form>
        </div>
    </div>
</div>
</body>
<link rel="stylesheet" type="text/css" href="https://chat.deutsch-kurs-hannover.de/css/chat.css">
<script>
window.addEventListener("message", function(event) {

  if (event.origin == 'https://chat.deutsch-kurs-hannover.de') {
    eval(event.data);
  } else {
    return;
  }
});
var botmanWidget = {
    frameEndpoint: 'https://chat.deutsch-kurs-hannover.de/chat',
    chatServer : 'https://chat.deutsch-kurs-hannover.de/botman',
    title: 'German',
    headerTextColor: '#fff',
    aboutText: '',
    bubbleAvatarUrl: '',
    mainColor: '#13b3e6',
    bubbleBackground: '#13b3e6'
}

        
function setLocalStorage(key, value) {
    localStorage[key] = value;
}

function restartDialog() {
        botmanChatWidget.whisper('start force');
        botmanChatWidget.say('Restart bot&#173;');
}
    
</script>
<script src='https://chat.deutsch-kurs-hannover.de/js/widget.js'></script>
<a id="popup__toggle" href="#" onclick="botmanChatWidget.open(); return false;"><div class="circlephone" style="transform-origin: center;"></div><div class="circle-fill" style="transform-origin: center;"></div><div class="img-circle" style="transform-origin: center;"><img src="https://chat.deutsch-kurs-hannover.de//img/consultation.png"></div></a>
<script src="{{ asset('js/WebAudioTrack.js') }}"></script>
<script src="{{ asset('js/app_audio.js') }}"></script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
	(function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
		m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(57076675, "init", {
		clickmap:true,
		trackLinks:true,
		accurateTrackBounce:true,
		webvisor:true
	});
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/57076675" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</html>