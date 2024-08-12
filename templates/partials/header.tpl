<header class="border-bottom">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3">
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

      <div class="d-flex align-items-center ms-auto">
        {if $is_logged_in}
          <!-- Si el usuario está conectado, mostrar el nombre y el dropdown -->
          <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="{$base_url}public/images/avatars/{$user_avatar}" alt="{$username|escape}" class="rounded-circle" width="40" height="40">
              <div class="ms-2">
                <span>{$username|escape}</span>
                <span class="d-block text-white-50" style="font-size: 0.8em;">{$user_role|escape}</span>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
              <li><a class="dropdown-item" href="{$base_url}profile">Profile</a></li>
              <li><a class="dropdown-item" href="{$base_url}settings">Settings</a></li>
             {if $user_role == 'Administrador'}
              <li><a class="dropdown-item" href="{$base_url}admin">Admin</a></li>
             {/if}
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{$base_url}logout">Logout</a></li>
            </ul>
          </div>
        {else}
          <!-- Si el usuario no está conectado, mostrar los botones de inicio de sesión y registro -->
          <a href="{$base_url}login" class="btn btn-outline-light me-2">
            <i class="bi bi-box-arrow-in-right"></i> Login
          </a>
          <a href="{$base_url}register" class="btn btn-outline-light">
            <i class="bi bi-person-plus"></i> Register
          </a>
        {/if}
      </div>
    </div>
  </nav>
</header>
