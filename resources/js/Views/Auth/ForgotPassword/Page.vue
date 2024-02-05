<script setup>
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    email: null
});

const sendResetLinkHandler = () => {
    form.post("/password/email");
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

        <button @click.prevent="sendResetLinkHandler" :disabled="form.processing">
            Email password reset link
        </button>
    </form>
</template>
