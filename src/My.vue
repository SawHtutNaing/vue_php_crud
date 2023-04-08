
<template>
  <div class="container mt-3">
    <h1>{{ title }}</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Author</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="book in books" :key="book.id">
          <td>{{ book.id }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>
            <button class="btn btn-sm btn-primary" @click="editBook(book)">Edit</button>
            <button class="btn btn-sm btn-danger" @click="deleteBook(book)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
    <button class="btn btn-primary" @click="addBook()">Add Book</button>
    <div v-if="showModal" class="modal show" style="display: block;">
      <div class="modal-dialog">
        <div class="modal-content">
          <form>
            <div class="modal-header">
              <h5 class="modal-title">{{ modalTitle }}</h5>
              <button type="button" class="close" @click="closeModal()">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" v-model="formData.title">
              </div>
              <div class="form-group">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" v-model="formData.author">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="closeModal()">Close</button>
              <button type="submit" class="btn btn-primary" @click.prevent="saveBook()">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>



<script>

export default {
  name: 'My',
  data() {
    return {
      title: 'My Books',
      books: [],
      showModal: false,
      modalTitle: '',
      formData: {
        id: '',
        title: '',
        author: '',
      },
      saveCallback: null, // declare saveCallback variable
    saveCallbackResult: false, // declare saveCallbackResult variable
    };
  },
  mounted() {
    this.loadBooks();
  },

  methods: {
    loadBooks() {
      fetch('http://localhost:2223/api.php/books')
        .then((response) => response.json())
        .then((data) => (this.books = data));
    },

     editBook(book){
      this.showModal = true ; 
      this.modalTitle = "Edit the book" ;
      this.formData = {...book};


} , 

    
deleteBook(book) {
  
  if (confirm(`Are you sure you want to delete "${book.title}"?`)) {
    
    fetch(`http://localhost:2223/api.php/books?id=${book.id}`, {
  method: 'DELETE',
})

    .then(response => {
      if (response.ok) {
        this.loadBooks();
      } else {
        throw new Error('Failed to delete book');
      }
    })
    .catch(error => {
      console.error(error);
      alert('An error occurred while deleting the book.');
    });
  } 
}
,




saveBook() { if (
  this.formData.title && this.formData.author
  ) { let method = 'POST'; 
let url = 'http://localhost:2223/api.php/books';
 if (this.formData.id) {
  
   method = 'PUT'; url += `/${this.formData.id}`;
   
}

fetch(url, {
method: method,
headers: {
'Content-Type': 'application/json',
},
body: JSON.stringify(this.formData),
})
.then(() => {
this.closeModal();
this.loadBooks();
});
}
},


addBook() {
      this.modalTitle = 'Add Book';
      this.formData.id = 0;
      this.formData.title = '';
      this.formData.author = '';
      this.showModal = true;

  },
closeModal() {
this.showModal = false;
this.formData.id = 0;
this.formData.title = '';
this.formData.author = '';
},
},
};


</script>