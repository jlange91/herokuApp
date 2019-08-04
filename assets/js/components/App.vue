<template>
  <div>
      <product-form @newProduct="addProductToArray"/>
      <div class="flex lg:flex-row flex-wrap -mx-2">
        <product-card v-for="product in products" :key="product.id" :product="product" />
      </div>
  </div>
</template>
<script>
import axios from 'axios';
import ProductCard from './ProductCard'
import ProductForm from './ProductForm'

  export default {
    components: {
      ProductCard,
      ProductForm
    },
    mounted() {
      this.getProducts()
    },
    data() {
      return {
        products: []
      }
    },
    methods: {
      getProducts() {
        axios.get('products')
        .then(res => this.products = res.data)
        .catch(e => console.log(e))
      },
      addProductToArray(product) {
        this.products.push(product)
      }
    }
  }
</script>
