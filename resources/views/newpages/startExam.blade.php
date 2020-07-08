@extends('layouts.newapp', ['title' => 'Examen', 'description' => ""])

@section('content')

<div class="inner-banner">
    <div class="container">
        <h1 class="inner-banner__headline">
            Start Examen (Level {{$examen->name}})@if($oral == 'oral') Oral @endif
        </h1>
    </div>
</div>

<div class="lesson-list">
    <div class="container">
        <div class="main-details__text">
            <div class="text-instruction">	
		@if($oral == 'oral')
            @if(app()->getLocale() == 'de')
                {!! $examen->text_instruction_oral !!}
            @else
				<?= $examen['text_instruction_oral_'.trim_locale(app()->getLocale())];?>
            @endif
		@else
             @if(app()->getLocale() == 'de')
                 {!! $examen->text_instruction !!}
             @else
                <?= $examen['text_instruction_'.trim_locale(app()->getLocale())];?>
             @endif
		@endif
                
            </div>
            <form action="" method="post">
                @csrf
                <input name="email" required="" type="email" placeholder="Ihr E-mail*" class="modal-form__input">
                @if($oral)<input name="oral" value="1" type="hidden" >@endif
                <input type="submit" value="Einloggen" class="modal-form__button">
            </form>
        </div>
    </div>
</div>
@endsection
