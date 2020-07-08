<div style="position: fixed; left: -50px; top: -50px; right: -50px; bottom: -50px; text-align: center;z-index: -1000; background-color: brown; border: 2px solid green;">
  <img src="https://res.cloudinary.com/dkh-sprachschule/image/upload/v1573484558/back_swclvc.jpg" style="width: 100%;height:100%;">
</div>

<div style="padding: 20px;">
    <div style="width:30%;float:left;">
        <div style="margin-top:579px;">
            <p style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: sans-serif; font-size: 12px;">
Teilnahmebescheinigung</p>
        <p style="text-align: left; margin:0; padding:7px 0 0 0; font-weight:300;font-family: sans-serif; font-size: 15px;letter-spacing:3px;">Deutschkurs</p>
        </div>
        
        <div>
            <p style="text-align: left; margin:0; padding:80px 0 0 0; border-bottom:1px solid #000;font-weight:700;font-family: sans-serif; font-size: 14px;max-width: 165px;">DKH SPRACHSCHULE</p>
        <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px;">Georgstraße 11<br>30159 Hannover</p>
        </div>

        <div>
            <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px; margin-top:100px">Hannover, @dateNow<br>Ort, Datum * Place, Date</p>
        </div>
        
    </div>
    <div style="width: 70%;float:left;">
        
        <br><br><br><br>

        <h1 style="font-size: 22px">Teilnahmebescheinigung</h1>

        <div style="margin-top: 150px">
            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 16px;">Teilnehmernummer: </p>
            <span style="float:right;width:60%">{{$number}}</span>
            </div>
            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 16px;">Name und Familienname: </p>
            <span style="float:right;width:60%">{{$first_name}} {{$last_name}}</span>
            </div>

           
            <div style="width:100%; margin-top: 20px;">
                <p style="text-align: left; margin:0; padding: 0;font-family: Times New Roman; font-size: 16px;"><b>{{$first_name}} {{$last_name}}</b> nimmt an einem {{$course_name}} - Deutschkurs vom
{{$start_date}} bis zum {{$end_date}} teil.

</p>

            </div>
            <div style="margin-top: 460px;"></div>
            <div style="width:90px; border-bottom:1px solid #000; margin-top: 100px;">
                                </div>
            
            
        </div>
    </div>
</div>