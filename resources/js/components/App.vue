<template>

    <v-app>
        <v-app-bar app>
            LOGO
        </v-app-bar>

        <v-main>
            <register/>
        </v-main>
    </v-app>

</template>

<script>
    import Register from './auth/Register'

    export default {
        name: 'app',
        components: {
            Register,
        },
        data() {
            return {}
        },
        methods: {}
    }
</script>
