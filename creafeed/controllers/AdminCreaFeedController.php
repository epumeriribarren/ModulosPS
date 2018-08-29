<?php

class AdminCreaFeedController extends ModuleAdminController {
	public function __construct() {
		$this->bootstrap = true;
		$this->lang                = false;
		$this->context             = Context::getContext();
		parent::__construct();
	}

	public function renderForm() {
		$this->fields_form = array(
            'legend' => array(
                'title' => 'Crear feed',
                'icon' => 'icon-home'
            ),
            'submit' => array(
                'title' => 'Crear',
            )
        );
        return parent::renderForm();
	}
}

?>