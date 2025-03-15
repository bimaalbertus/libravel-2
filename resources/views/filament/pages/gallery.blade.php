<x-filament-panels::page>
    <div x-data="{
        observe() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        @this.loadMore();
                    }
                });
            }, { threshold: 0.1 });
    
            observer.observe($refs.loadMore);
        }
    }" x-init="observe()">
        <div class="columns-3xs space-y-4">
            @foreach ($loadedImages['books'] ?? [] as $image)
                <div class="rounded shadow-md overflow-hidden">
                    <img src="{{ $image->getCoverPath() }}" alt="{{ $image->title }}" class="w-full object-cover">
                </div>
            @endforeach
            @foreach ($loadedImages['authors'] ?? [] as $image)
                <div class="rounded shadow-md overflow-hidden">
                    <img src="{{ $image->getCoverPath() }}" alt="{{ $image->title }}" class="w-full object-cover">
                </div>
            @endforeach

            <div x-ref="loadMore"></div>
        </div>
    </div>
</x-filament-panels::page>
