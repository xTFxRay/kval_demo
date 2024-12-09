<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('builds', function (Blueprint $table) {
            $table->id('buildID'); 
            $table->unsignedBigInteger('userID'); 
            $table->string('squareMeters')->nullable();
            $table->string('housePlan')->nullable(); 
            $table->integer('wallWidth')->nullable();  
            $table->string('floor')->nullable();  
            $table->string('wallsType')->nullable();  
            $table->string('wallsFinish')->nullable();  
            $table->string('ceiling')->nullable();  
            $table->string('fasadeType')->nullable();  
            $table->integer('fence')->nullable();  
            $table->string('groundMeasurement')->nullable();  
            $table->string('propertyBorderSetting')->nullable();  
            $table->string('paving')->nullable();  
            $table->string('lawn')->nullable();  
            $table->string('furnitureSet')->nullable(); 
            $table->string('foundationType')->nullable();  
            $table->string('heatingType')->nullable();  
            $table->string('heatingFloor')->nullable();
            $table->string('heatingWalls')->nullable(); 
            $table->string('heatingCeiling')->nullable();  
            $table->string('ventilation')->nullable(); 
            $table->string('airFilter')->nullable(); 
            $table->string('centralFilter')->nullable();
            $table->string('waterFilter')->nullable(); 
            $table->string('spotLights')->nullable();
            $table->string('ledPanels')->nullable(); 
            $table->string('buildProject')->nullable(); 
            $table->string('buildPermission')->nullable(); 
            $table->string('commisioning')->nullable(); 
            $table->string('garage')->nullable(); 
            $table->string('parking')->nullable(); 
            $table->string('gates')->nullable(); 
            $table->string('securitySystem')->nullable(); 
            $table->string('sensors')->nullable();
            $table->string('wallLights')->nullable(); 
            $table->string('roadLights')->nullable(); 
            $table->string('groundLights')->nullable();
            $table->string('windowType')->nullable();
            $table->string('doorType')->nullable();
            $table->string('design')->nullable();
            $table->float('cost')->nullable();
            $table->string('roofType')->nullable();
            
            $table->timestamps(); 
            
           
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('builds');
    }
};
