<?php

namespace App\Http\Controllers;

use App\Models\Variete;
use App\Models\Parcelle;
use Illuminate\Http\Request;
use App\Helpers\Components\Head;
use Illuminate\Validation\Validator;
use App\Models\CultureParcelle as ModelTarget;

class CultureParcelleController extends Controller
{
    public function index()
    {
        $varietes=Variete::query()
        ->join('especes', 'varietes.espece', 'especes.ide')
        ->select('varietes.*', 'especes.nomCommercial as espece')->get();
        $parcelles = Parcelle::all();
        $CultureParcelle = ModelTarget::all();
        return view('crud.culture.index', compact('Varietes', 'parcelles', 'CultureParcelle'));
    }

    public function create()
    {
        // dd(33);

        $heads = [
            new Head('espece', Head::TYPE_TEXT, 'espece'),
            new Head('nomCommercial', Head::TYPE_TEXT, 'nom Commercial'),
            new Head('appelationAr', Head::TYPE_TEXT, 'appelation Arabe'),
            new Head('qualite', Head::TYPE_TEXT, 'qualite'),
            new Head('precocite', Head::TYPE_TEXT, 'precocite'),
            new Head('resistance', Head::TYPE_TEXT, 'resistance'),
            new Head('competitivite', Head::TYPE_TEXT, 'competitivite'),
            new Head('description', Head::TYPE_TEXT, 'description'),
        ];
        
        $varietes=Variete::query()
        ->join('especes', 'varietes.espece', 'especes.ide')
        ->select('varietes.*', 'especes.nomCommercial as espece')->get();
        return view('crud.culture.create', compact('heads', 'varietes'));
    }

    public function store(Request $request)
    {
        // dd($request);
        ModelTarget::query()->where('parcelleId','=',$request->idp)->delete();
        $options=$request->check;
       


        if(isset($options)){

            foreach ($options as $index => $value) {
                    $val=[
                        'parcelleId'=>$request->idp,
                        'varieteID'=>$value
                        
                    ];
             
           
                    $model= ModelTarget::query()->create($val);
             
            } 
            $this->success(text: trans('messages.added_message'));
            return redirect()->route('cultureparcelle.create');
            

        }

        $this->error('selectionner une culture');
            return redirect()->route('cultureparcelle.create');
            
       
    }

}
