<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

  <!-- CSS Reset -->
  <script>
    try {
        $element = $('#confirm');
        $('body').html($element);
    } catch(err) {

    }


    setTimeout(function () {
        window.print();
        //location.href = '/admin';
    },500);
</script>
    
    
    <!-- Progressive Enhancements -->
    

</head>
<body bgcolor="#fff" width="100%" style="Margin: 0;">
<table bgcolor="#fff" cellpadding="0" cellspacing="0" border="0" height="100%" width="600" style="border-collapse:collapse;">
<tr>
<td valign="top">
    <center style="width: 100%;">
        <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600" class="email-container">
            
           
            

            <!-- Background Image with Text : BEGIN -->
            <tr>
                <td  bgcolor="#fff" valign="middle" style="text-align: center; background-position: top left !important;background-repeat:no-repeat!important;  ">
                    <!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                    <div>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="40%" valign="middle" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    
                                </td>
                                <td  width="60%" valign="top" style="text-align: center; padding: 40px 0 0 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                   
<p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$name}}</p>
<p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Vorname∙First Name</p>

<p  style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$lastname}}</p>
<p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Familienname∙Surname</p>

<p  style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$birthday}}</p>
<p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Geburtsdatum ∙ Date ofbirth</p>

<p  style="text-align: left; margin:20px 0 0 0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$contractnumber}}</p>
<p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">Teilnehmernummer∙Number</p>

                                </td>
                               
                            </tr>
                        </table>
                        </div>
                    <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" valign="middle" style="text-align: center; background-position: top left !important;background-repeat:no-repeat!important;  ">
                    <!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                    <div>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="40%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    
                                </td>
                                <td  width="60%" valign="top" style="text-align: center; padding: 40px 0 0 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:70px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="40%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Kurstitel:</p>
                                                </td>
                                                <td  width="60%" valign="top" style="text-align: center; padding: 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">{{$coursesnames}}</p> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:30px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="40%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Kurszeit:</p>
                                                </td>
                                                <td  width="60%" valign="top" style="text-align: center; padding: 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">{{$how_often}}</p> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:30px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="40%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Teilnahmedauer:</p>
                                                </td>
                                                <td  width="60%" valign="top" style="text-align: center; padding: 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">{!! $date_range !!}</p> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                            
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:30px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="40%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Buch:</p>
                                                </td>
                                                <td  width="60%" valign="top" style="text-align: center; padding: 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left;margin:0; padding: 0px; font-family: sans-serif; font-size: 14px;">{{$books}}</p> 
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                               
                            </tr>
                        </table>
                        </div>
                    <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" valign="middle" style="text-align: center; background-position: top left !important;background-repeat:no-repeat!important;  ">
                    <!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                    <div>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="40%" valign="top" style="text-align: center; padding:0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    <div style="display:block; position:relative; float:left; padding:0 30px;margin-top:40px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="100%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: sans-serif; font-size: 14px;">ANMELDEBESTÄTIGUNG</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding:3px 0 0 0; font-weight:300;font-family: sans-serif; font-size: 14px;letter-spacing:3px;">Deutschkurs</p>
                                                    
                                                    <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="100%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding:80px 0 0 0; border-bottom:1px solid #000;font-weight:700;font-family: sans-serif; font-size: 14px;">DKH SPRACHSCHULE</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    <p  style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px;">Georgstraße 11<br>30159 Hannover</p>
                                                </td>
                                            </tr>
                                        </table>
                                                    
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </td>
                                <td  width="60%" valign="top" style="text-align: center; padding:0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:40px;">

                                    </div>
                                    <div style="display:block; position:relative; float:left; width:100%;margin-top:30px;">
                                        <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td width="100%" valign="top" style="text-align: center; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                                    @if($prepaid === false)
               
                                                        <p  style="text-align: left; margin:0; padding: 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">{{$name}} ist der/die Teilnehmer/in der DKH Sprachschule.</p>
                                                    
                                                    @endif
                                                    <p  style="text-align: left; margin:0; padding:15px 0 0 0; font-weight:700;font-family: Times New Roman; font-size: 18px;">Die allgemeine Geschäftsbedingungen und den Hinweis zum vorzeitigen Erlöschen des Widerrufsrechts habe ich zur Kenntnis genommen und bestätige es mit meiner Unterschrift. </p>
                                                    <p>You can check originaly this document on <a href="https://deutsch-kurs-hannover.de/verify_check" target="_blank">https://deutsch-kurs-hannover.de/verify_check</a></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </div> 
                                </td>
                               
                            </tr>
                        </table>
                        </div>  
                    <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->
                </td>
            </tr>
            <tr>
                <td bgcolor="#fff" valign="middle" style="text-align: center; background-position: bottom left !important; ">
                    <!--[if gte mso 9]>
                    <v:rect xmlns:v="urn:schemas-microsoft-com:vml" fill="true" stroke="false" style="width:600px;height:175px; background-position: center center !important;">
                    <v:fill type="tile" src="http://placehold.it/600x230/222222/666666" color="#222222" />
                    <v:textbox inset="0,0,0,0">
                    <![endif]-->
                    <div>
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td valign="top" width="40%"style="text-align: center; padding: 19px 0 110px 30px; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                    <p  style="text-align: left; margin:0; padding:0; font-weight:300;font-family: sans-serif; font-size: 14px;">Georgstraße 11<br>30159 Hannover<br>@dateFormat</p>
                                </td>
                                <td valign="top" width="60%"style="text-align: left; padding: 80px 0 0 0; font-family: Times New Roman; font-size: 15px; mso-height-rule: exactly; line-height: 20px; color: #000;">
                                   <div style="width:90px; border-bottom:1px solid #000;">
                                </td>
                            </tr>
                        </table>
                        </div>
                    <!--[if gte mso 9]>
                    </v:textbox>
                    </v:rect>
                    <![endif]-->
                </td>
            </tr>
            <!-- Background Image with Text : END -->
           
     
        </table>
    </center>
</td>
</tr>
</table>
</body>
<small style="display: block;position: absolute;right:20px;bottom:20px;">2020{{$payed}}{{ \Carbon\Carbon::now()->format('Hs')}}</small>
</html>

