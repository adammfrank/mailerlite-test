<template>
  <form>
    <h5>Subscriber</h5>
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

    <h5>Fields</h5>
    <ul class="list-group">
      <li class="list-group-item" v-for="field in fields" v-bind:key="field.id">
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" v-model="field.title" />
          <label>Type</label>
          <select>
            <option disabled value>Please select one</option>
            <option
              v-for="option of typeOptions"
              v-bind:key="option.value"
              v-bind:value="option.value"
            >{{ option.value }}</option>
          </select>
        </div>
      </li>
    </ul>
    <button type="button" v-on:click="addField" class="btn btn-primary">Add Field</button>
    <button type="button" v-on:click="updateSubscriber" class="btn btn-primary">Submit</button>
  </form>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
    this.getSubscribers();
  },
  props: {
    selectedSubscriber: {
      default: {}
    },
    fields: {
      default: [
        {
          title: "",
          type: "date"
        }
      ]
    }
  },
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
    },
    updateSubscriber: async function() {
      const response = await this.$http.put(
        `/api/subscribers/${this.selectedSubscriber.id}`,
        this.selectedSubscriber
      );
    },
    addField: function() {
      this.fields.unshift({ title: "", type: "date" });
    }
  }
};
</script>
