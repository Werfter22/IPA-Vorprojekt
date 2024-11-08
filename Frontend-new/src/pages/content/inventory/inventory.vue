<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Inventar Artikel Bearbeiten</h2>
      <form @submit.prevent="handleSubmit" id="inventoryForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Barcode -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Barcode</label>
              <input type="text" v-model="barcode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
              <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateBarcode">Neuen Barcode generieren</button>
            </div>
          </div>

          <!-- Details -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Details</label>
              <textarea v-model="details" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
            </div>
          </div>

          <!-- Name -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Name</label>
              <input type="text" v-model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>

          <!-- QR Code -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">QR Code</label>
              <input type="text" v-model="qrCode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="flex items-center justify-between">
              <button type="button" class="ml-2 px-3 py-1 bg-blue-600 text-white text-sm rounded-md shadow hover:bg-blue-700" @click="generateQRCode">Neuen QR Code generieren</button>
            </div>
          </div>

          <!-- Transport Unit -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Transport Einheit</label>
              <input type="text" v-model="transportUnit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>

          <!-- Location -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ort</label>
              <input type="text" v-model="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
          </div>
        </div>

        <!-- Save Buttons -->
        <div class="mt-6 flex space-x-4">
          <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded-md shadow hover:bg-green-600">Änderung übernehmen</button>
          
          <router-link to="/inventory">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </form>
    </div>

    <!-- Notification Area -->
    <div v-if="notificationMessage" class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md" role="alert">
      <span>{{ notificationMessage }}</span>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const barcode = ref('');
const details = ref('');
const name = ref('');
const qrCode = ref('');
const transportUnit = ref('');
const location = ref('');
const notificationMessage = ref('');

// Function to handle form submission
const handleSubmit = () => {
  // Handle form submission logic here (e.g., send data to API)
  console.log("Form submitted:", { barcode: barcode.value, details: details.value, name: name.value, qrCode: qrCode.value, transportUnit: transportUnit.value, location: location.value });
  notificationMessage.value = "Änderungen erfolgreich übernommen!";
  clearForm(); // Clear form after submission
};

// Function to clear the form
const clearForm = () => {
  barcode.value = '';
  details.value = '';
  name.value = '';
  qrCode.value = '';
  transportUnit.value = '';
  location.value = '';
  setTimeout(() => {
    notificationMessage.value = ''; // Clear notification after 3 seconds
  }, 3000);
};

// QR Code generation
const generateQRCode = () => {
  qrCode.value = "Generated QR Code"; // Simulated generation
  notificationMessage.value = "Neuer QR Code wurde generiert!";
};

// Barcode generation
const generateBarcode = () => {
  barcode.value = "Generated Barcode"; // Simulated generation
  notificationMessage.value = "Neuer Barcode wurde generiert!";
};

</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
