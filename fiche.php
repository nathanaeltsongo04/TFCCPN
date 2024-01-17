<?php
require_once('./class/link_db.php');
require('./dompdf/autoload.inc.php');
require_once("./class/patiente.php");
require('./class/entreprise.php');
require('./class/antecedent.php');
require('./class/planning.php');
require('./class/lastconsultation.php');
require('./class/evolution.php');
require('./class/vaccination.php');
require('./class/traitement.php');
require('./class/maternite.php');
require('./class/exapasse.php');
$currentdate = DATE("Y/m/d");
// Get Data About The Company
$data = new entreprise();
$all = $data->afficher();
$id;
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}
// Get Data About Patient
$datap = new patiente();
$datap->setCODEPATIENTE($id);
$allp = $datap->afficherid();

// Get Data About Antecedents
$dataa = new antecedent();
$dataa->setRefpatiente($id);
$alla = $dataa->afficherByrefpatientelast();
if (empty($alla)) {
	echo '<script>
                    alert("Donnée vide Cette Patiente");
                    window.location.href="./rendez-voustoday.php";
                </script>';
}

// Get Data About Evolution Grossesse
$dataevo = new evolution();
$dataevo->setRefpatiente($id);
$allevo = $dataevo->afficherByrefpatientelast();

$datatrait = new traitement();
$datatrait->setRefpatiente($id);
$alltrait = $datatrait->afficherByrefpatientelast();

$datalast = new lastconsultation();
$datalast->setRefpatiente($id);
$alllast = $datalast->afficherByrefpatientelast();

$datade = new lastconsultation();
$datade->setRefpatiente($id);
$allde = $datade->afficherByrefpatientelastdecisionlast();

$datam = new maternite();
$datam->setRefpatiente($id);
$allm = $datam->afficherByrefpatientelast();

$datav = new vaccination();
$datav->setRefpatiente($id);
$allv = $datav->afficherByrefpatientelast();

$datae = new exapasse();
$datae->setRefpatiente($id);
$alle = $datae->afficherByrefpatientelast();

$datapl = new planning();
$datapl->setREFPATIENTE($id);
$allpl = $datapl->afficheridlast();

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;


// les choses a charger comme pdf dans la page
$a = 'Content-Type';
$b = 'text/html; charset=utf-8';
$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0014)about:internet -->
<html>
<head>
	<title>fiche</title>
	<meta HTTP-EQUIV=' . $a . ' CONTENT=' . $b . '/>
	<style type="text/css">
		.cs4A517927 {color:#000000;background-color:transparent;border-left:#000000 1px solid;border-top:#000000 1px solid;border-right:#000000 1px solid;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; padding-left:2px;}
		.csF0462E56 {color:#000000;background-color:transparent;border-left:#000000 1px solid;border-top:#000000 1px solid;border-right:#000000 1px solid;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:16px; font-weight:normal; font-style:normal; }
		.csE75D3AE5 {color:#000000;background-color:transparent;border-left:#000000 1px solid;border-top:#000000 1px solid;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.csC3BBD80E {color:#000000;background-color:transparent;border-left:#000000 1px solid;border-top-style: none;border-right-style: none;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.csD2198692 {color:#000000;background-color:transparent;border-left:#000000 1px solid;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs9ABF747E {color:#000000;background-color:transparent;border-left-style: none;border-top:#000000 1px solid;border-right:#000000 1px solid;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:16px; font-weight:normal; font-style:normal; }
		.csE33A3B23 {color:#000000;background-color:transparent;border-left-style: none;border-top:#000000 1px solid;border-right:#000000 1px solid;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs140EE778 {color:#000000;background-color:transparent;border-left-style: none;border-top:#000000 1px solid;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.csA4A4F90C {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right:#000000 1px solid;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs914D1A68 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right:#000000 1px solid;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs7384E3C7 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom:#000000 1px solid;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs8BD51C12 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:bold; font-style:normal; padding-left:2px;padding-right:2px;}
		.cs101A94F7 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; }
		.cs6105B8F3 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:13px; font-weight:normal; font-style:normal; padding-left:2px;}
		.cs8A77DDF0 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:15px; font-weight:bold; font-style:normal; padding-left:2px;padding-right:2px;}
		.csE9F2AA97 {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:16px; font-weight:bold; font-style:normal; padding-left:2px;padding-right:2px;}
		.csA5A7AB7C {color:#000000;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Times New Roman; font-size:16px; font-weight:bold; font-style:normal; text-decoration: underline;padding-left:2px;padding-right:2px;}
		.cs739196BC {color:#5C5C5C;background-color:transparent;border-left-style: none;border-top-style: none;border-right-style: none;border-bottom-style: none;font-family:Segoe UI; font-size:11px; font-weight:normal; font-style:normal; }
		.csF7D3565D {height:0px;width:0px;overflow:hidden;font-size:0px;line-height:0px;}
	</style>
</head>
<body leftMargin=10 topMargin=10 rightMargin=10 bottomMargin=10 style="background-color:#FFFFFF">
<table cellpadding="0" cellspacing="0" border="0" style="border-width:0px;empty-cells:show;width:1009px;height:1219px;position:relative;">
	<tr>
		<td style="width:0px;height:0px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:20px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:10px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:19px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:10px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:14px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:11px;"></td>
		<td style="height:0px;width:13px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:12px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:11px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:12px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:7px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:7px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:10px;"></td>
		<td style="height:0px;width:7px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:11px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:13px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:10px;"></td>
		<td style="height:0px;width:11px;"></td>
		<td style="height:0px;width:14px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:7px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:8px;"></td>
		<td style="height:0px;width:12px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:6px;"></td>
		<td style="height:0px;width:4px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:15px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:22px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:19px;"></td>
		<td style="height:0px;width:5px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:17px;"></td>
		<td style="height:0px;width:37px;"></td>
		<td style="height:0px;width:7px;"></td>
		<td style="height:0px;width:13px;"></td>
		<td style="height:0px;width:3px;"></td>
		<td style="height:0px;width:2px;"></td>
		<td style="height:0px;width:9px;"></td>
		<td style="height:0px;width:1px;"></td>
		<td style="height:0px;width:9px;"></td>
	</tr>
		<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csE75D3AE5" colspan="4" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:32px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="6" style="width:20px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:27px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:30px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="9" style="width:30px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:28px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:21px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:41px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="8" style="width:30px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:20px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:18px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:33px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:23px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:18px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="6" style="width:36px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:23px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:15px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:48px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:67px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:27px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csE33A3B23" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8BD51C12" colspan="214" style="width:985px;height:22px;line-height:15px;text-align:center;vertical-align:top;"><nobr>REPUBLIQUE&nbsp;DEMOCRATIQUE&nbsp;DU&nbsp;CONGO</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8BD51C12" colspan="214" style="width:985px;height:22px;line-height:15px;text-align:center;vertical-align:top;"><nobr>MINISTERE&nbsp;DE&nbsp;LA&nbsp;SANTE&nbsp;PUBLIQUE</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($all as $key => $val) {
	$html .= '   
    <tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:75px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>PROVINCE&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="48" rowspan="2" style="width:165px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $val['PROVINCE'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="26" style="width:98px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>DISTRICT&nbsp;SAN:</nobr></td>
		<td class="cs6105B8F3" colspan="40" style="width:164px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $val['DISTRICT'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="8" style="width:33px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>ZS&nbsp;:</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="32" rowspan="2" style="width:157px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $val['ZONE'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="6" style="width:25px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr></nobr></td>
		<td class="cs6105B8F3" colspan="14" rowspan="3" style="width:60px;height:47px;line-height:15px;text-align:left;vertical-align:top;"><nobr></nobr><br/><nobr></nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="5" style="width:46px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>DATE&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="9" rowspan="2" style="width:92px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . DATE("d/m/Y") . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
    <tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:14px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="24" style="width:96px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>AS/FORM/SAN&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="75" style="width:296px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $val['ASFORMATION'] . '</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csE9F2AA97" colspan="214" style="width:985px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>FICHE&nbsp;DE&nbsp;CONSULTATION&nbsp;&nbsp;&nbsp;PRENATALE</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:6px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:6px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($allp as $keyp => $valp) {
	$age = 20;
	$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="24" style="width:96px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Nom&nbsp;et&nbsp;Prenom&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="63" style="width:222px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['NOM'] . ' ' . $valp['POSTNOM'] . ' ' . $valp['PRENOM'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="20" style="width:94px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Date&nbsp;naissance&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="32" style="width:132px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['DATENAISS'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="11" style="width:37px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>age&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="12" rowspan="2" style="width:39px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['age'] . '</nobr><br/><nobr>....</nobr></td>
		<td class="cs6105B8F3" colspan="10" style="width:68px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Etat&nbsp;civil&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="20" style="width:103px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['ETATCIVIL'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="13" style="width:86px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Occupation/F&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="10" rowspan="2" style="width:93px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['OCCUPATION'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" style="width:55px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Adresse&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="33" style="width:97px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['ADRESSE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="24" style="width:110px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Nom&nbsp;du&nbsp;Partenaire&nbsp;:</nobr></td>
		<td class="cs6105B8F3" colspan="49" style="width:187px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valp['PARTENAIRE'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}

$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:14px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:14px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($alla as $keya => $vala) {
	$html .= '
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csE9F2AA97" colspan="192" style="width:803px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>ANTECEDENTS/RENSEIGNEMENTS&nbsp;GENERAUX</nobr></td>
		<td class="csA5A7AB7C" colspan="22" style="width:178px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>Rendez-vous</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="192" style="width:803px;height:22px;line-height:17px;text-align:center;vertical-align:top;"><nobr>Ant&#233;c&#233;dents&nbsp;M&#233;dicaux</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:5px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="5" rowspan="2" style="width:32px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>HTA</nobr></td>
		<td class="cs4A517927" colspan="23" rowspan="2" style="width:73px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['HTARTERIELLE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="14" rowspan="2" style="width:34px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>DBT</nobr></td>
		<td class="cs4A517927" colspan="18" rowspan="2" style="width:81px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['DBT'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="17" rowspan="2" style="width:62px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>CAERDIO</nobr></td>
		<td class="cs4A517927" colspan="16" rowspan="2" style="width:75px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['CARDIOPAT'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="21" rowspan="2" style="width:95px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>IST-VIH/SIDA</nobr></td>
		<td class="cs4A517927" colspan="25" rowspan="2" style="width:80px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['ISTVIH'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" rowspan="2" style="width:47px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Autres</nobr></td>
		<td class="cs4A517927" colspan="25" rowspan="2" style="width:151px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['AUTRES'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
foreach ($allpl as $keypl => $valpl) {
	$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:17px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="11" rowspan="2" style="width:126px;height:20px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]-->' . $valpl['DATERDV'] . '</td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:17px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:5px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="189" rowspan="2" style="width:800px;height:21px;line-height:17px;text-align:center;vertical-align:top;"><nobr>Ant&#233;c&#233;dents&nbsp;Chirurgicaux</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:5px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:16px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:16px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="15" style="width:69px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>C&#233;sarienne</nobr></td>
		<td class="cs4A517927" colspan="28" style="width:80px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['CESRIENE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="14" style="width:54px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Cerclage</nobr></td>
		<td class="cs4A517927" colspan="14" style="width:65px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['CERCLAGE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" style="width:30px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>GPU</nobr></td>
		<td class="cs4A517927" colspan="23" style="width:91px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['GPU'] . '</nobr></td>
		<td class="cs101A94F7" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="22" style="width:95px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Fibronne&nbsp;Ut&#233;rine</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:68px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['FIBROME'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:98px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Fracture&nbsp;Bassin</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:100px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['FRACTBASSIN'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="191" style="width:802px;height:22px;line-height:17px;text-align:center;vertical-align:top;"><nobr>Ant&#233;c&#233;dents&nbsp;Obst&#233;tricaux</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="6" style="width:38px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Parit&#233;</nobr></td>
		<td class="cs4A517927" colspan="6" style="width:24px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['PARITE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="21" style="width:61px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Grossesses</nobr></td>
		<td class="cs4A517927" colspan="11" style="width:25px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['GROSSESSE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:73px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Avortements</nobr></td>
		<td class="cs4A517927" colspan="6" style="width:27px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['AVORTEMENT'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="19" style="width:76px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Enfant&nbsp;en&nbsp;vie</nobr></td>
		<td class="cs4A517927" colspan="7" rowspan="2" style="width:28px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['ENFANTVIE'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="38" style="width:156px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Avortements&nbsp;du&nbsp;1er&nbsp;trimestre</nobr></td>
		<td class="cs4A517927" colspan="10" style="width:26px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['AVORTFIRSTTRIM'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="26" style="width:156px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Trimpare&nbsp;de&nbsp;15ans&nbsp;ou&nbsp;moins</nobr></td>
		<td class="cs4A517927" colspan="9" style="width:42px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['TRIMPART15'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:13px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="11" rowspan="2" style="width:25px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['TRIMPART30PLUS'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:9px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="18" rowspan="2" style="width:83px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>30ans&nbsp;ou&nbsp;Plus</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="36" rowspan="2" style="width:132px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Dernier&nbsp;Accouchement</nobr></td>
		<td class="cs4A517927" colspan="23" rowspan="2" style="width:89px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['LASTACCOUCH'] . '</nobr></td>
		<td class="cs101A94F7" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="22" rowspan="2" style="width:98px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Intervalle&nbsp;&lt;&nbsp;2&nbsp;ans</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="12" rowspan="2" style="width:34px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['INTERVAL2ANS'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" rowspan="2" style="width:42px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Eutocie</nobr></td>
		<td class="cs4A517927" colspan="12" rowspan="2" style="width:32px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['EUDOCIE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" rowspan="2" style="width:53px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Dystocie</nobr></td>
		<td class="cs4A517927" colspan="5" rowspan="2" style="width:32px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['DYSTOCIE'] . '</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:13px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="26" style="width:105px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Plus&nbsp;de&nbsp;4&nbsp;kg&nbsp;(nbre)</nobr></td>
		<td class="cs4A517927" colspan="24" style="width:69px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['POIDSSUP4'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="41" style="width:171px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Plus&nbsp;gros&nbsp;poids&nbsp;de&nbsp;naissance&nbsp;(g)</nobr></td>
		<td class="cs4A517927" colspan="10" style="width:46px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['BIGPOIDS'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="45" style="width:180px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Dernier&nbsp;accouchement&nbsp;Pr&#233;matur&#233;</nobr></td>
		<td class="cs4A517927" colspan="17" style="width:68px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['LASTBORNPREMA'] . '</nobr></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="10" style="width:72px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Post-matur&#233;</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="12" style="width:59px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['POSTMAT'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="6" style="width:46px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Mort-n&#233;</nobr></td>
		<td class="cs4A517927" colspan="11" style="width:33px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['MORTNE'] . '</nobr></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="34" style="width:110px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Mort&nbsp;avant&nbsp;7&nbsp;jours</nobr></td>
		<td class="cs4A517927" colspan="12" style="width:58px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['MORTAVSEPT'] . '</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="43" style="width:186px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Complications&nbsp;post-partum&nbsp;(Non)</nobr></td>
		<td class="cs4A517927" colspan="20" style="width:62px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['COMPOSTPAT'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="25" style="width:97px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Si&nbsp;Oui,&nbsp;lesquelles</nobr></td>
		<td class="cs6105B8F3" colspan="100" rowspan="2" style="width:405px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vala['COMPPOSTPATOUI'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:12px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:32px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:27px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:30px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="9" style="width:30px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:28px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:41px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="8" style="width:30px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:33px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:23px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="6" style="width:36px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:24px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csF0462E56" colspan="44" style="width:155px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>Date</nobr></td>
		<td class="cs9ABF747E" colspan="80" style="width:349px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>Autres&nbsp;Problems(IST,TBC,VIH/SIDA,Diab&#232;te)</nobr></td>
		<td class="cs9ABF747E" colspan="67" style="width:298px;height:22px;line-height:18px;text-align:center;vertical-align:top;"><nobr>Traitements&nbsp;et&nbsp;Observation</nobr></td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($alle as $keye => $vale) {
	$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:24px;"></td>
		<td class="csD2198692" colspan="4" style="width:8px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csF0462E56" colspan="44" style="width:155px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]-->' . $vale['ddate'] . '</td>
		<td class="cs9ABF747E" colspan="80" style="width:349px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]-->' . $vale['examen'] . '</td>
		<td class="cs9ABF747E" colspan="67" style="width:298px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]-->' . $vale['trait'] . '</td>
		<td class="cs101A94F7" colspan="5" style="width:23px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:15px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:48px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:67px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" style="width:8px;height:24px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:89px;"></td>
		<td class="csC3BBD80E" colspan="4" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:32px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:7px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:7px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:12px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:7px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:5px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:10px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="6" style="width:20px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:11px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:14px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:27px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:30px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:10px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:14px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:11px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="9" style="width:30px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:28px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:12px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:21px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:6px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:5px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:12px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:41px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="8" style="width:30px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:4px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:5px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:13px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:10px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:12px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:20px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:3px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:6px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:11px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:10px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:9px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:18px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:10px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:7px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:33px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:23px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:14px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:18px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:9px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="6" style="width:36px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:23px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:15px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:48px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:67px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:27px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csA4A4F90C" style="width:8px;height:88px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
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
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csE75D3AE5" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:25px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:15px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:15px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:5px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:29px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:17px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:21px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:27px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:13px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:16px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:7px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:8px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:38px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:18px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="4" style="width:35px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:11px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:10px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:12px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:6px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="5" style="width:14px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:4px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:9px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="3" style="width:19px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:22px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:24px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:1px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:17px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:37px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" colspan="2" style="width:20px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:3px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs140EE778" style="width:2px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csE33A3B23" colspan="3" style="width:18px;height:9px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($allevo as $keyevo => $valevo) {
	$a = $valevo['DDR'];
	$b = strtotime($a);
	$c = strtotime("+284 day", $b);
	$DPA = date('d-m-Y', $c);
	$html .= '
	<tr style="vertical-align:top;">
		<td style="width:0px;height:21px;"></td>
		<td class="csD2198692" style="width:4px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8BD51C12" colspan="213" style="width:976px;height:21px;line-height:15px;text-align:center;vertical-align:top;"><nobr>EVOLUTION&nbsp;DE&nbsp;LA&nbsp;GROSSESSE&nbsp;ACTUELLE</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:12px;"></td>
		<td class="csD2198692" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="7" style="width:39px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>DDR</nobr></td>
		<td class="cs4A517927" colspan="33" style="width:103px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['DDR'] . '</nobr></td>
		
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="7" style="width:40px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>DPA</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="24" style="width:102px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' .
		$DPA  . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="18" style="width:83px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Date&nbsp;1&#232;re&nbsp;Cons</nobr></td>
		<td class="cs4A517927" colspan="10" style="width:43px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['DATECONSULT'] . '</nobr></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="21" style="width:70px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Conjoctivit&#233;</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="12" style="width:47px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['CONJONCTIVITE'] . '</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="19" style="width:94px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Hauteur&nbsp;Ut&#233;rine</nobr></td>
		<td class="cs4A517927" colspan="13" style="width:75px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['HTUTERINE'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="18" style="width:94px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Mvment&nbsp;Foetaux</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="9" style="width:100px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['MVTFEOTAL'] . '</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="7" style="width:37px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>BCF</nobr></td>
		<td class="cs4A517927" colspan="12" style="width:43px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['BCF'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="27" style="width:68px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Pr&#233;sentation</nobr></td>
		<td class="cs4A517927" colspan="23" style="width:109px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['PRESENTATION'] . '</nobr></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="25" style="width:105px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Perte&nbsp;Liquidienne</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:77px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['PERTLIQUI'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="26" style="width:94px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Presence&nbsp;Eodem</nobr></td>
		<td class="cs4A517927" colspan="20" style="width:60px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['EODEM'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="11" style="width:73px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Albuminurie</nobr></td>
		<td class="cs4A517927" colspan="11" style="width:69px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['ALBUMIN'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="13" style="width:52px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Glyc&#233;mie</nobr></td>
		<td class="cs4A517927" colspan="7" style="width:64px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['GLYCEMIE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:37px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:23px;"></td>
		<td class="csD2198692" style="width:4px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="4" style="width:25px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>TA</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:66px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['TARTERIELLE'] . '</nobr></td>
		<td class="cs6105B8F3" colspan="19" style="width:51px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>mmHg</nobr></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:73px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Contraction</nobr></td>
		<td class="cs4A517927" colspan="18" style="width:72px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['CONTRACTION'] . '</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="30" style="width:127px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Bassin&nbsp;ou&nbsp;Promoutoire</nobr></td>
		<td class="cs4A517927" colspan="18" style="width:68px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['BASPROMO'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="9" style="width:40px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Poids</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="20" style="width:69px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['POIDS'] . '</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="5" style="width:36px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Taille</nobr></td>
		<td class="cs4A517927" colspan="11" style="width:69px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['TAILLE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:4px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="17" style="width:73px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>m&nbsp;si&nbsp;&lt;1,50</nobr></td>
		<td class="cs4A517927" colspan="11" style="width:120px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valevo['TAILLESUP'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:23px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
};
foreach ($alltrait as $keytrait => $valtrait) {

	$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:21px;"></td>
		<td class="csD2198692" style="width:4px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8BD51C12" colspan="212" style="width:975px;height:21px;line-height:15px;text-align:center;vertical-align:top;"><nobr>TRAITEMENT&nbsp;PREVENTIFS</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		
		<td class="cs6105B8F3" colspan="4" style="width:30px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>VAT</nobr></td>
		<td class="cs4A517927" colspan="26" style="width:80px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>VAT</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="11" style="width:25px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>SP</nobr></td>
		<td class="cs4A517927" colspan="14" style="width:69px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>SP</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>

	<td class="cs6105B8F3" colspan="31" style="width:131px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Dors&nbsp;sous&nbsp;moustiquaire</nobr></td>
		<td class="cs4A517927" colspan="13" style="width:39px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valtrait['MILDA'] . '</nobr></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="14" rowspan="2" style="width:69px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Si&nbsp;non&nbsp;Date</nobr><br/><nobr>du&nbsp;don</nobr></td>
		<td class="cs4A517927" colspan="30" style="width:92px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valtrait['SIMILDA'] . '</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="18" style="width:105px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Supplement&nbsp;en&nbsp;fer</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:94px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valtrait['SPFER'] . '</nobr></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="9" style="width:69px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Vermifuge</nobr></td>
		<td class="cs4A517927" colspan="7" style="width:76px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valtrait['VERMIFUGE'] . '</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:12px;"></td>
		<td class="csD2198692" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($alllast as $keylast => $vallast) {
	$html .= '
	<tr style="vertical-align:top;">
		<td style="width:0px;height:21px;"></td>
		<td class="csD2198692" style="width:4px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="197" style="width:824px;height:21px;line-height:17px;text-align:center;vertical-align:top;"><nobr>Consultation(fin&nbsp;8eme&nbsp;mois)&nbsp;9eme&nbsp;mois</nobr></td>
		<td class="cs8BD51C12" colspan="6" style="width:41px;height:21px;line-height:15px;text-align:center;vertical-align:top;"><nobr>Date</nobr></td>
		<td class="cs4A517927" colspan="10" rowspan="2" style="width:102px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['DDATE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:1px;"></td>
		<td class="csD2198692" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:13px;"></td>
		<td class="csD2198692" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:13px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="15" style="width:72px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Conjoctivit&#233;</nobr></td>
		<td class="cs4A517927" colspan="19" style="width:52px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['CONJ'] . '</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="25" style="width:94px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Hauteur&nbsp;Ut&#233;rine</nobr></td>
		<td class="cs4A517927" colspan="13" style="width:53px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['HTUTERINE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="23" style="width:96px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Si&nbsp;plus&nbsp;de&nbsp;36&nbsp;cm</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="24" style="width:102px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['PLUSDE36'] . '</nobr></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="46" style="width:193px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Si&nbsp;HB&nbsp;&lt;&nbsp;7g&nbsp;%&nbsp;ou&nbsp;HB&nbsp;moins&nbsp;de&nbsp;50%</nobr></td>
		<td class="cs4A517927" colspan="39" style="width:270px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['HB7ET50'] . '</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="17" style="width:78px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr></nobr></td>
		<td class="cs4A517927" colspan="29" style="width:75px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>BCF</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:78px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>BCF</nobr></td>
		<td class="cs4A517927" colspan="13" style="width:52px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['BTF'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="38" style="width:166px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Si&nbsp;BCF&nbsp;&lt;120/min&nbsp;et&nbsp;&gt;160/min</nobr></td>
		<td class="cs4A517927" colspan="76" style="width:333px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['SIBTF'] . '</nobr></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="9" style="width:69px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Pr&#233;sentation</nobr></td>
		<td class="cs4A517927" colspan="7" style="width:76px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['PRESENTATION'] . '</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="9" style="width:54px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Oed&#232;mes</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="26" style="width:73px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['OEDEM'] . '</nobr></td>
		<td class="cs101A94F7" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="16" style="width:59px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Albumine</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="19" style="width:82px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['ALBUMINE'] . '</nobr></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="11" style="width:22px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>TA</nobr></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="11" style="width:68px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['TA'] . '</nobr></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="39" style="width:154px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>TA&gt;14&nbsp;et&nbsp;minima&nbsp;9&nbsp;ou&nbsp;plus</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="41" style="width:216px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>.....</nobr></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="17" rowspan="2" style="width:98px;height:32px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Perte</nobr><br/><nobr>Liquidiennes</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="6" style="width:75px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['PERTLIQUI'] . '</nobr></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="37" rowspan="2" style="width:120px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['CONTRACTION'] . '</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:12px;"></td>
		<td class="csD2198692" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="18" rowspan="2" style="width:78px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Contraction</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="27" rowspan="2" style="width:96px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Autre&nbsp;&#224;&nbsp;pr&#233;ciser</nobr></td>
		<td class="cs4A517927" colspan="93" rowspan="2" style="width:426px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $vallast['AUTREPRECISION'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:12px;"></td>
		<td class="csD2198692" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:12px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
foreach ($allde as $keyde => $valde) {
	$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:21px;"></td>
		<td class="csD2198692" style="width:4px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="215" style="width:976px;height:21px;line-height:17px;text-align:center;vertical-align:top;"><nobr>D&#233;cision&nbsp;du&nbsp;Centre&nbsp;de&nbsp;Sant&#233;</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:21px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:18px;"></td>
		<td class="csD2198692" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="25" style="width:95px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>CPN&nbsp;NORMAL</nobr></td>
		<td class="cs4A517927" colspan="12" style="width:33px;height:20px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valde['cpnnormal'] . '</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="38" rowspan="2" style="width:153px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>RDV(R&#233;f&#233;r&#233;e)&nbsp;&#224;&nbsp;la&nbsp;maternit&#233;</nobr></td>
		<td class="cs4A517927" colspan="13" rowspan="2" style="width:33px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valde['cpnnormal'] . '</nobr></td>
		<td class="cs101A94F7" style="width:13px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="6" rowspan="2" style="width:37px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Date</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs4A517927" colspan="23" rowspan="2" style="width:102px;height:21px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valde['rdvmat'] . '</nobr></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="15" rowspan="2" style="width:45px;height:23px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Raison</nobr></td>
		<td class="cs6105B8F3" colspan="73" rowspan="3" style="width:423px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valde['raison'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '<tr style="vertical-align:top;">
		<td style="width:0px;height:1px;"></td>
		<td class="csD2198692" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:1px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
foreach ($allm as $keym => $valm) {
	$html .= '
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs8A77DDF0" colspan="214" style="width:975px;height:22px;line-height:17px;text-align:center;vertical-align:top;"><nobr>Suivi&nbsp;&#224;&nbsp;la&nbsp;Maternit&#233;</nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr><tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:29px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:21px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:27px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:13px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="28" style="width:101px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Examen&nbsp;Physique :</nobr></td>
		<td class="cs6105B8F3" colspan="94" rowspan="2" style="width:377px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valm['EXAPHYSIQUE'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="39" style="width:129px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Examen&nbsp;Paracliniques :</nobr></td>
		<td class="cs6105B8F3" colspan="52" rowspan="2" style="width:355px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valm['EXAPARACLINIQUE'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="30" style="width:112px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Autres&nbsp;observations :</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="94" rowspan="2" style="width:387px;height:32px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valm['AUTROBS'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="23" style="width:72px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>Conclusion :</nobr></td>
		<td class="cs6105B8F3" colspan="64" rowspan="2" style="width:395px;height:32px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valm['CONCLUSION'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:10px;"></td>
		<td class="csD2198692" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:15px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:5px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:12px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:10px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:22px;"></td>
		<td class="csD2198692" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="14" style="width:60px;height:22px;line-height:15px;text-align:left;vertical-align:top;"><nobr>D&#233;cision :</nobr></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs6105B8F3" colspan="110" rowspan="2" style="width:439px;height:33px;line-height:15px;text-align:left;vertical-align:top;"><nobr>' . $valm['DECISION'] . '</nobr><br/><nobr></nobr></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:22px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:11px;"></td>
		<td class="csD2198692" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:25px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:15px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:16px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:7px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:8px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:38px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="4" style="width:35px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:11px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:10px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:12px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:6px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="5" style="width:14px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:4px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:9px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="3" style="width:19px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:22px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:24px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:1px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:17px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:37px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" colspan="2" style="width:20px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:3px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs101A94F7" style="width:2px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs914D1A68" colspan="3" style="width:18px;height:11px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>
	<tr style="vertical-align:top;">
		<td style="width:0px;height:19px;"></td>
		<td class="csC3BBD80E" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:25px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:15px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:15px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:12px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:5px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:29px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:17px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:21px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:27px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:13px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:14px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:16px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:7px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:8px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:38px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:18px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="4" style="width:35px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:11px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:10px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:12px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:6px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="5" style="width:14px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:4px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:9px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="3" style="width:19px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:22px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:24px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:1px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:17px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:37px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" colspan="2" style="width:20px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:3px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="cs7384E3C7" style="width:2px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
		<td class="csA4A4F90C" colspan="3" style="width:18px;height:18px;"><!--[if lte IE 7]><div class="csF7D3565D"></div><![endif]--></td>
	</tr>';
}
$html .= '</table>
</body>
</html>';

$dompdf = new Dompdf();
$option = new Options();
$option->set('chroot', realpath(''));
$dompdf = new Dompdf($option);
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A3', 'portrait');

// Render the HTML as PDF

$dompdf->render();

// Output the generated PDF to Browser
ob_clean();
$dompdf->stream('FicheCPN.pdf', ['Attachment' => false]);
