<template>
    <div class="message">
      <div class="message-text">{{ message.text }}</div>
      <div class="message-timestamp">{{ formattedTimestamp }}</div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      message: {
        type: Object,
        required: true,
      },
    },
    computed: {
      formattedTimestamp() {
        const date = new Date(this.message.timestamp);
        return date.toLocaleTimeString();
      },
    },
  };
  </script>
  
  <style scoped>
  .message {
    margin-bottom: 12px;
    padding: 8px;
    border-radius: 4px;
    background-color: #fff;
    border: 1px solid #ddd;
  }
  
  .message-text {
    font-size: 16px;
  }
  
  .message-timestamp {
    font-size: 12px;
    color: #888;
    text-align: right;
  }
  </style>
  