@extends('layouts.front')

@section('konten')
    <div class="w-full flex flex-col gap-5 my-20 max-w-screen-lg mx-auto ">
        <div class="flex flex-col gap-5">
            <div class="grid grid-flow-col grid-cols-12 gap-8   ">
                <div class=" flex flex-col col-span-4 gap-2 ">
                    <div class=" h-72  w-full">
                        <img id="produkMainImage" class="h-full w-full object-contain  rounded-xl"
                            src="{{ '/storage/img/static-pages/' . $tentangData->image }}" alt="">
                    </div>
                </div>
                <div class=" col-span-8 flex flex-col text-gray-800 gap-5">
                    <h1 class=" font-semibold text-2xl text-primary-color-mtma ">{{ $tentangData->title }}</h1>
                    <div class=" flex flex-col gap-2">
                        <div>
                            {{ $tentangData->content }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class=" col-span-8 flex flex-col  gap-5">
            <h1 class=" font-semibold text-2xl text-primary-color-mtma ">Hubungi Kami :</h1>
            <div class=" flex-1 flex flex-col flex-2 gap-4  text-sm text-gray-700">
                <div class=" flex flex-col ">
                    <h3 class="font-semibold text-xl">{{ $companyInfo->company_name }}</h3>
                    <span class="text-xs font-semibold"><i>{{ $companyInfo->company_slogan }}</i></span>
                </div>
                <div class="flex flex-col gap-4">
                    <a href=""> <i class="fas fa-map-marker-alt"></i> {{ $companyInfo->company_address }}
                    </a>
                    <a href=""> <i class="fas fa-phone"></i> {{ $companyInfo->company_phone }}
                    </a>
                    <a href=""> <i class="fas fa-envelope"></i> {{ $companyInfo->company_email }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
