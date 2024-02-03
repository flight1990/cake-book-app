<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const authUser = computed(() => usePage().props.auth);

const logoutHandler = () => {
    router.post('/logout');
}

</script>

<template>
    <ul>
        <li>
            <inertia-link href="/">Home</inertia-link>
        </li>
        <template v-if="authUser">
            <li>
                <a href="/logut" @click.prevent="logoutHandler">Logout</a>
            </li>
        </template>

        <template v-else>
            <li>
                <inertia-link href="/login">Login</inertia-link>
            </li>
            <li>
                <inertia-link href="/register">Register</inertia-link>
            </li>
        </template>
    </ul>
</template>
