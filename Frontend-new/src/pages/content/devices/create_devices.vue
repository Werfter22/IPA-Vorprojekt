<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Gerät erstellen</h2>
      <form @submit.prevent="handleSubmit" id="createDevicesForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
          <div v-for="(device, index) in devices" :key="index" class="space-y-4 p-4 border border-gray-300 rounded-md bg-gray-50 shadow-sm">
            <div class="flex justify-between items-center">
              <h3 class="text-lg font-semibold">Gerät {{ index + 1 }}</h3>
              <button type="button" class="text-gray-500 hover:text-red-500" @click="confirmDelete(index)">&#10006;</button>
            </div>

            <!-- Device Name -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
              <input type="text" v-model="device.name" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- Serial Number -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
              <input type="text" v-model="device.serialNumber" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- OS -->
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
              <input type="text" v-model="device.os" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm">
            </div>

            <!-- Werft or Private Device -->
            <div class="flex items-center justify-between space-x-4">
              <div>
                <label class="block text-sm font-medium text-gray-700">Werft Gerät?</label>
                <input type="checkbox" v-model="device.isWerftDevice" class="mt-1" @change="toggleDeviceType(device)">
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-700">Privat Gerät?</label>
                <input type="checkbox" v-model="device.isPrivateDevice" class="mt-1" @change="toggleDeviceType(device)">
              </div>
            </div>
          </div>
        </div>

        <!-- QR Code and Barcode Fields -->
        <div class="mt-4">
          <div class="flex items-center justify-between">
            <label class="block text-sm font-medium text-gray-700">QR Code</label>
            <input type="text" v-model="qrCode" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateQRCode">Neuer QR Code erstellen</button>
          </div>

          <div class="flex items-center justify-between mt-4">
            <label class="block text-sm font-medium text-gray-700">Barcode</label>
            <input type="text" v-model="barcode" readonly class="mt-1 block w-full border-gray-300 rounded-md shadow-sm sm:text-sm">
            <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateBarcode">Neuer Barcode erstellen</button>
          </div>
        </div>

        <!-- Add More Devices Button -->
        <div class="mt-4">
          <button type="button" class="px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700" @click="addDeviceBlock">Mehr Geräte Hinzufügen</button>
        </div>

        <!-- Save and Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Erstellen</button>
          <router-link to="/devices">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </form>
    </div>

    <!-- Modal for Confirmation -->
    <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75">
      <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full">
        <h2 class="text-lg font-semibold mb-4">Bestätigung</h2>
        <p class="mb-4">Bist du sicher, dass du dieses Gerät entfernen möchtest?</p>
        <div class="flex justify-end space-x-2">
          <button class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600" @click="removeDevice">Ja, entfernen</button>
          <button class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400" @click="closeModal">Abbrechen</button>
        </div>
      </div>
    </div>
  </div>

  <Footer />
</template>

<script setup>
import { ref } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const devices = ref([{ name: '', serialNumber: '', os: '', isWerftDevice: false, isPrivateDevice: false }]);
const qrCode = ref('');
const barcode = ref('');
const isModalOpen = ref(false);
let currentDeviceIndex = null;

const addDeviceBlock = () => {
  devices.value.push({ name: '', serialNumber: '', os: '', isWerftDevice: false, isPrivateDevice: false });
};

const toggleDeviceType = (device) => {
  // Disable logic for checkboxes
  if (device.isWerftDevice && device.isPrivateDevice) {
    device.isPrivateDevice = false;
  }
  if (!device.isWerftDevice && !device.isPrivateDevice) {
    device.isWerftDevice = true;
  }
};

const confirmDelete = (index) => {
  currentDeviceIndex = index;
  isModalOpen.value = true;
};

const removeDevice = () => {
  if (currentDeviceIndex !== null) {
    devices.value.splice(currentDeviceIndex, 1);
    closeModal();
  }
};

const closeModal = () => {
  isModalOpen.value = false;
  currentDeviceIndex = null;
};

const generateQRCode = () => {
  qrCode.value = "Generated QR Code"; // Simulated generation
  alert("QR Code generated!");
};

const generateBarcode = () => {
  barcode.value = "Generated Barcode"; // Simulated generation
  alert("Barcode generated!");
};

const handleSubmit = () => {
  // Handle form submission logic here
  console.log("Form submitted", devices.value);
};
</script>

<style scoped>
/* Add any additional styles here if necessary */
</style>
