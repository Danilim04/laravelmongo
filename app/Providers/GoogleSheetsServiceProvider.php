<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Google\Client;
use Google\Service\Sheets;
use App\Services\GoogleSheetsService;

class GoogleSheetsServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(GoogleSheetsService::class, function ($app) {
            $client = new Client();
            $client->setApplicationName('nome da sua aplicação');
            $client->setScopes([Sheets::SPREADSHEETS]);
            $client->setAccessType('offline');
            $client->setAuthConfig(base_path(env('GOOGLE_CREDENTIALS_PATH')));
            $client->setPrompt('select_account consent');
            $spreadsheetId = "17DBBTG49P-7h9xJjwlojxCb6bL02WubbWzRx8AqVeOQ";
            return new GoogleSheetsService ($client,$spreadsheetId);
        });
    }
}
