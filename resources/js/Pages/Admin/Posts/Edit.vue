<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";

const props = defineProps({
    post: {
        type: Object,
        required: true
    },
})

const form = useForm({
    title: props.post.title,
});


</script>
<template>
    <Head title="Update Post"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-end">
                <Link :href="route('posts.index')"
                      class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                    Back
                </Link>
            </div>
            <div class="mt-6 w-full mx-auto bg-slate-100 shadow-lg rounded-lg p-4">
                <h1 class="text-2xl p-4">Edit Post</h1>
                <form @submit.prevent="form.put(route('posts.update', props.post?.id))">
                    <div class="mt-4">
                        <InputLabel for="title" value="Title"/>

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autofocus
                            autocomplete="title"
                        />

                        <InputError class="mt-2" :message="form.errors.title"/>
                    </div>
                    <div class="flex items-center mt-4">

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Update
                        </PrimaryButton>
                    </div>
                </form>
            </div>

        </div>
    </AdminAuthenticatedLayout>
</template>
