@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">{{__('messages.course')}} {{$course->category()->name}}</div>

                    <div class="card-body">
                        <p class="register"><button  data-toggle="modal" data-target="#registerModal" class="btn-primary btn">{{__('messages.register')}}</button></p>

                        
                        <p class="description">
                            <center>
                            <table class="table table-striped">
                            	<tr>
                            		<th>{{__('messages.start_date')}}</th>
                            		<th>{{__('messages.course_time')}}</th>
                                    <th>{{__('messages.duration')}}</th>
                                    <th>{{__('messages.price')}}</th>
                            	</tr>
                            <?php $i = 0; ?>
                            @foreach($similars as $similar)
                            <?php $i++; ?>
                            <?php if($i > 10) continue; ?>
                                    @if($similar->price !== null && $similar->available)

									<tr>
										<td>@dateFormat($similar->start_date)</td>
										<td>{{$similar->how_often}}</td>
										<td>{{$similar->duration}} {{__('messages.weeks')}}</td>
										<td>{{$similar->price}} Euro</td>
									</tr>

                                    @endif
                                @endforeach
                            </table>    
                            </center>
                            {!! $category['description_'.app()->getLocale()] ?? $category['description_en'] !!}
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
                    <form action="{{route('registerForm')}}" id="register-form" method="post">
                @else
                    <form action="{{route('registerFormClient')}}" id="register-client-form" method="post">
                @endguest


                <div class="modal-body">

                        @csrf
                        <div class="form-group">
                            <label for="whenStart">{{__('messages.whenStart')}} ({{$course->name}})</label>
                            <select class="form-control orig-select"  aria-describedby="whenStartHelp" name="whenStart[]" data-pricetext="{{$similars[0]->category()->price_description}}">
                                @foreach($similars as $similar)
                                    @if($similar->price !== null && $similar->available)
                                    <option data-price="{{$similar->price}}" value="{{$similar->id}}" data-date="@toUnix($similar->start_date)">@dateFormat($similar->start_date) | {{$similar->how_often}}</option>
                                    @endif
                                @endforeach

                            </select>
                            <style type="text/css">
                                b {
                                    font-weight: bold !important;
                                }
                                .hidden {
                                    display: none;
                                }
                            </style>

                            <!-- DOP DAYS -->
                       

                            @if($next1Courses !== null)<br>
                            <label>{{__('messages.nextCourseText')}}(<b>{{$next1Courses[0]->name}}</b>) <input type="checkbox" class="show_select"></label>
                            <select class="form-control hidden next1"  aria-describedby="whenStartHelp" name="" data-pricetext="{{$next1Courses[0]->category()->price_description}}">
                            @foreach($next1Courses as $next1)
                                @if($next1->price !== null && $next1->available)
                                <option data-price="{{$next1->price}}" data-date="@toUnix($next1->start_date)" value="{{$next1->id}}">@dateFormat($next1->start_date) | {{$next1->how_often}}</option>
                                @endif
                            @endforeach
                            </select>
                            @endif

                            @if($next2Courses !== null)<br>
                            <label class="hidden">{{__('messages.nextCourseText')}}(<b>{{$next2Courses[0]->name}}</b>) <input type="checkbox" class="show_select2">
                            </label>                    
                            <select class="form-control hidden next2"  aria-describedby="whenStartHelp" name="" data-pricetext="{{$next2Courses[0]->category()->price_description}}">
                            @foreach($next2Courses as $next2)
                                @if($next2->price !== null && $next2->available)
                                <option data-price="{{$next2->price}}" value="{{$next2->id}}" data-date="@toUnix($next2->start_date)">@dateFormat($next2->start_date) | {{$next2->how_often}}</option>
                                @endif
                            @endforeach
                            </select>
                            @endif
                            
                       
                            <!-- END -->
                            <small id="whenStartHelp" class="form-text text-muted">{{__('messages.priceforyou')}}: <b>{{ $similars[0]->price }}</b> €
                                <button type="button" class="btn btn-information" data-container="body" data-html="true"  data-toggle="popover" data-placement="bottom" data-content="{{$similars[0]->category()['price_description_'.app()->getLocale()] ?? $similars[0]->category()['price_description_en']}}">
                                    ?
                                </button></small>
                        </div>
                        @guest
                        <div class="form-group">
                            <label for="firstName">{{title_case(__('messages.firstname'))}}</label>
                            <input type="text" required class="form-control" name="name" placeholder="{{__('messages.firstname')}}">
                        </div>
                        <div class="form-group">
                            <label for="lastName">{{title_case(__('messages.lastname'))}}</label>
                            <input type="text" required class="form-control" name="last_name" placeholder="{{__('messages.lastname')}}">
                        </div>
                        <div class="form-group">
                            <label for="Phone">{{title_case(__('messages.phone'))}}</label>
                            <input type="tel" required class="form-control" name="phone" placeholder="{{__('messages.phone')}}">
                        </div>
                        <div class="form-group">
                            <label for="birthDay">{{title_case(__('messages.birthday'))}}</label>
                            <input type="text" required class="form-control datepicker" name="birthDay"  placeholder="{{__('messages.birthday')}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">{{title_case(__('messages.email'))}}</label>
                            <input type="email" required class="form-control" name="email" aria-describedby="emailHelp" placeholder="{{__('messages.email')}}">
                            <small id="emailHelp" class="form-text text-muted">{{__('messages.emailhelp')}}</small>
                        </div>
                        <div class="form-group">
                            <label for="adress">{{title_case(__('messages.adress'))}}</label>
                            <p><input class="form-control" name="country" placeholder="{{__('messages.land')}}" required></p>
                            <p><input class="form-control" name="street" placeholder="{{__('messages.street')}}" required></p>
                            <p><input class="form-control" name="city" placeholder="{{__('messages.city')}}" required></p>
                            <p><input class="form-control" name="zip" placeholder="{{__('messages.zip')}}" required></p>


                        </div>
                        <div class="form-check">
                            <input type="checkbox" id="ifrom" class="form-check-input show-field">
                            <label for="ifrom" class="form-check-label">{!!__('messages.ifrom')!!}</label>
                        </div>

                        <div class="form-group ifrom" style="display: none;">
                            <label>{{title_case(__('messages.passport_data'))}}</label>
                            <input type="text"  class="form-control" name="passport_data" placeholder="passport data">
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="consul" id="acceptCheck0" >
                            <label class="form-check-label" for="acceptCheck0">{!!__('messages.ineedconfirmed')!!}</label>
                        </div>
                        @endguest

                        <div class="form-check">
                            <input type="hidden" name="combine" value="{{$combine}}">
                            <input type="checkbox" class="form-check-input" id="acceptCheck" required>
                            <label class="form-check-label" for="acceptCheck"> {{__('messages.accept')}} <a href="https://www.deutsch-kurs-hannover.com/agb" target="_blank">{{__('messages.schoolrules')}}</a></label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="acceptCheck2" required>
                            <label class="form-check-label" for="acceptCheck2">{!! __('messages.getrulest') !!}</a></label>
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
