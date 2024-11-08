<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Navigation component -->

    <div class="max-w-7xl mx-auto bg-white p-8 shadow-lg rounded-lg">
      <h2 class="text-2xl font-semibold mb-6">Maschine erfassen</h2>
      <form @submit.prevent="submitMachine">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Is Obsolete -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ist nicht mehr gebräuchlich?</label>
              <select v-model="form.is_obsolete" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="no" selected>No</option>
                <option value="yes">Yes</option>
              </select>
            </div>
          </div>

          <!-- Machine Name -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Name</label>
              <input v-model="form.machine_name" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Machine Function -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Funktion</label>
              <input v-model="form.machine_function" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required />
            </div>
          </div>

          <!-- Machine Description -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Maschinen Beschreibung</label>
              <textarea v-model="form.machine_description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" rows="3" required></textarea>
            </div>
          </div>

          <!-- Is Virtual -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ist Virtuell?</label>
              <select v-model="form.is_virtual" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="no" selected>No</option>
                <option value="yes">Yes</option>
              </select>
            </div>
          </div>

          <!-- VM Host -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">VM Host</label>
              <input v-model="form.vm_host" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- CPU -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">CPU</label>
              <input v-model="form.cpu" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Cores -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Cores</label>
              <input v-model="form.cores" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- RAM (MB) -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">RAM (MB)</label>
              <input v-model="form.ram_mb" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- OS -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem</label>
              <input v-model="form.os" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- OS Info -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Betriebsystem Information</label>
              <input v-model="form.os_info" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Location -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Ort</label>
              <input v-model="form.location" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Lowest Unit -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Kleinste Einheit</label>
              <input v-model="form.lowest_unit" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Buy Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Kauf Datum</label>
              <input v-model="form.buy_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Value of Hardware -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Wert der Hardware</label>
              <input v-model="form.value_of_hardware" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Restore Hours -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Wiederherstellungsdauer</label>
              <input v-model="form.restore_hours" type="number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Serial Number -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Seriennummer</label>
              <input v-model="form.serial_number" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Production Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Produktionsdatum</label>
              <input v-model="form.production_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>

          <!-- Disposal Date -->
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700">Entsorgungsdatum</label>
              <input v-model="form.disposal_date" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
            </div>
          </div>
        </div>

        <div class="mt-6">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-500 hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Erstellen
          </button>
          <a href="../Machines/machines.php">
            <button type="button" class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600">Zurück</button>
          </a>
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

const form = ref({
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
  disposal_date: ''
});

// Function to handle form submission
const submitMachine = async () => {
  try {
    const response = await fetch('http://127.0.0.1:3000/api/machines', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(form.value),
    });

    if (response.ok) {
      // Handle successful creation, e.g., redirect or show a success message
      alert('Maschine erfolgreich erstellt!');
      // Optionally, redirect or reset the form
    } else {
      console.error('Fehler beim Erstellen der Maschine:', response.statusText);
    }
  } catch (error) {
    console.error('Error:', error);
  }
};
</script>

<style scoped>
/* You can include additional styles here if necessary */
</style>
