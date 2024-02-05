<script setup>
import Navbar from './Navigation/NavbarComponent.vue';
import Auth from '../Share/Auth/AuthUserComponent.vue';
</script>

<template>
    Admin layout

    <Navbar />

    <Auth />

    <main>
        <slot></slot>
    </main>

</template>
