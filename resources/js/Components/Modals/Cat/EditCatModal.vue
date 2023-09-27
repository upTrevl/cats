<template>
    <el-dialog v-model="value" title="Редактирование кота" width="30%" draggable :close-on-click-modal="false">
        <cat-form @close="value = false" @save="saveCat" :cat="cat" :errors="errors" @clear-error="clearError"/>
    </el-dialog>
</template>

<script setup>
import CatForm from "@/Components/Forms/CatForm.vue";
import {computed, defineEmits, defineProps, ref} from "vue";
import axios from "axios";

const props = defineProps(['modelValue', 'cat'])
const emit = defineEmits(['update:modelValue', 'edited'])
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
    params.id = props.cat.id;
    axios
        .put(route('cats.update'), params)
        .then(() => {
            emit('edited');
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
