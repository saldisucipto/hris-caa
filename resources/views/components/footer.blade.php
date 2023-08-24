<div class="h-80 bg-secondary1-color-mtma w-full relative ">
    <div class="max-w-screen-lg mx-auto flex flex-col justify-between  h-full  ">
        <div class="my-7 flex mx-auto gap-8 justify-between">
            {{-- Navigasi --}}
            <div class=" flex-1 flex flex-col flex-2 gap-4 text-gray-200">
                <h3 class="font-semibold text-xl">Navigasi</h3>
                <div class="flex flex-col gap-1">
                    <a class=" hover:text-gray-300 hover:font-bold " href="#">Home</a>
                    <a class=" hover:text-gray-300 hover:font-bold " href="#">Produk & Servis</a>
                    <a class=" hover:text-gray-300 hover:font-bold " href="#">Tentang</a>
                    <a class=" hover:text-gray-300 hover:font-bold " href="#">Hubungi Kami</a>
                    <a class=" hover:text-gray-300 hover:font-bold " href="#">Blogs & News</a>
                </div>
            </div>
            {{-- End Navigasi --}}
            {{-- Customer Session Showcahse --}}
            <livewire:sosial-media-showcase />
            {{-- End Customer Session Showcase --}}
            {{-- About --}}
            <div class=" flex-1 flex flex-col flex-2 gap-4 text-gray-200 text-sm">
                <div class=" flex flex-col ">
                    <h3 class="font-semibold text-xl">{{ $companyInfo->company_name }}</h3>
                    <span class="text-xs font-semibold"><i>{{ $companyInfo->company_slogan }}</i></span>
                </div>
                <div class="flex flex-col gap-1">
                    <a href=""> <i class="fas fa-map-marker-alt"></i> {{ $companyInfo->company_address }}
                    </a>
                    <a href=""> <i class="fas fa-phone"></i> {{ $companyInfo->company_phone }}
                    </a>
                    <a href=""> <i class="fas fa-envelope"></i> {{ $companyInfo->company_email }}
                    </a>
                </div>
            </div>
            {{-- End About --}}
        </div>
        <hr>
        <div class="text-center text-gray-100 text-xs my-3">
            <i class="far fa-copyright"></i> Copyright {{ date('Y') }} {{ $companyInfo->company_name }}
        </div>

    </div>
    <div class="absolute top-0">
        <div class="h-80 w-80 overflow-hidden">
            <img class="object-cover -rotate-90 opacity-40 h-full w-full " src="/assets/img/patern.png">
        </div>
    </div>
</div>
