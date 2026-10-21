<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Terapkan hanya pada view yang memiliki sidebar/menu
        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $rawQuery = "
                SELECT DISTINCT
                    a.*,
                    d.dscprm as group_name,
                    d.seqprm,
                    d.valprm1 as icon_name
                FROM m_menu a
                INNER JOIN m_rmenu b ON a.idmnu = b.idmnu
                INNER JOIN m_urole c ON b.idrol = c.idrol
                LEFT JOIN m_param d ON a.grpmnu = d.valprm
                WHERE c.idusr = ?
                AND b.viwrmn = true
                ORDER BY d.seqprm ASC, a.ordmnu ASC
                ";
                $menus = DB::select($rawQuery, [Auth::id()]);
                $groupedMenus = collect($menus)->groupBy('group_name');

                $view->with('dynamicMenus', $groupedMenus);
            }
        });
    }
}
