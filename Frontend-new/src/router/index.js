import { createRouter, createWebHistory } from 'vue-router';

// Import your components for the routes
import users from '../pages/content/users/users.vue'; // Correct path
import create_users from '../pages/content/users/create_users.vue'; // Correct path
import edit_users from '../pages/content/users/edit_users.vue'; // Correct path
import detail_users from '../pages/content/users/detail_users.vue'; // Correct path

import devices from '../pages/content/devices/devices.vue'; // Ensure path is correct
import create_devices from '../pages/content/devices/create_devices.vue'; // Ensure path is correct
import edit_devices from '../pages/content/devices/edit_devices.vue'; // Ensure path is correct
import detail_devices from '../pages/content/devices/detail_devices.vue'; // Ensure path is correct

import inventory from '../pages/content/inventory/inventory.vue'; // Ensure path is correct
import create_inventory from '../pages/content/inventory/create_inventory.vue'; // Ensure path is correct
import edit_inventory from '../pages/content/inventory/edit_inventory.vue'; // Ensure path is correct
import detail_inventory from '../pages/content/inventory/detail_inventory.vue'; // Ensure path is correct

import machines from '../pages/content/machines/machines.vue'; // Ensure path is correct
import create_machines from '../pages/content/machines/create_machines.vue'; // Ensure path is correct
import edit_machines from '../pages/content/machines/edit_machines.vue'; // Ensure path is correct
import detail_machines from '../pages/content/machines/detail_machines.vue'; // Ensure path is correct

import phones from '../pages/content/phones/phones.vue'; // Ensure path is correct
import create_phones from '../pages/content/phones/create_phones.vue'; // Ensure path is correct
import edit_phones from '../pages/content/phones/edit_phones.vue'; // Ensure path is correct
import detail_phones from '../pages/content/phones/detail_phones.vue'; // Ensure path is correct

import home from '../pages/content/home/home.vue'; // Ensure path is correct

import login from '../pages/login/login.vue'; // Ensure path is correct
import register from '../pages/login/register.vue'; // Ensure path is correct

// Define your routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: home,
  },
  {
    path: '/users',
    name: 'users',
    component: users,
  },
  {
    path: '/create_users',
    name: 'create_users',
    component: create_users,
  },
  {
    path: '/edit_users/:id',
    name: 'edit_users',
    component: edit_users,
  },
  {
    path: '/detail_users/:id',
    name: 'detail_users',
    component: detail_users,
  },
  {
    path: '/devices',
    name: 'devices',
    component: devices,
  },
  {
    path: '/create_devices',
    name: 'create_devices',
    component: create_devices,
  },
  {
    path: '/edit_devices/:id',
    name: 'edit_devices',
    component: edit_devices,
  },
  {
    path: '/detail_devices/:id',
    name: 'detail_devices',
    component: detail_devices,
  },
  {
    path: '/inventory',
    name: 'inventory',
    component: inventory,
  },
  {
    path: '/create_inventory',
    name: 'create_inventory',
    component: create_inventory,
  },
  {
    path: '/edit_inventory/:id',
    name: 'edit_inventory',
    component: edit_inventory,
  },
  {
    path: '/detail_inventory/:id',
    name: 'detail_inventory',
    component: detail_inventory,
  },
  {
    path: '/machines',
    name: 'machines',
    component: machines,
  },
  {
    path: '/create_machines',
    name: 'create_machines',
    component: create_machines,
  },
  {
    path: '/edit_machines/:id',
    name: 'edit_machines',
    component: edit_machines,
  },
  {
    path: '/detail_machines/:id',
    name: 'detail_machines',
    component: detail_machines,
  },
  {
    path: '/phones',
    name: 'phones',
    component: phones,
  },
  {
    path: '/create_phones',
    name: 'create_phones',
    component: create_phones,
  },
  {
    path: '/edit_phones/:id',
    name: 'edit_phones',
    component: edit_phones,
  },
  {
    path: '/detail_phones/:id',
    name: 'detail_phones',
    component: detail_phones,
  },
  {
    path: '/login',
    name: 'login',
    component: login,
  },
  {
    path: '/register',
    name: 'register',
    component: register,
  },
];

// Create the router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
});

// Export the router instance
export default router;
