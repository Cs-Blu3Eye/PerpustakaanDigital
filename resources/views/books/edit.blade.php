<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-6 text-gray-700">Form Edit Buku</h3>

                <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-2">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700">Judul Buku</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="author" class="block font-medium text-sm text-gray-700">Penulis</label>
                        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 @error('author') border-red-500 @enderror">
                        @error('author')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="publisher" class="block font-medium text-sm text-gray-700">Penerbit</label>
                        <input type="text" id="publisher" name="publisher" value="{{ old('publisher', $book->publisher) }}" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 @error('publisher') border-red-500 @enderror">
                        @error('publisher')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="publication_year" class="block font-medium text-sm text-gray-700">Tahun Terbit</label>
                        <input type="number" id="publication_year" name="publication_year"
                            value="{{ old('publication_year', $book->publication_year) }}" required min="1900" max="{{ date('Y') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 @error('publication_year') border-red-500 @enderror">
                        @error('publication_year')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block font-medium text-sm text-gray-700">Stok</label>
                        <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" required min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200 @error('stock') border-red-500 @enderror">
                        @error('stock')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="cover_image" class="block font-medium text-sm text-gray-700">Gambar Cover</label>
                        <input type="file" id="cover_image" name="cover_image"
                            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-md file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('cover_image') border-red-500 @enderror">
                        @if ($book->cover_image)
                            <p class="text-sm text-gray-600 mt-2">
                                Gambar saat ini:
                                <a href="{{ asset('storage/' . $book->cover_image) }}" target="_blank" class="text-blue-500 underline">
                                    Lihat Cover
                                </a>
                            </p>
                        @endif
                        @error('cover_image')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class=""></div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                            Perbarui
                        </button>
                        <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
