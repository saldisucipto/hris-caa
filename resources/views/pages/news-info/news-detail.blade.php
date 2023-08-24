@extends('layouts.front')

@section('konten')
    <div class="w-full ">
        <div class="flex flex-col gap-20 mb-20  mt-16 max-w-screen-lg  mx-auto ">
            <div class=" flex flex-col  gap-6 ">
                <div class=" h-80 mx-auto  w-full">
                    <img id="produkMainImage" class="h-full w-full object-cover rounded-md"
                        src="{{ '/storage/img/blog-news/' . $news->image }}" alt="">

                </div>

                <div class=" flex flex-col gap-2 my-20">
                    <div class="text-2xl font-semibold leading-4 ">
                        <h1>{{ $news->title }}</h1>
                        <span class="text-xs"> {{ \Carbon\Carbon::parse($news->created_at)->diffForhumans() }} | Oleh :
                            Admin</span>
                    </div>
                    <h3 class="capitalize font-semibold text-primary-color-mtma ">Deskripsi</h3>
                    <div>
                        {{ strip_tags($news->content) }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
