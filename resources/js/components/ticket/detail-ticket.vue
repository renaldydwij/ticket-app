<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detail Ticket</h3>
                        <div class="card-tools">
                            <a href="#"> 
                                <router-link :to="{name:'ticket'}">
                                    <button class="btn btn-success btn-sm">
                                        <span class="fa fa-arrow-left"></span> 
                                    </button>
                                </router-link>
                            </a>
                </div>
                    </div>
                    
                    <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <td>
                                        {{tickets.id}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Open
                                    </th>
                                    <td>
                                        {{ tickets.created_at | myDate }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Name
                                    </th>
                                    <td>
                                        {{tickets.name}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Customer
                                    </th>
                                    <td>
                                        {{ tickets.name_customer }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Email
                                    </th>
                                    <td>
                                        {{ tickets.email}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <td>
                                        <span class="badge badge-secondary">
                                            {{tickets.name_status}}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Priority
                                    </th>
                                    <td>
                                        <span class="badge badge-success">
                                            {{tickets.name_priority}}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Development
                                    </th>
                                    <td>
                                        {{ tickets.development }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Image
                                    </th>
                                    <td>
                                         <!-- {{ tickets.image }} -->
                                         <!-- <img :src="'../image/1622014216.2001.jpeg'"/> -->
                                         <img v-bind:src="'../image/' + tickets.image" style="" alt="" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Comment
                                    </th>
                                    <td>
                                        {{ tickets.comment }}
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        /* props: ['id'], */
        data() {
            return {
                tickets: '',
                errors: ''
            }
        },
        created() {
            let id  = this.$route.params.id;
            axios.get('api/ticket/'+ id)
            .then(response => {
                this.tickets = response.data
            }).catch(e => {
                this.errors.push(e)
            })
        }
    }
</script>
