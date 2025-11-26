@extends('layouts.app')

@section('title', 'Nouvel Étudiant')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Breadcrumb -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <a href="{{ route('etudiants.index') }}" class="ml-1 text-gray-500 hover:text-primary-600">Étudiants</a>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ml-1 text-gray-700 font-medium">Nouveau</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Alerte si pas de filières -->
    @if($filieres->count() == 0)
        <div class="bg-amber-50 border border-amber-200 rounded-xl p-6 mb-6">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-amber-800">Action requise</h3>
                    <p class="mt-1 text-sm text-amber-700">
                        Vous devez créer au moins une filière avant d'ajouter un étudiant.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('filieres.create') }}" class="btn bg-amber-600 text-white hover:bg-amber-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Créer une filière
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Form Card -->
        <div class="card">
            <div class="card-header bg-gradient-to-r from-primary-600 to-primary-700">
                <h2 class="text-xl font-semibold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Nouvel Étudiant
                </h2>
                <p class="text-primary-100 text-sm mt-1">Remplissez les informations de l'étudiant</p>
            </div>
            
            <div class="card-body">
                <form action="{{ route('etudiants.store') }}" method="POST">
                    @csrf
                    
                    <!-- Section Informations personnelles -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">1</span>
                            Informations personnelles
                        </h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pl-11">
                            <!-- Nom -->
                            <div>
                                <label for="nom" class="form-label">
                                    Nom complet <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input type="text" 
                                           id="nom" 
                                           name="nom" 
                                           value="{{ old('nom') }}"
                                           class="form-input pl-10 @error('nom') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                           placeholder="Prénom et nom"
                                           required
                                           autofocus>
                                </div>
                                @error('nom')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="form-label">
                                    Adresse email <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="email" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email') }}"
                                           class="form-input pl-10 @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                           placeholder="etudiant@email.com"
                                           required>
                                </div>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Date de naissance -->
                            <div>
                                <label for="date_naissance" class="form-label">
                                    Date de naissance <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input type="date" 
                                           id="date_naissance" 
                                           name="date_naissance" 
                                           value="{{ old('date_naissance') }}"
                                           max="{{ date('Y-m-d') }}"
                                           class="form-input pl-10 @error('date_naissance') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                           required>
                                </div>
                                @error('date_naissance')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">La date doit être antérieure à aujourd'hui</p>
                            </div>
                        </div>
                    </div>

                    <!-- Section Formation -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <span class="bg-primary-100 text-primary-700 w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold mr-3">2</span>
                            Formation
                        </h3>
                        
                        <div class="pl-11">
                            <!-- Filière -->
                            <div class="max-w-md">
                                <label for="filiere_id" class="form-label">
                                    Filière <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                        </svg>
                                    </div>
                                    <select id="filiere_id" 
                                            name="filiere_id" 
                                            class="form-select pl-10 @error('filiere_id') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                                            required>
                                        <option value="">-- Sélectionner une filière --</option>
                                        @foreach($filieres as $filiere)
                                            <option value="{{ $filiere->id }}" 
                                                    {{ old('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                                {{ $filiere->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('filiere_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Aperçu des filières disponibles -->
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 mb-2">Filières disponibles :</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($filieres as $filiere)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700 cursor-pointer hover:bg-primary-100 hover:text-primary-700 transition-colors"
                                              onclick="document.getElementById('filiere_id').value = '{{ $filiere->id }}'">
                                            {{ $filiere->nom }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Récapitulatif (dynamique) -->
                    <div class="mb-8 bg-gray-50 rounded-xl p-6" id="recap-section" style="display: none;">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Récapitulatif
                        </h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Nom :</span>
                                <span class="font-medium text-gray-900 ml-2" id="recap-nom">-</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Email :</span>
                                <span class="font-medium text-gray-900 ml-2" id="recap-email">-</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Date de naissance :</span>
                                <span class="font-medium text-gray-900 ml-2" id="recap-date">-</span>
                            </div>
                            <div>
                                <span class="text-gray-500">Filière :</span>
                                <span class="font-medium text-gray-900 ml-2" id="recap-filiere">-</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Retour à la liste
                        </a>
                        
                        <div class="flex items-center space-x-3">
                            <button type="reset" class="btn btn-secondary" onclick="resetRecap()">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Réinitialiser
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Enregistrer l'étudiant
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Aide -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-xl p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Besoin d'aide ?</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Tous les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires</li>
                            <li>L'email doit être unique pour chaque étudiant</li>
                            <li>Cliquez sur une filière dans la liste pour la sélectionner rapidement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    // Mise à jour du récapitulatif en temps réel
    document.addEventListener('DOMContentLoaded', function() {
        const nomInput = document.getElementById('nom');
        const emailInput = document.getElementById('email');
        const dateInput = document.getElementById('date_naissance');
        const filiereSelect = document.getElementById('filiere_id');
        const recapSection = document.getElementById('recap-section');
        
        function updateRecap() {
            const nom = nomInput?.value || '';
            const email = emailInput?.value || '';
            const date = dateInput?.value || '';
            const filiere = filiereSelect?.options[filiereSelect.selectedIndex]?.text || '';
            
            // Afficher le récapitulatif si au moins un champ est rempli
            if (nom || email || date || (filiereSelect?.value)) {
                recapSection.style.display = 'block';
            } else {
                recapSection.style.display = 'none';
            }
            
            document.getElementById('recap-nom').textContent = nom || '-';
            document.getElementById('recap-email').textContent = email || '-';
            document.getElementById('recap-date').textContent = date ? formatDate(date) : '-';
            document.getElementById('recap-filiere').textContent = filiereSelect?.value ? filiere : '-';
        }
        
        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            });
        }
        
        // Écouter les changements
        nomInput?.addEventListener('input', updateRecap);
        emailInput?.addEventListener('input', updateRecap);
        dateInput?.addEventListener('change', updateRecap);
        filiereSelect?.addEventListener('change', updateRecap);
        
        // Initialiser
        updateRecap();
    });
    
    function resetRecap() {
        document.getElementById('recap-section').style.display = 'none';
        document.getElementById('recap-nom').textContent = '-';
        document.getElementById('recap-email').textContent = '-';
        document.getElementById('recap-date').textContent = '-';
        document.getElementById('recap-filiere').textContent = '-';
    }
</script>
@endpush