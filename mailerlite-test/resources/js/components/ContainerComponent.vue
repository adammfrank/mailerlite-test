<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <subscriber-list v-on:subscriber-selected="selectedSubscriber = $event"></subscriber-list>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <subscriber-form v-bind:selected-subscriber="selectedSubscriber"></subscriber-form>
        </div>
      </div>
    </div>
    <br />
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
      activeComponent: "subscriber-list",
      selectedSubscriber: {}
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
