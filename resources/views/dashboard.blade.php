<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between">

                    <h3 class="text-lg font-semibold mb-4">Statistik Perpustakaan</h3>
                    <div class="mb-4">
                        <form method="GET" action="{{ route('dashboard') }}">
                            <label for="range" class="mr-2 font-medium">Tampilkan:</label>
                            <select name="range" id="range" class="border rounded px-3 py-1"
                                onchange="this.form.submit()">
                                <option value="year" {{ request('range') == 'year' ? 'selected' : '' }}>5 Tahun
                                </option>
                                <option value="month" {{ request('range') == 'month' ? 'selected' : '' }}>12 Bulan
                                </option>
                                <option value="week" {{ request('range') == 'week' ? 'selected' : '' }}>4 Minggu
                                </option>
                                <option value="day" {{ request('range') == 'day' ? 'selected' : '' }}>7 Hari</option>
                            </select>
                        </form>
                    </div>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-blue-600 text-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <i class="fas fa-book text-2xl mr-3"></i>
                            <div>
                                <h5 class="font-semibold">Total Buku</h5>
                                <p class="text-2xl">{{ $totalBooks }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-600 text-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <i class="fas fa-users text-2xl mr-3"></i>
                            <div>
                                <h5 class="font-semibold">Total Anggota</h5>
                                <p class="text-2xl">{{ $totalMembers }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-yellow-500 text-white rounded-lg shadow p-4">
                        <div class="flex items-center">
                            <i class="fas fa-handshake text-2xl mr-3"></i>
                            <div>
                                <h5 class="font-semibold">Peminjaman Aktif</h5>
                                <p class="text-2xl">{{ $activeLoans }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-semibold mb-4">Grafik Peminjaman</h3>

                <div class="bg-gray-100 rounded-lg shadow p-4">
                    <canvas id="monthlyLoansChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('monthlyLoansChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($loanMonths),
                    datasets: [{
                        label: 'Jumlah Peminjaman',
                        data: @json($loanCounts),
                        backgroundColor: 'rgba(13, 110, 253, 0.6)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1,
                        borderRadius: 5
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' peminjaman';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
