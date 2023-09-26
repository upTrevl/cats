<template>
    <el-dialog v-model="value" :title="props.title" width="20%" draggable>
        <slot/>
        <template #footer>
          <span class="dialog-footer">
            <el-button @click="value = false">
                Отмена
            </el-button>
            <el-button type="danger" @click="$emit('confirm')">
                Подтверждаю
            </el-button>
          </span>
        </template>
    </el-dialog>
</template>

<script setup>
import {computed, defineEmits, defineProps} from "vue";

const props = defineProps(['modelValue', 'title'])
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
