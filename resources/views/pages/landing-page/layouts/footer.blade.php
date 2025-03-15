@props([
    'title' => '',
    'bgImage' => '/public/assets/cool-bgs/1.webp',
])

<footer
    class="w-full rounded-[3rem] bg-[url('/public/assets/cool-bgs/1.webp')] dark:bg-[url('/public/assets/cool-bgs/trans-1.webp')] bg-cover bg-center dark:bg-bottom dark:bg-dark-bg-primary flex flex-col items-center gap-8 md:py-16">
    @if ($title)
        <h1
            class="text-4xl md:text-8xl mt-32 font-bold font-geist-sans text-light-text-primary dark:text-dark-text-primary">
            {{ $title }}.</h1>
        <x-animated-button href="/auth/login"
            class="active:scale-90 transition-transform ease-linear font-figtree shadow-2xl"
            name="{{ __('navigation/navigation.action.get_started') }}" bgColor="bg-white" textColor="text-black"
            fontSize="text-lg"
            translateValue="{{ app()->getLocale() === 'en' ? 'group-hover:translate-x-28' : 'group-hover:translate-x-[135px]' }}"
            containerWidth="{{ app()->getLocale() === 'en' ? 'w-40' : 'w-[184px]' }}" containerHeight="h-12"
            containerHeight="h-12" iconBgColor="bg-dark-bg-tertiary size-12" iconTextColor="text-white"
            fontWeight="bold" icon="ti-login-2" />
    @endif

    @include('layouts.footer')
</footer>
