<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome, claim your free meal today!') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Cards Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-green-100 border-l-4 border-green-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-green-800 mb-2">Available Donations</h3>
                    <p class="text-green-700 mb-4">Browse available donations and claim them.</p>
                    <a href="{{ route('donations.available') }}" 
                       class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition duration-300">
                       Click Here
                    </a>
                </div>

                <div class="bg-yellow-100 border-l-4 border-yellow-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-yellow-800 mb-2">My Claimed Meals</h3>
                    <p class="text-yellow-700 mb-4">View meals you have successfully claimed.</p>
                    <a href="{{ route('donations.my_claims') }}" 
                       class="inline-block bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                       Click Here
                    </a>
                </div>
            </div>

            <!-- Forum Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-purple-100 border-l-4 border-purple-500 shadow-md rounded-lg p-6 h-full">
                    <h3 class="text-xl font-bold text-purple-800 mb-2">Community Discussions</h3>
                    <p class="text-purple-700 mb-4">Browse and engage with posts shared by others in the community.</p>
                    <a href="{{ route('forum-posts.index') }}" 
                       class="inline-block bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 transition duration-300">
                       Click Here
                    </a>
                </div>
                <div class="hidden md:block"></div>
            </div>

            <!-- Chart Section -->
            <div class="mt-10 bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">Claimed Meals Per Month</h3>
                <div style="position: relative; height: 400px;">
                    <canvas id="claimedMealsChart"></canvas>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js CDN and Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('claimedMealsChart').getContext('2d');

            const chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($donationChartLabels) !!}, // Month labels like ['Jan', 'Feb', ...]
                    datasets: [{
                        label: 'Claimed Meals',
                        data: {!! json_encode($claimedDonationData) !!}, // Corresponding numbers
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',   // Jan - Red
                    'rgba(255, 159, 64, 0.7)',   // Feb - Orange
                    'rgba(255, 205, 86, 0.7)',   // Mar - Yellow
                    'rgba(75, 192, 192, 0.7)',   // Apr - Teal
                    'rgba(54, 162, 235, 0.7)',   // May - Blue
                    'rgba(153, 102, 255, 0.7)',  // Jun - Purple
                    'rgba(255, 99, 255, 0.7)',   // Jul - Pink
                    'rgba(255, 140, 0, 0.7)',    // Aug - Dark Orange
                    'rgba(60, 179, 113, 0.7)',   // Sep - Medium Sea Green
                    'rgba(0, 191, 255, 0.7)',    // Oct - Deep Sky Blue
                    'rgba(138, 43, 226, 0.7)',   // Nov - Blue Violet
                    'rgba(255, 20, 147, 0.7)',   // Dec - Deep Pink
                ],
                borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 99, 255, 1)',
                        'rgba(255, 140, 0, 1)',
                        'rgba(60, 179, 113, 1)',
                        'rgba(0, 191, 255, 1)',
                        'rgba(138, 43, 226, 1)',
                        'rgba(255, 20, 147, 1)',
                ],
                borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Month'
                            },
                            ticks: {
                                color: '#555'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Meals Claimed'
                            },
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
