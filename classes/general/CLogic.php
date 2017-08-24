<?php

use \Bitrix\Main\Security\Random;

Class CLogic{

    public static function OnBeforeUserSendPassword(&$arFields){

        if ($arFields['LOGIN']) {
            $rsUser = CUser::GetByLogin($arFields['LOGIN']);
        } else {
            $filter = Array("EMAIL" => $arFields['EMAIL']);
            $rsUser = CUser::GetList(($by="id"), ($order="desc"), $filter);
        }

        $arUser = $rsUser->Fetch();
        $ID = $arUser['ID'];

        $randString = 'abcdefghijklnmopqrstuvwxyzABCDEFGHIJKLNMOPQRSTUVWXYZ0123456789';
        $passwordLenght = rand(7, 10);
        $newPassword = Random::getStringByCharsets($passwordLenght, $randString);

        $fields = Array(
            "PASSWORD"          => $newPassword,
            "CONFIRM_PASSWORD"  => $newPassword
        );

        $user = new CUser;
        $user->Update($ID, $fields);

        static::sendMail($newPassword, $arUser['EMAIL'], $arFields['SITE_ID']);

        return false;
    }

    public static function sendMail($NEW_PASSW, $userEmail,  $SITE_ID){

        $arFields = array(
            "NEW_PASSW" => $NEW_PASSW,
            "USER_EMAIL" => $userEmail
        );
        CEvent::SendImmediate("RESTORE_PASSWORD", $SITE_ID, $arFields);
    }
}
?>