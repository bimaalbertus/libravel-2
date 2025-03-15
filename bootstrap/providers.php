<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\LivewireAuthServiceProvider::class,
    App\Providers\ViewServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    Laravel\Scout\ScoutServiceProvider::class,
];
