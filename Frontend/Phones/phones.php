<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/Nav/nav.css">
    <link rel="stylesheet" href="../CSS/Footer/footer.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://davidshimjs.github.io/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@latest/dist/JsBarcode.all.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Phones List</title>
</head>

<body class="bg-gray-100 font-sans text-xs">

<?php
include '../Nav/nav.php';

// Funktion zum Abrufen der Telefondaten aus der API
function fetch_phones_from_api() {
    $api_url = 'http://127.0.0.1:3000/api/phones';
    $response = file_get_contents($api_url);

    if ($response === FALSE) {
        return [];
    }

    return json_decode($response, true);
}

$phones = fetch_phones_from_api();
?>

<div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold text-center mb-4">Telefon Nummer Liste</h1>

    <button class="bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600 mb-2 text-xs" onclick="window.location.href='create_phones.php'">Hinzufügen</button>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
            <thead class="bg-yellow-400">
                <tr>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Phone ID</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 1</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 2</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 3</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 4</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Mobile 5</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Work 1</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Work 2</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Work 3</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Work 4</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Work 5</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">QR Code</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Barcode</th>
                    <th class="py-1 px-1 border-b text-left text-gray-700">Aktion</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($phones as $phone) {
                echo "<tr class='hover:bg-gray-50' data-id='{$phone['phone_id']}'>
                        <td class='py-1 px-1 border-b'>{$phone['phone_id']}</td>
                        
                        <td class='py-1 px-1 border-b'>
                            <span class='phone-value'>{$phone['mobile_number_1']}</span>
                            <input type='text' class='phone-input hidden text-xs' value='{$phone['mobile_number_1']}' />
                            <span class='edit-icon cursor-pointer text-blue-500' onclick='editPhone(this)'>✏️</span>
                            <button class='save-button hidden bg-green-500 text-white py-1 px-1 rounded hover:bg-green-600 text-xs' onclick='savePhone(this, {$phone['phone_id']})'>✔️</button>
                        </td>
                        
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['mobile_number_2']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['mobile_number_2']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['mobile_number_3']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['mobile_number_3']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['mobile_number_4']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['mobile_number_4']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['mobile_number_5']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['mobile_number_5']}' /></td>
                        
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['work_number_1']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['work_number_1']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['work_number_2']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['work_number_2']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['work_number_3']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['work_number_3']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['work_number_4']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['work_number_4']}' /></td>
                        <td class='py-1 px-1 border-b'><span class='phone-value'>{$phone['work_number_5']}</span><input type='text' class='phone-input hidden text-xs' value='{$phone['work_number_5']}' /></td>
                        
                        <td class='py-1 px-1 border-b'>{$phone['qr_code']}</td>
                        <td class='py-1 px-1 border-b'>{$phone['barcode']}</td>
                        
                        <td class='py-1 px-1 border-b'>
                            <button class='bg-black text-white py-1 px-1 rounded hover:bg-gray-800 text-xs' onclick=\"window.location.href='detail_phones.php?id={$phone['phone_id']}'\">
                                <i class='fas fa-eye' style='font-size: 20px;'></i>
                            </button>
                            <button class='bg-yellow-500 text-white py-1 px-1 rounded hover:bg-yellow-600 text-xs' onclick=\"window.location.href='edit_phones.php?id={$phone['phone_id']}'\">
                                <i class='fas fa-pencil-alt' style='font-size: 20px;'></i>
                            </button>
                            <button class='bg-red-500 text-white py-1 px-1 rounded hover:bg-red-600 text-xs' onclick=\"if(confirm('Möchten Sie dieses Handy wirklich löschen?')) window.location.href='delete_phones.php?id={$phone['phone_id']}';\">
                                <i class='fas fa-trash' style='font-size: 20px;'></i>
                            </button>
                        </td>

                    </tr>";
            }
            ?>
        </tbody>
        </table>
    </div>
</div>

<script>
    function editPhone(element) {
        const row = $(element).closest('tr');
        row.find('.phone-input').removeClass('hidden');
        row.find('.phone-value').addClass('hidden');
        $(element).addClass('hidden');
        row.find('.save-button').removeClass('hidden');
    }

    async function savePhone(element, phoneId) {
        const row = $(element).closest('tr');
        const updatedData = {
            mobile_number_1: row.find('input.phone-input').eq(0).val(),
            mobile_number_2: row.find('input.phone-input').eq(1).val(),
            mobile_number_3: row.find('input.phone-input').eq(2).val(),
            mobile_number_4: row.find('input.phone-input').eq(3).val(),
            mobile_number_5: row.find('input.phone-input').eq(4).val(),
            work_number_1: row.find('input.phone-input').eq(5).val(),
            work_number_2: row.find('input.phone-input').eq(6).val(),
            work_number_3: row.find('input.phone-input').eq(7).val(),
            work_number_4: row.find('input.phone-input').eq(8).val(),
            work_number_5: row.find('input.phone-input').eq(9).val(),
        };

        const confirmed = confirm('Möchten Sie die Änderungen speichern?');
        if (!confirmed) return;

        try {
            const response = await fetch(`http://127.0.0.1:3000/api/phones/${phoneId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(updatedData),
            });

            if (response.ok) {
                location.reload();
            } else {
                console.error('Fehler beim Speichern der Telefonnummern:', response.statusText);
            }
        } catch (error) {
            console.error('Fehler beim Speichern der Telefonnummern:', error);
        }
    }
</script>

<?php
include '../Footer/footer.php';
?>

</body>
</html>
