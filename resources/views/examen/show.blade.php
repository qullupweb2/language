@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{__('messages.exam')}} {{$exam->name}}</div>

                    <div class="card-body">
                        <p class="register"><button  data-toggle="modal" data-target="#registerModal" class="btn-primary btn">{{__('messages.register')}}</button></p>
                        <p class="description">
                            {!! $exam->description !!}
                        </p>
                        <p class="register"><button  data-toggle="modal" data-target="#registerModal" class="btn-primary btn">{{__('messages.register')}}</button></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="registerModal" tabindex="0" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.formtitle')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @guest
                    <form action="{{route('registerFormExam')}}" id="register-form" method="post">
                        @else
                            <form action="{{route('registerFormExamClient')}}" id="register-client-form" method="post">
                                @endguest


                                <div class="modal-body">

                                    @csrf
                                    <div class="form-group">
                                        <label for="whenStart">{{__('messages.whenStartExam')}}</label>
                                        <select class="form-control"  aria-describedby="whenStartHelp" name="whenStart">
                                            @foreach($similars as $similar)
															
                                                    <option value="{{$similar->id}}">
                                                    	@if($similar->start_date == '2022-06-06 00:00:00')
															Bald
                                                    	@else
                                                    		@dateFormat($similar->start_date)
                                                    	@endif
                                                    </option>

                                            @endforeach

                                        </select>
                                    </div>
                                    @guest
                                        <div class="form-group">
                                            <label for="firstName">{{title_case(__('messages.firstname'))}}</label>
                                            <input type="text" required class="form-control" name="name" placeholder="{{__('messages.enter')}} {{__('messages.firstname')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="lastName">{{title_case(__('messages.lastname'))}}</label>
                                            <input type="text" required class="form-control" name="last_name" placeholder="{{__('messages.enter')}} {{__('messages.lastname')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="Phone">{{title_case(__('messages.phone'))}}</label>
                                            <input type="tel" required class="form-control" name="phone" placeholder="{{__('messages.enter')}} {{__('messages.phone')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="birthDay">{{title_case(__('messages.birthday'))}}</label>
                                            <input type="text" required class="form-control datepicker" name="birthDay"  placeholder="{{__('messages.enter')}} {{__('messages.birthday')}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="passnum">{{title_case(__('messages.passport_number'))}}</label>
                                            <input type="text" required class="form-control" name="passport_number"  placeholder="{{__('messages.enter')}} {{__('messages.passport_number')}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">{{title_case(__('messages.email'))}}</label>
                                            <input type="email" required class="form-control" name="email" aria-describedby="emailHelp" placeholder="{{__('messages.enter')}} {{__('messages.email')}}">
                                            <small id="emailHelp" class="form-text text-muted">{{__('messages.emailhelp')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="adress">{{title_case(__('messages.adress'))}}</label>
                                            <p><input class="form-control" name="country" placeholder="Country" required></p>
                                            <p><input class="form-control" name="street" placeholder="Street name and number" required></p>
                                            <p><input class="form-control" name="city" placeholder="City" required></p>
                                            <p><input class="form-control" name="zip" placeholder="ZIP code" required></p>


                                        </div>
                                    @else
                                        @if(auth()->user()->passport_number == '')
                                        <div class="form-group">
                                            <label for="passnum">{{title_case(__('messages.passport_number'))}}</label>
                                            <input type="text" required class="form-control" name="passport_number" required=""  placeholder="{{__('messages.enter')}} {{__('messages.passport_number')}}">
                                        </div>
                                        @endif
                                    @endguest

                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="acceptCheck" required>
                                        <label class="form-check-label" for="acceptCheck">Ich akzeptiere <a href="https://www.deutsch-kurs-hannover.com/agb" target="_blank">AGB</a> der DKH Sprachschule / {{__('messages.accept')}} <a href="https://www.deutsch-kurs-hannover.com/agb" target="_blank">{{__('messages.schoolrules')}}</a></label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="acceptCheck2" required>
                                        <label class="form-check-label" for="acceptCheck2">Ich akzeptiere die <a href="https://www.deutsch-kurs-hannover.com/datenschutz" target="_blank">Datenschutzerklärung</a> der DKH Sprachschule / {{__('messages.accept')}} <a href="https://www.deutsch-kurs-hannover.com/datenschutz" target="_blank">{{__('messages.politic')}}</a></label>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary btn-register">{{__('messages.register')}}</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                                </div>
                            </form>
            </div>
        </div>
    </div>

    <div class="modal" id="rulesModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{title_case(__('messages.schoolrules'))}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{$rules}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{title_case(__('messages.politic'))}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{$konf}}
                </div>
            </div>
        </div>
    </div>


@endsection
