<template>
  <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
export default {
  props: ["active"],

  data() {
    return {
      toggle: this.active
    };
  },

  computed: {
    classes() {
      return ["btn", this.toggle ? "btn-danger" : "btn-primary"];
    }
  },

  methods: {
    subscribe() {
      axios[this.toggle ? "delete" : "post"](
        location.pathname + "/subscriptions"
      );

      this.toggle = !this.toggle;
    }
  }
};
</script>