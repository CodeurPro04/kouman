<?php

namespace App\Http\Controllers\Excursion;


use App\Models\Equipement;
use App\Models\Excursion;
use App\Models\ImageExcursion;
use App\Models\Localisation;
use App\Models\ExcursionDate;
use App\Models\Localisations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class ExcursionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:partenaire');
    }

     public function index()
    {
        $excursions = Excursion::with(['partenaire', 'localisation', 'avisClients'])->latest()->get();
        $serviceIds = $excursions->flatMap(function ($excursion) {
            return $excursion->avisClients->pluck('service_id');
        })->unique()->values();
        return view('screens.add.excursion.excursion-list', compact('excursions'));
    }

    public function createExcursion()
    {
        $equipements = Equipement::whereIn('type', ['excursion', 'inclus', 'optionnel'])->orWhereNull('type')->get();
        $localisations = Localisations::all();
        return view('screens.add.excursion.excursion-add', compact(
            'equipements',
            'localisations'
        ));
    }

    // public function storeExcursion(Request $request)
    // {
    //     $partenaire = Auth::guard('partenaire')->user();

    //     $validated = $request->validate([
    //         'titre' => [
    //             'required',
    //             'string',
    //             'max:150',
    //             Rule::unique('excursions')->where('id', $partenaire->idPartenaire),
    //         ],
    //         'description' => 'nullable|string',
    //         'date' => 'required|date|after_or_equal:today',
    //         'heure_debut' => [
    //             'nullable',
    //             'date_format:H:i',
    //             function ($attribute, $value, $fail) use ($request) {
    //                 if ($request->date === now()->toDateString() && $value < now()->format('H:i')) {
    //                     $fail("L'heure de début doit être postérieure à l'heure actuelle pour une excursion aujourd'hui.");
    //                 }
    //             },
    //         ],
    //         'duree' => 'required|numeric|min:0.5|max:24',
    //         'prix' => 'required|numeric|min:0',
    //         'devise' => 'required|in:CFA,EUR,USD,GBP,CAD,AUD',
    //         'capacite_max' => 'required|integer|min:1',
    //         'ville' => 'nullable|string|max:255',
    //         'pays' => 'nullable|string|max:255',
    //         'adresse' => 'nullable|string|max:255',
    //         'equipements' => 'nullable|array',
    //         'equipements.*' => 'exists:equipements,idEquipement',
    //         'images.*' => 'nullable|image|mimes:jpeg,png|max:10240',
    //         'itineraire' => 'nullable|string',
    //         'nom_guide' => 'nullable|string|max:150',
    //         'langues' => 'nullable|array',
    //         'langues.*' => 'string|max:50',
    //         'recurrence' => 'nullable|in:ponctuelle,quotidienne,hebdomadaire,mensuelle',
    //         'age_minimum' => 'nullable|integer|min:0',
    //         'conditions' => 'nullable|string',
    //         'paiements' => 'nullable|array',
    //         'paiements.*' => 'string|max:50',
    //     ]);

    //     $excursion = Excursion::create([
    //         'titre' => $validated['titre'],
    //         'description' => $validated['description'],
    //         'duree' => $validated['duree'],
    //         'prix' => $validated['prix'],
    //         'devise' => $validated['devise'],
    //         'capacite_max' => $validated['capacite_max'],
    //         'partenaire_id' => $partenaire->id,
    //         'statut' => 'brouillon',

    //         'itineraire' => $request->itineraire,
    //         'nom_guide' => $request->nom_guide,
    //         'langues' => $request->filled('langues') ? implode(',', $request->langues) : null,
    //         'recurrence' => $request->recurrence ?? 'ponctuelle',
    //         'age_minimum' => $request->age_minimum ?? 0,
    //         'conditions' => $request->conditions,
    //         'moyens_paiement' => $request->filled('paiements') ? implode(',', $request->paiements) : null,

    //     ]);

    //     $localisationData = array_filter([
    //         'ville' => $request->ville,
    //         'pays' => $request->pays,
    //         'adresse' => $request->adresse,
    //     ]);
    //     if (!empty($localisationData)) {
    //         $localisation = Localisations::create($localisationData);
    //         $excursion->localisation_id = $localisation->idLocalisation;
    //         $excursion->save();
    //     }

    //     ExcursionDate::create([
    //         'idExcursion' => $excursion->id,
    //         'date' => $request->date,
    //         'heure_debut' => $request->heure_debut,
    //         'places_disponibles' => $request->capacite_max,
    //     ]);

    //     if ($request->equipements) {
    //         $excursion->equipements()->attach($request->equipements);
    //     }

    //     if ($request->hasFile('images')) {
    //         $newImages = $request->file('images');
    //         if (count($newImages) > 10) {
    //             return back()->withErrors(['images' => 'Vous ne pouvez pas ajouter plus de 10 images.'])->withInput();
    //         }

    //         foreach ($newImages as $index => $image) {
    //             $path = $image->store('excursions', 'public');
    //             ImageExcursion::create([
    //                 'idExcursion' => $excursion->id,
    //                 'url' => $path,
    //                 'estPrincipale' => $index === 0,
    //             ]);
    //         }
    //     } else {
    //         Log::info('Aucune image reçue dans la requête.', ['files' => $request->allFiles()]);
    //     }

    //     return redirect()->route('partenaire.dashboard')
    //         ->with('success', 'Excursion ajoutée avec succès.');
    // }


    public function storeExcursion(Request $request)
    {
        $partenaire = Auth::guard('partenaire')->user();

        $validated = $request->validate([
            'titre' => [
                'required', 'string', 'max:150',
                Rule::unique('excursions')->where('id', $partenaire->idPartenaire),
            ],
            'description' => 'nullable|string',
            'date' => 'required|date|after_or_equal:today',
            'heure_debut' => [
                'nullable', 'date_format:H:i',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->date === now()->toDateString() && $value < now()->format('H:i')) {
                        $fail("L'heure de début doit être postérieure à l'heure actuelle pour une excursion aujourd'hui.");
                    }
                },
            ],
            'duree' => 'required|numeric|min:0.5|max:24',
            'prix' => 'required|numeric|min:0',
            'devise' => 'required|in:CFA,EUR,USD,GBP,CAD,AUD',
            'capacite_max' => 'required|integer|min:1',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'equipements' => 'nullable|array',
            'equipements.*' => 'exists:equipements,id',
            'images.*' => 'nullable|image|mimes:jpeg,png|max:10240',
            'itineraire' => 'nullable|string',
            'nom_guide' => 'nullable|string|max:150',
            'langues' => 'nullable|string',
            'langues.*' => 'string|max:50',
            'recurrence' => 'nullable|in:ponctuelle,quotidienne,hebdomadaire,mensuelle',
            'age_minimum' => 'nullable|integer|min:0',
            'conditions' => 'nullable|string',
            'paiements' => 'nullable|array',
            'paiements.*' => 'string|max:50',
            'moyens_paiement' => 'nullable|string',
        ]);

        $excursion = Excursion::create([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'duree' => $validated['duree'],
            'prix' => $validated['prix'],
            'devise' => $validated['devise'],
            'capacite_max' => $validated['capacite_max'],
            'partenaire_id' => $partenaire->id,
            'statut' => 'brouillon',
            'itineraire' => $request->itineraire,
            'nom_guide' => $request->nom_guide,
            'langues' => $request->filled('langues') ? implode(',', $request->langues) : null,
            'recurrence' => $request->recurrence ?? 'ponctuelle',
            'age_minimum' => $request->age_minimum ?? 0,
            'conditions' => $request->conditions,
            'moyens_paiement' => $request->filled('paiements') ? implode(',', $request->paiements) : null,
        ]);

        $localisationData = array_filter([
            'ville' => $request->ville,
            'pays' => $request->pays,
            'adresse' => $request->adresse,
        ]);
        if (!empty($localisationData)) {
            $localisation = Localisations::create($localisationData);
            $excursion->localisation_id = $localisation->idLocalisation;
            $excursion->save();
        }

        ExcursionDate::create([
            'idExcursion' => $excursion->id,
            'date' => $request->date,
            'heure_debut' => $request->heure_debut,
            'places_disponibles' => $request->capacite_max,
        ]);

        if ($request->equipements) {
            $excursion->equipements()->attach($request->equipements);
        }

        if ($request->hasFile('images')) {
            $newImages = $request->file('images');
            if (count($newImages) > 10) {
                return back()->withErrors(['images' => 'Vous ne pouvez pas ajouter plus de 10 images.'])->withInput();
            }

            foreach ($newImages as $index => $image) {
                $path = $image->store('excursions', 'public');
                ImageExcursion::create([
                    'idExcursion' => $excursion->id,
                    'url' => $path,
                    'estPrincipale' => $index === 0,
                ]);
            }
        } else {
            Log::info('Aucune image reçue dans la requête.', ['files' => $request->allFiles()]);
        }

        return redirect()->route('partenaire.excursion')->with('success', 'Excursion ajoutée avec succès.');
    }


    public function edit(Excursion $excursion)
    {
        // $this->authorize('update', $excursion); // facultatif

        $excursion = Excursion::with(['equipements', 'localisation'])->findOrFail($excursion->id);
        $equipements = Equipement::all();
        return view('partenaire.excursion-detail.edit', compact('excursion', 'equipements'));
    }



    public function update(Request $request, $id)
    {
        $excursion = Excursion::findOrFail($id);

        $validated = $request->validate([
            'titre' => [
                'required', 'string', 'max:150',
                Rule::unique('excursions')->ignore($id)
            ],
            'description' => 'nullable|string',
            'duree' => 'required|numeric|min:0.5|max:24',
            'prix' => 'required|numeric|min:0',
            'devise' => 'required|in:CFA,EUR,USD,GBP,CAD,AUD',
            'capacite_max' => 'required|integer|min:1',
            'ville' => 'nullable|string|max:255',
            'pays' => 'nullable|string|max:255',
            'adresse' => 'nullable|string|max:255',
            'itineraire' => 'nullable|string',
            'nom_guide' => 'nullable|string|max:150',
            'langues' => 'nullable|array',
            'langues.*' => 'string|max:50',
            'recurrence' => 'nullable|in:ponctuelle,quotidienne,hebdomadaire,mensuelle',
            'age_minimum' => 'nullable|integer|min:0',
            'conditions' => 'nullable|string',
            'paiements' => 'nullable|array',
            'paiements.*' => 'string|max:50',
            'equipements' => 'nullable|array',
            'equipements.*' => 'exists:equipements,idEquipement',
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:10240',
        ]);

        $excursion->update([
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'duree' => $validated['duree'],
            'prix' => $validated['prix'],
            'devise' => $validated['devise'],
            'capacite_max' => $validated['capacite_max'],
            'itineraire' => $request->itineraire,
            'nom_guide' => $request->nom_guide,
            'langues' => $request->filled('langues') ? implode(',', $request->langues) : null,
            'recurrence' => $request->recurrence ?? 'ponctuelle',
            'age_minimum' => $request->age_minimum ?? 0,
            'conditions' => $request->conditions,
            'moyens_paiement' => $request->filled('paiements') ? implode(',', $request->paiements) : null,
        ]);

        // Mise à jour localisation
        if ($excursion->localisation) {
            $excursion->localisation->update([
                'ville' => $request->ville,
                'pays' => $request->pays,
                'adresse' => $request->adresse,
            ]);
        }

        // Équipements
        $excursion->equipements()->sync($request->equipements ?? []);

        // Images supplémentaires
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('excursions', 'public');
                ImageExcursion::create([
                    'idExcursion' => $excursion->id,
                    'url' => $path,
                    'estPrincipale' => false,
                ]);
            }
        }

        return redirect()->route('partenaire.excursion')->with('success', 'Excursion mise à jour avec succès.');
    }


    public function destroy($id)
    {
        $excursion = Excursion::with('images')->findOrFail($id);

        // Supprimer les images du stockage
        foreach ($excursion->images as $image) {
            if (Storage::disk('public')->exists($image->url)) {
                Storage::disk('public')->delete($image->url);
            }
            $image->delete();
        }

        // Supprimer les relations (si contraintes manuelles)
        $excursion->equipements()->detach();
        $excursion->dates()->delete();

        $excursion->delete();

        return redirect()->route('partenaire.excursion')->with('success', 'Excursion supprimée avec succès.');
    }



}
