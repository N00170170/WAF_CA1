<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInsuranceFieldsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropColumn('insurance');
          $table->boolean('hasInsurance')->after('id');
          $table->bigInteger('insurance_company_id')->unsigned()->nullable();
          $table->foreign('insurance_company_id')->references('id')->on('insurance_companies');
          $table->string('policy_number')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
          $table->dropColumn('hasInsurance');
          $table->dropForeign(['insurance_company_id']);
          $table->dropColumn('insurance_company_id');
          $table->dropColumn('policy_number');
          $table->string('insurance');
        });
    }
}
