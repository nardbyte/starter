<main role="main" class="container mt-5">
    <div class="text-center">
        <h1 class="display-4">Página no encontrada</h1>
        <p class="lead">Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-center">Información del sitio</h5>
            <p class="card-text">
                <strong>Sitio:</strong> {$sitename|escape}<br>
                <strong>Descripción:</strong> {$description|escape}<br>
                <strong>Correo del administrador:</strong> {$mail|escape}
            </p>
            <div class="text-center mt-4">
                <a href="{$url}" class="btn btn-primary">Volver al inicio</a>
            </div>
        </div>
    </div>
</main>
