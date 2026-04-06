<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Ruang Music Saya') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 border-b-8 border-gray-800">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="h-20 w-20 bg-gray-900 rounded-full flex items-center justify-center text-4xl shadow-lg">
                        <img src="{{ asset('images/user-rock.jpg') }}" 
     alt="User Profile" 
     class="h-full w-full object-cover">
                    </div>
                    <div class="text-center md:text-left">
                        <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">
                            HEI, {{ Auth::user()->name }}!
                        </h1>
                        <p class="text-gray-500 font-bold uppercase text-xs tracking-widest mt-1">
                            Bersiap menemukan instrumen keren?
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 group hover:border-gray-800 transition-all">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-3xl">🛒</span>
                        <h4 class="font-black text-gray-800 uppercase">Aktivitas Belanja</h4>
                    </div>
                    <p class="text-gray-500 text-sm font-medium mb-6">Cek koleksi instrumen keren disini.</p>
                    <a href="{{ url('/shop') }}" class="inline-block w-full text-center bg-gray-900 text-white font-black py-3 rounded-xl hover:bg-black transition-all uppercase tracking-widest text-xs">
                        Mulai Belanja Sekarang
                    </a>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200 group hover:border-gray-800 transition-all">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="text-3xl"></span>
                        <h4 class="font-black text-gray-800 uppercase">Status Customer</h4>
                    </div>
                    <div class="space-y-2 mb-6">
                        <p class="text-sm font-bold text-gray-600">Email: <span class="text-gray-900">{{ Auth::user()->email }}</span></p>
                        <p class="text-sm font-bold text-gray-600">Role: <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs">CUSTOMER</span></p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="inline-block w-full text-center border-2 border-gray-800 text-gray-800 font-black py-3 rounded-xl hover:bg-gray-800 hover:text-white transition-all uppercase tracking-widest text-xs">
                        Edit Profile
                    </a>
                </div>
            </div>

            <div class="mt-8 bg-gray-900 rounded-2xl p-8 text-white flex flex-col md:flex-row items-center justify-between shadow-2xl border-4 border-white/10">
                <div>
                    <h3 class="text-xl font-black uppercase tracking-tighter">Dapatkan Diskon Member 10%</h3>
                    <p class="text-gray-400 text-sm font-bold uppercase">Gunakan kode: FERZROCK</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-4xl"></span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>