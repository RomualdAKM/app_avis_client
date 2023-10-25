<script setup>
import Base from "../../components/base.vue"
import {reactive,ref,onMounted} from 'vue'
import router from "./../../../router/index.js"

let form = reactive({
  name:"",
  firstname:"",
  email:"",
  phone:"",
  adresse:"",
  jobId:"",
  idAuthUser:"",
})
const jobs = ref({})

const user = ref(null) // Créez une référence pour stocker les données de l'utilisateur

// Fonction pour récupérer les données de l'utilisateur actuellement connecté
const fetchUserData = async () => {
  try {
    const response = await axios.get('/api/user', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            });
          
    form.idAuthUser = response.data.id
    console.log(form.idAuthUser)
  } catch (error) {
    console.error('Erreur lors de la récupération des données de l\'utilisateur :', error)
  }
}

const saveUser = async () => {
  await axios.post('/api/create_user',form).then((response) => {
    if(response.data.success){

                 router.push("/employes")

                console.log('ok')
                  toast.fire({
                      icon: "success",
                      title: "employé enregistrer avec success",
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
const getJobs = () => {
    axios.get('/api/jobs').then((response) => {
        jobs.value = response.data
        console.log('job',jobs.value)
    })
}

onMounted ( async () => {
  getJobs()
  fetchUserData()
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
                      <input type="name" id="sku" v-model="form.name">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Prenom </label>
                      <input type="name" id="sku" v-model="form.firstname">
                    </div>
                  </div>
                  <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1">
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Contact </label>
                      <input type="number" min="0" id="sku" v-model="form.phone">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Adresse </label>
                      <input type="text" id="sku" v-model="form.adresse">
                    </div>
                  </div>
                  <div class="grid grid-cols-12 gap-5 sm:gap-3 sm:-mt-1">
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                      <label for="sku">Email </label>
                      <input type="email" id="sku" v-model="form.email">
                    </div>
                    <div class="col-span-6 2md:col-span-6 sm:col-span-12">
                        <label for="brand">Poste</label>
                        <select v-model="form.jobId"  class="form-select block w-full px-3 text-xs font-normal text-content3 bg-white bg-clip-padding bg-no-repeat border border-border-light rounded-5 transition ease-in-out m-0 min-w-[150px] py-[9px] dark:border-border-dark dark:bg-sidebar-dark2" id="brand" aria-label="Default select example">
                            
                                <option v-for="job in jobs" :key="job.id" value="{{ job.id }}">{{ job.name }}</option>
                                               
                        </select>
                    </div>
                  </div>
                                 
                    <div class="flex flex-wrap gap-2 items-center justify-end">

                    <a class="btn btn-primary py-1 text-white text-xs flex gap-2 items-center" href="#"><button @click="saveUser()" type="button" >Enregistrer</button></a>

                    </div>
                    </form>
              </div>
            </div>
            
          </div>
        </div>
        <!-- Page Body End  -->
    </div>
</template>