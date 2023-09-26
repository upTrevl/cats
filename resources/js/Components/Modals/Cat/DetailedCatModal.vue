<template>
    <el-dialog v-model="value" :title="cat.name" width="30%" draggable :close-on-click-modal="false">
        <div class="grid grid-cols-2 gap-4 ">
            <div>
                <el-image style="width: 100%; height: 240px" :fit="'contain'" :src="cat.image.storage_name"/>
            </div>
            <div>
                <div>
                    <span>Имя:</span> {{ cat.name }}
                </div>
                <div>
                    <span>Возраст: {{ cat.age }}</span>
                </div>
                <div>
                    <span>Порода: {{ cat.breed.name }}</span>
                </div>
                <div>
                    <span>Средняя продолжительность жизни: {{ cat.breed.avg_age }}</span>
                </div>
            </div>
        </div>
        <div>
            <div>
                Описание:
            </div>
            {{ cat.breed.description }}
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
