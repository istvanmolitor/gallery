@php
    use Molitor\Gallery\Models\Gallery;

    $galleryId = $settings['gallery_id'] ?? null;
    $columns = $settings['columns'] ?? 3;
    $showTitle = $settings['show_title'] ?? false;

    $gallery = $galleryId ? Gallery::with('images')->find($galleryId) : null;

    $gridClass = match((int) $columns) {
        1 => 'grid-cols-1',
        2 => 'grid-cols-2',
        4 => 'grid-cols-2 sm:grid-cols-4',
        default => 'grid-cols-2 sm:grid-cols-3',
    };
@endphp

@if($gallery)
    <div class="content-element content-element-gallery mb-6">
        @if($showTitle)
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">{{ $gallery->name }}</h3>
        @endif

        <div class="grid {{ $gridClass }} gap-3">
            @foreach($gallery->images as $image)
                <a href="{{ route('gallery.show', [$gallery->slug, $image->id]) }}"
                   class="block overflow-hidden rounded-lg aspect-square group">
                    <img src="{{ $image->image_url }}"
                         alt="{{ $image->title }}"
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                </a>
            @endforeach
        </div>
    </div>
@endif
