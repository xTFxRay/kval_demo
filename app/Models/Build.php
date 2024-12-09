<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Build extends Model
{
    use HasFactory;

    protected $table = 'builds'; 
    protected $primaryKey = 'userID';

    protected $fillable = [
        'userID', 
        'squareMeters', 
        'wallWidth', 
        'floor', 
        'wallsType', 
        'ceiling', 
        'fasadeType', 
        'fence', 
        'groundMeasurement', 
        'propertyBorderSetting', 
        'paving', 
        'lawn', 
        'furnitureSet',
        'foundationType', 
        'heatingType', 
        'heatingFloor',
        'heatingWalls',
        'heatingCeiling',
        'ventilation',
        'airFilter',
        'centralFilter',
        'waterFilter',
        'spotLights',
        'ledPanels',
        'buildProject',
        'buildPermission',
        'commisioning',
        'garage',
        'parking',
        'gates',
        'securitySystem',
        'sensors',
        'wallLights',
        'roadLights',
        'groundLights',
        'doorType',
        'windowType',
        'design',
        'roofType',
        'wallsFinish',
        'housePlan',
        'cost',
    ];
}
