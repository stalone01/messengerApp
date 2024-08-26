<template>
 <div class="login-container">
    <h1>Connexion</h1>
    <form @submit.prevent="login" class="login-form">
      <div class="form-group">
        <label for="username">Nom d'utilisateur</label>
        <input 
          type="text" 
          id="username" 
          v-model="username" 
          placeholder="Entrez votre nom d'utilisateur" 
          required
        />
      </div>
      <div class="form-group">
        <label for="password">Mot de passe</label>
        <input 
          type="password" 
          id="password" 
          v-model="password" 
          placeholder="Entrez votre mot de passe" 
          required
        />
      </div>
      <button type="submit" class="submit-button">Se connecter</button>
    </form>
    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
  </div>
</template>
  
<script>
import axios from 'axios';

export default{
  data() {
    return {
      username:'',
      password:'',
      errorMessage:''
    };
  },
  methods:{
    async login(){
      try{
        const response = await axios.post('/login-users',{
          username: this.username,
          password: this.password
        });
        //Enregistrer le twt token
        localStorage.setItem('token', response.data.token);

        this.$router.push('/dasboard');
      }catch(error){
        //this.errorMessage = 'Utilisateur introuvable! Inscrivez vous et ressayez plus tard!!!';
        this.errorMessage = error.response?.data?.message || 'Une erreur s\'est produite, veuillez réessayer.';
        console.log(error);
      }
    }
  }
}

</script>
<style scoped>
  /* Centrer le conteneur du formulaire de login */
  .login-container {
    max-width: 400px;
    margin: 100px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
  }
  
  /* Styliser le titre */
  .login-container h1 {
    font-size: 24px;
    margin-bottom: 20px;
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
  }
  
  /* Styliser les champs de saisie */
  .form-group input {
    width: calc(100% - 20px);
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
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
  