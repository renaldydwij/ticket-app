<template>
    <div class="container">
        <div class="row">
          <div class="col-md-12">
              <br>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addStatus" @click="newModal">
                        Add Status <i class="fas fa-user-plus" />
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
                    <tr v-for="status in statuses.data" :key="status.id">
                      <td>{{status.id}}</td>
                      <td>{{status.name}}</td>
                      <td>{{status.created_at | myDate }}</td>

                      <td>
                          <button class="btn btn-primary btn-sm" @click="editModal(status)">
                              <span class="fas fa-edit"></span>
                          </button>
                          <button class="btn btn-danger btn-sm" @click="deleteStatus(status.id)">
                              <span class="fas fa-trash"></span>
                          </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                    <pagination :data="statuses" 
                        @pagination-change-page="getResults"></pagination>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addStatus" tabindex="-1" aria-labelledby="addStatusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 v-show="!editmode" class="modal-title" id="addStatusLabel">Add Status</h5>
                <h5 v-show="editmode" class="modal-title" id="addStatusLabel">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form @submit.prevent="editmode ? updateStatus() : createStatus()">
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
                <button  @click="saveSession()" v-show="!editmode" type="submit" class="btn btn-primary">
                    <div v-if="loading" class="spinner-border spinner-border-sm"></div>
                    <span v-if="loading">Create</span>
                    <span v-else >Create</span>
                </button>
                <button  @click="saveSession()" v-show="editmode" type="submit" class="btn btn-success">
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

//datatables
/* import "datatables.net-buttons-bs4";
import "datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css";

import "datatables.net-buttons/js/dataTables.buttons.js";

import "datatables.net-buttons/js/buttons.colVis.js";
import "datatables.net-buttons/js/buttons.flash.js";
import "datatables.net-buttons/js/buttons.html5.js";
import "datatables.net-buttons/js/buttons.print.js"; */

    export default {
        data: function() {
            return {
                editmode: false,
                statuses: {},
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
                axios.get('api/status?page=' + page)
                    .then(response => {
                        this.statuses = response.data;
                    });
            },
            updateStatus(){
                this.$Progress.start();
                this.form.put('api/status/'+this.form.id)
                .then(() => {
                    Fire.$emit('refreshData');
                    // success
                    $('#addStatus').modal('hide');
                     Swal.fire(
                        'Updated!',
                        'Status has been updated.',
                        'success'
                        )
                        this.$Progress.finish();
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            editModal(status){
                this.editmode = true;
                this.form.reset();
                $('#addStatus').modal("show");
                this.form.fill(status);
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addStatus').modal("show");
            },
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
                    axios.get('api/status').then(({data}) => 
                    {
                        this.statuses = data;
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
            },
                    /* axios.get('api/status').then(({ data }) => (this.statuses = data)); */
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
