{extends file="layouts/base.tpl"}

{block name="content"}
<h1>Login</h1>

{if isset($error)}
<div class="alert alert-danger">{$error}</div>
{/if}

<form method="post" action="{$base_url}login">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
{/block}
