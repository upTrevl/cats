<template>
    <el-dialog v-model="value" title="Новая порода" width="20%" draggable :close-on-click-modal="false">
        <breed-form @close="value = false" @save="saveBreed"/>
    </el-dialog>
</template>

<script setup>
import axios from "axios";

import {defineProps, defineEmits, computed} from "vue";

import BreedForm from "@/Components/Forms/BreedForm.vue";

const props = defineProps(['modelValue'])
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
    axios
        .post(route('breeds.store'), params)
        .then(() => {
            emit('created');
            value.value = false;
        })
        .catch((error) => {
            console.log(error);
        });
}
</script>

<style scoped>

</style>
