<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://davidshimjs.github.io/qrcodejs/qrcode.min.js"></script>
    <title>Benutzer Liste</title>
</head>

<body class="bg-gray-100 font-sans">

<?php
// Include the navigation bar
include '../Nav/nav.php';

// Function to fetch user data from the API
function fetch_users_from_api() {
    $api_url = 'http://127.0.0.1:3000/api/users'; // URL for the users API
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        return []; // Return empty array on failure
    }

    return json_decode($response, true); // Decode JSON response into an associative array
}

// Fetch user data
$users = fetch_users_from_api();
?>

<div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">

    <h1 class="text-3xl font-bold text-center mb-6">Benutzer Liste</h1>

    <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4" onclick="window.location.href='create_users.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-yellow-400">
                <tr>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Nachname</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Vorname</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Email 1</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Email 2</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Email 3</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">QR Code</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Barcode</th>
                    <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody id="user-list">
                <?php
                if (empty($users)) {
                    echo "<tr><td colspan='8' class='text-center py-4'>Keine Benutzerdaten gefunden.</td></tr>";
                } else {
                    foreach ($users as $user) {
                        echo "<tr class='hover:bg-gray-50'>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['lastname']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['firstname']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['email_1']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['email_2']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['email_3']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>
                                    <div class='qr-code' style='width: 60px; height: 60px;' data-qr='Name: {$user['firstname']} {$user['lastname']}, Email: {$user['email_1']}'></div>
                                </td>
                                <td class='py-2 px-2 md:px-4 border-b'>{$user['barcode']}</td>
                                <td class='py-2 px-2 md:px-4 border-b'>
                                    <div class='flex space-x-2'>
                                        <button class='bg-black text-white py-1 px-2 rounded hover:bg-gray-800' onclick=\"window.location.href='detail_users.php?id={$user['user_id']}'\">Ansicht</button>
                                        <button class='bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600' onclick=\"window.location.href='edit_users.php?id={$user['user_id']}'\">Bearbeiten</button>
                                        <button class='bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600' onclick=\"if(confirm('Möchten Sie diesen Benutzer wirklich löschen?')) window.location.href='delete_users.php?id={$user['user_id']}';\">Löschen</button>
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
    // Generate QR codes after populating the user list
    function generateQRCodes() {
        $('.qr-code').each(function() {
            const qrData = $(this).data('qr'); // Get the QR data from the div's data attribute
            const qrcode = new QRCode(this, {
                text: qrData,
                width: 60,
                height: 60,
            });
        });
    }

    // Run the QR code generation when the page loads
    document.addEventListener('DOMContentLoaded', generateQRCodes);
</script>

<?php
// Include the footer
include '../Footer/footer.php';
?>

</body>
</html>
