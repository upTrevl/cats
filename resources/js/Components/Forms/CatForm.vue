<template>
    <el-form :label-position="'top'">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <el-form-item label="Имя" :error="errors.name[0]">
                    <el-input type="text" v-model="form.name" @input="emit('clear-error', 'name')"/>
                </el-form-item>
                <el-form-item label="Порода" :error="errors.breed_id[0]">
                    <el-autocomplete
                        v-model="currentBreed"
                        :fetch-suggestions="searchBreeds"
                        clearable
                        class="w-full"
                        value-key="name"
                        @select="handleSelect"
                    />
                </el-form-item>
                <el-form-item label="Возраст" :error="errors.age[0]">
                    <el-input type="number" min="1" max="100" v-model="form.age" @input="emit('clear-error', 'age')">
                        <template #append>лет</template>
                    </el-input>
                </el-form-item>
            </div>
            <div class="relative">
                <el-image style="width: 100%; height: 240px" :fit="'contain'" :src="preview"/>
                <el-button
                    type="primary"
                    circle
                    class="absolute right-0"
                    :icon="Refresh"
                    @click="getRandomImage"
                />
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

<script lang="ts" setup>
import axios from "axios";
import {onMounted, ref, reactive, defineProps, defineEmits} from "vue";
import {Refresh} from "@element-plus/icons-vue";

const emit = defineEmits(['clear-error', 'save', 'close'])
const props = defineProps({
    errors: {
        type: Object,
        default() {
            return {
                name: [],
                breed_id: [],
                age: [],
            }
        }
    },
    cat: {
        type: Object,
        default() {
            return {
                name: '',
                breed_id: 0,
                age: null,
                image_id: 0,
                image: {
                    storage_name: ''
                },
                breed: {
                    name: '',
                }
            }
        }
    },
})

const preview = ref(props.cat.image.storage_name);
const currentBreed = ref(props.cat.breed.name);

const form = reactive({
    name: props.cat.name,
    breed_id: props.cat.breed_id,
    age: props.cat.age,
    file_id: props.cat.image_id,
})

const searchBreeds = (queryString: string, cb: any) => {
    const params = {
        search_query: queryString,
    };
    axios
        .get(route('breeds.search'), {params})
        .then((response) => {
            cb(response.data);
        });

}

const getRandomImage = () => {
    axios
        .get(route('cats.get-random-image'))
        .then((response) => {
            preview.value = response.data.storage_name;
            form.file_id = response.data.id;
        });
}

const handleSelect = (item) => {
    emit('clear-error', 'breed_id');
    form.breed_id = item.id;
}

onMounted(() => {
    if (!preview.value) {
        getRandomImage();
    }
})
</script>

<style scoped>

</style>
