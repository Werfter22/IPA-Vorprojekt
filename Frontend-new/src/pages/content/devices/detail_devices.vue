<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Geräte Detail Ansicht</h2>
      <div id="deviceDetails">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6" id="device-container">
          <div v-if="device">
            <div class="space-y-4 p-4 border border-gray-300 rounded-md bg-gray-50 shadow-sm">
              <h3 class="text-lg font-semibold">Gerät Details</h3>

              <div>
                <label class="block text-sm font-medium text-gray-700">Geräte Name</label>
                <input type="text" v-model="device.device_name" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
                <input type="text" v-model="device.serialnumber" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700">Betriebssystem</label>
                <input type="text" v-model="device.os" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm sm:text-sm" readonly>
              </div>
            </div>
          </div>

          <div v-else>
            <p class="text-red-500">Gerät nicht gefunden.</p>
          </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
          <router-link to="/devices">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </div>
    </div>

    <!-- Modal for Confirmation (optional, if you need it) -->
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
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRoute } from 'vue-router';

const route = useRoute();
const device = ref(null);
const isModalOpen = ref(false);
let currentDeviceId = null;

// Function to fetch device details based on the ID from the URL
const fetchDeviceDetails = async () => {
  const deviceId = route.query.id; // Get the device ID from the query parameters

  try {
    const response = await fetch(`http://127.0.0.1:3000/api/devices/detail/${deviceId}`);
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    const data = await response.json();
    device.value = Array.isArray(data) ? data[0] : data; // Assuming data is an array
  } catch (error) {
    console.error('Error fetching device details:', error);
    device.value = null; // Set to null to show "not found" message
  }
};

// Fetch device details on component mount
onMounted(fetchDeviceDetails);

// Function to handle the removal of a device (if needed)
const removeDevice = () => {
  // Logic to remove the device (e.g., making a DELETE request)
  closeModal();
};

// Function to close the confirmation modal (if needed)
const closeModal = () => {
  isModalOpen.value = false;
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
