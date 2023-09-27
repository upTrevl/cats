<template>
    <el-dialog v-model="value" title="Новая порода" width="20%" draggable :close-on-click-modal="false">
        <breed-form @close="value = false" @save="saveBreed" :errors="errors" @clear-error="clearError"/>
    </el-dialog>
</template>

<script setup>
import axios from "axios";

import {defineProps, defineEmits, computed, ref} from "vue";

import BreedForm from "@/Components/Forms/BreedForm.vue";

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue', 'created'])
const errors = ref({
    name: [],
    description: [],
    avg_age: [],
});

const value = computed({
    get() {
        return props.modelValue
    },
    set(value) {
        emit('update:modelValue', value)
    }
})

const saveBreed = (params) => {
    axios
        .post(route('breeds.store'), params)
        .then(() => {
            emit('created');
            clearErrors();
            value.value = false;
        })
        .catch((error) => {
            clearErrors();
            errors.value = Object.assign(errors.value, error.response.data.errors);
        });
}

const clearErrors = () => {
    errors.value = {
        name: [],
        description: [],
        avg_age: [],
    };
}

const clearError = (field) => {
    errors.value[field] = [];
}
</script>

<style scoped>

</style>
