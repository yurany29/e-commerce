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
			<div v-for="product in category.products" :key="product.id" class="card mx-2 my-3 card_size col-md-6 col-sm-6">
				<img :src="product.file.route" class="card-img-top" alt="Producto">
				<div class="card-body">
					<h5 class="card-title">{{ product.name }}</h5>
					<div class="d-flex flex-wrap">
						<span class="w-100">
						<strong>Precio: </strong> {{ product.price }}
						</span>
						<span class="mt-2">
						<strong>Stock: </strong> {{ product.stock }}
						</span>
					</div>
				</div>
			</div>
		</div>
    </div>
</section>
</template>

<script>
import AllProducts from './AllProducts.vue'

export default {
  props: ['categories'],

  components:{ AllProducts },


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