<script setup>
import Base from "../../components/base.vue"
import { ref,reactive,onMounted } from 'vue'
import router from "./../../../router/index.js"
import { useRoute } from 'vue-router'

const route = useRoute()

const jobId = ref(route.params.jobId)

const job = ref({
        name: "",
        description: "", 
})

const getJob = async () => {
    let response = await axios.get(`/api/get_job/${jobId.value}`)
    job.value = response.data.job
    console.log('job',response.data.job)
}

const editJob = async () => {

await axios.post("/api/edit_job/" + job.value.id, job.value)
.then((response) => {
    if(response.data.success){
        router.push("/postes")
        toast.fire({
        icon: "success",
        title: "Poste Modifier avec success",
    })
    }else{
           toast.fire({
                  icon: "error",
                  title: "Remplissez Correctement tout les champs",
                });
                console.log('errorr',response.data.message)
            }
        })
        
    }


    onMounted( async () => {
        getJob()
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
                <h5 class="text-title font-semibold mb-3">Modifier Poste </h5>
                <form class="flex flex-col gap-4 m-0 sm:gap-3 theme-form">
                 
                  <!-- <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1"> -->
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Nom </label>
                      <input type="name" id="sku" v-model="job.name">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Description </label>
                      <textarea id="description" v-model="job.description"></textarea>
                    </div>
                  <!-- </div> -->
                
                 
                  
                  <div class="flex flex-wrap gap-2 items-center justify-end">

                    <a class="btn btn-primary py-1 text-white text-xs flex gap-2 items-center" href="#"><button @click="editJob()" type="button" >Modifier</button></a>

                    </div>
         </form>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Page Body End  -->
    </div>

</template>