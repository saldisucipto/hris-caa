<?php

namespace App\Http\Class;

trait CekTanggal
{
    public static function cek_masa_aktif($tanggal_aktif): bool
    {
        $tanggal_sekarang = date('Y-m-d');
        $hasil = true;
        if ($tanggal_sekarang <= $tanggal_aktif) {
            $hasil = false;
            return $hasil;
        }
        return $hasil;
    }
}
