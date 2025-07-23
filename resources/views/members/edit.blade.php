<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow rounded-lg">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Form Edit Anggota</h3>

                <form action="{{ route('members.update', $member->id) }}" method="POST" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Anggota</label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $member->name) }}"
                            required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        >
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input
                            type="text"
                            id="nim"
                            name="nim"
                            value="{{ old('nim', $member->nim) }}"
                            required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('nim') border-red-500 @enderror"
                        >
                        @error('nim')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="major" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <input
                            type="text"
                            id="major"
                            name="major"
                            value="{{ old('major', $member->major) }}"
                            required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('major') border-red-500 @enderror"
                        >
                        @error('major')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email', $member->email) }}"
                            required
                            class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                        >
                        @error('email')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <input
                            type="checkbox"
                            id="is_active"
                            name="is_active"
                            value="1"
                            {{ old('is_active', $member->is_active) ? 'checked' : '' }}
                            class="h-4 w-4 text-indigo-600 border-gray-300 rounded"
                        >
                        <label for="is_active" class="ml-2 block text-sm text-gray-700">Aktif</label>
                    </div>

                    <div class="flex justify-start gap-3 pt-4 justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            Perbarui
                        </button>
                        <a href="{{ route('members.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
