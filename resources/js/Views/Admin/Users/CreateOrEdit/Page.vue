<script setup>

import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    user: {
        type: Object,
        required: false
    }
});

const form = useForm({
    name: props.user?.name ?? null,
    email: props.user?.email ?? null,
    password: null,
    password_confirmation: null
});

const createUserAction = () => {
    form.post('/admin/users');
}

const updateUserAction = () => {
    form.patch(`/admin/users/${props.user.id}`);
}

const submitHandler = () => {
    props.user ? updateUserAction() : createUserAction();
}

</script>

<template>
    <h1>{{ props.user ? 'Edit' : 'Create new' }} user</h1>

    <form>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" v-model="form.name">
            <small v-if="form.errors.name">{{ form.errors.name }}</small>
        </div>

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

        <button @click.prevent="submitHandler" :disabled="form.processing">
            {{ props.user ? 'Update' : 'Create' }}
        </button>

        <inertia-link href="/admin/users">Return back</inertia-link>
    </form>

</template>
