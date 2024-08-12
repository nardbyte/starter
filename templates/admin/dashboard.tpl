{extends file="layouts/base.tpl"}

{block name="content"}
<div class="container-fluid mt-5">
    <div class="row">
        {include file="admin/partials/sidebar.tpl"}
        <!-- Main Content -->
        <div class="col-md-9 col-lg-10">
            <h1 class="mb-4">Dashboard</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Welcome, {$username|escape}</h5>
                    <p class="card-text">This is the administration panel where you can manage the website.</p>
                    <p class="card-text">Role: <span class="text-success">{$user_role|escape}</span></p>
                    <p class="card-text">Use the navigation menu to access different sections of the admin panel.</p>
                </div>
            </div>
        </div>
    </div>
</div>
{/block}
