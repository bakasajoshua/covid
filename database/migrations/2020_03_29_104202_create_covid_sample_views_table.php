<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidSampleViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {        
        DB::statement("
        CREATE OR REPLACE VIEW covid_sample_view AS
        (
          SELECT s.*, p.facility_id, p.quarantine_site_id, p.case_id, p.identifier_type, p.identifier, p.patient_name, p.email_address, p.phone_no, p.occupation, p.justification, p.county, p.subcounty, p.ward, p.residence, p.hospital_admitted, p.dob, p.sex, p.current_health_status, p.date_symptoms, p.date_admission, p.date_isolation, date_death, date_recovered, p.county_id, `f`.`facilitycode`,`f`.`name` as facilityname, qs.name as quarantine_site
          FROM covid_samples s
            JOIN covid_patients p ON p.id=s.patient_id
            LEFT JOIN national_db.facilitys f ON f.id=p.facility_id
            LEFT JOIN quarantine_sites qs ON qs.id=p.quarantine_site_id
        );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
