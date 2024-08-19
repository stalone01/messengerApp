<template>
    <Navbar/>
    <div class="chat-container">
      <UserList :users="users" :currentUserId="userId" />
      <div class="chat-container">
        <div class="messages">
          <Message v-for="(msg, index) in messages" :key="index" :message="msg" :currentUserId="userId"/>
        </div>
        <div class="input-container">
          <InputMessage @send-message="handlSendMessage" />
        </div>
      </div>
    </div>

</template>

<script>
import InputMessage from './InputMessage.vue';
import Message from './Message.vue';
import UserList from './UserList.vue';
import Navbar from './partiels/Navbar.vue';

export default {
  name: 'App',
  components: {
    Message,
    InputMessage,
    UserList,
    Navbar,
  },
  data() {
    return {
      socket: null,
      messages: [],
      users: [],
      userId: 1, //user Id, this should be dynamically set
    };
  },
  created() {
    this.socket = new WebSocket('ws://localhost:8080'); // URL de votre serveur WebSocket

    // Gestion de message
    this.socket.onmessage = (event) => {
      const message = JSON.parse(event.data);
      if(data.type === 'message'){
        this.messages.push(message);
      }else if(data.type === 'user_list'){
        this.users = data.users;
      }
    };
  },
  methods: {
    // handlSendMessage(messageText){
    //   const message = {
    //     user_id: this.userId,
    //     message: messageText,
    //     timestamp: new Date().toISOString(),
    //   };
    //   this.socket.send(JSON.stringify({ type: 'message',data: message }));
    //   this.message.push(message);
    // },
    handleSendMessage() {
      if (this.newMessage.trim()) {
        const message = { user_id:this.userId, text: this.newMessage, timestamp: new Date().toISOString() };
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
  height: 90vh;
  max-width: 900px;
  margin: 0 auto;
  border: 1px solid #ccc;
  border-radius: 8px;
  overflow: hidden;
}

.chat-content {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.messages {
  flex: 1;
  display: flex;
  flex-direction: column;
  overflow-y: auto;
  padding: 10px;
  overflow-y: auto;
  background-color: #f9f9f9;
}

</style>
