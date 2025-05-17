@extends('layouts.masterdash')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex items-center justify-between bg-blue-600 p-4 rounded-lg">
            <!-- Profil Guru -->
            <div class="flex items-center text-white space-x-3">
                <img src="{{ asset('src/images/fotonull.png') }}" alt="Avatar" class="h-10 w-10 rounded-full">
                <div>
                    <p class="font-semibold text-lg">Nama Guru</p>
                    <p class="text-sm">Staffsus</p>
                </div>
            </div>
        
            <!-- Tombol Logout -->
            <a href="{{ url('/logout') }}" class="flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-300 text-red-600 font-medium rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6-8v16" />
                </svg>
                <span class="hidden md:inline">Logout</span>
            </a>
        </div>

        <div class="bg-white p-4 rounded-lg shadow-md mt-4">
            <h2 class="font-bold text-lg">INFORMASI</h2>
            <ul class="mt-2 text-sm">
                <li>1. Mohon absen dengan background sekolah atau kelas</li>
                <li>2. Bagi yang belum cek history mohon dicek dari tanggal 6 - 31 Januari 2025</li>
                <li>3. Untuk transport di kelas 11 ditiadakan selama kelas 11 PKL</li>
            </ul>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <a href="#" class="bg-green-500 w-full py-3 text-white rounded-lg text-center"><i
                    class="fa-solid fa-camera"></i> Masuk</a>
            <a href="#" class="bg-red-500 w-full py-3 text-white rounded-lg text-center"><i
                    class="fa-solid fa-camera"></i> Pulang</a>
        </div>

        <h2 class="mt-6 font-semibold text-lg">Rekap Absen Bulan Maret Tahun 2025</h2>
        <div class="grid grid-cols-2 gap-4 mt-2">
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <i class="fa-solid fa-wallet"></i>
                <span>Bonus Hari Ini</span>
                <span class="text-red-500">Rp 0</span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <i class="fa-solid fa-wallet"></i>
                <span>Transport Hari Ini</span>
                <span class="text-red-500">Rp 0</span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-2">
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <i class="fa-solid fa-wallet "></i>
                <span>Bonus Bulan Ini</span>
                <span class="text-red-500">Rp 0</span>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md flex justify-between items-center">
                <i class="fa-solid fa-wallet"></i>
                <span>Transport Bulan Ini</span>
                <span class="text-red-500">Rp 0</span>
            </div>
        </div>
        <div class="fixed bottom-0 left-0 w-full bg-white p-4 flex justify-around shadow-md">
            <button><i class="fa-solid fa-clock text-xl"></i>
                <p><span>Inval</span></p>
            </button>
            <button><i class="fa-solid fa-list text-xl"></i>
                <p><span>History</span></p>
            </button>
            <button class="bg-blue-600 text-white rounded-full p-3"><i class="fa-solid fa-house text-xl"></i></button>
            <button><i class="fa-solid fa-calendar text-xl"></i>
                <p><span>Izin</span></p>
            </button>
            <button><i class="fa-solid fa-gears text-xl"></i>
                <p><span>Profil</span></p>
            </button>

        </div>
    </div>
@endsection
