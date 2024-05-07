<template>
<section>
	<div v-if="category.id == products.category_id">
		<div class="d-flex justify-content-center my-4">
			<h1>Productos de la categoria {{ category.name }}</h1>
		</div>
			<div class="row" >
				<div v-for="product in products" :key="product.id" class="mx-2 my-3 card_size col-md-6 col-sm-6">
					<product :product="product" />
				</div>
			</div>
		</div>
</section>
</template>

<script>
import Product from './Product.vue'
export default {
  props: ['products', 'category'],

  components:{Product},

  data() {
    return {

	};
  },
  methods: {

  },

};

</script>
