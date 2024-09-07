<script setup>
import AdminAuthenticatedLayout from '@/Layouts/AdminAuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Admin" />

    <AdminAuthenticatedLayout>
       <div class="py-4">
           <h1>Welcome Admin</h1>
       </div>

    </AdminAuthenticatedLayout>
</template>
