<template>
  <div class="justify-content-center">
    <div class="card-header">Subscriber List</div>
    <ul id="subscriber-list" class="list-group">
      <li
        v-on:click="$emit('subscriber-selected', subscriber)"
        class="list-group-item"
        v-for="subscriber in subscribers"
        v-bind:key="subscriber.id"
      >{{subscriber.name}}</li>
    </ul>
    <button class="btn btn-primary" v-on:click="addSubscriber">Add Subscriber</button>
  </div>
</template>

<script>
export default {
  mounted() {
    this.getSubscribers();
  },
  data: function() {
    return {
      subscribers: []
    };
  },
  methods: {
    getSubscribers: async function() {
      const response = await this.$http.get("/api/subscribers");
      this.subscribers = response.data;
    },
    addSubscriber: function() {
      const newSubscriber = {
        id: null,
        email_address: null,
        name: "New Subscriber",
        fields: []
      };
      this.subscribers.push(newSubscriber);
      this.$emit("subscriber-selected", newSubscriber);
    }
  }
};
</script>
