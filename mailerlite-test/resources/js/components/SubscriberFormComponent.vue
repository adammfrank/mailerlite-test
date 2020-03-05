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

    <h5>Fields</h5>
    <ul class="list-group">
      <li class="list-group-item" v-for="field in selectedSubscriber.fields" v-bind:key="field.id">
        <div class="form-group">
          <label>Title</label>
          <input type="text" class="form-control" v-model="field.title" />
          <label>Type</label>
          <select v-model="field.type">
            <option disabled value>Please select one</option>
            <option
              v-for="typeOption in typeOptions"
              v-bind:key="typeOption.value"
              v-bind:value="typeOption.value"
            >{{ typeOption.value }}</option>
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
  mounted() {},
  props: {
    selectedSubscriber: {
      default: {}
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
      ],
      typeOptions: [
        {
          value: "date"
        },
        {
          value: "number"
        },
        {
          value: "string"
        },
        {
          value: "boolean"
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
      this.selectedSubscriber.fields = this.selectedSubscriber.fields.map(
        field => {
          field.subscriber_id = this.selectedSubscriber.id;
          return field;
        }
      );
      const response = await this.$http.put(
        `/api/subscribers/${this.selectedSubscriber.id}`,
        this.selectedSubscriber
      );
    },
    addField: function() {
      this.selectedSubscriber.fields.push({
        title: "",
        type: "date",
        id: null,
        subscriber_id: null
      });
    }
  }
};
</script>
