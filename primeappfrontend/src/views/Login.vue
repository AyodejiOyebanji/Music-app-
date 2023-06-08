<template>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img
            src="https://www.getillustrations.com/photos/pack/Music-band-illustrations_lg.png"
            class="img-fluid"
            alt="Sample image"
          />
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form @submit.prevent="login">
            <div
              class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start"
            >
              <p class="lead fw-normal mb-0 me-3">Sign in with</p>
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
              <input
                type="email"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
                v-model="email"
                @blur="validateField('email')"
                required
              />

              <label for="floatingInput">Email address</label>
              <span v-if="!email && showErrors.email" class="error"
                >Email is required.</span
              >
            </div>
            <div class="form-floating">
              <input
                type="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
                v-model="password"
                @blur="validateField('password')"
                required
              />
              <label for="floatingPassword">Password</label>
              <span v-if="!password && showErrors.password" class="error"
                >Password is required.</span
              >
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input
                  class="form-check-input me-2"
                  type="checkbox"
                  value=""
                  id="form2Example3"
                />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="/request-password" class="text-body">Forgot password?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button
                type="submit"
                class="btn btn-primary btn-lg"
                style="padding-left: 2.5rem; padding-right: 2.5rem"
              >
                Login
              </button>
              <p class="small fw-bold mt-2 pt-1 mb-0">
                Don't have an account?
                <a href="#!" class="link-danger">Register</a>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div
      class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary"
    >
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
import axios from "axios";
import { useToast } from "vue-toast-notification";

export default {
  data() {
    return {
      email: "",
      password: "",

      showErrors: {
        email: false,
        password: false,
      },
    };
  },
  methods: {
    login() {
      const toast = useToast();
      this.showErrors = {
        email: true,
        password: true,
      };

      if (!this.email || !this.password) {
        this.$toast.error("Please fill in all required fields.");
        return;
      }

      // Create the data object to send to the backend
      const data = {
        email: this.email,
        password: this.password,
      };
      console.log(data);

      // Send the data to the backend using Axios
      fetch('http://localhost/PrimeApp/PrimeApp/public/api/login', {
      method: 'POST',
      body: JSON.stringify(data),
      headers: {
        'Content-Type': 'application/json'
      },
      credentials: 'include'
    })
.then(response => {
  if (response.ok) {
    return response.json();
  } else if (response.status === 401) {
    throw new Error('Invalid credentials');
  } else {
    throw new Error('An error occurred during login. Please try again later.');
  }
})
.then(data => {
  console.log(data);
  toast.success(data.message);
  localStorage.setItem("prime_music", JSON.stringify(data.token));
  this.$router.push('/dashboard');
})
.catch(error => {
  console.error(error);
  this.$toast.error(error.message);
});


    }}
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
@media (max-width: 450px) {
  .h-custom {
    height: 100%;
  }
}
</style>