<script setup>
import { ref, onMounted, reactive } from 'vue'


let companyId = ref({})
const company = ref([])


const fetchUserData = async () => {
  try {
    const response = await axios.get('/api/user', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            });
          
            companyId.value = response.data.company_id
            console.log(companyId.value)
      } catch (error) {
        console.error('Erreur lors de la récupération des données de l\'utilisateur :', error)
      }
    }

    const getCompany = async () => {
    let response = await axios.get(`/api/get_info_structure/${companyId.value}`)
    company.value = response.data.company
    console.log('company',response.data.company)
}

onMounted ( async () => {
  
  fetchUserData()
  getCompany()
})

</script>


<template>
     <!-- Page Header start-->
     <header class="fixed top-0 z-[6] xl:w-full 4xl:w-[calc(100%_-_14.375rem)] w-[calc(100%_-_15.8125rem)] ml-auto">
          <div class="page-header transition-all bg-white shadow-header dark:bg-sidebar-dark">
            <div class="py-[11px] flex items-center xl:relative justify-between px-body-space gap-4">
              <div class="left-header flex items-center gap-2"> 
                <button class="sidebar-toggle hide"> 
                  <svg class="w-6 4xl:w-5 h-6 4xl:h-5 stroke-title"> 
                    <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Category"> </use>
                  </svg>
                </button>
                <h1 class="flex items-center gap-1 text-xl font-extrabold leading-none sm:hidden dark:text-white 4xl:text-lg">Bienvenu sur votre espace </h1>
              </div>
              <div class="right-header flex items-center flex-1 sm:gap-[calc(7px_+_(14_-_7)_*_((100vw_-_320px)_/_(1920_-_320)))] gap-[calc(16px_+_(20_-_16)_*_((100vw_-_320px)_/_(1920_-_320)))]  justify-end">
               
              
                
                <ul class="profile-box flex items-center"> 
                 
                  <li class="cursor-pointer flex- pl-[11px] language-border rtl:first:pr-0 first:pl-0 flex items-center">
                    <!-- Profile Start -->
                    <div class="dropdown"> 
                      <div class="flex items-center gap-[10px] cursor-pointer"> 
                        <div><img class="w-[calc(35px_+_(40_-_35)_*_((100vw_-_320px)_/_(1920_-_320)))] h-[calc(35px_+_(40_-_35)_*_((100vw_-_320px)_/_(1920_-_320)))] rounded-full" src="/assets/images/avatar/1.jpg" alt="avatar"></div>
                        <div class="md:hidden">
                          <h4 class="text-xs font-bold dark:text-white"> Helen Walter</h4><span class="flex items-center gap-1 font-semibold text-3xs text-content">Admin
                            <svg class="w-[6px] h-[4px]  dark:stroke-white"> 
                              <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Fill-Arrow"> </use>
                            </svg></span>
                        </div>
                      </div>
                      <div class="dropdown-menu !min-w-[170px]"> 
                        <ul class="flex flex-col gap-3"> 
                          <!-- <li><a class="flex items-center gap-2 text-title" href="user-profile.html">
                              <svg class="w-[18px] h-[18px] stroke-title dark:stroke-white"> 
                                <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#2-User"> </use>
                              </svg>Profile Setting</a></li>
                          <li><a class="flex items-center gap-2 text-title" href="chat-app.html">
                              <svg class="w-[18px] h-[18px] stroke-title dark:stroke-white"> 
                                <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#More-Square"> </use>
                              </svg>Message</a></li>
                          <li><a class="flex items-center gap-2 text-title" href="todo.html">
                              <svg class="w-[18px] h-[18px] stroke-title dark:stroke-white"> 
                                <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Edit-Square"> </use>
                              </svg>Taskboard</a></li>
                          <li><a class="flex items-center gap-2 text-title" href="knowledgebase.html">
                              <svg class="w-[18px] h-[18px] stroke-title dark:stroke-white"> 
                                <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Shield-Done"> </use>
                              </svg>Help</a></li> -->
                          <li><a class="flex items-center gap-2 text-title" href="javascript:void(0)">
                              <svg class="w-[18px] h-[18px] stroke-title dark:stroke-white"> 
                                <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Login"> </use>
                              </svg>Logout</a></li>
                        </ul>
                      </div>
                    </div>
                    <!-- Profile End -->
                  </li>
                </ul>
              </div>
            </div>
            
          </div>
        </header>
        <!-- Page Header end-->
</template>