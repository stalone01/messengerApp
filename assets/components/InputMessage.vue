<template>
    <div class="input-message">
      <input
        v-model="message"
        placeholder="Type a message..."
        @keyup.enter="send"
      />
      <button @click="send">Send</button>
    </div>
  </template>
  
  <script>
  export default {
    name: 'InputMessage',
    data() {
      return {
        message: '',
      };
    },
    methods: {
      send() {
        if (this.message.trim()) {
          this.$emit('send-message', this.message.trim());
          this.message = '';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .input-message {
    display: flex;
    padding: 10px;
    border-top: 1px solid #ccc;
    background: #fff;
  }
  
  input {
    flex: 1;
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    padding: 10px 20px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 4px;
    cursor: pointer;
  }
  
  button:hover {
    background-color: #0056b3;
  }
  </style>
  