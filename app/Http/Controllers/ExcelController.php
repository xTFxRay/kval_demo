<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Build;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends Controller
{

    public function makeExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sessionSpecifications = Session::get('buildData', []);
        $totalCost = Session::get('totalCost', 0);
        
        $sheet->setCellValue('A1', 'Formas kopsavilkums');
        $sheet->mergeCells('A1:B1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        
        $build = Build::where('userID', auth()->id())->latest()->first();

        $buildData = [
            'Lietotāja ID' => $build->userID ?? '0',
            'Mājas nosaukums' => $build->housePlan ?? '0',
            'Izmērs' => ($build->squareMeters ?? '0') . ' m²',
            'Sienas Platums' => ($build->wallWidth ?? '0') . ' cm',
            'Grīda' => $build->floor ?? '0',
            'Sienu Tips' => $build->wallsType ?? '0',
            'Sienu Apdare' => $build->wallsFinish ?? '0',
            'Griesti' => $build->ceiling ?? '0',
            'Fasādes Tips' => $build->fasadeType ?? '0',
            'Žogs' => $build->fence ?? '0',
            'Zemes Mērījumi' => $build->groundMeasurement ?? '0',
            'Īpašuma Robežu Iestatījumi' => $build->propertyBorderSetting ?? '0',
            'Bruģa Tips' => $build->paving ?? '0',
            'Zāliena Tips' => $build->lawn ?? '0',
            'Mēbeļu Komplekts' => $build->furnitureSet ?? '0',
            'Pamatu Tips' => $build->foundationType ?? '0',
            'Apkures Tips' => $build->heatingType ?? '0',
            'Grīdas Apkure' => $build->heatingFloor ?? '0',
            'Sienu Apkure' => $build->heatingWalls ?? '0',
            'Griestu Apkure' => $build->heatingCeiling ?? '0',
            'Ventilācija' => $build->ventilation ?? '0',
            'Gaisa Filtrs' => $build->airFilter ?? '0',
            'Centrālie Filtri' => $build->centralFilter ?? '0',
            'Ūdens Filtri' => $build->waterFilter ?? '0',
            'Prožektori' => $build->spotLights ?? '0',
            'LED Gaismas' => $build->ledPanels ?? '0',
            'Būvprojekts' => $build->buildProject ?? '0',
            'Būvatļauja' => $build->buildPermission ?? '0',
            'Nodošana Ekspluatācijā' => $build->commisioning ?? '0',
            'Garāža' => $build->garage ?? '0',
            'Stāvvieta' => $build->parking ?? '0',
            'Vārti' => $build->gates ?? '0',
            'Drošības Sistēma' => $build->securitySystem ?? '0',
            'Sensori' => $build->sensors ?? '0',
            'Sienas Lampas' => $build->wallLights ?? '0',
            'Ceļa Apgaismojums' => $build->roadLights ?? '0',
            'Grīdas Apgaismojums' => $build->groundLights ?? '0',
            'Logu Tips' => $build->windowType ?? '0',
            'Durvju Tips' => $build->doorType ?? '0',
            'Dizains' => $build->design ?? '0',
            'Cena' => $build->cost ?? '0',
            'Izveidots' => $build->created_at ?? '0',
        ];


        $sessionSpecifications = Session::get('specifications', []);
        foreach ($sessionSpecifications as $spec) {
            $buildData[$spec['name']] = $spec['price'];
        }

        $sheet->setCellValue('A2', 'Parametrs');
        $sheet->setCellValue('B2', 'Vērtība');
        $sheet->getStyle('A2:B2')->getFont()->setBold(true);

        $row = 3;
        foreach ($buildData as $label => $value) {
            $sheet->setCellValue("A{$row}", $label);
            $sheet->setCellValue("B{$row}", $value);
            $row++;
        }

        $fileName = 'form_summary.xlsx';
        $tempFile = storage_path('app/public/' . $fileName);

        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
