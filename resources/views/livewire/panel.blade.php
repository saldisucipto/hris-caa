<div class="max-w-screen-lg  mx-auto ">
    <div class=" text-white flex justify-center gap-16 ">
        @foreach ($dataPanel as $item)
            <div class="flex flex-col gap-1">
                <div
                    class="mx-auto h-36 w-36 hover:h-52 bg-slate-400 rounded-full border-4 border-secondary1-color-mtma">
                    <img class="w-full h-full object-cover rounded-full" src="{{ '/storage/img/panel/' . $item->image }}"
                        alt="">
                </div>
                <div class="text-gray-800  w-52 overflow-hidden text-center flex flex-col gap-1 mx-auto">
                    <h1 class="font-semibold">{{ $item->title }}</h1>
                    <p class="font-thin leading-5 text-sm">
                        {{ $item->description }}
                    </p>
                </div>
            </div>
        @endforeach


    </div>
</div>
