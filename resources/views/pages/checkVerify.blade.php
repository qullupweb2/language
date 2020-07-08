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
                        <p>Course start date: @dateFormat(\Session::get('date_start'))</p>
                        <p>Student name and last name: {{\Session::get('name')}} {{\Session::get('lastname')}}</p>
                    @endif


                    @if ($errors->has('message') ?? false)
                        <div class="alert alert-danger" role="alert">
                            <i class="mdi mdi-alert-circle"></i>
                            {{$errors->first('message')}}
                        </div>
                    @endif

                    <form method="post" autocomplete="off">

                        @csrf
                        <div class="form-group">
                            <label >Individual/Passport number</label>
                            <input name="number" type="text" class="form-control" placeholder="For example: 1543219876">
                        </div>

                        <button type="submit" class="btn btn-primary">Check number</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection