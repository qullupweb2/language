@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card  courses">
                <div class="card-header">{{__('messages.courses')}}</div>

                <div class="card-body">
                    @include('course.categories')


                </div>
            </div>
            
            <div class="card">
                <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <th>Start Datum / Start date</th>
                                <th>Kurszeiten / Course time</th>
                                <th>Dauer / Duration</th>
                                <th>Preis / Price</th>
                            </tr>
                            @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>@dateFormat($item->start_date)</td>
                                <td>{{$item->how_often}}</td>
                                <td>{{$item->duration}} Weeks</td>
                                <td>{{$item->price}} Euro</td>
                            </tr> 
                            @endforeach
                        </tbody>
                     </table>
            </div>

            @include('examen.categories', ['examens'=>$examens])
        </div>
    </div>
</div>
@endsection
