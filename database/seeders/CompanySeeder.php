<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyData = [
            [
                'nama_company' => 'PT. Cipta Aneka Air',
                'alamat_company' => 'alamat company ',
                'logo_company' => 'logo.jpg',
                'phone_company' => '02123432',
                'fax_company' => '02123432',
                'email_company' => 'email@email.com',
                'npwp_company' => '22319781',
                'website_company' => 'www.website.com',
            ],
            [
                'nama_company' => 'PT. Cipta Aneka Servis',
                'alamat_company' => 'alamat company ',
                'logo_company' => 'logo.jpg',
                'phone_company' => '02123432',
                'fax_company' => '02123432',
                'email_company' => 'email@email.com',
                'npwp_company' => '22319781',
                'website_company' => 'www.website.com',
            ],
            [
                'nama_company' => 'PT. Ragam Adi Catur Esajaya',
                'alamat_company' => 'alamat company ',
                'logo_company' => 'logo.jpg',
                'phone_company' => '02123432',
                'fax_company' => '02123432',
                'email_company' => 'email@email.com',
                'npwp_company' => '22319781',
                'website_company' => 'www.website.com',
            ],
        ];
        Company::insert($companyData);
    }
}
