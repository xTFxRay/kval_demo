<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material_prices extends Model
{
    use HasFactory;

    protected $table = 'material_prices';

    protected $fillable = [
        'kustibas_kamera', 
        'radiators',
        'apkures_katls',
        'siltumsuknis',
        'gazes_katls',
        'akmens_vate',
        'stikla_vate',
        'putuplasts',
        'xps',
        'putas',
        'koka_durvis',
        'metala_durvis',
        'ugunsdrosas_durvis',
        'skanu_izolejosas_durvis',
        'aluminija_logs',
        'pvc_logs',
        'koka_logs',
        'dakstini',
        'metala_jumts',
        'siferis',
        'flizes',
        'parkets',
        'laminats',
        'tapetes',
        'krasa',
        'spot_gaismas',
        'led_paneli',
        'koka_divans',
        'koka_galds',
        'koka_skapis',
        'koka_kresls',
        'koka_gulta',
        'auduma_divans',
        'auduma_galds',
        'auduma_skapis',
        'auduma_kresls',
        'auduma_gulta',
        'adas_divans',
        'adas_galds',
        'adas_skapis',
        'adas_kresls',
        'adas_gulta',
        'metala_divans',
        'metala_galds',
        'metala_skapis',
        'metala_kresls',
        'metala_gulta',
        'dumu_detektors',
        'cela_apgaismojums',
        'sienas_gaismeklis',
        'zemes_lampa',
    ];

}
