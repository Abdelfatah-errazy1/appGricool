<?php

namespace App\Http\Controllers;

use App\Models\Variete;
use App\Models\StadeVariete;
use Illuminate\Http\Request;
use App\Models\Qualifications;
use App\Models\CultureParcelle;
use App\Helpers\Components\Head;
use App\Models\TechniqueSpecifique;
use App\Models\mesurequantification;

class DashboardController extends Controller
{
    //
    public function plantation () {
        $varietes=Variete::query()
        ->join('especes', 'varietes.espece', 'especes.ide')
        ->select('varietes.*', 'especes.nomCommercial as espece')->get();

        $collection = StadeVariete::query()
        ->join('varietes', 'varietes.idV', 'stadeVarietes.variete')
        ->select('stadeVarietes.*', 'varietes.nomCommercial as variete')
        
        ->get();
        $model = Qualifications::all();
        //$techSpe=TechniquesSpecefique::all();
        $idculture = '1';
        $idteckAgr = "Irrigation";


        return view('index',compact('varietes','collection','model','idculture','idteckAgr'));
    }
    public function stadeVariete () {
        $collection = StadeVariete::query()
        ->join('varietes', 'stadevarietes.idS', 'varietes.idV')
        // ->where('techniques_specifiques.idTS',$id)
        ->select('charges_tech_spe.*', 'techniques_specifiques.titre as TechniqueSpecifique')
        ->get();

        return view('crud.stadeVariete.index',compact('sVariete'));
    }


    public function plantations () {
        $varietes=Variete::all();
        $heads = [
            new Head('nom', Head::TYPE_TEXT, 'nom'),
            new Head('phaseFin', Head::TYPE_TEXT, 'phaseFin'),
            new Head('variete', Head::TYPE_TEXT, 'variete'),
            new Head('sommesTemps', Head::TYPE_TEXT, 'sommesTemps'),
            new Head('sommesTempFroid', Head::TYPE_TEXT, 'sommesTempFroid'),
            new Head('Kc', Head::TYPE_TEXT, 'Kc'),
            new Head('enracinement', Head::TYPE_TEXT, 'enracinement'),
            new Head('maxEnracinement', Head::TYPE_OPTIONS, 'maxEnracinement',[
                'Y' => trans('words.yes'),
                'N' => trans('words.no'),
            ]),
            new Head('description', Head::TYPE_TEXT, trans('pages/stadeVarietes.description')),
        ];

    $collection = StadeVariete::query()
    ->join('varietes', 'varietes.idV', 'stadeVarietes.variete')
    ->select('stadeVarietes.*', 'varietes.nomCommercial as variete')
    ->get();


        $model = Qualifications::all();
        //$techSpe=TechniquesSpecefique::all();
        $idculture = '1';
        $idteckAgr = "Irrigation";


        return view('index',compact('varietes','collection','model','idculture','idteckAgr'));
    }
  

    public function store(Request $request)
    {

        $validator = validator($request->all(), [
            'idquantification' => 'required|exists:qualifications,' . Qualifications::PK,
            'idculture' => 'required|exists:culture_parcelles,' . CultureParcelle::PK,
            'mesure' => 'required',
            'date' => 'required|date'
        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }
        mesurequantification::create([
            'idquantification' => $validator->validated()['idquantification'] ,
            'idculture' => $validator->validated()['idculture'] ,
            'mesure' => $validator->validated()['mesure'] ,
            'date' => $validator->validated()['date']
        ]) ;


        return response()->json(['message' => true]);


    }

    public function getUnite(Request  $request){

        $validator = validator($request->all(), [
            'idQ' => 'required|exists:qualifications,' . Qualifications::PK,

        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $res = Qualifications::find($validator->validated()['idQ']);

        return response()->json([
            'data' => $res ,
        ]);
    }
    public function storeTS(Request  $request){

        $validator = validator($request->all(), [
            'idTS' => 'required|exists:techniques_specifiques,' . TechniqueSpecifique::PK,

        ]);
        if ($validator->fails()) {
            return [
                'errors' => $validator->errors()->toArray()
            ];
        }

        $res = TechniqueSpecifique::find($validator->validated()['idTS']);

        return response()->json([
            'data' => $res ,
        ]);
    }
}
