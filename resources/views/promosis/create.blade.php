<x-app-layout>
    <div class="container mx-auto">
      <h1 class="text-2xl font-bold mb-4">Buat promosi baru</h1>
  
      <form action="{{ route('promosis.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
  
        <div class="mb-4">
          <label for="judul" class="block text-sm font-medium">Nama Produk</label>
          <input type="text" name="judul" class="border-gray-300 mt-1 block w-full" placeholder="Tulis nama produk Anda disini.." required>
        </div>
  
        <div class="mb-4">
          <label for="deskripsi" class="block text-sm font-medium">Deskripsi Produk</label>
          <textarea name="deskripsi" class="border-gray-300 mt-1 block w-full" rows="4" placeholder="Tuliskan deskripsi produk Anda"></textarea>
        </div>
  
        <div class="mb-4">
          <label for="foto_produk" class="block text-sm font-medium">Pilih Foto</label>
          <input type="file" name="foto_produk" class="border-gray-300 mt-1 block w-full">
        </div>
  
        <div class="flex justify-between">
          {{-- <button type="button" class="bg-gray-300 text-white px-4 py-2 rounded">Upload foto produk Anda disini</button> --}}
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Promosikan Sekarang!</button>
        </div>
      </form>
    </div>
</x-app-layout>