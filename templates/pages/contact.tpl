{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$title|escape}</h1>

<p>Puedes ponerte en contacto con nosotros a través de este formulario. También puedes realizar solicitudes de modificaciones o mejoras en nuestro repositorio de GitHub: <a href="https://github.com/nardbyte/starter" target="_blank">nardbyte/starter</a>.</p>

{if isset($success)}
<div class="alert alert-success">{$success}</div>
{/if}

{if isset($error)}
<div class="alert alert-danger">{$error}</div>
{/if}

<form method="post" action="{$base_url}contact">
    <div class="mb-3">
        <label for="name" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Mensaje</label>
        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>
{/block}
