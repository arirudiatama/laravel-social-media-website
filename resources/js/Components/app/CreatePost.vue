<script setup>

import {ref} from "vue";
import InputTextarea from "@/Components/InputTextarea.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import PostModal from "@/Components/app/PostModal.vue";
import { ArrowUpTrayIcon } from '@heroicons/vue/24/solid'
const authUser = usePage().props.auth.user;

const showModal = ref(false)
const newPost = ref({
    id: null,
    body: '',
    user: authUser
})

defineProps({
    group: {
        type: Object,
        default: null
    }
})

function showCreatePostModal() {
    showModal.value = true
}

</script>

<template>
    
        <button @click="showCreatePostModal" class="">
        
            <ArrowUpTrayIcon class="w-10 h-6 dark:text-white"/>
        </button>

        <PostModal :post="newPost" :group="group" v-model="showModal"/>
    
</template>

<style scoped>

</style>
