<script setup>

</script>

<template>
    <div class="bg-gray-50 h-screen">
        <el-menu mode="horizontal">
            <div class="container mx-auto flex">
                <el-menu-item index="/">
                    <el-link :underline="false" :href="route('cats')">
                        Коты
                    </el-link>
                </el-menu-item>
                <el-menu-item index="/breeds">
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
