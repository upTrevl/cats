<template>
    <el-dialog v-model="value" title="Новый кот" width="30%" draggable :close-on-click-modal="false">
        <cat-form @close="value = false" @save="saveCat"/>
    </el-dialog>
</template>

<script lang="ts" setup>
import {defineProps, defineEmits} from "vue";
import {computed} from 'vue'
import CatForm from "@/Components/Forms/CatForm.vue";
import axios from "axios";

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

const saveCat = (params) => {
    axios
        .post('/cats/store', params)
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
