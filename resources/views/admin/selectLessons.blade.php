<div class="row courses_row">
    <div class="col-md-4">
        <select class="form-control changeLevel" style="width: 100%;" name="level[]" data-value="" >
            <option value="">Select level</option>
            @foreach($categories as $category)
                <option value="{{$category->id}}" >{{$category->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4">
    <select class="form-control selectCourse" style="width: 100%;" name="start_at[]" data-value="" >
        <option value="">Select course date</option>
    </select>
    </div>

    <div class="col-md-2">
        <input class="form-control selectPrice" style="width: 100%;" name="price[]" type="number" placeholder="Price" data-value="" >
    </div>
    <div class="col-md-2">
        <button type="button" class="btn btn-primary clone_select">Add course</button>
    </div>
</div>