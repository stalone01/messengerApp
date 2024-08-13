<template>
    <div class="user-list">
      <h2>Active Users</h2>
      <ul>
        <li v-for="user in users" :key="user.id">
          <span :class="{ 'current-user': user.id === currentUserId }">
            {{ user.name }}
          </span>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    name: 'UserList',
    props: {
      users: {
        type: Array,
        required: true,
      },
      currentUserId: {
        type: Number,
        required: true,
      },
    },
  };
  </script>
  
  <style scoped>
  .user-list {
    padding: 10px;
    border-right: 1px solid #ccc;
  }
  
  .user-list h2 {
    font-size: 1.2em;
    margin-bottom: 10px;
  }
  
  .user-list ul {
    list-style: none;
    padding: 0;
  }
  
  .user-list li {
    margin-bottom: 5px;
  }
  
  .current-user {
    font-weight: bold;
    color: #007bff;
  }
  </style>
  