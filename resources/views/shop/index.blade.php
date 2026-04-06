<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-white text-center md:text-left">Katalog Alat Musik</h1>
                
                {{-- TOMBOL KHUSUS ADMIN: Tambah Produk --}}
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('products.create') }}" class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-xl text-sm font-bold transition shadow-lg shadow-green-500/20">
                        + Tambah Alat Musik
                    </a>
                @endif
            </div>

            <div class="flex gap-4 mb-10 overflow-x-auto pb-4 no-scrollbar">
                <a href="{{ route('products.index') }}" 
                   class="whitespace-nowrap px-6 py-2 {{ !request('category') ? 'bg-indigo-600 text-white' : 'bg-gray-800 text-gray-400' }} rounded-full text-sm font-medium transition hover:scale-105">
                    Semua Instrumen
                </a>
                {{-- Loop Kategori --}}
                @foreach($categories as $cat)
                    <a href="{{ route('products.index', ['category' => $cat->slug]) }}" 
                       class="whitespace-nowrap px-6 py-2 {{ request('category') == $cat->slug ? 'bg-indigo-600 text-white' : 'bg-gray-800 text-gray-400' }} hover:bg-indigo-500 hover:text-white rounded-full text-sm font-medium transition hover:scale-105">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 md:gap-8">
                @foreach($products as $product)
                    <div class="bg-gray-800 rounded-3xl p-3 border border-gray-700 hover:border-indigo-500 hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-300 group flex flex-col min-h-[22rem]">

                        {{-- Image Section --}}
                        <div class="relative aspect-square bg-gray-700 rounded-2xl mb-3 overflow-hidden flex items-center justify-center p-2">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 alt="{{ $product->name }}"
                                 class="w-24 h-24 object-contain mx-auto group-hover:scale-110 transition-transform duration-300">
                            
                            {{-- OVERLAY ADMIN: Muncul saat hover kalau dia Admin --}}
                            @if(auth()->check() && auth()->user()->role === 'admin')
                                <div class="absolute inset-0 bg-black/60 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 p-2 rounded-lg text-white hover:bg-yellow-400 shadow-lg">
                                        📝 Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus instrumen ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="bg-red-600 p-2 rounded-lg text-white hover:bg-red-500 shadow-lg">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>

                        {{-- Product Info --}}
                        <div class="px-2 flex-grow flex flex-col">
                            <p class="text-indigo-400 text-[10px] font-bold uppercase tracking-widest mb-1">
                                {{ $product->category->name ?? 'Instrumen' }}
                            </p>
                            <h3 class="text-white font-semibold text-sm line-clamp-2 mb-2 leading-tight">
                                {{ $product->name }}
                            </h3>
                            <p class="text-indigo-300 font-bold text-base">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>

                        {{-- Tombol Beli (Untuk Semua User) --}}
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-white hover:text-indigo-600 text-white font-bold py-2 rounded-xl transition-all duration-300 text-sm flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Keranjang
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
                <div class="text-center py-20">
                    <p class="text-gray-500 text-xl">Yah, instrumen di kategori ini belum tersedia, Bro.</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</x-app-layout>