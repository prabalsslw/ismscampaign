<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Session;
use App\Validuser;
use App\PermissionMenu;
use App\SmsPermissionTab;
use App\PermissionBulk;
use App\PermissionAdmin;
use App\PermissionPushpull;


class NavbarProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.master', function($view)
        {
            // $query = Validuser::where('id', session('id'))->first();
            $top = PermissionMenu::where('user_id', session('user_id'))->first();  // Top menu bar
            $top_menue = array_unique(explode(',',$top['permit_menue']));     

            $left_menu_sms = SmsPermissionTab::select('left_menu_id')->where('user_id', session('id'))->groupBy('left_menu_id')->get(); // Left menu bar for SMS
            // echo "<pre>";
            // print_r($left_menu_sms);exit();

            // $left_menu_bulk = PermissionBulk::where('user_id', 'rumana')->first();  // Left menu bar for BULK
            // $left_menu_bulk_arr = array_unique(explode(',',$left_menu_bulk['permit_left_menue']));


            // $left_menu_admin = PermissionAdmin::where('user_id', 'admin')->first();  // Left menu bar for ADMIN
            // $left_menu_admin_arr = array_unique(explode(',',$left_menu_admin['permit_left_menue']));


            // $left_menu_pushpull = PermissionPushpull::where('user_id', 'ferdous ')->first();  // Left menu bar for PUSH PULL
            // $left_menu_pushpull_arr = array_unique(explode(',',$left_menu_admin['permit_left_menue']));


            // $view->with('topbar', $top_menue)->with('leftbarsms', $left_menu_sms)->with('leftbarbulk', $left_menu_bulk_arr)->with('leftbaradmin', $left_menu_admin_arr)->with('leftbarpushpull', $left_menu_pushpull_arr);

            $view->with('topbar', $top_menue)->with('leftbarsms', $left_menu_sms);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
