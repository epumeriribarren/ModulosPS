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
		return parent::install();
	}

	public function uninstall() {
		return parent::uninstall();
	}

	public function getContent()
    {
    	$output = null;
    	if (Tools::isSubmit('submit'.$this->name))
        {
        	$output .= $this->crearFeed();
        	$output .= $this->displayConfirmation('Se generó el feed');
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
    	$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $langs = Language::getLanguages();
        $options = array();
        foreach ( $langs as $lang ) {
            $options[] = array(
                'id_lang' => $lang['id_lang'],
                'name' => $lang['name']
            );
        }
        $fields_form = array();
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Crear feed'),
            ),
            'submit' => array(
                'title' => $this->l('Crear'),
                'class' => 'btn btn-default pull-right'
            )
        );
        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.

        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Guardar'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Atras')
            )
        );

        return $helper->generateForm($fields_form);
    }

    public function crearFeed() {
    	$output = '';
    	$products = $this->getProducts((int)Configuration::get('PS_LANG_DEFAULT'));
    	$path = $_SERVER['DOCUMENT_ROOT'] . '/modules/creafeed/feed/feed.xml';
    	$file = fopen($path, "a");
    	if ( $products != false ) {
    		foreach ( $products as $product ) {
    			try {
                    $productObj = new Product($product['id_product']);
                    $params = array(
                    	'g:id' =>	$productObj->reference,
                    	'title' =>	$productObj->name,
                    	'description' =>	$this->htmlToText($productObj->description),
                    	'link' =>	$productObj->getLink();,
                    	'g:image_link' =>	,
                    	'g:condition' =>	$productObj->condition,
                    	'g:additional_image_link' =>	,
                    	'g:product_type' =>	,
                    	'g:google_product_category' =>	,
                    	'g:quantity' =>	,
                    	'g:availability' =>	,
                    	'g:price' =>	,
                    	'g:gtin' =>	,
                    	'g:mpn' =>	,
                    	'g:color' =>	,
                    	'g:shipping' => array(
                    						'g:country' =>	,
                    						'g:price' =>	,
                    					)
                    );
                } catch (Exception $e) {
                	$output .= $e->getMessage();
                }
    		}
    	}
    	return $output
    }

    public function htmlToText($html) {
    	$text = '';
    	$chars = str_split($html);
    	$dentro = false;
    	foreach ( $chars as $char ) {
    		if ( $char == '<' ) {
    			$dentro = true;
    		} else if ( $char == '>' ) {
    			$dentro = false;
    		} else if ( !$dentro ){
    			$text .= $char;
    		}
    	}
    	return $text;
    }

    public function escribirXml($params) {
    	$xml = '<item>'."\n";
    	foreach ($params as $key => $value) {
    		$xml .= '<'.$key.'>'.$value.'</'.$key.'>'."\n";
    	}
    	$xml .= '</item>'."\n";
    	return $xml;
    } 

    public function getProducts($id_lang) {
        $sql = 'SELECT a.`id_product`, 
                       b.`name` AS `name`
                FROM `'._DB_PREFIX_ .'product` a 
                LEFT JOIN `'._DB_PREFIX_.'product_lang` b ON (b.`id_product` = a.`id_product` 
                                                  AND b.`id_lang` =' . $id_lang . '
                                                  AND b.`id_shop` = a.id_shop_default)
                LEFT JOIN `'._DB_PREFIX_ .'stock_available` sav ON (sav.`id_product` = a.`id_product` 
                                                       AND sav.`id_product_attribute` = 0
                                                       AND sav.id_shop = 1  
                                                       AND sav.id_shop_group = 0 )  
                JOIN `'._DB_PREFIX_ .'product_shop` sa ON (a.`id_product` = sa.`id_product` AND sa.id_shop = a.id_shop_default)
                LEFT JOIN `'._DB_PREFIX_ .'category_lang` cl ON (sa.`id_category_default` = cl.`id_category` 
                                                    AND b.`id_lang` = cl.`id_lang` 
                                                    AND cl.id_shop = a.id_shop_default)
                LEFT JOIN `'._DB_PREFIX_ .'shop` shop ON (shop.id_shop = a.id_shop_default)
                LEFT JOIN `'._DB_PREFIX_ .'image_shop` image_shop ON (image_shop.`id_product` = a.`id_product` 
                                                         AND image_shop.`cover` = 1 
                                                         AND image_shop.id_shop = a.id_shop_default)
                LEFT JOIN `'._DB_PREFIX_ .'image` i ON (i.`id_image` = image_shop.`id_image`)
                LEFT JOIN `'._DB_PREFIX_ .'product_download` pd ON (pd.`id_product` = a.`id_product`) 
             WHERE 1
             ORDER BY a.`price` ASC;';
        $result = Db::getInstance()->query($sql);
        if (!$result && $result != '' && !empty($result) && $result != null) {
            return $result->fetchAll();
        } else {
            return $result;
        }
    }
}

?>