<?php
if(!defined('_PS_VERSION_'))
    exit;
class CreaFeed extends Module {
	public function __construct() {
		$this->name = 'creafeed'; //nombre del módulo el mismo que la carpeta y la clase.
	    $this->tab = 'Catalog'; // pestaña en la que se encuentra en el backoffice.
	    $this->version = '1.0.0'; //versión del módulo
	    $this->author ='Epumer: informatico@barcelonaled.com'; // autor del módulo
	    $this->need_instance = 0; //si no necesita cargar la clase en la página módulos,1 si fuese necesario.
	    $this->ps_versions_compliancy = array('min' => '1.6.x.x', 'max' => _PS_VERSION_); //las versiones con las que el módulo es compatible.
	    $this->bootstrap = true; //si usa bootstrap plantilla responsive.

	    parent::__construct(); //llamada al constructor padre.

	    $this->displayName = $this->l('Crear feed'); // Nombre del módulo
	    $this->description = $this->l('Crea un feed para criteo'); //Descripción del módulo
	    $this->confirmUninstall = $this->l('¿Estás seguro de que quieres desinstalar el módulo?'); //mensaje de alerta al desinstalar el módulo.
	}

	public function install() {
		return parent::install()
			   && $this->installTab('AdminCreaFeed', 'Crear feed', 'Catalog');
	}

	public function uninstall() {
		return parent::uninstall()
			   && $this->uninstallTab('AdminCreaFeed');
	}

	public function installTab($class_name,$tab_name,$tab_parent_name=false) {
	    $tab = new Tab();
	    $tab->active = 1;
	    $tab->class_name = $class_name;
	    $tab->name = array();
	    foreach (Language::getLanguages(true) as $lang)
	        $tab->name[$lang['id_lang']] = $tab_name;
	    if($tab_parent_name) {
	        $tab->id_parent = (int)Tab::getIdFromClassName($tab_parent_name);
	    }else {
	        $tab->id_parent = 0;
	    }
	    $tab->module = $this->name;
	    return $tab->add();
	}

	public function uninstallTab($class_name) {
	    $id_tab = (int)Tab::getIdFromClassName($class_name);
	    if ($id_tab){
	        $tab = new Tab($id_tab);
	        return $tab->delete();
	    }
	    else
	        return false;
	}
}

?>