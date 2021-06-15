<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCustomer" @click="newModal">
                        Add Customer <i class="fas fa-user-plus" />
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap" id="myTable">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="customer in customers.data" :key="customer.id">
                      <td>{{customer.id}}</td>
                      <td>{{customer.name_customer}}</td>
                      <td>{{customer.created_at | myDate }}</td>

                      <td>
                          <button class="btn btn-primary btn-sm" @click="editModal(customer)">
                              <span class="fas fa-edit"></span>
                          </button>
                          <button class="btn btn-danger btn-sm" @click="deleteCustomer(customer.id)">
                              <span class="fas fa-trash"></span>
                          </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer">
                    <pagination :data="customers" 
                        @pagination-change-page="getResults"></pagination>
              </div> -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addCustomerLabel">Add Customer</h5>
                <h5 v-show="editmode" class="modal-title" id="addCustomerLabel">Update Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateCustomer() : createCustomer()">
            <div class="modal-body">
                <div class="form-group">
                        <input v-model="form.name_customer" type="text" name="name_customer"
                            placeholder="Customer"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('name_customer') }">
                        <div class="text-danger" v-html="form.errors.get('name_customer')" />
                        <has-error :form="form" field="name_customer"></has-error>
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
import $ from 'jquery';

    export default {
        data: function() {
            return {
                editmode: false,
                customers: {},
                form: new Form({
                    id: '',
                    name_customer: ''
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
           /*  getResults(page = 1) {
                axios.get('api/customer?page=' + page)
                    .then(response => {
                        this.customers = response.data;
                    });
            }, */
            updateCustomer(){
                this.$Progress.start();
                this.form.put('api/customer/'+this.form.id)
                .then(() => {
                    Fire.$emit('refreshData');
                    // success
                    $('#addCustomer').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Customer has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(customer){
                this.editmode = true;
                this.form.reset();
                $('#addCustomer').modal("show");
                this.form.fill(customer);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addCustomer').modal("show");
            },
            deleteCustomer(id){
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
                            this.form.delete('api/customer/'+id).then(()=>{
                                    Swal.fire(
                                    'Deleted!',
                                    'Your customer has been deleted.',
                                    'success'
                                    )
                                Fire.$emit('refreshData');
                            }).catch(()=> {
                                Swal.fire("Failed!", "There was something wronge.", "warning");
                            });  
                        }
                })
            },
            loadCustomers(){
                axios.get('api/customer').then(({data}) => 
                    {
                        this.customers = data;
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
                        })
                    /* axios.get('api/customer').then(({ data }) => (this.customers = data)); */
                
            },
            createCustomer(){
                this.$Progress.start();
                this.form.post('api/customer').then(() => {
                   Fire.$emit('refreshData');
                    $('#addCustomer').modal("hide");
                    Swal.fire(
                        'Success!',
                        'Customer has been created.',
                        'success'
                        )
                this.$Progress.finish();
                })
                .catch(()=>{

                })
            }
        },
        created() {
            this.loadCustomers();
            Fire.$on('refreshData', () => {
                this.loadCustomers();
            });

        }
    }
</script>
