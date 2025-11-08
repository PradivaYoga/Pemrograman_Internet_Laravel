<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-10 text-center bg-gray-50 min-h-screen">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">
            Selamat datang, {{ Auth::user()->name }}!
        </h3>
        <p class="text-gray-600 mb-6">
            Anda login sebagai <strong class="text-gray-900">{{ ucfirst(Auth::user()->role) }}</strong>.
        </p>

        <div class="flex justify-center flex-wrap gap-4">
            @if (Auth::user()->role === 'admin')
                {{-- Tombol Admin --}}
                <a href="{{ route('fakultas.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                    Kelola Fakultas
                </a>

                <a href="{{ route('prodi.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                    Kelola Prodi
                </a>

                <a href="{{ route('mahasiswa.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                    Kelola Mahasiswa
                </a>
            @else
                {{-- Tombol User --}}
                <a href="{{ route('mahasiswa.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                    Lihat Data Mahasiswa
                </a>

                <a href="{{ route('prodi.index') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition-all duration-200">
                    Lihat Program Studi
                </a>
            @endif
        </div>

        {{-- Pesan Error --}}
        @if (session('error'))
            <p class="text-red-600 mt-5 font-semibold">
                {{ session('error') }}
            </p>
        @endif
    </div>
</x-app-layout>
