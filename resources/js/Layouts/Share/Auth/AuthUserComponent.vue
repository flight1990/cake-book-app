<script setup>
import {router, usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const authUser = computed(() => usePage().props.auth);

const logoutHandler = () => {
    router.post('/logout');
}
</script>

<template>
    <div v-if="authUser">
        <div>
            {{ authUser.name }}
        </div>

        <div>
            <small>{{ authUser.email }}</small>
        </div>

        <ul>
            <li>
                <inertia-link href="/profile">Profile</inertia-link>
            </li>
            <li>
                <a href="/logut" @click.prevent="logoutHandler">Logout</a>
            </li>
        </ul>
    </div>
</template>
