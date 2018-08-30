<?php
if(!defined('_PS_VERSION_')){
	exit;
}
class responsive_home extends Module{
	public function __construct(){
		$this->name='responsive_home'; //nombre del módulo el mismo que la carpeta y la clase.
		$this->tab='Design'; // pestaña en la que se encuentra en el backoffice.
		$this->version="0.9.9";//version del modulo
		$this->author='Andre Verdejo';//autor del modulo
		$this->need_instance=0; //si no necesita cargar la clase en la página módulos,1 si fuese necesario.
		$this->ps_versions_compliancy=array('min' => '1.7.x.x', 'max' => _PS_VERSION_); //las versiones con las que el módulo es compatible.
		$this->bootstrap=true; //si usa bootstrap plantilla responsive.
		parent::__construct(); //llamada al constructor padre.
		$this->displayName=$this->l('ResponsiveHome'); // Nombre del módulo
		$this->description=$this->l('Añade un javascript responsive al home.'); //Descripción del módulo
		$this->confirmUninstall=$this->l('¿Estas seguro de desinstalar este modulo?'); //mensaje de alerta al desinstalar el módulo.
	}
		}
	public function install(){
		return parent::install() &&
			   $this->registerHook('top') &&
			   $this->registerHook('header');
			   //registrando en 2 hook()
	}

	public function uninstall() {
		return parent::uninstall() &&
			   $this->unregisterHook('top') &&
			   $this->unregisterHook('header');
	}
	public function hookHeader(){
		$this->context->controller->registerJavascript('modules-responsivehome', 'modules/'.$this->name.'/views/js/responsivehome.js');
		//Instalar este javascript en el hook;
	}
}
?>