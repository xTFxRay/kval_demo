<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Material_prices;


class ScrapperController extends Controller
{

    private function standardizePrice($price)
    {
        $price = preg_replace('/[^\d,\.]/', '', $price);

        $price = str_replace(',', '.', $price);


        return number_format((float) $price, 2, '.', '');
    }
    public function scrapper(Request $request)
    {
        $kustibas_kamera = "https://euroled.lv/lv/privatais-apgaismojums/iekstelpu-apgaismojums/kustibas-sensori-2508/infrasarkanais-klatbutnes-sensors-360-20m-2000w1";
        $radiators = "https://www.ksenukai.lv/p/konvekcijas-radiators-mill-mb800l-dn-800-w/5z2z?cat=22n&index=21";
        $apkures_katls = "https://teplodar.eu/lv/malkas-apkures-katli/2001-cuguna-apkures-katls-solitech-14kw.html";
        $siltumsuknis = "https://citasantehnika.lv/lv/siltums%C5%ABknis-ariston-nimbus-compact-50-s-net-r32-gaiss-%C5%ABdens-ar-integr%C4%93tu-%C5%ABdens-sild%C4%ABt%C4%81ju-ar-wi-fi-7-57-kw";
        $gazes_katls = "https://www.sbsiltumtehnika.lv/lv/precu-katalogs/-1708618";
        $akmens_vate = "https://www.ksenukai.lv/p/akmensvate-paroc-ultra-122-cm-x-61-cm-x-5-cm/e5pc?mtd=search&pos=regular&src=searchnode";
        $stikla_vate = "https://www.ksenukai.lv/p/stikla-vate-knauf-ekoboard-125-cm-x-60-cm-x-5-cm/b88v?mtd=search&pos=regular&src=searchnode";
        $putuplasts = "https://www.ksenukai.lv/p/putuplasts-tenax-eps-150-120-cm-x-60-cm-x-10-cm/hjwl?mtd=search&pos=regular&src=searchnode";
        $xps = "https://www.ksenukai.lv/p/putuplasts-finnfoam-fl-300-xx-123-5-cm-x-58-5-cm-x-5-cm/dr33?mtd=search&pos=regular&src=searchnode";
        $putas = "https://www.ksenukai.lv/p/siltumizolacijas-un-skanas-izolacijas-putas-polynor-pro-pistole-750-ml/euc4?mtd=search&pos=regular&src=searchnode";
        $koka_durvis = "https://www.ksenukai.lv/p/ieksdurvju-vertne-porta-verte-home-g4-verte-home-g4-kreisais-sibirijas-ozols-203-x-84-4-x-4-cm/egop?mtd=search&pos=regular&src=searchnode";
        $metala_durvis = "https://miolans.lv/metala-durvis/durvis-ar-d-1-mdf-900h2070mm-dzivoklim-lv";
        $ugunsdrosas_durvis = "https://www.latakva.com/lv/buvtehniska-ugunsaizsardziba/item/135/1352?_gl=1*1h11xzs*_up*MQ..&gclid=Cj0KCQjw99e4BhDiARIsAISE7P-WI7h29fgU2-z2dWPIkLL-oHdO7w-CcxECaOOGDsPt5CjFSkrUJrkaAkTXEALw_wcB";
        $skanu_izolejosas_durvis = "https://fores.lv/specialas_durvis/skanu_izolejosas_durvis_sound_41db_swedoor";
        $pvc_logs = "https://www.eurologi.lv/lv/izpardosana";
        $aluminija_logs = "https://jumta-logi.lv/product/aluminija-jumta-logi-suproalu-55x98cm/";
        $koka_logs = "http://www.geleos.lv/lat/Serviss/Cenu-katalogs/Logu-Cenas/Koka-logi";
        $flizes = "https://www.ksenukai.lv/p/flizes-akmens-0764460074901-60-cm-x-60-cm-balta/lw4h?mtd=search&pos=regular&src=searchnode";
        $parkets = "https://www.ksenukai.lv/p/parketa-deli-barlinek-5906737957325-priede-ozols-1800-mm-x-180-mm-x-14-mm/sd2v?cat=1s3&index=1";
        $laminats = "https://www.ksenukai.lv/p/laminats-ar-paaugstinatu-mitruma-izturibu-berry-alloc-jazz-xl-light-grey-12-mm-33/wkon?mtd=search&pos=regular&src=searchnode";
        $krasa = "https://www.ksenukai.lv/p/sienu-krasa-vivacolor-green-line-wall-4-balta-18-l/dxbn?mtd=search&pos=regular&src=searchnode";
        $tapetes = "https://www.ksenukai.lv/p/krasojamas-tapetes-st-t3011-fiberstikla-balta/3dvg?mtd=search&pos=regular&src=searchnode";
        $dekorativie_paneli = "https://www.ksenukai.lv/p/dekorativais-tekstila-sienas-panelis-mollis-basic-grey-60-cm-x-30-cm-x-3-7-cm/kcel?mtd=search&pos=regular&src=searchnode";
        $dakstini = "https://www.buvserviss.lv/buvmateriali/jumta-segumi/betona-dakstini/benders-palema-candor-dakstins?prod=38487";
        $bezasbesta_loksnes = "https://prof.lv/eternklasl-eternit-agro-l-bezazbesta-siferis-1750x1130mm-nekrasots?krasa=104947";
        $metala_jumts = "https://plastikati.lv/lv/produkti/metala-segums-t14r-trapecveida--0-37mm-pm-ral7016-peleks";
        $spot_gaismas = "https://www.kursi.lv/lv/elektromateriali/apgaismojums/griestu-lampas/spot-lampas/gaismeklis-gtv-karis-led-18w-1800lm-3cct-3000-4000-6400k-d170mm-balts";
        $led_paneli = "https://www.kursi.lv/lv/gaismeklis-tope-lighting-led-sopot-36w-480-mm-ar-pulti-6004000075";
        $koka_kresls = "https://www.mebeles1.lv/kresli/kresls-victorville-367-alksnis.html";
        $koka_galds = "https://www.mebeles1.lv/galdi/galds-berwyn-2168.html";
        $koka_skapis = "https://www.mebeles1.lv/skapji/skapis-denton-240.html";
        $koka_divans = "https://www.mebeles1.lv/mikstas-mebeles/divangultas/divans-gulta-comfivo-360.html";
        $koka_gulta = "https://www.mebeles1.lv/gultas/gulta-houston-459.html";
        $adas_kresls = "https://www.mebeles1.lv/kresli/kresls-springfield-127-bruns-melns.html";
        $adas_galds = "https://www.mebeles1.lv/galdi/galds-stanton-147-balts-melns.html";
        $adas_skapis = "https://www.mebeles1.lv/skapji/skapis-atlanta-199-kasmirs-zelta.html";
        $adas_divans = "https://www.mebeles1.lv/mebelu-kolekcijas/mebelu-kolekcija-scandinavian-choice-b/divans-scandinavian-choice-b109-madryt-melns.html";
        $adas_gulta = "https://www.mebeles1.lv/gulamistabas-mebeles/kontinentalas-gultas/kontinentala-gulta-yr5-lv-15.html";
        $auduma_kresls = "https://www.mebeles1.lv/kresli/kresls-houston-1583.html";
        $auduma_galds = "https://www.mebeles1.lv/galdi/galds-boston-476-artisan-ozols-melns.html";
        $auduma_skapis = "https://www.mebeles1.lv/mebelu-kolekcijas/mebelu-kolekcija-honolulu-a/skapis-honolulu-a103.html";
        $auduma_divans = "https://www.mebeles1.lv/mikstas-mebeles/stura-divani/stura-divans-rome-100-lawa-06-lawa-05.html";
        $auduma_gulta = "https://www.mebeles1.lv/gultas/gulta-tj30-lv-10.html";
        $metala_kresls = "https://www.mebeles1.lv/kresli/kresls-charleston-184-melns.html";
        $metala_galds = "https://www.mebeles1.lv/galdi/galds-houston-1531.html";
        $metala_skapis = "https://www.mebeles1.lv/skapji/skapis-fresno-145.html";
        $metala_divans = "https://www.mebeles1.lv/mikstas-mebeles/stura-divani/stura-divans-comfivo-121-kronos-07.html";
        $metala_gulta = "https://www.mebeles1.lv/gultas/gulta-elmira-100-melns.html";
        $dumu_detektors = "https://www.estalert.lv/lv/a/estalert-dumu-detektors";
        $sienas_gaismeklis = "https://balticled.lv/ara-apgaismojums/ara-sienas-un-fasades-gaismekli/wall-lamp-maytoni-o581wl-l6b.html";
        $zemes_lampa = "https://cenuklubs.lv/ara-lampa-croto-l-1-7w-6500k-v-a-ip65-025717.html";
        $cela_apgaismojums = "https://cenuklubs.lv/ieb-l-moro-dl-35-ip67-230v-025093.html";

        $html = file_get_contents($sienas_gaismeklis);
        $crawler = new Crawler($html);
        $sienas_gaismeklis = $this->standardizePrice($crawler->filter('.oct-price-normal')->first()->text());
   
        $html = file_get_contents($zemes_lampa);
        $crawler = new Crawler($html);
        $zemes_lampa = $this->standardizePrice($crawler->filter('.price')->first()->text());

        $html = file_get_contents($cela_apgaismojums);
        $crawler = new Crawler($html);
        $cela_apgaismojums = $this->standardizePrice($crawler->filter('.price')->first()->text());

        $html = file_get_contents($dumu_detektors);
        $crawler = new Crawler($html);
        $dumu_detektors = $this->standardizePrice($crawler->filter('.price-tag')->first()->text());

        $html = file_get_contents($metala_skapis);
        $crawler = new Crawler($html);
        $metala_skapis = $this->standardizePrice($crawler->filter('#sec_discounted_price_549135')->first()->text());

        $html = file_get_contents($metala_kresls);
        $crawler = new Crawler($html);
        $metala_kresls = $this->standardizePrice($crawler->filter('#sec_discounted_price_209717')->first()->text());

        $html = file_get_contents($metala_gulta);
        $crawler = new Crawler($html);
        $metala_gulta = $this->standardizePrice($crawler->filter('#sec_discounted_price_447373')->first()->text());

        $html = file_get_contents($metala_galds);
        $crawler = new Crawler($html);
        $metala_galds = $this->standardizePrice($crawler->filter('#sec_discounted_price_503082')->first()->text());

        $html = file_get_contents($metala_divans);
        $crawler = new Crawler($html);
        $metala_divans = $this->standardizePrice($crawler->filter('#sec_discounted_price_447732')->first()->text());

        $html = file_get_contents($auduma_skapis);
        $crawler = new Crawler($html);
        $auduma_skapis = $this->standardizePrice($crawler->filter('#sec_discounted_price_253785')->first()->text());

        $html = file_get_contents($auduma_kresls);
        $crawler = new Crawler($html);
        $auduma_kresls = $this->standardizePrice($crawler->filter('#sec_discounted_price_525053')->first()->text());

        $html = file_get_contents($auduma_gulta);
        $crawler = new Crawler($html);
        $auduma_gulta = $this->standardizePrice($crawler->filter('#sec_discounted_price_206754')->first()->text());

        $html = file_get_contents($auduma_galds);
        $crawler = new Crawler($html);
        $auduma_galds = $this->standardizePrice($crawler->filter('#sec_discounted_price_510463')->first()->text());

        $html = file_get_contents($auduma_divans);
        $crawler = new Crawler($html);
        $auduma_divans = $this->standardizePrice($crawler->filter('#sec_discounted_price_202178')->first()->text());

        $html = file_get_contents($adas_galds);
        $crawler = new Crawler($html);
        $adas_galds = $this->standardizePrice($crawler->filter('#sec_discounted_price_554640')->first()->text());

        $html = file_get_contents($adas_gulta);
        $crawler = new Crawler($html);
        $adas_gulta = $this->standardizePrice($crawler->filter('#sec_discounted_price_187566')->first()->text());

        $html = file_get_contents($adas_skapis);
        $crawler = new Crawler($html);
        $adas_skapis = $this->standardizePrice($crawler->filter('#sec_discounted_price_555492')->first()->text());

        $html = file_get_contents($adas_kresls);
        $crawler = new Crawler($html);
        $adas_kresls = $this->standardizePrice($crawler->filter('#sec_discounted_price_261318')->first()->text());

        $html = file_get_contents($adas_divans);
        $crawler = new Crawler($html);
        $adas_divans = $this->standardizePrice($crawler->filter('#sec_discounted_price_78568')->first()->text());

        $html = file_get_contents($koka_divans);
        $crawler = new Crawler($html);
        $koka_divans = $this->standardizePrice($crawler->filter('#sec_discounted_price_542658')->first()->text());

        $html = file_get_contents($koka_kresls);
        $crawler = new Crawler($html);
        $koka_kresls = $this->standardizePrice($crawler->filter('#sec_discounted_price_552724')->first()->text());

        $html = file_get_contents($koka_gulta);
        $crawler = new Crawler($html);
        $koka_gulta = $this->standardizePrice($crawler->filter('#sec_discounted_price_111728')->first()->text());

        $html = file_get_contents($koka_galds);
        $crawler = new Crawler($html);
        $koka_galds = $this->standardizePrice($crawler->filter('#sec_discounted_price_552460')->first()->text());

        $html = file_get_contents($koka_skapis);
        $crawler = new Crawler($html);
        $koka_skapis = $this->standardizePrice($crawler->filter('#sec_discounted_price_440202')->first()->text());

        $html = file_get_contents($kustibas_kamera);
        $crawler = new Crawler($html);
        $kustibas_kamera = $this->standardizePrice($crawler->filter('.card__pice-sale span')->first()->text());

        $html = file_get_contents($radiators);
        $crawler = new Crawler($html);
        $radiators = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($apkures_katls);
        $crawler = new Crawler($html);
        $apkures_katls = $this->standardizePrice($crawler->filter('span[itemprop="price"]')->first()->text());

        $html = file_get_contents($siltumsuknis);
        $crawler = new Crawler($html);
        $siltumsuknis = $this->standardizePrice($crawler->filter('.price-new.price-value-90668254')->first()->text());

        $html = file_get_contents($gazes_katls);
        $crawler = new Crawler($html);
        $gazes_katls = $this->standardizePrice($crawler->filter('.price.eiro.stock strong')->first()->text());

        $html = file_get_contents($akmens_vate);
        $crawler = new Crawler($html);
        $akmens_vate = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($stikla_vate);
        $crawler = new Crawler($html);
        $stikla_vate = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($putuplasts);
        $crawler = new Crawler($html);
        $putuplasts = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($xps);
        $crawler = new Crawler($html);
        $xps = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($putas);
        $crawler = new Crawler($html);
        $putas = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($koka_durvis);
        $crawler = new Crawler($html);
        $koka_durvis = $this->standardizePrice($crawler->filter('.price span')->first()->text());

        $html = file_get_contents($metala_durvis);
        $crawler = new Crawler($html);
        $metala_durvis = $this->standardizePrice($crawler->filter('.product-price-new')->first()->text());

        
        $html = file_get_contents($ugunsdrosas_durvis);
        $crawler = new Crawler($html);
        $ugunsdrosas_durvis = $this->standardizePrice($crawler->filter('.f-price')->first()->text());

        $html = file_get_contents($skanu_izolejosas_durvis);
        $crawler = new Crawler($html);
        $skanu_izolejosas_durvis = $this->standardizePrice($crawler->filter('.product-page__price.price')->first()->text());

        $html = file_get_contents($pvc_logs);
        $crawler = new Crawler($html);
        $pvc_logs = $this->standardizePrice($crawler->filter('.price')->first()->text());

        $html = file_get_contents($aluminija_logs);
        $crawler = new Crawler($html);
        $aluminija_logs = $this->standardizePrice($crawler->filter('.screen-reader-text')->first()->text());
    
        $html = file_get_contents($koka_logs);
        $crawler = new Crawler($html);
        $koka_logs = $this->standardizePrice($crawler->filter('span[style="color: rgb(169, 169, 169);"]')->first()->text());

        $html = file_get_contents($flizes);
        $crawler = new Crawler($html);
        $flizes = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());

        $html = file_get_contents($laminats);
        $crawler = new Crawler($html);
        $laminats = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());

        $html = file_get_contents($parkets);
        $crawler = new Crawler($html);
        $parkets = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());

        $html = file_get_contents($krasa);
        $crawler = new Crawler($html);
        $krasa = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());


        $html = file_get_contents($tapetes);
        $crawler = new Crawler($html);
        $tapetes = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());

        $html = file_get_contents($dekorativie_paneli);
        $crawler = new Crawler($html);
        $dekorativie_paneli = $this->standardizePrice($crawler->filter('.column-friendly.amount-info tr')->eq(2)->filter('td')->eq(2)->text());
        $dekorativie_paneli = $dekorativie_paneli/1.26;

        $html = file_get_contents($bezasbesta_loksnes);
        $crawler = new Crawler($html);
        $bezasbesta_loksnes = $this->standardizePrice($crawler->filter('.price')->first()->text());

        $html = file_get_contents($dakstini);
        $crawler = new Crawler($html);
        $dakstini = $this->standardizePrice($crawler->filter('.square-price')->first()->text());

        $html = file_get_contents($metala_jumts);
        $crawler = new Crawler($html);
        $metala_jumts = $this->standardizePrice($crawler->filter('.product-old-price')->first()->text());
        
        $html = file_get_contents($spot_gaismas);
        $crawler = new Crawler($html);
        $spot_gaismas = $this->standardizePrice($crawler->filter('#product-price-295729')->attr('data-price-amount'));

        $html = file_get_contents($led_paneli);
        $crawler = new Crawler($html);
        $led_paneli = $this->standardizePrice($crawler->filter('#product-price-194546')->attr('data-price-amount'));

        Material_prices::truncate();
        

        Material_prices::create([
            'kustibas_kamera' => $kustibas_kamera,
            'radiators' => $radiators,
            'apkures_katls' => $apkures_katls,
            'siltumsuknis' => $siltumsuknis,
            'gazes_katls' => $gazes_katls,
            'akmens_vate' => $akmens_vate,
            'stikla_vate' => $stikla_vate,
            'putuplasts' => $putuplasts,
            'xps' => $xps,
            'putas' => $putas,
            'koka_durvis' => $koka_durvis,
            'metala_durvis' => $metala_durvis,
            'ugunsdrosas_durvis' => $ugunsdrosas_durvis,
            'skanu_izolejosas_durvis' => $skanu_izolejosas_durvis,
            'aluminija_logs'=> $aluminija_logs,
            'pvc_logs'=> $pvc_logs,
            'koka_logs'=> $koka_logs,
            'flizes'=> $flizes,
            'laminats'=> $laminats,
            'parkets'=> $parkets,
            'krasa'=> $krasa,
            'tapetes'=> $tapetes,
            'dekorativie_paneli'=> $dekorativie_paneli,
            'dakstini'=> $dakstini,
            'metala_jumts'=> $metala_jumts,
            'siferis'=> $bezasbesta_loksnes,
            'spot_gaismas'=> $spot_gaismas,
            'led_paneli' => $led_paneli,
            'koka_divans'=> $koka_divans,
            'koka_galds'=> $koka_galds,
            'koka_skapis'=> $koka_skapis,
            'koka_kresls'=> $koka_kresls,
            'koka_gulta'=> $koka_gulta,
            'auduma_divans'=> $auduma_divans,
            'auduma_galds'=> $auduma_galds,
            'auduma_skapis'=> $auduma_skapis,
            'auduma_kresls'=> $auduma_kresls,
            'auduma_gulta'=> $auduma_gulta,
            'adas_divans'=> $adas_divans,
            'adas_galds'=> $adas_galds,
            'adas_skapis'=> $adas_skapis,
            'adas_kresls'=> $adas_kresls,
            'adas_gulta'=> $adas_gulta,
            'metala_divans'=> $metala_divans,
            'metala_galds'=> $metala_galds,
            'metala_skapis'=> $metala_skapis,
            'metala_kresls'=> $metala_kresls,
            'metala_gulta'=> $metala_gulta,
            'dumu_detektors'=> $dumu_detektors,
            'sienas_gaismeklis'=> $sienas_gaismeklis,
            'zemes_lampa'=> $zemes_lampa,
            'cela_apgaismojums'=> $cela_apgaismojums,
            
        ]);

       
    }
}
    

    
    
 