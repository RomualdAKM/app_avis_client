<script setup>
import { reactive, ref } from "vue";
import router from "./../../router/index.js"

let form = reactive({
    email: "",
    password: "",
});

const login = async () => {
    await axios.post("api/login", form).then((response) => {
        if (response.data.success) {
            localStorage.setItem("token", response.data.data.token);
            router.push("/panel");
             toast.fire({
            icon: "success",
            title: "Connect  Successfully",
        });
        } else {
           toast.fire({
            icon: "error",
            title: response.data.message,
        });
        }
    });
};

</script>

<template>
    <!-- Page Body Start-->
    <div class="page-body h-[100vh] !mt-0 bg-cover bg-no-repeat  bg-[url('../../assets/images/dotsbg.jpg')]">
        <div class="!flex items-center justify-center h-full p-[.9375rem] common-animate-main ratio_asos">
          <div class=" grid grid-cols-12 gap-0 mx-auto w-full max-w-[70%] xl:max-w-[50%] md:max-w-[70%] sm:max-w-[80%] 2sm:max-w-[100%] xl:flex xl:justify-center">
            <div class="relative col-span-5 bg-white 2xl:col-span-6 z-1 xl:col-span-12 rounded-xl max-w-[29.375rem] min-w-[18.75rem] sm:min-w-[22.75rem] 2sm:min-w-[18.75rem] h-max">
              <form class="theme-form flex flex-col gap-3 !m-0 p-8 2sm:p-4" @submit.prevent="login()">
                <h3>Connecter Vous</h3>
                <p>Entrez votre email et votre mot de passe  pour acceder a votre espace</p>
                <div>
                  <input type="email" placeholder="Email" v-model="form.email">
                </div>
                <div class="relative">
                  <input type="password" id="password" name="password"  placeholder="Mot de passe" v-model="form.password">
                  <div class="password-icon"><i class="cursor-pointer w-4 h-4 stroke-title right-[25px] rtl:right-unset top-1/2 rtl:left-[25px] absolute -translate-y-1/2  showHidePassword" data-feather="eye"> </i><i class="cursor-pointer w-4 h-4 stroke-title right-[25px] rtl:right-unset top-1/2 rtl:left-[25px] absolute -translate-y-1/2  showHidePassword" data-feather="eye-off"> </i></div>
                </div>
                <div class="flex justify-between items-center gap-1">
                  <div class="flex items-center gap-2">
                    <label class="checkbox w-[1rem] h-[1rem] cursor-pointer">  
                      <input class="peer" type="checkbox"><span class="checkbox-indicator peer-checked:!bg-primary !border-primary"> <i data-feather="check"></i></span>
                    </label><span>Remember Me</span>
                  </div>
                  <div class="!mb-0"><a href="forgot-password.html">Mot de passe oublié? </a></div>
                </div><a class="btn btn-primary !text-white hover:drop-shadow-lg my-2" href="#"> <button type="submit"> Connexion </button> </a>
                
                <div class="text-center"><span>Vous n'avez pas un compte? <router-link to="/register">Inscription</router-link></span></div>
              </form>
            </div>
            <div class="col-span-7 rounded-lg 2xl:col-span-6 z-1 xl:col-span-12 xl:hidden">
              <div class="relative flex items-center justify-center"><img class="w-[75%] 2xl:w-full" src="https://admin.pixelstrap.com/govo/assets/images/svg/login.svg" alt=""><img class="common-animate animate-ping bottom-[35%] absolute left-[25%] w-[33%] animate__animated animate__infinite animate__shakeY animate__slower" src="https://admin.pixelstrap.com/govo/assets/images/svg/login2.svg" alt="register vector"></div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page Body End-->
</template>