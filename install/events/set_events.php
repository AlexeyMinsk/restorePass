<?php

$et = new CEventType;

$ERR = $et->Add(array(
    "LID" => "ru",
    "EVENT_NAME" => "RESTORE_PASSWORD",
    "NAME" => "Изменился пароль для доступа к сайту",
    "DESCRIPTION"   => "
    #NEW_PASSW# - сгенерированный пароль,
    #USER_EMAIL# - электронная почта пользователя
    "
));

$arr["ACTIVE"] = "Y";
$arr["EVENT_NAME"] = "RESTORE_PASSWORD";
$arr["LID"] = 's1';
$arr["EMAIL_FROM"] = "#DEFAULT_EMAIL_FROM#";
$arr["EMAIL_TO"] = "#USER_EMAIL#";
$arr["BCC"] = "";
$arr["SUBJECT"] = "Пароль изменён";
$arr["BODY_TYPE"] = "Пароль для входа на сайт";
$arr["MESSAGE"] = "
Информационное сообщение
------------------------------------------

Внимание! Ваш пароль изменён. Автоматичесски сгенерированный пароль для входана сайт - #NEW_PASSW#.

Сообщение сгенерировано автоматически.
";

$eMess = new CEventMessage;
$ERR = $eMess->Add($arr);
?>