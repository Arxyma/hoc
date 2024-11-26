<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Pimpinan</h1>

        <!-- Grafik Donat -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Distribusi User</h2>
                <canvas id="userDistributionChart" class="w-full"></canvas>
            </div>

            <!-- Card Statistik -->
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('communities.index') }}"
                    class="block bg-gradient-to-r from-green-400 to-blue-500 hover:from-green-500 hover:to-blue-600 shadow-lg rounded-lg p-6 text-white transform transition duration-300 hover:scale-105">
                    <h3 class="text-lg font-medium">Jumlah Komunitas</h3>
                    <p class="text-3xl font-bold mt-2">{{ $communityCount }}</p>
                </a>
                <a href="{{ route('promosis.semuapromosi') }}"
                    class="block bg-gradient-to-r from-yellow-400 to-orange-500 hover:from-yellow-500 hover:to-orange-600 shadow-lg rounded-lg p-6 text-white transform transition duration-300 hover:scale-105">
                    <h3 class="text-lg font-medium">Jumlah Promosi</h3>
                    <p class="text-3xl font-bold mt-2">{{ $promotionCount }}</p>
                </a>
                <a href="{{ route('mentors.index') }}"
                    class="block bg-gradient-to-r from-purple-400 to-pink-500 hover:from-purple-500 hover:to-pink-600 shadow-lg rounded-lg p-6 text-white transform transition duration-300 hover:scale-105">
                    <h3 class="text-lg font-medium">Jumlah Mentor</h3>
                    <p class="text-3xl font-bold mt-2">{{ $mentorCount }}</p>
                </a>
                <a href="{{ route('events.index') }}"
                    class="block bg-gradient-to-r from-red-400 to-indigo-500 hover:from-red-500 hover:to-indigo-600 shadow-lg rounded-lg p-6 text-white transform transition duration-300 hover:scale-105">
                    <h3 class="text-lg font-medium">Jumlah Event</h3>
                    <p class="text-3xl font-bold mt-2">{{ $eventCount }}</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('userDistributionChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Belum Membership', 'Sudah Membership'],
            datasets: [{
                data: [{{ $userLevel1Count }}, {{ $userLevel2Count }}],
                backgroundColor: ['#4CAF50', '#FF9800'],
                hoverBackgroundColor: ['#45A049', '#FF8C00']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });
</script>
