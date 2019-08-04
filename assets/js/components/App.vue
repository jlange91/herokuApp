<template>
  <div>
      <div class="flex lg:flex-row flex-wrap -mx-2">
        <product-card />
      </div>
  </div>
</template>
<script>
import ProductCard from './ProductCard'

  export default {
    components: {
      ProductCard
    }
  }
</script>
