<div class="gradient-bg h-screen">
    <div class="flex px-4 md:px-8 py-32">
        <section class="mt-32 md:mt-24 lg:mt-48 flex flex-col items-center justify-center mx-auto">
            <div class="flex flex-col items-center gap-10 space-y-0 text-center">
                <h1
                    class="hidden md:block text-[11rem] text-white font-lovan font-medium leading-[38px] md:leading-[100%] lg:leading-[80px]">
                    {{ __('navigation/navigation.jumbotron.find_some_book') }}
                </h1>
                <h1 class="block md:hidden text-white font-lovan text-9xl">
                    {{ __('navigation/navigation.jumbotron.find_some_book') }}
                </h1>
                <span
                    class="font-geist-sans text-3xl font-semibold text-white">{{ __('navigation/navigation.jumbotron.subtitle_1') }}.</span>
                <x-animated-button href="/auth/login" class="active:scale-90 transition-transform ease-linear capitalize"
                    name="{{ __('navigation/navigation.action.get_started') }}"
                    bgColor="bg-white dark:bg-dark-bg-tertiary" textColor="text-black dark:text-white"
                    fontSize="text-lg"
                    translateValue="{{ app()->getLocale() === 'en' ? 'group-hover:translate-x-28' : 'group-hover:translate-x-[135px]' }}"
                    containerWidth="{{ app()->getLocale() === 'en' ? 'w-40' : 'w-[184px]' }}" containerHeight="h-12"
                    iconBgColor="bg-dark-bg-tertiary dark:bg-light-bg-primary size-12"
                    iconTextColor="text-white dark:text-black" fontWeight="medium" icon="ti-login-2" />
            </div>
        </section>
    </div>
</div>
