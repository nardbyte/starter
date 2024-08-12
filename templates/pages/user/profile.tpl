{extends file="layouts/base.tpl"}

{block name="content"}
<h1>{$title|escape}</h1>
<div class="card my-4">
    <div class="card-body">
        <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{$base_url}profile/update">
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img src="{$base_url}public/images/avatars/{$user.avatar|default:'default_avatar.png'}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                    <div class="button-wrapper">
                        <label for="avatar" class="btn btn-primary me-2 mb-3">
                            <span>Upload new photo</span>
                            <input type="file" id="avatar" class="account-file-input" name="avatar" hidden accept="image/png, image/jpeg, image/gif" />
                        </label>
                    </div>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="first_name" class="form-label">First Name</label>
                        <input class="form-control" type="text" id="first_name" name="first_name" value="{$user.first_name|escape}" required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input class="form-control" type="text" id="last_name" name="last_name" value="{$user.last_name|escape}" required />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input class="form-control" type="text" id="country" name="country" value="{$user.country|escape}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="phone" class="form-label">Phone</label>
                        <input class="form-control" type="text" id="phone" name="phone" value="{$user.phone|escape}" />
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>
{/block}
