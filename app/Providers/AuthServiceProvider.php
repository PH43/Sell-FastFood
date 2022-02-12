<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //category
        Gate::define('category-list', function ($user) {
            return $user->checkUserPermissionAccess('list_category');
        });
        Gate::define('category-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_category');
        });
        Gate::define('category-edit', function ($user) {
            return $user->checkUserPermissionAccess('edit_category');
        });
        Gate::define('category-add', function ($user) {
            return $user->checkUserPermissionAccess('add_category');
        });
        //product
        Gate::define('product-list', function ($user) {
            return $user->checkUserPermissionAccess('list_product');
        });
        Gate::define('product-add', function ($user) {
            return $user->checkUserPermissionAccess('add_product');
        });
        Gate::define('product-edit', function ($user) {
            return $user->checkUserPermissionAccess('edit_product');
        });
        Gate::define('product-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_product');
        });
        //user
        Gate::define('user-list', function ($user) {
            return $user->checkUserPermissionAccess('list_user');
        });
        Gate::define('user-add', function ($user) {
            return $user->checkUserPermissionAccess('add_user');
        });
        Gate::define('user-edit', function ($user) {
            return $user->checkUserPermissionAccess('edit_user');
        });
        Gate::define('user-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_user');
        });
        //role
        Gate::define('role-list', function ($user) {
            return $user->checkUserPermissionAccess('list_role');
        });
        Gate::define('role-add', function ($user) {
            return $user->checkUserPermissionAccess('add_role');
        });
        Gate::define('role-edit', function ($user) {
            return $user->checkUserPermissionAccess('edit_role');
        });
        Gate::define('role-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_role');
        });
        //oder
        Gate::define('order-list', function ($user) {
            return $user->checkUserPermissionAccess('list_order');
        });
        Gate::define('order-confirm', function ($user) {
            return $user->checkUserPermissionAccess('order_browsing');
        });
        Gate::define('order-reject', function ($user) {
            return $user->checkUserPermissionAccess('cancel_order');
        });
        Gate::define('order-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_order');
        });
        //comment
        Gate::define('comment-list', function ($user) {
            return $user->checkUserPermissionAccess('list_comment');
        });
        Gate::define('comment-delete', function ($user) {
            return $user->checkUserPermissionAccess('delete_comment');
        });
    }
}
