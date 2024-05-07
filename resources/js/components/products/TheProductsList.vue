<template>
<div class="d-flex justify-content-center my-4">
	<h1>Productos disponibles</h1>
</div>

<section>
    <div v-for="category in categories" :key="category.id" class="container card d-flex flex-wrap mx-2 my-5 ">
		<a :href="`/categories/all/${category.id}`" class="btn "><strong>Ver mas</strong></a>
      <div class="card-title">
        <h4><strong>Categoría: {{ category.name }}</strong></h4>
      </div>
		<div class="row">
			<div v-for="product in category.products" :key="product.id" class="mx-2 my-3 card_size col-md-6 col-sm-6">
				<product :product="product"/>
			</div>
		</div>
    </div>
</section>
</template>

<script>
import Product from './Product.vue'

export default {
  props: ['categories'],

  components:{ Product },


  data() {
    return {
		search:'',
		product: {}

	};
  },


  methods: {
    // filteredProducts(categoryId) {
    //   // Filtrar productos por ID de categoría
    //   return this.products.filter((product) => product.category.id === categoryId);
    // },

  },


};

</script>
