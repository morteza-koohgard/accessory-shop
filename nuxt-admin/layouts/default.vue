<template>
    <div class="w-full flex justify-center bg-sky-50 dark:bg-sky-950 min-h-screen">
        <div class="w-full max-w-[1920px]">
            <!-- header section -->
            <LayoutsHeaderSection />
            <!-- main section -->
            <div class="w-full grid grid-cols-1 md:grid-cols-12">
                <!-- left sidebar -->
                <div class="hidden md:block w-full bg-gradient-to-r from-sky-50 to-sky-100 dark:from-sky-950 dark:to-sky-900 col-span-3 h-[calc(100vh_-_64px)] lg:h-[calc(100vh_-_72px)] border-r border-sky-300 dark:border-sky-800">
                    <layoutsSidebar />
                </div>
                <!-- content -->
                <div></div>
            </div>
        </div>
    </div>
</template>

<script setup>

</script>

<style lang="scss" scoped></style>