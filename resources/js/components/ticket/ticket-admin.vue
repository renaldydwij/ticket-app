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
                        <div class="table-responsive">
                            <!-- <b-table
                            id="table-transition-example"
                            :items="tickets"
                            :fields="fields"
                            striped
                            small
                            show-empty
                            primary-key="Name"
                            :tbody-transition-props="transProps">
                                <template slot="name" slot-scope="row">
                                    {{ row.item.name}}
                                </template>
                            </b-table> -->
                            <b-table striped hover :items="items" :fields="fields" show-empty>

                            </b-table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
      name: 'ticket-admin',
    data() {
      return {
          fields: [
            { key: 'Name', sortable: true },
            { key: 'Customer', sortable: true },
            { key: 'Email', sortable: true },
            { key: 'Date Open', sortable: true },
            { key: 'Status', sortable: true },
            { key: 'Priority', sortable: true },
            { key: 'Development', sortable: true },
            { key: 'Action', sortable: true }
          ],
          items: [],
          tickets: [],
        transProps: {
          // Transition name
          name: 'flip-list'
        },
       /*  items: [
          { Name: 'Aldy', Customer: 'PT AlfaBizz Teknologi', Email: 'aldy@gmail.com', Date: '22 July 2021', Status: 'Open', Priority: 'High', Development: 'Aziz', Action: 'test'},
          { Name: 'Ronaldo', Customer: 'PT Lestari Jaya Raya', Email: 'ronaldo@gmail.com', Date: '22 July 2021', Status: 'Closed', Priority: 'Low', Development: 'Riki', Action: 'test'},
        ], */
        
      }
    },
    created() {
         /* axios.get('api/ticket').then(({ data }) => (this.tickets = data)); */
    },
  }
</script>

