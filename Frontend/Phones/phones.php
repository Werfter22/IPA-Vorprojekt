<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Phones List</title>
    <script>
        function editPhone(element) {
            const td = element.closest('td');
            const span = td.querySelector('.device-name');
            const input = td.querySelector('.device-name-input');

            // Toggle visibility
            span.classList.toggle('hidden');
            input.classList.toggle('hidden');

            // If switching to input mode, focus on it
            if (!input.classList.contains('hidden')) {
                input.focus();
            }
        }

        function savePhone(element, phoneId) {
            const td = element.closest('td');
            const input = td.querySelector('.device-name-input');
            const newValue = input.value;

            // Make an API call to save the updated value (implement the save functionality as needed)
            fetch(`http://127.0.0.1:3000/api/phones/${phoneId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ mobile_number_1: newValue }) // Adjust the payload as necessary
            })
            .then(response => {
                if (response.ok) {
                    // Optionally reload the page or update the UI with the new value
                    location.reload();
                } else {
                    alert('Failed to save changes.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';

// Function to fetch phone data from the API
function fetch_phones_from_api() {
    $api_url = 'http://127.0.0.1:3000/api/phones'; // URL for the phones API
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        return []; // Return empty array on failure
    }

    return json_decode($response, true); // Decode JSON response into an associative array
}

// Fetch phone data
$phones = fetch_phones_from_api();
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold text-center mb-6">Telefon Nummer Liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_phones.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-yellow-400">
                <tr>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Phone ID</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Mobile Number 1</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Mobile Number 2</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Mobile Number 3</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Mobile Number 4</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Mobile Number 5</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Work Number 1</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Work Number 2</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Work Number 3</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Work Number 4</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Work Number 5</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">QR Code</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Barcode</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through phones and display each one in a row
                foreach ($phones as $phone) {
                    echo "<tr class='hover:bg-gray-50'>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['phone_id']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>
                                <span class='device-name'>{$phone['mobile_number_1']}</span>
                                <input type='text' class='device-name-input hidden' value='{$phone['mobile_number_1']}' />
                                <span class='edit-icon cursor-pointer text-blue-500' onclick='editPhone(this)'>✏️</span>
                                <button class='bg-green-500 text-white py-1 px-2 rounded hover:bg-green-600 hidden' onclick='savePhone(this, {$phone['phone_id']})'>Speichern</button>
                            </td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['mobile_number_2']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['mobile_number_3']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['mobile_number_4']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['mobile_number_5']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['work_number_1']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['work_number_2']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['work_number_3']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['work_number_4']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['work_number_5']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['qr_code']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>{$phone['barcode']}</td>
                            <td class='py-2 px-2 md:px-4 border-b'>
                                <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800' onclick=\"window.location.href='detail_phones.php?id={$phone['phone_id']}'\">Ansicht</button>
                                <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600' onclick=\"window.location.href='edit_phones.php?id={$phone['phone_id']}'\">Bearbeiten</button>
                                <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick=\"if(confirm('Möchten Sie dieses Handy wirklich löschen?')) window.location.href='delete_phones.php?id={$phone['phone_id']}';\">Löschen</button>
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
