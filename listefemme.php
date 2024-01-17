<?php
require_once('./class/link_db.php');
require('./dompdf/autoload.inc.php');
require_once("./class/patiente.php");
$data = new patiente();
$all = $data->afficheralpha();
// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


// les choses a charger comme pdf dans la page
$a = 'Content-Type';
$b = 'text/html; charset=utf-8';
$html = '<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html>

    <head>
        <title>Liste Femmes Enregistrées</title>
        <meta HTTP-EQUIV=' . $a . ' CONTENT=' . $b . ' />
        <style type="text/css">
        *{
            margin-left:0px
        }
        .csAA5B9630 {
            color: #000000;
            background-color: transparent;
            border-left: #000000 1px solid;
            border-top: #000000 1px solid;
            border-right: #000000 1px solid;
            border-bottom: #000000 1px solid;
            font-family: Times New Roman;
            font-size: 16px;
            font-weight: bold;
            font-style: normal;
        }

        .cs425CAA45 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top: #000000 1px solid;
            border-right: #000000 1px solid;
            border-bottom: #000000 1px solid;
            font-family: Times New Roman;
            font-size: 16px;
            font-weight: bold;
            font-style: normal;
        }

        .cs8BD51C12 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 13px;
            font-weight: bold;
            font-style: normal;
            padding-left: 2px;
            padding-right: 2px;
        }

        .cs101A94F7 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 13px;
            font-weight: normal;
            font-style: normal;
        }

        .csE9F2AA97 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 16px;
            font-weight: bold;
            font-style: normal;
            padding-left: 2px;
            padding-right: 2px;
        }

        .cs2C853136 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 19px;
            font-weight: bold;
            font-style: normal;
            padding-left: 2px;
            padding-right: 2px;
        }

        .cs1A57CD4B {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 20px;
            font-weight: bold;
            font-style: normal;
            padding-left: 2px;
            padding-right: 2px;
        }

        .cs38564E56 {
            color: #000000;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Times New Roman;
            font-size: 21px;
            font-weight: bold;
            font-style: normal;
            text-decoration: underline;
            padding-left: 2px;
            padding-right: 2px;
        }

        .cs739196BC {
            color: #5C5C5C;
            background-color: transparent;
            border-left-style: none;
            border-top-style: none;
            border-right-style: none;
            border-bottom-style: none;
            font-family: Segoe UI;
            font-size: 11px;
            font-weight: normal;
            font-style: normal;
        }

        .csF7D3565D {
            height: 0px;
            width: 0px;
            overflow: hidden;
            font-size: 0px;
            line-height: 0px;
        }
        </style>
    </head>

    <body leftMargin=10 topMargin=10 rightMargin=10 bottomMargin=10 style="background-color:#FFFFFF">
        <table cellpadding="0" cellspacing="0" border="0"
            style="border-width:0px;empty-cells:show;width:1059px;height:331px;position:relative;">
            <thead>
                <tr>
                    <td style="width:0px;height:0px;"></td>
                    <td style="height:0px;width:38px;"></td>
                    <td style="height:0px;width:107px;"></td>
                    <td style="height:0px;width:36px;"></td>
                    <td style="height:0px;width:58px;"></td>
                    <td style="height:0px;width:170px;"></td>
                    <td style="height:0px;width:34px;"></td>
                    <td style="height:0px;width:122px;"></td>
                    <td style="height:0px;width:227px;"></td>
                    <td style="height:0px;width:71px;"></td>
                    <td style="height:0px;width:61px;"></td>
                    <td style="height:0px;width:37px;"></td>
                    <td style="height:0px;width:98px;"></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:23px;"></td>
                    <td class="cs739196BC" colspan="5"
                        style="width:409px;height:23px;line-height:14px;text-align:center;vertical-align:middle;">
                        
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:35px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:25px;"></td>
                    <td></td>
                    <td class="cs101A94F7" colspan="2" rowspan="6"
                        style="width:143px;height:129px;text-align:left;vertical-align:top;">
                        <div style="overflow:hidden;width:143px;height:129px;">
                            <img src="./assets/img/logon.png" width="135px" height="129px">                            
                        </div>
                    </td>
                    <td></td>
                    <td class="cs1A57CD4B" colspan="5"
                        style="width:620px;height:25px;line-height:23px;text-align:center;vertical-align:top;">
                        <nobr>REPUBLIQUE&nbsp;DEMOCRATIQUE&nbsp;DU&nbsp;CONGO</nobr>
                    </td>
                    <td></td>
                    <td class="cs101A94F7" colspan="2" rowspan="6"
                        style="width:135px;height:129px;text-align:left;vertical-align:top;">
                        <div style="overflow:hidden;width:135px;height:129px;">
                            <img src="./assets/img/logon.png" width="135px" height="129px">
                        </div>
                    </td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:23px;"></td>
                    <td></td>
                    <td></td>
                    <td class="cs2C853136" colspan="5"
                        style="width:620px;height:23px;line-height:22px;text-align:center;vertical-align:top;">
                        <nobr>PROVINCE&nbsp;DU&nbsp;NORD-KIVU</nobr>
                    </td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:22px;"></td>
                    <td></td>
                    <td></td>
                    <td class="csE9F2AA97" colspan="5"
                        style="width:620px;height:22px;line-height:18px;text-align:center;vertical-align:top;">
                        <nobr>HOPITAL&nbsp;DES&nbsp;GRANDS&nbsp;LACS</nobr>
                    </td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:22px;"></td>
                    <td></td>
                    <td></td>
                    <td class="cs8BD51C12" colspan="5"
                        style="width:620px;height:22px;line-height:15px;text-align:center;vertical-align:top;">
                        <nobr>
                            Adresse.&nbsp;2104,&nbsp;AV&nbsp;NYAMULAGIRA,&nbsp;Q.&nbsp;MURARA,&nbsp;COM.&nbsp;DE&nbsp;KARISIMBI,
                        </nobr>
                    </td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:22px;"></td>
                    <td></td>
                    <td></td>
                    <td class="cs8BD51C12" colspan="5"
                        style="width:620px;height:22px;line-height:15px;text-align:center;vertical-align:top;">
                        <nobr>Tel&nbsp;:&nbsp;+243&nbsp;974&nbsp;988&nbsp;721,&nbsp;+243&nbsp;815&nbsp;145&nbsp;422
                        </nobr>
                    </td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:15px;"></td>
                    <td></td>
                    <td></td>
                    <td class="cs8BD51C12" colspan="5" rowspan="2"
                        style="width:620px;height:23px;line-height:15px;text-align:center;vertical-align:top;">
                        <nobr>hglgoma@gmail.com</nobr>
                    </td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:8px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:29px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:26px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="cs38564E56" colspan="5"
                        style="width:620px;height:26px;line-height:25px;text-align:center;vertical-align:top;">
                        <nobr>Liste&nbsp;de&nbsp;Femmes&nbsp;Enregistr&#233;es</nobr>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:33px;"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="vertical-align:top;">
                    <td style="width:0px;height:24px;"></td>
                    <td></td>
                    <td></td>                    
                    <td class="csAA5B9630" colspan="4"
                        style="width:296px;height:22px;line-height:18px;text-align:center;vertical-align:top;">
                        <nobr>NOMS</nobr>
                    </td>
                    <td class="cs425CAA45"
                        style="width:121px;height:22px;line-height:18px;text-align:center;vertical-align:top;">
                        <nobr>ETAT&nbsp;CIVIL</nobr>
                    </td>
                    <td class="cs425CAA45"
                        style="width:226px;height:22px;line-height:18px;text-align:center;vertical-align:top;">
                        <nobr>ADRESSE</nobr>
                    </td>
                    <td class="cs425CAA45" colspan="3"
                        style="width:168px;height:22px;line-height:18px;text-align:center;vertical-align:top;">
                        <nobr>OCCUPATION</nobr>
                    </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>';
foreach ($all as $key => $val) {
    $html .= '<tr style="vertical-align:top;">
    <td style="width:0px;height:24px;"></td>
    <td></td>
    <td></td>
    <td class="csAA5B9630" colspan="4" style="width:296px;height:22px; text-align:center; ">'
        . $val['NOM'] . ' ' . $val['POSTNOM'] . ' ' . $val['PRENOM'] . '
    </td>
    <td class="cs425CAA45" style="width:121px;height:22px; text-align:center;">
        ' . $val['ETATCIVIL'] . '
    </td>
    <td class="cs425CAA45" style="width:226px;height:22px; text-align:center;">
        ' . $val['ADRESSE'] . '
    </td>
    <td class="cs425CAA45" colspan="3" style="width:168px;height:22px; text-align:center;">
        ' . $val['OCCUPATION'] . '
    </td>
    <td></td>
</tr>';
}
$html .= '</tbody>
</table>
</body>

</html>';

$dompdf = new Dompdf();
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('nathan.pdf', ['Attachment' => false]);
