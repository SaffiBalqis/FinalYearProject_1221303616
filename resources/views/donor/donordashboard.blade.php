<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome, contribute your part today!
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif
            <!-- Top Row - Donation Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Post a Donation Card -->
                <div class="bg-green-100 border-l-4 border-green-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-green-800 mb-2">Post a Donation</h3>
                    <p class="text-green-700 mb-4">Share your surplus food to help others in need.</p>
                    <a href="{{ route('donations.create') }}" 
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                       Click Here
                    </a>
                </div>

                <!-- My Donations Card -->
                <div class="bg-yellow-100 border-l-4 border-yellow-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-yellow-800 mb-2">My Donations</h3>
                    <p class="text-yellow-700 mb-4">View, manage, or edit your submitted donations.</p>
                    <a href="{{ route('donations.index') }}" 
                       class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                       Click Here
                    </a>
                </div>
            </div>

            <!-- Bottom Row - Community Forum Card in two-column grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Community Posts Card -->
                <div class="bg-purple-100 border-l-4 border-purple-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-purple-800 mb-2">Community Discussions</h3>
                    <p class="text-purple-700 mb-4">Browse and engage with posts shared by others in the community.</p>
                    <a href="{{ route('forum-posts.index') }}" 
                       class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition duration-300">
                       Click Here
                    </a>
                </div>

                <!-- Optional empty div to balance the layout -->
                <div class="hidden md:block"></div>
            </div>

                    <!-- Chart.js Script -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <!-- Chart Container -->
        <div class="bg-white mt-10 rounded-lg shadow p-6">
            <h3 class="text-xl font-bold mb-4 text-gray-800">Your Monthly Donations (Claimed vs Unclaimed)</h3>
            <canvas id="donationChart" height="100"></canvas>
        </div>

        <script>
            const ctx = document.getElementById('donationChart').getContext('2d');
            const donationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($donationChartLabels),
                    datasets: [
                        {
                            label: 'Claimed',
                            data: @json($claimedDonationData),
                            backgroundColor: 'rgba(59, 130, 246, 0.7)', // blue-500
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        },
                        {
                            label: 'Unclaimed',
                            data: @json($unclaimedDonationData),
                            backgroundColor: 'rgba(234, 179, 8, 0.7)', // yellow-500
                            borderColor: 'rgba(202, 138, 4, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>

        </div>
    </div>
</x-app-layout>
