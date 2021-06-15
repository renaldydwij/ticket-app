<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser" @click="newModal">
                        Add User <i class="fas fa-user-plus" />
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users.data" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>{{user.role}}</td>
                      <td>{{user.created_at | myDate }}</td>

                      <td>
                          <!-- <a href="#">
                              <i class="fas fa-info-circle green"></i>
                          </a> -->
                          <button class="btn btn-primary btn-sm" @click="editModal(user)">
                              <span class="fas fa-edit"></span>
                          </button>
                          <button class="btn btn-danger btn-sm" @click="deleteTicket(user.id)">
                              <span class="fas fa-trash"></span>
                          </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                    <pagination :data="users" 
                        @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        

        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addUserLabel">Add User</h5>
                <h5 v-show="editmode" class="modal-title" id="addUserLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
                <div class="form-group">
                    <input v-model="form.name" type="text" name="name"
                        placeholder="Name"
                        class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                    <div class="text-danger" v-html="form.errors.get('name')" />
                    <has-error :form="form" field="name"></has-error>
                </div>

                <div class="form-group">
                        <input v-model="form.email" type="text" name="email"
                            placeholder="Email Address"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                        <div class="text-danger" v-html="form.errors.get('email')" />
                        <has-error :form="form" field="email"></has-error>
                </div>

                <div class="form-group">
                        <textarea v-model="form.bio" name="bio" id="bio"
                            placeholder="Short bio for user" class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('bio') }" />
                        <div class="text-danger" v-html="form.errors.get('bio')" />
                        <has-error :form="form" field="bio"></has-error>
                </div>

                <div class="form-group">
                        <select name="role" class="form-control" v-model="form.role" :class="{ 'is-invalid': form.errors.has('role') }">
                            <option value="">--Select--</option>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                            <option value="Author">Author</option>
                        </select>
                        <div class="text-danger" v-html="form.errors.get('role')" />
                        <has-error :form="form" field="role"></has-error>
                </div>
                

                <div class="form-group">
                        <input v-model="form.password" type="password" name="password" id="password"
                        placeholder="Password"  class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <div class="text-danger" v-html="form.errors.get('password')" />
                        <has-error :form="form" field="password"></has-error>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button @click="saveSession()" v-show="editmode" type="submit" class="btn btn-success">
                    <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                    <span v-if="loading">Update</span>
                    <span v-else >Update</span>
                </button>
                <button @click="saveSession()" v-show="!editmode" type="submit" class="btn btn-primary">
                    <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                    <span v-if="loading">Create</span>
                    <span v-else >Create</span>
                </button>
            </div>
            </form>
            </div>
        </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                users: {},
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    password: '',
                    role: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {
             saveSession(){
                this.loading=!false
                setTimeout(()=> {
                    this.loading=!true
                }, 10)
            },
            getResults(page = 1) {
                axios.get('api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id)
                .then(() => {
                    Fire.$emit('refreshData');
                    // success
                    $('#addUser').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addUser').modal("show");
                this.form.fill(user);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addUser').modal("show");
            },
            deleteUser(id){
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {

                        if (result.isConfirmed) {
                            this.form.delete('api/user/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('refreshData');
                            }).catch(()=> {
                                Swal.fire("Failed!", "There was something wronge.", "warning");
                            });  
                        }
                })
            },
            loadUsers(){
                
                    axios.get('api/user').then(({ data }) => (this.users = data));
                
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user').then(() => {
                   Fire.$emit('refreshData');
                    $('#addUser').modal("hide");
                    Swal.fire(
                        'Success!',
                        'User has been created.',
                        'success'
                        )
                this.$Progress.finish();
                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadUsers();
            Fire.$on('refreshData', () => {
                this.loadUsers();
            });
        }
    }
</script>
