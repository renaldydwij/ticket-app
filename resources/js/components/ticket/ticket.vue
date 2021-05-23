<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ticket</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTicket">
                        Add Ticket <i class="fas fa-user-plus" />
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Customer</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="ticket in tickets.data" :key="ticket.id">
                      <td>{{ticket.name}}</td>
                      <td>{{ticket.name_customer}}</td>
                      <td>{{ticket.email}}</td>
                      <td>{{ticket.created_at | myDate }}</td>

                      <td>
                          <a href="#">
                              <i class="fas fa-info-circle green"></i>
                          </a>
                          <a href="#">
                              <i class="fas fa-edit blue"></i>
                          </a>
                          <a href="#" @click="deleteTicket(ticket.id)">
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
        <div class="modal fade" id="addTicket" tabindex="-1" aria-labelledby="addTicketLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTicketLabel">Add Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="createTicket">
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
                        <select name="name_customer" v-model="form.name_customer" class="form-control" :class="{ 'is-invalid': form.errors.has('name_customer') }">
                            <option value="">--Select Customer--</option>
                            <option>PT. IBM Indonesia</option>
                            <option>PT. Lestari Jaya Raya</option>
                            <option>Vitafoam</option>
                            <option>PT. Alfa Bizz Teknologi</option>
                            <option>CBC Indonesia</option>
                            <option>Marie Joseph</option>
                            <option>Infracom Technology</option>
                            <option>Others</option>
                            <!-- <option v-for="item in customers" :key="item.id" :value="item.id"> {{item.nama_customer}} </option> -->
                        </select>
                        <div class="text-danger" v-html="form.errors.get('name_customer')" />
                        <has-error :form="form" field="name_customer"></has-error>
                </div>

                <div class="form-group">
                        <textarea v-model="form.comment" name="comment" id="comment"
                            placeholder="Short Comment for user" class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('comment') }" />
                        <div class="text-danger" v-html="form.errors.get('comment')" />
                        <has-error :form="form" field="comment"></has-error>
                </div>

                <div class="form-group">
                        <input  type="file"  class="form-control" id="photo" name="photo"  :class="{ 'is-invalid': form.errors.has('photo') }" >
                        <div class="text-danger" v-html="form.errors.get('photo')" />
                        <has-error :form="form" field="photo"></has-error>
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
                tickets: {},
                form: new Form({
                    id: '',
                    name: '',
                    name_cutomer: '',
                    email: ''
                })
            }
        },
        methods: {
            deleteTicket(id){
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
                            this.form.delete('api/ticket/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your ticket has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('refreshData');
                            }).catch(()=> {
                                Swal.fire("Failed!", "There was something wronge.", "warning");
                            });  
                        }
                })
            },
            loadTickets(){
                axios.get('api/ticket').then(({ data }) => (this.tickets = data));
            },
            createTicket(){
                this.$Progress.start();
                this.form.post('api/ticket').then(() => {
                   Fire.$emit('refreshData');
                    $('#addTicket').modal("hide");
                    Swal.fire(
                        'Success!',
                        'Ticket has been created.',
                        'success'
                        )
                this.$Progress.finish();
                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadTickets();
            Fire.$on('refreshData', () => {
                this.loadTickets();
            });
        }
    }
</script>
