<template>
    <app-layout>
        <div class="table-header my-3 p-6 bg-white rounded-md flex justify-between">
            <div>
                Таблица котов
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
                :data="cats"
                :row-class-name="tableRowClassName"
            >
                <el-table-column prop="id" width="50"/>
                <el-table-column prop="name" label="Имя"/>
                <el-table-column prop="breed.name" label="Порода"/>
                <el-table-column prop="age" label="Возраст" width="80"/>
                <el-table-column label="" width="140">
                    <template #default="scope">
                        <div class="flex justify-between">
                            <el-button
                                type="success"
                                circle
                                :icon="View"
                                @click="showCatModal(scope.row)"
                            />
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
        <confirm-modal v-model="showDeleteCatModal" @confirm="deleteCat" :title="'Удалить кота?'">
            Вы уверены что хотите удалить кота? Восстановить кота будет не возможно.
        </confirm-modal>
        <create-cat-modal v-if="showCreateCatModal" v-model="showCreateCatModal" @created="getCats"/>
        <detailed-cat-modal v-if="showDetailedCatModal" v-model="showDetailedCatModal" :cat="detailedCat"/>
        <edit-cat-modal v-if="showEditCatModal" v-model="showEditCatModal" :cat="editableCat" @edited="getCats"/>
    </app-layout>
</template>

<script lang="ts" setup>
import axios from 'axios';

import {Edit, Delete, Plus, View} from "@element-plus/icons-vue";
import {onMounted, ref} from "vue";

import AppLayout from "@/Layouts/AppLayout.vue";
import CreateCatModal from "@/Components/Modals/Cat/CreateCatModal.vue";
import ConfirmModal from "@/Components/Modals/ConfirmModal.vue";
import DetailedCatModal from "@/Components/Modals/Cat/DetailedCatModal.vue";
import EditCatModal from "@/Components/Modals/Cat/EditCatModal.vue";

const showCreateCatModal = ref(false);
const showDeleteCatModal = ref(false);
const showDetailedCatModal = ref(false);
const showEditCatModal = ref(false);

const editableCat = ref(null);
const deletableCat = ref(null);
const detailedCat = ref(null);

const cats = ref([]);
const total = ref(0);
const page = ref(1);

const tableRowClassName = ({row, rowIndex}) => {
    switch (row.age_status) {
        case 'young':
            return 'success-row'
        case 'old':
            return 'warning-row'
        case 'critical':
            return 'danger-row'
    }
}

const showCreateModal = () => {
    showCreateCatModal.value = true;
}

const showEditModal = (item) => {
    editableCat.value = item;
    showEditCatModal.value = true;
}

const showDeleteModal = (item) => {
    deletableCat.value = item;
    showDeleteCatModal.value = true;
}

const showCatModal = (item) => {
    detailedCat.value = item
    showDetailedCatModal.value = true;
}

const deleteCat = () => {
    axios
        .delete(route('cats.delete', {id: deletableCat.value.id}))
        .then(() => {
            showDeleteCatModal.value = false;
            getCats();
        })
        .catch((error) => {
            console.log(error)
        });
}

const getCats = () => {
    const params = {
        page: page.value,
    };
    axios
        .get(route('cats.get'), {params})
        .then((response) => {
            cats.value = response.data.items
            total.value = response.data.total
        })
        .catch((error) => {
            console.log(error)
        });
}

const pageChanged = (currentPage) => {
    page.value = currentPage;
    getCats();
}

onMounted(() => {
    getCats();
})
</script>

<style>
</style>
