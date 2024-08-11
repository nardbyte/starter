<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|escape}</title>
    <link rel="stylesheet" href="{$base_url}vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$base_url}public/css/styles.css">
    <link rel="icon" href="{$base_url}public/images/favicon.ico" type="image/x-icon">
    <link href="{$base_url}public/css/prism.css" rel="stylesheet" />
</head>
<body class="d-flex flex-column min-vh-100">
    {include file="partials/nav.tpl"}
    <main role="main" class="container mt-5 mb-5">
        {block name="content"}{/block}
        {include file="partials/sidebar.tpl"}
    </main>
    {include file="partials/footer.tpl"}
    <script src="{$base_url}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{$base_url}public/js/prism.js"></script>
</body>
</html>
