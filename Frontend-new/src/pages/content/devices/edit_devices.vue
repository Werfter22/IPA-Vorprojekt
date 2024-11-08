<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg" id="main-container">
      <h2 class="text-2xl font-semibold mb-6">Gerät Bearbeiten</h2>
      <form id="devicesForm" @submit.prevent="handleSubmit">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
          <div v-for="(device, index) in devices" :key="index" class="space-y-4 p-4 border border-gray-300 rounded-md bg-gray-50 shadow-sm">
            <div class="flex justify-between items-center">
              <h3 class="text-lg font-semibold">Gerät {{ index + 1 }}</h3>
              <button type="button" class="text-gray-500 hover:text-red-500" @click="confirmDelete(index)">&#10006;</button>
            </div>

            <!-- Device Name -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
              <input type="text" v-model="device.device_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Serial Number -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
              <input type="text" v-model="device.serial_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- OS -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
              <input type="text" v-model="device.os" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>

            <!-- Werft or Private Device -->
            <div class="flex items-center justify-between space-x-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Werft Gerät?</label>
                <input type="checkbox" v-model="device.is_werft_device" class="mt-1" @change="toggleDeviceType(device)">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Privat Gerät?</label>
                <input type="checkbox" v-model="device.is_private_device" class="mt-1" @change="toggleDeviceType(device)">
              </div>
            </div>
          </div>
        </div>

        <!-- QR Code and Barcode Fields -->
        <div class="mt-6">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">QR Code</label>
            <input type="text" v-model="qrCode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
            <button type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateQRCode">Neuen QR Code generieren</button>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Barcode</label>
            <input type="text" v-model="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
            <button type="button" class="mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateBarcode">Neuen Barcode generieren</button>
          </div>
        </div>

        <!-- Save and Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Speichern</button>
          
          <router-link to="/devices">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </form>
      
      <!-- Notification Area -->
      <div v-if="notificationMessage" class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md" role="alert">
        <span>{{ notificationMessage }}</span>
      </div>
    </div>

    <!-- Alert Window -->
    <div v-if="isAlertOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="text-lg font-semibold mb-2">Bestätigung</h3>
        <p>Möchten Sie dieses Gerät wirklich löschen?</p>
        <div class="mt-4 flex justify-end space-x-2">
          <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="confirmDeleteDevice">Ja</button>
          <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" @click="closeAlert">Nein</button>
        </div>
      </div>
    </div>
  </div>
  <Footer />
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const devices = ref(Array(12).fill({ device_name: '', serial_number: '', os: '', is_werft_device: false, is_private_device: false }));
const qrCode = ref('');
const barcode = ref('');
const notificationMessage = ref('');
const isAlertOpen = ref(false);
let currentDeviceIndex = null;

// Fetch initial devices or simulate devices
const fetchDevices = () => {
  // Simulate fetching devices (You can replace this with your API call)
  devices.value = Array.from({ length: 12 }, (_, index) => ({
    device_name: `Gerät ${index + 1}`,
    serial_number: `SN${index + 1}`,
    os: 'Windows 10',
    is_werft_device: false,
    is_private_device: false,
  }));
};

// Call fetchDevices when the component is mounted
onMounted(fetchDevices);

// Function to toggle device type
const toggleDeviceType = (device) => {
  // Ensure that both checkboxes are not checked at the same time
  if (device.is_werft_device && device.is_private_device) {
    device.is_private_device = false;
  } else if (!device.is_werft_device && !device.is_private_device) {
    device.is_werft_device = true;
  }
};

// QR Code and Barcode generation functions
const generateQRCode = () => {
  qrCode.value = "Generated QR Code"; // Simulated generation
  showNotification("Neuer QR Code wurde generiert!");
};

const generateBarcode = () => {
  barcode.value = "Generated Barcode"; // Simulated generation
  showNotification("Neuer Barcode wurde generiert!");
};

// Function to handle form submission
const handleSubmit = () => {
  // Handle form submission logic here
  console.log("Devices to save:", devices.value);
  showNotification("Geräte erfolgreich gespeichert!");
};

// Function to show notifications
const showNotification = (message) => {
  notificationMessage.value = message;
  setTimeout(() => {
    notificationMessage.value = '';
  }, 3000);
};

// Function to confirm deletion
const confirmDelete = (index) => {
  currentDeviceIndex = index;
  isAlertOpen.value = true;
};

// Function to confirm deletion of the device
const confirmDeleteDevice = () => {
  devices.value.splice(currentDeviceIndex, 1); // Remove device
  closeAlert(); // Close alert
  showNotification("Gerät erfolgreich gelöscht!");
};

// Function to close the alert
const closeAlert = () => {
  isAlertOpen.value = false;
  currentDeviceIndex = null; // Reset the index
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
