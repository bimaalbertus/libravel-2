@extends('layouts/app')

@section('content')
    <div x-data>
        <img src="/gradients/docs-left.png"
            class="block fixed -left-32 w-[65rem] opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none rounded-large -z-10"
            alt="docs left background" data-loaded="true" x-on:contextmenu.prevent />
        <img src="/gradients/docs-right.png"
            class="block fixed -right-96 -top-72 w-[75rem] rotate-180 opacity-0 shadow-[#0a0a0a]/5 blur-md data-[loaded=true]:opacity-100 shadow-none rounded-large -z-10"
            alt="docs right background" data-loaded="true" x-on:contextmenu.prevent />
    </div>

    <div class="h-screen">
        <div class="flex px-4 md:px-8 py-0">
            <section class="flex flex-col items-center justify-center mx-auto">
                <div class="flex flex-col items-center space-y-0 text-center">
                    <h1
                        class="text-[6rem] font-medium text-light-btn-primary font-jersey-15 leading-[38px] md:leading-[100%] lg:leading-[80px]">
                        How Modern School</h1>
                    <h1 class="text-[4rem] font-medium leading-[38px] md:leading-[100%] lg:leading-[80px]">Organize their
                        Library</h1>
                </div>
            </section>
        </div>
    </div>
@endsection
