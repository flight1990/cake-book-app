<script setup>
import DatatableServerSide from "../../../../Share/Components/DatatableServerSideComponent.vue";

import {onMounted, ref, watch} from "vue";
import {router} from "@inertiajs/vue3";

const items = ref([]);

const headers = ref([
    {id: 'id', title: 'ID'},
    {id: 'name', title: 'Name'},
    {id: 'email', title: 'Email'},
    {id: 'created_at', title: 'Created at'},
    {id: 'updated_at', title: 'Updated at'},
    {id: 'actions', title: 'Actions'},
]);

const loading = ref(false);

const itemsLength = ref(0);

const params = ref({
    page: 1,
    limit: 10
});

const getUsersAction = () => {
    router.get('/admin/users', params.value, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        only: ['users'],
        onStart: () => {
            loading.value = true;
        },
        onSuccess: (response) => {
            items.value = response.props.users.data;
            itemsLength.value = response.props.users.meta.total;

            loading.value = false;
        },
        onError: (error) => {
            console.log(error);
            loading.value = false;
        }
    });
}

const deleteUserAction = (id) => {
    router.delete(`/admin/users/${id}`, {
        preserveScroll: true,
        preserveState: true,
        replace: true,
        onSuccess: () => {
            getUsersAction();
        },
        onError: (error) => {
            console.log(error);
        }
    });
}

onMounted(() => getUsersAction());
watch(() => params.value, () => getUsersAction(), {deep: true});

</script>

<template>
    <h1>Users</h1>

    <inertia-link href="/admin/users/create">Create new user</inertia-link>

    <DatatableServerSide
        :headers="headers"
        :items="items"
        :items-length="itemsLength"
        :loading="loading"
        @update:page="params.page = $event"
        @update:perPage="params.limit = $event"
    >
        <template v-slot:item.actions="{ item }">
            <inertia-link
                :href="`/admin/users/${item.id}/edit`"
            >
                Edit
            </inertia-link>

            <a
                :href="`/admin/users/${item.id}/delete`"
                @click.prevent="deleteUserAction(item.id)"
            >
                Delete
            </a>
        </template>
    </DatatableServerSide>
</template>
