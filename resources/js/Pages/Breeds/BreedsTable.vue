<template>
    <app-layout>
        <div class="table-header my-3 p-6 bg-white rounded-md flex justify-between">
            <div>
                Таблица пород
            </div>
            <div>
                <el-button type="primary" @click="showCreateModal">
                    <el-icon :size="20" class="mr-3">
                        <Plus/>
                    </el-icon>
                    Добавить
                </el-button>
            </div>
        </div>
        <div class="bg-white my-3  p-6 rounded-md">
            <el-table
                border
                :data="breeds"
            >
                <el-table-column prop="id" width="50"/>
                <el-table-column prop="name" label="Название" width="150"/>
                <el-table-column prop="description" label="Описание"/>
                <el-table-column prop="avg_age" label="Продолжительность жизни" width="180"/>
                <el-table-column label="" width="100">
                    <template #default="scope">
                        <div class="flex justify-between">
                            <el-button
                                type="primary"
                                circle
                                :icon="Edit"
                                @click="showEditModal(scope.row)"
                            />
                            <el-button
                                type="danger"
                                circle
                                :icon="Delete"
                                @click="showDeleteModal(scope.row)"
                            />
                        </div>
                    </template>
                </el-table-column>
            </el-table>
            <el-pagination
                class="my-3"
                layout="prev, pager, next"
                :total="total"
                @current-change="pageChanged"
            />
        </div>
        <confirm-modal v-model="showDeleteBreedModal" @confirm="deleteBreed" :title="'Удалить породу?'">
            Вы уверены что хотите удалить породу? Восстановить породу будет не возможно.
        </confirm-modal>
        <create-breed-modal v-if="showCreateBreedModal" v-model="showCreateBreedModal" @created="getBreeds"/>
        <edit-breed-modal v-if="showEditBreedModal" v-model="showEditBreedModal" :breed="editableBreed"
                          @edited="getBreeds"/>
    </app-layout>
</template>

<script setup>
import axios from 'axios';

import {onMounted, ref} from "vue";

import {Edit, Delete, Plus} from "@element-plus/icons-vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import ConfirmModal from "@/Components/Modals/ConfirmModal.vue";
import CreateBreedModal from "@/Components/Modals/Breed/CreateBreedModal.vue";
import EditBreedModal from "@/Components/Modals/Breed/EditBreedModal.vue";

const showCreateBreedModal = ref(false);
const showDeleteBreedModal = ref(false);
const showEditBreedModal = ref(false);

const editableBreed = ref(null);
const deletableBreed = ref(null);

const breeds = ref([]);
const total = ref(0);
const page = ref(1);

const showCreateModal = () => {
    showCreateBreedModal.value = true;
}

const showEditModal = (item) => {
    editableBreed.value = item;
    showEditBreedModal.value = true;
}

const showDeleteModal = (item) => {
    deletableBreed.value = item;
    showDeleteBreedModal.value = true;
}

const deleteBreed = () => {
    axios
        .delete('/breeds/delete/' + deletableBreed.value.id)
        .then(() => {
            showDeleteBreedModal.value = false;
            getBreeds();
        })
        .catch((error) => {
            console.log(error)
        });
}

const getBreeds = () => {
    const params = {
        page: page.value,
    };
    axios
        .get('/breeds/get', {params})
        .then((response) => {
            breeds.value = response.data.items
            total.value = response.data.total
        })
        .catch((error) => {
            console.log(error)
        });
}

const pageChanged = (currentPage) => {
    page.value = currentPage;
    getBreeds();
}

onMounted(() => {
    getBreeds();
})
</script>

<style scoped>

</style>
