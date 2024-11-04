<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Machine List</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';

// Function to fetch machine data from the API
function fetch_machines_from_api() {
    $api_url = 'http://127.0.0.1:3000/api/machine_list'; // URL for the machine list API
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        return []; // Return empty array on failure
    }

    return json_decode($response, true); // Decode JSON response into an associative array
}

// Fetch machine data
$machines = fetch_machines_from_api();
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Maschinen Liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_machines.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-yellow-400">
                <tr>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Liste ID</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Name</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Description</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Function</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Is Obsolete</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Is Virtual</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">VM Host</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">CPU</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Cores</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">RAM (MB)</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">OS</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">OS Info</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Location</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Lowest Unit</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Buy Date</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Value of Hardware</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Restore Hours</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Serial Number</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Production Date</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Disposal Date</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through machines and display each one in a row
                foreach ($machines as $machine) {
                    echo "<tr class='hover:bg-gray-50'>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_liste_id']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_name']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_description']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_function']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>" . ($machine['is_obsolete'] ? 'Yes' : 'No') . "</td>
                            <td class='py-2 px-2 md:px-4 border-b'>" . ($machine['is_virtual'] ? 'Yes' : 'No') . "</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['vm_host']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['cpu']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['cores']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['ram_mb']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['os']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['os_info']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_location']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['lowest_unit']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['buy_date']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['value_of_hardware']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['restore_hours']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['serialnumber']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['production_date']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$machine['disposal_date']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>
                                <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800' onclick=\"window.location.href='detail_machines.php?id={$machine['machine_liste_id']}'\">Ansicht</button>
                                <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600' onclick=\"window.location.href='edit_machines.php?id={$machine['machine_liste_id']}'\">Bearbeiten</button>
                                <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick=\"if(confirm('Möchten Sie diese Maschine wirklich löschen?')) window.location.href='delete_machines.php?id={$machine['machine_liste_id']}';\">Löschen</button>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
