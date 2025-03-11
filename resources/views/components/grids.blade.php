@props([
    'title' => 'Grids',
    'datas' => [],
    'model' => 'book',
])

<div
    class="grid justify-center items-center grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 md:gap-x-8 md:gap-y-16 px-4">
    @foreach ($datas as $data)
        <div>
            <a href="/{{ $model }}/{{ $data->id }}-{{ $data->slug }}">
                <div class="relative hover:scale-110 transition-transform duration-300">
                    @if ($data->getCoverPath())
                        <x-image-skeleton :src="$data->getCoverPath()" :alt="$data->title ?? ($data->name ?? $data->fullname)"
                            class="w-56 md:h-[350px] object-cover rounded-xl" loading="lazy" />
                    @else
                        <x-image-skeleton src="https://placehold.co/200x300?text=No+Image+Available"
                            alt="No Image Available" class="w-full h-full object-cover rounded-xl" />
                    @endif
                </div>
            </a>
        </div>
    @endforeach
</div>
