import { createRouter, createWebHistory } from 'vue-router'
import dashbordsIndex from '../pages/views/dashbords/index.vue'
import index from '../pages/views/index.vue'
import login from '../pages/views/login.vue'
import register from '../pages/views/register.vue'
import notFound from '../pages/notFound.vue'
//structures
import structuresIndex from '../pages/views/structures/index.vue'
import structuresCreate from '../pages/views/structures/create.vue'
import structuresEdit from '../pages/views/structures/edit.vue'
//postes
import postesIndex from '../pages/views/postes/index.vue'
import postesCreate from '../pages/views/postes/create.vue'
import postesEdit from '../pages/views/postes/edit.vue'
//employés
import employesCreate from '../pages/views/employes/create.vue'
import employesIndex from '../pages/views/employes/index.vue'
import employesQrcodeuser from '../pages/views/employes/qrcodeuser.vue'



const routes = [
    {   
       
        path: '/panel',
        component: dashbordsIndex,
        
    },
    {   
       
        path: '/',
        component: index,
        
    },
    {   
       
        path: '/login',
        component: login,
        
    },
    {   
       
        path: '/register',
        component: register,
        
    },

    //structures
    {
        path: '/structures',
        component: structuresIndex,
        
    },
    {
        path: '/structures/create',
        component: structuresCreate,
        
    },
    {
        name: 'EditCompany',
        path: '/structures/edit/:companyId',
        component: structuresEdit,
        props: true,
        
    },
    //postes
    {
        path: '/postes',
        component: postesIndex,
        
    },
    {
        path: '/postes/create',
        component: postesCreate,
        
    },{
        name: 'EditJob',
        path: '/postes/edit/:jobId',
        component: postesEdit,
        props: true,
        
    },
    //employes
    {
        path: '/employes/create',
        component: employesCreate,
        
    },
    {
        path: '/employes',
        component: employesIndex,
        
    },
    {
        name: 'QrcodeUser',
        path: '/employes/qrcode/:userId',
        component: employesQrcodeuser,
        props: true,
        
    },

    {
        path: '/:pathMatch(.*)*',
        component: notFound,
        
    }

]

const router = createRouter({
    history: createWebHistory(),
    routes,

})

export default router
