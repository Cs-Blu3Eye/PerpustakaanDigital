<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2 sm:mb-0">Manajemen Peminjaman</h3>
                    <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                        <i class="fas fa-plus mr-2"></i> Tambah Peminjaman
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 table-auto border border-gray-300">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium">#</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Anggota</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Buku</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Tanggal Pinjam</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Tanggal Kembali</th>
                                <th class="px-4 py-2 text-left text-sm font-medium">Status</th>
                                <th class="px-4 py-2 text-center text-sm font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($loans as $loan)
                                <tr>
                                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="px-4 py-2">
                                        {{ $loan->member->name }}<br>
                                        <span class="text-xs text-gray-500">({{ $loan->member->nim }})</span>
                                    </td>
                                    <td class="px-4 py-2">{{ $loan->book->title }}</td>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d-m-Y') }}</td>
                                    <td class="px-4 py-2">
                                        {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d-m-Y') : '-' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <span class="inline-block px-2 py-1 text-xs rounded font-semibold text-white 
                                            {{ $loan->status == 'borrowed' ? 'bg-yellow-500' : 'bg-green-600' }}">
                                            {{ $loan->status == 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <div class="flex justify-center gap-2">
                                            @if ($loan->status == 'borrowed')
                                                <form action="{{ route('loans.return', $loan->id) }}" method="POST" onsubmit="return confirm('Kembalikan buku ini?');">
                                                    @csrf
                                                    <button type="submit" class="text-blue-600 hover:text-blue-800" title="Kembalikan Buku">
                                                        <i class="fas fa-undo"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-gray-500 py-4">Tidak ada data peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $loans->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
