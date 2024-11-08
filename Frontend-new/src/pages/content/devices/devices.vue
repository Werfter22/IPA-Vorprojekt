<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="container mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
      <h1 class="text-3xl font-bold text-center mb-6">Geräte Liste</h1>

      <router-link to="/create-devices">
        <button class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">Hinzufügen</button>
      </router-link>

      <table class="min-w-full bg-white border border-gray-200 rounded-lg">
        <thead class="bg-gray-100">
          <tr>
            <th class="py-2 px-4 border-b text-left text-gray-700">Geräte Bild</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Geräte Name</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Seriennummer</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Betriebssystem</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Ist ein Werft Gerät</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Ist ein Privat Gerät</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">QR-Code</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Barcode</th>
            <th class="py-2 px-4 border-b text-left text-gray-700">Aktion</th>
          </tr>
        </thead>
        <tbody id="device-list">
          <tr v-for="device in devices" :key="device.id" class="hover:bg-gray-50">
            <td class="py-4 px-4 border-b text-left">
              <img :src="getDeviceImage(device.device_name)" alt="Gerät" class="w-12 h-12 rounded-full object-cover">
            </td>
            <td class="py-2 px-4 border-b">
              <span class="device-name">{{ device.device_name }}</span>
            </td>
            <td class="py-2 px-4 border-b">{{ device.serialnumber }}</td>
            <td class="py-2 px-4 border-b">{{ device.os }}</td>
            <td class="py-2 px-4 border-b">{{ device.is_werft_device ? 'Ja' : 'Nein' }}</td>
            <td class="py-2 px-4 border-b">{{ device.is_private_device ? 'Ja' : 'Nein' }}</td>
            <td class="py-2 px-4 border-b">
              <div :id="'qr-code-' + device.id"></div>
            </td>
            <td class="py-2 px-4 border-b">
              <svg :id="'barcode-' + device.id"></svg>
            </td>
            <td class="py-2 px-4 border-b">
              <div class="flex flex-col space-y-2">
                <button class="bg-black text-white py-1 px-2 rounded hover:bg-gray-800" @click="viewDetails(device.device_id)">
                  <i class="fas fa-eye" style="font-size: 20px;"></i>
                </button>
                <button class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600" @click="editDevice(device.device_id)">
                  <i class="fas fa-pencil-alt" style="font-size: 20px;"></i>
                </button>
                <button class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" @click="openModal(device.device_name, device.id)">
                  <i class="fas fa-trash" style="font-size: 20px;"></i>
                </button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
      <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-semibold mb-4">Gerät Löschen</h2>
        <p class="mb-4">Möchten Sie das Gerät <span>{{ deviceName }}</span> wirklich löschen?</p>
        <div class="flex justify-end">
          <button class="bg-gray-300 text-gray-700 py-2 px-4 rounded mr-2" @click="closeModal">Abbrechen</button>
          <button class="bg-red-500 text-white py-2 px-4 rounded" @click="confirmDelete">Löschen</button>
        </div>
      </div>
    </div>

    <Footer /> <!-- Footer component -->
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRouter } from 'vue-router';
import QRCode from 'qrcode'; // Assuming you have the qrcode package installed
import JsBarcode from 'jsbarcode'; // Assuming you have jsbarcode package installed

const devices = ref([]);
const isModalOpen = ref(false);
const deviceName = ref('');
const currentDeviceId = ref(null);
const router = useRouter();

// Function to fetch devices from the API
const fetchDevices = async () => {
  try {
    const response = await fetch('http://127.0.0.1:3000/api/devices'); // Your API endpoint
    devices.value = await response.json();

    devices.value.forEach(device => {
      // Generate QR Code and Barcode after fetching devices
      const qrData = `${device.device_name}, Serial: ${device.serialnumber}`;
      QRCode.toCanvas(document.getElementById(`qr-code-${device.id}`), qrData);

      JsBarcode(`#barcode-${device.id}`, device.serialnumber, {
        format: "CODE39",
        displayValue: false
      });
    });
  } catch (error) {
    console.error('Error fetching devices:', error);
  }
};

// Call fetchDevices when the component is mounted
onMounted(fetchDevices);

// Functions for modal
const openModal = (name, id) => {
  deviceName.value = name;
  currentDeviceId.value = id;
  isModalOpen.value = true;
};

const closeModal = () => {
  isModalOpen.value = false;
};

const confirmDelete = async () => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/devices/${currentDeviceId.value}`, {
      method: 'DELETE',
    });

    if (response.ok) {
      fetchDevices(); // Refresh the device list
      closeModal(); // Close the modal
    } else {
      console.error('Error deleting device:', response.statusText);
    }
  } catch (error) {
    console.error('Error deleting device:', error);
  }
};

// Navigation functions
const viewDetails = (deviceId) => {
  router.push(`/devices/detail?id=${deviceId}`);
};

const editDevice = (deviceId) => {
  router.push(`/devices/edit?id=${deviceId}`);
};

// Function to get device image path
const getDeviceImage = (deviceName) => {
  const deviceImages = {
    "Apple_iMac": "../../Backend/Images/Content/Devices/Apple_iMac.png",
    "Apple_iPhone_12": "../../Backend/Images/Content/Devices/Apple_iPhone_12.png",
    "default": "../../Backend/Images/Content/Devices/default.png"
  };
  return deviceImages[deviceName] || deviceImages['default'];
};

</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
