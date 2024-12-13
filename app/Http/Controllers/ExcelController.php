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
            'Mājas nosaukums' => $build->housePlan ?? 'Nav',
            'Izmērs' => ($build->squareMeters ?? 'Nav') . ' m²',
            'Sienas Platums' => ($build->wallWidth ?? 'Nav') . ' cm',
            'Grīda' => $build->floor ?? 'Nav',
            'Sienu Tips' => $build->wallsType ?? 'Nav',
            'Sienu Apdare' => $build->wallsFinish ?? 'Nav',
            'Griesti' => $build->ceiling ?? 'Nav',
            'Fasādes Tips' => $build->fasadeType ?? 'Nav',
            'Žogs' => $build->fence ? $build->fence . 'm²' : 'Nav',
            'Zemes Mērījumi' => $build->groundMeasurement ?? 'Nav',
            'Īpašuma Robežu Iestatījumi' => $build->propertyBorderSetting ?? 'Nav',
            'Bruģa Tips' => $build->paving ? $build->paving . 'm2': 'Nav',
            'Zāliena Tips' => $build->lawn ? $build->lawn . 'm2' : 'Nav',
            'Mēbeļu Komplekts' => $build->furnitureSet ?? 'Nav',
            'Pamatu Tips' => $build->foundationType ?? 'Nav',
            'Apkures Tips' => $build->heatingType ?? 'Nav',
            'Grīdas Apsilde' => $build->heatingFloor ?? 'Nav',
            'Sienu Apsilde' => $build->heatingWalls ?? 'Nav',
            'Griestu Apsilde' => $build->heatingCeiling ?? 'Nav',
            'Ventilācija' => $build->ventilation ?? 'Nav',
            'Gaisa Filtrs' => $build->airFilter ?? 'Nav',
            'Centrālie Filtri' => $build->centralFilter ?? 'Nav',
            'Ūdens Filtri' => $build->waterFilter ?? 'Nav',
            'Prožektori' => $build->spotLights ?? 'Nav',
            'Apgaismojums' => $build->ledPanels ?? 'Nav',
            'Būvprojekts' => $build->buildProject ?? 'Nav',
            'Būvatļauja' => $build->buildPermission ?? 'Nav',
            'Nodošana Ekspluatācijā' => $build->commisioning ?? 'Nav',
            'Garāža' => $build->garage ?? 'Nav',
            'Stāvvieta' => $build->parking ?? 'Nav',
            'Vārti' => $build->gates ?? 'Nav',
            'Drošības Sistēma' => $build->securitySystem ?? 'Nav',
            'Sensori' => $build->sensors ?? 'Nav',
            'Sienas Lampas' => $build->wallLights ?? 'Nav',
            'Ceļa Apgaismojums' => $build->roadLights ?? 'Nav',
            'Grīdas Apgaismojums' => $build->groundLights ?? 'Nav',
            'Logu Tips' => $build->windowType ?? 'Nav',
            'Durvju Tips' => $build->doorType ?? 'Nav',
            'Dizains' => $build->design ?? 'Nav',
            'Cena' => $build->cost ? $build->cost . '€' : 'Nav',

            'Izveidots' => $build->created_at ?? 'Nav',
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
