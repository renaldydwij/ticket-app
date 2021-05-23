<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStatus">
                        Add Status <i class="fas fa-user-plus" />
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
                    <tr v-for="status in statuses.data" :key="status.id">
                      <td>{{status.id}}</td>
                      <td>{{status.name}}</td>
                      <td>{{status.created_at | myDate }}</td>

                      <td>
                          <a href="#">
                              <i class="fas fa-info-circle green"></i>
                          </a>
                          <a href="#">
                              <i class="fas fa-edit blue"></i>
                          </a>
                          <a href="#" @click="deleteStatus(status.id)">
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
        <div class="modal fade" id="addStatus" tabindex="-1" aria-labelledby="addStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStatusLabel">Add Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createStatus">
            <div class="modal-body">
                <div class="form-group">
                        <input v-model="form.name" type="text" name="name"
                            placeholder="Status"
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
                statuses: {},
                form: new Form({
                    id: '',
                    name: ''
                })
            }
        },
        methods: {
            deleteStatus(id){
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
                            this.form.delete('api/status/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your status has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('refreshData');
                            }).catch(()=> {
                                Swal.fire("Failed!", "There was something wronge.", "warning");
                            });  
                        }
                })
            },
            loadStatuses(){
                axios.get('api/status').then(({ data }) => (this.statuses = data));
            },
            createStatus(){
                this.$Progress.start();
                this.form.post('api/status').then(() => {
                   Fire.$emit('refreshData');
                    $('#addStatus').modal("hide");
                    Swal.fire(
                        'Success!',
                        'Status has been created.',
                        'success'
                        )
                this.$Progress.finish();
                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadStatuses();
            Fire.$on('refreshData', () => {
                this.loadStatuses();
            });
        }
    }
</script>
