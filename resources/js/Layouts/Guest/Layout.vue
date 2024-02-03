<script setup>
import Navbar from './Navigation/NavbarComponent.vue';
import Auth from './Auth/AuthUserComponent.vue';
</script>

<template>
    Guest layout

    <Navbar />

    <Auth />

    <main>
        <slot></slot>
    </main>

</template>
