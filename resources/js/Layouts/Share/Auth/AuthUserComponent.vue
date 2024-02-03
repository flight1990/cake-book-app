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

        <div>
            <a href="/logut" @click.prevent="logoutHandler">Logout</a>
        </div>
    </div>
</template>
