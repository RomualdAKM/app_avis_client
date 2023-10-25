<script setup>
import { ref,reactive,onMounted } from 'vue'
import { useRoute } from 'vue-router'

const route = useRoute()

const qrcodeuser = ref('')

const userId = ref(route.params.userId)

const getqrcodeuser = async () => {
  try {
    let response = await axios.get(`/api/get_qrcodeuser/${userId.value}`);
    qrcodeuser.value = response.data;
    console.log('qrcode', qrcodeuser.value);
  } catch (error) {
    console.error('Error fetching QR code:', error);
  }
}
onMounted( async () => {
    getqrcodeuser()
    })
</script>

<template>


    <div class="flex justify-center items-center h-screen">
    <img
      :src="'/codes-qr/' + qrcodeuser.qrcode"
      alt="QR Code"
      class="mx-auto w-48" 
    >
    <a
      :href="'/codes-qr/' + qrcodeuser.qrcode"
      download
      class="text-blue-500 underline cursor-pointer"
    >
      Download QR Code (SVG)
    </a>
  </div>

</template>
    
