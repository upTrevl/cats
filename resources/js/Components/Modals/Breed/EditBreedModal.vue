<template>
    <el-dialog v-model="value" title="Редактирование породы" width="20%" draggable :close-on-click-modal="false">
        <breed-form @close="value = false" @save="saveBreed" :breed="breed"/>
    </el-dialog>
</template>

<script setup>
import axios from "axios";

import {defineProps, defineEmits, computed} from "vue";

import BreedForm from "@/Components/Forms/BreedForm.vue";

const props = defineProps(['modelValue', 'breed'])
const emit = defineEmits(['update:modelValue'])

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
        })
        .catch((error) => {
            console.log(error);
        });
}

</script>

<style scoped>

</style>
