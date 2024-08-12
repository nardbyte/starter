{extends file="layouts/base.tpl"}

{block name="content"}
<h1>Settings</h1>
<div class="card my-4">
    <div class="card-body">
      <form method="post" action="{$base_url}settings/updatePassword">
          <div class="mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="current_password" name="current_password" required>
          </div>
          <div class="mb-3">
              <label for="new_password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="new_password" name="new_password" required>
          </div>
          <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
          </div>
          <button type="submit" class="btn btn-primary">Update Password</button>
      </form>
    </div>
</div>
{/block}
