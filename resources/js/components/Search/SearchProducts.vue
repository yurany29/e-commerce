<template>
	<div class="row" >
		<div v-for="product in products" :key="product.id" class="mx-2 my-3 card_size col-md-6 col-sm-6">
			<product :product="product"/>
		</div>
	</div>
</template>

<script>
import Product from '../products/Product.vue'

export default {
	props:['products'],

	components:{ Product },

}
</script>

