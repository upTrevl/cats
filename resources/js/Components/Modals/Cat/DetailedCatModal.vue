<template>
    <el-dialog v-model="value" :title="cat.name" width="30%" draggable>
        <div class="grid grid-cols-2 gap-4 ">
            <div>
                <el-image style="width: 100%; height: 240px" :fit="'contain'" :src="cat.image.storage_name"/>
            </div>
            <div class="text-base">
                <div class="mb-2">
                    <span class="text-gray-500 font-semibold">Имя:</span> {{ cat.name }}
                </div>
                <div class="mb-2">
                    <span class="text-gray-500 font-semibold">Возраст:</span> {{ cat.age }}
                </div>
                <div class="mb-2">
                    <span class="text-gray-500 font-semibold">Порода:</span> {{ cat.breed.name }}
                </div>
                <div class="mb-2">
                    <span class="text-gray-500 font-semibold">Средняя продолжительность жизни:</span>
                    {{ cat.breed.avg_age }}
                </div>
                <div class="mb-2">
                    <span class="text-gray-500 font-semibold">Описание:</span> {{ cat.breed.description }}
                </div>
            </div>
        </div>
    </el-dialog>
</template>
<script setup>
import {computed, defineEmits, defineProps} from "vue";

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

</script>

<style scoped>

</style>
