<template>
    <el-dialog v-model="value" title="Редактирование породы" width="20%" draggable :close-on-click-modal="false">
        <breed-form @close="value = false" @save="saveBreed" :breed="breed" :errors="errors" @clear-error="clearError"/>
    </el-dialog>
</template>

<script setup>
import axios from "axios";

import {defineProps, defineEmits, computed, ref} from "vue";

import BreedForm from "@/Components/Forms/BreedForm.vue";

const props = defineProps(['modelValue', 'breed'])
const emit = defineEmits(['update:modelValue', 'edited'])
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
    params.id = props.breed.id;
    axios
        .put(route('breeds.update'), params)
        .then(() => {
            emit('edited');
            value.value = false;
            clearErrors();
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
