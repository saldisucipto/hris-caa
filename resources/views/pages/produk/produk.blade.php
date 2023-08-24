@extends('layouts.front')

@section('konten')
    <div class="w-full ">
        <div class="flex flex-col gap-20  mt-16 mb-20 ">
            {{-- Produk Banner  --}}
            <livewire:produk-banner-pages />
            {{-- End Produk Banner --}}

            {{-- Produk Head --}}
            @include('components.grid-produk-head')
            {{-- End Produk Head --}}

        </div>
    </div>
@endsection
