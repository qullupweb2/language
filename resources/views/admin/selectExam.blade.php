<div class="row examens_row">

    <div class="col-md-4">
    <select class="form-control " style="width: 100%;" name="exam_start">
        <option value="">Select examen</option>
        @foreach($examens as $examen)
                <option value="{{$examen->id}}" >{{$examen->name}} @dateFormat($examen->start_date) - @dateFormat($examen->end_date)</option>
            @endforeach
    </select>
    </div>

</div>