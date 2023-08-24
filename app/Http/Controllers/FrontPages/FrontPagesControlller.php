<?php

namespace App\Http\Controllers\FrontPages;

use App\Http\Controllers\Controller;
use App\Http\Utils\AnalisisPengunjung;
use App\Http\Utils\Meta;
use App\Models\BlogNews;
use App\Models\BrandProduk;
use App\Models\CompanyInfo;
use App\Models\KategoriProduk;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Servis;
use App\Models\StaticPages;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class FrontPagesControlller extends Controller
{
    // Home Pages
    public function index()
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $sliders = Slider::get();
        $meta = new Meta($companyInfo[0]->company_name . ' - ' . Meta::$keyWord, 'Perusahaan Water Treatment atau Pengolahan Air Bersih ' . $companyInfo[0]->company_slogan, '/storage/img/company/' . $companyInfo[0]->company_logo);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('index', ['companyInfo' => $companyInfo[0], 'sliders' => $sliders, 'title' => Meta::getTitle()]);
    }

    // Produk and Servis Pages
    public function produkPages()
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone']);
        $sliders = Slider::get();
        $meta = new Meta('Produk' . ' - ' . Meta::$keyWord, 'Produk Pengolahan Air Bersih dan Air Limbah', '/storage/img/company/' . $companyInfo[0]->company_logo);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.produk.produk', ['companyInfo' => $companyInfo[0], 'sliders' => $sliders, 'title' => Meta::getTitle()]);
    }

    // Produk Detail Pages
    public function produkDetailsPages($slugs = null)
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $produk = Produk::where('slugs', $slugs)->with(['kategoriProduk', 'brandProduk', 'imagesProduk'])->first();
        $meta = new Meta($produk->nama_produk, Str::limit($produk->deskripsi_produk, 290, '.'), '/storage/img/produk/' . $produk->imagesProduk[0]->gambar_produk);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.produk.produk-detail', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle(), 'produk' => $produk]);
    }


    // Produk By Ketegori
    public function produkByKategori($slugs)
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $kategoriProduk = KategoriProduk::where('slugs', $slugs)->with(['produk'])->first();
        $meta = new Meta($kategoriProduk->nama_kategori, Str::limit($kategoriProduk->deskripsi_kategori, 250, '.'), '/storage/img/kategori-produk/' . $kategoriProduk->gambar_produk);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.produk.produk-by-kategori', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle(), 'kategoriProduk' => $kategoriProduk]);
    }

    // Produk By Brand
    public function produkByBrand($slugs)
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $brandProduk = BrandProduk::where('slugs', $slugs)->with(['produk'])->first();
        $meta = new Meta($brandProduk->nama_brand, Str::limit($brandProduk->deskripsi_brand, 250, '.'), '/storage/img/brand-produk/' . $brandProduk->gambar_brand);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.produk.produk-by-brand', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle(), 'brandProduk' => $brandProduk]);
    }

    // Servis Pages
    public function servisPages()
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $servis = Servis::get(['judul_servis', 'slug', 'gambar_servis', 'deskripsi_servis']);
        $meta = new Meta('Servis' . ' - ' . Meta::$keyWord, 'Servis dan Layanan Pengolahan Air Bersih dan Air Limbah', '/storage/img/company/' . $companyInfo[0]->company_logo);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.servis.servis', ['companyInfo' => $companyInfo[0], 'servis' => $servis, 'title' => Meta::getTitle()]);
    }

    // Servis Detail Ppages
    public function servisDetailPages($slugs)
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $servis = Servis::where('slug', $slugs)->first();
        $meta = new Meta($servis->judul_servis, Str::limit(strip_tags($servis->deskripsi_servis), 250, '.'), '/storage/img/servis/' . $servis->gambar_servis);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.servis.servis-detail', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle(), 'servis' => $servis]);
    }

    // News Pages
    public function newsPages()
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        // $servis = Servis::get(['judul_servis', 'slug', 'gambar_servis', 'deskripsi_servis']);
        $meta = new Meta('Info Terbaru ' . ' - ' . Meta::$keyWord, 'Info Terbaru Pengolahan Air Bersih dan Air Limbah', '/storage/img/company/' . $companyInfo[0]->company_logo);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.news-info.news', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle()]);
    }

    // news Detail
    public function newssDetailPages($slugs)
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $news = BlogNews::where('slug', $slugs)->first();
        $meta = new Meta($news->title, Str::limit(strip_tags($news->content), 250, '.'), '/storage/img/blog-news/' . $news->image);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.news-info.news-detail', ['companyInfo' => $companyInfo[0], 'title' => Meta::getTitle(), 'news' => $news]);
    }

    // Tentang kami
    public function tentangKamiPages()
    {
        $companyInfo = CompanyInfo::where('id', 1)->get(['company_name', 'company_slogan', 'company_logo', 'company_address', 'company_email', 'company_phone',]);
        $tentangData = StaticPages::find(5);
        $meta = new Meta('Tentang Kami ' . ' - ' . Meta::$keyWord, 'Tentang - ' .  $companyInfo[0]->company_name, '/storage/img/company/' . $companyInfo[0]->company_logo);
        AnalisisPengunjung::recordVisitor($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], url()->current());
        return view('pages.tentang-kami', ['companyInfo' => $companyInfo[0], 'tentangData' => $tentangData,  'title' => Meta::getTitle()]);
    }
}
