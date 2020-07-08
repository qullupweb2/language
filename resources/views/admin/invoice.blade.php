<style type="text/css">
	body {
    font-family: DejaVu Serif;
    font-size:14px;
}
</style>
<div style="position: fixed; left: -50px; top: -50px; right: -50px; bottom: -50px; text-align: center;z-index: -1000; background-color: brown; border: 2px solid green;">
  <img src="https://i.ibb.co/rFc4QPZ/back.jpg" style="width: 100%;height:100%;">
</div>
<div style="width: 650px;
    margin: 0 auto;
    height: 921px;
    background-size: 100%;">
<p>&nbsp;</p>
<p>&nbsp;</p>

<table style="width: 100%;">
<tbody>
<tr>
<td>{{$first_name}} {{$last_name}}</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>{{$street}}&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>{{$zipcode}} {{$city}}</td>
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
<p><b style="font-size: 22px">Rechnung Nr. {{$document_index}}</b></p>
<p>&nbsp;</p>
<p>Die K&uuml;rsgeb&uuml;hren f&uuml;r {{$course}}-Kurs betragen <b>{{$amount_course}} Euro</b>.</p>
<p>&nbsp;</p>
<p>Hiermit best&auml;tigen wir Ihnen, dass wir von Ihnen eine Zahlung in H&ouml;he von: <u><b>{{$amount}},00 &euro;</b></u><br>
erhalten haben.</p>
<p>&nbsp;</p>
<table style="width: 100%;">
<tbody>
<tr>
<td width="325">&nbsp;</td>
<td></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p><b>Umsatzsteuerfreie Leistung gem&auml;&szlig; &sect; 4 Nr. 21 UStG.</b></p>
<p><b>Umsatzsteuer-Identifikationsnummer: 24/138/20544</b></p>
<p>&nbsp;</p>
<table style="width: 100%;">
<tbody>
<tr>
<td><b>Name und Familienname:</b></td>
<td>&nbsp;{{$first_name}} {{$last_name}}</td>
</tr>
<tr>
<td><b>Kurstitel:</b></td>
<td>&nbsp;{{$course}}-Kurs nach GER</td>
</tr>
<tr>
<td><b>Teilnahmedauer:</b></td>
<td>&nbsp;{{$period}}</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>Hannover, @dateNow</p>
<p>&nbsp;</p>
<p>____________________</p>
</div>