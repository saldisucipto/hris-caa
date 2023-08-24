@extends('layouts.front')

@section('konten')
    <div class="w-full ">
        <div class="flex flex-col gap-20  mt-16 max-w-screen-lg  mx-auto ">
            <div class="grid grid-flow-col grid-cols-12 gap-8   ">
                <div class=" flex flex-col col-span-4 gap-2 ">
                    <div class=" h-72  w-full">
                        <img id="produkMainImage" class="h-full w-full object-cover rounded-md"
                            src="{{ '/storage/img/produk/' . $produk->imagesProduk[0]->gambar_produk }}" alt="">
                    </div>
                    @if (count($produk->imagesProduk) > 1)
                        <div class=" h-24 w-full flex gap-2 overflow-x-auto">
                            @foreach ($produk->imagesProduk as $foto)
                                <img id="imagePanel{{ $foto->id }}"
                                    class="h-full w-full object-cover rounded-md cursor-pointer panel"
                                    onclick="changeImage('{{ '/storage/img/produk/' . $foto->gambar_produk }}', '{{ $foto->id }}')"
                                    src="{{ '/storage/img/produk/' . $foto->gambar_produk }}" alt="">
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class=" col-span-8 flex flex-col text-gray-800 gap-5">
                    <div class="text-2xl font-semibold ">
                        <h1>{{ $produk->nama_produk }}</h1>
                    </div>
                    <div class="text-2xl font-semibold ">
                        <h1>{{ App\Http\Utils\Utility::formatRupiah($produk->harga_produk) }}</h1>
                    </div>
                    <div class="text-xs flex gap-5 ">
                        <a href="{{ '/produk/kategori/' . $produk->kategoriProduk->slugs }}" class="flex gap-2">
                            <div class=" h-8 w-8 rounded-full bg-black overflow-hidden">
                                <img class="w-full h-full object-cover "
                                    src="{{ '/storage/img/kategori-produk/' . $produk->kategoriProduk->gambar_produk }}"
                                    alt="">
                            </div>
                            <div class="h-8 flex flex-col justify-center">
                                <h2 class="capitalize text-sm font-semibold">
                                    {{ $produk->kategoriProduk->nama_kategori }}
                                </h2>
                            </div>
                        </a>
                        <a href="{{ '/produk/brand/' . $produk->brandProduk->slugs }}" class="flex gap-2">
                            <div class=" h-8 w-8 rounded-full bg-black overflow-hidden">
                                <img class="w-full h-full object-cover "
                                    src="{{ '/storage/img/brand-produk/' . $produk->brandProduk->gambar_brand }}"
                                    alt="">
                            </div>
                            <div class="h-8 flex flex-col justify-center">
                                <h2 class="capitalize text-sm font-semibold">
                                    {{ $produk->brandProduk->nama_brand }}
                                </h2>
                            </div>
                        </a>
                    </div>
                    <div class=" flex flex-col gap-2">
                        <h3 class="capitalize font-semibold text-primary-color-mtma ">Informasi Detail</h3>
                        <div class="flex gap-1">
                            <span class="text-gray-600 font-semibold">Kondisi :</span>
                            <span class="text-gray-800">{{ $produk->kondisi_produk }}</span>
                        </div>
                        <div class="flex gap-1">
                            <span class="text-gray-600 font-semibold">Satuan :</span>
                            <span class="text-gray-800">{{ $produk->satuan_produk }}</span>
                        </div>
                        <div class="flex gap-1">
                            <span class="text-gray-600 font-semibold">On Stok :</span>
                            <span class="text-gray-800">
                                @if ($produk->on_stok == 1)
                                    ada stok
                                @else
                                    tidak ada stok
                                @endif
                            </span>
                        </div>
                        @if ($produk->on_stok == 1)
                            <div class="flex gap-1">
                                <span class="text-gray-600 font-semibold">Stok :</span>
                                <span class="text-gray-800">
                                    {{ $produk->stok_produk }}
                                </span>
                            </div>
                        @endif

                    </div>
                    <div class=" flex flex-col gap-2">
                        <h3 class="capitalize font-semibold text-primary-color-mtma ">Deskripsi</h3>
                        <div>
                            {{ $produk->deskripsi_produk }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-20  mt-16 mb-20 max-w-screen-lg  mx-auto bg-slate-50 rounded-lg ">
            <div class="m-5 flex flex-col gap-3">
                <div class="leading-4">
                    <h3 class="text-primary-color-mtma font-semibold text-2xl">Tertarik Dengan Produk Kami ?</h3>
                    <span class=" text-xs italic text-gray-700 ">Hubungi kami melalu berbagai media dibawah ini :</span>
                </div>

                <div class="flex gap-2 text-primary-color-mtma ">

                    <a class="hover:text-secondary1-color-mtma"
                        href="{{ 'https://api.whatsapp.com/send?phone=' . $companyInfo->company_phone . '&text=Saya%20mau%20bertanya%20mengenai%20produk%20Berikut:' . $produk->nama_produk . '%20Link%20: %20' . url()->current() }}"
                        target="_blank">
                        <i class="fa fa-whatsapp fa-3x hover:fa-5x" aria-hidden="true"></i></a>

                </div>
            </div>

        </div>
    </div>
@endsection
