<template>
    <el-dialog v-model="value" title="Новый кот" width="30%" draggable :close-on-click-modal="false">
        <cat-form @close="value = false" @save="saveCat" :errors="errors" @clear-error="clearError"/>
    </el-dialog>
</template>

<script lang="ts" setup>
import {defineProps, defineEmits, ref} from "vue";
import {computed} from 'vue'
import CatForm from "@/Components/Forms/CatForm.vue";
import axios from "axios";

const props = defineProps(['modelValue'])
const emit = defineEmits(['update:modelValue', 'created'])
const errors = ref({
    name: [],
    breed_id: [],
    age: [],
});

const value = computed({
    get() {
        return props.modelValue
    },
    set(value) {
        emit('update:modelValue', value)
    }
})

const saveCat = (params) => {
    axios
        .post(route('cats.store'), params)
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
        breed_id: [],
        age: [],
    };
}

const clearError = (field) => {
    errors.value[field] = [];
}

</script>

<style scoped>

</style>
