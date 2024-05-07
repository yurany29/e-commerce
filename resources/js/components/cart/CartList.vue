<template>

<div class="container d-flex justify-content-end">
	<div class="card text-bg-light mb-3" style="max-width: 14rem;">
		<div class="card-header d-flex justify-content-center">
			<h6> Total: ${{total_sum}} </h6>
			<button class="btn btn-outline-primary">Comprar</button>
		</div>
	</div>
</div>
  <div class="card border-dark mb-3 container" v-for="cart in carts" :key="cart.id" style="max-width: 35rem;">
  <div class="row g-0">
    <div class="col-md-4">
      <img :src="cart.product.file.route" class="img-fluid rounded-start" alt="Producto agregado">
    </div>
    <div class="col-md-8">
      <div class="card-body">
			<h5 class="card-title">Producto: {{cart.product.name}}</h5>
			<h6 class="card-text">Valor Total: ${{cart.total_price}}</h6>
			<div class="d-flex justify-content-end">
				<button type="button" class="btn btn-danger" @click="deleteCart(cart)"><i class="fa-solid fa-trash"></i></button>
			</div>
			<div class="" role="group" aria-label="Basic example">
				<button type="button" @click="updateCartPlus(cart)" id="plus"  class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
				{{cart.quantity}}
				<button type="button" @click="updateCartMinus(cart)" id="minus" class="btn btn-primary btn-sm"><i class="fa-solid fa-minus"></i></button>
			</div>
      </div>
    </div>
  </div>
</div>
<!-- <v-else>
    <div class="container text-center pt-5">
      <h1>No hay productos en el carrito.</h1>
    </div>
  </v-else> -->
</template>

<script>
import { deleteMessage, successMessage, handlerErrors } from '@/helpers/Alerts.js'
import axios from 'axios';
export default {
  props: ['carts', 'total_sum'],

  components:{ },

  data() {
    return {
	};
  },
  methods: {
	async deleteCart({id}){
		if (!(await deleteMessage())) return
		try {
			await axios.delete(`/carts/${id}`)
			await successMessage({is_delete : true, reload : true})
		} catch (error) {
			console.error(error)
		}

	},
	async updateCartPlus(cart){
		const quantity = cart.quantity;
		const product_id = cart.product_id;
		try {
			await axios.put(`/carts/plus/${cart.id}`,{ quantity, product_id})
			window.location.reload()
		} catch (error) {
			//console.error(error)
			await handlerErrors(error)
		}
	},
	async updateCartMinus(cart){
		const quantity = cart.quantity;
		const product_id = cart.product_id;
		try {
			await axios.put(`/carts/minus/${cart.id}`,{ quantity, product_id })
			window.location.reload()
		} catch (error) {
			console.error(error)
		}
	}

  },

};
</script>
