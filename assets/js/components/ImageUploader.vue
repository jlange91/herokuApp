<template>
  <div
    @dragenter="onDragEnter"
    @dragleave="onDragLeave"
    @dragover.prevent
    @drop="onDrop"
    :class="isdragging ? 'bg-gray-200' : 'bg-white'"
    class="flex flex-col uppercase items-center justify-center border-dashed rounded border-4 border-teal-600 bg-white p-4 container mx-auto w-5/6"
  >
    <div v-show="!images.length" class="flex flex-col justify-center items-center">
      <p>Drag your image here</p>
      <p>or</p>
      <div class="flex items-center justify-center w-full my-2 h-12">
        <label
          for="file"
          class="curesor-pointer absolute max-w-lg text-center py-2 px-2 rounded bg-teal-600 text-white"
        >Select file</label>
        <input class="hidden" type="file" name="file" id="file" @change="onInputChange" />
      </div>
    </div>
    <div class="px-2">
      <div v-show="images.length" class="flex flex-row-reverse">
        <form enctype="multipart/form-data">
          <button
            @click.prevent="upload"
            class="focus:outline-none bg-white border border-teal-600 text-teal-600 px-4 py-2 rounded"
          >Upload image</button>
        </form>
        <label
          for="file"
          class="text-center py-2 px-2 rounded bg-teal-600 text-white mx-4 max-w-md"
        >Select file</label>
      </div>
      <div class="flex flex-wrap -mx-2">
        <div
          v-for="(image, index) in images"
          :key="index"
          class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 px-2 my-2"
        >
          <img :src="image" :alt="index" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "imageUploader",
  props: {
    uploaded: {
      type: Boolean,
      required: true
    }
  },
  data() {
    return {
      isdragging: false,
      dragCount: 0,
      files: [],
      images: [],
      cloudName: "jlange-et-dada"
    };
  },
  methods: {
    upload() {
      const formData = new FormData();
      this.files.forEach(file => {
        formData.append("file", file);
        formData.append("upload_preset", "wtft3ats"); // Replace the preset name with your own
        formData.append("api_key", "582729798726353"); // Replace API key with your own Cloudinary key
        formData.append("timestamp", (Date.now() / 1000) | 0);
      });
      axios
        .post(
          `https://api.cloudinary.com/v1_1/${this.cloudName}/image/upload/`,
          formData
        )
        .then(res => {
          if (res.status === 200) {
            this.$emit("imageUpload", res.data.url);
          }
        })
        .catch(e => console.log("e ", e));
    },
    onDragEnter(e) {
      e.preventDefault();
      this.dragCount++;
      this.isdragging = true;
    },
    onDragLeave(e) {
      e.preventDefault();
      this.dragCount--;
      if (this.dragCount <= 0) this.isdragging = false;
    },
    onDrop(e) {
      e.preventDefault();
      e.stopPropagation();
      this.isDragging = false;
      const files = e.dataTransfer.files;
      Array.from(files).forEach(file => this.addImage(file));
    },
    onInputChange(e) {
      const files = e.target.files;
      Array.from(files).forEach(file => this.addImage(file));
    },
    addImage(file) {
      if (!file.type.match("image.*")) {
        // send meesage with error on
        console.log(`${file.name} is not an image`);
        return;
      }
      if (this.images.length == 1) {
        this.files.shift();
        this.images.shift();
      }
      this.files.push(file);
      const reader = new FileReader();
      reader.onload = e => this.images.push(e.target.result);
      reader.readAsDataURL(file);
    }
  },
  watch: {
    uploaded(newVal) {
      if (newVal === true) {
        this.images = [];
        this.files = [];
        this.isdragging = false;
        this.dragCount = 0;
      }
    }
  }
};
</script>
