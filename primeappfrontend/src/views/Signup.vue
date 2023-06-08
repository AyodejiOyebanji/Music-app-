<template>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="https://www.getillustrations.com/photos/pack/Music-band-illustrations_lg.png"
                        class="img-fluid" alt="Sample image" />
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form @submit.prevent="register">
                        <h4>Sign Up As a User</h4>
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Sign Up with</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Or</p>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Username"
                                v-model="username" @blur="validateField('username')" required />
                            <label for="floatingInput">Username</label>
                            <span v-if="!username && showErrors.username" class="error">Username is required.</span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                                v-model="email" @blur="validateField('email')" required />
                            <label for="floatingInput">Email address</label>
                            <span v-if="!email && showErrors.email" class="error">Email is required.</span>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="tel" class="form-control" id="floatingInput" placeholder="081..........."
                                v-model="phone" @blur="validateField('phone')" required />
                            <label for="floatingInput">Phonenumber</label>
                            <span v-if="!phone && showErrors.phone" class="error">Phonenumber is required.</span>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                v-model="password" @blur="validateField('password')" required />
                            <label for="floatingPassword">Password</label>
                            <span v-if="!password && showErrors.password" class="error">Password is required.</span>
                        </div>

                        <div class="d-flex justify-content-between align-items-center"></div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem">
                                Register
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">
                                Already have an account?
                                <a href="/" class="link-danger">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0"></div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#!" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="#!" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
            <!-- Right -->
        </div>
    </section>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toast-notification';

export default {

    data() {
        return {
            username: "",
            email: "",
            password: "",
            phone: "",
            isAdmin: false,
            showErrors: {
                username: false,
                email: false,
                password: false,
                phone: false,
                
               
            },
        };
    },
    methods: {
        register() {
            const toast = useToast();
            this.showErrors = {
      username: true,
      email: true,
      password: true,
      phone: true,
      isAdmin: false,
    };

    if (
      !this.username ||
      !this.email ||
      !this.password ||
      !this.phone 
  
    ) {
        console.log("Please fill in all required fields.");
      this.$toast.error("Please fill in all required fields.");
      return;
    }

    // Create the data object to send to the backend
    const data = {
      username: this.username,
      email: this.email,
      password: this.password,
      phone: this.phone,
      isArtist: this.isAdmin,
    };
    console.log(data);

    // Send the data to the backend using Axios
    
    axios
      .post('http://127.0.0.1:8000/api/register', data)
      .then(response => {
        
        if(response.status== 200){
            toast.success(response.data.message,);
            this.$router.push('/');

        }
     
       
      })
      .catch(error => {
        if (error.response && error.response.data && error.response.data.errors) {
    const firstError = Object.values(error.response.data.errors)[0];
    if (firstError) {
      toast.error(firstError);
    }
  }
      });
  },
  validateField(fieldName) {
    if (this.showErrors[fieldName]) {
      this.showErrors[fieldName] = false;
    }
  },
    },
};
</script>
<style scoped>
.divider:after,
.divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
}

.h-custom {
    height: calc(100% - 73px);
}

.error {
    color: red;
}

@media (max-width: 450px) {
    .h-custom {
        height: 100%;
    }
}
</style>
