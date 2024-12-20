<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
       <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
           <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Promosi Saya</h2>
       </div>
   </header>
   <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-gradient-to-r from-blue-500 to-80% to-blue-900 text-white p-10 rounded-xl">
            <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi Saya</h2>
            {{-- @can('multi-role', 'level2|admin') --}}
                <p class="text-center">Berikut adalah produk yang sudah anda promosikan, atau anda ingin mempromosikan produk lagi?</p>
                <div class="flex justify-center mt-6">
                    <a href="{{ route('promosis.create') }}"
                        class="w-fit px-6 py-2 rounded-full bg-orange-400 font-bold flex justify-center items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-circle-plus">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M8 12h8" />
                            <path d="M12 8v8" />
                        </svg> 
                        Buat Promosi Produk
                    </a>
                </div>
            {{-- @endcan --}}
        </div>
    </section>
   <div class="container mx-auto px-10 py-12">
       <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filter Dropdown -->
            <form method="GET" action="{{ route('promosis.promosisaya') }}" class="mt-4">
                <label for="status" class="block text-gray-700 dark:text-gray-300 mb-2">Filter Status:</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu persetujuan</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Diterima</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @foreach($promosis as $promosi)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden p-4">
                        <a href="{{ route('promosis.detail', $promosi->slug) }}" class="block">
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
                            <h2 class="text-lg font-semibold mb-2 text-blue-500">{{ $promosi->judul }}</h2>
                        </a>
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
                        <div class="py-2">
                            @can('admin')
                                <form action="{{ route('promosis.edit', $promosi->id) }}" method="GET" class="inline-block">
                                    <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                </form>
                            @else
                                @if($promosi->status === 'pending')
                                    <form action="{{ route('promosis.edit', $promosi->id) }}" method="GET" class="inline-block">
                                        <button type="submit" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                                    </form>
                                @endif
                            @endcan
                            <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST" class="inline-block delete-form">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="redirect" value="mypromote">
                                <button type="button" class="bg-red-500 text-white px-2 py-1 mt-2 rounded delete-button" data-title="{{ $promosi->judul }}">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>         
            <div class="pt-8 mt-4">
                {{ $promosis->links() }}
            </div> 
       </div>
   </div>

    
   {{-- alert berhasil upload --}} 
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('berhasil'))
                    Swal.fire({
                        title: 'Sukses!',
                        text: "{{ session('berhasil') }}",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
            @endif
        });
    </script>


    {{-- alert hapus --}}
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const title = this.getAttribute('data-title'); // Ambil judul promosi dari atribut data-title

                    Swal.fire({
                        title: `Hapus <span style="font-weight: bold; color: red;">${title}</span> ?`,
                        text: "Item akan dihapus permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('.delete-form').submit();
                        }
                    });
                });
            });
        });
    </script> 

    {{-- alert update --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('berhasilupdate'))
                    Swal.fire({
                        title: 'Sukses!',
                        text: "{{ session('berhasilupdate') }}",
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
            @endif
        });
    </script>
</x-app-layout>
