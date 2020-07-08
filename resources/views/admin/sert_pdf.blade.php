<div style="position: fixed; left: -50px; top: -50px; right: -50px; bottom: -50px; text-align: center;z-index: -1000; background-color: brown; border: 2px solid green;">
  <img src="https://res.cloudinary.com/dkh-sprachschule/image/upload/v1573484742/sert_tnmih9.jpg" style="width: 100%;height:100%;">
</div>
<div style="padding: 20px;">
    <div style="width:40%;float:left;">
        <div style="margin-top:307px;">
            <p style="text-align: left; margin:0; padding: 0; font-weight:400;font-family: monospace; font-size: 33px;text-transform: uppercase;">Zertifikat</p>
        <p style="text-align: left; margin:0; padding:7px 0 0 0; font-weight:700;font-family: sans-serif; font-size: 15px;letter-spacing:3px;">Deutsch <?php echo str_replace('für Teilnehmer', '', $exam->name); ?></p>
        </div>
        <br><br><br><br>
        <br><br><br><br>
        <div>
            <p style="width:180px;text-align: left; margin:0; padding:80px 0 0 0; border-bottom:1px solid #000;font-weight:700;font-family: sans-serif; font-size: 14px;">DKH SPRACHSCHULE</p>
        <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px;">Georgstraße 11<br>30159 Hannover</p>
        </div>

        <div>
            <p style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px; margin-top:100px">Hannover,@dateNow<br>Ort, Datum * Place, Date</p>
        </div>
        
    </div>
    <div style="width: 60%;float:left;">
        <div style="margin-top:40px;">
            <p style="text-transform: uppercase; text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace;  font-size: 15px;">{{$user->name}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Vorname * First Name</p>

            <p style="text-transform: uppercase; text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: monospace;  font-size: 15px;">{{$user->last_name}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Familienname * Surname</p>

            <p style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: monospace; font-size: 15px;">{{$user->birthday}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Geburtsdatum * Date of birth</p>

            <p style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: monospace;  font-size: 15px;">{{$user->passport_number}}</p>
            <p style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Passnummer * ID Number</p>
        </div>

        <div style="margin-top: 150px">
            <div>
            <p style="width:44%;text-align: left;display: inline-block; float:left; margin:0; padding: 0; font-weight:700;font-family: monospace;  font-size: 15px;">PRÄDIKAT * GRADE:</p> <p  style="width: 56%;display: inline-block;float:right;margin-top:-6px;font-family: monospace;font-size: 15px;border: 1px solid #000;border-radius: 4px;padding: 5px;text-align: center;line-height: 9px;font-weight: bold;">
                                                        @if($container->ma+$container->sa+$container->hv+$container->lv < 60)
                                                        nicht bestanden  * fail
                                                        @elseif($container->ma+$container->sa+$container->hv+$container->lv < 70 && $container->ma+$container->sa+$container->hv+$container->lv > 59)
                                                        ausreichend  * fair
                                                        @elseif($container->ma+$container->sa+$container->hv+$container->lv < 80 && $container->ma+$container->sa+$container->hv+$container->lv > 69)
                                                        befriedigend  * satisfactory
                                                        @elseif($container->ma+$container->sa+$container->hv+$container->lv < 90 && $container->ma+$container->sa+$container->hv+$container->lv > 79)
                                                        gut  * good
                                                        @elseif($container->ma+$container->sa+$container->hv+$container->lv < 101 && $container->ma+$container->sa+$container->hv+$container->lv > 89)
                                                        sehr gut  * very good
@endif
                                                </p>
                                                </div>
<br><br>
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-size: 14px;">LESEVERSTEHEN * READING COMPREHENSION:</p>
                                                    <p  style="line-height:2;text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-weight: bold; font-size: 14px;">{{$container->lv}}/25</p>
<br>
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace;  font-size: 14px;">SCHRIFTLICHER AUSDRUCK * WRITTEN EXPRESSION:</p>
                                                    <p  style="line-height:2;text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-weight: bold; font-size: 14px;">{{$container->sa}}/25</p>
<br>
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-size: 14px;">HÖRVERSTEHEN * LISTENING COMPREHENSION:</p>
                                                    <p  style="line-height:2;text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-weight: bold; font-size: 14px;">{{$container->hv}}/25</p>
<br>
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-size: 14px;">MÜNDLICHER AUSDRUCK * ORAL TEST:</p>
                                                    <p  style="line-height:2;text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace; font-weight: bold; font-size: 14px;">{{$container->ma}}/25</p>
<br>
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: monospace;  font-size: 15px;">INSGESAMT * TOTAL:</p>
                                                    <p  style="text-align: left;margin:0;padding: 0px;font-family: monospace;font-size: 15px;border: 1px solid #000;border-radius: 4px;padding: 5px;width: 132px;text-align: center;line-height: 9px;font-weight: bold;">{{$container->ma+$container->sa+$container->hv+$container->lv}}/100</p>
                                                    <p style="text-align: left; font-family: monospace;font-size: 12px;">
                                                        Die Prüfung entspricht der Niveau-Stufe <?php echo str_replace('für Teilnehmer', '', $exam->name); ?> des „Gemeinsamen Europäischen Referenzrahmens“. 
                                                    </p>
                                                    <p style="text-align: left; font-family: monospace;font-size: 12px;">
                                                        Sie können dieses Zertifikat online prüfen - https://deutsch-kurs-hannover.de/verify_check 
                                                    </p>
        </div>
    </div>
</div>