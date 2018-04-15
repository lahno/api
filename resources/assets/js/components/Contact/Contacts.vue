<style lang="sass">
    .label-new
        position: absolute
        right: 10px
        top: 10px
    .table_tr td
        position: relative
    .slide-fade-enter-active
        transition: all .3s ease
    .slide-fade-leave-active
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0)
    .slide-fade-enter, .slide-fade-leave-to
        transform: translateX(10px)
        opacity: 0
    .contacts_list
        .tableFilters
            margin-bottom: 10px
            input
                width: 55%
                padding: 3px
            .control
                float: right
            select
                height: 35px
                &:hover
                    cursor: pointer
        .sort
            background-repeat: no-repeat
            background-position: center right
            &.sorting
                background-image: url('../../../img/sort_both.png')
            &.sorting_asc
                background-image: url('../../../img/sort_asc.png')
            &.sorting_desc
                background-image: url('../../../img/sort_desc.png')
    .tableOptions
        margin: 20px 0
        .option
            text-align: center
            display: inline-block
            label
                text-align: center
                span
                    font-size: 12px
                    font-weight: normal
                div
                    margin: 0 auto
    .table_block
        position: relative
        z-index: 5
        .loader_block
            width: 100%
            height: 100%
            .loader
                position: absolute
                top: 50%
                left: 50%
                z-index: 15
                margin-left: -30px
                margin-top: -30px
                border: 2px solid #d9edf7
                border-top: 6px solid #3498db
                border-radius: 50%
                width: 60px
                height: 60px
                animation: spin 1s linear infinite
            @keyframes spin
                0%
                    transform: rotate(0deg)
                100%
                    transform: rotate(360deg)
        .table_load.active
            opacity: 0.4
</style>
<template>
    <div class="contacts_list panel panel-default">
        <div class="panel-heading">Contacts</div>
        <div class="panel-body">
            <div class="alert alert-info" v-if="message">
                {{ message }}
            </div>
            <div class="tableFilters">
                <input class="input" type="text" v-model="tableData.search" placeholder="Search Contacts" @input="getContacts()">
                <div class="control">
                    <div class="select">
                        <select v-model="tableData.length" @change="getContacts()">
                            <option v-for="view in views" :value="view">{{view}}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="tableOptions">
                <div class="option">
                    <switches v-model="online" theme="bulma" color="green" textDisabled="Update offline" textEnabled="Update online"/>
                </div>
            </div>
            <div class="table_block">
                <div class="loader_block" v-show="loader">
                    <div class="loader"></div>
                </div>
                <div class="table_load" v-bind:class="{ active: loader }">
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
                </div>
            </div>

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
    </div>
</template>

<script>
import Datatable from './Datatable.vue';
import Pagination from './Pagination.vue'
import Switches from 'vue-switches';

export default {
    components: { datatable: Datatable, pagination: Pagination, Switches },
    created() {
        this.getContacts();
        Echo.channel('user-room.1')
            .listen('onAddContactEvent', (e) => {
                if (this.online){
                    e.contact.new = true;
                    this.contacts.unshift(e.contact);
                }
            });
    },

    data() {
        let sortOrders = {},
            columns = [
                {width: '5%', label: 'ID', name: 'id' },
                {width: '23.75%', label: 'Firstname', name: 'firstname' },
                {width: '23.75%', label: 'Phone', name: 'phone'},
                {width: '33.75%', label: 'Email', name: 'email'},
                {width: '13.75%', label: 'City', name: 'city'}
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
            },
            online: true,
            loader: true,
            views: [10, 20, 30, 50, 100]
        }
    },
    methods: {
        getContacts(url = '/api/get_contacts') {
            this.loader = true;
            this.tableData.draw++;
            axios.get(url, {params: this.tableData})
                .then(response => {
                    let data = response.data;
                    if (this.tableData.draw == data.draw) {
                        this.contacts = data.data.data;
                        this.configPagination(data.data);
                        this.loader = false;
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
        onlineChange(value){
            this.online = value;
            this.getContacts();
        },
        edit(contact) {
            this.editForm.contact_form = contact;
            $('#modal-edit-contact').modal('show');
        },
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
