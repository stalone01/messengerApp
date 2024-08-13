<template>
  <div class="message" :class="{ 'own-message': isOwnMessage }">
    <div class="message-content">
      <strong v-if="!isOwnMessage">User {{ message.user_id }}:</strong>
      <p>{{ message.message }}</p>
    </div>
    <div class="message-timestamp">
      <small>{{ formattedTime }}</small>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Message',
  props: {
    message: {
      type: Object,
      required: true,
    },
    currentUserId: {
      type: Number,
      required: true,
    },
  },
  computed: {
    isOwnMessage() {
      return this.message.user_id === this.currentUserId;
    },
    formattedTime() {
      const date = new Date(this.message.timestamp);
      return date.toLocaleTimeString();
    },
  },
};
</script>

<style scoped>
.message {
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
  max-width: 60%;
}

.own-message {
  background-color: #dcf8c6;
  align-self: flex-end;
}

.message-content {
  margin-bottom: 5px;
}

.message-timestamp {
  text-align: right;
  font-size: 0.8em;
  color: #888;
}
</style>
