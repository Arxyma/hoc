<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
       <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Promosi Saya</h2>
       </div>
   </header>
   <div class="container mx-auto px-10 py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

           <div class="bg-blue-500 text-white p-4 rounded-lg">
               <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi Saya</h2>
               <p class="text-center mb-4">Berikut adalah produk yang sudah anda promosikan, atau anda ingin mempromosikan produk lagi?</p>
               @can('multi-role', 'level2|admin')    
               <div class="flex justify-center">
                   <a href="{{ route('promosis.create') }}" class="bg-white text-blue-500 hover:bg-blue-100 rounded-md text-center">
                       <button class="bg-white text-blue-500 hover:bg-blue-100 rounded-md px-4 py-2 flex items-center">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                               <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                           </svg>
                           Buat Promosi Produk
                       </button>
                   </a>
               </div>
                @endcan
           </div>
           
           <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
               @foreach($promosis as $promosi)
                   <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                       <div class="h-48 overflow-hidden mb-4">
                           @if ($promosi->foto_produk)
                               @php
                                   $foto_produk = json_decode($promosi->foto_produk);
                                   $foto_pertama = $foto_produk[0] ?? null;
                               @endphp
                               @if ($foto_pertama)
                                   <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk" class="w-full h-full object-cover">
                               @else
                                   <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                       No Image
                                   </div>
                               @endif
                           @else
                               <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                   No Image
                               </div>
                           @endif
                       </div>
                       <div>
                           <h2 class="text-lg font-semibold mb-2">{{ $promosi->judul }}</h2>
                           <p class="text-gray-600">Uploaded by: {{ $promosi->user->name ?? 'Unknown' }}</p>
                           <p class="mt-1">
                               Status: 
                               @if($promosi->status === 'pending')
                                   <span class="text-orange-400 font-semibold">Menunggu persetujuan</span>
                               @elseif($promosi->status === 'approved')
                                   <span class="text-green-500 font-semibold">Diterima</span>
                               @elseif($promosi->status === 'rejected')
                                   <span class="text-red-600 font-semibold">Ditolak</span>
                               @endif
                           </p>
                           <td class="border px-4 py-2">
                               @can('admin')
                                   <form action="{{ route('promosis.edit', $promosi->id) }}" method="GET" class="inline-block">
                                       <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                   </form>
                               @endcan
                               <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block">
                                   @csrf
                                   @method('DELETE')
                                   <input type="hidden" name="redirect" value="mypromote">
                                   <button type="submit" class="bg-red-500 text-white px-2 py-1 mt-2 rounded">Delete</button>
                               </form>                                
                           </td>
                       </div>
                   </div>
               @endforeach
           </div>
       </div>
   </div>
</x-app-layout>
