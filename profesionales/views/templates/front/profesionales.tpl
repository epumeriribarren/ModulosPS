{extends file='page.tpl'}
{block name='left_column'}
	<div id="left-column" class="col-xs-12 col-sm-4 col-md-3">
		{hook h="displayLeftColumn"}
	</div>
{/block}
{block name='page_title'}
	<h1>Regístrate como profesional</h1>
{/block}
{block name='page_content'}
	<form id="pro" action="/module/profesionales/profesionales?registrar_profesional" method="post">
		<section>
			{foreach $parametros as $parametro}
				<div class="form-group row">
					<label class="col-md-3 form-control-label required">{$parametro.titulo}</label>
					<div class="col-md-6">
						{if $parametro.tipo == 'select'}
							 <select class="form-control" id="{$parametro.id}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}>
													{foreach $parametro.options as $option}
														<option value="{$option}" {if isset($valores)}{if {$valores.{$parametro.name}}=={$option}} selected="selected"{/if}{/if}>{$option}</option>
													{/foreach}
							 </select>{if $parametro.name|in_array:$parametros_mal}<span class="glyphicon glyphicon-exclamation-sign"></span>{/if}
						{elseif $parametro.tipo == 'radio'}
							<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="Si"}checked=""{/if}{else}checked=""{/if} value="Si" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">Si</span>
							<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="No"}checked=""{/if}{/if}value="No" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">No</span>
							{if $parametro.name|in_array:$parametros_mal}<span class="glyphicon glyphicon-exclamation-sign"></span>{/if}
						{else}
							<input class="form-control" type="{$parametro.tipo}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if} {if isset($valores) } value="{$valores.{$parametro.name}}" {/if}/>{if $parametro.name|in_array:$parametros_mal}<span class="glyphicon glyphicon-exclamation-sign"></span>{/if}
						{/if}
					</div>
				</div>
			{/foreach}
		</section>
		<footer class="form-footer clearfix">
		    <input name="submitCreate" value="1" type="hidden">
	        <button class="btn btn-primary form-control-submit float-xs-right" data-link-action="save-customer" type="submit">
	          Guardar
	        </button>
	    </footer>
	</form>
{/block}