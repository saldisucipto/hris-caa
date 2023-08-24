<div class="mx-auto ">
    <div class="relative">
        <ul id="slider" class="bg-gray-200">
            @foreach ($sliders as $item)
                <li class="h-slider @if (!$loop->first) hidden @endif">
                    <img class=" h-slider w-full object-cover" src="{{ '/storage/img/sliders/' . $item->slider_image }}"
                        alt="{{ $item->slider_title }}" />
                </li>
            @endforeach
        </ul>
        <div class="absolute flex top-0 left-0 h-full w-full">
            <div class="my-auto flex justify-between w-full px-2">
                <button onclick="prev()"
                    class="bg-white py-2 px-3 rounded-full bg-opacity-30 hover:bg-opacity-70 shadow-lg">
                    <i class="fas fa-arrow-left"></i>
                </button>
                <button onclick="next()"
                    class="bg-white py-2 px-3 rounded-full bg-opacity-30 hover:bg-opacity-70 shadow-lg">
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>
