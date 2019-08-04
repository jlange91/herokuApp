<template>
  <div class="w-full lg:w-1/3 px-2 mb-4">
    <div class="max-w-sm rounded overflow-hidden hover:shadow-lg mx-auto">
        <img class="w-full" src="https://tailwindcss.com/img/card-top.jpg" alt="Sunset in the mountains">
        <div class="px-6 py-4">
          <div class="font-bold text-xl mb-2 text-purple-500">{{ product.title }}</div>
          <p class="text-gray-700 text-base">
            {{ product.content }}
          </p>
        </div>
        <div class="flex justify-between px-6 py-4">
          <span class="inline-block bg-purple-200 rounded-full px-3 py-1 text-sm font-semibold text-purple-600 opacity-75 mr-2">#{{ product.status }}</span>
          <span class="inline-block px-3 py-1 text-sm font-semibold text-gray-900 opacity-75">{{ productDate }}</span>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'ProductCard',
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  computed: {
    productDate() {
      const old = new Date(this.product.created_at.date)
      const now = new Date()

      return ( (old.getFullYear() < now.getFullYear()) ||
       (old.getMonth() < now.getMonth()) ||
       (old.getDate() < now.getDate()) ) ?
       this.product.created_at.date.split(' ')[0] : this.product.created_at.date.split(' ')[1].split('.')[0]
    }
  }
}
</script>

<style>

</style>
