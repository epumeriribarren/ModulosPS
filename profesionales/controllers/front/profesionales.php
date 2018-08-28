<?php

class profesionalesprofesionalesModuleFrontController extends ModuleFrontController {
	public function initContent()
	{
		parent::initContent();
		$redirect = true;
		$parametros_mal = array();
		if ( Tools::isSubmit('registrar_profesional')) {
			$parametros = Tools::getAllValues();
			$this->context->smarty->assign('valores', $parametros);
			foreach ($parametros as $key => $value) {
				if (empty($value)) {
					array_push($parametros_mal, $key);
				}
			}

			if ( !ereg("([0-9]{5})", $parametros['cpostal'])){
				array_push($parametros_mal, 'cpostal');
			}
			if ( !ereg("([0-9]{9})", $parametros['telefono'])){
				array_push($parametros_mal, 'telefono');
			}
		}
		$form_fields = array(
			array(
				'titulo' => 'Nombre de la Empresa',
				'tipo'	 => 'text',
				'name'	 => 'nombre'
			),
			array(
				'titulo' => 'CIF/NIF de la empresa',
				'tipo'	 => 'text',
				'name'	 => 'cif'
			),
			array(
				'titulo' => 'Tipo de profesional',
				'tipo'	 => 'select',
				'id'	 => 'tipo-profesional',
				'name'	 => 'tipo',
				'options' => array(
								'',
								'Distribuidor',
								'Instalador',
								'Arquitecto',
								'Decorador',
								'Empresa'
							)
			),
			array(
				'titulo' => '¿Eres autónomo?',
				'tipo'	 => 'radio',
				'name'	 => 'eres_autonomo'
			),
			array(
				'titulo' => '¿Necesitas que se te aplique el recargo de equivalencia?',
				'tipo'	 => 'radio',
				'name'	 => 'surcharge_equivalence'
			),
			array(
				'titulo' => 'Dirección de facturación',
				'tipo'	 => 'text',
				'name'	 => 'dfiscal'
			),
			array(
				'titulo' => 'Provincia',
				'tipo'	 => 'text',
				'name'	 => 'provincia'
			),
			array(
				'titulo' => 'Código postal',
				'tipo'	 => 'text',
				'name'	 => 'cpostal'
			),
			array(
				'titulo' => 'Teléfono',
				'tipo'	 => 'tel',
				'name'	 => 'telefono'
			),
		);
		$this->context->controller->addCSS($_SERVER['DOCUMENT_ROOT'] . '/modules/profesionales/views/css/profesionales.css');
		$this->context->smarty->assign('parametros', $form_fields);
		$this->context->smarty->assign('parametros_mal',$parametros_mal);
		$this->setTemplate('module:profesionales/views/templates/front/profesionales.tpl');
	}

	public function escribirLog($text)
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/profesionales/controllers/front/log.log';
		$file = fopen($path, "a");
		fwrite($file, $text);
		fclose($file);
	}
}
?>