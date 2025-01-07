<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Build;
use App\Models\BuildItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;




class CalculatorController extends Controller
{
    protected $pricing;
    protected $sizes;
    protected $floor;
    protected $ceiling;
    protected $walls;
    protected $materialPrices;
    protected $windows;
    protected $doors;
    protected $rooms;
    protected $lighting_count;
    protected $wall_cost;

    protected $fasade;
  
    //Iegūst noklusētās vērtības izmantotās kalkulatora darbībai no config mapes def_values faila
    public function __construct()
    {
        $this->pricing = config('def_values.work');
        $this->sizes = config('def_values.sizes');
        $this->floor = config('def_values.floor');
        $this->ceiling = config('def_values.ceiling');
        $this->walls = config('def_values.walls');
        $this->windows = config('def_values.windows');
        $this->doors = config('def_values.doors');
        $this->rooms = config('def_values.rooms');
        $this->lighting_count = config('def_values.outside_lighting_count');
        $this->wall_cost = config('def_values.wall_frame_cost');
        $this->fasade = config('def_values.fasade');
        
        //Iegūst preču datus no DB
        $this->materialPrices = Product::all(['name', 'price'])->pluck('price', 'name')->toArray();
        Session::forget('specifications');

        
    }

    
    public function layout(Request $request)
    {   
        //Gadījumam ja palikuši dati no iepriekšējāss kalkulatora darbības   
        Session::forget('buildData');
        Session::forget('totalCost');

        $userID = Auth::id();
        Session::put('userID', $userID);
    
        $request->validate([
            'squareMeters' => 'required|string',
        ]);

        //Pievieno lietotāja izvēlēto izmaksu sesijas mainīgajā
        $buildData = Session::get('buildData', []);
        $buildData['squareMeters'] = $request->input('squareMeters');

        Session::put('buildData', $buildData); 

        //Inicializē kopējās summas mainīgo
        $totalCost = 0;
        Session::put('totalCost', $totalCost);
        

        $selectedRange = $request->input('squareMeters');

        //Māju plāni balstīti uz lietotāja izvēlēto mājass izmēru
        $plans = [
            ['name' => 'Namejs', 'size-category' => '40-60', 'size' => '46', 'image' => 'houseplan1.jpg'],
            ['name' => 'Astra', 'size-category' => '40-60', 'size' => '60', 'image' => 'houseplan2.jpg'],
            ['name' => 'Auseklis', 'size-category' => '70-85', 'size' => '71', 'image' => 'houseplan3.jpg'],
            ['name' => 'Gaiziņš', 'size-category' => '70-85', 'size' => '83', 'image' => 'houseplan4.jpg'],
            ['name' => 'Lubāns', 'size-category' => '90-120', 'size' => '102', 'image' => 'houseplan5.jpg'],
            ['name' => 'Tors', 'size-category' => '90-120', 'size' => '124', 'image' => 'houseplan6.jpg'],
        ];
        

        //Iegūst plānus kuri atbilst lietotāja izvēlei
        $filteredPlans = array_filter($plans, function($plan) use ($selectedRange) {
            return $plan['size-category'] === $selectedRange;
        });

      
        return view('layout', ['plans' => $filteredPlans]);

    }

    public function building(Request $request)
    {

        if (!$request->has('housePlan')) {
            return redirect()->back()->with('error', 'Atzīmējiet visas obligātās opcijas');
        }
        
        $request->validate([
            'housePlan'=> 'string|required',
        ]);
        
        
        $buildData = Session::get('buildData', []);
        
        //Pievieno lietotāja izvēli un atjauno kopējās summas vērtību sesijas mainīgajos
        $buildData['housePlan'] = $request->input('housePlan');
        
        Session::put('buildData', $buildData);
        
        return view('building');
    }
    
    public function structure(Request $request)
    {
   
        $request->validate([
            'projekts' => 'string',
            'merisana' => 'string',
            'robezu-apstiprinasana' => 'string',
            'atlauja' => 'string',
            'eksplotacija' => 'string',
        ]);
    
        $buildData = Session::get('buildData', []);
    
        $previousStructureCost = $buildData['structureCost'] ?? 0;
        $totalCost = ($buildData['totalCost'] ?? 0) - $previousStructureCost;
    
        $structureCost = 0;
        if ($request->input('projekts') == 'Nepieciešams') {
            $structureCost += $this->pricing['buildProject'];
        }
        if ($request->input('merisana') == 'Nepieciešams') {
            $structureCost += $this->pricing['groundMeasurement'];
        }
        if ($request->input('robezu-apstiprinasana') == 'Nepieciešams') {
            $structureCost += $this->pricing['propertyBorderSetting'];
        }
        if ($request->input('atlauja') == 'Nepieciešams') {
            $structureCost += $this->pricing['buildPermission'];
        }
        if ($request->input('eksplotacija') == 'Nepieciešams') {
            $structureCost += $this->pricing['commisioning'];
        }
    
        $totalCost += $structureCost;
        $totalCost = (float) round($totalCost, 2);
    
        $buildData['structureCost'] = $structureCost;
        $buildData['totalCost'] = $totalCost;
        $buildData['buildProject'] = $request->input('projekts');
        $buildData['groundMeasurement'] = $request->input('merisana');
        $buildData['propertyBorderSetting'] = $request->input('robezu-apstiprinasana');
        $buildData['buildPermission'] = $request->input('atlauja');
        $buildData['commisioning'] = $request->input('eksplotacija');
        
        Session::put('buildData', $buildData);
    
        return view('structure', ['totalCost' => $totalCost]);
    }

    //Zemāk funkcijas seko iepriekš komentēto funkciju principam 
    //(dažkārt veicot cenas aprēķinus balstoties uz def_values datiem), tāpēc tās netiks komentētas
    public function heating(Request $request)
{
    $request->validate([
        'pamatu-veidi' => 'required|string',
        'sienas-biezums' => 'required|int',
        'sienas-tips' => 'required|string',
        'jumta-veidi' => 'required|string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousHeatingCost = $buildData['heatingCost'] ?? 0;
  
    $totalCost = Session::get('totalCost', 0) - $previousHeatingCost;
    
    $heatingCost = 0;
    $materialPrices = $this->materialPrices;

    $defaultWallWidth = 15; 

    $wallWidthFactor = $request->input('sienas-biezums') / $defaultWallWidth;
  
    $heatingCost += ($this->pricing[$request->input('pamatu-veidi')]) * ($this->sizes[$buildData['housePlan']]);
    $heatingCost += $this->wall_cost[$request->input('sienas-tips')] * $this->walls[$buildData['housePlan']] * $wallWidthFactor;;
    $heatingCost += ($materialPrices[$request->input('jumta-veidi')] + $this->pricing['roof']) * ($this->sizes[$buildData['housePlan']]);

    $buildData['foundationType'] = $request->input('pamatu-veidi');
    $buildData['wallWidth'] = $request->input('sienas-biezums');
    $buildData['wallsType'] = $request->input('sienas-tips');
    $buildData['roofType'] = $request->input('jumta-veidi');
    $buildData['heatingCost'] = $heatingCost;

    $totalCost += $heatingCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('heating', ['totalCost' => $totalCost]);
}

public function winDoor(Request $request)
{
    $request->validate([
        'apsildes-veids' => 'nullable|string',
        'siltinajums-gridai' => 'nullable|string',
        'siltinajums-sienam' => 'nullable|string',
        'siltinajums-griestiem' => 'nullable|string',
    ]);
   

    $buildData = Session::get('buildData', []);

   
    $previouswinDoorCost = $buildData['winDoorCost'] ?? 0;
  
    $totalCost = Session::get('totalCost', 0) - $previouswinDoorCost;
    $winDoorCost = 0;
    $materialPrices = $this->materialPrices;

    if ($request->input('apsildes-veids') != 'Bez') {
        $winDoorCost += $materialPrices[$request->input('apsildes-veids')];
    }
    if ($request->input('siltinajums-gridai') != 'Bez') {  
        $winDoorCost += ($materialPrices[$request->input('siltinajums-gridai')] * $this->floor[$buildData['housePlan']]) +
        (($this->floor[$buildData['housePlan']] * $this->pricing['heating_montage']));
    }
    if ($request->input('siltinajums-sienam') != 'Bez') {
        $winDoorCost += ($materialPrices[$request->input('siltinajums-sienam')] * $this->walls[$buildData['housePlan']]) +
        (($this->walls[$buildData['housePlan']] * $this->pricing['heating_montage']));
    }
    if ($request->input('siltinajums-griestiem') != 'Bez') {
        $winDoorCost += ($materialPrices[$request->input('siltinajums-griestiem')] * $this->ceiling[$buildData['housePlan']]) +
        (($this->floor[$buildData['housePlan']] * $this->pricing['heating_montage']));
    }

    $buildData['heatingType'] = $request->input('apsildes-veids');
    $buildData['heatingFloor'] = $request->input('siltinajums-gridai');
    $buildData['heatingWalls'] = $request->input('siltinajums-sienam');
    $buildData['heatingCeiling'] = $request->input('siltinajums-griestiem');
    
    $buildData['winDoorCost'] = $winDoorCost;

    $totalCost += $winDoorCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('winDoor', ['totalCost' => $totalCost]);
}
public function finish(Request $request)
{
    $request->validate([
        'logu-tips' => 'string',
        'durvju-veids' => 'string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousFinishCost = $buildData['finishCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousFinishCost;
    $finishCost = 0;
    $materialPrices = $this->materialPrices;

    if ($request->input('logu-tips')) {
       $finishCost += ($materialPrices[$request->input('logu-tips')] + $this->pricing['window'])
                     * $this->windows[$buildData['housePlan']];
    }
    if ($request->input('durvju-veids')) {  
        $finishCost += ($materialPrices[$request->input('durvju-veids')] + $this->pricing['door'])
                     * $this->doors[$buildData['housePlan']];
    }

    $buildData['windowType'] = $request->input('logu-tips');
    $buildData['doorType'] = $request->input('durvju-veids');
    $buildData['finishCost'] = $finishCost;

    $totalCost += $finishCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('finish', ['totalCost' => $totalCost]);
}

public function plumblight(Request $request)
{
    $request->validate([
        'gridu-veids' => 'string',
        'sienu-apdare' => 'string',
        'griestu-apdare' => 'string',
        'fasades-apsuvums' => 'string',
    ]);

    $buildData = Session::get('buildData', []);
   
    $previousPlumblightCost = $buildData['plumblightCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousPlumblightCost;
    $plumblightCost = 0;
    $materialPrices = $this->materialPrices;
  
   
    if ($request->input("gridu-veids") != "Bez apdares") {
        $plumblightCost += ($materialPrices[$request->input("gridu-veids")] + $this->pricing[$request->input("gridu-veids")])
                        * $this->floor[$buildData['housePlan']];
    }

    if ($request->input("sienu-apdare") == "Dekoratīvās plāksnes") {
        $plumblightCost += ($this->pricing[$request->input("sienu-apdare")])
                        * $this->floor[$buildData['housePlan']];
    }
    else if ($request->input("sienu-apdare") != "Bez apdares"){
        $plumblightCost += ($materialPrices[$request->input('sienu-apdare')] + $this->pricing[$request->input('sienu-apdare')])
                        * $this->walls[$buildData['housePlan']];
    }

    if ($request->input("griestu-apdare") != "Bez apdares") {
        $plumblightCost +=$this->pricing[$request->input('griestu-apdare')]
                        * $this->floor[$buildData['housePlan']];
    }
    if ($request->input("fasades-apsuvums") != "Bez apšuvuma") {
        $plumblightCost +=$this->pricing[$request->input('fasades-apsuvums')]
                        * $this->fasade[$buildData['housePlan']];
    }

    $buildData['floor'] = $request->input('gridu-veids');
    $buildData['wallsFinish'] = $request->input('sienu-apdare');
    $buildData['ceiling'] = $request->input('griestu-apdare');
    $buildData['fasadeType'] = $request->input('fasades-apsuvums');
    $buildData['plumblightCost'] = $plumblightCost;

    $totalCost += $plumblightCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('plumblight', ['totalCost' => $totalCost]);
}


public function furniture(Request $request)
{   
   
    $request->validate([
        'ventilacija' => 'string',
        'gaisa_filtrs' => 'string',
        'centralais_filtrs' => 'string',
        'udens_filtrs' => 'string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousFurnitureCost = $buildData['furnitureCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousFurnitureCost;
    $furnitureCost = 0;

    if ($request->input("centralais_filtrs")) {
        $furnitureCost += $this->pricing[$request->input("centralais_filtrs")];
    }
    if ($request->input("udens_filtrs")) {
        $furnitureCost += $this->pricing[$request->input("udens_filtrs")];
    }
    if ($request->input("gaisa_filtrs")) {
        $furnitureCost += $this->pricing[$request->input("gaisa_filtrs")];
    }
    if ($request->input("ventilacija")) {
        $furnitureCost += $this->pricing[$request->input("ventilacija")];
    }

    $buildData['ventilation'] = $request->input('ventilacija');
    $buildData['airFilter'] = $request->input('gaisa_filtrs');
    $buildData['centralFilter'] = $request->input('centralais_filtrs');
    $buildData['waterFilter'] = $request->input('udens_filtrs');
    $buildData['furnitureCost'] = $furnitureCost;

    $totalCost += $furnitureCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);
    return view('furniture', ['totalCost' => $totalCost]);
}

public function add(Request $request)
{
    $request->validate([
        'furniture_set' => 'nullable|string',
        'design_consultation' => 'nullable|string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousAddCost = $buildData['addCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousAddCost;
    $addCost = 0;
    $materialPrices = $this->materialPrices;
    $plan = $buildData['housePlan'];

    if (
        $request->input('furniture_set') == 'Koka' || 
        $request->input('furniture_set') == 'Ādas' || 
        $request->input('furniture_set') == 'Auduma' || 
        $request->input('furniture_set') == 'Metāla'
    ) {
    $addCost += $materialPrices[$request->input('furniture_set') . ' krēsls'] * config('def_values.furniture.' . $plan . '.chairs');
    $addCost += $materialPrices[$request->input('furniture_set') . ' galds'] * config('def_values.furniture.' . $plan . '.tables');
    $addCost += $materialPrices[$request->input('furniture_set') . ' dīvans'] * config('def_values.furniture.' . $plan . '.sofas');
    $addCost += $materialPrices[$request->input('furniture_set') . ' skapis'] * config('def_values.furniture.' . $plan . '.cupboards');
    $addCost += $materialPrices[$request->input('furniture_set') . ' gulta'] * config('def_values.furniture.' . $plan . '.beds');
    }

    if ($request->input('design_consultation') == 'Jā') {
        $addCost += $this->pricing['design'];
    }

    
    $buildData['furnitureSet'] = $request->input('furniture_set');
    $buildData['design'] = $request->input('design_consultation');

    $buildData['addCost'] = $addCost;

    $totalCost += $addCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('add', ['totalCost' => $totalCost]);
}
public function com(Request $request)
{   
   
    $request->validate([
        'garaza' => 'nullable|int',
        'stavvieta' => 'nullable|int',
        'drosibas-sistema' => 'nullable|string',
        'sensori' => 'nullable|string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousComCost = $buildData['comCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousComCost;
    $comCost = 0;
    $materialPrices = $this->materialPrices;

    if ($request->input('garaza')) {
        $comCost += $this->pricing['garage'] * $request->input('garaza');
    }
    if ($request->input('stavvieta')) {
        $comCost += $this->pricing['paving'] * $request->input('stavvieta');
    }
    if ($request->input('drosibas-sistema') != 'Nē') {
        $comCost += $this->pricing[$request->input('drosibas-sistema')];
    }
    if ($request->input('sensori') != 'Nē') {
        $comCost += $materialPrices[$request->input('sensori')] * 4;
    }

    $buildData['garage'] = $request->input('garaza');
    $buildData['parking'] = $request->input('stavvieta');
    $buildData['securitySystem'] = $request->input('drosibas-sistema');
    $buildData['sensors'] = $request->input('sensori');

    $buildData['comCost'] = $comCost;

    $totalCost += $comCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);

    return view('com', ['totalCost' => $totalCost]);
}


public function extras(Request $request){

   
    $request->validate([
        'platiba' => 'nullable|numeric',
        'varti' => 'nullable|string',
        'celina_uzstadisana' => 'nullable|string',
        'zaliena_ierikosana' => 'nullable|string',
        'spot_gaismas' => 'nullable|string',
        'led_paneli' => 'nullable|string',
        'sienas_gaismas' => 'nullable|string',
        'cela_apg' => 'nullable|string',
        'zemes_apg' => 'nullable|string',
    ]);

    $buildData = Session::get('buildData', []);
    $previousResultsCost = $buildData['resultsCost'] ?? 0;

    $totalCost = Session::get('totalCost', 0) - $previousResultsCost;
    $resultsCost = 0;
    $materialPrices = $this->materialPrices;
    $plan = $buildData['housePlan'];

    if ($request->input('spot_gaismas')) {
        $resultsCost += $materialPrices["Spot gaismas"] * ($this->rooms[$plan] * 4);
    }

   
    if ($request->input('led_paneli')) {
        $resultsCost += $materialPrices["LED paneli"] * ($this->rooms[$plan] * 4);
    }
    if ($request->input('sienas_gaismas')) {
        $resultsCost += $this->lighting_count[$plan] * $materialPrices['Sienas gaismeklis'];
    }
    if ($request->input('cela_apg')) {
        $resultsCost += $this->lighting_count[$plan] * $materialPrices['Ceļa apgaismojums'];
    }
    if ($request->input('zemes_apg')) {
        $resultsCost += $this->lighting_count[$plan] * $materialPrices['Zemes lampa'];
    }
    if ($request->input('platiba')) {
        $resultsCost += $request->input('platiba') * $this->pricing['fence'];
    }
    if ($request->input('celina_uzstadisana') != 'no') {
        $resultsCost += $this->pricing['paving'];
    }
    if ($request->input('varti') != 'Bez') {
        $resultsCost += $this->pricing[$request->input('varti')];
    }
    if ($request->input('zaliena_ierikosana') != 'no') {
        $resultsCost += $this->pricing['zaliens'] * $request->input('zaliena_ierikosana');
    }

    
    $buildData['userID'] = Session::get('userID');

    $buildData['fence'] = $request->input('platiba');
    $buildData['gates'] = $request->input('varti');
    $buildData['paving'] = $request->input('celina_uzstadisana');
    $buildData['lawn'] = $request->input('zaliena_ierikosana');
    $buildData['spotLights'] = $request->input('spot_gaismas');
    $buildData['ledPanels'] = $request->input('led_paneli');
    $buildData['wallLights'] = $request->input('sienas_gaismas');
    $buildData['roadLights'] = $request->input('cela_apg');
    $buildData['groundLights'] = $request->input('zemes_apg');
    $buildData['cost'] = $totalCost;

    $totalCost += $resultsCost;
    $totalCost = (float)round($totalCost, 2);
    Session::put('buildData', $buildData);
    Session::put('totalCost', $totalCost);
   


    if (Auth::check()) {
        return redirect()->route('specification');
    } else {
     
        return redirect()->route('results');
    }
}

public function addSpecification(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
        }

        if (!($request->specName)) {
            return redirect()->back()->with("error", "Ievadiet korektu izmaksas nosaukumu!");
        }
        
        if (!($request->specPrice) || $request->specPrice < 0) {
            return redirect()->back()->with("error", "Ievadiet korektu papildus izmaksas cenu!");
        }

       $request->validate([
            'specName' => 'required|string|max:255',
            'specPrice' => 'required|numeric|min:0',
        ]);

        $specifications = Session::get('specifications', []);
        $totalCost = Session::get('totalCost', 0);


        $specifications[] = [
            'name' => $request->input('specName'),
            'price' => $request->input('specPrice'),
        ];
        Session::put('specifications', $specifications);

        $totalCost += $request->input('specPrice');
        Session::put('totalCost', $totalCost);

        return redirect()->back()->with('success', 'Izmaksa pievienota veiksmīgi!');
    }


    public function updatePrices(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Šī lapa pieejama tikai reģistrētiem lietotājiem.');
        }

        $updatedPrices = $request->input('prices');

        foreach ($updatedPrices as $key => $newPrice) {
            if (!is_numeric($newPrice)) {
                return redirect()->back()->with('error', 'Cenām ir jābūt ievadītām kā skaitļiem!');
            }
        }
        
        $materialPrices = Session::get('material_prices', []); 
        
        foreach ($updatedPrices as $key => $newPrice) {
            if (is_numeric($newPrice)) {
                $materialPrices[$key] = $newPrice;
            }
        }
    
        Session::put('material_prices', $materialPrices);
      
        return redirect()->route('start')->with('success', 'Cenas ir atjauninātas!');

    }
    
    public function results(Request $request)
    {
        //Iegūst lietotāja datus, kalkulatora saglabātās izmaksas un kopējo summu
        $user = Auth::user();
        $buildData = Session::get('buildData', []);
        $totalCost = Session::get('totalCost', 0);
        
      
        //Izveido būves ierakstu datubāzē (tikai reģistrētiem lietotājiem)
        if (Auth::check()) {
            $build = Build::create([
                'userID' => $user->id,
                'cost' => $totalCost,
            ]);
        }
    
        
        $items = [
            ['specification' => 'squareMeters', 'value' => $buildData['squareMeters'] ?? '-'],
            ['specification' => 'wallWidth', 'value' => $buildData['wallWidth'] ?? '-'],
            ['specification' => 'floor', 'value' => $buildData['floor'] ?? '-'],
            ['specification' => 'wallsType', 'value' => $buildData['wallsType'] ?? '-'],
            ['specification' => 'ceiling', 'value' => $buildData['ceiling'] ?? '-'],
            ['specification' => 'fasadeType', 'value' => $buildData['fasadeType'] ?? '-'],
            ['specification' => 'fence', 'value' => $buildData['fence'] ?? '-'],
            ['specification' => 'groundMeasurement', 'value' => $buildData['groundMeasurement'] ?? '-'],
            ['specification' => 'propertyBorderSetting', 'value' => $buildData['propertyBorderSetting'] ?? '-'],
            ['specification' => 'paving', 'value' => $buildData['paving'] ?? '-'],
            ['specification' => 'lawn', 'value' => $buildData['lawn'] ?? '-'],
            ['specification' => 'furnitureSet', 'value' => $buildData['furnitureSet'] ?? '-'],
            ['specification' => 'foundationType', 'value' => $buildData['foundationType'] ?? '-'],
            ['specification' => 'heatingType', 'value' => $buildData['heatingType'] ?? '-'],
            ['specification' => 'heatingFloor', 'value' => $buildData['heatingFloor'] ?? '-'],
            ['specification' => 'heatingWalls', 'value' => $buildData['heatingWalls'] ?? '-'],
            ['specification' => 'heatingCeiling', 'value' => $buildData['heatingCeiling'] ?? '-'],
            ['specification' => 'ventilation', 'value' => $buildData['ventilation'] ?? '-'],
            ['specification' => 'airFilter', 'value' => $buildData['airFilter'] ?? '-'],
            ['specification' => 'centralFilter', 'value' => $buildData['centralFilter'] ?? '-'],
            ['specification' => 'waterFilter', 'value' => $buildData['waterFilter'] ?? '-'],
            ['specification' => 'spotLights', 'value' => $buildData['spotLights'] ?? '-'],
            ['specification' => 'ledPanels', 'value' => $buildData['ledPanels'] ?? '-'],
            ['specification' => 'buildProject', 'value' => $buildData['buildProject'] ?? '-'],
            ['specification' => 'buildPermission', 'value' => $buildData['buildPermission'] ?? '-'],
            ['specification' => 'commisioning', 'value' => $buildData['commisioning'] ?? '-'],
            ['specification' => 'garage', 'value' => $buildData['garage'] ?? '-'],
            ['specification' => 'parking', 'value' => $buildData['parking'] ?? '-'],
            ['specification' => 'gates', 'value' => $buildData['gates'] ?? '-'],
            ['specification' => 'securitySystem', 'value' => $buildData['securitySystem'] ?? '-'],
            ['specification' => 'sensors', 'value' => $buildData['sensors'] ?? '-'],
            ['specification' => 'wallLights', 'value' => $buildData['wallLights'] ?? '-'],
            ['specification' => 'roadLights', 'value' => $buildData['roadLights'] ?? '-'],
            ['specification' => 'groundLights', 'value' => $buildData['groundLights'] ?? '-'],
            ['specification' => 'doorType', 'value' => $buildData['doorType'] ?? '-'],
            ['specification' => 'windowType', 'value' => $buildData['windowType'] ?? '-'],
            ['specification' => 'design', 'value' => $buildData['design'] ?? '-'],
            ['specification' => 'roofType', 'value' => $buildData['roofType'] ?? '-'],
            ['specification' => 'wallsFinish', 'value' => $buildData['wallsFinish'] ?? '-'],
            ['specification' => 'housePlan', 'value' => $buildData['housePlan'] ?? '-'],
        ];
        
        //Dati tiek formatēti vieglākai pievienošanai datubāzē un cenai tiek pievienota eiro zīme 
        $specifications = Session::get('specifications', []);
        foreach ($specifications as $specification) {
            $items[] = [
                'specification' => $specification['name'],
                'value' => $specification['price'] . '€',
            ];
        }
        
        //Pievieno būves izmaksas datubāzē (tikai reģistrētiem lietotājiem)
        if (Auth::check()) {
        foreach ($items as $item) {
            BuildItem::create([
                'buildID' => $build->id,
                'specification' => $item['specification'],
                'value' => $item['value'],
            ]);
        }
    }
    
        return view('results', ['build' => $buildData, 'totalCost' => $totalCost, 'user' => $user]);
    }

}