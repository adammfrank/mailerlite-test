<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <subscriber-list
            v-bind:subscribers="subscribers"
            v-on:subscriber-selected="selectedSubscriber = $event"
          ></subscriber-list>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <subscriber-form
            v-bind:selected-subscriber="selectedSubscriber"
            v-on:subscriber-deleted="onSubscriberDeleted($event)"
          ></subscriber-form>
        </div>
      </div>
    </div>
    <br />
  </div>
</template>

<script>
export default {
  mounted() {
    this.getSubscribers();
  },
  data: function() {
    return {
      activeComponent: "subscriber-list",
      selectedSubscriber: {},
      subscribers: []
    };
  },
  methods: {
    getSubscribers: async function() {
      const response = await this.$http.get("/api/subscribers");
      this.subscribers = response.data;
    },
    onSubscriberDeleted: async function(deletedSubscriber) {
      try {
        await this.$http.delete(`/api/subscribers/${deletedSubscriber.id}`);
        this.$emit("subscriber-deleted", deletedSubscriber);
        this.subscribers = this.subscribers.filter(
          subscriber => subscriber.id !== deletedSubscriber.id
        );
        this.selectedSubscriber = {};
      } catch (error) {
        alert(error.message);
      }
    }
  }
};
</script>
