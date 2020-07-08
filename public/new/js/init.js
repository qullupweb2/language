$(document).ready(function() {

    const observer = lozad();
    observer.observe();

    window.price = {
        'orig' : 0,
        'next1' : 0,
        'next2' : 0
    };

    window.audio;

    $('.date').mask('00.00.0000');

    $('.date-range').daterangepicker({
        startDate: moment(window.mindateM, "DD.MM.YYYY"),
        minDate: moment(window.mindateM, "DD.MM.YYYY"),
        endDate: moment(window.mindateM, "DD.MM.YYYY").add(31, 'day'),
        locale: {
          format: 'DD.MM.YYYY'
        }
    }, function(start, end, label) {
        var days = end.diff( start, 'days');

        if(days < 31) {
            $('.date-range').data('daterangepicker').setStartDate(start);
            $('.date-range').data('daterangepicker').setEndDate(start.add(1, 'month'));
            $('.price_reservation').text(400);
            $('input[name="price"]').val(400);
        } else {
            var endprice = parseInt(400/31*days);
            $('input[name="price"]').val(endprice);
            $('.price_reservation').text(endprice);
        }

      });

    $('.sex').change(function() {
        if($(this).val() == 1) {
            //Мужской
            //$('.date-range').data('daterangepicker').minDate(moment(window.mindateM, "DD.MM.YYYY"));
            $('.date-range').data('daterangepicker').setStartDate(moment(window.mindateM, "DD.MM.YYYY"));
            $('.date-range').data('daterangepicker').setEndDate(moment(window.mindateM, "DD.MM.YYYY").add(1, 'month'));
            $('input[name="room_id"]').val(window.flatM);
        } else {
            //Женский
            //$('.date-range').data('daterangepicker').minDate(moment(window.mindateF, "DD.MM.YYYY"));
            $('.date-range').data('daterangepicker').setStartDate(moment(window.mindateF, "DD.MM.YYYY"));
            $('.date-range').data('daterangepicker').setEndDate(moment(window.mindateF, "DD.MM.YYYY").add(1, 'month'));
            $('input[name="room_id"]').val(window.flatF);
        }
    });



    $(document).ready(function(){
        $(".leap").on("click", function(e){
            var anchor = $(this);
            $('html, body').stop().animate({
                scrollTop: $(anchor.attr('target')).offset().top
            }, 777);
            e.preventDefault();
            return false;
        });
    });
    $('.header__login').click(function() {
        $('#modal-login').arcticmodal();
    });
    $('.course-pick').click(function() {
        $('#modal-subscribe').arcticmodal();
    });



     /* Mobile Menu (START) */

     $('.mobile-menu-open').click(function() {
        $('.mobile-menu-body').fadeIn();
    });
    $('.mobile-menu-close').click(function() {
        $('.mobile-menu-body').fadeOut();
    });

    $('.mobile-menu-button').click(function() {
        $(this).toggleClass('close');
        $('.mobile-menu-body').toggleClass('opened');
        if ($('.mobile-menu-body__sub-list').hasClass('opened')) {
            $('.mobile-menu-body__sub-list').removeClass('opened');
        }
    });
    $('.mobile-menu-open-sub').click(function() {
        $(this).next('.mobile-menu-body__sub-list').addClass('opened');
    });
    $('.mobile-menu-back').click(function() {
        $(this).parent().parent().parent().parent('.mobile-menu-body__sub-list').removeClass('opened');
    });

    /* Mobile Menu (END) */

    $('.course-schedule__next-date a').click( function () {
        $(this).parent().parent().find('.hide-row').show();
        $(this).hide();

        return false;
    });

    $('.main-details__text-button a').click(function() {
        autoHeightAnimate($('.part_content'), 500);
        $('.main-details__text-button a').slideToggle();
    });


    $('.slider-about').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        centerMode: true,
        variableWidth: true
    });
    $('.slider-courses').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        variableWidth: true,
        dots: true,
        arrows: true,
        infinite: true,
        responsive: [
            {
                breakpoint: 1140,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });


    $(".exam-type__tests").hide();
    $(".exam-type__block-button a").click(function() {
        $(".exam-type__block-button a").removeClass("active");
        $(this).addClass("active");
        $(".exam-type__tests").hide();
        var activeExamTab = $(this).attr("href");
        $(activeExamTab).fadeIn();
        return false;
    });


    //$(".lesson-card__content").hide();
    //$(".lesson-card__content:first").show();
    //$(".lesson-card__tabs li:first a").addClass("active");
    $(".lesson-card__tabs li a").click(function() {
        $(".lesson-card__tabs li a").removeClass("active");
        $(this).addClass("active");
        $(".lesson-card__content").hide();
			var activeLessonCardTab = $(this).attr("href");
			$(activeLessonCardTab).fadeIn();
			return false;
	});


	$(".tab-for-test").hide();
	$(".exam-type__test-button").click(function() {
		$(".exam-type__test-button").removeClass("active");
		$(this).addClass("active");
		$(".tab-for-test").hide();
		var activeLessonCardTab = $(this).attr("href");
		$(activeLessonCardTab).fadeIn();
		return false;
	});

	$(".exam-type__test-button").click(function() { $('html, body').animate({ scrollTop: $(".tests-tabs").offset().top }, 500); });
	$(".exam-type__block-button a").click(function() { $('html, body').animate({ scrollTop: $(".exam-type__tests-tabs").offset().top }, 500); });


	$('.course-tests__test-question').find('input[type="radio"]').change(function () {

		if($(this).hasClass('correct_item')) {
			var input = $(this).parent().parent().find('input[name="score"]');
			input.val(parseInt(input.val())+1);
		} else {
			//$(this).next().addClass('error');
			//$(this).parent().find('.correct_item').prop('checked', true);
		}
		$(this).parent().find('input[type="radio"]').prop('disabled', true);
	});


	function Answers_test(q, a) {
		this.question = q;
		this.answer = a;
	}


    $('.finish-question').click( function (e) {
		var check = 0;
		var struct = [];

		if($('input[type="radio"]')) {
			$('input[type="radio"]:checked').each(function () {
				//console.log($(this).closest('div').find('p').text());//Question
				//console.log($("label[for='"+$(this).attr('id')+"']").text());//Answer
				struct.push(new Answers_test($(this).closest('div').find('p').text(), $("label[for='" + $(this).attr('id') + "']").text()));
			});
			$('[name="test_answers"]').val(JSON.stringify(struct));
		}

        if ($('.course-tests__test').hasClass('test_oral')) check = 1;

		$('[type="radio"]').each(function(key, index) {
			if($(this).prop('checked')) {
				check = 1;
            }
		});

		if ($('[name="letter"]').length && $('[name="letter"]').val().length > 3) check = 1;
		if ($('[name="letter"]').length && $('[name="letter"]').val().length < 3) alert('Letter required!');

        if($(this).hasClass('send-result') && check == 1) {
            $('#res-fr').submit();
        }
        else if (!$(this).hasClass('finish-question-st')) {
			e.preventDefault();
			return;
        }

        var score = $(this).parent().find('input[name="score"]').val();
        var total = $(this).parent().find('input[name="total"]').val();

        var points = (parseInt(score)/parseInt(total))*100/2;

        console.log(points);

		if($(this).data('test') != 'pruefung') {
			if (points <= 10) {
				var res = $(this).data('r1');
			} else if (points > 10 && points <= 20) {
				var res = $(this).data('r2');
			} else if (points > 20 && points <= 30) {
				var res = $(this).data('r3');
			} else if (points > 40 && points < 50) {
				var res = $(this).data('r4');
			} else if (points === 50) {
				var res = $(this).data('r5');
			}
		}
		else {
			switch (points) {
				case (points <= 20): var res = 'A1.1'; break;
				case (points > 20 && points <= 25): var res = 'A1.2'; break;
				case (points > 25 && points <= 30): var res = 'A2.1'; break;
				case (points > 30 && points < 35): var res = 'A2.2'; break;
				case (points > 35 && points < 40): var res = 'B1.1'; break;
				case (points > 40 && points < 45): var res = 'B1.2'; break;
				case (points > 45 && points < 50): var res = 'B2.1'; break;
				case (points > 50 && points < 55): var res = 'B2.2'; break;
				case (points > 55): var res = 'C1'; break;
				default: var res = 'A1.1';
			}
		}

		if (!$('.course-tests__test').hasClass('test_oral')) {
        	$(this).parent().prev().html(
        		'<p class="course-tests__test-buttons__result">'+$(this).data('rating')+': '+res +
				'</p><p class="course-tests__test-buttons__result">'
				+ $(this).data('result').replace('%score', score).replace('%total', total)+'</p>'
			);
		}
        $(this).parent().hide();
        e.preventDefault();
    });

    $('.next-question-st').click(function (e) {
        var input = $(this).parent().find('input[name="current"]');
        var total = parseInt($(this).parent().find('input[name="total"]').val());
        var current = $(this).parent().parent().parent().find('.current');
        var newval = parseInt(input.val())+1;
        input.val(newval);
        current.text(newval);


        if(newval === total) {
            $(this).hide();
            $(this).next().show();
        }

        var parent = $(this).parent().parent();
        parent.find('.course-tests__test-question').not('.hide-question').addClass('hide-question').next().removeClass('hide-question');
        e.preventDefault();
    });


    $('.next-question').click(function (e) {
		var input = $(this).parent().find('input[name="current"]');
		var total = parseInt($(this).parent().find('input[name="total"]').val());
		var current = $(this).parent().parent().parent().find('.current');//course-tests__test

		var parent = $(this).parent().parent();//form
		var current_item = parent.find('.course-tests__test-question').not('.hide-question').last();
		var doctors_test = parent.find('.course-tests__test-question').hasClass('doctors_test');

		var check = 0;

		$('[type="radio"]').each(function(key, index) {
			if($(this).prop('checked')) {
				check = 1;
			}
		});

		if (!check) {
			e.preventDefault();
		    return;
		}

		//Показываем либо скрываем группу вопросов, текущую скрываем, следующую показываем
		if (current_item.next().data('audio') != "") {
            window.audio.pause();
			window.audio = new Audio(current_item.next().data('audio'));
			window.audio.play();
		}

		if (doctors_test) {

			$('#res-fr').submit();
			e.preventDefault();

			return;
		}

        if (current_item.next().data('group') == current_item.data('group')) {

            $('*[data-group="' + current_item.data('group') + '"]').addClass('hide-question');

            let found = true;
            let item = current_item.next();
            var i = 0;

            while (found) { // выводит 0, затем 1, затем 2
                i++;
                if (item.data('group') == current_item.data('group')) {
                    item.removeClass('hide-question');
                    item = item.next();
                } else {
                    found = false;
                }
            }

        } else {
            var group_id_current = current_item.data('group');
            var group_id_next = current_item.next().data('group');
            $('*[data-group="' + group_id_current + '"]').addClass('hide-question');
            $('*[data-group="' + group_id_next + '"]').removeClass('hide-question');
        }

        //Обновляем счетчики вопросов
        var newval = parseInt(input.val()) + $('*[data-group="' + group_id_current + '"]').length;
        input.val(newval);
        current.text(newval);

        //Если конец, то показываем копку финиш
        if (!$('*[data-group="' + group_id_next + '"]').last().next().hasClass('group')) {
            $(this).hide();
            $(this).next().show();
        }

            //Подгружаем задание
        $('.content-zadanie').html(current_item.next().data('html'));

        setTimeout(function() {
            $('html, body').stop().animate({
                scrollTop: 0
            }, 500);
        }, 50);
        
        e.preventDefault();
    });

    $('.content-zadanie').html($('.course-tests__test-question').first().data('html'));


    if($('.course-tests__test-question').first().data('audio') != "" && $('.course-tests__test-question').first().data('audio') !== undefined) {
        $.confirm({
            title: 'You need enable audio speakers!',
            buttons: {
                confirm: function () {
                    window.audio = new Audio($('.course-tests__test-question').first().data('audio'));
                    window.audio.play();
                }
            }
        });
    }


    setTimeout(function() {
        if(!$('.course-tests__test-question').last().hasClass('hide-question') && !$('.course-tests__test').hasClass('examen-doctor')) {
            $('.next-question').hide();
            $('.next-question').next().show();
        }
    },500);
    
    
    if($('.course-tests__test-question').first().hasClass('group')) {

        let found = true;
        let item = $('.course-tests__test-question').first().next();
        var first_item_group_id = $('.course-tests__test-question').first().data('group');

        var i = 0;

        while (found) { // выводит 0, затем 1, затем 2
          i++; 

          if(item.data('group') == first_item_group_id) {
            item.removeClass('hide-question');
            item = item.next();
          } else {
            found = false;
          }
        }            

    }


    $('.login-form').submit(function (e) {

        var msg   = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: msg,
            success: function(data) {
				let url = location.href.split('/');
				url = url[4].split('?');
				if (url[0] != 'register') window.location.href = '/'+$('.header__lang-select').text().toLowerCase()+'/personal';
				else window.location.href = location.href;
            },
            error:  function(xhr, str){
                $('.wrong_data').show();
                $('.login-form').find('.modal-form__input').addClass('invalid');
                //alert('Р’РѕР·РЅРёРєР»Р° РѕС€РёР±РєР°: ' + xhr.responseCode);
            }
        });

        e.preventDefault();
    });

    $('.lesson-card__tabs a').click(function (e) {
        e.preventDefault();
    });

    $('select.orig-select').change(function () {
        var end_date = $(this).find('option:selected').data('date_end');

        $('select.next1 option[data-date]').each(function() {
            if($(this).data('date') < end_date) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });

        $('select.next1 option').each(function () {
            if ($(this).css('display') != 'none') {
                $(this).prop("selected", true);
                return false;
            }
        });

        window.price.orig = parseInt($(this).find('option:selected').data('price'));
        updatePrice();
    });

	$('select.next1').change(function () {
		var end_date = $(this).find('option:selected').data('date_end');

		$('select.next2 option[data-date]').each(function() {
			if($(this).data('date') < end_date) {
				$(this).hide();
			} else {
				$(this).show();
			}
		});

		$('select.next2 option').each(function () {
			if ($(this).css('display') != 'none') {
				$(this).prop("selected", true);
				return false;
			}
		});

		window.price.orig = parseInt($(this).find('option:selected').data('price'));
		updatePrice();
	});

    $('select.orig-select').trigger('change');

    $('.show_select').change(function() {
        var checked = $(this).prop('checked');

        if(checked) {
            $(this).next().next().attr('name', 'whenStart[]');
            $(this).next().next().show();

            $('.next1').bind('change', function() {
                window.price.next1 = parseInt($(this).find('option:selected').data('price'));
                updatePrice();
            });
            $('.next1').trigger('change');
            $('.check2_class').show();
        } else {
            $(this).next().next().attr('name', '');
            $(this).next().next().hide();
            $('.show_select2').prop('checked', false);
            $('.check2_class select').hide().attr('name', '');
            window.price.next1 = 0;
            window.price.next2 = 0;
            $('.next1').unbind();
            $('.next2').unbind();
            $('.check2_class').hide();
            updatePrice();
        }


    });

    $('.show_select2').change(function() {
        var checked = $(this).prop('checked');

        if(checked) {

            $(this).next().next().attr('name', 'whenStart[]');
            $(this).next().next().show();

            $('.next2').bind('change', function() {
                window.price.next2 = parseInt($(this).find('option:selected').data('price'));
                updatePrice();
            });
            $('.next2').trigger('change');
        } else {
            $(this).next().next().attr('name', '');
            window.price.next2 = 0;
            $('.next2').unbind();
            updatePrice();
        }


    });

    $('#check23').change(function () {
        var checked = $(this).prop('checked');

        if(checked) {
            $('.ifrom').show();
        } else {
            $('.ifrom').hide();
        }
    });


    $('#register-form').submit(function(e) {

        var msg   = $(this).serialize();
		var lessoncard = 1;

		if($(this).attr('action').indexOf('Exam') > 1) lessoncard = 2;

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: msg,
            success: function(data) {
                setTimeout(function () {
                    alert('Danke. Wir haben Ihnen eine Bestätigung per E-Mail versendet. Prüfen Sie Spam-Ordner.\nThanks.  We have sent you a confirmation by e-mail. Please also check spam folder.');
                    window.location.href = '/'+$('.header__lang-select').text().toLowerCase()+'/personal?lessoncard='+lessoncard;
                }, 1000);
            },
            error:  function(xhr, str){
                var errors = $.parseJSON(xhr.responseText);
                var errorsArray = Object.values(errors);


                errorsArray.forEach(function(element) {
                    alert(element);
                    $('.btn-register').prop('disabled','disabled');
                });


            }
        });
        e.preventDefault();
    });

    $('#register-client-form').submit(function(e) {

        var msg   = $(this).serialize();
        var lessoncard = 1;

        if($(this).attr('action').indexOf('Exam') > 1) lessoncard = 2;

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: msg,
            success: function(data) {
				setTimeout(function () {
					window.location.href = '/' + $('.header__lang-select').text().toLowerCase() + '/personal?lessoncard=' + lessoncard;
				}, 1000);
            },
            error:  function(xhr, str){
                var errors = $.parseJSON(xhr.responseText);
                var errorsArray = Object.values(errors);


                errorsArray.forEach(function(element) {
                    alert(element);
                    $('.btn-register').prop('disabled','disabled');
                });


            }
        });
        e.preventDefault();
    });

    $(".cancel").click(function (e) {
        $('.box-modal_close').click();
       e.preventDefault();
    });

    $('.main-contacts__form form').submit(function () {
       alert('Ok');
       return false;
    });

    $('.header__lang-select').click(function() { $('.header__lang-dropdown').slideToggle(); });
    $('.course-schedule__details-block__icon').click(function() { $(this).find('.main-courses__course-photo__shorttext').slideToggle(); });

	$('.lesson-list input').on('paste', false);
	$('.lesson-list textarea').on('paste', false);

	$("#register-form [name='phone'], #register-client-form [name='phone']").intlTelInput({
		// allowDropdown: false,
		// autoHideDialCode: false,
		// autoPlaceholder: "off",
		// dropdownContainer: "body",
		// excludeCountries: ["us"],
		// formatOnDisplay: false,
		// geoIpLookup: function(callback) {
		//   $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
		//     var countryCode = (resp && resp.country) ? resp.country : "";
		//     callback(countryCode);
		//   });
		// },
		// hiddenInput: "full_number",
		  initialCountry: "auto",
		// nationalMode: false,
		// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
		// placeholderNumberType: "MOBILE",
		// preferredCountries: ['cn', 'jp'],
		// separateDialCode: true,
		utilsScript: "build/js/utils.js"
	});

	$('#check1').change(function () {
	    console.log('check1');
		if($(this).prop('checked') == true) {
            $('.strike').text(800);
			$('.question').attr('data-tooltip', $('.next1').data('pricetext'));
		}
		else  {
            $('.strike').text(400);
		    $('.question').attr('data-tooltip', $('.next0').data('pricetext'));
        }
	});

	$('#check2').change(function () {
		if($(this).prop('checked') == true) {
            $('.strike').text(1200);
            $('.question').attr('data-tooltip', $('.next2').data('pricetext'));
        }
		else {
            $('.strike').text(800);
		    $('.question').attr('data-tooltip', $('.next1').data('pricetext'));
        }
	});
});


function fun(e){
	console.log(525);
	e.preventDefault();
}

function updatePrice() {
    var price = window.price.orig+window.price.next1+window.price.next2;
    $('.price b').text(price);
}

/* Function to animate height: auto */
function autoHeightAnimate(element, time){
    var curHeight = element.height(), // Get Default Height
        autoHeight = element.css('height', 'auto').height(); // Get Auto Height
    element.height(curHeight); // Reset to Default Height
    element.stop().animate({ height: autoHeight }, time); // Animate to Auto Height
}

//start tooltipElem
let tooltipElem;

document.onmouseover = function(event) {
	let target = event.target;

	// если у нас есть подсказка...
	let tooltipHtml = target.dataset.tooltip;
	if (!tooltipHtml) return;

	// ...создадим элемент для подсказки

	tooltipElem = document.createElement('div');
	tooltipElem.className = 'tooltip';
	tooltipElem.innerHTML = tooltipHtml;
	document.body.append(tooltipElem);

	// спозиционируем его сверху от аннотируемого элемента (top-center)
	let coords = target.getBoundingClientRect();

	let left = coords.left + (target.offsetWidth - tooltipElem.offsetWidth) / 2;
	if (left < 0) left = 0; // не заезжать за левый край окна

	let top = coords.top - tooltipElem.offsetHeight - 5;
	if (top < 0) { // если подсказка не помещается сверху, то отображать её снизу
		top = coords.top + target.offsetHeight + 5;
	}

	tooltipElem.style.left = left + 'px';
	tooltipElem.style.top = top + 'px';
};

document.onmouseout = function(e) {

	if (tooltipElem) {
		tooltipElem.remove();
		tooltipElem = null;
	}

};
//end tooltipElem