{extends file="layouts/base.tpl"}
{block name="content"}
<div class="d-flex justify-content-center align-items-center" style="height: calc(100vh - 200px);">
    <div class="text-center">
        <h1 class="display-4">Página no encontrada</h1>
        <p class="lead">Lo sentimos, la página que estás buscando no existe.</p>
        <a href="{$url}" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>
</div>
{/block}
