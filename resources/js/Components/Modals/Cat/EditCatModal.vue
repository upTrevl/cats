<template>
    <el-dialog v-model="value" title="Редактирование кота" width="30%" draggable :close-on-click-modal="false">
        <cat-form @close="value = false" @save="saveCat" :cat="cat"/>
    </el-dialog>
</template>

<script setup>
import CatForm from "@/Components/Forms/CatForm.vue";
import {computed, defineEmits, defineProps} from "vue";
import axios from "axios";

const props = defineProps(['modelValue', 'cat'])
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
    params.id = props.cat.id;
    axios
        .put(route('cats.update'), params)
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
