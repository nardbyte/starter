{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$title|escape}</h1>
<p>Puedes ponerte en contacto con nosotros a través de este formulario.</p>
<div class="card my-4">
    <div class="card-body">
        {include file="partials/contact_form.tpl"}
        <p class="mt-5">También puedes realizar solicitudes de modificaciones o mejoras en nuestro repositorio de GitHub: <a href="https://github.com/nardbyte/starter" target="_blank">nardbyte/starter</a>.</p>
    </div>
</div>
{/block}
