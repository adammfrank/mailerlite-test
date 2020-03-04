<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Subscriber List</div>
          <ul id="subscriber-list">
            <li v-for="subscriber in subscribers" v-bind:key="subscriber.id">{{subscriber.name}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
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
      console.log("RESPONSE ", response);
      this.subscribers = response.data;
    }
  }
};
</script>
