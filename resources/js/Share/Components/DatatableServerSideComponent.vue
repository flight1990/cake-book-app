<script setup>
import {ref, watch, computed} from "vue";

const props = defineProps({
    headers: {
        type: Array,
        required: true
    },
    items: {
        type: Array,
        required: true
    },
    itemsLength: {
        type: Number,
        required: true
    },
    perPage: {
        type: Number,
        required: false,
        default: 10
    },
    itemsPerPageOptions: {
        type: Array,
        required: false,
        default: () => [
            {label: '10', value: 10},
            {label: '25', value: 25},
            {label: '50', value: 50},
            {label: '100', value: 100},
        ]
    },
    loading: {
        type: Boolean,
        required: false,
        default: false
    },
    noDataText: {
        type: String,
        required: false,
        default: 'No items found...'
    },
    loadingText: {
        type: String,
        required: false,
        default: 'Loading...'
    },
    itemsPerPageOptionsText: {
        type: String,
        required: false,
        default: 'Items per page:'
    },
    selectedText: {
        type: String,
        required: false,
        default: 'Selected:'
    },
    pageText: {
        type: String,
        required: false,
        default: '{0} - {1} of {2}'
    },
    currentPageText: {
        type: String,
        required: false,
        default: 'Page:'
    },
    showCurrentPage: {
        type: Boolean,
        required: false,
        default: true
    },
    showPageText: {
        type: Boolean,
        required: false,
        default: true
    },
    showSelected: {
        type: Boolean,
        required: false,
        default: true
    }
});

const options = ref({
    perPage: props.perPage,
    page: 1,
});

const emits = defineEmits([
    'update:perPage',
    'update:page',
    'update:options',
    'rowDblClick',
]);

const rowDbClickHandler = (item) => {
    emits('rowDblClick', item);
};

const updateOptionsHandler = () => {
    emits('update:options', options.value);
};

const updatePerPageHandler = () => {
    emits('update:perPage', options.value.perPage);
};

const updatePageHandler = () => {
    emits('update:page', options.value.page);
};

const prevPageHandler = () => {
    options.value.page--;
    updatePageHandler();
};

const nextPageHandler = () => {
    options.value.page++;
    updatePageHandler();
};

watch(() => options.value, updateOptionsHandler, {deep: true});

const headersLength = computed(() => props.showSelected ? props.headers.length + 1 : props.headers.length);
const paginateStartIndex = computed(() => (options.value.page - 1) * options.value.perPage + 1);
const paginateEndIndex = computed(() => Math.min(paginateStartIndex.value + options.value.perPage - 1, props.itemsLength));

const pageText = computed(() => {
    return props.pageText.replace('{0}', String(paginateStartIndex.value))
        .replace('{1}', String(paginateEndIndex.value))
        .replace('{2}', props.itemsLength);
});

</script>

<template>
    <table>
        <thead>
        <tr>
            <th v-for="header in props.headers">
                <slot :name="`header.${header.id}`">
                    {{ header.title }}
                </slot>
            </th>
        </tr>
        </thead>
        <tbody>
        <template v-if="props.items.length">
            <tr v-for="item in props.items" @dblclick="rowDbClickHandler(item)">
                <td v-for="header in props.headers">
                    <slot :name="`item.${header.id}`" :item="item">
                        {{ item[header.id] }}
                    </slot>
                </td>
            </tr>
        </template>
        <template v-else>
            <tr>
                <td :colspan="headersLength">
                    {{ props.loading ? props.loadingText : props.noDataText }}
                </td>
            </tr>
        </template>
        </tbody>
        <tfoot>
        <tr>
            <td :colspan="headersLength">
                <label
                    for="itemsPerPageOption"
                >
                    {{ props.itemsPerPageOptionsText }}
                </label>

                <select
                    id="itemsPerPageOption"
                    v-model="options.perPage"
                    @change="updatePerPageHandler"
                >
                    <option
                        v-for="itemsPerPageOption in props.itemsPerPageOptions"
                        :value="itemsPerPageOption.value"
                    >
                        {{ itemsPerPageOption.label }}
                    </option>
                </select>

                <span v-if="props.showPageText">
                    {{ pageText }}
                </span>

                <button
                    v-if="options.page > 1"
                    @click.prevent="prevPageHandler"
                >
                    <
                </button>

                <span v-if="props.showCurrentPage">
                   {{ props.currentPageText }} {{ options.page }}
                </span>

                <button
                    v-if="options.page < Math.ceil(props.itemsLength / options.perPage)"
                    @click.prevent="nextPageHandler"
                >
                    >
                </button>
            </td>
        </tr>
        </tfoot>
    </table>
</template>
