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
					<div class="col-md-6">
						{if $parametro.tipo == 'select'}
							 <select class="form-control" placeholder="{$parametro.titulo}" id="{$parametro.id}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}>
													{foreach $parametro.options as $option}
														<option value="{$option}" {if isset($valores)}{if {$valores.{$parametro.name}}=={$option}} selected="selected"{/if}{/if}>{$option}</option>
													{/foreach}
							 </select>{if $parametro.name|in_array:$parametros_mal}<i class="fa fa-exclamation-triangle"></i>{/if}
						{elseif $parametro.tipo == 'radio'}
							<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="Si"}checked=""{/if}{else}checked=""{/if} value="Si" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">Si</span>
							<input name="{$parametro.name}" {if isset($valores)}{if {$valores.{$parametro.name}}=="No"}checked=""{/if}{/if}value="No" type="{$parametro.tipo}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if}><span class="radio-text">No</span>
							{if $parametro.name|in_array:$parametros_mal}<i class="fa fa-exclamation-triangle"></i>{/if}
						{elseif $parametro.tipo == 'password'}
						  <div class="input-group js-parent-focus">
						    <input class="form-control js-child-focus js-visible-password" placeholder="{$parametro.titulo}" required="" type="{$parametro.tipo}" name="{$parametro.name}" />
						    <span class="input-group-btn">
						      <button class="btn" type="button" data-action="show-password"><i class="fa fa-eye"></i></button>
						    </span>
						  </div>
						{else}
							<input class="form-control" placeholder="{$parametro.titulo}" type="{$parametro.tipo}" name="{$parametro.name}" {if $parametro.name|in_array:$parametros_mal}class="mal"{/if} {if isset($valores) } value="{$valores.{$parametro.name}}" {/if}/>{if $parametro.name|in_array:$parametros_mal}<i class="fa fa-exclamation-triangle"></i>{/if}
						{/if}
					</div>
				</div>
			{/foreach}
			<div class="form-group row ">
			    <label class="col-md-3 form-control-label">
			    </label>
			    <div class="col-md-6">
			        <span class="custom-checkbox">
			          <input name="newsletter" value="1" type="checkbox">
			          <span><i class="material-icons checkbox-checked"></i></span>
			          <label>Suscribete a nuestro boletín de noticias<br><em>Puede darse de baja en cualquier momento. Para ello, consulte nuestra información de contacto en el aviso legal.</em></label>
			        </span>
			    </div>
			    <div class="col-md-3 form-control-comment">
			    </div>
			</div>
			<div class="form-group row ">
			    <label class="col-md-3 form-control-label required">
			    </label>
			    <div class="col-md-6">
			        <span class="custom-checkbox">
			          <input name="psgdpr" value="1" required="" type="checkbox">
			          <span><i class="material-icons checkbox-checked"></i></span>
			          <label>Estoy de acuerdo con los términos y condiciones y con la política de privacidad.&nbsp; <a href="https://iberianled.com/content/5-condiciones" style="color:#3ed2f0;text-decoration:underline;">Consulte las condiciones de servicio</a>.</label>
			        </span>
			    </div>
			    <div class="col-md-3 form-control-comment">
			    </div>
			</div>
			{if isset($error)}<p>{$error}</p>{/if}
			<button id="crear-cuenta" class="btn btn-primary form-control-submit" type="submit">
	          Crear cuenta
	        </button>
		</section>
	</form>
{/block}