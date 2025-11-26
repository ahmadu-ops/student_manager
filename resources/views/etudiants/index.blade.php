@extends('layouts.app')

@section('title', 'Gestion des Étudiants')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Gestion des Étudiants</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $etudiants->total() }} étudiant(s) enregistré(s)</p>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Nouvel Étudiant
        </a>
    </div>
</div>

<!-- Recherche avancée -->
<div class="card mb-6">
    <div class="card-header bg-gray-50 cursor-pointer" onclick="toggleSearch()">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-700 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                Recherche avancée
                @if(request()->hasAny(['nom', 'email', 'filiere_id', 'date_debut', 'date_fin']))
                    <span class="ml-2 badge badge-primary">Filtres actifs</span>
                @endif
            </h3>
            <svg id="search-chevron" class="w-5 h-5 text-gray-500 transform transition-transform {{ request()->hasAny(['nom', 'email', 'filiere_id', 'date_debut', 'date_fin']) ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
    <div id="search-form" class="card-body {{ request()->hasAny(['nom', 'email', 'filiere_id', 'date_debut', 'date_fin']) ? '' : 'hidden' }}">
        <form action="{{ route('etudiants.index') }}" method="GET">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label for="search-nom" class="form-label">Nom</label>
                    <input type="text" 
                           id="search-nom" 
                           name="nom" 
                           value="{{ request('nom') }}"
                           class="form-input"
                           placeholder="Rechercher par nom...">
                </div>
                
                <div>
                    <label for="search-email" class="form-label">Email</label>
                    <input type="text" 
                           id="search-email" 
                           name="email" 
                           value="{{ request('email') }}"
                           class="form-input"
                           placeholder="Rechercher par email...">
                </div>
                
                <div>
                    <label for="search-filiere" class="form-label">Filière</label>
                    <select id="search-filiere" name="filiere_id" class="form-select">
                        <option value="">Toutes les filières</option>
                        @foreach($filieres as $filiere)
                            <option value="{{ $filiere->id }}" {{ request('filiere_id') == $filiere->id ? 'selected' : '' }}>
                                {{ $filiere->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="search-date-debut" class="form-label">Né après le</label>
                    <input type="date" 
                           id="search-date-debut" 
                           name="date_debut" 
                           value="{{ request('date_debut') }}"
                           class="form-input">
                </div>
                
                <div>
                    <label for="search-date-fin" class="form-label">Né avant le</label>
                    <input type="date" 
                           id="search-date-fin" 
                           name="date_fin" 
                           value="{{ request('date_fin') }}"
                           class="form-input">
                </div>
            </div>
            
            <div class="flex items-center justify-end space-x-3 mt-4 pt-4 border-t border-gray-200">
                <a href="{{ route('etudiants.index') }}" class="btn btn-secondary btn-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Réinitialiser
                </a>
                <button type="submit" class="btn btn-primary btn-sm">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Rechercher
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Liste des étudiants -->
<div class="card">
    <div class="card-body p-0">
        @if($etudiants->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Étudiant</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Date de naissance</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Filière</th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($etudiants as $etudiant)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center">
                                            <span class="text-white font-bold text-sm">{{ strtoupper(substr($etudiant->nom, 0, 2)) }}</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $etudiant->nom }}</div>
                                            <div class="text-xs text-gray-500">ID: #{{ $etudiant->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="mailto:{{ $etudiant->email }}" class="text-sm text-primary-600 hover:text-primary-800 hover:underline">
                                        {{ $etudiant->email }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-sm text-gray-900">{{ $etudiant->date_naissance->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $etudiant->date_naissance->age }} ans</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="badge badge-primary">
                                        {{ $etudiant->filiere->nom }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <form action="{{ route('etudiants.destroy', $etudiant) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-all duration-200"
                                                title="Supprimer cet étudiant">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($etudiants->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $etudiants->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Aucun étudiant trouvé</h3>
                <p class="mt-2 text-sm text-gray-500">
                    @if(request()->hasAny(['nom', 'email', 'filiere_id', 'date_debut', 'date_fin']))
                        Aucun résultat ne correspond à vos critères de recherche.
                    @else
                        Commencez par ajouter votre premier étudiant.
                    @endif
                </p>
                <div class="mt-4 flex justify-center space-x-3">
                    @if(request()->hasAny(['nom', 'email', 'filiere_id', 'date_debut', 'date_fin']))
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Effacer les filtres
                        </a>
                    @endif
                    <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Ajouter un étudiant
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleSearch() {
        const form = document.getElementById('search-form');
        const chevron = document.getElementById('search-chevron');
        
        form.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }
</script>
@endpush