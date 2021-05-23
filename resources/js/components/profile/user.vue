<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUser">
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
                          <a href="#">
                              <i class="fas fa-info-circle green"></i>
                          </a>
                          <a href="#">
                              <i class="fas fa-edit blue"></i>
                          </a>
                          <a href="#" @click="deleteUser(user.id)">
                              <i class="fas fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createUser">
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
                <button type="submit" class="btn btn-primary">Create</button>
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
                users: {},
                form: new Form({
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
