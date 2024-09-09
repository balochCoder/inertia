<script setup>
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import VueMultiselect from "vue-multiselect";

defineProps({
    permissions: Array
})


const form = useForm({
    name: '',
    permissions:[]
});


</script>
<template>
    <Head title="Create Role"/>
    <AdminAuthenticatedLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-end">
                <Link :href="route('roles.index')"
                      class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded">
                    Back
                </Link>
            </div>
            <div class="mt-6 w-full mx-auto bg-slate-100 shadow-lg rounded-lg p-4">
                <h1 class="text-2xl p-4">Create New Role</h1>
                <form @submit.prevent="form.post(route('roles.store'))">
                    <div class="mt-4">
                        <InputLabel for="name" value="Name"/>

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name"/>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="permissions" value="Permissions"/>

                        <VueMultiselect
                            v-model="form.permissions"
                            :options="permissions"
                            :multiple="true"
                            :close-on-select="true"
                            placeholder="Select Permissions"
                            label="name"
                            track-by="id"
                        />
                    </div>

                    <div class="flex items-center mt-4">

                        <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }"
                                       :disabled="form.processing">
                            Create
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>


    </AdminAuthenticatedLayout>
</template>

<style src="vue-multiselect/dist/vue-multiselect.css"></style>
