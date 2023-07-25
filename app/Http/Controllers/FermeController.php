<?php

namespace App\Http\Controllers;

use App\Helpers\Components\Action;
use App\Helpers\Components\Head;
use App\Http\Requests\Fermes\Add as FermesAdd;
use App\Http\Requests\Fermes\Update;
use Illuminate\Http\Request;
use App\Models\Ferme as ModelTarget;
use App\Models\Parcelle;
use App\Models\Typesol;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Routing\Route as RoutingRoute;
use League\Flysystem\FilesystemException;

use function PHPSTORM_META\type;

class FermeController extends Controller
{
    /***
     *  page index
     */
    protected function index(Request $request)
    {

        $actions = [
            new Action(ucwords('Ajouter Nouveau'), Action::TYPE_NORMAL,  route('fermes.create')),
            new Action(ucwords('Supprimer'), Action::TYPE_DELETE_ALL, route('fermes.destroyGroup')),
        ];
        $heads = [
            new Head('logo', Head::TYPE_IMG, 'Logo'),
            new Head('nomDomaine', Head::TYPE_TEXT,'Nom de ferme'),
            new Head('fullNameG', Head::TYPE_TEXT, 'Nom Gerant'),
            new Head('cin', Head::TYPE_TEXT, 'CIN'),
            new Head('contactG', Head::TYPE_TEXT, 'Contact Gerant'),
            new Head('SAT', Head::TYPE_TEXT, 'Superficie Agricole Totale'),
            new Head('SAU', Head::TYPE_TEXT, 'Superficie Agricole Utile'),
            new Head('observation', Head::TYPE_TEXT, 'Observation'),
            new Head('fixe', Head::TYPE_TEXT, 'Fixe'),
            new Head('fax', Head::TYPE_TEXT, 'Fax'),
            new Head('GSM1', Head::TYPE_TEXT, 'GSM1'),
            new Head('GSM2', Head::TYPE_TEXT, 'GSM2'),
            new Head('email', Head::TYPE_TEXT, 'Email'),
            new Head('siteWeb', Head::TYPE_TEXT, 'SiteWeb'),
            new Head('Douar', Head::TYPE_TEXT, 'Douar'),
            new Head('Cercle', Head::TYPE_TEXT, 'Circle'),
            new Head('province', Head::TYPE_TEXT, 'Province'),
            new Head('region', Head::TYPE_TEXT, 'Region'),
            new Head('adresse', Head::TYPE_TEXT,'Address'),
            new Head('gps', Head::TYPE_TEXT, 'Gps'),
            new Head('ville', Head::TYPE_TEXT, 'Ville'),
        ];
        $collection = ModelTarget::all();
        return view('crud.ferme.index', compact(['actions', 'heads', 'collection']));
    }

    public function create()
    {
        return view('crud.ferme.create');
    }

    public function show(Request $request, $id)
    {
        $model = ModelTarget::query()->where(ModelTarget::PK, $id)->firstOrFail();
        
        $parcelles=Parcelle::query()
        ->join('typesols', 'typesols.idTS', 'parcelles.typeSol')
        ->where('parcelles.Ferme', $id)
        ->select('parcelles.*', 'typesols.vernaculaure as typeSol')->get();

        $typesols = Typesol::query()
            ->select('typesols.*', 'fermes.idF as laravel_through_key')
            ->join('fermes', 'typesols.ferme', 'fermes.idF')
            ->where('fermes.idF', $id)
            ->get();

        $actions = [
            new Action(ucwords('Ajouter nouveau'), Action::TYPE_NORMAL, url: route('parcelles.create', [
                'id_ferme' => $model[ModelTarget::PK],
                'back' => url()->current()
            ])),
            new Action(ucwords('supprimer les selctionner'), Action::TYPE_DELETE_ALL, url: route('parcelles.destroyGroup'))
        ];
        $actions2 = [
            new Action(ucwords('Ajouter nouveau'), Action::TYPE_NORMAL, url: route('typesols.create',
             [
                'id_ferme' => $model[ModelTarget::PK],
                'back' => url()->current()
            ])),
            new Action(ucwords('supprimer les selctionner'), Action::TYPE_DELETE_ALL, url: route('typesols.destroyGroup'))
        ];
        $heads = [
            new Head('codification', Head::TYPE_TEXT,'Codification'),
            new Head('superficie', Head::TYPE_TEXT, 'Superficie'),
            new Head('modeCulture', Head::TYPE_OPTIONS, 'Mode Culture', [
                'S' => 'Simple',
                'M' => 'Mixte',
                'E' => 'Mixte',
            ]),
            new Head('topographie', Head::TYPE_TEXT, 'Topographie'),
            new Head('pente', Head::TYPE_TEXT, 'Pente'),
            new Head('pierosite', Head::TYPE_TEXT,'Pierosite'),
            new Head('gps', Head::TYPE_TEXT, 'Gps'),
            new Head('description', Head::TYPE_TEXT,'Description'),
            new Head('typeSol', Head::TYPE_TEXT, 'TypeSol'),
        ];
        $heads2 = [
            new Head('vernaculaure', Head::TYPE_TEXT, 'Vernaculaure'),
            new Head('nomDomaine', Head::TYPE_TEXT, 'Nom de Ferme'),
            new Head('teneurArgile', Head::TYPE_TEXT, 'Teneur Argile'),
            new Head('teneurLimon', Head::TYPE_TEXT, 'Teneur Limon'),
            new Head('teneurSable', Head::TYPE_TEXT, 'Teneur Sable'),
            new Head('teneurPhosphore', Head::TYPE_TEXT,'Teneur Phosphore'),
            new Head('teneurPotassiume', Head::TYPE_TEXT, 'Teneur Potassiume'),
            new Head('teneurAzote', Head::TYPE_TEXT, 'TeneurAzote'),
            new Head('calcaireActif', Head::TYPE_TEXT, 'Calcaire Actif'),
            new Head('calcaireTotal', Head::TYPE_TEXT, 'Calcaire Total'),
            new Head('conductiviteElectrique', Head::TYPE_TEXT, 'conductive Electrique'),
            new Head('HCC', Head::TYPE_TEXT, 'Humidité à la capacité au champ'),
            new Head('HPF', Head::TYPE_TEXT, 'Humidité Point de Filtration'),
            new Head('DA', Head::TYPE_TEXT, 'Densité Apparente'),
        ];
        return view('crud.ferme.edit', compact('model', 'heads', 'actions', 'typesols','parcelles', 'heads2', 'actions2'));
    }

    public function destroyGroup(Request $request)
    {
       
        $ids = $request['ids'] ?? [];
       
        foreach ($ids as $id) {
            $client = ModelTarget::query()->findOrFail($id);
            $client?->delete();
        }
        $this->success(trans('messages.deleted_message'));
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        ModelTarget::query()->findOrFail($id)->delete();
        $this->success(trans('messages.deleted_message'));
        return redirect(Route('fermes.index'));
    }

    public function store(FermesAdd $request)
    {
        $validated = $request->validated();
        $logo = $request->validated()['logo'] ?? null;
        unset($validated['logo']);

        if($logo === null){
            $validated['logo'] = asset('assets\media\default\image-placeholder.png');
            $model = ModelTarget::query()->create($validated);
        }else{
            $model = ModelTarget::query()->create($validated);

            $model->update([
                'logo' => $this->saveFile('fermes',$logo)
            ]);
        }

        $this->success(trans('messages.added_message'));
        return redirect(route('fermes.show', $model[ModelTarget::PK]));
    }

    public function update(Update $request, $id)
    {
        $data = ModelTarget::query()->findOrFail($id);
        $validated = $request->validated();
        // dd($request);

        $validated = $request->validated();
        unset($validated['logo']);

        $this->saveAndDeleteOld($request->validated()['logo'] ?? null, 'fermes', $data, 'logo');
        $data->update($validated);
    

        $this->success(trans('messages.updated_message'));
        return back();
    }
}

