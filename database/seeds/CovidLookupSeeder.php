<?php

use Illuminate\Database\Seeder;

class CovidLookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

		DB::statement("DROP TABLE IF EXISTS `quarantine_sites`;");
		DB::statement("
			CREATE TABLE `quarantine_sites` (
				`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(100) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('quarantine_sites')->insert([
			['id' => 1, 'name' => 'Infectious Disease Unit-KNH'],
			['id' => 2, 'name' => 'Kenyatta University'],
			['id' => 3, 'name' => 'Kenya School of Government'],
			['id' => 4, 'name' => 'Boma Hotel'],
			['id' => 5, 'name' => 'KMTC Karen'],
			['id' => 6, 'name' => 'Mandera'],
			['id' => 7, 'name' => "Nairobi Women's"],
			['id' => 8, 'name' => 'LANCET'],
			['id' => 9, 'name' => 'KQ medical centre pride'],
			['id' => 10, 'name' => 'Nairobi hospital'],
			['id' => 11, 'name' => 'Nairobi West'],
			['id' => 12, 'name' => 'Kisii teaching and referral hospital'],
			['id' => 13, 'name' => 'NHPLS'],
			['id' => 14, 'name' => 'Meru TRH'],
			['id' => 15, 'name' => 'MP Shah hospital'],
			['id' => 16, 'name' => 'KEMRI clinic'],
			['id' => 17, 'name' => 'Lenana School'],
			['id' => 18, 'name' => 'Moi Girls Kibra'],
			['id' => 19, 'name' => 'MTRH'],
			['id' => 20, 'name' => 'KMTC'],
			['id' => 21, 'name' => 'Monarch Hotel'],
			['id' => 22, 'name' => 'Trademark Hotel'],
			['id' => 23, 'name' => 'Panari Hotel'],
			['id' => 24, 'name' => 'KEWI'],
			['id' => 25, 'name' => 'Kauwi subcounty hospital'],
			['id' => 26, 'name' => 'Kings Premier Inn'],
			['id' => 27, 'name' => 'Land Mark Suites'],
			['id' => 28, 'name' => 'Nairobi School'],
			['id' => 29, 'name' => 'MASH'],
			['id' => 30, 'name' => '67 Hotel Syokimau'],
			['id' => 31, 'name' => 'Kenya Comfort'],
			['id' => 32, 'name' => 'NIC'],
			['id' => 33, 'name' => "Nairobi Women's, Kitengela"],
			['id' => 34, 'name' => 'Makindu Sub-County Hospital'],
			['id' => 35, 'name' => 'Kambu Sub County Hospital'],
			['id' => 36, 'name' => 'Iten County referal hospital'],
			['id' => 37, 'name' => 'Coptic Hospital'],
			['id' => 38, 'name' => 'Kisii Teaching and Referral hospital'],
			['id' => 39, 'name' => 'Karen - KEMRI'],
			['id' => 40, 'name' => 'EID - KEMRI'],
			['id' => 41, 'name' => 'Mtito Andei Subcounty hospital'],
			['id' => 42, 'name' => 'Kibwezi subcounty hospital'],
			['id' => 43, 'name' => 'Makueni county referral hospital'],
			['id' => 44, 'name' => 'Elgeyo Marakwet'],
			['id' => 45, 'name' => 'Kitui Referral Hospital'],
			['id' => 46, 'name' => 'Kitui Nursing home'],
			['id' => 47, 'name' => 'Longisa County referral hospital'],
			['id' => 48, 'name' => 'Siha Hospital Mpeketoni'],
			['id' => 49, 'name' => 'Tenwek Hospital'],
			['id' => 50, 'name' => 'Migori county referral hospital'],
			// ['id' => , 'name' => ''],
		]);

		return;


		DB::statement("DROP TABLE IF EXISTS `covid_justifications`;");
		DB::statement("
			CREATE TABLE `covid_justifications` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('covid_justifications')->insert([
			['id' => 1, 'name' => 'Contact with confirmed case'],
			['id' => 2, 'name' => 'Presented at health facility'],
			['id' => 3, 'name' => 'Surveillance'],
			['id' => 4, 'name' => 'Point of entry detection'],
			['id' => 5, 'name' => 'Repatriation'],
			['id' => 6, 'name' => 'Other'],
			['id' => 7, 'name' => 'Surveillance and Quarantine'],
		]);


		DB::statement("DROP TABLE IF EXISTS `user_types`;");
		DB::statement("
			CREATE TABLE `user_types` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('user_types')->insert([
			['id' => 1, 'name' => 'Admin'],
			['id' => 2, 'name' => 'National'],
			['id' => 3, 'name' => 'Lab'],
		]);

		DB::statement("DROP TABLE IF EXISTS `age_categories`;");
		DB::statement("
			CREATE TABLE `age_categories` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('age_categories')->insert([
			['id' => 1, 'name' => '0-10'],
			['id' => 2, 'name' => '11-20'],
			['id' => 3, 'name' => '21-30'],
			['id' => 4, 'name' => '31-40'],
			['id' => 5, 'name' => '41-50'],
			['id' => 6, 'name' => '51-60'],
			['id' => 7, 'name' => '61-70'],
			['id' => 8, 'name' => '71-80'],
			['id' => 9, 'name' => '81-90'],
			['id' => 10, 'name' => '91-100'],
		]);

		DB::statement("DROP TABLE IF EXISTS `nationalities`;");
		DB::statement("
			CREATE TABLE `nationalities` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('nationalities')->insert([
			['id' => 1, 'name' => 'Kenyan'],
			['id' => 2, 'name' => 'African'],
			['id' => 3, 'name' => 'European'],
			['id' => 4, 'name' => 'Asian'],
			['id' => 5, 'name' => 'American'],
			['id' => 6, 'name' => 'Other'],
		]);

		DB::statement("DROP TABLE IF EXISTS `identifier_types`;");
		DB::statement("
			CREATE TABLE `identifier_types` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('identifier_types')->insert([
			['id' => 1, 'name' => 'National ID'],
			['id' => 2, 'name' => 'Passport No'],
			['id' => 3, 'name' => 'Foreign ID'],
			['id' => 4, 'name' => 'National ID of parent'],
			['id' => 5, 'name' => 'Passport No of parent'],
			['id' => 6, 'name' => 'Foreign ID of parent'],
			['id' => 7, 'name' => 'Other'],
		]);


		DB::statement("DROP TABLE IF EXISTS `health_statuses`;");
		DB::statement("
			CREATE TABLE `health_statuses` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('health_statuses')->insert([
			['id' => 1, 'name' => 'Stable'],
			['id' => 2, 'name' => 'Severely ill'],
			['id' => 3, 'name' => 'Dead'],
			['id' => 4, 'name' => 'Unknown'],
		]);



		DB::statement("DROP TABLE IF EXISTS `covid_test_types`;");
		DB::statement("
			CREATE TABLE `covid_test_types` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('covid_test_types')->insert([
			['id' => 1, 'name' => 'Initial Test'],
			['id' => 2, 'name' => '1st Follow Up'],
			['id' => 3, 'name' => '2nd Follow Up'],
			['id' => 4, 'name' => '3rd Follow Up'],
			['id' => 5, 'name' => '4th Follow Up'],
			['id' => 6, 'name' => '5th Follow Up'],
		]);



		DB::statement("DROP TABLE IF EXISTS `covid_symptoms`;");
		DB::statement("
			CREATE TABLE `covid_symptoms` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('covid_symptoms')->insert([
			['id' => 1, 'name' => 'Fever / Chills'],
			['id' => 2, 'name' => 'Shortness of Breath'],
			['id' => 3, 'name' => 'Muscular Pain'],

			['id' => 4, 'name' => 'General Weakness'],
			['id' => 5, 'name' => 'Diarrhoea'],
			['id' => 6, 'name' => 'Chest Pain'],

			['id' => 7, 'name' => 'Cough'],
			['id' => 8, 'name' => 'Nausea / vomiting'],
			['id' => 9, 'name' => 'Abdominal Pain'],

			['id' => 10, 'name' => 'Sore Throat'],
			['id' => 11, 'name' => 'Headache'],
			['id' => 12, 'name' => 'Joint Pain'],

			['id' => 13, 'name' => 'Runny Nose'],
			['id' => 14, 'name' => 'Irritability / Confusion'],
			// ['id' => , 'name' => ''],
		]);



		DB::statement("DROP TABLE IF EXISTS `observed_signs`;");
		DB::statement("
			CREATE TABLE `observed_signs` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('observed_signs')->insert([
			['id' => 1, 'name' => 'Pharyngeal exudate'],
			['id' => 2, 'name' => 'Coma'],
			['id' => 3, 'name' => 'Abnormal lung X-Ray findings'],
			['id' => 4, 'name' => 'Conjunctival injection'],
			['id' => 5, 'name' => 'Dyspnea / tachypnea'],
			['id' => 6, 'name' => 'Seizure'],
			['id' => 7, 'name' => 'Abnormal lung auscultation'],
		]);



		DB::statement("DROP TABLE IF EXISTS `underlying_conditions`;");
		DB::statement("
			CREATE TABLE `underlying_conditions` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('underlying_conditions')->insert([
			['id' => 1, 'name' => 'Pregnancy (trimester 1)'],
			['id' => 2, 'name' => 'Pregnancy (trimester 2)'],
			['id' => 3, 'name' => 'Pregnancy (trimester 3)'],
			['id' => 4, 'name' => 'Post-partum (&lt; 6 weeks)'],
			['id' => 5, 'name' => 'Cardiovascular disease, including hypertension'],
			['id' => 6, 'name' => 'Immunodeficiency, including HIV'],
			['id' => 7, 'name' => 'Diabetes'],
			['id' => 8, 'name' => 'Renal disease'],
			['id' => 9, 'name' => 'Liver disease'],
			['id' => 10, 'name' => 'Chronic lung disease'],
			['id' => 11, 'name' => 'Chronic neurological or neuromuscular disease'],
			['id' => 12, 'name' => 'Malignancy'],
			['id' => 13, 'name' => 'Smoking'],
		]);



		DB::statement("DROP TABLE IF EXISTS `covid_isolations`;");
		DB::statement("
			CREATE TABLE `covid_isolations` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('covid_isolations')->insert([
			['id' => 1, 'name' => 'Admitted and Isolation'],
			['id' => 2, 'name' => 'In Patient Ward'],
			['id' => 3, 'name' => 'Self Quarantine'],
			['id' => 4, 'name' => 'ICU - critical condition'],
		]);

		DB::statement("DROP TABLE IF EXISTS `covid_sample_types`;");
		DB::statement("
			CREATE TABLE `covid_sample_types` (
				`id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		DB::table('covid_sample_types')->insert([
			['id' => 1, 'name' => 'Nasopharygneal & Oropharygneal swabs'],
			['id' => 2, 'name' => 'Nasopharygneal swab in UTM'],
			['id' => 3, 'name' => 'Oropharygneal swab in UTM'],
			['id' => 4, 'name' => 'Serum'],
			['id' => 5, 'name' => 'Sputum'],
			['id' => 6, 'name' => 'Tracheal Aspirate'],
			['id' => 7, 'name' => 'Other'],
		]);


		DB::statement("DROP TABLE IF EXISTS `cities`;");
		DB::statement("
			CREATE TABLE `cities` (
				`id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
				`name` varchar(50) DEFAULT NULL,
				`subcountry` varchar(150) DEFAULT NULL,
				`country` varchar(50) DEFAULT NULL,
				`subcounty_id` smallint(5) unsigned DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `name` (`name`),
				KEY `country` (`country`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
		");

		$a = file_get_contents(public_path('world-cities_json.json'));
		$b = json_decode($a);

		foreach ($b as $key => $row) {
			DB::table('cities')->insert([
				['id' => $key+1, 'name' => $row->name, 'subcountry' => $row->subcountry, 'country' => $row->country]
			]);
		}
    }
}
