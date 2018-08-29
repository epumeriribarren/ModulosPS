<?php
if(!defined('_PS_VERSION_')){
	exit;
}
class ResponsiveHome extends Module{
	public function __construct(){
		$this->name='responsive_home';//mismo nombre de la carpeta
		$this->tab='Design';//en que categoria va
		$this->version="0.9.9";//version del modulo
		$this->author='Andre Verdejo';//autor del modulo
		$this->need_instance=0;//Un 0 porn que no necessito cargar una classe en el modulo
		$this->ps_versions_compliancy=array('min' => '1.7.x.x', 'max' => _PS_VERSION_);
		/*									vesion minima para que funcione en un prestashop
		*/
		$this->bootstrap=true;
		//si usa boottrap
		parent::__construct();
		//llamanado a la funcion del padre
		$this->displayName=$this->l('ResponsiveHome');
		$this->description=$this->l('Añade un javascript responsive al home.');
		$this->confirmUninstall=$this->l('¿Estas seguro de desinstalar este modulo?');
		}
	public function install(){
		return parent::install() &&
			   registerHook('top') &&
			   registerHook('header');
			   //registrando en 2 hook()
	}
	public function hookHeadder(){
		$this->context->controller->registerJavascript('modules-responsivehome', 'module/'.$this->name.'/responsivehome.js');
		//Instalar este javascript en el hook;
	}
}
?>