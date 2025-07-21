@extends('layout.base')
@section('title', 'Ajouter une excursion')

@section('content')

    <div class="container-fluid relative px-3">
        <div class="layout-specing">
            <!-- Start Content -->
            <div class="md:flex justify-between items-center">
                <h5 class="text-lg font-semibold">Ajouter une nouvelle excursion</h5>

                <ul class="tracking-[0.5px] inline-block sm:mt-0 mt-3">
                    <li class="inline-block capitalize text-[16px] font-medium duration-500 hover:text-green-600"><a href="{{ route('partenaire.dashboard') }}">Afrique évasion</a></li>
                    <li class="inline-block text-base text-slate-950 mx-0.5 ltr:rotate-0 rtl:rotate-180"><i class="mdi mdi-chevron-right"></i></li>
                    <li class="inline-block capitalize text-[16px] font-medium text-green-600" aria-current="page">Excursion</li>
                </ul>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="bg-red-100 text-red-800 px-4 py-2 rounded mb-4">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('partenaire.add.excursion.store') }}" method="POST" enctype="multipart/form-data">
            {{-- <form action=""> --}}
                @csrf
                <div class="container relative">
                    <div class="grid md:grid-cols-1 grid-cols-1 gap-6 mt-6">
                        <!-- Section Images -->
                        <div class="rounded-md shadow p-6 bg-white h-fit mb-5">
                            <div>
                                <p class="font-medium mb-4">Téléchargez les images de votre excursion (max 10 images, 10MB chacune, JPG/PNG)</p>
                                <div id="preview-box" class="preview-box flex flex-wrap gap-4 overflow-x-auto max-h-60 bg-gray-50 p-4 rounded-md shadow-inner text-center text-slate-400">
                                    Supports JPG et PNG. Taille max : 10MB.
                                </div>
                                <input type="file" id="input-file" name="images[]" accept="image/jpeg,image/png" multiple class="hidden" onchange="handleImageChange()">
                                <label for="input-file" class="btn-upload btn bg-green-600 hover:bg-green-700 border-green-600 hover:border-green-700 text-white rounded-md mt-6 cursor-pointer inline-block">
                                    Ajouter des images
                                </label>
                                <div id="image-errors" class="text-red-600 text-sm mt-2"></div>
                                @error('images.*')
                                    <span class="text-red-600 text-sm block mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Autres champs -->
                        <div class="rounded-md shadow p-6 bg-white h-fit mb-5">
                            <div class="grid grid-cols-12 gap-5">

                                <!-- Titre -->
                                <div class="col-span-12">
                                    <label for="titre" class="font-medium">Titre de l'excursion :</label>
                                    <input name="titre" id="titre" type="text" class="form-input mt-2 @error('titre') border-red-500 @enderror" placeholder="Titre de l'excursion" value="{{ old('titre') }}" required>
                                    @error('titre') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Description -->
                                <div class="col-span-12">
                                    <label for="description" class="font-medium">Description :</label>
                                    <textarea name="description" id="description" class="form-input mt-2 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                                    @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Date / Heure -->
                                <div class="col-span-6">
                                    <label for="date" class="font-medium">Date de l'excursion :</label>
                                    <input name="date" id="date" type="date" class="form-input mt-2 @error('date') border-red-500 @enderror" value="{{ old('date') }}">
                                    @error('date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="heure_debut" class="font-medium">Heure de début :</label>
                                    <input name="heure_debut" id="heure_debut" type="time" class="form-input mt-2 @error('heure_debut') border-red-500 @enderror" value="{{ old('heure_debut') }}">
                                    @error('heure_debut') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Durée -->
                                <div class="col-span-6">
                                    <label for="duree" class="font-medium">Durée (en heures) :</label>
                                    <input name="duree" id="duree" type="number" step="0.1" min="0.5" max="24" class="form-input mt-2 @error('duree') border-red-500 @enderror" value="{{ old('duree') }}" required>
                                    @error('duree') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Prix / Devise -->
                                <div class="col-span-6">
                                    <label for="prix" class="font-medium">Prix par personne :</label>
                                    <input name="prix" id="prix" type="number" step="0.01" min="0" class="form-input mt-2 @error('prix') border-red-500 @enderror" value="{{ old('prix') }}" required>
                                    @error('prix') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="devise" class="font-medium">Devise :</label>
                                    <select name="devise" id="devise" class="form-input mt-2 @error('devise') border-red-500 @enderror" required>
                                        @foreach(['CFA', 'EUR', 'USD', 'GBP', 'CAD', 'AUD'] as $dev)
                                            <option value="{{ $dev }}" {{ old('devise') == $dev ? 'selected' : '' }}>{{ $dev }}</option>
                                        @endforeach
                                    </select>
                                    @error('devise') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Capacité -->
                                <div class="col-span-6">
                                    <label for="capacite_max" class="font-medium">Capacité maximale :</label>
                                    <input name="capacite_max" id="capacite_max" type="number" min="1" class="form-input mt-2 @error('capacite_max') border-red-500 @enderror" value="{{ old('capacite_max', 1) }}" required>
                                    @error('capacite_max') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Localisation -->
                                <div class="col-span-6"><label for="ville" class="font-medium">Ville :</label>
                                    <input name="ville" id="ville" type="text" class="form-input mt-2 @error('ville') border-red-500 @enderror"  value="{{ old('ville') }}" readonly>
                                    @error('ville') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6"><label for="pays" class="font-medium">Pays :</label>
                                    <input name="pays" id="pays" type="text" class="form-input mt-2 @error('pays') border-red-500 @enderror" value="{{ old('pays') }}" readonly>
                                    @error('pays') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="adresse" class="font-medium">Adresse (point de départ) :</label>
                                    <input name="adresse" id="adresse" type="text" class="form-input mt-2 @error('adresse') border-red-500 @enderror" value="{{ old('adresse') }}" readonly>
                                    @error('adresse') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-3">
                                    <label for="latitude" class="font-medium">Latitude :</label>
                                    <input name="latitude" id="latitude" type="number" step="0.000001" class="form-input mt-2 @error('latitude') border-red-500 @enderror" value="{{ old('latitude') }}" required readonly>
                                    @error('latitude') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-span-3">
                                    <label for="longitude" class="font-medium">Longitude :</label>
                                    <input name="longitude" id="longitude" type="number" step="0.000001" class="form-input mt-2 @error('longitude') border-red-500 @enderror" value="{{ old('longitude') }}" required readonly>
                                    @error('longitude') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                                </div>

                                <!-- Bouton Carte -->
                                <div class="col-span-12">
                                    <button type="button" onclick="openMapPopup()" class="btn bg-green-600 text-white rounded-md px-4 py-2 mt-2">
                                        Ajouter ma localisation
                                    </button>
                                </div>

                                <!-- Équipements -->
                                <div class="col-span-12">
                                    <label class="font-medium">Équipements inclus :</label>
                                    <div class="mt-2">
                                        @foreach($equipements as $equipement)
                                            <label class="inline-flex items-center mr-4">
                                                <input type="checkbox" name="equipements[]" value="{{ $equipement->idEquipement }}" class="form-checkbox" {{ in_array($equipement->idEquipement, old('equipements', [])) ? 'checked' : '' }}>
                                                <span class="ml-2">{{ $equipement->nom }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Téléphones -->
                                <div class="col-span-12">
                                    <label class="font-semibold block mb-2">Numéros de téléphone :</label>
                                    <div id="telephones-container">
                                        <div class="grid grid-cols-12 gap-2 mb-2">
                                            <div class="col-span-4">
                                                <input name="telephones[0][numero]" type="text" class="form-input" placeholder="+2250700000000" value="{{ old('telephones.0.numero') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="add-telephone" class="btn bg-white text-gray-800 border border-gray-300 hover:bg-gray-100 rounded-md mt-2">
                                        Ajouter un numéro
                                    </button>
                                </div>

                                {{-- 🎯 NOUVEAUX CHAMPS ICI --}}
                                {{-- @include('client.partials.excursion_extras') --}}

                                <!-- Boutons -->
                                <div class="col-span-12 flex justify-end space-x-4 mt-6">
                                    <a href="{{ route('partenaire.dashboard') }}" class="btn bg-gray-500 hover:bg-gray-600 text-white rounded-md px-4 py-2">Annuler</a>
                                    <button type="submit" class="btn bg-green-600 hover:bg-green-700 text-white rounded-md px-4 py-2">Ajouter l'excursion</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
    </div>
</div>

@push('scripts')
    <script>
    const selectedFiles = [];
    const maxImages = 10;
    const maxSize = 10 * 1024 * 1024; // 10MB
    const previewBox = document.getElementById('preview-box');
    const inputFile = document.getElementById('input-file');
    const errorContainer = document.getElementById('image-errors');

    function handleImageChange() {
        const newFiles = Array.from(inputFile.files);
        const currentCount = selectedFiles.length;
        const errors = [];

        // Valider chaque fichier individuellement
        const validFiles = newFiles.filter(file => {
            if (selectedFiles.some(f => f.name === file.name && f.size === file.size)) {
                errors.push(`Le fichier "${file.name}" est déjà sélectionné.`);
                return false;
            }
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                errors.push(`Le fichier "${file.name}" doit être au format JPG ou PNG.`);
                return false;
            }
            if (file.size > maxSize) {
                errors.push(`Le fichier "${file.name}" dépasse la taille maximale de 10MB.`);
                return false;
            }
            return true;
        });

        // Vérifier la limite totale
        if (currentCount + validFiles.length > maxImages) {
            const allowedCount = maxImages - currentCount;
            if (allowedCount > 0) {
                validFiles.splice(allowedCount);
                errors.push(`Seules les ${allowedCount} premières images valides ont été ajoutées (limite de ${maxImages} images).`);
            } else {
                errors.push(`La limite de ${maxImages} images est atteinte.`);
                validFiles.length = 0;
            }
        }

        // Afficher les erreurs
        displayErrors(errors);

        // Ajouter les fichiers valides
        validFiles.forEach(file => {
            selectedFiles.push(file);
            addImageToPreview(file);
        });

        updateInputFiles();
        inputFile.value = '';
    }

    function addImageToPreview(file) {
        if (selectedFiles.length === 1 && previewBox.children.length === 0) {
            previewBox.innerHTML = '';
        }

        const wrapper = document.createElement('div');
        wrapper.className = 'relative rounded border border-gray-300 p-1 bg-white shadow max-w-[150px] image-preview';
        wrapper.dataset.index = selectedFiles.length - 1;

        const deleteBtn = document.createElement('button');
        deleteBtn.innerHTML = '✕';
        deleteBtn.className = 'absolute top-1 left-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs hover:bg-red-600';
        deleteBtn.type = 'button';

        const img = document.createElement('img');
        img.className = 'w-full h-auto object-cover rounded';
        img.src = URL.createObjectURL(file);
        img.onload = () => URL.revokeObjectURL(img.src);

        if (selectedFiles.length === 1 && previewBox.children.length === 0) {
            const principalBadge = document.createElement('span');
            principalBadge.className = 'absolute bottom-0 left-0 bg-green-600 text-white text-xs px-2 py-1 rounded principal-badge';
            principalBadge.textContent = 'Principale';
            wrapper.appendChild(principalBadge);
        }

        wrapper.appendChild(deleteBtn);
        wrapper.appendChild(img);
        previewBox.appendChild(wrapper);

        deleteBtn.addEventListener('click', () => {
            const index = parseInt(wrapper.dataset.index);
            selectedFiles.splice(index, 1);
            wrapper.remove();

            updatePreviewIndices();
            updatePrincipalBadge();

            if (selectedFiles.length === 0 && previewBox.children.length === 0) {
                previewBox.innerHTML = 'Supports JPG et PNG. Taille max : 10MB.';
            }

            updateInputFiles();
        });

        updatePrincipalBadge();
    }

    function updatePreviewIndices() {
        const wrappers = previewBox.querySelectorAll('.image-preview');
        wrappers.forEach((wrapper, index) => {
            wrapper.dataset.index = index;
        });
    }

    function updatePrincipalBadge() {
        previewBox.querySelectorAll('.principal-badge').forEach(badge => badge.remove());
        const firstWrapper = previewBox.querySelector('.image-preview');
        if (firstWrapper) {
            const principalBadge = document.createElement('span');
            principalBadge.className = 'absolute bottom-0 left-0 bg-green-600 text-white text-xs px-2 py-1 rounded principal-badge';
            principalBadge.textContent = 'Principale';
            firstWrapper.appendChild(principalBadge);
        }
    }

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        inputFile.files = dataTransfer.files;
        console.log('Input files updated:', inputFile.files);
    }

    function displayErrors(errors) {
        errorContainer.innerHTML = '';
        if (errors.length > 0) {
            const ul = document.createElement('ul');
            ul.className = 'list-disc pl-5';
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                ul.appendChild(li);
            });
            errorContainer.appendChild(ul);
        }
    }

    // Validation côté client
    document.querySelector('form').addEventListener('submit', function (e) {
        const errors = [];
        const today = new Date().toISOString().split('T')[0];
        const dateExcursion = document.getElementById('date').value;
        const heureDebut = document.getElementById('heure_debut').value;
        const duree = parseFloat(document.getElementById('duree').value);
        const capaciteMax = parseInt(document.getElementById('capacite_max').value);

        if (dateExcursion && dateExcursion < today) {
            errors.push("La date de l'excursion doit être aujourd'hui ou postérieure.");
        }

        if (heureDebut && dateExcursion === today) {
            const now = new Date();
            const currentTime = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
            if (heureDebut < currentTime) {
                errors.push("L'heure de début doit être postérieure à l'heure actuelle pour une excursion aujourd'hui.");
            }
        }

        if (duree > 24) {
            errors.push("La durée ne peut pas dépasser 24 heures.");
        }

        if (capaciteMax < 1) {
            errors.push("La capacité maximale doit être d'au moins 1 personne.");
        }

        if (errors.length > 0) {
            e.preventDefault();
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-600 text-sm mb-4';
            const ul = document.createElement('ul');
            ul.className = 'list-disc pl-5';
            errors.forEach(error => {
                const li = document.createElement('li');
                li.textContent = error;
                ul.appendChild(li);
            });
            errorDiv.appendChild(ul);
            const form = e.target;
            if (!form.querySelector('.form-errors')) {
                const errorContainer = document.createElement('div');
                errorContainer.className = 'form-errors';
                form.prepend(errorContainer);
            }
            form.querySelector('.form-errors').innerHTML = '';
            form.querySelector('.form-errors').appendChild(errorDiv);
        }
    });

    let telephoneIndex = 1;

        document.getElementById('add-telephone').addEventListener('click', function () {
            const container = document.getElementById('telephones-container');

            const newBlock = document.createElement('div');
            newBlock.className = 'grid grid-cols-12 gap-2 mb-2';
            newBlock.innerHTML = `
                <div class="md:col-span-4 col-span-12">
                    <input name="telephones[${telephoneIndex}][numero]" type="text" class="form-input" placeholder="+2250700000000">
                </div>
                <div class="md:col-span-3 col-span-4">
                    <button type="button" class="remove-block btn text-red-600 border border-red-300 hover:bg-red-50 rounded-md px-2 py-1 w-full">
                        Retirer
                    </button>
                </div>
            `;

            container.appendChild(newBlock);
            telephoneIndex++;
        });

        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-block')) {
                e.target.closest('.grid').remove();
            }
        });

    function openMapPopup() {
        const width = 600;
        const height = 500;
        const left = (screen.width / 2) - (width / 2);
        const top = (screen.height / 2) - (height / 2);

        const mapWindow = window.open(
            "/partenaire/localisation-popup", // à créer dans Laravel
            "Localisation",
            `width=${width},height=${height},top=${top},left=${left}`
        );
        window.addEventListener('message', function (event) {
            if (event.origin !== window.location.origin) return;

            const { latitude, longitude, adresse, ville, pays } = event.data;

            console.log("📦 Données reçues :", event.data); // 👀 ici tu verras tout

            // Assure-toi que latitude/longitude sont bien définies
            if (latitude !== undefined && longitude !== undefined) {
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            }

            if (adresse) document.getElementById('adresse').value = adresse;
            if (ville) document.getElementById('ville').value = ville;
            if (pays) document.getElementById('pays').value = pays;
        });

        // Recevoir la position depuis la popup
        window.addEventListener('message', function (event) {
            if (event.origin !== window.location.origin) return;

            const { latitude, longitude, adresse, ville, pays } = event.data;
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;
            document.getElementById('adresse').value = adresse;
            document.getElementById('ville').value = ville;
            document.getElementById('pays').value = pays;
        }, false);
    }
    </script>
@endpush
@endsection
