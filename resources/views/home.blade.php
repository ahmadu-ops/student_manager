@extends('layouts.app')

@section('title', 'Accueil - Student Manager')

@section('content')
<!-- Hero Section -->
<div class="mb-8">
    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-8 py-12 md:py-16">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="text-center md:text-left mb-6 md:mb-0">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                        Bienvenue sur Student Manager
                    </h1>
                    <p class="text-primary-100 text-lg max-w-xl">
                        Gérez facilement vos filières et étudiants avec notre plateforme intuitive et moderne.
                    </p>
                    <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center md:justify-start">
                        <a href="{{ route('etudiants.create') }}" class="btn btn-lg bg-white text-primary-600 hover:bg-primary-50">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                            </svg>
                            Nouvel Étudiant
                        </a>
                        <a href="{{ route('filieres.create') }}" class="btn btn-lg bg-primary-500 text-white hover:bg-primary-400 border border-primary-400">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Nouvelle Filière
                        </a>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <svg class="w-64 h-64 text-white/20" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        <path d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistiques principales -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Étudiants -->
    <div class="stat-card group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Étudiants</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_etudiants']) }}</p>
            </div>
            <div class="bg-primary-100 p-3 rounded-xl group-hover:bg-primary-200 transition-colors">
                <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-emerald-600 font-medium">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
                +{{ $stats['etudiants_ce_mois'] }}
            </span>
            <span class="text-gray-400 ml-2">ce mois</span>
        </div>
    </div>

    <!-- Total Filières -->
    <div class="stat-card group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Filières</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['total_filieres']) }}</p>
            </div>
            <div class="bg-emerald-100 p-3 rounded-xl group-hover:bg-emerald-200 transition-colors">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-500">
                Formations actives
            </span>
        </div>
    </div>

    <!-- Nouveaux ce mois -->
    <div class="stat-card group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Nouveaux ce mois</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ number_format($stats['etudiants_ce_mois']) }}</p>
            </div>
            <div class="bg-amber-100 p-3 rounded-xl group-hover:bg-amber-200 transition-colors">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-500">
                {{ now()->translatedFormat('F Y') }}
            </span>
        </div>
    </div>

    <!-- Âge Moyen -->
    <div class="stat-card group">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Âge Moyen</p>
                <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stats['age_moyen'] }} <span class="text-lg font-normal text-gray-500">ans</span></p>
            </div>
            <div class="bg-purple-100 p-3 rounded-xl group-hover:bg-purple-200 transition-colors">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-500">
                Moyenne des étudiants
            </span>
        </div>
    </div>
</div>

<!-- Section Graphiques et Détails -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Répartition par Filière -->
    <div class="lg:col-span-2 card">
        <div class="card-header flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">
                <svg class="w-5 h-5 inline mr-2 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                </svg>
                Répartition par Filière
            </h2>
            <a href="{{ route('filieres.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                Voir tout →
            </a>
        </div>
        <div class="card-body">
            @if($repartitionFilieres->count() > 0)
                <div class="space-y-4">
                    @foreach($repartitionFilieres as $filiere)
                        @php
                            $percentage = $stats['total_etudiants'] > 0 
                                ? round(($filiere->etudiants_count / $stats['total_etudiants']) * 100, 1) 
                                : 0;
                            $colors = ['bg-primary-500', 'bg-emerald-500', 'bg-amber-500', 'bg-purple-500', 'bg-pink-500', 'bg-cyan-500'];
                            $color = $colors[$loop->index % count($colors)];
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <span class="text-sm font-medium text-gray-700">{{ $filiere->nom }}</span>
                                <span class="text-sm text-gray-500">{{ $filiere->etudiants_count }} étudiants ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="{{ $color }} h-2.5 rounded-full transition-all duration-500" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="mt-2 text-gray-500">Aucune donnée disponible</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Répartition par Âge -->
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-semibold text-gray-900">
                <svg class="w-5 h-5 inline mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Tranches d'âge
            </h2>
        </div>
        <div class="card-body">
            <div class="space-y-3">
                @foreach($repartitionAge as $tranche => $count)
                    @php
                        $percentage = $stats['total_etudiants'] > 0 
                            ? round(($count / $stats['total_etudiants']) * 100, 1) 
                            : 0;
                    @endphp
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">{{ $tranche }}</span>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm text-gray-500">{{ $count }}</span>
                            <span class="badge badge-primary">{{ $percentage }}%</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Inscriptions par mois + Derniers étudiants -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Graphique des inscriptions -->
    <div class="card">
        <div class="card-header">
            <h2 class="text-lg font-semibold text-gray-900">
                <svg class="w-5 h-5 inline mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Inscriptions (6 derniers mois)
            </h2>
        </div>
        <div class="card-body">
            <div class="flex items-end justify-between h-48 space-x-2">
                @foreach($statsParMois as $stat)
                    @php
                        $maxCount = collect($statsParMois)->max('count') ?: 1;
                        $height = $stat['count'] > 0 ? max(($stat['count'] / $maxCount) * 100, 10) : 5;
                    @endphp
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full bg-primary-100 rounded-t-lg relative overflow-hidden" 
                             style="height: {{ $height }}%">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary-600 to-primary-400"></div>
                            <span class="absolute -top-6 left-1/2 transform -translate-x-1/2 text-xs font-bold text-gray-700">
                                {{ $stat['count'] }}
                            </span>
                        </div>
                        <span class="mt-2 text-xs text-gray-500 text-center">{{ $stat['mois'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Derniers étudiants inscrits -->
    <div class="card">
        <div class="card-header flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-900">
                <svg class="w-5 h-5 inline mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Dernières inscriptions
            </h2>
            <a href="{{ route('etudiants.index') }}" class="text-sm text-primary-600 hover:text-primary-700 font-medium">
                Voir tout →
            </a>
        </div>
        <div class="card-body">
            @if($derniersEtudiants->count() > 0)
                <div class="space-y-3">
                    @foreach($derniersEtudiants as $etudiant)
                        <div class="flex items-center p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-semibold text-sm">
                                        {{ strtoupper(substr($etudiant->nom, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-3 flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $etudiant->nom }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $etudiant->email }}</p>
                            </div>
                            <div class="flex-shrink-0">
                                <span class="badge badge-primary">{{ $etudiant->filiere->nom }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="mt-2 text-gray-500">Aucun étudiant inscrit</p>
                    <a href="{{ route('etudiants.create') }}" class="mt-3 btn btn-primary btn-sm inline-flex">
                        Ajouter un étudiant
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8 bg-gradient-to-r from-gray-50 to-gray-100 rounded-2xl p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('etudiants.create') }}" 
           class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="bg-primary-100 p-3 rounded-full mb-3">
                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Nouvel étudiant</span>
        </a>
        
        <a href="{{ route('filieres.create') }}" 
           class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="bg-emerald-100 p-3 rounded-full mb-3">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Nouvelle filière</span>
        </a>
        
        <a href="{{ route('etudiants.index') }}" 
           class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="bg-amber-100 p-3 rounded-full mb-3">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Rechercher</span>
        </a>
        
        <a href="{{ route('filieres.index') }}" 
           class="flex flex-col items-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
            <div class="bg-purple-100 p-3 rounded-full mb-3">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Liste filières</span>
        </a>
    </div>
</div>
@endsection