<template>

    <div style="width:400px;margin:0 auto;text-align: center;">
        <h1>退出中...</h1>
        <a-spin :size="100">
            <template #icon>
                <icon-sync />
            </template>
        </a-spin>
    </div>

</template>

<script setup>
import { onMounted } from 'vue';

onMounted(() => {
    location.href = '/logout';
});
</script>