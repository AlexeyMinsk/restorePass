<?
global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

Class latyhouski_restorepass extends CModule {
	
	const MODULE_ID = 'latyhouski.restorepass';
	
	var $MODULE_ID = "latyhouski.restorepass";
	var $MODULE_NAME;
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_DESCRIPTION;
	 
	function latyhouski_restorepass() {
		 
		$arModuleVersion = array();
		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");
		 
		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		$this->MODULE_NAME = GetMessage("restorepass_MODULE_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("restorepass_MODULE_DESC");
		$this->PARTNER_NAME = GetMessage("restorepass_PARTNER_NAME");
		$this->PARTNER_URI = GetMessage("restorepass_PARTNER_URI");
	 }
	 
	function InstallDB($arParams = array()){
		RegisterModule(self::MODULE_ID);
		return true;
	}

	function UnInstallDB($arParams = array()){
		UnRegisterModule(self::MODULE_ID);
		return true;
	}
	 
	function InstallEvents(){
		RegisterModuleDependences('main', 'OnBeforeUserChangePassword', self::MODULE_ID,
            'CLogic', 'OnBeforeUserChangePassword');
        RegisterModuleDependences('main', 'OnBeforeUserSendPassword', self::MODULE_ID,
            'CLogic', 'OnBeforeUserSendPassword');
		include $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.self::MODULE_ID.
            '/install/events/set_events.php';
		return true;
	}

	function UnInstallEvents(){
		UnRegisterModuleDependences('main', 'OnBeforeUserChangePassword', self::MODULE_ID,
            'CLogic', 'OnBeforeUserChangePassword');
        UnRegisterModuleDependences('main', 'OnBeforeUserSendPassword', self::MODULE_ID,
            'CLogic', 'OnBeforeUserSendPassword');
        include $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.self::MODULE_ID.
            '/install/events/del_events.php';
		return true;
	}
	
	function DoInstall(){
		
	    global $APPLICATION;
		$this->InstallDB();
		$this->InstallEvents();
		//$this->InstallFiles();
	
	    /*$APPLICATION->IncludeAdminFile(GetMessage("FORM_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/latyhouski.restorepass/install/step.php");*/
	}
	 
	function DoUninstall(){
		
	    global $APPLICATION;
		
		UnRegisterModule(self::MODULE_ID);
		$this->UnInstallDB();
		$this->UnInstallEvents();
		//$this->UnInstallFiles();
		
	    /*$APPLICATION->IncludeAdminFile(GetMessage("FORM_INSTALL_TITLE"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/latyhouski.restorepass/install/unstep.php");*/
	}
}
?>