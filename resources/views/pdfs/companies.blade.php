<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Angebot</title>
<style>
    body {
        height: 1120px;
    }
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
        font-size: x-small;
    }
    .recipient {
        display: flex;
        justify-content: start;
        text-align: left;
        margin-top: 32px;
        font-size: small;
    }
    .greeting {
        display: flex;
        justify-content: start;
        text-align: left;
        margin-top: 48px;
        margin-bottom: 24px;
        font-size: small;
    }

    .subject {
        display: flex;
        justify-content: start;
        text-align: left;
        font-weight: bold;
        margin-top: 32px;
        font-size: small;
    }

    .logo {
        width: fit-content;
        height: fit-content;
    }
    .dividerLine {
        border-bottom: black solid 2px;
        margin-top: 8px;
    }

    .transferText {
        margin-top: 48px;
        margin-bottom: 16px;
        text-align: left;
        font-size: small;
    }
    .signature {
        position: absolute;
        bottom: 64px;
        text-align: left;
    }
    .signature span {
        font-size: small;
    }
    .offerFooter {
        font-size: xx-small;
        position: absolute;
        bottom: 1px;
    }
</style>
</head>

<body>

<div class="container w-full">
    <div class="topLevel">
        <div class="logo">
            <img src="{{asset('img/tangensQBillLogo.png')}}" alt="logo" align="right">
        </div>
    </div>
    <div class="topLeft">
        <div class="address">
            <span class="txt">tangensQ GmbH   Barckhausenstr. 20    21335 Lüneburg </span>
        </div>
        <div class="dividerLine"></div>
        <div class="recipient">
            <table>
                <thead>
                <tr>
                    <th style="text-align: left">Empfänger</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Firma</td>
                </tr>
                <tr>
                    <td>StraßeStraßeStraße NR</td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td style="margin-top: 4px">PLZ ORT</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="address">
    </div>
    <div class="date">
    </div>
    <div class="subject">
        <table>
            <tbody>
            <tr>
                <td><span>RE-22100001 / Seminar XXX am XX.XX.XX</span></td>
            </tr>

            </tbody>
        </table>
    </div>
    <div class="greeting">
        <table>
            <tr>
                <td><span>Guten Tag,</span></td>
            </tr>
            <tr>
                <td> <span>auf der Basis meines Angebotes vom TT.MM.2022 erlaube ich mir, Ihnen folgenden Betrag in Rechnung zu stellen:</span></td>
            </tr>
        </table>

    </div>
    <div class="positions">
        <table style="width: 100%;">
            <tbody>
            <tr style="border-bottom: black thin;">
                <td style="text-align: left">
                    Honorarsatz netto
                </td>
                <td style="text-align: right">
                    xxx
                </td>
            </tr>
            <tr style="border-bottom: black thin;">
                <td style="text-align: left">
                    zzgl. 19% MwSt.
                </td>
                <td style="text-align: right">
                    xxxx
                </td>
            </tr>
            <tr style="border-bottom: black thin;">
                <td style="text-align: left">
                    Gesamt
                </td>
                <td style="text-align: right">
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
</div>
</body>

</html>
