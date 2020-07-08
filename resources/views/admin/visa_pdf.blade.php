<style type="text/css">
	body {
    font-family: DejaVu Serif;
    font-size:14px;
}
</style>
<div style="position: fixed; left: -50px; top: -50px; right: -50px; bottom: -50px; text-align: center;z-index: -1000; background-color: brown; border: 2px solid green;">
  <img src="https://res.cloudinary.com/dkh-sprachschule/image/upload/v1573484706/full2_pyagae.jpg" style="width: 100%;height:100%;">
</div>
<div style="width: 650px;
    margin: 0 auto;
    height: 921px;
    background-size: 100%;">

<table style="width: 100%;">
<tbody>
<tr>
<td>{{$first_name}} {{$last_name}}</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>{{$adress}}</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</tbody>
</table>

<p>&nbsp;</p>
<p><b style="font-size: 20px">Bescheinigung zur Erteilung eines Visums</b></p>
<p>&nbsp;</p>
<p>Auf der Basis der gesetzlichen Grundlagen des Aufenthaltsgesetzes der Bundesrepublik Deutschland nach § 16
Absatz 1 laden wir Sie recht herzlich zu einer Maßnahme nach Hannover/Niedersachsen/Deutschland ein.</p>
<p><b>{{$first_name}} {{$last_name}}</b>, Reisepassnummer <b>{{$passport_number}}</b>, geboren am <b>{{$date_birth}}</b>, hat sich zu folgendem Kurs
angemeldet:</p>
<p>&nbsp;</p>


<table style="width: 100%;">
<tbody>
<tr>
<td><b>Kurstitel:</b></td>
<td>{{$course_name1}}</td>
</tr>
<tr>
<td><b>Kurszeit:</b></td>
<td>{!! $how_often !!}</td>
</tr>
<tr>
<td><b>Maßnahmebeginn:</b></td>
<td>{{$date_1}}</td>
</tr>
<tr>
<td><b>Maßnahmeende:</b></td>
<td>{{$date_2}}</td>
</tr>
<tr>
<td><b>Bedingungen:</b></td>
<td>Im Falle der nicht bestandenen Prüfung am Ende der Stufe muss der Kurs<br>
kostenpflichtig wiederholt werden.</td>
</tr>
</tbody>
</table>
<p><b>Wir bieten Kurse vom Niveau A1-C1, Deutschkurs für Mediziner sowie die Vorbereitungskurse für die
Universität an.</b></p>
<p><b>{{$first_name}} {{$last_name}}</b> hat die Kursgebühren bezahlt.</p>
<p>Wir möchten Sie bitten, uns rechtzeitig über Änderungen zu informieren.Wir freuen uns, Sie am {{$date_1}} in
der DKH Sprachschule begrüßen zu dürfen.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Hannover, @dateNow</p>
<p>&nbsp;</p>
<p>____________________</p>
</div>