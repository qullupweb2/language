<style>
    .action-price {
        display: none;
    }
</style>
<script>
    $(function () {
        $('select.action').change(function () {
           if($(this).val() == 'break' || $(this).val() == 'breakWithConfirm') {
               $('.action-price').show();
           } else {
               $('.action-price').hide();
           }
        });             

        $('select.action').change(function () {
           if($(this).val() == 'confirmVisa') {
               $('.action-visa').show();
           } else {
               $('.action-visa').hide();
           }
        });

        $('select.action').change(function () {
           if($(this).val() == 'confirmOfParticipation' || $(this).val() == 'confirmOfParticipationFuture') {
               $('.action-participation').show();
           } else {
               $('.action-participation').hide();
           }
        });



        $('select.action').change(function () {
           if($(this).val() == 'confirmCash' || $(this).val() == 'confirmManual') {
               $('.action-prepaid').show();
           } else {
               $('.action-prepaid').hide();
           }
        });

        $('.disable_paid_sum').change(function () {
           var disabled = $('input[name="payed_price"]').prop('disabled');  
           $('input[name="payed_price"]').prop('disabled', !disabled);
        });
    });
</script>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Contracts</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">

            @foreach($contracts as $contract)

                <div class="col-sm-6">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">

                                <p class="unic_number">Payment number: <b>{{$contract->number}}</b></p>


                            </h5>
                            <p class="card-text">
                            <table class="table  table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Start date</th>
                                    <th scope="col">End date</th>
                                </tr>
                                </thead>
                                <tbody>



                                <?php $price = 0; ?>
                                @foreach($contract->items() as $item)
                                    @if($item !== null && $item->course() !== null)
                                    <tr>
                                        <th scope="row">{{$item->course()->name}}</th>
                                        <td>{{date('d.m.Y H:i:s', strtotime($item->course()->start_date))}}</td>
                                        <td>@dateFormat($item->course()->end_date)</td>
                                    </tr>
                                    <?php $price = $price + $item->price; ?>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <p class="price">Price: <b>{{$contract->price}} €</b></p>
                            @if($contract->payed !== null)
                            <p class="price">Payed: <b>{{$contract->payed}} €</b></p>
                            @endif
                            @if($contract->returns !== null)
                            <p class="price">Breaked sum: <b>{{$contract->returns}} €</b></p>
                            @endif

                            @if($contract->status == 'not_paid')
                                <p class="expire">Reservation expires: @dateFormat($item->expired_at)</p>
                                <div class="alert alert-warning" role="alert">
                                    Not paid
                                </div>

                            @elseif($contract->status == 'paid')
                                <div class="alert alert-success" role="alert">
                                    Paid
                                </div>
                            @elseif($contract->status == 'prepaid')
                                <div class="alert alert-info" role="alert">
                                    Prepaid
                                </div>
                            @elseif($contract->status == 'cash_pre_paid')
                                <div class="alert alert-info" role="alert">
                                    Cash prepaid
                                </div>    
                            @elseif($contract->status == 'cash_paid')
                                <div class="alert alert-success" role="alert">
                                    Cash paid
                                </div>
                            @elseif($contract->status == 'break')
                                <div class="alert alert-danger" role="alert">
                                    Break
                                </div>
                            @elseif($contract->status == 'soft_break')
                                <div class="alert alert-danger" role="alert">
                                    Soft Break
                                </div>    
                            @elseif($contract->status == 'expired')
                                <div class="alert alert-danger" role="alert">
                                    Expired
                                </div>
                            @endif

                                @if(count($contract->documents()) > 0)
                                    <hr>
                                    <h6>Documents:</h6>
                                    <ul>
                                        @foreach($contract->documents() as $document)

                                            <li><a target="_blank" href="{{route('downloadPdf', ['name'=>$document->name]) }}">Download {{$document->name}}</a></li>

                                        @endforeach

                                    </ul>
                                @endif
                                <hr>
                                <h5>Actions:</h5>
                                <form method="post" action="/admin/contractActions">
                                <div class="col-md-5">
                                    {{csrf_field()}}
                                    <select class="form-control action" style="width: 100%;" name="action" data-value="" >
                                        <option>Select action</option>
                                        <option value="break">Break</option>
                                        <option value="breakWithConfirm">Break with confirm</option>
                                        <option value="softBreak">Soft break</option>
                                        <option value="sendOfficial">Send official</option>
                                        <option value="sendOfficialPaid">Send official paid</option>
                                        <option value="confirmCash">Confirm cash</option>
                                        <option value="confirmFull">Confirm full price</option>
                                        <option value="confirmManual">Confirm manual</option>
                                        <option value="confirmOfParticipation">Confirm course participation</option>
                                        <option value="confirmOfParticipationFuture">Confirm participation future</option>
                                        <option value="confirmVisa">Confirm visa</option>
                                    </select>
                                </div>
                                <div class="col-md-4 action-prepaid" style="display: none;">
                                    <input type="checkbox" name="" class="disable_paid_sum"> Not full paid<br>
                                    <input type="number" class="form-control" name="payed_price" placeholder="Paid sum"  disabled="" value="">
                                </div>
                                <div class="col-md-4 action-participation" style="display: none;">
                                    <input type="text" class="form-control" name="course_name" placeholder="Course name"   value="">
                                    <input type="text" class="form-control" name="start_date" placeholder="Start date"   value="">
                                    <input type="text" class="form-control" name="end_date" placeholder="End date"   value="">
                                </div>
                                <div class="col-md-4 action-visa" style="display: none;">
                                    <input type="text" class="form-control" name="course_name1" placeholder="Course name"   value="">
                                    <input type="text" class="form-control" name="date_1" placeholder="Date 1"   value="">
                                    <input type="text" class="form-control" name="date_2" placeholder="Date 2"   value="">
                                </div>

                                <div class="col-md-4 action-price">
                                    <input type="number" class="form-control" name="price" placeholder="Price to return" value="">
                                    <input type="text" class="form-control" name="reason" placeholder="Reason" value="">
                                    <input type="text" class="form-control" name="bank_reqs" placeholder="Bank requisites" value="">
                                </div>
                                <div class="col-md-2">
                                    <input type="hidden" name="contract_id" value="{{$contract->id}}">
                                    <button class="btn btn-primary">Apply</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
        <!-- /.box-body -->
    </div>
</div>