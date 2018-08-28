{extends file='page.tpl'}
	{block name='page_content_container'}
		<contenido id="izquierda">
			<p>Si eres distribuidor, instalador, arquitecto, decorador o una empresa con proyectos de iluminación, regístrate como profesional para recibir descuentos exclusivos:</p></br>

		    <p>20% descuento para instaladores y profesionales de la iluminación.</p></br>

		    <p>10% de descuento para empresas</p></br>

			<p>somos importadores directos por lo que podemos ofrecer los precios más competitivos del mercado y el descuento aplica en la web, nuestras tiendas físicas y por vía telefónica.</p></br>

			<p>Tras enviarnos tus datos a través del formulario, deberás hacernos llegar por email el documento acreditativo de alta censal de tu empresa que justifica tu actividad (modelo 036/037) a la dirección <a href="mailto:informacion@iberianled.com" >informacion@iberianled.com</a>.</p></br>

			<p>Nuestro departamento de atención al cliente validará tu cuenta y te aplicará el descuento correspondiente. Si ya estás previamente registrado en nuestra web, se te notificará por email cuando el descuento esté aplicado. Si no estás registrado en nuestra web, nosotros te daremos de alta y aplicaremos el descuento correspondiente, y te notificaremos por email.</p></br>

			<img id="imagenpro" src="https://www.barcelonaled.com/modules/formularios/views/img/professionals.png" alt="Profesionales">
		</contenido>
		<contenido id="derecha">
			<h2>Formulario para profesionales</h2>
			<form id="pro" action="/module/profesionales/profesionales?registrar_profesional" method="post">
				{foreach $parametros as $parametro}
					<campo>
						<titulo>{$parametro.titulo}</titulo>
						<valor>
							{if $parametro.tipo == 'select'}
								 <select id="{$parametro.id}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}>
														{foreach $parametro.options as $option}
															<option value="{$option}" {if isset($valores)}{if {$valores.{$parametro.name}}=={$option}} selected="selected"{/if}{/if}>{$option}</option>
														{/foreach}
								 </select>
							{elseif $parametro.tipo == 'radio'}
								<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="Si"}checked=""{/if}{else}checked=""{/if} value="Si" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">Si</span>
								<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="No"}checked=""{/if}{/if}value="No" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">No</span>
							{else}
								<input type="{$parametro.tipo}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if} {if isset($valores) } value="{$valores.{$parametro.name}}" {/if}/>
							{/if}
						</valor>
					</campo>
				{/foreach}
				<input id="enviar" type="submit" value="Enviar" />
			</form>
		</contenido>
	{/block}