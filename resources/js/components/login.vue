<template>
  <div class="container">
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">

          <p v-if="errors !== null">
            <b-alert show variant="danger" v-if="errors !== null">{{ errors }} </b-alert>
        </p>

      <b-form-group
        id="input-group-1"
        label="Email address:"
        label-for="input-1"
        description="We'll never share your email with anyone else."
      >
        <b-form-input
          id="input-1"
          v-model="email"
          type="email"
          placeholder="Enter email"
          required
        ></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-2" label="Your password:" label-for="input-2">
        <b-form-input
          id="input-2"
          v-model="password"
          type="password"
          placeholder="Enter password"
          required
        ></b-form-input>
      </b-form-group>

    
      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
  
  </div>
</template>

<script>

import appurl from "../appurl";

  export default {

    data() {
      return {
     
          password: '',
          email: '',
          show: true,
          errors: null,
      }
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()
        this.errors = null;

          const data = { 
                        email : this.email,
                        password : this.password
                    };
            axios.post(appurl.urlLive +'vue/login', data)
               .then(response => {
              // JSON responses are automatically parsed.
                    console.log(response.data.valid);
                    if(response.data.valid){
                     this.$router.push("/Camera");
                    }else{
                       this.errors = response.data.message;
                    }
                  })
              .catch(error => {
                this.errorMessage = error.message;
                console.error("There was an error!", error);
              });
        
  
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.password = ''
        this.name = ''

        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      }
    }
  }
</script>