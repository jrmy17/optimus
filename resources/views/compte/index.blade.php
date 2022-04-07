@extends('layouts.app')

@section('title', 'Accueil')


@section('content')
    <div class="flex flex-nowrap">
        @foreach ($comptes as $compte)
            <a href="{{ route('compte.dashboard', $compte->id) }}">
                <div class="mr-4 shadow rounded-xl w-[200px] h-[200px] bg-slate-50 hover:bg-slate-200 transition-all p-3 flex flex-col justify-between">
                    <p class="text-lg font-bold"> {{ $compte->intitule }}</p>
                    <p class="text-cyan-600 self-end">Accéder ➟</p>
                </div>
            </a>
        @endforeach

        <a href="{{ route('compte.create') }}">
            <div class="shadow rounded-xl w-[200px] h-[200px] bg-slate-50 hover:bg-slate-200 p-3 flex justify-center items-center">
                <p class="text-cyan-600 text-5xl">+</p>
            </div>
        </a>
    </div>
@endsection
