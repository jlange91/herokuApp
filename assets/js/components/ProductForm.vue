<template>
  <form class="w-full">
    <div class="flex flex-wrap -mx-3 mb-6">
      <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="title"
        >Title</label>
        <app-input name="title" v-model="product.title" :error="errors.title" :disabled="false" />
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="description"
        >Description</label>
        <app-input
          name="content"
          v-model="product.content"
          :error="errors.content"
          :disabled="false"
        />
      </div>
      <div class="w-full md:w-1/2 px-3">
        <label
          class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
          for="status"
        >Status</label>
        <app-select
          @click="$emit('click')"
          :error="errors.status"
          :selected="selected"
          :options="status"
          @selected="select"
        />
      </div>
      <div v-if="this.errors.image" class="text-center w-full my-8">
        <p>Please upload an image first</p>
      </div>
      <image-uploader @imageUpload="addImage" :uploaded="uploaded" />
      <div class="w-full flex flex-row-reverse mx-4 mt-4">
        <button
          @click.prevent="processForm"
          class="uppercase font-bold bg-teal-600 text-white px-4 py-2 rounded hover:bg-teal-700 mb-8 focus:outline-none"
        >new</button>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import AppInput from "./AppInput";
import AppSelect from "./AppSelect";
import ImageUploader from "./ImageUploader";

export default {
  name: "ProductForm",
  components: {
    AppInput,
    AppSelect,
    ImageUploader
  },
  data() {
    return {
      uploaded: false,
      selected: "Choose status",
      product: {
        title: "",
        content: "",
        status: "",
        image: ""
      },
      errors: {
        title: false,
        content: false,
        status: false,
        image: false
      },
      status: {
        Promo: "Promo",
        New: "New",
        Popular: "Popular"
      }
    };
  },
  methods: {
    processForm() {
      let empty = false;
      const self = this;
      Object.keys(this.product).forEach((key, index) => {
        if (self.product[key] === "") {
          self.errors[key] = true;
          empty = true;
        }
      });
      if (!empty) this.submitProduct();
    },
    submitProduct() {
      axios
        .post("/products", {
          title: this.product.title,
          content: this.product.content,
          status: this.product.status,
          image: this.product.image
        })
        .then(res => {
          if (res.status === 201) {
            this.$emit("newProduct", res.data);
            this.resetLocalVars();
          }
        })
        .catch(e => console.log(e));
    },
    select(e) {
      this.selected = e;
      this.product.status = this.selected;
    },
    addImage(image) {
      this.product.image = image;
      this.errors.image = false;
    },
    resetLocalVars() {
      this.uploaded = true;
      this.selected = "Choose status";
      this.product.title = "";
      this.product.content = "";
      this.product.status = "";
      this.product.image = "";
      this.errors.title = false;
      this.errors.content = false;
      this.errors.status = false;
      this.errors.image = false;
    }
  }
};
</script>

<style>
</style>
