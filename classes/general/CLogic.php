<?php
Class CLogic{
	
	public function OnBeforeUserChangePassword(){

        die("in OnBeforeUserChangePassword");

        $arFields = array(
            "ID"          => 124,
            "CONTRACT_ID" => 1,
            "TYPE_SID"    => "LEFT"
        );

        CEvent::Send("RESTORE_PASSWORD", 's1', $arFields);
	}

	public function OnBeforeUserSendPassword(){
		
		//die("in OnBeforeUserSendPassword");
		$arFields = array(
            "ID"          => 124,
            "CONTRACT_ID" => 1,
            "TYPE_SID"    => "LEFT"
        );

        CEvent::Send("RESTORE_PASSWORD", 's1', $arFields);
    }
}
?>