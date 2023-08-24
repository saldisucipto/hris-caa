<div>
    <div class="phone:hidden tab:hidden">
        <div class="h-20 flex flex-col justify-center bg-white px-7 my-3 mx-4">
            <div class="flex justify-between">
                <div>
                    <a href="/" class="flex justify-start">
                        <img class="max-h-24 py-5 px-2" src="{{ '/storage/img/company/' . $companyInfo->company_logo }}"
                            alt="{{ $companyInfo->company_name }} " />
                        <h1 class="my-auto text-primary-color-mtma font-bold text-1xl">
                            {{ $companyInfo->company_name }}
                        </h1>
                    </a>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="flex justify-between gap-4 text-md">
                        <a href="/produk">
                            <div
                                class=" @if (Route::current()->getName() == 'produk') bg-primary-color-mtma text-white @endif border-primary-color-mtma border-r-2 font-semibold  h-8 flex flex-col justify-center hover:text-white hover:bg-primary-color-mtma">
                                <h1 class="px-3">Produk</h1>
                            </div>
                        </a>
                        <a href="/servis">
                            <div
                                class=" @if (Route::current()->getName() == 'servis') bg-primary-color-mtma text-white @endif border-primary-color-mtma border-r-2 font-semibold  h-8 flex flex-col justify-center hover:text-white hover:bg-primary-color-mtma">
                                <h1 class="px-3">Servis</h1>
                            </div>
                        </a>
                        <a href="/news">
                            <div
                                class="@if (Route::current()->getName() == 'news') bg-primary-color-mtma text-white @endif border-primary-color-mtma border-r-2 font-semibold  h-8 flex flex-col justify-center hover:text-white hover:bg-primary-color-mtma">
                                <h1 class="px-3">News</h1>
                            </div>
                        </a>
                        <a href="tentang-kami">
                            <div
                                class="@if (Route::current()->getName() == 'about') bg-primary-color-mtma text-white @endif border-primary-color-mtma border-r-2 font-semibold  h-8 flex flex-col justify-center hover:text-white hover:bg-primary-color-mtma">
                                <h1 class="px-3">Tentang Kami</h1>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- responsive nav -->
    <div class="tab:bg-primary-color-mtma h-14 hidden tab:flex">
        <div class="mx-2 h-full flex flex-col justify-center w-full py-2">
            <div class="flex justify-between">
                <div class="my-auto">
                    <i class="fas fa-bars fa-2x text-gray-200"></i>
                </div>
                <div class="my-auto text-gray-200 text-lg font-semibold">
                    <h1>COMPANY NAME</h1>
                </div>

                <div>
                    <a href="/" class="flex justify-start">
                        <img class="max-h-10 bg-gray-200 py-2 px-4 rounded-full" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
