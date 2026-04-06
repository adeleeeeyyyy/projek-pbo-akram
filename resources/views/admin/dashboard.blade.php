<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-800 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-2xl shadow-2xl p-6 mb-8 border-2 border-gray-500/20">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 rounded-full overflow-hidden border-2 border-gray-900 shadow-inner">

<img src="{{ asset('images/admin-foto.jpg') }}" 
     alt="Admin Profile" 
     class="h-full w-full object-cover">
</div>
                        <div>
                            <h1 class="text-2xl font-black text-gray-900 uppercase tracking-tight">Selamat Datang, <span class="text-gray-600">{{ Auth::user()->name }}</span></h1>
                            <p class="text-gray-500 text-sm font-bold uppercase tracking-widest">Di Toko Musik</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-900 text-white px-5 py-2 rounded-full font-black text-xs tracking-tighter shadow-lg">
                        <span class="inline-block h-2 w-2 bg-green-400 rounded-full animate-ping"></span>
                        SISTEM AKTIF
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div class="bg-white rounded-2xl shadow-xl border-b-8 border-gray-800 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 font-black text-xs uppercase tracking-widest">Total Produk</h3>
                        <div class="text-3xl bg-gray-900 p-3 rounded-2xl text-white"></div>
                    </div>
                    <p class="text-6xl font-black text-gray-900 mb-2">{{ \App\Models\Product::count() }}</p>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-800 text-white px-4 py-2 rounded-lg text-xs font-black uppercase hover:bg-black transition-colors inline-block mt-4">Kontrol Produk →</a>
                </div>

                <div class="bg-white rounded-2xl shadow-xl border-b-8 border-gray-800 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 font-black text-xs uppercase tracking-widest">Total Pengguna</h3>
                        <div class="text-3xl bg-gray-900 p-3 rounded-2xl text-white"></div>
                    </div>
                    <p class="text-6xl font-black text-gray-900 mb-2">{{ \App\Models\User::count() }}</p>
                    <span class="inline-flex items-center gap-2 text-gray-900 text-xs font-black bg-gray-100 px-4 py-2 rounded-lg border border-gray-300 mt-4">AKTIVASI</span>
                </div>

                <div class="bg-white rounded-2xl shadow-xl border-b-8 border-gray-800 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-gray-400 font-black text-xs uppercase tracking-widest">Server Status</h3>
                        <div class="text-3xl bg-gray-900 p-3 rounded-2xl text-white"></div>
                    </div>
                    <p class="text-6xl font-black text-gray-900 mb-2">AMAN</p>
                    <div class="mt-6 text-green-600 font-black text-xs flex items-center gap-2 bg-green-50 px-4 py-2 rounded-lg border border-green-200">
                        <span class="h-2 w-2 bg-green-600 rounded-full animate-pulse"></span> NORMAL
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-4 border-gray-900 mb-8">
                <div class="bg-gray-900 p-4 flex justify-between items-center">
                    <h3 class="text-white font-black uppercase tracking-tighter">Tabel Orderan</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-[10px] bg-white text-black px-3 py-1 font-black rounded hover:bg-gray-200">Lihat Semua</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-100 border-b-2 border-gray-900">
                            <tr>
                                <th class="p-4 font-black text-xs uppercase italic">Customer</th>
                                <th class="p-4 font-black text-xs uppercase italic text-right">Total Price</th>
                                <th class="p-4 font-black text-xs uppercase italic text-center">Status</th>
                                <th class="p-4 font-black text-xs uppercase italic text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4">
                                    <p class="font-black text-gray-900">{{ $order->user->name }}</p>
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $order->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="p-4 text-right font-black text-gray-900">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-3 py-1 text-[10px] font-black uppercase border-2 border-gray-900 {{ $order->status == 'PENDING' ? 'bg-yellow-400' : 'bg-green-400' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-center gap-2">
                                        @if($order->status !== 'SUCCESS')
                                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="SUCCESS">
                                            <button type="submit" class="bg-gray-900 text-white px-4 py-1 text-[10px] font-black hover:bg-green-600 transition-all uppercase shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                                                Approve
                                            </button>
                                        </form>
                                        @else
                                        <span class="text-green-600 font-black text-[10px] uppercase italic">Confirmed ✓</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-10 text-center font-bold text-gray-400 uppercase tracking-widest">No Recent Orders Detected</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="{{ route('products.create') }}" class="group bg-gray-900 rounded-2xl p-8 text-white shadow-2xl hover:bg-black transition-all hover:-translate-y-2 block border-4 border-white/10">
                    <div class="text-center">
                        <div class="text-5xl mb-4"></div>
                        <h3 class="text-xl font-black uppercase tracking-tighter">Tambah Produk</h3>
                    </div>
                </a>

                <a href="{{ url('/shop') }}" class="group bg-gray-900 rounded-2xl p-8 text-white shadow-2xl hover:bg-black transition-all hover:-translate-y-2 block border-4 border-white/10">
                    <div class="text-center">
                        <div class="text-5xl mb-4"></div>
                        <h3 class="text-xl font-black uppercase tracking-tighter">Lihat Toko</h3>
                    </div>
                </a>

                <a href="{{ route('admin.products.index') }}" class="group bg-gray-900 rounded-2xl p-8 text-white shadow-2xl hover:bg-black transition-all hover:-translate-y-2 block border-4 border-white/10">
                    <div class="text-center">
                        <div class="text-5xl mb-4"></div>
                        <h3 class="text-xl font-black uppercase tracking-tighter">Kelola Stok</h3>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>