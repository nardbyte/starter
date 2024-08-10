<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$title|escape}</title>
    <link rel="stylesheet" href="{$base_url}vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{$base_url}public/css/styles.css">
    <link rel="icon" href="{$base_url}public/images/favicon.ico" type="image/x-icon">
</head>
<body>
<header class="border-bottom">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <img src="{$base_url}public/images/logo.svg" alt="{$sitename|escape}" style="height: 40px;" class="me-lg-3">
      <div class="collapse navbar-collapse justify-content-center justify-content-lg-start" id="menu">
        <ul class="navbar-nav mb-2 mb-lg-0 text-center">
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
        {include file="partials/search_bar.tpl"}
      </div>
    </div>
  </nav>
</header>

<main role="main" class="container mt-5">
    {block name="content"}{/block}
    {include file="partials/sidebar.tpl"}
</main>

<footer class="footer fixed-bottom border-top mt-auto py-3 bg-dark">
    <div class="container text-center">
        <span class="text-white d-block mb-2">
            &copy; {$sitename} {$current_year} v{$version|escape}
        </span>
        <span class="text-white d-block" style="font-size: 0.6em;">
            Page loaded in {$generation_time} sec
        </span>
        <span class="text-white d-block" style="font-size: 0.6em;">
            Memory used: {$usage|escape}
        </span>
    </div>
</footer>

<script src="{$base_url}vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
