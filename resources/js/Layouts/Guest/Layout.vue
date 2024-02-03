<script setup>
import Navbar from './Navigation/NavbarComponent.vue';
</script>

<template>
    Guest layout

    <Navbar />

    <main>
        <slot></slot>
    </main>

</template>
