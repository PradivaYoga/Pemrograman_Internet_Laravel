<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 text-center">
        <h3>Selamat datang, {{ Auth::user()->name }}!</h3>
        <p>Anda login sebagai <strong>{{ Auth::user()->role }}</strong>.</p>

        @if (Auth::user()->role === 'admin')
            <p><a href="{{ route('fakultas.index') }}">Kelola Fakultas</a> | 
               <a href="{{ route('prodi.index') }}">Kelola Prodi</a></p>
        @else
            <p><a href="{{ route('mahasiswa.index') }}">Lihat Data Mahasiswa</a></p>
        @endif

        @if (session('error'))
            <p style="color:red;">{{ session('error') }}</p>
        @endif
    </div>
</x-app-layout>
