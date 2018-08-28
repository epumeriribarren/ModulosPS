{extends file='page.tpl'}
	{block name='page_content_container'}
		<form action="/module/profesionales/profesionales?registrar_profesional" method="post">
			{foreach $parametros as $parametro}
				<campo>
					<titulo>{$parametro.titulo}</titulo>
					{if $parametro.tipo == 'select'}
						 <select id="{$parametro.id}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if} >
												{foreach $parametro.options as $option}
													<option value="{$option}">{$option}</option>
												{/foreach}
						 </select>
					{elseif $parametro.tipo == 'radio'}
						<input name="{$parametro.name}" checked="" value="Si" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">Si</span>
						<input name="{$parametro.name}" value="No" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">No</span>
					{else}
						<input type="{$parametro.tipo}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}/>
					{/if}
				</campo>
			{/foreach}
			<input type="submit" value="Enviar" >
		</form>
	{/block}