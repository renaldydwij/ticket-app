<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Priority</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPriority">
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
                          <a href="#">
                              <i class="fas fa-info-circle green"></i>
                          </a>
                          <a href="#">
                              <i class="fas fa-edit blue"></i>
                          </a>
                          <a href="#" @click="deletePriority(priority.id)">
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
        <div class="modal fade" id="addPriority" tabindex="-1" aria-labelledby="addPriorityLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPriorityLabel">Add Priority</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createPriority">
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
                priorities: {},
                form: new Form({
                    id: '',
                    name: ''
                })
            }
        },
        methods: {
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
