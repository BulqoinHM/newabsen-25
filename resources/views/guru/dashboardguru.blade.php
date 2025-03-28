@extends('layouts.masterdash')

@section('content')
    <div class="container mx-auto p-4">
        <div class="bg-blue-600 text-white p-4 rounded-lg flex items-center">
            <img src="{{ asset('src/images/fotonull.png') }}" alt="Profile"
                class="w-12 h-12 rounded-full border-2 border-white mr-4">
            <div>
                <h1 class="text-lg font-semibold">Nama guru</h1>
                <p class="text-sm">Staffsus</p>
            </div>
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
                <i class="fa-solid fa-wallet " ></i>
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
