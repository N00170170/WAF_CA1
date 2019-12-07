<?php

use Illuminate\Database\Seeder;
use App\InsuranceCompany;

class InsuranceCompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insurance_company = new InsuranceCompany();
        $insurance_company->company_name = 'VHI';
        $insurance_company->phone = '0123456789';
        $insurance_company->website = 'https://vhi.ie';
        $insurance_company->save();

        $insurance_company = new InsuranceCompany();
        $insurance_company->company_name = 'Aviva';
        $insurance_company->phone = '0123456789';
        $insurance_company->website = 'https://aviva.ie';
        $insurance_company->save();

    }
}
