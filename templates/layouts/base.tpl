<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|escape} - {$sitename|escape}</title>
    <link rel="stylesheet" href="{$base_url}vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$base_url}public/css/styles.css">
    <link rel="icon" href="{$base_url}public/images/favicon.ico" type="image/x-icon">
    <link href="{$base_url}public/css/prism.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    {include file="partials/header.tpl"}
    <main role="main" class="container my-3">
        {if isset($success)}
            <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                {$success}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        {/if}
        {if isset($error)}
            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                {$error}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        {/if}
        {block name="content"}{/block}
    </main>
    {include file="partials/footer.tpl"}
    <script src="{$base_url}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{$base_url}public/js/scripts.js"></script>
	<script src="{$base_url}public/js/prism.js"></script>

</body>
</html>
