<?php

/*$et = new CEventType;

$ERR = $et->Add(array(
    "LID" => "ru",
    "EVENT_NAME" => "RESTORE_PASSWORD",
    "NAME" => "Изменился пароль для доступа к сайту",
    "DESCRIPTION"   => "
        #ID# - ID баннера
        #CONTRACT_ID# - ID контракта
        #TYPE_SID# - ID типа
        "
));

if(!$ERR)
	die( $et->LAST_ERROR );*/

$arr["ACTIVE"] = "Y";
$arr["EVENT_NAME"] = "RESTORE_PASSWORD";
$arr["LID"] = 's1';//array("ru","en");//+++++++
$arr["EMAIL_FROM"] = "asdrubael@tut.by";
$arr["EMAIL_TO"] = "rash04@tut.by";
$arr["BCC"] = "";
$arr["SUBJECT"] = "Тема сообщения";
$arr["BODY_TYPE"] = "text";
$arr["MESSAGE"] = "
Внимание! Статус баннера # #ID# изменен.
Тип баннера - #TYPE_SID#
ID контракта - #CONTRACT_ID#
";
$eMess = new CEventMessage;
$ERR = $eMess->Add($arr);

if(!$ERR)
	die($eMess->LAST_ERROR );

/*$obEventType = new CEventType;
$obEventType->Add(array(
    "EVENT_NAME"    => "ADV_BANNER_STATUS_CHANGE",
    "NAME"          => "Изменился статус баннера",
    "LID"           => "ru",
    "DESCRIPTION"   => "
        #ID# - ID баннера
        #CONTRACT_ID# - ID контракта
        #TYPE_SID# - ID типа
        "
    ));
	$arr["ACTIVE"]      = "Y";
$arr["EVENT_NAME"]  = "ADV_BANNER_STATUS_CHANGE";
$arr["LID"]         = array("ru","en");
$arr["EMAIL_FROM"]  = "Asdrubael@tut.by";
$arr["EMAIL_TO"]    = "Rash04@tut.by";
$arr["BCC"]         = "";
$arr["SUBJECT"]     = "Изменен статус баннера #ID#";
$arr["BODY_TYPE"]   = "text";
$arr["MESSAGE"]     = "
Внимание! Статус баннера # #ID# изменен.
Тип баннера - #TYPE_SID#
ID контракта - #CONTRACT_ID#
";

$obTemplate = new CEventMessage;
$obTemplate->Add($arr);
$arFields = array(
    "ID"          => 124,
    "CONTRACT_ID" => 1,
    "TYPE_SID"    => "LEFT"
    );
CEvent::Send("ADV_BANNER_STATUS_CHANGE", array("ru", "en"), $arFields);*/
?>