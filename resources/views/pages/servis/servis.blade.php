@extends('layouts.front')

@section('konten')
    <div class="w-full ">
        <div class="flex flex-col gap-20  mt-16 mb-20 ">
            {{-- Produk Banner  --}}
            <livewire:servis-banner-pages />
            {{-- End Produk Banner --}}

            {{-- Produk Head --}}
            <div class="grid grid-flow-col grid-cols-2  gap-3 max-w-screen-lg mx-auto">
                @foreach ($servis as $item)
                    <div class=" overflow-hidden  h-96 bg-slate-100 flex flex-col  rounded-lg drop-shadow-lg">
                        <div class=" h-48 w-full overflow-hidden">
                            <img class="w-full h-48 object-cover rounded-tl-lg rounded-tr-lg "
                                src="{{ '/storage/img/servis/' . $item->gambar_servis }}" alt="">
                        </div>
                        <div class="m-3 flex flex-col gap-2 text-gray-700 text-sm">
                            <div class="font-semibold ">
                                <a href="{{ '/servis/' . $item->slug }}">{{ $item->judul_servis }}</a>
                            </div>
                            <div class="">
                                {!! Str::limit($item->deskripsi_servis, 160) !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- End Produk Head --}}

        </div>
    </div>
@endsection
