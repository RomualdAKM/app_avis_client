<script setup>
import Base from "../../components/base.vue"
import { ref,reactive,onMounted } from 'vue'
import router from "./../../../router/index.js"
import { useRoute } from 'vue-router'

const route = useRoute()

const companyId = ref(route.params.companyId)

const company = ref({
        name: "",
        email: "",
        phone: "",
        ifu: "",
        adresse: "",
        image: "",
})

const getCompany = async () => {
    let response = await axios.get(`/api/get_structure/${companyId.value}`)
    company.value = response.data.company
    console.log('company',response.data.company)
}

const changePhoto = (e) => {
    const file = e.target.files[0];
    const limit = 4024 * 4024 * 7; // Limite de taille en octets (7 Mo dans cet exemple)

    if (file.size > limit) {
        swal({
            icon: "error",
            title: "Ooops...",
            text: "Vous téléchargez un fichier trop volumineux.",
        });
        return false;
    }

    // Stockez le fichier image dans la propriété "image"
    company.value.image = file;
}


const editCompany = async () => {
    const formData = new FormData();

    // Ajoutez les autres champs au formulaire
    formData.append("name", company.value.name);
    formData.append("email", company.value.email);
    formData.append("phone", company.value.phone);
    formData.append("ifu", company.value.ifu);
    formData.append("adresse", company.value.adresse);
    
   // Ajoutez le fichier image s'il est défini
   if (company.value.image) {
        formData.append("image", company.value.image);
    }

   
  await axios.post("/api/edit_structure/" + company.value.id,formData).then((response) => {
    if(response.data.success){
                 router.push("/structures")
                console.log('ok')
                  toast.fire({
                      icon: "success",
                      title: "Structure modifer avec success",
                  });

                }

                 
              else{
                toast.fire({
                      icon: "error",
                      title: "Remplissez correctement tout les champs",
                  });
                console.log('error',response.data.message)
              }
      
  })

}
onMounted( async () => {
    getCompany()
})
</script>


<template>
    <div class="page-body-wrapper xl:w-full 4xl:w-[calc(100%_-_14.375rem)] w-[calc(100%_-_15.8125rem)] ml-auto transition-all duration-300">
        <Base />
        <!-- Page Body Start-->
        <div class="page-body"> 
          <div class="grid grid-cols-12 gap-4 add-product card">
            <div class="col-span-12 pr-4 border-r dark:border-r rtl:!border-r-0 rtl:!pr-4 dark:border-border-dark 2lg:col-span-12 2lg:border-b 2lg:pb-4 2lg:border-r-0 border-border-light rtl:border-l rtl:2lg:border-l-0  rtl:pl-4 ">
              <div> 
                <h5 class="text-title font-semibold mb-3">Ajouter Structure </h5>
                <form class="flex flex-col gap-4 m-0 sm:gap-3 theme-form">
                 
                  <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1">
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Nom </label>
                      <input type="text" id="sku" v-model="company.name">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Email </label>
                      <input type="email" id="sku" v-model="company.email">
                    </div>
                  </div>
                  <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1">
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Contact </label>
                      <input type="number" min="0" id="sku" v-model="company.phone">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Adresse </label>
                      <input type="text" id="sku" v-model="company.adresse">
                    </div>
                  </div>
                  <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1">
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Ifu </label>
                      <input type="number" min="0" id="sku" v-model="company.ifu">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Logo </label>
                      <input class="cursor-pointer show-preview" type="file" @change="changePhoto">
                    </div>
                  </div>        
                  <div class="flex flex-wrap gap-2 items-center justify-end">

                    <a class="btn btn-primary py-1 text-white text-xs flex gap-2 items-center" href="#"><button @click="editCompany()" type="button" >Modifier</button></a>

                     </div>
                </form>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Page Body End  -->
    </div>
    
</template>