<div class="flex-1 flex flex-col flex-2 gap-4 text-gray-100">
    <h3 class="font-semibold text-xl">Terhubung Dengan Kami</h3>
    <div class="flex">
        @foreach ($sosmed as $item)
            <div class="h-12 w-12 rounded-full">
                <a target="_blank" href="{{ $item->link }}">
                    <img class=" drop-shadow-lg " src="{{ '/storage/img/sosmed/' . $item->image }}"
                        alt="{{ $item->title }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
