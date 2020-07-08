<div style="position: fixed; left: -50px; top: -50px; right: -50px; bottom: -50px; text-align: center;z-index: -1000; background-color: brown; border: 2px solid green;">
    <img src="https://res.cloudinary.com/dkh-sprachschule/image/upload/v1573484558/back_swclvc.jpg" style="width: 100%;height:100%;">
</div>
<div style="padding: 20px;">
    <div style="width:30%;float:left;">
        <div style="margin-top:579px;">
            <p style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: sans-serif; font-size: 14px;">
ANMELDEBESTÄTIGUNG</p>
        <p style="text-align: left; margin:0; padding:7px 0 0 0; font-weight:300;font-family: sans-serif; font-size: 15px;letter-spacing:3px;">Deutschkurs</p>
        </div>
        
        <div>
            <p style="text-align: left; margin:0; padding:80px 0 0 0; border-bottom:1px solid #000;font-weight:700;font-family: sans-serif; font-size: 14px;max-width: 180px;">DKH SPRACHSCHULE</p>
        <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px;">Georgstraße 11<br>30159 Hannover</p>
        </div>

        <div>
            <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px; margin-top:100px">Hannover, @dateNow<br>Ort, Datum * Place, Date</p>
        </div>
        
    </div>
    <div style="width: 70%;float:left;">
        <div style="margin-top:40px;">
            <p style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$name}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Vorname * First Name</p>

            <p style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$lastname}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Familienname * Surname</p>

            <p style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$birthday}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Geburtsdatum * Date of birth</p>

            <p style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$contractnumber}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Teilnehmernummer * Number</p>
        </div>

        <div style="margin-top: 150px">
            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Kurstitel: </p>
            <span style="float:right;width:60%">{{$coursesnames}}</span>
            </div>
            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Kurszeit: </p>
            <span style="float:right;width:60%">{{$how_often}}</span>
            </div>

            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Teilnahmedauer: </p>
            <span style="float:right;width:60%">{!! $date_range !!}</span>
            </div>
            <div style="width:100%; height: 40px;">
                <p style="float:left; width:40%;text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Buch: </p>
            <span style="float:right;width:60%">{{$books}}</span>
            </div>

            <div style="width:100%; height: 40px;">

            </div>

            <div style="width:100%; margin-top: 20px;">
                <p style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">
                    @if($prepaid === false)
               
                        {{$name}} ist der/die Teilnehmer/in der DKH Sprachschule.
                    
                    @endif</p><br>
                <p style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Die allgemeine Geschäftsbedingungen und den Hinweis zum vorzeitigen Erlöschen des Widerrufsrechts habe ich zur Kenntnis genommen und bestätige es mit meiner Unterschrift.

</p>
<p>You can check originaly this document on <a href="https://deutsch-kurs-hannover.de/verify_check" target="_blank">https://deutsch-kurs-hannover.de/verify_check</a></p>
            </div>
            <div style="width:90px; position:relative; border-bottom:1px solid #000; margin-top: 100px;">
                <small style="display: block;position: absolute;right:-350px;bottom:20px;">2020{{$payed}}{{ \Carbon\Carbon::now()->format('Hs')}}</small>
                                </div>
            
            
        </div>
    </div>
    
</div>