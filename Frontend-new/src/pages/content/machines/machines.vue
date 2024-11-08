<template>
  <div class="bg-gray-100 font-sans">
    <NavBar /> <!-- Include your navigation bar component -->

    <div class="container mx-auto mt-4 p-4 bg-white shadow-md rounded-lg">
      <h1 class="text-3xl font-bold text-center mb-6">Maschinen Liste</h1>

      <button @click="navigateToCreate" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-4">Hinzufügen</button>

      <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg text-xs">
          <thead class="bg-yellow-400">
            <tr>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Liste ID</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Name</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Description</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Machine Function</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Is Obsolete</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Is Virtual</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">VM Host</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">CPU</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Cores</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">RAM (MB)</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">OS</th>
              <th class="py-2 px-2 md:px-4 border-b text-left text-gray-700">Aktion</th>
            </tr>
          </thead>
          <tbody>
            <tr v-if="machines.length === 0">
              <td colspan="12" class="text-center py-4">Keine Maschinendaten gefunden.</td>
            </tr>
            <tr v-for="machine in machines" :key="machine.machine_liste_id" class="hover:bg-gray-50">
              <td class="py-2 px-2 md:px-4 border-b">{{ machine.machine_liste_id }}</td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-name">{{ machine.machine_name }}</span>
                <input type="text" class="hidden machine-name-input" v-model="machine.machine_name" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-description">{{ machine.machine_description }}</span>
                <input type="text" class="hidden machine-description-input" v-model="machine.machine_description" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-function">{{ machine.machine_function }}</span>
                <input type="text" class="hidden machine-function-input" v-model="machine.machine_function" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-obsolete">{{ machine.is_obsolete }}</span>
                <input type="text" class="hidden machine-obsolete-input" v-model="machine.is_obsolete" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-virtual">{{ machine.is_virtual }}</span>
                <input type="text" class="hidden machine-virtual-input" v-model="machine.is_virtual" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-vm-host">{{ machine.vm_host }}</span>
                <input type="text" class="hidden machine-vm-host-input" v-model="machine.vm_host" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-cpu">{{ machine.cpu }}</span>
                <input type="text" class="hidden machine-cpu-input" v-model="machine.cpu" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-cores">{{ machine.cores }}</span>
                <input type="text" class="hidden machine-cores-input" v-model="machine.cores" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-ram">{{ machine.ram_mb }}</span>
                <input type="text" class="hidden machine-ram-input" v-model="machine.ram_mb" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <span class="machine-os">{{ machine.os }}</span>
                <input type="text" class="hidden machine-os-input" v-model="machine.os" />
              </td>
              <td class="py-2 px-2 md:px-4 border-b">
                <div class="flex space-x-2">
                  <button class="bg-black text-white py-1 px-2 rounded hover:bg-gray-800" @click="viewDetails(machine.machine_liste_id)">
                    <i class="fas fa-eye" style="font-size: 20px;"></i>
                  </button>
                  <button class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600" @click="toggleEdit(machine.machine_liste_id)">
                    <i class="fas fa-pencil-alt" style="font-size: 20px;"></i>
                  </button>
                  <button class="bg-yellow-500 text-white py-1 px-2 rounded hover:bg-yellow-600" @click="editMachine(machine.machine_liste_id)">
                    <i class="fas fa-edit" style="font-size: 20px;"></i>
                  </button>
                  <button class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600" @click="confirmDelete(machine.machine_liste_id, machine.machine_name)">
                    <i class="fas fa-trash" style="font-size: 20px;"></i>
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import NavBar from '../../nav_bar/nav/nav.vue'; // Adjust the path as necessary
import Footer from '../../footer_bar/footer/footer.vue'; // Adjust the path as necessary
import { useRouter } from 'vue-router';

const machines = ref([]);
const router = useRouter();

const fetchMachines = async () => {
  try {
    const response = await fetch('http://127.0.0.1:3000/api/machine_list');
    const data = await response.json();
    machines.value = data;
  } catch (error) {
    console.error('Error fetching machines:', error);
  }
};

const navigateToCreate = () => {
  router.push('/create_machines'); // Adjust the route to your create machine page
};

const viewDetails = (machineId) => {
  router.push(`/detail_machines?id=${machineId}`); // Adjust route to detail machine page
};

const editMachine = (machineId) => {
  router.push(`/edit_machines?id=${machineId}`); // Adjust route to edit machine page
};

const confirmDelete = (machineId, machineName) => {
  if (confirm(`Möchten Sie die Maschine "${machineName}" wirklich löschen?`)) {
    deleteMachine(machineId);
  }
};

const deleteMachine = async (machineId) => {
  try {
    const response = await fetch(`http://127.0.0.1:3000/api/machine_list/${machineId}`, {
      method: 'DELETE',
    });

    if (response.ok) {
      alert('Maschine erfolgreich gelöscht.');
      fetchMachines(); // Refresh the machine list
    } else {
      alert('Fehler beim Löschen der Maschine.');
    }
  } catch (error) {
    console.error('Error deleting machine:', error);
  }
};

// Fetch machines when the component is mounted
onMounted(fetchMachines);
</script>

<style scoped>
/* Additional styles can be added here if needed */
</style>
