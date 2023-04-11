<template>
  <div>
    <ul>
      <li v-for="user in users" :key="user.id">
        <div>{{ user.name }}</div>
        <div>{{ user.email }}</div>
      </li>
    </ul>
  </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'UsersLayout',
  props: {
    users: Array,
  },
})
</script>
