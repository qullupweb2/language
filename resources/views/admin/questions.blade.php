<div class="row courses_row">
    <div class="question_wrap">
        <div class="col-md-5">
            <input class="form-control selectPrice" style="width: 100%;" name="list[question][]" type="text" placeholder="Question" value="" >
        </div>
        <div class="col-md-1">
            <input class="form-control selectPrice" style="width: 100%;" name="list[a][]" type="text" placeholder="a"  value="" >
        </div>

        <div class="col-md-1">
            <input class="form-control selectPrice" style="width: 100%;" name="list[b][]" type="text" placeholder="b" value="" >
        </div>

        <div class="col-md-1">
            <input class="form-control selectPrice" style="width: 100%;" name="list[c][]" type="text" placeholder="c" value="" >
        </div>

        <div class="col-md-1">
            <input class="form-control selectPrice" style="width: 100%;" name="list[d][]" type="text" placeholder="d" value="" >
        </div>

        <div class="col-md-1">
            <input type='hidden' name='list[continiues][]' value="">
            <input class="form-control selectPrice" style="width: 100%;" name="list[answer][]" type="text" placeholder="answer" value="" >
        </div>


        <div class="col-md-2">
            <button type="button" class="btn btn-primary clone_select_question">Add question</button>
        </div>
    </div>

    @foreach($questions as $question)

        <div class="question_wrap" style="margin-top: 10px; float:left;">
            <div class="col-md-4">
                <input class="form-control selectPrice" style="width: 100%;" name="list[question][]" type="text" placeholder="Question" value="{{$question['question']}}" >
            </div>
            <div class="col-md-1">
                <input class="form-control selectPrice" style="width: 100%;" name="list[a][]" type="text" placeholder="a"  value="{{$question['a']}}" >
            </div>

            <div class="col-md-1">
                <input class="form-control selectPrice" style="width: 100%;" name="list[b][]" type="text" placeholder="b" value="{{$question['b']}}" >
            </div>

            <div class="col-md-1">
                <input class="form-control selectPrice" style="width: 100%;" name="list[c][]" type="text" placeholder="c" value="{{$question['c']}}" >
            </div>

            <div class="col-md-1">
                <input class="form-control selectPrice" style="width: 100%;" name="list[d][]" type="text" placeholder="d" value="{{$question['d']}}" >
            </div>

            <div class="col-md-1">
                <input class="form-control selectPrice" style="width: 100%;" name="list[answer][]" type="text" placeholder="answer" value="{{$question['answer']}}" >
            </div>

            <div class="col-md-1">
                <select name="list[continiues][]">
                    @foreach($groups as $group)
                    
                    <option @if(isset($question['continiues']) && $group->id == $question['continiues']) selected @endif value="{{$group->id}}">{{$group->name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-primary remove_select">Remove question</button>
            </div>
        </div>

    @endforeach
</div>