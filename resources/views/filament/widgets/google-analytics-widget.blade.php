<div class=" p-4 bg-white rounded-lg shadow">
    <h3 class="text-xl font-bold mb-4">Google Analytics</h3>
    
    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-gray-100 rounded">
            <p class="text-sm text-gray-600">Active Users</p>
            <p class="text-2xl font-bold"><span id="activeUsers">0</span></p>
        </div>
        
        <div class="p-4 bg-gray-100 rounded">
            <p class="text-sm text-gray-600">Event Count</p>
            <p class="text-2xl font-bold"><span id="eventCount">0</p>
        </div>
        {{-- <div class="p-4 bg-gray-100 rounded">
            <p class="text-sm text-gray-600">Screen Page Views</p>
            <p class="text-2xl font-bold"><span id="screenPageviews">0</p>
        </div> --}}
    </div>
</div>

<script>
    function fetchRealtimeUsers() {
        fetch('/analytics/realtime')
            .then(response => response.json())
            .then(data => {
                let activeUsers = data.rows?.[0]?.metricValues?.[0]?.value || 0;
                let eventCount = data.rows?.[1]?.metricValues?.[1]?.value || 1;
                let screenPageviews = data.rows?.[2]?.metricValues?.[2]?.value || 2;
                console.log(activeUsers);
                
                document.getElementById("activeUsers").innerText = activeUsers;
                document.getElementById("eventCount").innerText = eventCount;
                // document.getElementById("screenPageviews").innerText = screenPageviews;
            })
            .catch(error => console.error('Error fetching analytics data:', error));
    }

    // Refresh tiap 5 detik
    setInterval(fetchRealtimeUsers, 5000);
    fetchRealtimeUsers(); // Panggil langsung saat halaman pertama kali dimuat
</script>