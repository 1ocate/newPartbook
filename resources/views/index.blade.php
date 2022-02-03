<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <div class="mb-3">
            <h1 class="text-center text-xl mb-5">PartBook.ID</h1>
            <p class="text-center mb-5">
                Refensi Partbook untuk Mesin produksi anda dan Excell generator <br /><br />
                Database dan Informasi Sparepart Mesin Produksi, beserta No Part terlengkap dan terupdate yang dapat bantu Kinerja Produksi, juga membantu dalam mempercepat untuk membuat list excel kebutuhan sparepart
            </p>
            <div class="text-center mb-5">
                <a href="/login" class="items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Daftar Sekarang</a>
            </div>
            <div class="text-center">
                <img class="inline" src="{{ asset('img/example.gif') }}" />
            </div>

        </div>

       
    </x-auth-card>
</x-guest-layout>
