
<div class="card-header">{{__('messages.mycourses')}}</div>

<div class="card-body">
    <div class="row">

        @if(count($contracts) < 1)

            <p class="text-center w-100">{{__('messages.nocourses')}}</p>

        @endif
        @foreach($contracts as $contract)

            <div class="col-sm-6">
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">

                            <p class="unic_number">{{__('messages.paymentNum')}}: <b>{{$contract->number}}</b></p>


                        </h5>
                        <p class="card-text">
                        <table class="table  table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">{{__('messages.nameCourse')}}</th>
                                <th scope="col">{{__('messages.startDate')}}</th>
                                <th scope="col">{{__('messages.endDate')}}</th>
                            </tr>
                            </thead>
                            <tbody>



                            <?php $price = 0; ?>
                            @foreach($contract->items() as $item)
                                <tr>
                                    <th scope="row">{{$item->course()->name}}</th>
                                    <td>{{$item->course()->start_date}}</td>
                                    <td>@dateFormat($item->course()->end_date)</td>
                                </tr>
                                <?php $price = $price + $item->price; ?>
                            @endforeach
                                </tbody>
                            </table>
                            <p class="price">{{__('messages.price')}}: <b>{{$price}} €</b></p>

                            @if($contract->status == 'not_paid')
                            <p class="expire">Reservation expires: @dateFormat($item->expired_at)</p>
                                <div class="alert alert-warning" role="alert">
                                    {{__('messages.not_paid')}}
                                </div>
                            </p>
                            @elseif($contract->status == 'paid')
                                <div class="paid" role="alert">
                                    {{__('messages.paid')}}
                                </div>
                            @elseif($contract->status == 'prepaid')
                            <div class="pre_paid" role="alert">
                                {{__('messages.prepaid')}}
                            </div>
                            @elseif($contract->status == 'cash_paid')
                            <div class="paid" role="alert">
                                {{__('messages.cash_paid')}}
                            </div>
                            @elseif($contract->status == 'break')
                            <div class="break" role="alert">
                                {{__('messages.break')}}
                            </div>
                            @elseif($contract->status == 'expired')
                            <div class="alert alert-danger" role="alert">
                                {{__('messages.expired')}}
                            </div>
                            @endif
                        </p>

                        @if(count($contract->documents()) > 0)
                        <hr>
                        <h6>{{__('messages.documents')}}:</h6>
                        <ul>
                            @foreach($contract->documents() as $document)

                                <li><a href="{{route('downloadPdf', ['name'=>$document->name])}}">{{__('messages.download')}} {{$document->name}}</a></li>

                            @endforeach

                        </ul>
                        @endif
                    </div>
                </div>
            </div>

        @endforeach



    </div>
</div>
@if($next_course !== false && isset($next_course->name))

    <div class="modal" id="offerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('messages.nextLvlQuestion')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>{{__('offer')}}: <b>{{$next_course->name}}</b>. {{__('messages.question')}}</p>
                    <div class="modal-footer">
                        <a href="{{route('course', [$next_course->id, 'type'=>'acceptNext'])}}" class="btn btn-primary btn-accept">{{__('messages.register')}}</a>
                        <button type="button" class="btn btn-secondary btn-refuse" data-dismiss="modal">{{__('messages.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
