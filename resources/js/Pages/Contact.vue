<script setup>
import { onMounted } from 'vue';
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
import emailjs from "@emailjs/browser";

onMounted(() => {
  emailjs.init('vo-DBCoEr9P2JtjNe');
});

const sendMail = () => {
  const form = document.querySelector('form');
  const formData = new FormData(form);

  emailjs.sendForm('service_b2gugqu', 'template_vk54zid', form)
    .then((response) => {
      console.log('SUCCESS!', response.status, response.text);
      alert('Email envoyé avec succès!');
    }, (error) => {
      console.error('FAILED...', error);
      alert('Échec de l\'envoi de l\'email.');
    });
};
</script>

<template>
    <GuestLayout title="Dashboard">
        <Head title="Formulaire de contact">
            <link rel="preconnect" href="https://fonts.bunny.net">
            <link href="https://fonts.bunny.net/css?family=great-vibes:400|mansalva:400" rel="stylesheet" />
        </Head>

            <div class="min-h-screen bg-white py-6 flex flex-col justify-center sm:py-12">
            <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                <div class="absolute inset-0 bg-[#FFBF66] shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl"></div>
                <div class="text-[#00353F] relative px-4 py-10 bg-[#D46F4D] shadow-lg sm:rounded-3xl sm:p-20">
                    <div class="text-center pb-6">
                        <h1 class="text-3xl font-[Mansalva]">
                            CONTACTEZ-NOUS !
                        </h1>
                    </div>

                    <form class="font-[Mansalva]" @submit.prevent="sendMail">
                        <div class="mb-4">
                            <label class="block text-[#00353F] mb-2" for="name"
                                >Nom</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text"
                                id="name"
                                name="name"
                                required/>
                        </div>

                        <div class="mb-4">
                            <label class="block text-[#00353F] mb-2" for="email"
                                >Email</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="email"
                                id="email"
                                name="email"
                                required/>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-[#00353F] mb-2"
                                for="_subject"
                                >Objet</label>
                            <input
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                type="text"
                                id="_subject"
                                name="_subject"
                                required/>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-[#00353F] mb-2"
                                for="message"
                                >Message</label>
                            <textarea
                                class="shadow min-h-0 appearance-none border rounded h-64 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="message"
                                name="message"
                                style="height: 121px"
                                required></textarea>
                        </div>

                        <div class="flex justify-between">
                            <button
                                class="shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="submit">
                                envoyer
                            </button>
                            <button
                                class="shadow bg-[#00353F] hover:bg-white text-white hover:text-[#00353F] font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                type="reset">
                                réinitialiser
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @livewireScripts
    </GuestLayout>
</template>
