<style scoped>
    .label-new{
        position: absolute;
        right: 10px;
        top: 10px;
    }
    .table_tr td{
        position: relative;
    }
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active до версии 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>
<template>
    <div class="contacts_list">
        <div class="alert alert-info" v-if="message">
            {{ message }}
        </div>
        <div class="tableFilters">
            <input class="input" type="text" v-model="tableData.search" placeholder="Search Contacts"
                   @input="getContacts()">

            <div class="control">
                <div class="select">
                    <select v-model="tableData.length" @change="getContacts()">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">50</option>
                        <option value="30">100</option>
                    </select>
                </div>
            </div>
        </div>
        <datatable :columns="columns" :sortKey="sortKey" :sortOrders="sortOrders" @sort="sortBy">
            <tbody>
                <tr v-for="contact in contacts" :key="contact.id" class="table_tr" v-bind:class="{ success: contact.new}">
                    <td>{{contact.id}}</td>
                    <td>{{contact.firstname}}</td>
                    <td>{{contact.phone}}</td>
                    <td>{{contact.email}}<span class="label label-primary label-new" v-if="contact.new">New</span></td>
                    <td>{{contact.city}}</td>
                    <td>
                        <button type="button" class="btn btn-link btn-xs" @click="edit(contact)"><span class="glyphicon glyphicon-search"></span></button>
                    </td>
                </tr>
            </tbody>
        </datatable>
        <pagination :pagination="pagination"
                    @prev="getContacts(pagination.prevPageUrl)"
                    @next="getContacts(pagination.nextPageUrl)">
        </pagination>

        <!-- Edit Contact Modal -->
        <div class="modal fade" id="modal-edit-contact" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                            Edit Contact
                        </h4>
                    </div>

                    <div class="modal-body table-responsive">
                        <table class="table table-bordered table-hover table-condensed">
                            <tbody>
                            <tr v-for="(value, key) in editForm.contact_form">
                                <td><strong>{{ key }}</strong></td>
                                <td v-if=" key === 'photo' &&  value !== null || key === 'photo_soc' &&  value !== null">
                                    <img :src="'file_download/photo_users/' + value" class="img-responsive img-thumbnail">
                                </td>
                                <td v-else-if=" key === 'soc_url' &&  value !== null">
                                    <a :href="value" target="_blank">
                                        {{ value }}
                                    </a>
                                </td>
                                <td v-else>{{ value }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <a class="action-link text-danger" @click="destroy(editForm.contact_form)">
                            Delete
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue'
export default {
    components: { datatable: Datatable, pagination: Pagination },
    created() {
        this.getContacts();
        Echo.channel('user-room.1')
            .listen('onAddContactEvent', (e) => {
                e.contact.new = true;
                this.contacts.unshift(e.contact);
            });
    },

    data() {
        let sortOrders = {};

        let columns = [
            {width: '', label: 'ID', name: 'id' },
            {width: '', label: 'Firstname', name: 'firstname' },
            {width: '', label: 'Phone', name: 'phone'},
            {width: '', label: 'Email', name: 'email'},
            {width: '', label: 'City', name: 'city'}
        ];

        columns.forEach((column) => {
           sortOrders[column.name] = -1;
        });
        return {
            contacts: [],
            columns: columns,
            sortKey: 'id',
            sortOrders: sortOrders,
            tableData: {
                draw: 0,
                length: 10,
                search: '',
                column: 0,
                dir: 'desc',
            },
            pagination: {
                lastPage: '',
                currentPage: '',
                total: '',
                lastPageUrl: '',
                nextPageUrl: '',
                prevPageUrl: '',
                from: '',
                to: ''
            },

            message: '',

            editForm: {
                errors: [],
                contact_form: []
            }
        }
    },
    methods: {
        getContacts(url = '/api/get_contacts') {
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.contacts = data.data.data;
                        this.configPagination(data.data);
                    }
                })
                .catch(errors => {
                    console.log(errors);
                });
        },
        configPagination(data) {
            this.pagination.lastPage = data.last_page;
            this.pagination.currentPage = data.current_page;
            this.pagination.total = data.total;
            this.pagination.lastPageUrl = data.last_page_url;
            this.pagination.nextPageUrl = data.next_page_url;
            this.pagination.prevPageUrl = data.prev_page_url;
            this.pagination.from = data.from;
            this.pagination.to = data.to;
        },
        sortBy(key) {
            this.sortKey = key;
            this.sortOrders[key] = this.sortOrders[key] * -1;
            this.tableData.column = this.getIndex(this.columns, 'name', key);
            this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';
            this.getContacts();
        },
        getIndex(array, key, value) {
            return array.findIndex(i => i[key] == value)
        },

        /**
         * Edit the given Contact.
         */
        edit(contact) {
            this.editForm.contact_form = contact;

            $('#modal-edit-contact').modal('show');
        },

        /**
         * Destroy the given client.
         */
        destroy(contact) {
            axios.get('/api/contacts/delete/' + contact.id)
                .then(response => {
                    if (response.data.status !== true){
                        this.message = 'Not deleted ID: '+contact.id;
                        return false;
                    }
                    this.getContacts();
                });
            $('#modal-edit-contact').modal('hide');
            this.message = 'Deleted ID: '+contact.id;
        }
    }
};
</script>
