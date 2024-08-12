
   <template>
    <div>
      
      
    </div>
    <div  class="example-wrapper">

      <h1>Conversation...</h1>

      <div class="chat-container">
          <div v-for="message in messages" :key="message">{{ message }}</div>
          <div class="chat-box" id="chatBox">
              <div class="message received">
                  <p>Bonjour! Comment puis-je vous aider?</p>
              </div>
              <div class="message send">
                  <p>Bonjour!!!</p>
              </div>
          </div>

          <form id="messageForm">
              <input v-model="newMessage" @keyup.enter="sendMessage" type="text" id="messageInput" placeholder="Écrivez votre message..." required/>
              <button type="submit">Envoyer</button>
          </form>
      </div>

    </div>
  </template>
  
  <script>
  export default {
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
        this.messages.push(event.data);
      };
    },
    methods: {
      sendMessage() {
        if (this.newMessage.trim()) {
          this.socket.send(this.newMessage);
          this.newMessage = '';
        }
      },
    },
  };
  </script>
  