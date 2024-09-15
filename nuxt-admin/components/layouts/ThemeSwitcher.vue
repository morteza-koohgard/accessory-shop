<template>
    <UToggle color="gray" :ui="{ inactive: 'dark:bg-gray-400' }" @click="toggle" size="lg" on-icon="i-heroicons-sun" off-icon="i-heroicons-moon" :model-value="theme" />
</template>

<script setup>
const colorMode = useColorMode()
const theme = ref(false)
const toggle = () => {
    if (colorMode.preference == 'dark') {
        colorMode.preference = 'light'
        theme.value = true
    } else {
        colorMode.preference = 'dark'
        theme.value = false
    }
}
</script>