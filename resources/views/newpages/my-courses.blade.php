@extends('layouts.newapp', ['title' =>  __('personal.title') , 'description' => ""])

@section('content')
	@if(app()->getLocale() == 'ru')
		<style>
		</style>
	@endif

<div class="inner-banner">
	<div class="container">
		<h1 class="inner-banner__headline">{{__('personal.title')}}</h1>

		<ul class="inner-banner__breadcrumbs">
			<li class="inner-banner__breadcrumbs__item"><a href="{{trim_locale(app()->getLocale())}}/">{{__('main_page.title')}}</a></li>
			<li class="inner-banner__breadcrumbs__item">{{ __('top_navigation.personal') }}</li>
		</ul>
	</div>
</div>



<div class="lesson-list">
	<div class="container">

		<ul class="lesson-card__tabs">
			<?
				$active1 = $active2 = false;
				if(count($contracts) > 0) {$active1 = true;}
				if(count($exams) > 0) {$active2 = true;}
				if($active1 && $active2) $active2 = false;
				if(!empty($_GET['lessoncard']) && $_GET['lessoncard'] == 2) {
					$active1 = false;
					$active2 = true;
				}

			?>
			@if(count($contracts) > 0)
				<li>
					<a href="#lessoncard1" @if((!empty($_GET['lessoncard']) && $_GET['lessoncard'] == 1) || $active1)class="active"@endif>
						{{ __('personal.tab1') }}
					</a>
				</li>
			@endif
			@if(count($exams) > 0)
				<li>
					<a href="#lessoncard2" @if((!empty($_GET['lessoncard']) && $_GET['lessoncard'] == 2) || $active2)class="active"@endif>
						{{ __('personal.tab2') }}
					</a>
				</li>
			@endif
			@if(count($brons) > 0)<li><a href="#lessoncard3" class="">{{ __('personal.tab3') }}</a></li>@endif
		</ul>

		@if(count($contracts) > 0)
		<div class="lesson-card__content"  id="lessoncard1"  style="padding: 10px; @if((!empty($_GET['lessoncard']) && $_GET['lessoncard'] == 2) || $active2) display:none; @endif">
			<div class="my-course">
				@foreach($contracts as $contract)
					<div class="my-course__item">
						<div class="stripe">
							<div class="number">
								{{ __('personal.payment_number') }}: <span>{{$contract->number}}</span>
							</div>

							<table class="table-name">
								<thead>
								<tr>
									<td >{{ __('personal.name') }}</td>
									<td >{{ __('personal.start_date') }}</td>
									<td >{{ __('personal.end_date') }}</td>
								</tr>
								</thead>
                                <?php $price = 0; ?>
								@foreach($contract->items() as $item)
									<tr>
										<td>{{$item->course()->name}}</td>
										<td>@dateFormat($item->course()->start_date)</td>
										<td>@dateFormat($item->course()->end_date)</td>
									</tr>
                                    <?php $price = $price + $item->price; ?>
								@endforeach
							</table>

							<div class="price">
								<p class="price">{{__('messages.price')}}: <b>{{$price}} €</b></p>
							</div>

							@if($contract->status == 'not_paid')
								<p class="expire">Reservation expires: @dateFormat($item->expired_at)</p>
								<div class="not_paid">
									{{__('personal.not_paid')}}
								</div>
								</p>
							@elseif($contract->status == 'paid')
								<div class="paid" role="alert">
									{{__('personal.paid')}}
								</div>
							@elseif($contract->status == 'prepaid')
								<div class="pre_paid" role="alert">
									{{__('personal.pre_paid')}}
								</div>
							@elseif($contract->status == 'cash_paid')
								<div class="paid" role="alert">
									{{__('personal.paid_cash')}}
								</div>
							@elseif($contract->status == 'break')
								<div class="break" role="alert">
									{{__('personal.break')}}
								</div>
							@elseif($contract->status == 'expired')
								<div class="break" role="alert">
									{{__('personal.expired')}}
								</div>
							@endif


							<table class="table-details">
								<tr>
									<td>Empfänger:</td>
									<td>DKH Sprachschule</td>
								</tr>
								<tr>
									<td>Bank:</td>
									<td>Marienstraße 11, 30171 Hannover</td>
								</tr>
								<tr>
									<td>Adresse:</td>
									<td>Marienstraße 11, 30171 Hannover</td>
								</tr>
								<tr>
									<td>IBAN:</td>
									<td>DE03672300004014155339</td>
								</tr>
								<tr>
									<td>BIC(SWIFT):</td>
									<td>MLPBDE61XXX</td>
								</tr>
								<tr>
									<td>Verwendungszweck:</td>
									<td>+49178 870 92 18</td>
								</tr>
							</table>
						</div>
						@if(count($contract->documents()) > 0)
							<div class="stripe">
								<div class="number">
									{{__('personal.documents')}}:
								</div>
								<ul class="document-list">
									@foreach($contract->documents() as $document)

										<li><a href="{{route('downloadPdf', ['name'=>$document->name])}}">{{__('personal.download')}} {{$document->name}}</a></li>

									@endforeach
								</ul>
							</div>
						@endif

					</div>
				@endforeach
			</div>
		</div>

		@endif
		
		@if(count($exams) > 0)
		<div class="lesson-card__content"  id="lessoncard2" style="padding: 10px; @if((!empty($_GET['lessoncard']) && $_GET['lessoncard'] == 1) || $active1) display:none; @endif">
			<div class="my_course">
				@foreach($exams as $examContainer)
					<div class="my-course__item">
						<div class="stripe">
							<div class="number" style="    margin-bottom: 4px;">
								{{ __('personal.name') }}: <span>{{$examContainer->exam()->name}}</span>
							</div>
							<div class="number">
								{{ __('personal.start_date') }}: <span>@dateFormat($examContainer->start_date)</span>
							</div>

							@if($examContainer->status == 'pending')
								<div class="not_paid" role="alert">
									{{__('personal.wait_result')}}
								</div>
								</p>
							@elseif($examContainer->status == 'closed')
								<div class="paid" role="alert">
									{{__('personal.complete_exem')}}
								</div>
								<h4>{{__('personal.results')}}:</h4>
								<br>
								<p>
									<b>LESERVERSTEHEN</b>: {{$examContainer->lv}}
								</p>
								<hr>
								<p>
									<b>HÖRVERSTEHEN</b>: {{$examContainer->hv}}
								</p>
								<hr>
								<p>
									<b>SCHRIFTLICHER AUSDRUCK</b>: {{$examContainer->sa}}
								</p>
								<hr>
								<p>
									<b>MÜNDLICHER AUSDRUCK</b>: {{$examContainer->ma}}
								</p>
								<hr>
								<p>
									<b>LINSGESAMT</b>: {{$examContainer->hv+$examContainer->lv+$examContainer->sa+$examContainer->ma}}
								</p>
							@endif

						</div>
						@if(count($examContainer->documents()) > 0)
							<div class="stripe">
								<div class="number">
									{{__('personal.documents')}}:
								</div>
								<ul class="document-list">
									@foreach($examContainer->documents() as $document)

										<li><a href="{{route('downloadPdf', ['name'=>$document->name])}}">{{__('personal.download')}} {{$document->name}}</a></li>

									@endforeach
								</ul>
							</div>
						@endif

					</div>
				@endforeach
			</div>
		</div>

		@endif
		

		@if(count($brons) > 0)
		<div class="lesson-card__content"  id="lessoncard3" style="padding: 10px;">
			<div class="my_course">
				@foreach($brons as $bron)
					<div class="my-course__item">
						<div class="stripe">
							<div class="number" style="    margin-bottom: 4px;">
								{{ __('personal.name') }}: 
								@if($bron->type == 'Male') 
									<span>{{__('personal.m_room')}} {{$bron->roomName()}}</span>
								@else
									<span>{{__('personal.f_room')}} {{$bron->roomName()}}</span>
								@endif
								
							</div>
							<div class="number"  style="    margin-bottom: 4px;">
								{{ __('personal.start_date') }}: <span>@dateFormat($bron->date_start)</span>
							</div>

							<div class="number">
								{{ __('personal.end_date') }}: <span>@dateFormat($bron->date_end)</span>
							</div>

				
							<div class="not_paid" role="alert">
								{{__('personal.wait_result')}}
							</div>
					
							

						</div>
						@if(count($bron->documents()) > 0)
							<div class="stripe">
								<div class="number">
									{{__('personal.documents')}}:
								</div>
								<ul class="document-list">
									@foreach($bron->documents() as $document)

										<li><a href="{{route('downloadPdf', ['name'=>$document->name])}}">{{__('personal.download')}} {{$document->name}}</a></li>

									@endforeach
								</ul>
							</div>
						@endif

					</div>
				@endforeach
			</div>
		</div>
		@endif


	</div>
</div>
@endsection