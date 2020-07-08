<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Email Newsletter</h3>
    </div>
    <div class="form-horizontal">

        <div class="box-body">
            <form method="post" action="@if($exam){{'/admin/emailNewsletter_exam'}}@else{{'/admin/emailNewsletter'}}@endif">
                <div class="form-group">
                    <div class="col-md-6">
                        {{csrf_field()}}
                        <select class="form-control action" style="width: 100%;" name="status" data-value="">
                            <option>Select status student</option>
                            <option value="paid">paid</option>
                            <option value="no paid">no paid</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" placeholder="Title email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                        <label for="text">Message email</label>
                        <textarea id="text" name="text" rows="10" style="width: 100%;"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input type="hidden" class="form-control" name="id" value="{{$id}}">
                        <button class="btn btn-primary">Send emails to students</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script data-exec-on-popstate>

	$(function () {
		tinymce.init({
			selector: "textarea#text",
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table paste imagetools wordcount"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",

		});
	});
</script>