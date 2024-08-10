<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|escape}</title>
    <link rel="stylesheet" href="{$base_url}vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$base_url}public/css/styles.css">
</head>
<body>
<header class="border-bottom">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <img src="{$base_url}public/images/logo.svg" alt="{$sitename|escape}" style="height: 40px;" class="me-lg-3">
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="{$url}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <!-- Formulario oculto
      {include file="partials/search_bar.tpl"} -->
    </div>
  </div>
</nav>
</header>
