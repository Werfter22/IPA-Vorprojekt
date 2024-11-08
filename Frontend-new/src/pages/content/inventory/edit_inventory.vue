<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Inventar Artikel Detail Ansicht</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Barcode -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Barcode</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.barcode }}</p>
          </div>
        </div>

        <!-- Details -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Details</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.details }}</p>
          </div>
        </div>

        <!-- Name -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.name }}</p>
          </div>
        </div>

        <!-- QR Code -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">QR Code</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.qr_code }}</p>
          </div>
        </div>

        <!-- Transport Unit -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Transport Einheit</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.transport_unit }}</p>
          </div>
        </div>

        <!-- Location -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Ort</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ inventoryItem.location }}</p>
          </div>
        </div>
      </div>

      <!-- Back Button -->
      <div class="mt-6">
        <router-link to="/inventory">
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
        </router-link>
      </div>
    </div>

    <!-- Footer -->
    <Footer /> <!-- Footer component -->
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRoute } from 'vue-router';

const inventoryItem = ref({
  barcode: '',
  details: '',
  name: '',
  qr_code: '',
  transport_unit: '',
  location: ''
});

const route = useRoute();

onMounted(() => {
  const itemId = route.query.id; // Assuming you're getting the item ID from the URL query parameters
  fetchInventoryDetails(itemId);
});

// Fetch inventory item details from the API
const fetchInventoryDetails = async (itemId) => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/inventory/${itemId}`); // Replace with your actual API endpoint
    if (!response.ok) {
      throw new Error('Failed to fetch inventory details');
    }
    inventoryItem.value = await response.json(); // Assume the API returns the inventory item data
  } catch (error) {
    console.error('Error fetching inventory details:', error);
  }
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
