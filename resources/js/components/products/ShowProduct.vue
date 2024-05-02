<template>
<!-- <button type="button"  class="btn btn-primary justify-content-center mx-2 my-5"><i class="fa-solid fa-cart-plus"></i> Ver carrito</button> -->
<section v-if="product">
  <div class="container card tarjet">
    <img :src="product.file.route" class="card-img-top " alt="Producto">
    <h5 class="card-title">{{ product.name }}</h5>
    <div class="d-flex flex-wrap">
      <span class="w-100">
        <strong>Descripción: </strong> {{ product.description }}
      </span>
      <span class="w-100">
        <strong>Precio: </strong> {{ product.price }}
      </span>
      <span class="mt-2">
        <strong>Stock: </strong> {{ product.stock }}
      </span>
	  <button type="button" @click="addCart(product.id)" class="btn btn-primary justify-content-center mx-2 my-5"><i class="fa-solid fa-cart-plus"></i> Agregar al carrito</button>
    </div>
  </div>
</section>

<section v-else>
  <p>Producto no encontrado.</p>
</section>
</template>

<script>
import {successMessage, handlerErrors} from '@/helpers/Alerts.js'

export default {
  props: ['product'],

  components: {},

  data() {
    return {
    };
  },

  methods: {
	async addCart(productId) {
		try {
			await axios.post('/carts', this.productId)
				await successMessage({ reload: true })
			} catch (error) {
				console.error(error)
				// this.back_errors = await handlerErrors(error)
			}
	}
  },


};
</script>
