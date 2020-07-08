<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">The rooms</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            @if(count($items) < 1)

                <p class="text-center w-100">Rooms not found</p>

            @endif
            @foreach($items as $itemContainer)

                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">

                                <p class="unic_number">Room: <b>{{__('personal.m_room')}} {{$itemContainer->roomName()}}</b></p>
                                <p>Status: @if($itemContainer->status == 'paid') Paid @else Not paid @endif</p>


                            </h5>
                            <p class="card-text">

                            <p class="start_date">{{__('messages.start')}}: <b>@dateFormat($itemContainer->date_start)</b></p>
                            <p class="start_date">End: <b>@dateFormat($itemContainer->date_end)</b></p>
                            
                                
                                <h5>Actions:</h5>
                                <form method="post" action="/admin/roomActionsAll">
                                <div class="col-md-5">
                                    {{csrf_field()}}
                                    <select class="form-control action" style="width: 100%;" name="action" data-value="" >
                                        <option>Select action</option>
                                        <option value="confirmPaid">Confirm pay</option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <input type="hidden" name="item_contrainer_id" value="{{$itemContainer->id}}">
                                    <button class="btn btn-primary">Apply</button>
                                </div>
                                </form>
    <br><br>


                                

                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- /.box-body -->
    </div>
</div>