<template>
  <div class="justify-content-center">
    <div class="card-header">Subscriber List</div>
    <ul id="subscriber-list" class="list-group">
      <li v-for="subscriber in subscribers" v-bind:key="subscriber.id">
        <div class="row">
          <a
            v-on:click="$emit('subscriber-selected', subscriber)"
            class="list-group-item col-8"
          >{{subscriber.name}}</a>

          <button class="btn btn-secondary col-4" v-on:click="deleteSubscriber(subscriber)">Delete</button>
        </div>
      </li>
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
    },
    deleteSubscriber: async function(deletedSubscriber) {
      try {
        await this.$http.delete(`/api/subscribers/${deletedSubscriber.id}`);
        this.subscribers = this.subscribers.filter(
          subscriber => subscriber.id !== deletedSubscriber.id
        );
      } catch (error) {
        alert(error.message);
      }
    }
  }
};
</script>
