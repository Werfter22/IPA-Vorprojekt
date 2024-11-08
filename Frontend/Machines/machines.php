<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

<div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Maschinen Liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_machines.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
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
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody id="machine-list">
        <?php
        if (empty($machines)) {
            echo "<tr><td colspan='12' class='text-center py-4'>Keine Maschinendaten gefunden.</td></tr>";
        } else {
            foreach ($machines as $machine) {
                echo "<tr class='hover:bg-gray-50' id='machine-{$machine['machine_liste_id']}'>
                        <td class='py-2 px-2 md:px-4 border-b'>{$machine['machine_liste_id']}</td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-name'>{$machine['machine_name']}</span>
                            <input type='text' class='hidden machine-name-input' value='{$machine['machine_name']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-description'>{$machine['machine_description']}</span>
                            <input type='text' class='hidden machine-description-input' value='{$machine['machine_description']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-function'>{$machine['machine_function']}</span>
                            <input type='text' class='hidden machine-function-input' value='{$machine['machine_function']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-obsolete'>{$machine['is_obsolete']}</span>
                            <input type='text' class='hidden machine-obsolete-input' value='{$machine['is_obsolete']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-virtual'>{$machine['is_virtual']}</span>
                            <input type='text' class='hidden machine-virtual-input' value='{$machine['is_virtual']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-vm-host'>{$machine['vm_host']}</span>
                            <input type='text' class='hidden machine-vm-host-input' value='{$machine['vm_host']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-cpu'>{$machine['cpu']}</span>
                            <input type='text' class='hidden machine-cpu-input' value='{$machine['cpu']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-cores'>{$machine['cores']}</span>
                            <input type='text' class='hidden machine-cores-input' value='{$machine['cores']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-ram'>{$machine['ram_mb']}</span>
                            <input type='text' class='hidden machine-ram-input' value='{$machine['ram_mb']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <span class='machine-os'>{$machine['os']}</span>
                            <input type='text' class='hidden machine-os-input' value='{$machine['os']}' />
                        </td>
                        <td class='py-2 px-2 md:px-4 border-b'>
                            <div class='flex space-x-2'>
                            <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800' onclick=\"window.location.href='detail_machines.php?id={$machine['machine_liste_id']}'\">
                                <i class='fas fa-eye' style='font-size: 20px;'></i>
                            </button>
                            <a class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600 edit-button' onclick='toggleEdit({$machine['machine_liste_id']})'>
                                <i class='fas fa-pencil-alt' style='font-size: 20px;'></i>
                            </a>
                            <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600' onclick=\"window.location.href='edit_machines.php?id={$machine['machine_liste_id']}'\">
                                <i class='fas fa-edit' style='font-size: 20px;'></i>
                            </button>
                            <button class='bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 save-button hidden' onclick='saveChanges({$machine['machine_liste_id']})'>
                                <i class='fas fa-save' style='font-size: 20px;'></i>
                            </button>
                            <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick=\"if(confirm('Möchten Sie diese Maschine wirklich löschen?')) window.location.href='delete_machines.php?id={$machine['machine_liste_id']}';\">
                                <i class='fas fa-trash' style='font-size: 20px;'></i>
                            </button>
                        </div>

                        </td>
                    </tr>";
            }
        }
        ?>
    </tbody>
        </table>
    </div>
</div>

<script>
    // Toggle edit mode for a machine
    function toggleEdit(machineId) {
        const row = $(`#machine-${machineId}`);
        row.find('.machine-name, .machine-description, .machine-function, .machine-obsolete, .machine-virtual, .machine-vm-host, .machine-cpu, .machine-cores, .machine-ram, .machine-os').toggleClass('hidden');
        row.find('.machine-name-input, .machine-description-input, .machine-function-input, .machine-obsolete-input, .machine-virtual-input, .machine-vm-host-input, .machine-cpu-input, .machine-cores-input, .machine-ram-input, .machine-os-input').toggleClass('hidden');
        row.find('.edit-button, .save-button').toggleClass('hidden');
    }

    // Save changes to the API
    function saveChanges(machineId) {
        const row = $(`#machine-${machineId}`);
        const data = {
            machine_liste_id: machineId,
            machine_name: row.find('.machine-name-input').val(),
            machine_description: row.find('.machine-description-input').val(),
            machine_function: row.find('.machine-function-input').val(),
            is_obsolete: row.find('.machine-obsolete-input').val(),
            is_virtual: row.find('.machine-virtual-input').val(),
            vm_host: row.find('.machine-vm-host-input').val(),
            cpu: row.find('.machine-cpu-input').val(),
            cores: row.find('.machine-cores-input').val(),
            ram_mb: row.find('.machine-ram-input').val(),
            os: row.find('.machine-os-input').val()
        };

        $.ajax({
            url: `http://127.0.0.1:3000/api/machine_list/${machineId}`,
            type: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function() {
                alert('Maschinendaten wurden erfolgreich aktualisiert.');
                toggleEdit(machineId);
                location.reload(); // Reload the page to reflect the updated data
            },
            error: function() {
                alert('Fehler beim Aktualisieren der Maschinendaten.');
            }
        });
    }
</script>

</body>

</html>
