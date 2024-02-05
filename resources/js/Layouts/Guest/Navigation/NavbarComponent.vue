<script setup>
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const authUser = computed(() => usePage().props.auth);
</script>

<template>
    <ul>
        <li>
            <inertia-link href="/">Home</inertia-link>
        </li>
        <template v-if="authUser">
            <li>
                <inertia-link href="/admin">Dashboard</inertia-link>
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
