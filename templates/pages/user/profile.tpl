{extends file="layouts/base.tpl"}

{block name="content"}
<h1>Profile</h1>
<div class="card my-4">
    <div class="card-body">
        <!-- Mostrar la foto del usuario o la predeterminada si no hay avatar -->
        <div class="text-center mb-4">
            <img src="{$base_url}public/images/avatars/{$user.avatar|default:'default_avatar.png'|escape}" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>
        <form method="post" action="{$base_url}profile/update" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{$user.first_name|escape}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{$user.last_name|escape}" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{$user.country|escape}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{$user.phone|escape}">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="avatar" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="avatar" name="avatar">
                <small class="form-text text-muted">Leave empty if you don't want to change your profile picture.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</div>
{/block}
