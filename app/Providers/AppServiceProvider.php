<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        DB::listen(function($query) {
//            $search = array_map(function() {
//                return '?';
//            }, $query->bindings);
//            $query->sql = str_replace($search, $query->bindings, $query->sql);
//            File::append(
//                storage_path('/logs/query.log'),
//                '[' . date('Y-m-d H:i:s') . ']' . PHP_EOL . $query->sql . ' --- In ' . $query->time . 'ms' . PHP_EOL . PHP_EOL
//            );
//        });
    }
}
