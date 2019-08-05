<template>
  <div :class="error ? '' : 'mb-2'" class="relative w-full" v-click-outside="hide">
    <div class="inline-flex w-full">
      <input
        :value="value"
        name="dropdown"
        type="text"
        disabled="true"
        :class="[error ? ' border-red-500' : visible ? 'border-blue-500' : 'border-gray-300', value === 'Choisir un statut' ? 'text-gray-500' : 'text-gray-900']"
        class="mb-2 appearance-none block w-full bg-white border py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-blue-500 rounded"
      />
      <div
        @click="click"
        class="cursor-pointer"
        style="position:absolute; left:0; right:0; top:0; bottom:0;"
      ></div>
    </div>​
    <div
      class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
    >
      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
      </svg>
    </div>
    <div v-if="visible" class="absolute shadow bg-white z-10 flex w-full h-36">
      <ul class="list-reset text-lg w-full">
        <li
          class="w-full py-2"
          v-for="(option, name, i) in options"
          :class="selectedOption === name ? 'bg-blue-600 text-white' : selectedOption === 'Choisir une durée' ? 'hover:bg-blue-dark hover:text-white cursor-pointer' : 'hover:shadow cursor-pointer text-gray-900 hover:bg-gray-300'"
          @click="$emit('input', name), visible = false"
          :value="option"
          :key="i"
        >
          <span class="px-4">{{ name }}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import clickOutside from "../directives/clickOutside.js";

export default {
  name: "AppDropdown",
  props: {
    value: {
      type: String,
      required: true
    },
    options: {
      type: Object,
      required: true
    },
    error: {
      type: Boolean,
      required: false,
      default: false
    }
  },
  data() {
    return {
      selectedOption: "",
      visible: false
    };
  },
  mounted() {
    this.selectedOption = this.value;
  },
  methods: {
    hide() {
      this.visible = false;
    },
    click() {
      this.visible = !this.visible;
      this.$emit("click");
    }
  },
  watch: {
    value(newValue) {
      this.selectedOption = newValue;
    }
  }
};
</script>


<style>
</style>