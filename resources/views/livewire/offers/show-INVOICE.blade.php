

<div>
<style>
    .topLevel {
        position: relative;
        display: flex;
        width: 100%;
        height: 192px;
        justify-content: end;
    }
    .address {
        display: flex;
        justify-content: start;
    }
    .address .txt {
        color: green;
        font-weight: bold;
    }
    .recipient {
        display: flex;
        justify-content: start;
        text-align: left;
        margin-top: 48px;
        font-size: x-large;
    }
    .greeting {
        display: flex;
        justify-content: start;
        text-align: left;
        margin-top: 48px;
        margin-bottom: 24px;
        font-size: x-large;
    }
    .subject {
        display: flex;
        justify-content: start;
        text-align: left;
        font-weight: bold;
        margin-top: 96px;
        font-size: x-large;
    }
    .secondLevel {
        position: relative;
        display: flex;

        justify-content: end;

    }
    .logo {
        width: fit-content;
        height: fit-content;
    }
    .dividerLine {
        border-bottom: black solid 2px;
        margin-top: 8px;
    }
    .tdRight {
        text-align: right;
        border-left: black  1px;
        font-size: x-large;
    }
    .tdLeft {
        text-align: left;
        font-size: x-large;
    }
    .transferText {
        margin-top: 48px;
        margin-bottom: 16px;
        text-align: left;
        font-size: x-large;
    }
    .signature {
        margin-top: 48px;
        margin-bottom: 64px;
        font-size: large;
        text-align: left;

    }
</style>







   <div class="container w-full">
       <div class="topLevel">
           <div class="logo">
               <img src="{{asset('img/tangensQBillLogo.png')}}">
           </div>
       </div>
       <div class="topLeft">
           <div class="address">
               <span class="txt">tangensQ GmbH   Barckhausenstr. 20    21335 Lüneburg </span>
           </div>
           <div class="dividerLine"></div>
           <div class="recipient">
               {{$offer->companies->first()->name}}<br>
               <br>
{{--               Herr<br>--}}
{{--               Position<br>--}}
               {{$offer->companies->first()->street}}<br>
               {{$offer->companies->first()->zip.' '.$offer->companies->first()->city}}<br>

           </div>
       </div>

           <div class="address">

           </div>
           <div class="date">

           </div>


       <div class="subject">
           Angebot<br>
           Angebotsnummer: {{$offer->offer_number}}<br>
           Seminar XXXX am 12.12.22
       </div>
        <div class="greeting">
            <span>Guten Tag,<br>
            auf der Basis meines Angebotes vom TT.MM.2022 erlaube ich mir, Ihnen folgenden Betrag in Rechnung zu stellen:
            </span>
        </div>
       <div class="positions">
       <table class="table stripe">
           <thead>

           </thead>
            <tbody>
            <tr>
                <td class="tdLeft">
                    Honorarsatz netto
                </td>
                <td class="tdRight">
                xxx
                </td>
            </tr>
            <tr>
                <td class="tdLeft">
                    zzgl. 19% MwSt.
                </td>
                <td class="tdRight">
                xxxx
                </td>
            </tr>
            <tr>
                <td  class="tdLeft">
                Gesamt
                </td>
                <td class="tdRight">
                XXXX
                </td>
            </tr>
            </tbody>

       </table>
       </div>
       <div class="transferText">
        <span>Bitte veranlassen Sie die Überweisung des Gesamtbetrages unter Angabe der Rechnungsnummer innerhalb von 14 Tagen auf folgendes Konto:
        IBAN: DE08 2585 0110 0230 5512 69 bei der Sparkasse Uelzen Lüchow-Dannenberg.
        </span><br>
           <span>Vielen Dank für Ihren Auftrag!</span>
       </div>
        <div class="signature">
            <span>Mit freundlichen Grüßen</span><br>
            <br>
            <br>
            <br>
            <span>Gerald Doose</span><br>
            <span>Geschäftsführer</span>
        </div>
       <div class="offerFooter">
           <table>
               <tbody>
               <tr>
                   <td>tangensQ GmbH – Institut
                       für zukunftsorientierte
                       Qualifizierung
                       Heide 5
                       29578 Eimke OT Ellerndorf
                   </td>
                   <td>Telefon +49 4131 22 38 995
                       Telefax +49 4131 22 38 997
                       Internet www.tangensq.de
                       E-Mail info@tangensq.de
                       USt-IdNr. DE334234777
                   </td>
                   <td>Bankverbindung
                       Sparkasse Uelzen
                       Lüchow-Dannenberg
                       IBAN DE08 2585 0110 0230 5512 69
                       BIC NOLADE21UEL
                   </td>
                   <td>Handelsregister
                       Lüneburg, HRB 209051
                       Geschäftsführer
                       Gerald Doose
                       Henrik Doose
                   </td>
               </tr>
               </tbody>
           </table>
       </div>
       <a class="btn btn-primary" href="{{ URL::to('/generate-offer').'/'.$offer->id }}">Export to PDF</a>
   </div>

</div>
