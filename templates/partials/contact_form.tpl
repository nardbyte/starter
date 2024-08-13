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

            <!-- Campo oculto para bots (llamado 'website' en lugar de 'honeypot') -->
            <div style="display:none;">
                <label for="website">Si ves este campo, déjalo en blanco</label>
                <input type="text" id="website" name="website" value="">
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
