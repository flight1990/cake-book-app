<script setup>
import {usePage} from "@inertiajs/vue3";
import {computed} from "vue";

const authUser = computed(() => usePage().props.auth);
</script>

<template>
    <div v-if="authUser">
        <div>
            {{ authUser.name }}
        </div>
        <div>
            <small>{{ authUser.email }}</small>
        </div>
    </div>
</template>
