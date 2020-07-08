@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card" style="padding: 20px">

                    @if (\Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="mdi mdi-alert-circle"></i>
                            {!! \Session::get('success') !!}
                        </div>
                    @endif

                    <h2>{{__('messages.breakTitle')}}</h2>


                    <form method="post" autocomplete="off" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label >{{title_case(__('messages.firstname'))}}</label>
                            <input name="first_name" required type="text" class="form-control" placeholder="{{__('messages.enter')}} {{__('messages.firstname')}}">
                        </div>

                        <div class="form-group">
                            <label >{{title_case(__('messages.lastname'))}}</label>
                            <input name="last_name" required type="text" class="form-control" placeholder="{{__('messages.enter')}} {{__('messages.lastname')}}">
                        </div>

                        <div class="form-group">
                            <label >{{title_case(__('messages.email'))}}</label>
                            <input name="email" required type="text" class="form-control" placeholder="{{__('messages.enter')}} {{__('messages.email')}}">
                        </div>

                        <div class="form-group">
                            <label >{{title_case(__('messages.bank_account'))}}</label>
                            <input name="bank_account" required type="text" class="form-control" placeholder="{{__('messages.enter')}} {{__('messages.bank_account')}}">
                        </div>

                        <div class="form-group">
                            <label >BIC</label>
                            <input name="bic" required type="text" class="form-control" placeholder="{{__('messages.enter')}} BIC">
                        </div>

                        <div class="form-group">
                            <label >{{title_case(__('messages.coursename'))}}</label>
                            <input name="course_name" required type="text" class="form-control" placeholder="A1.1">
                        </div>


                        <div class="form-group">
                            <label for="birthDay">{{title_case(__('messages.startfrom'))}}</label>
                            <input type="text" required class="form-control datepicker" name="startDate"  placeholder="01.01.2019">
                        </div>

                        <div class="form-group">
                            <label for="birthDay">{{title_case(__('messages.breakReason'))}}</label>
                            <textarea name="reason" required class="form-control" id="" cols="30" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="birthDay">{{title_case(__('messages.document'))}}</label>
                            <input type="file" name="document">
                        </div>

                        <button type="submit" class="btn btn-primary">{{__('messages.send')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection