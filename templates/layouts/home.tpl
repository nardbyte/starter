{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$sitename|escape}</h1>
<p>{$description|escape}</p>

<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Acerca del Proyecto</h5>
        <p class="card-text">
            Este proyecto "Starter" está diseñado para ser un punto de partida sólido para el desarrollo de aplicaciones web utilizando tecnologías modernas y eficientes. Está construido sobre los siguientes lenguajes y herramientas:
        </p>
        <ul>
            <li><strong>Lenguajes de Programación:</strong> PHP, HTML, CSS, JavaScript.</li>
            <li><strong>Motor de Plantillas:</strong> <a href="https://www.smarty.net/" target="_blank">Smarty</a>, que facilita la separación de la lógica y la presentación, permitiendo un desarrollo más organizado y modular.</li>
            <li><strong>Framework CSS:</strong> <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>, para el desarrollo rápido y receptivo de interfaces de usuario atractivas y funcionales.</li>
        </ul>
        <p class="card-text">
            El proyecto utiliza <strong>Composer</strong> para la gestión de dependencias, lo que permite una fácil instalación y actualización de los paquetes necesarios. Los paquetes principales utilizados incluyen:
        </p>
        <ul>
            <li><strong>Smarty:</strong> Un motor de plantillas PHP que permite una fácil separación de la lógica de la aplicación y la capa de presentación.</li>
            <li><strong>Bootstrap:</strong> Una biblioteca CSS que proporciona un conjunto de herramientas para crear sitios web y aplicaciones web responsivas y móviles.</li>
        </ul>
        <p class="card-text">
            La funcionalidad principal de este proyecto es servir como un "starter kit" para nuevos proyectos de desarrollo web. Con una estructura bien organizada, soporte para el motor de plantillas Smarty y la potencia de Bootstrap para el diseño, este proyecto facilita el desarrollo rápido y escalable. Es ideal para desarrolladores que buscan un punto de partida eficiente que les ahorre tiempo y esfuerzo en la configuración inicial, permitiéndoles concentrarse en la lógica y funcionalidad de sus aplicaciones.
        </p>
        <p class="card-text">
            Este proyecto incluye una arquitectura de Modelo-Vista-Controlador (MVC) simple pero efectiva, permitiendo a los desarrolladores estructurar sus aplicaciones de manera lógica y organizada. Además, incorpora ejemplos de buenas prácticas para la gestión de rutas, configuración de entornos y manejo de plantillas, todo listo para ser extendido según las necesidades del proyecto.
        </p>
        <p class="card-text">
            Si tienes alguna pregunta o necesitas soporte, puedes contactar al administrador del sitio en el siguiente correo: <a href="mailto:{$mail|escape}">{$mail|escape}</a>.
        </p>
    </div>
</div>
{/block}
