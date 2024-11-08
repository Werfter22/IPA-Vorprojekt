import { createRouter, createWebHistory } from 'vue-router';

// Import your components for the routes
import UserList from '../pages/content/users/users.vue'; // Correct path
import CreateUser from '../pages/content/users/create_users.vue'; // Correct path
import EditUser from '../pages/content/users/edit_users.vue'; // Correct path
import DetailUser from '../pages/content/users/detail_users.vue'; // Correct path

import DeviceList from '../pages/content/devices/devices.vue'; // Ensure path is correct
import CreateDevice from '../pages/content/devices/create_devices.vue'; // Ensure path is correct
import EditDevice from '../pages/content/devices/edit_devices.vue'; // Ensure path is correct
import DetailDevice from '../pages/content/devices/detail_devices.vue'; // Ensure path is correct

import Inventory from '../pages/content/inventory/inventory.vue'; // Ensure path is correct
import CreateInventory from '../pages/content/inventory/create_inventory.vue'; // Ensure path is correct
import EditInventory from '../pages/content/inventory/edit_inventory.vue'; // Ensure path is correct
import DetailInventory from '../pages/content/inventory/detail_inventory.vue'; // Ensure path is correct

import MachineList from '../pages/content/machines/machines.vue'; // Ensure path is correct
import CreateMachine from '../pages/content/machines/create_machines.vue'; // Ensure path is correct
import EditMachine from '../pages/content/machines/edit_machines.vue'; // Ensure path is correct
import DetailMachine from '../pages/content/machines/detail_machines.vue'; // Ensure path is correct

import PhoneList from '../pages/content/phones/phones.vue'; // Ensure path is correct
import CreatePhone from '../pages/content/phones/create_phones.vue'; // Ensure path is correct
import EditPhone from '../pages/content/phones/edit_phones.vue'; // Ensure path is correct
import DetailPhone from '../pages/content/phones/detail_phones.vue'; // Ensure path is correct

import Home from '../pages/content/home/home.vue'; // Ensure path is correct

import Login from '../pages/login/login.vue'; // Ensure path is correct
import Register from '../pages/login/register.vue'; // Ensure path is correct

// Define your routes
const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home,
  },
  {
    path: '/users',
    name: 'UserList',
    component: UserList,
  },
  {
    path: '/create_users',
    name: 'CreateUser',
    component: CreateUser,
  },
  {
    path: '/edit_users/:id',
    name: 'EditUser',
    component: EditUser,
  },
  {
    path: '/detail_users/:id',
    name: 'DetailUser',
    component: DetailUser,
  },
  {
    path: '/devices',
    name: 'DeviceList',
    component: DeviceList,
  },
  {
    path: '/create_devices',
    name: 'CreateDevice',
    component: CreateDevice,
  },
  {
    path: '/edit_devices/:id',
    name: 'EditDevice',
    component: EditDevice,
  },
  {
    path: '/detail_devices/:id',
    name: 'DetailDevice',
    component: DetailDevice,
  },
  {
    path: '/inventory',
    name: 'Inventory',
    component: Inventory,
  },
  {
    path: '/create_inventory',
    name: 'CreateInventory',
    component: CreateInventory,
  },
  {
    path: '/edit_inventory/:id',
    name: 'EditInventory',
    component: EditInventory,
  },
  {
    path: '/detail_inventory/:id',
    name: 'DetailInventory',
    component: DetailInventory,
  },
  {
    path: '/machines',
    name: 'MachineList',
    component: MachineList,
  },
  {
    path: '/create_machines',
    name: 'CreateMachine',
    component: CreateMachine,
  },
  {
    path: '/edit_machines/:id',
    name: 'EditMachine',
    component: EditMachine,
  },
  {
    path: '/detail_machines/:id',
    name: 'DetailMachine',
    component: DetailMachine,
  },
  {
    path: '/phones',
    name: 'PhoneList',
    component: PhoneList,
  },
  {
    path: '/create_phones',
    name: 'CreatePhone',
    component: CreatePhone,
  },
  {
    path: '/edit_phones/:id',
    name: 'EditPhone',
    component: EditPhone,
  },
  {
    path: '/detail_phones/:id',
    name: 'DetailPhone',
    component: DetailPhone,
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
  },
];

// Create the router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Export the router instance
export default router;
