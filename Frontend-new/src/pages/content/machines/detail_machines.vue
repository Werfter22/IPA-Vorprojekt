<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Maschinen Detail Ansicht</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Is Obsolete -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Ist nicht mehr gebräuchlich?</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.is_obsolete }}</p>
          </div>
        </div>

        <!-- Machine Name -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Maschinen Name</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.machine_name }}</p>
          </div>
        </div>

        <!-- Machine Function -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Maschinen Funktion</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.machine_function }}</p>
          </div>
        </div>

        <!-- Machine Description -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Maschinen Beschreibung</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.machine_description }}</p>
          </div>
        </div>

        <!-- Is Virtual -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Ist Virtuell?</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.is_virtual }}</p>
          </div>
        </div>

        <!-- VM Host -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">VM Host</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.vm_host }}</p>
          </div>
        </div>

        <!-- CPU -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">CPU</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.cpu }}</p>
          </div>
        </div>

        <!-- Cores -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Cores</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.cores }}</p>
          </div>
        </div>

        <!-- RAM (MB) -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">RAM (MB)</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.ram_mb }}</p>
          </div>
        </div>

        <!-- OS -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.os }}</p>
          </div>
        </div>

        <!-- OS Info -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Betriebsystem Information</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.os_info }}</p>
          </div>
        </div>

        <!-- Location -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Ort</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.location }}</p>
          </div>
        </div>

        <!-- Lowest Unit -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Kleinste Einheit</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.lowest_unit }}</p>
          </div>
        </div>

        <!-- Buy Date -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Kauf Datum</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.buy_date }}</p>
          </div>
        </div>

        <!-- Value of Hardware -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Wert der Hardware</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.value_of_hardware }}</p>
          </div>
        </div>

        <!-- Restore Hours -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Wiederherstellungsdauer</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.restore_hours }}</p>
          </div>
        </div>

        <!-- Serial Number -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.serial_number }}</p>
          </div>
        </div>

        <!-- Production Date -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Produktionsdatum</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.production_date }}</p>
          </div>
        </div>

        <!-- Disposal Date -->
        <div class="space-y-4">
          <div>
            <label class="block text-sm font-medium text-gray-700">Entsorgungsdatum</label>
            <p class="mt-1 block w-full border-gray-300 rounded-md shadow-sm bg-gray-100 p-2">{{ machine.disposal_date }}</p>
          </div>
        </div>
      </div>

      <!-- Back Button -->
      <div class="mt-6">
        <a href="../Machines/machines.php">
          <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600" @click="goBack">Zurück</button>
        </a>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary

const machine = ref({});

// Function to fetch machine details based on ID
const fetchMachineDetails = async (id) => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/machines/${id}`);
    if (!response.ok) {
      throw new Error(`Fehler beim Laden der Maschinendetails: ${response.statusText}`);
    }
    const data = await response.json();
    machine.value = data;
  } catch (error) {
    console.error(error);
  }
};

// Go back to the previous page
const goBack = () => {
  window.history.back();
};

// Get the machine ID from the URL query parameters and fetch details
onMounted(() => {
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id'); // Assume the ID is passed as a query parameter
  fetchMachineDetails(id);
});
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
