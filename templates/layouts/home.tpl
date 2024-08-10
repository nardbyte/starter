{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$sitename|escape}</h1>
<p>{$description|escape}</p>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Información del sitio</h5>
        <p class="card-text">Correo del administrador: {$mail|escape}</p>
    </div>
</div>
{/block}
