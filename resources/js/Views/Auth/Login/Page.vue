<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
    remember: false
});

const loginHandler = () => {
    form.post("/login");
};

</script>

<template>
    <h1>Login</h1>

    <form>
        <div>
            <label for="email">Email</label>
            <input type="text" id="email" v-model="form.email">
            <small v-if="form.errors.email">{{ form.errors.email }}</small>
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" id="password" v-model="form.password">
            <small v-if="form.errors.password">{{ form.errors.password }}</small>
        </div>

        <div>
            <label for="remember">Remember me</label>
            <input type="checkbox" id="remember" v-model="form.remember">
        </div>

        <button @click.prevent="loginHandler" :disabled="form.processing">Login</button>
    </form>

    <inertia-link href="/register">Register</inertia-link>
</template>
