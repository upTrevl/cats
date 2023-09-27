<template>
    <el-form :label-position="'top'">
        <div>
            <div>
                <el-form-item label="Название" :error="errors.name[0]">
                    <el-input
                        v-model="form.name"
                        type="text"
                        @input="emit('clear-error', 'name')"
                    />
                </el-form-item>
                <el-form-item label="Описание" :error="errors.description[0]">
                    <el-input
                        v-model="form.description"
                        :autosize="{ minRows: 4}"
                        type="textarea"
                        @input="emit('clear-error', 'description')"
                    />
                </el-form-item>
                <el-form-item label="Средняя продолжительность жизни" :error="errors.avg_age[0]">
                    <el-input
                        v-model="form.avg_age"
                        type="number"
                        min="1"
                        max="100"
                        @input="emit('clear-error', 'avg_age')"
                    >
                        <template #append>лет</template>
                    </el-input>
                </el-form-item>
            </div>
        </div>
        <div class="flex justify-center mt-6">
            <el-button @click="emit('close')">
                Закрыть
            </el-button>
            <el-button type="primary" @click="emit('save', form)">
                Сохранить
            </el-button>
        </div>
    </el-form>
</template>

<script setup>
import {defineEmits, defineProps, reactive} from "vue";

const emit = defineEmits(['clear-error', 'save', 'close'])

const props = defineProps({
    errors: {
        type: Object,
        default() {
            return {
                name: [],
                description: [],
                avg_age: [],
            }
        }
    },
    breed: {
        type: Object,
        default() {
            return {
                name: '',
                description: '',
                avg_age: null,
            }
        }
    },
})

const form = reactive({
    name: props.breed.name,
    description: props.breed.description,
    avg_age: props.breed.avg_age,
})
</script>

<style scoped>

</style>
