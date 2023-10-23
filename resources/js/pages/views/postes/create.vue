<script setup>
import Base from "../../components/base.vue"
import {reactive,ref} from 'vue'
import router from "./../../../router/index.js"

let form = reactive({
  name:"",
  description:"",
})

const saveJob = async () => {
  await axios.post('/api/create_job',form).then((response) => {
    if(response.data.success){

                 router.push("/postes")

                console.log('ok')
                  toast.fire({
                      icon: "success",
                      title: "Poste enregistrer avec success",
                  });

                }

                 
              else{
                toast.fire({
                      icon: "error",
                      title: "Remplissez correctement tout les champs",
                  });
                console.log('errorr',response.data.message)
              }
      
      
   
  })

}
</script>

<template>
    <div class="page-body-wrapper xl:w-full 4xl:w-[calc(100%_-_14.375rem)] w-[calc(100%_-_15.8125rem)] ml-auto transition-all duration-300">
        <Base />
    
    <!-- Page Body Start-->
    <div class="page-body"> 
          <div class="grid grid-cols-12 gap-4 add-product card">
            <div class="col-span-12 pr-4 border-r dark:border-r rtl:!border-r-0 rtl:!pr-4 dark:border-border-dark 2lg:col-span-12 2lg:border-b 2lg:pb-4 2lg:border-r-0 border-border-light rtl:border-l rtl:2lg:border-l-0  rtl:pl-4 ">
              <div> 
                <h5 class="text-title font-semibold mb-3">Ajouter Poste </h5>
                <form class="flex flex-col gap-4 m-0 sm:gap-3 theme-form">
                 
                  <!-- <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1"> -->
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Nom </label>
                      <input type="name" id="sku" v-model="form.name">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Description </label>
                      <textarea id="description" v-model="form.description"></textarea>
                    </div>
                  <!-- </div> -->
                
                 
                  
                  <div class="flex flex-wrap gap-2 items-center justify-end">

                    <a class="btn btn-primary py-1 text-white text-xs flex gap-2 items-center" href="#"><button @click="saveJob()" type="button" >Enregistrer</button></a>

                    </div>
         </form>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Page Body End  -->
    </div>
    
</template>