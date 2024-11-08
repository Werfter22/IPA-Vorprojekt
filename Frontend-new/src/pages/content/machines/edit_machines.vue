<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Maschine Bearbeiten</h2>
      <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Is Obsolete -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ist nicht mehr gebräuchlich?</label>
              <select v-model="machine.is_obsolete" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>

          <!-- Machine Name -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Name</label>
              <input type="text" v-model="machine.machine_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Machine Function -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Funktion</label>
              <input type="text" v-model="machine.machine_function" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Machine Description -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Beschreibung</label>
              <textarea v-model="machine.machine_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="3" required></textarea>
            </div>
          </div>

          <!-- Is Virtual -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ist Virtuell?</label>
              <select v-model="machine.is_virtual" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
            </div>
          </div>

          <!-- VM Host -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">VM Host</label>
              <input type="text" v-model="machine.vm_host" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- CPU -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">CPU</label>
              <input type="text" v-model="machine.cpu" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Cores -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Cores</label>
              <input type="number" v-model="machine.cores" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- RAM (MB) -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">RAM (MB)</label>
              <input type="number" v-model="machine.ram_mb" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- OS -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
              <input type="text" v-model="machine.os" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- OS Info -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem Information</label>
              <input type="text" v-model="machine.os_info" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Location -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ort</label>
              <input type="text" v-model="machine.location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Lowest Unit -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Kleinste Einheit</label>
              <input type="text" v-model="machine.lowest_unit" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Buy Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Kauf Datum</label>
              <input type="date" v-model="machine.buy_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Value of Hardware -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Wert der Hardware</label>
              <input type="number" v-model="machine.value_of_hardware" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Restore Hours -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Wiederherstellungsstunden</label>
              <input type="number" v-model="machine.restore_hours" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Serial Number -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
              <input type="text" v-model="machine.serial_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Production Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Produktionsdatum</label>
              <input type="date" v-model="machine.production_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Disposal Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Entsorgungsdatum</label>
              <input type="date" v-model="machine.disposal_date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>
        </div>

        <div class="mt-6">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Änderungen übernehmen
          </button>
          <router-link to="../Machines/machines.php">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </router-link>
        </div>
      </form>
    </div>
    <Footer />
  </div>

</template>

<script setup>
import { ref } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRoute, useRouter } from 'vue-router';

const machine = ref({
  is_obsolete: 'no',
  machine_name: '',
  machine_function: '',
  machine_description: '',
  is_virtual: 'no',
  vm_host: '',
  cpu: '',
  cores: '',
  ram_mb: '',
  os: '',
  os_info: '',
  location: '',
  lowest_unit: '',
  buy_date: '',
  value_of_hardware: '',
  restore_hours: '',
  serial_number: '',
  production_date: '',
  disposal_date: '',
});

// Fetch machine details using the ID from the route
const route = useRoute();
const router = useRouter();
const machineId = route.params.id; // Assuming you pass the machine ID in the route

// You should implement an API call here to fetch the machine details based on the ID
const fetchMachineDetails = async () => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/machines/${machineId}`);
    const data = await response.json();
    Object.assign(machine.value, data); // Update the machine object with fetched data
  } catch (error) {
    console.error('Error fetching machine details:', error);
  }
};

// Call the fetch function when the component is mounted
fetchMachineDetails();

const submitForm = async () => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/machines/${machineId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(machine.value),
    });

    if (response.ok) {
      alert('Machine details updated successfully!');
      router.push('../Machines/machines.php'); // Redirect after successful update
    } else {
      alert('Failed to update machine details.');
    }
  } catch (error) {
    console.error('Error updating machine details:', error);
  }
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
