<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['name' => 'Kustības kamera', 'description' => 'Cena par 1gb', 'price' => 24.99, 'category' => 'Drošība', 'image' => 'images/kustibas_kamera.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Radiators', 'description' => 'Cena par 1gb', 'price' => 153.90, 'category' => 'Apsilde', 'image' => 'images/radiators.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Apkures katls', 'description' => 'Cena par 1gb', 'price' => 1115.20, 'category' => 'Apsilde', 'image' => 'images/apkures_katls.jpg', 'quantity' => 5]);
        Product::create(['name' => 'Siltumsūknis', 'description' => 'Cena par 1gb', 'price' => 5499.99, 'category' => 'Apsilde', 'image' => 'images/siltumsuknis.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Gāzes katls', 'description' => 'Cena par 1gb', 'price' => 1396.26, 'category' => 'Apsilde', 'image' => 'images/gazes_katls.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Akmens vate', 'description' => 'Cena par 1m2', 'price' => 39.99, 'category' => 'Siltinājums', 'image' => 'images/akmens_vate.jpg', 'quantity' => 4]);
        Product::create(['name' => 'Stikla vate', 'description' => 'Cena par 1m2', 'price' => 30.99, 'category' => 'Siltinājums', 'image' => 'images/stikla_vate.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Putuplasts', 'description' => 'Cena par 1m2', 'price' => 58.00, 'category' => 'Siltinājums', 'image' => 'images/putuplasts.jpg', 'quantity' => 5]);
        Product::create(['name' => 'XPS', 'description' => 'Cena par 1m2', 'price' => 39.99, 'category' => 'Siltinājums', 'image' => 'images/xps.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Putas', 'description' => 'Cena par 1m2', 'price' => 9.59, 'category' => 'Siltinājums', 'image' => 'images/putas.jpg', 'quantity' => 3]);
        Product::create(['name' => 'Koka durvis', 'description' => 'Cena par 1gb', 'price' => 157.48, 'category' => 'Durvis', 'image' => 'images/koka_durvis.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Metala durvis', 'description' => 'Cena par 1gb', 'price' => 510.00, 'category' => 'Durvis', 'image' => 'images/metala_durvis.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Ugunsdrošas durvis', 'description' => 'Cena par 1gb', 'price' => 229.90, 'category' => 'Durvis', 'image' => 'images/ugunsdrosas_durvis.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Skaņu Izolējošas durvis', 'description' => 'Cena par 1gb', 'price' => 470.00, 'category' => 'Durvis', 'image' => 'images/skanu_izolejosas_durvis.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Alumīnija logs', 'description' => 'Cena par 1gb', 'price' => 731.00, 'category' => 'Logi', 'image' => 'images/aluminija_logs.jpg', 'quantity' => 5]);
        Product::create(['name' => 'PVC logs', 'description' => 'Cena par 1gb', 'price' => 590.28, 'category' => 'Logi', 'image' => 'images/pvc_logs.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Koka logs', 'description' => 'Cena par 1gb', 'price' => 432.62, 'category' => 'Logi', 'image' => 'images/koka_logs.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Flīzes', 'description' => 'Cena par 1m2', 'price' => 14.99, 'category' => 'Interjers', 'image' => 'images/flizes.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Parkets', 'description' => 'Cena par 1m2', 'price' => 39.99, 'category' => 'Interjers', 'image' => 'images/parkets.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Laminats', 'description' => 'Cena par 1m2', 'price' => 26.49, 'category' => 'Interjers', 'image' => 'images/laminats.jpg', 'quantity' => 4]);
        Product::create(['name' => 'Dakstini', 'description' => 'Cena par 1m2', 'price' => 12.54, 'category' => 'Jumta segums', 'image' => 'images/dakstini.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Metāla jumts', 'description' => 'Cena par 1m2', 'price' => 6.38, 'category' => 'Jumta segums', 'image' => 'images/metāla jumts.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Šīferis', 'description' => 'Cena par 1m2', 'price' => 6.74, 'category' => 'Jumta segums', 'image' => 'images/siferis.jpg', 'quantity' => 5]);
        Product::create(['name' => 'Tapetes', 'description' => 'Cena par 1m2', 'price' => 2.47, 'category' => 'Interjers', 'image' => 'images/tapetes.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Krasa', 'description' => 'Cena 1m2', 'price' => 5.56, 'category' => 'Interjers', 'image' => 'images/krasa.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Spot gaismas', 'description' => 'Cena par 1gb', 'price' => 54.63, 'category' => 'Apgaismojums', 'image' => 'images/spot_gaisma.png', 'quantity' => 3]);
        Product::create(['name' => 'LED paneli', 'description' => 'Cena par 1gb', 'price' => 33.48, 'category' => 'Apgaismojums', 'image' => 'images/led_paneli.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Koka dīvans', 'description' => 'Cena par 1gb', 'price' => 366.00, 'category' => 'Mēbeles', 'image' => 'images/koka_divans.jpg', 'quantity' => 5]);
        Product::create(['name' => 'Koka galds', 'description' => 'Cena par 1gb', 'price' => 368.00, 'category' => 'Mēbeles', 'image' => 'images/koka_galds.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Koka skapis', 'description' => 'Cena par 1gb', 'price' => 593.00, 'category' => 'Mēbeles', 'image' => 'images/koka_skapis.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Koka krēsls', 'description' => 'Cena par 1gb', 'price' => 65.00, 'category' => 'Mēbeles', 'image' => 'images/koka_kresls.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Koka gulta', 'description' => 'Cena par 1gb', 'price' => 443.00, 'category' => 'Mēbeles', 'image' => 'images/koka_gulta.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Auduma gulta', 'description' => 'Cena par 1gb', 'price' => 581.00, 'category' => 'Mēbeles', 'image' => 'images/auduma_gulta.jpg', 'quantity' => 4]);
        Product::create(['name' => 'Auduma galds', 'description' => 'Cena par 1gb', 'price' => 215.00, 'category' => 'Mēbeles', 'image' => 'images/auduma_galds.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Auduma skapis', 'description' => 'Cena par 1gb', 'price' => 440.00, 'category' => 'Mēbeles', 'image' => 'images/auduma_skapis.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Auduma dīvans', 'description' => 'Cena par 1gb', 'price' => 504.00, 'category' => 'Mēbeles', 'image' => 'images/auduma_divans.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Auduma krēsls', 'description' => 'Cena par 1gb', 'price' => 115.00, 'category' => 'Mēbeles', 'image' => 'images/auduma_kresls.jpg', 'quantity' => 9]);
        Product::create(['name' => 'Ādas krēsls', 'description' => 'Cena par 1gb', 'price' => 138.00, 'category' => 'Mēbeles', 'image' => 'images/adas_kresls.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Ādas dīvans', 'description' => 'Cena par 1gb', 'price' => 745.00, 'category' => 'Mēbeles', 'image' => 'images/adas_divans.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Ādas galds', 'description' => 'Cena par 1gb', 'price' => 205.00, 'category' => 'Mēbeles', 'image' => 'images/adas_galds.png', 'quantity' => 8]);
        Product::create(['name' => 'Ādas gulta', 'description' => 'Cena par 1gb', 'price' => 595.00, 'category' => 'Mēbeles', 'image' => 'images/adas_gulta.jpg', 'quantity' => 5]);
        Product::create(['name' => 'Ādas skapis', 'description' => 'Cena par 1gb', 'price' => 447.00, 'category' => 'Mēbeles', 'image' => 'images/adas_skapis.png', 'quantity' => 9]);
        Product::create(['name' => 'Metāla skapis', 'description' => 'Cena par 1gb', 'price' => 791.00, 'category' => 'Mēbeles', 'image' => 'images/metala_skapis.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Metāla dīvans', 'description' => 'Cena par 1gb', 'price' => 777.00, 'category' => 'Mēbeles', 'image' => 'images/metala_divans.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Metāla galds', 'description' => 'Cena par 1gb', 'price' => 231.00, 'category' => 'Mēbeles', 'image' => 'images/metala_galds.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Metāla krēsls', 'description' => 'Cena par 1gb', 'price' => 83.00, 'category' => 'Mēbeles', 'image' => 'images/metala_kresls.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Metāla gulta', 'description' => 'Cena par 1gb', 'price' => 253.00, 'category' => 'Mēbeles', 'image' => 'images/metala_gulta.jpg', 'quantity' => 5]);
        Product::create(['name' => 'Dūmu detektors', 'description' => 'Cena par 1gb', 'price' => 6.49, 'category' => 'Drošība', 'image' => 'images/dumu_detektors.jpg', 'quantity' => 8]);
        Product::create(['name' => 'Sienas gaismeklis', 'description' => 'Cena par 1gb', 'price' => 48.35, 'category' => 'Apgaismojums', 'image' => 'images/sienas_gaismeklis.jpg', 'quantity' => 7]);
        Product::create(['name' => 'Zemes lampa', 'description' => 'Cena par 1gb', 'price' => 18.59, 'category' => 'Apgaismojums', 'image' => 'images/zemes_lampa.jpg', 'quantity' => 6]);
        Product::create(['name' => 'Ceļa apgaismojums', 'description' => 'Cena par 1gb', 'price' => 19.99, 'category' => 'Apgaismojums', 'image' => 'images/cela_apgaismojums.jpg', 'quantity' => 9]);

        
    }
}
