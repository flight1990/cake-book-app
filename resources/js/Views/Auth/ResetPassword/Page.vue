<script setup>
import {useForm} from "@inertiajs/vue3";

const urlParams = new URLSearchParams(window.location.search);
const url = new URL(window.location.href);
const pathSegments = url.pathname.split('/');

const form = useForm({
    email: urlParams.get('email'),
    token: pathSegments[pathSegments.length - 1],
    password: null,
    password_confirmation: null
});

const resetPasswordHandler = () => {
    form.post('/password/reset');
};

</script>

<template>
    <h1>Password reset</h1>

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
            <label for="password_confirmation">Password confirmation</label>
            <input type="password" id="password_confirmation" v-model="form.password_confirmation">
            <small v-if="form.errors.password_confirmation">{{ form.errors.password_confirmation }}</small>
        </div>

        <button @click.prevent="resetPasswordHandler" :disabled="form.processing">
            Reset password
        </button>
    </form>
</template>
