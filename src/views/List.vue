<template>
    <div>
      <ul class="list-group">
        <li class="list-group-item" v-for="item in items" :key="item.id">
          {{ item.name }} ({{ item.email }})
          <button type="button" class="btn btn-sm btn-danger ms-2" @click="handleDelete(item.id)">
            Delete
          </button>
          <button type="button" class="btn btn-sm btn-primary ms-2" @click="handleEdit(item)">
            Edit
          </button>
        </li>
      </ul>
      <b-modal v-model="showEditModal" title="Edit" ok-title="Save" @ok="handleUpdate">
        <form @submit.prevent="handleUpdate">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" v-model="editName">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" v-model="editEmail">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control" v-model="editPhone">
          </div>
        </form>
      </b-modal>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { BModal } from 'bootstrap-vue';
  
  export default {
    components: {
      BModal
    },
    props: {
      items: {
        type: Array,
        required: true
      }
    },
    data() {
      return {
        showEditModal: false,
        editId: null,
        editName: '',
        editEmail: '',
        editPhone: ''
      }
    },
    methods: {
      handleDelete(id) {
        // Send delete request to server using Axios
        axios.delete(`api.php?id=${id}`).then(response => {
          // Emit event to parent component to refresh data
          this.$emit('delete', id);
        }).catch(error => {
          console.error(error);
        });
      },
      handleEdit(item) {
        // Set edit form data based on selected item
        this.editId = item.id;
        this.editName = item.name;
        this.editEmail = item.email;
        this.editPhone = item.phone;
        this.showEditModal = true;
      },
      handleUpdate() {
        // Send update request to server using Axios
        axios.put(`api.php?id=${this.editId}`, {
          name: this.editName,
          email: this.editEmail,
          phone: this.editPhone
        }).then(response => {
          // Emit event to parent component to refresh data
          this.$emit('update');
          // Reset edit form data and hide modal
          this.editId = null;
          this.editName = '';
          this.editEmail = '';
          this.editPhone = '';
          this.showEditModal = false;
        }).catch(error => {
          console.error(error);
        });
      }
    }
  }
  </script>
<template>
    <div>
      <ul class="list-group">
        <li class="list-group-item" v-for="item in items" :key="item.id">
          {{ item.name }} ({{ item.email }})
          <button type="button" class="btn btn-sm btn-danger ms-2" @click="handleDelete(item.id)">
            Delete
          </button>
          <button type="button" class="btn btn-sm btn-primary ms-2" @click="handleEdit(item)">
            Edit
          </button>
        </li>
      </ul>
      <b-modal v-model="showEditModal" title="Edit" ok-title="Save" @ok="handleUpdate">
        <form @submit.prevent="handleUpdate">
          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" v-model="editName">
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" v-model="editEmail">
          </div>
          <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="tel" class="form-control" v-model="editPhone">
          </div>
        </form>
      </b-modal>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { BModal } from 'bootstrap-vue';
  
  export default {
    components: {
      BModal
    },
    props: {
      items: {
        type: Array,
        required: true
      }
    },
    data() {
      return {
        showEditModal: false,
        editId: null,
        editName: '',
        editEmail: '',
        editPhone: ''
      }
    },
    methods: {
      handleDelete(id) {
        // Send delete request to server using Axios
        axios.delete(`api.php?id=${id}`).then(response => {
          // Emit event to parent component to refresh data
          this.$emit('delete', id);
        }).catch(error => {
          console.error(error);
        });
      },
      handleEdit(item) {
        // Set edit form data based on selected item
        this.editId = item.id;
        this.editName = item.name;
        this.editEmail = item.email;
        this.editPhone = item.phone;
        this.showEditModal = true;
      },
      handleUpdate() {
        // Send update request to server using Axios
        axios.put(`api.php?id=${this.editId}`, {
          name: this.editName,
          email: this.editEmail,
          phone: this.editPhone
        }).then(response => {
          // Emit event to parent component to refresh data
          this.$emit('update');
          // Reset edit form data and hide modal
          this.editId = null;
          this.editName = '';
          this.editEmail = '';
          this.editPhone = '';
          this.showEditModal = false;
        }).catch(error => {
          console.error(error);
        });
      }
    }
  }
  </script>
    