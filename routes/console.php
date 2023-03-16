<?php

use App\Http\Controllers\apiBeeCloudController;
use App\Http\Controllers\reimburseController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('refreshTransaksi',function(){
    $api_bee_cloud_controller = new apiBeeCloudController();
    $api_bee_cloud_controller->refreshTransaksi();
});

Artisan::command('updatePattyCash',function(){
    $reimburseController = new reimburseController();
    $reimburseController->updateAllHistoryOutlet();
});