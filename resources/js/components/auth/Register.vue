<template>

    <v-container>
        <v-card
            class="mx-auto"
            max-width="600"
            elevation="2"
            :loading="savingUser"
            :disabled="savingUser"
        >
            <v-card-title>
                Register Form
            </v-card-title>

            <v-card-text>
                <v-alert v-if="alert.type" text outlined :type="alert.type">
                    <strong v-if="alert.title">{{ alert.title }}</strong> <br>
                    <template v-if="!isString(alert.message)">
                        <div v-for="message in alert.message">
                            <template v-if="!isString(message)">
                                <div v-for="msg in message">
                                    {{ msg }}
                                </div>
                            </template>
                            <template v-else>
                                {{ message }}
                            </template>
                        </div>
                    </template>
                    <template v-else>
                        <div>
                            {{ alert.message }}
                        </div>
                    </template>
                </v-alert>

                <v-form>
                    <v-text-field
                        label="Full Name"
                        v-model="user.full_name"
                    />

                    <v-autocomplete
                        label="Country"
                        placeholder="Type to search..."
                        item-text="name"
                        item-value="id"
                        :items="countries.data"
                        :loading="countries.loading"
                        :search-input.sync="countries.searchValue"
                        v-model="user.country_id"
                    >
                        <template v-slot:selection="data">
                            {{ data.item.flag }} {{ data.item.name }}
                        </template>
                        <template v-slot:item="data">
                            {{ data.item.flag }} {{ data.item.name }}
                        </template>
                    </v-autocomplete>

                    <v-text-field
                        class="phone-number-field"
                        label="Phone Number"
                        :disabled="!user.country_id"
                        v-model="user.phone_number"
                    />

                    <v-text-field
                        label="Email"
                        v-model="user.email"
                    />
                </v-form>
            </v-card-text>

            <v-card-actions>
                <v-btn color="primary" text @click="register">
                    Register
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-container>

</template>

<script>
    import apiCountries from '../../api/countries'
    import apiUsers from '../../api/users'
    import Cleave from 'cleave.js'

    export default {
        name: 'register',
        components: {},
        data() {
            return {
                phoneNumberCleave: null,
                alert: {type: null, title: null, message: null},
                savingUser: false,
                countries: {
                    loading: false,
                    searchValue: null,
                    data: [],
                },
                user: {
                    full_name: null,
                    country_id: null,
                    country: null,
                    phone_number: null,
                    email: null,
                }
            }
        },
        watch: {
            'countries.searchValue'() {
                this.fetchCountries()
            },
            'user.country_id'() {
                this.user.country = _.find(this.countries.data, {id: this.user.country_id}) || null
                this.user.phone_number = ''

                this.formatPhoneNumberField()
            }
        },
        methods: {
            isString(val) {
                return _.isString(val)
            },
            fetchCountries() {
                if (!this.countries.searchValue) {
                    this.countries.data = []
                    return
                }

                this.countries.loading = true

                return apiCountries.get({search: this.countries.searchValue})
                    .then(response => {
                        this.countries.data = response.data
                    })
                    .finally(() => {
                        this.countries.loading = false
                    })
            },
            initUser() {
                let user = {
                    full_name: null,
                    country_id: null,
                    country: null,
                    phone_number: null,
                    email: null,
                }

                this.user = user
            },
            initAlert() {
                this.alert.type = null
                this.alert.title = null
                this.alert.message = null
            },
            formatPhoneNumberField() {
                if (this.phoneNumberCleave) {
                    this.phoneNumberCleave.destroy()
                }
                if (!this.user.country) {
                    return
                }

                this.$nextTick(() => {
                    this.phoneNumberCleave = new Cleave('.phone-number-field input', {
                        // country code is not saved - not possible to set
                        // phone: true,
                        // phoneRegionCode: this.user.country.code,

                        prefix: this.user.country.idd,
                        blocks: [this.user.country.idd.length, 2, 3, 2, 2],
                        delimiters: [' ', ' ', '-', '-'],
                        noImmediatePrefix: true
                    })
                })
            },
            register() {
                this.savingUser = true

                this.initAlert()

                return apiUsers.store(this.user)
                    .then(response => {
                        this.initUser()

                        this.alert.type = 'success'
                        this.alert.title = 'Success'
                        this.alert.message = response.data.message
                    })
                    .catch(error => {
                        this.alert.type = 'error'
                        this.alert.title = error.response.data.message
                        this.alert.message = error.response.data.errors
                    })
                    .finally(() => {
                        this.savingUser = false
                    })
            }
        }
    }
</script>
