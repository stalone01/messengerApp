<template>
  <div class="chat-container">
    <div class="messages">
      <Message v-for="msg in messages" :key="msg.id" :message="msg" />
    </div>
    <div class="input-container">
      <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message..." />
      <button @click="sendMessage">Send</button>
    </div>
  </div>
</template>

<script>
import Message from './Message.vue';

export default {
  components: {
    Message,
  },
  data() {
    return {
      socket: null,
      messages: [],
      newMessage: '',
    };
  },
  created() {
    this.socket = new WebSocket('ws://localhost:9502'); // URL de votre serveur WebSocket
    this.socket.onmessage = (event) => {
      const message = JSON.parse(event.data);
      this.messages.push(message);
    };
  },
  methods: {
    sendMessage() {
      if (this.newMessage.trim()) {
        const message = { text: this.newMessage, timestamp: new Date().toISOString() };
        this.socket.send(JSON.stringify(message));
        this.newMessage = '';
      }
    },
  },
};
</script>

<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  max-width: 600px;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 8px;
  overflow: scroll;
}

.messages {
  flex: 1;
  padding: 16px;
  overflow-y: auto;
  background-color: #f9f9f9;
}

.input-container {
  display: flex;
  padding: 16px;
  border-top: 1px solid #ddd;
  background-color: #fff;
  
}

input {
  flex: 1;
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
  margin-right: 8px;
}

button {
  padding: 8px 16px;
  border: none;
  border-radius: 4px;
  background-color: #007bff;
  color: white;
  cursor: pointer;
}

button:hover {
  background-color: #0056b3;
}
</style>
