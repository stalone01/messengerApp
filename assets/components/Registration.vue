<template>
    <!-- <Navbar/> -->
    <div class="registration-container">
      <h1>S'inscrire</h1>
  
      <form @submit.prevent="register" class="registration-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" v-model="form.username" placeholder="Enter your username" required />
            </div>
                <div class="form-group">
                <label for="password-first">Password</label>
                <input type="password" id="password-first" v-model="form.passwordFirst" placeholder="Enter your password" required />
            </div>
            <div class="form-group">
                <label for="password-second">Confirm Password</label>
                <input type="password" id="password-second" v-model="form.passwordSecond" placeholder="Confirm your password" required />
            </div>
            <button type="submit" class="submit-button">Sign Up</button>
      </form>
    </div>
</template>
  
<script>
// import Navbar from './partiels/Navbar.vue';
  export default {
    name:'Registration',
    // components:{
    //     Navbar,
    // },
    data() {
      return {
        form: {
          username: '',
          passwordFirst: '',
          passwordSecond: ''
        }
      }
    },
    methods: {
      async register() {
        // Simple validation for passwords
        if (this.form.passwordFirst !== this.form.passwordSecond) {
          alert('Passwords do not match!');
          return;
        }
  
        try {
          const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(this.form)
          });
  
          if (response.ok) {
            alert('Registration successful!');
            this.$router.push('/login');
          } else {
            alert('Registration failed!');
          }
        } catch (error) {
          console.error('Error:', error);
        }
      }
    }
  }
</script>
  
<style scoped>
  /* Centrer le conteneur du formulaire d'inscription */
  .registration-container {
    max-width: 500px;
    margin: 2em auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  
  /* Styliser le titre */
  .registration-container h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
  }
  
  /* Styliser le formulaire */
  .registration-form {
    display: flex;
    flex-direction: column;
  }
  
  /* Styliser chaque groupe de formulaire */
  .form-group {
    margin-bottom: 20px;
    text-align: left;
  }
  
  /* Styliser les labels */
  .form-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
  }
  
  /* Styliser les champs de saisie */
  .form-group input {
    width: calc(100% - 20px);
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box; /* Pour inclure le padding dans la largeur */
  }
  
  /* Placeholder styling */
  .form-group input::placeholder {
    color: #999;
  }
  
  /* Styliser le bouton de soumission */
  .submit-button {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: white;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-top: 10px;
  }
  
  /* Ajouter un effet au bouton lors du survol */
  .submit-button:hover {
    background-color: #0056b3;
  }
</style>
  