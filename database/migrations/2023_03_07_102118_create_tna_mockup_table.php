<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\TnaMockup;

class CreateTnaMockupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tna_mockup', function (Blueprint $table) {
            $table->id();
            $table->string('organizationName');
            $table->string('facilityName');
            $table->string('facilityUrl');
            $table->string('facilityCountry');
            $table->string('facilityCity');
            $table->string('equipmentType');
            $table->string('equipmentGroup');
            $table->string('equipmentName');
            $table->string('equipmentUrl');
            $table->string('equipmentManufacturer');
            $table->string('tnaStartDate');
            $table->string('tnaEndDate');
            $table->timestamps();
        });
        
        
        TnaMockup::create([
            'organizationName' => '(UU) Universiteit Utrecht',
            'facilityName' => 'EM Centre',
            'facilityUrl' => 'https://www.uu.nl/en/organisation/faculty-of-science/collaboration/research-facilities/electron-microscopy',
            'facilityCountry' => 'NL',
            'facilityCity' => 'Utrecht',
            'equipmentType' => 'Electron Microprobe',
            'equipmentGroup' => 'EPMA (Electron Probe Micro Analyser)',
            'equipmentName' => 'JXA-8530F Hyperprobe (EPMA)',
            'equipmentUrl' => 'https://www.uu.nl/en/organisation/faculty-of-geosciences/collaboration/labs-and-facilities/electron-microscopy',
            'equipmentManufacturer' => 'JEOL',
            'tnaStartDate' => '01-05-2023',
            'tnaEndDate' => '31-10-2023'
        ]);
        
        TnaMockup::create([
            'organizationName' => '(UU) Universiteit Utrecht',
            'facilityName' => 'EM Centre',
            'facilityUrl' => 'https://www.uu.nl/en/organisation/faculty-of-science/collaboration/research-facilities/electron-microscopy',
            'facilityCountry' => 'NL',
            'facilityCity' => 'Utrecht',
            'equipmentType' => 'Electron Microscopy',
            'equipmentGroup' => 'FIB-SEM (Focused Ion Beam - Scanning Electron Microscope)',
            'equipmentName' => 'Helios Nanolab G3 (FIB-SEM)',
            'equipmentUrl' => 'https://www.uu.nl/en/organisation/faculty-of-science/collaboration/research-facilities/electron-microscopy/advanced-electron-microscopes',
            'equipmentManufacturer' => 'ThermoFisher Scientific',
            'tnaStartDate' => '01-05-2023',
            'tnaEndDate' => '31-10-2023'
        ]);
        
        TnaMockup::create([
            'organizationName' => '(INGV) Istituto Nazionale di Geofisica e Vulcanologia',
            'facilityName' => 'INGV-RM1',
            'facilityUrl' => 'https://www.ingv.it/it/monitoraggio-e-infrastrutture-per-la-ricerca/laboratori/laboratorio-hpht/electron-microscopy-laboratory',
            'facilityCountry' => 'Italy',
            'facilityCity' => 'Roma',
            'equipmentType' => 'Electron Microprobe',
            'equipmentGroup' => 'EPMA (Electron Probe Micro Analyser)',
            'equipmentName' => 'JXA-8200 (EPMA)',
            'equipmentUrl' => 'https://www.ingv.it/it/monitoraggio-e-infrastrutture-per-la-ricerca/laboratori/laboratorio-hpht/electron-microprobe-laboratory',
            'equipmentManufacturer' => 'JEOL',
            'tnaStartDate' => '01-05-2023',
            'tnaEndDate' => '31-10-2023'
        ]);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tna_mockup');
    }
}
