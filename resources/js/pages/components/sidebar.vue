<script setup>
import { ref, onMounted } from 'vue'

const userRole = ref({})

const fetchUserData = async () => {
  try {
    const response = await axios.get('/api/user', {
                headers: {
                    Authorization: 'Bearer ' + localStorage.getItem('token')
                }
            });
          
            userRole.value = response.data.role
            console.log(userRole.value)
      } catch (error) {
        console.error('Erreur lors de la récupération des données de l\'utilisateur :', error)
      }
    }

onMounted ( async () => {
  
  fetchUserData()
  
})
</script>


<template>
     <!-- Sidebar Start -->
     <div class="page-sidebar sidebar-dark unique-sidebar">
          <aside class="sidebar"> 
            <div class="logo-wrapper"><a href="index.html"> <img class="w-full full-sidebar" src="/assets/images/qrcode2.png" alt="logo"></a>
              <button class="sidebar-btn">
                <svg class="w-6 h-6"> 
                  <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Category"> </use>
                </svg>
              </button>
            </div>
            <div class="search-wrapper">
              <div class="search-box"> 
                <input class="search" placeholder="Search" type="search">
                <svg class="w-5 h-5 cursor-pointer"> 
                  <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Search"> </use>
                </svg>
              </div>
            </div>
            <nav class="sidebar-main"> 
              <ul class="sidebar-links custom-scroll"> 
                <li class="title" v-if="userRole=='superadmin'">Structures</li>
                
                <li class="sidebar-list" v-if="userRole=='superadmin'"> <router-link to="/structures/create" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Ajouter </span></span></router-link>
                </li>
                <li class="sidebar-list" v-if="userRole=='superadmin'"> <router-link to="/structures" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Listes</span></span></router-link>
                </li>
               
                <li class="title" v-if="userRole!='superadmin'">Postes</li>
                
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/postes/create" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Ajouter </span></span></router-link>
                </li>
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/postes" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Listes</span></span></router-link>
                </li>
                <li class="title" v-if="userRole!='superadmin'">Employés</li>
                
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/employes/create" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Ajouter </span></span></router-link>
                </li>
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/employes" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Listes</span></span></router-link>
                </li>
                <li class="title" v-if="userRole!='superadmin'">Questions</li>
                
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/questions/create" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Ajouter </span></span></router-link>
                </li>
                <li class="sidebar-list" v-if="userRole!='superadmin'"> <router-link to="/questions" class="sidebar-link sidebar-title" href="#"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Listes</span></span></router-link>
                </li>
                <!-- <li class="title">General</li>
                
                <li class="sidebar-list"> <a class="sidebar-link sidebar-title" href="widgets.html"><span> 
                      <svg> 
                        <use href="https://admin.pixelstrap.com/govo/assets/svg/sprite.svg#Graph"> </use>
                      </svg><span class="sidebar-name">Widgets</span></span></a>
                </li> -->
               
                
              </ul>
            </nav>
          </aside>
        </div>
        <!-- Sidebar End -->
</template>