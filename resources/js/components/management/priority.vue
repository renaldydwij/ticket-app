<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Priority</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPriority" @click="newModal">
                        Add Priority <i class="fas fa-user-plus" />
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
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="priority in priorities.data" :key="priority.id">
                      <td>{{priority.id}}</td>
                      <td>{{priority.name}}</td>
                      <td>{{priority.created_at | myDate }}</td>

                      <td>
                          <button class="btn btn-primary btn-sm" @click="editModal(priority)">
                              <span class="fas fa-edit"></span>
                          </button>
                          <button class="btn btn-danger btn-sm" @click="deletePriority(priority.id)">
                              <span class="fas fa-trash"></span>
                          </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                    <pagination :data="priorities" 
                        @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addPriority" tabindex="-1" aria-labelledby="addPriorityLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addPriorityLabel">Add Priority</h5>
                <h5 v-show="editmode" class="modal-title" id="addPriorityLabel">Update Priority</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updatePriority() : createPriority()">
            <div class="modal-body">
                <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Priority"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                        <div class="text-danger" v-html="form.errors.get('name')" />
                        <has-error :form="form" field="name"></has-error>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button @click="saveSession()" v-show="!editmode" type="submit" class="btn btn-primary">
                    <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                    <span v-if="loading">Create</span>
                    <span v-else >Create</span>
                </button>
                <button @click="saveSession()" v-show="editmode" type="submit" class="btn btn-success">
                    <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                    <span v-if="loading">Update</span>
                    <span v-else >Update</span>
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
                priorities: {},
                form: new Form({
                    id: '',
                    name: ''
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
                axios.get('api/priority?page=' + page)
                    .then(response => {
                        this.priorities = response.data;
                    });
            },
            updatePriority(){
                this.$Progress.start();
                this.form.put('api/priority/'+this.form.id)
                .then(() => {
                    Fire.$emit('refreshData');
                    // success
                    $('#addPriority').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Priority has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(priority){
                this.editmode = true;
                this.form.reset();
                $('#addPriority').modal("show");
                this.form.fill(priority);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addPriority').modal("show");
            },
            deletePriority(id){
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
                            this.form.delete('api/priority/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your priority has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('refreshData');
                            }).catch(()=> {
                                Swal.fire("Failed!", "There was something wronge.", "warning");
                            });  
                        }
                })
            },
            loadPriorities(){
                
                    axios.get('api/priority').then(({ data }) => (this.priorities = data));
                
            },
            createPriority(){
                this.$Progress.start();
                this.form.post('api/priority').then(() => {
                   Fire.$emit('refreshData');
                    $('#addPriority').modal("hide");
                    Swal.fire(
                        'Success!',
                        'Priority has been created.',
                        'success'
                        )
                this.$Progress.finish();
                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadPriorities();
            Fire.$on('refreshData', () => {
                this.loadPriorities();
            });
        }
    }
</script>
