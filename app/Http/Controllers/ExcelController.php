<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build;
use App\Models\BuildItem;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{

    public function makeExcel()
    {
        //Izveido jaunu Excel darblapu un inicalizē to
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        //Iegūst kalkulatora rezultātu datus un kopējo summu
        $sessionSpecifications = Session::get('buildData', []);
        $totalCost = Session::get('totalCost', 0);
        
        //Pievieno nosaukumu tabulai A1 un B1 šūnās apvienojot tās
        $sheet->setCellValue('A1', 'Formas kopsavilkums');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        
        //Massīvs kalkulatora datu atspoguļošanai darblapā
        $build = Session::get('buildData');
        $buildData = [
            'Cena' => isset($totalCost) ? $totalCost . '€' : 'Nav',
            'Mājas nosaukums' => $build['housePlan'] ?? 'Nav',
            'Izmērs' => $build['squareMeters'] ?? 'Nav' . ' m²',
            'Sienas Platums' => ($build['wallWidth'] ?? 'Nav') . ' cm',
            'Grīda' => $build['floor'] ?? 'Nav',
            'Sienu Tips' => $build['wallsType'] ?? 'Nav',
            'Sienu Apdare' => $build['wallsFinish'] ?? 'Nav',
            'Griesti' => $build['ceiling'] ?? 'Nav',
            'Fasādes Tips' => $build['fasadeType'] ?? 'Nav',
            'Žogs' => isset($build['fence']) ? $build['fence'] . 'm' : 'Nav',
            'Zemes Mērījumi' => $build['groundMeasurement'] ?? 'Nav',
            'Īpašuma Robežu Iestatījumi' => $build['propertyBorderSetting'] ?? 'Nav',
            'Bruģa Tips' => isset($build['paving']) ? $build['paving'] . 'm²' : 'Nav',
            'Zāliena Tips' => isset($build['lawn']) ? $build['lawn'] . 'm²' : 'Nav',
            'Mēbeļu Komplekts' => $build['furnitureSet'] ?? 'Nav',
            'Pamatu Tips' => $build['foundationType'] ?? 'Nav',
            'Apkures Tips' => $build['heatingType'] ?? 'Nav',
            'Grīdas Apsilde' => $build['heatingFloor'] ?? 'Nav',
            'Sienu Apsilde' => $build['heatingWalls'] ?? 'Nav',
            'Griestu Apsilde' => $build['heatingCeiling'] ?? 'Nav',
            'Ventilācija' => $build['ventilation'] ?? 'Nav',
            'Gaisa Filtrs' => $build['airFilter'] ?? 'Nav',
            'Centrālie Filtri' => $build['centralFilter'] ?? 'Nav',
            'Ūdens Filtri' => $build['waterFilter'] ?? 'Nav',
            'Prožektori' => $build['spotLights'] ?? 'Nav',
            'Apgaismojums' => $build['ledPanels'] ?? 'Nav',
            'Būvprojekts' => $build['buildProject'] ?? 'Nav',
            'Būvatļauja' => $build['buildPermission'] ?? 'Nav',
            'Nodošana Ekspluatācijā' => $build['commisioning'] ?? 'Nav',
            'Garāža' => ($build['garage'] ?? 'Nav') . ' m2',
            'Stāvvieta' => ($build['parking'] ?? 'Nav'). ' m2',
            'Vārti' => $build['gates'] ?? 'Nav',
            'Drošības Sistēma' => $build['securitySystem'] ?? 'Nav',
            'Sensori' => $build['sensors'] ?? 'Nav',
            'Sienas Lampas' => $build['wallLights'] ?? 'Nav',
            'Ceļa Apgaismojums' => $build['roadLights'] ?? 'Nav',
            'Grīdas Apgaismojums' => $build['groundLights'] ?? 'Nav',
            'Logu Tips' => $build['windowType'] ?? 'Nav',
            'Durvju Tips' => $build['doorType'] ?? 'Nav',
            'Dizaina konsultācija' => $build['design'] ?? 'Nav',
        ];
        

        //Pievieno papildizmaksas rezultātu tabulai 
        $sessionSpecifications = Session::get('specifications', []);
        foreach ($sessionSpecifications as $spec) {
            $buildData[$spec['name']] = $spec['price'];
        }

        //Pievieno kolonnu nosaukumus augstākveidotā masīva datiem
        $sheet->setCellValue('A2', 'Parametrs');
        $sheet->setCellValue('B2', 'Vērtība');
        $sheet->getStyle('A2:B2')->getFont()->setBold(true);

        //Pievieno kalkulatora rezultātu datus (nosaukums -> vērtība formā)
        $row = 3;
        foreach ($buildData as $label => $value) {
            $sheet->setCellValue("A{$row}", $label);
            $sheet->setCellValue("B{$row}", $value);
            $row++;
        }

        //Izveido faila nosaukumu un īslaicīgi saglabā to
        $fileName = 'form_summary.xlsx';
        $tempFile = storage_path('app/public/' . $fileName);

        //Ieraksta izveidotās darblapas saturu Excel failā
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        //Lejupielādē failu lietotāja datorā un izdzēš to pēc ielādes
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
