{extends file='page.tpl'}
	{block name='page_content_container'}
		<contenido id="izquierda">
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