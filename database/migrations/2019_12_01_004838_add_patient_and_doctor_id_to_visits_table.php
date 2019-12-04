<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientAndDoctorIdToVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('visits', function (Blueprint $table) {
            //Adding patient id and foreign key
            $table->dropColumn('patient');
            $table->bigInteger('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');

            //Adding doctor id and foreign key
            $table->dropColumn('doctor');
            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('visits', function (Blueprint $table) {
            //Undoing everything done in up()
            $table->dropForeign(['patient_id']);
            $table->dropColumn('patient_id');
            $table->dropForeign(['doctor_id']);
            $table->dropColumn('doctor_id');
            $table->string('patient');
            $table->string('doctor');


        });
    }
}
