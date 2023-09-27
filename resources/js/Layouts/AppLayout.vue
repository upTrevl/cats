<script setup>
import {onBeforeMount, ref} from "vue";

onBeforeMount(() => {
    activePage.value = route().current();
    console.log(activePage);
})

const activePage = ref('breeds.index');
</script>

<template>
    <div class="bg-gray-50 h-screen">
        <el-menu mode="horizontal" :default-active="activePage">
            <div class="container mx-auto flex">
                <el-menu-item index="cats">
                    <el-link :underline="false" :href="route('cats')">
                        Коты
                    </el-link>
                </el-menu-item>
                <el-menu-item index="breeds.index">
                    <el-link :underline="false" :href="route('breeds.index')">
                        Породы
                    </el-link>
                </el-menu-item>
            </div>
        </el-menu>
        <div class="container mx-auto p-4">
            <main>
                <slot/>
            </main>
        </div>
    </div>
</template>

<style>

.el-menu-item.is-active .el-link {
    color: var(--el-menu-active-color)!important;
}

</style>
