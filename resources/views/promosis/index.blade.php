<x-app-layout>
    <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Promosi</h2>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="max-w-screen-xl mx-auto px-6 mt-20">
        <div class="bg-gradient-to-r from-blue-500 to-blue-900 text-white p-10 rounded-xl">
            <h2 class="text-5xl font-bold text-center" style="font-family: 'Montserrat', sans-serif;">Promosi</h2>
            @can('multi-role', 'level2|admin')
                <p class="text-center mt-2">Ingin mempromosikan produk Anda?</p>
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
            @else
                <div>
                    <p class="text-center pt-5">
                        Untuk mempromosikan produk Anda, Anda harus bergabung dalam <b>Event Inkubasi</b> yang kami adakan
                        untuk para pelaku usaha agar mendapatkan eksposur lebih luas dan menjangkau target pasar yang tepat.
                        Jika Anda membutuhkan informasi lebih lanjut atau memiliki pertanyaan, jangan ragu untuk menghubungi
                        admin kami melalui kontak yang tersedia. Bersama kami, jadikan produk Anda lebih dikenal!
                    </p>
                    <div class="flex justify-center mt-6">
                        <a href="{{ route('eventIndex') }}" 
                            class="w-fit px-6 py-2 rounded-full bg-orange-400 font-bold flex justify-center items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" 
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" 
                                stroke-linejoin="round" class="lucide lucide-circle-plus">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Gabung Event
                        </a>
                    </div>
                </div>
            @endcan
        </div>
    </section>
    <section class="max-w-screen-xl mx-auto px-6 mt-10">
        <div class="bg-white rounded-xl p-6 border shadow-sm">
            <!-- Form Pencarian -->
            <div class="">
                <form action="{{ route('promosis.index') }}" method="GET" class="flex items-center gap-4">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Promosi..."
                        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-500 dark:bg-gray-700 dark:text-white" />
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">
                        Cari
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 max-w-md md:max-w-full mx-auto md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @if ($promosis->count() > 0)
                    @foreach ($promosis as $promosi)
                        <div class="hover:scale-105 transition-transform duration-500 group">
                            <a href="{{ route('promosis.detail', $promosi->slug) }}"
                                class="bg-white shadow border rounded-xl overflow-hidden aspect-[5/4] relative block">
                                @php
                                    $foto_produk = json_decode($promosi->foto_produk);
                                    $foto_pertama = $foto_produk[0] ?? null;
                                @endphp
                                @if ($foto_pertama)
                                    <img src="{{ asset('storage/' . $foto_pertama) }}" alt="Foto Produk"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                @else
                                    <div
                                        class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                        No Image
                                    </div>
                                @endif
                                <div
                                    class="absolute h-full w-full top-0 bg-gradient-to-t from-black/90 to-70% to-transparent flex flex-col justify-end">
                                    <div class="text-white p-4">
                                        <div class="text-xl font-bold">{{ $promosi->judul }}</div>
                                        <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-user">
                                                <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2" />
                                                <circle cx="12" cy="7" r="4" />
                                            </svg>{{ $promosi->user->name ?? 'Unknown' }}
                                        </div>
                                        <div class="flex gap-1 items-center text-xs text-neutral-300 mt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-calendar">
                                                <path d="M8 2v4" />
                                                <path d="M16 2v4" />
                                                <rect width="18" height="18" x="3" y="4" rx="2" />
                                                <path d="M3 10h18" />
                                            </svg>
                                            {{ $promosi->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </a>
                            {{-- @can('admin')
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <a href="{{ route('promosis.edit', $promosi->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white py-2 text-center rounded-xl">
                                    Edit
                                </a>
                                <form action="{{ route('promosis.destroy', $promosi->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="bg-red-500 hover:bg-red-600 text-white py-2 text-center rounded-xl w-full delete-button"
                                        data-title="{{ $promosi->judul }}" >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endcan --}}
                        </div>
                    @endforeach
                @else
                    <p class="col-span-3 bg-red-200 text-red-700 rounded p-4 border border-red-700 text-center">Tidak
                        ada promosi
                        yang ditemukan.
                    </p>
                @endif
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <section class="max-w-screen-xl mx-auto px-6 mt-10">
        {{ $promosis->links() }}
    </section>

    <!-- Delete Alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const title = this.getAttribute('data-title');

                    Swal.fire({
                        title: `Hapus <span style="font-weight: bold; color: red;">${title}</span>?`,
                        text: "Item akan dihapus permanen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Yakin Hapus'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.closest('form').submit();
                        }
                    });
                });
            });
        });
    </script>

    <!-- Update Alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('berhasilupdate'))
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
