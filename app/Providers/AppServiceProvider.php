<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use App\Models\Permission;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        \Artisan::call('view:clear');
        \Blade::directive('permission', function ($expression) {
            $condition = false;
            $permission_arr = permissions(trim($expression,"'"));
            $has_key = Permission::whereIn('name', $permission_arr)->count();
            if($has_key){
                $condition = \Auth::user()->hasAnyPermission($permission_arr);
            }
            $condition = $condition == true ? 1 : 0;
            return "<?php if ($condition) { ?>";
        });

        \Blade::directive('endpermission', function () {
            return "<?php } ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            
        });
    }
}
