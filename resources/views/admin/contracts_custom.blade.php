<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Custom contract</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="form-horizontal">

        <div class="box-body">


            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                                <table class="table  table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($contracts_custom as $contract_custom)
                                        <tr>
                                            <th scope="row">{{$contract_custom->id}}</th>
                                            <td>{{$contract_custom->name}}</td>
                                            <td>{{ $contract_custom->status }}</td>
                                            <td>{{ $contract_custom->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- /.box-body -->
    </div>
</div>