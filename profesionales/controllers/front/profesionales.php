<?php

class profesionalesprofesionalesModuleFrontController extends ModuleFrontController {
	public function initContent()
	{
		parent::initContent();
		$redirect = true;
		$crear_cuenta = true;
		$parametros_mal = array();
		$error = '';
		if ( Tools::isSubmit('registrar_profesional')) {
			$this->escribirLog('Empieza el proceso');
			$parametros = Tools::getAllValues();
			$this->escribirLog(count($parametros));
			foreach ($parametros as $key => $value) {
				if ($key == 'registrar_profesional') {
					continue;
				}
				try {
					if (empty($value)) {
						$this->escribirLog('Campo vacio encontrado: '.$key);
						$redirect = false;
						$crear_cuenta = false;
						array_push($parametros_mal, $key);
					} else {
						$this->escribirLog($key.': '.$value);
					}
				} catch (Exception $e) {
					$this->escribirLog($e->getMessage());
				}
			}

			$this->escribirLog('Vamos a comprobar el telefono');
			if ( !preg_match("([0-9]{9})", $parametros['telefono'])){
				array_push($parametros_mal, 'telefono');
				$crear_cuenta = false;
				$redirect = false;
			}

			$this->escribirLog('Vamos a comprobar si podemos crear la cuenta');
			if ($crear_cuenta) {
				try {
					$this->escribirLog('Vamos a intentar crear la cuenta');
					$resultado = $this->crearCuenta($parametros);
					$this->escribirLog('No hubo error');
				} catch ( Exception $e ) {
					$this->escribirLog('Petó: '.$e->getMessage());
					$resultado = false;
				}
				if (!$resultado) {
					$this->escribirLog('La cuenta no se pudo crear');
					$redirect = false;
					$error = "No se pudo crear la cuenta.";
				}
			}
			$this->context->smarty->assign('valores', $parametros);
			if ($error != '') {
				$this->escribirLog('Hubo errores');
				$this->context->smarty->assign('error', $error);
			}
			if ($redirect) {
				$this->escribirLog('Todo fué dabuten');
				$this->redirectWithNotifications('index.php');
			}
		}
		$form_fields = array(
			array(
				'titulo' => 'Nombre',
				'tipo'	 => 'text',
				'name'	 => 'nombre'
			),
			array(
				'titulo' => 'Apellidos',
				'tipo'	 => 'text',
				'name'	 => 'apellidos'
			),
			array(
				'titulo' => 'Teléfono',
				'tipo'	 => 'tel',
				'name'	 => 'telefono'
			),
			array(
				'titulo' => 'Nombre de la Empresa',
				'tipo'	 => 'text',
				'name'	 => 'nombre_empresa'
			),
			array(
				'titulo' => 'CIF/NIF de la empresa',
				'tipo'	 => 'text',
				'name'	 => 'cif'
			),
			array(
				'titulo' => 'Dirección de correo electrónico',
				'tipo'	 => 'email',
				'name'	 => 'email'
			),
			array(
				'titulo' => 'Contraseña',
				'tipo'	 => 'password',
				'name'	 => 'password'
			),
		);
		$this->context->controller->addCSS($_SERVER['DOCUMENT_ROOT'] . '/modules/profesionales/views/css/profesionales.css');
		$this->context->smarty->assign('parametros', $form_fields);
		$this->context->smarty->assign('parametros_mal',$parametros_mal);
		$this->context->smarty->assign('layout','layouts/layout-left-column.tpl');
		$this->setTemplate('module:profesionales/views/templates/front/profesionales.tpl');
	}

	public function escribirLog($text)
	{
		$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/profesionales/controllers/front/log.log';
		$file = fopen($path, "a");
		fwrite($file, $text."\n");
		fclose($file);
	}

	public function crearCuenta($parametros) 
	{
		$cuenta = new CustomerCore();
		$cuenta->firstname = $parametros['nombre'];
		$cuenta->lastname = $parametros['apellidos'];
		$cuenta->email = $parametros['email'];
		$cuenta->company = $parametros['nombre_empresa'];
		$cuenta->passwd = $parametros['password'];
		$cuenta->id_default_group = 7;
		return $cuenta->add();
	}
}
?>