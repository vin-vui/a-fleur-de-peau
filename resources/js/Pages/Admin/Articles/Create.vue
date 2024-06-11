<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    image,
    title: null,
    content: null,
    category: false,
})

export default {
    components: {
        AppLayout
    },
    props: {
        articles: Object,
        images: Object,
    },
}
</script>

<template>
    <AppLayout title="Créer un article">
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">
                Créer un nouvel article
            </h1>
        </template>

        <div class="flex justify-center">

            <form @submit.prevent="form.post('/store')" class="flex flex-col items-center gap-12 mt-8">
                <!-- csrf -->
                <div class="flex gap-12">
                    <div class="flex flex-col gap-4 items-center">
                        <label for="image">Ajouter des images</label>
                        <input type="file" id="image" multiple>
                    </div>

                    <div class="flex flex-col items-center gap-7">
                        <!-- Titre -->
                        <div class="flex flex-col gap-2.5 items-center">
                            <label for="title">Titre de l'article</label>
                            <input type="text" name="title" id="title" placeholder="Ecrivez ici" class="w-96 rounded-lg">
                        </div>

                        <!-- Texte -->
                        <div class="flex flex-col gap-2.5 items-center">
                            <label for="content">Texte de l'article</label>
                            <textarea name="content" id="content" placeholder="Entrez le contenu de l'article"
                                class="w-96 h-52 rounded-lg"></textarea>
                        </div>

                        <!-- Page cible -->
                        <div class="flex flex-col gap-2.5 items-center">
                            <label for="category">Page cible de l'article</label>
                            <select name="category" id="category">
                                <option value="research">Page recherche</option>
                                <option value="service">Page fonctionnement du service</option>
                                <option value="communication">Page communication</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button
                    class="bg-[#D46F4D] py-1.5 px-3 text-gray-50 transition duration-300 ease-in-out hover:bg-gray-200 hover:text-[#D46F4D] hover:border-[#D46F4D] rounded-md w-32"
                    type="submit">Créer l'article</button>
            </form>

        </div>
    </AppLayout>
</template>