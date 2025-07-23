<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Form Tambah Buku</h3>
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('title') border-red-500 @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="author" class="block text-sm font-medium text-gray-700">Penulis</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('author') border-red-500 @enderror" id="author" name="author" value="{{ old('author') }}" required>
                        @error('author')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="publisher" class="block text-sm font-medium text-gray-700">Penerbit</label>
                        <input type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('publisher') border-red-500 @enderror" id="publisher" name="publisher" value="{{ old('publisher') }}" required>
                        @error('publisher')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="publication_year" class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                        <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('publication_year') border-red-500 @enderror" id="publication_year" name="publication_year" value="{{ old('publication_year') }}" required min="1900" max="{{ date('Y') }}">
                        @error('publication_year')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('stock') border-red-500 @enderror" id="stock" name="stock" value="{{ old('stock') }}" required min="0">
                        @error('stock')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover</label>
                        <input type="file" class="mt-1 block w-full text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 focus:outline-none @error('cover_image') border-red-500 @enderror" id="cover_image" name="cover_image">
                        @error('cover_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
