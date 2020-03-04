<template>
  <form>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input
        type="email"
        class="form-control"
        id="exampleInputEmail1"
        aria-describedby="emailHelp"
        v-model="selectedSubscriber.email_address"
      />
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Name</label>
      <input class="form-control" id="exampleInputPassword1" v-model="selectedSubscriber.name" />
    </div>
    <div class="form-group">
      <label for="subscriber-state">State</label>
      <select name="subscriber-state" id="subscriber-state" v-model="selectedSubscriber.state">
        <option disabled value>Please select one</option>
        <option
          v-for="option in stateOptions"
          v-bind:key="option.value"
          v-bind:value="option.value"
        >{{ option.text }}</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.getSubscribers();
  },
  props: ["selectedSubscriber"],
  data: function() {
    return {
      stateOptions: [
        {
          text: "Active",
          value: 0
        },
        {
          text: "Unsubscribed",
          value: 1
        },
        {
          text: "Junk",
          value: 2
        },
        {
          text: "Bounced",
          value: 3
        },
        {
          text: "Unconfirmed",
          value: 4
        }
      ]
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
