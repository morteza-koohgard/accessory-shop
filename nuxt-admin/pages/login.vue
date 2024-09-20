<template>
    <div class="w-full h-screen bg-sky-50 dark:bg-sky-950 flex justify-center items-center">
        <UCard class="w-full h-screen sm:w-2/3 sm:h-auto md:w-1/2 lg:w-1/3">
            <div class="main-header border-b border-sky-400 dark:border-sky-600 pb-2">
                Login
            </div>

            <div class="mt-8">
                <UForm :state="form" class="space-y-4" @submit="">
                    <UFormGroup label="Email" name="email">
                        <UInput v-model="form.email" color="sky" required />
                    </UFormGroup>

                    <UFormGroup label="Password" name="password">
                        <UInput v-model="form.password" type="password" color="sky" required />
                    </UFormGroup>

                    <div class="pt-12 md:pt-6">
                        <UButton type="submit" color="sky" size="lg" class="w-full flex justify-center text-center">
                            Login
                        </UButton>
                    </div>
                </UForm>
            </div>
        </UCard>
    </div>
</template>

<script setup>
const form = reactive({
    email: null,
    password: null
})
</script>