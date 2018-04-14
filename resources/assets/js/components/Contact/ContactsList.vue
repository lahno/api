<style scoped>
    .action-link {
        cursor: pointer;
    }
    .m-b-none {
        margin-bottom: 0;
    }
    .label-new{
        position: absolute;
        right: 0px;
        top: 10px;
    }
    .table_tr td{
        position: relative;
    }
    .table_tr.table_tr_new{
        background: #3097d140;
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
    <div>
        <transition name="slide-fade">
        <div class="alert alert-info" v-if="message">
            {{ message }}
        </div>
        </transition>

        <div class="panel panel-default">
            <div class="panel-heading">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        Contacts <span class="label label-success" v-if="contacts.length > 0">{{contacts.length}}</span>
                    </span>
                </div>
            </div>

            <div class="panel-body">
                <!-- Current Contacts -->
                <p class="m-b-none" v-if="contacts.length === 0">
                    Not created any Contacts.
                </p>

                <transition name="slide-fade">
                <table id="contactsTable" class="table table-borderless m-b-none" v-if="contacts.length > 0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Firstname</th>
                            <th>Secondname</th>
                            <th>Lastname</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="contact in contacts" class="table_tr" v-bind:class="{ table_tr_new: contact.new}">
                            <td>{{contact.id}}</td>
                            <td>{{contact.firstname}}</td>
                            <td>{{contact.secondname}}</td>
                            <td>{{contact.lastname}}</td>
                            <td>{{contact.phone}}</td>
                            <td>{{contact.email}}<span class="label label-primary label-new" v-if="contact.new">New</span></td>
                            <td>
                                <button type="button" class="btn btn-link btn-xs" @click="edit(contact)"><span class="glyphicon glyphicon-search"></span></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </transition>
            </div>

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

                        <div class="modal-body">
                            <table class="table table-bordered table-hover table-condensed table-responsive">
                                <tbody>
                                <tr v-for="(value, key) in editForm.contact_form">
                                    <td><strong>{{ key }}</strong></td>
                                    <td v-if=" key === 'photo' &&  value !== null || key === 'photo_soc' &&  value !== null">
                                        <img :src="'file_download/photo_users/' + value" class="img-responsive img-thumbnail">
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
    export default {
        /*
         * The component's data.
         */
        data() {
            return {
                contacts: [],

                message: '',

                editForm: {
                    errors: [],
                    contact_form: []
                }
            };
        },

        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },

        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },

        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getContacts();

                Echo.channel('user-room.1')
                    .listen('onAddContactEvent', (e) => {
                        e.contact.new = true;
                        this.contacts.push(e.contact);
                    });
            },

            /**
             * Get all of the OAuth Users for the contac.
             */
            getContacts() {
                axios.get('/api/get_contacts')
                    .then(response => {
                        this.contacts = response.data;
                    });
            },

            /**
             * Edit the given Contact.
             */
            edit(contact) {
                this.editForm.contact_form = contact;

                $('#modal-edit-Contact').modal('show');
            },

            /**
             * Destroy the given client.
             */
            destroy(contact) {
                axios.get('/api/contacts/delete/' + contact.id)
                    .then(response => {
                        this.getContacts();
                    });
                $('#modal-edit-Contact').modal('hide');
                this.message = 'Deleted ID: '+contact.id;
            }

        }
    }
</script>
