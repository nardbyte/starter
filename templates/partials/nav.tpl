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
            <a class="nav-link" href="{$base_url}routes">Routes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{$base_url}contact">Contact</a>
          </li>
        </ul>
        {include file="partials/search_bar.tpl"}
      </div>
    </div>
  </nav>
</header>
