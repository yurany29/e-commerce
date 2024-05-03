<template>
  <div class="card border-dark mb-3 container" v-for="cart in carts" :key="cart.id" style="max-width: 35rem;">
  <div class="row g-0">
    <div class="col-md-4">
      <img :src="cart.product.file.route" class="img-fluid rounded-start" alt="Producto agregado">
    </div>
    <div class="col-md-8">
      <div class="card-body">
			<h5 class="card-title">Producto: {{cart.product.name}}</h5>
			<h6 class="card-text">Total: {{cart.total_price}}</h6>
			<div class="d-flex justify-content-end">
				<button type="button" class="btn btn-danger" @click="deleteCart(cart)"><i class="fa-solid fa-trash"></i></button>
			</div>
			<div class="btn-group" role="group" aria-label="Basic example">
				<form @submit.prevent="updateCartPlus(cart)">
					<button type="submit" id="plus"  class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
				</form>
				{{cart.quantity}}
				<form @submit.prevent="updateCartMinus(cart)">
					<button type="submit" id="minus" class="btn btn-primary btn-sm"><i class="fa-solid fa-minus"></i></button>
				</form>
			</div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { deleteMessage, successMessage } from '@/helpers/Alerts.js'
import axios from 'axios';
export default {
  props: ['carts'],

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
		try {
			await axios.put(`/carts/plus/${cart.id}`,{ quantity})
			
		} catch (error) {
			console.error(error)
		}
	},
	async updateCartMinus(cart){
		const quantity = cart.quantity;
		try {
			await axios.put(`/carts/minus/${cart.id}`,{ quantity })
			window.location.reload()
		} catch (error) {
			console.error(error)
		}
	}

  },

};
</script>
