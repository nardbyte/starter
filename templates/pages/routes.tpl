{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$title|escape}</h1>

<div class="card my-4">
    <div class="card-body">
        <h5 class="card-title">Estructura de Carpetas</h5>
        <p class="card-text">
            El proyecto está organizado en una estructura clara y lógica para facilitar el desarrollo y el mantenimiento. Aquí está un resumen de las principales carpetas y su propósito:
        </p>
        <ul>
            <li><strong>/app</strong> - Contiene los controladores y modelos de la aplicación.</li>
            <li><strong>/controllers</strong> - Aquí se encuentran los controladores que manejan la lógica de la aplicación.</li>
            <li><strong>/models</strong> - Contiene los modelos que interactúan con la base de datos.</li>
            <li><strong>/views</strong> - Puede contener vistas específicas si es necesario, aunque en este proyecto, las plantillas se encuentran en /templates.</li>
            <li><strong>/templates</strong> - Almacena las plantillas Smarty que renderizan el HTML de la aplicación.</li>
            <li><strong>/public</strong> - Contiene archivos accesibles públicamente como CSS, JavaScript, imágenes, y el archivo index.php.</li>
            <li><strong>/inc</strong> - Incluye archivos de configuración y funciones auxiliares.</li>
            <li><strong>/vendor</strong> - Directorio gestionado por Composer que almacena las dependencias del proyecto.</li>
        </ul>

        <h5 class="card-title mt-4">Manejo de Rutas</h5>
        <p class="card-text">
            Las rutas de la aplicación están definidas en el archivo <strong>/inc/routes.php</strong>. Este archivo asocia rutas URL con controladores y métodos específicos. Aquí hay un ejemplo de cómo se define una ruta:
        </p>
        <pre>
            <code class="language-php">
                $routes = [
                    '/' => 'HomeController@index',
                    '/contact' => 'ContactController@index',
                    '/routes' => 'InfoController@index',
                ];
            </code>
        </pre>
        <p class="card-text">
            En este ejemplo, la URL <strong>/routes</strong> se asocia con el método <strong>routes()</strong> del controlador <strong>InfoController</strong>. Cuando un usuario accede a <strong>http://smarty.test/routes</strong>, se ejecuta ese método, que a su vez renderiza la plantilla correspondiente.
        </p>

        <h5 class="card-title mt-4">Plantillas Smarty</h5>
        <p class="card-text">
            Las plantillas Smarty se utilizan para separar la lógica de la aplicación del diseño y presentación. Los archivos de plantillas se encuentran en el directorio <strong>/templates</strong> y se extienden desde una plantilla base para evitar la repetición de código.
        </p>
        <p class="card-text">
            Por ejemplo, en la plantilla <strong>routes.tpl</strong>, se extiende la plantilla base y se define un bloque de contenido específico:
        </p>
        <pre><code class="language-smarty">
        {literal}
        {block name="content"}
        <!-- Contenido específico de la página -->
        {/block}
        {/literal}
        </code></pre>
    </div>
</div>
{/block}
