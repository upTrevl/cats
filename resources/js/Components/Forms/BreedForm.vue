<template>
    <el-form :label-position="'top'">
        <div>
            <div>
                <el-form-item label="Название">
                    <el-input type="text" v-model="form.name"/>
                </el-form-item>
                <el-form-item label="Описание">
                    <el-input
                        :autosize="{ minRows: 4}"
                        type="textarea"
                        v-model="form.description"
                    />
                </el-form-item>
                <el-form-item label="Средняя продолжительность жизни">
                    <el-input type="number" min="1" max="100" v-model="form.avg_age">
                        <template #append>лет</template>
                    </el-input>
                </el-form-item>
            </div>
        </div>
        <div class="flex justify-center mt-6">
            <el-button @click="$emit('close')">
                Закрыть
            </el-button>
            <el-button type="primary" @click="$emit('save', form)">
                Сохранить
            </el-button>
        </div>
    </el-form>
</template>

<script setup>
import {defineProps, reactive} from "vue";

const props = defineProps({
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
