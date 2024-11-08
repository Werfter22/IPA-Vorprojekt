<template>
    <div>
      <ActionButton label="Hinzufügen" :onClick="addItem" />
      <ActionButton label="Ansicht" :onClick="viewItem" />
      <ActionButton label="Bearbeiten Lokal" :onClick="editLocalItem" />
      <ActionButton label="Bearbeiten" :onClick="editItem" />
      <ActionButton label="Löschen" :onClick="deleteItem" />
      <ActionButton label="Speichern" :onClick="saveItem" />
      <ActionButton label="Barcode Generieren" :onClick="generateBarcode" />
      <ActionButton label="QR-Code Generieren" :onClick="generateQRCode" />
    </div>
  </template>
  
  <script>
  import ActionButton from './components/ActionButton.vue';
  
  export default {
    components: {
      ActionButton,
    },
    methods: {
      addItem() {
        // Logic to add an item
      },
      viewItem() {
        // Logic to view an item
      },
      editLocalItem() {
        // Logic to edit item locally
      },
      editItem() {
        // Logic to edit item
      },
      deleteItem() {
        // Logic to delete item
      },
      saveItem() {
        // Logic to save item
      },
      generateBarcode() {
        // Logic to generate barcode
      },
      generateQRCode() {
        // Logic to generate QR code
      },
    },
  };
  </script>
  