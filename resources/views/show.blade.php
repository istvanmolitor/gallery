@extends('gallery::layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-4 h-[calc(100vh-80px)] flex flex-col">
        <div class="mb-4 shrink-0 text-center">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $gallery->name }}</h1>
        </div>

        @if($currentImage)
            <div class="relative flex-grow flex items-center justify-center min-h-0 mb-4 group">
                {{-- Lapozó balra --}}
                @if($prevImage)
                    <a href="{{ route('gallery.show', [$gallery->slug, $prevImage->id]) }}"
                       class="absolute left-4 z-20 p-3 rounded-full bg-black/50 text-white hover:bg-black/70 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100"
                       aria-label="Előző kép">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </a>
                @endif

                <div class="w-full h-full flex items-center justify-center overflow-hidden">
                    <img src="{{ $currentImage->image_url }}" alt="{{ $currentImage->title }}"
                         class="max-w-full max-h-full object-contain shadow-2xl rounded-lg block">
                </div>

                {{-- Lapozó jobbra --}}
                @if($nextImage)
                    <a href="{{ route('gallery.show', [$gallery->slug, $nextImage->id]) }}"
                       class="absolute right-4 z-20 p-3 rounded-full bg-black/50 text-white hover:bg-black/70 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100"
                       aria-label="Következő kép">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-8 h-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                @endif
            </div>
        @endif

        <div class="shrink-0 flex justify-center gap-4 mb-2">
            @foreach($thumbnails as $image)
                <a href="{{ route('gallery.show', [$gallery->slug, $image->id]) }}"
                   class="block relative w-24 h-24 rounded-lg overflow-hidden border-4 {{ $currentImage && $currentImage->id === $image->id ? 'border-blue-500 shadow-lg scale-105 z-10' : 'border-transparent hover:border-gray-300 dark:hover:border-gray-600' }} transition-all duration-200">
                    <img src="{{ $image->image_url }}" alt="{{ $image->title }}" class="w-full h-full object-cover">
                </a>
            @endforeach
        </div>
    </div>
@endsection
