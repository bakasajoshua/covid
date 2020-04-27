<?php

use App\CovidKit;
use Illuminate\Database\Seeder;

class CovidConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CovidKit::truncate();
        $kits = [
        		['material_no' => 'manual-1', 'product_description' => 'SARS-COV-2 Extraction Kits',
        		'type' => 'Manual', 'unit' => 'tests'],
        		['material_no' => 'manual-2', 'product_description' => 'SARS-Cov2 Primers and probes- 96 tests',
        		'type' => 'Manual', 'unit' => 'tests'],
        		['material_no' => 'manual-3', 'product_description' => 'AgPath as a kit (Enzyme and buffer)',
        		'type' => 'Manual', 'unit' => 'tests'],
        		['material_no' => 'manual-4', 'product_description' => '10µl Sterile Filtered Pipette tips ',
        		'type' => 'Manual', 'unit' => 'tips'],
        		['material_no' => 'manual-5', 'product_description' => '100µl Sterile Filtered Pipette tips',
        		'type' => 'Manual', 'unit' => 'tips'],
        		['material_no' => 'manual-6', 'product_description' => '200µl Sterile Filtered Pipette tips',
        		'type' => 'Manual', 'unit' => 'tips'],
        		['material_no' => 'manual-7', 'product_description' => '1000µl Sterile Filtered Pipette tips',
        		'type' => 'Manual', 'unit' => 'tips'],
        		['material_no' => 'P1', 'product_description' => 'Swabs and viral transport medium', 'type' => 'Consumable'],
        		['material_no' => 'P2', 'product_description' => 'Extraction kits', 'type' => 'Consumable'],
        		['material_no' => 'P3', 'product_description' => 'Medical  disposable protective clothing', 'type' => 'Consumable'],
        		['material_no' => 'P4', 'product_description' => 'Face Shield', 'type' => 'Consumable'],
        		['material_no' => 'P5', 'product_description' => 'Medical gloves', 'type' => 'Consumable'],
        		['material_no' => 'P6', 'product_description' => 'Surgical Masks', 'type' => 'Consumable'],
        		['material_no' => 'P7', 'product_description' => 'Secondary sample collection (1 box= 1200 tubes)', 'type' => 'Consumable']
        	];
        foreach ($kits as $key => $kit)
        	CovidKit::create($kit);
    }
}








