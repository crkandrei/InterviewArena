<template>
    <div class="flex justify-center items-center">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
    </div>
</template>

<script>
export default {
    name: 'Loader'
};
</script>

<style scoped>
.loader {
    border-top-color: #3498db;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}
</style>
