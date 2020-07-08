<section class="content-header">
    <h1>
            Generate official
        </h1>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select exel file</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <div class="form-horizontal">
 
                        <div class="box-body">

                            <div class="fields-group">
                                <form method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-pencil fa-fw"></i></span>
                                            <input type="file" required="" name="document" class="form-control file" >
                                </div>


<br>
                                
<br>
                                <p><button type="sumbit" class="btn btn-primary">Generate</button></p>

                                </form>
                             
                            </div>

                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb end -->
</section>