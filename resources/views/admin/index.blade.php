<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome, Admin!') }}
        </h2>
    </x-slot>

    <div class="py-12 px-4 max-w-7xl mx-auto">
        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <p class="text-gray-500 font-bold">Total Users</p>
                <h3 class="text-3xl font-bold text-indigo-600">{{ $totalUsers }}</h3>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <p class="text-gray-500 font-bold">Active Donations (not yet expired)</p>
                <h3 class="text-3xl font-bold text-green-600">{{ $activeDonations }}</h3>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <p class="text-gray-500 font-bold">Forum Posts</p>
                <h3 class="text-3xl font-bold text-yellow-600">{{ $forumPosts }}</h3>
            </div>
            <div class="bg-gray-100 p-6 rounded-xl shadow">
                <p class="text-gray-500 font-bold">Currently Available Donations</p>
                <h3 class="text-3xl font-bold text-blue-600">{{ $availableDonations }}</h3>
    </div>

        </div>

        {{-- Donation Chart --}}
        <div class="bg-white p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Donations</h3>
            <canvas id="donationChart" height="100"></canvas>
        </div>
    </div>

    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('donationChart').getContext('2d');
        const donationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($donationChartLabels),
                datasets: [
                    {
                        label: 'Claimed Donations',
                        data: @json($claimedDonationData),
                        backgroundColor: 'rgba(34, 197, 94, 0.6)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    },
                    {
                        label: 'Unclaimed Donations',
                        data: @json($unclaimedDonationData),
                        backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
