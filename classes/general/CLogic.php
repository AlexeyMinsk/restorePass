<?php

use \Bitrix\Main\Security\Random;

Class CLogic
{
        /*$arFields = array(
            "ID"          => 124,
            "CONTRACT_ID" => 1,
            "TYPE_SID"    => "LEFT"
        );

        CEvent::Send("RESTORE_PASSWORD", 's1', $arFields);*/


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
        $newPassword = Random::getStringByCharsets($passwordLenght, $randString);//randomPassword($ID);

        $fields = Array(
            "PASSWORD"          => $newPassword,
            "CONFIRM_PASSWORD"  => $newPassword
        );

        $user = new CUser;
        $user->Update($ID, $fields);

        static::sendMail($newPassword, $arFields['SITE_ID']);
    }

    public static function sendMail($NEW_PASSW, $SITE_ID){

        $arFields = array(
            "NEW_PASSW" => $NEW_PASSW
        );

        CEvent::SendImmediate("RESTORE_PASSWORD", $SITE_ID, $arFields);
    }

    /*public static function randomPassword($gid){

        if (!is_array($gid) && is_numeric($gid) && $gid > 0) {
            $gid = array($gid);
        }

        $policy = CUser::GetGroupPolicy($gid);
        $length = $policy['PASSWORD_LENGTH'];
        if ($length <= 0) {
            $length = 6;
        }

        $alphabet = Random::ALPHABET_ALPHAUPPER
        | Random::ALPHABET_ALPHALOWER | Random::ALPHABET_NUM;

        if ($policy['PASSWORD_PUNCTUATION'] == 'Y') {
            $alphabet |= Random::ALPHABET_SPECIAL;
        }

        return Random::getStringByAlphabet($length, $alphabet);
    }*/
}
?>