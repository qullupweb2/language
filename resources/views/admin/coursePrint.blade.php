<script>
    setTimeout(function () {
        window.print();
        window.close();
    },500);
</script>
<style>
    body {
        font-family: Tahoma;
        padding-left:40px;
        padding-top:40px;
    }
    table, td, th {
        border:1px solid #ccc;
        border-collapse: collapse;
    }

    td,th {
        padding: 5px;
    }
</style>
<h2>Course: {{$course->name}}</h2>
<p>Period: @dateFormat($course->start_date) - @dateFormat($course->end_date)</p>
<br><br>
<h3>List of students</h3>
<table>
    <thead>
        <th>First Name</th>
        <th>Last Name</th>
    </thead>

    <tbody>

        @foreach($students as $student)
            <tr>
                <td>{{$student->name}}</td>
                <td>{{$student->last_name}}</td>
            </tr>


        @endforeach

    </tbody>
</table>