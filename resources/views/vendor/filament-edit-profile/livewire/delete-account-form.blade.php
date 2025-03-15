@php
    $isAdmin = Auth::user()->isAdmin();
    $adminCount = \App\Models\User::where('is_admin', true)->count();
@endphp

@if ($isAdmin && $adminCount >= 1)
    <div>
        <x-filament-panels::form>
            {{ $this->form }}
        </x-filament-panels::form>

        <x-filament-actions::modals />
    </div>
@endif
