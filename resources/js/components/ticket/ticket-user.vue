<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ticket</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addTicket" @click="newModal">
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
                      <th>Date Open</th>
                      <th>Status</th>
                      <th>Priority</th>
                      <th>Development</th>
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
                          <!-- <v-chip :color="getColor(ticket.name_status)" dark>
                              {{ticket.name_status}}
                          </v-chip> -->
                           <!-- if(data!=null){
                                return '<span class="badge badge-secondary">Closed</span> <br><span class="badge badge-secondary">{{ticket.name_status}}</span>';
                           }else{
                                return '<span class="badge badge-success">Open</span>';
                            } -->
                          <!-- <div v-if="name_status === Open">
                              <span class="badge badge-success">
                                {{ticket.name_status}}
                             </span>
                          </div>
                          <div v-else-if="name_status === Pending">
                              <span class="badge badge-warning">
                                {{ticket.name_status}}
                             </span>
                          </div>
                          <div v-else>
                              <span class="badge badge-secondary">
                                {{ticket.name_status}}
                             </span>
                          </div> -->
                          
                             <span class="badge badge-secondary">
                                {{ticket.name_status}}
                             </span>
                      </td>
                      <td>
                        <span class="badge badge-success">
                            {{ticket.name_priority}}
                        </span>
                      </td>
                      <td>{{ticket.development}}</td>
                      <td>
                          <a href="#">
                              <!-- :to="'/ticket/detail/' +ticket.id" -->
                              <router-link 
                                :to="{name: 'detail-user', params: { id: ticket.id }}" >
                                <button 
                                    class="btn btn-success btn-sm">
                                    <span 
                                        class="fas fa-info-circle">
                                    </span>
                                </button>
                              </router-link>
                          </a>
                           
                          <!-- <button class="btn btn-primary btn-sm" @click="editModal(ticket)">
                              <span class="fas fa-edit"></span>
                          </button> -->
                          <!-- <button class="btn btn-danger btn-sm" @click="deleteTicket(ticket.id)">
                              <span class="fas fa-trash"></span>
                          </button> -->
                          
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                    <pagination :data="tickets" 
                        @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addTicket" tabindex="-1" aria-labelledby="addTicketLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addTicketLabel">Add Ticket</h5>
                <h5 v-show="editmode" class="modal-title" id="addTicketLabel">Update Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent=" editmode ? updateTicket() : createTicket()" >
            <div class="modal-body">
                <div 
                    class="form-group" 
                    v-show="!editmode">
                        <input 
                            v-model="form.name" 
                            type="text" 
                            name="name"
                            placeholder="Name"
                            class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('name') }">
                        <div 
                            class="text-danger" 
                            v-html="form.errors.get('name')" />
                        <has-error 
                            :form="form" 
                            field="name">
                        </has-error>
                </div>

                <div 
                    class="form-group" 
                    v-show="!editmode">
                        <input 
                            v-model="form.email" 
                            type="text" 
                            name="email"
                            placeholder="Email Address"
                            class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('email') }">
                        <div 
                            class="text-danger" 
                            v-html="form.errors.get('email')" />
                        <has-error 
                            :form="form" 
                            field="email">
                        </has-error>
                </div>

                <div class="form-group" v-show="!editmode">
                        <select 
                            name="name_customer" 
                            v-model="form.name_customer" 
                            class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('name_customer') }"
                            >
                            <option value="">--Select Customer--</option>
                            <option value="PT. IBM Indonesia">PT. IBM Indonesia</option>
                            <option value="PT. Lestari Jaya Raya">PT. Lestari Jaya Raya</option>
                            <option value="Vitafoam">Vitafoam</option>
                            <option value="PT. Alfa Bizz Teknologi">PT. Alfa Bizz Teknologi</option>
                            <option value="CBC Indonesia">CBC Indonesia</option>
                            <option value="Marie Joseph">Marie Joseph</option>
                            <option value="Infracom Technology">Infracom Technology</option>
                            <option value="Others">Others</option>
                            <!-- <option v-for="item in customers" :key="item.id" :value="item.id"> {{item.nama_customer}} </option> -->
                        </select>
                        <div 
                            class="text-danger" 
                            v-html="form.errors.get('name_customer')" />
                        <has-error 
                            :form="form" 
                            field="name_customer">
                        </has-error>
                </div>
                <div class="form-group" v-show="editmode">
                        <select name="name_status" v-model="form.name_status" class="form-control" :class="{ 'is-invalid': form.errors.has('name_status') }">
                            <option value="">--Select Status--</option>
                            <option>Open</option>
                            <option>Pending</option>
                            <option>Closed</option>
                            <!-- <option v-for="item in customers" :key="item.id" :value="item.id"> {{item.nama_customer}} </option> -->
                        </select>
                        <div class="text-danger" v-html="form.errors.get('name_status')" />
                        <has-error :form="form" field="name_status"></has-error>
                </div>
                <div class="form-group" v-show="editmode">
                        <select name="name_priority" v-model="form.name_priority" class="form-control" :class="{ 'is-invalid': form.errors.has('name_priority') }">
                            <option value="">--Select Priority--</option>
                            <option>Low</option>
                            <option>Medium</option>
                            <option>High</option>
                            <!-- <option v-for="item in customers" :key="item.id" :value="item.id"> {{item.nama_customer}} </option> -->
                        </select>
                        <div class="text-danger" v-html="form.errors.get('name_priority')" />
                        <has-error :form="form" field="name_priority"></has-error>
                </div>
                <div class="form-group" v-show="editmode">
                        <select name="development" v-model="form.development" class="form-control" :class="{ 'is-invalid': form.errors.has('development') }">
                            <option value="">--Select Development--</option>
                            <option>Yoke</option>
                            <option>Tian</option>
                            <option>Riki</option>
                            <option>Aziz</option>
                            <option>Vanya</option>
                            <option>Dafi</option>
                            <option>Renaldy</option>
                            <!-- <option v-for="item in customers" :key="item.id" :value="item.id"> {{item.nama_customer}} </option> -->
                        </select>
                        <div class="text-danger" v-html="form.errors.get('development')" />
                        <has-error :form="form" field="development"></has-error>
                </div>

                <div class="form-group" v-show="!editmode">
                        <textarea 
                            v-model="form.comment" 
                            name="comment" 
                            id="comment"
                            placeholder="Short Comment for user" 
                            class="form-control" 
                            :class="{ 'is-invalid': form.errors.has('comment') }" />
                        <div class="text-danger" v-html="form.errors.get('comment')" />
                        <has-error :form="form" field="comment"></has-error>
                </div>

                <div class="form-group" v-show="!editmode">
                        <input 
                            type="file" 
                            class="form-control" 
                            @change="onChange">
                        
                        <!-- <div class="text-danger" v-html="form.errors.get('photo')" />
                        <has-error :form="form" field="photo"></has-error> -->
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
import axios from 'axios';
/* import $ from 'jquery';
 */
    export default {
        /* props: ['id'], */
        data: function() {
            return {
                loading: false,
                editmode: false,
                tickets: {},
                form: new Form({
                    id: '',
                    name: '',
                    name_customer: '',
                    email: '',
                    comment: '',
                    name_status: '',
                    name_priority: '',
                    image: '',
                    development: ''
                })
            }
        },
        methods: {
            saveSession(){
                this.loading=!false
                setTimeout(()=> {
                    this.loading=!true
                }, 2000)
            },
        /*     getColor (name_status) {
                if (name_status == 'Open') return 'green'
                else if (name_status == 'Pending') return 'orange'
                else return 'red'
            }, */
            getResults(page = 1) {
                axios.get('api/ticket?page=' + page)
                    .then(response => {
                        this.tickets = response.data;
                    });
            },
            updateTicket(){
                this.$Progress.start();
                this.form.put('api/ticket/'+this.form.id)
                .then(() => {
                    Fire.$emit('refreshData');
                    // success
                    $('#addTicket').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Ticket has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(ticket){
                this.editmode = true;
                this.form.reset();
                $('#addTicket').modal("show");
                this.form.fill(ticket);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addTicket').modal("show");
            },
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
                            axios.delete('api/ticket/'+id).then(()=>{
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
                /*  axios.get('api/ticket').then(({data}) => 
                    {
                        this.tickets = data;
                        setTimeout(function () {
                            $('#myTable').DataTable(
                                {
                                    pageLength: 5,
                                    processing: true,
                                    dom: 'Bfrtip',
                                    buttons: ['copy', 'csv', 'print']
                                }
                            );
                        },
                            1
                            );
                        }) */
                axios.get('api/ticket').then(({ data }) => (this.tickets = data));
            },
            onChange(e){
                console.log("selected file", e.target.files[0])
                this.image = e.target.files[0]
                /* this.photo = this.$refs.file.files[0]
                this.photo = this.photo.name */
                /* console.log('success'); */
            },
            createTicket(){
                this.$Progress.start();
                var fd = new FormData();
                fd.append('name', this.form.name);
                fd.append('name_customer', this.form.name_customer);
                fd.append('email', this.form.email);
                fd.append('comment', this.form.comment);
                fd.append('img', this.image);
                fd.append('name_status', this.form.name_status);
                fd.append('name_priority', this.form.name_priority);
                fd.append('development', this.form.development);
                axios.post("api/ticket", fd, this.form).then(() => {
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
                    Swal.fire("Failed!", "There was something wronge.", "warning");
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