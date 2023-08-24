<div class="flex flex-col gap-2">
    <div class="relative">
        {{-- Nothing in the world is as soft and yielding as water. --}}
        <div class="h-52 w-full  overflow-hidden ">
            <img class=" h-full w-full  object-cover" src="{{ '/storage/img/static-pages/' . $servisPages[0]->image }}"
                alt=" {{ $servisPages[0]->title }}">
        </div>
        <div class="absolute top-0 flex flex-col justify-end h-full w-full text-right">
            <div class="flex flex-col  mx-4 gap-2">
                <h1 class="font-semibold text-white text-5xl "> {{ $servisPages[0]->title }}</h1>
                <h2 class="text-white ">{!! $servisPages[0]->content !!}</h2>
            </div>
        </div>
    </div>
</div>
