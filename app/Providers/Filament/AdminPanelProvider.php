<?php

namespace App\Providers\Filament;

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Authenticate as MiddlewareAuthenticate;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

use TomatoPHP\FilamentLanguageSwitcher\FilamentLanguageSwitcherPlugin;
use GeoSot\FilamentEnvEditor\FilamentEnvEditorPlugin;
use Awcodes\LightSwitch\LightSwitchPlugin;
use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
use Filament\Support\Enums\Platform;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Hasnayeen\Themes\ThemesPlugin;
use IbrahimBougaoua\FilaSortable\FilaSortablePlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('libramint')
            ->path('libramint')
            ->databaseNotifications()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchFieldSuffix(fn(): ?string => match (Platform::detect()) {
                Platform::Windows, Platform::Linux => 'CTRL+K',
                Platform::Mac => '⌘K',
                default => null,
            })
            ->colors([
                'primary' => Color::Amber,
            ])
            ->font('Figtree')
            ->viteTheme('resources/css/app.css')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])->plugins([
                FilamentLanguageSwitcherPlugin::make(),
                FilamentEnvEditorPlugin::make()
                    ->navigationGroup('Menu')
                    ->navigationLabel('ENV Editor')
                    ->navigationIcon('heroicon-o-cog-8-tooth')
                    ->navigationSort(1)
                    ->slug('env-editor'),
                // new Lockscreen(),
                LightSwitchPlugin::make(),
                FilaSortablePlugin::make(),
                ThemesPlugin::make(),
                GlobalSearchModalPlugin::make()
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                // LockerTimer::class,
                SetTheme::class,
                AdminMiddleware::class,
                MiddlewareAuthenticate::class
            ])
            ->authMiddleware([
                Authenticate::class,
                // Locker::class,
                SetTheme::class
            ]);
    }
}
