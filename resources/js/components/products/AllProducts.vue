<template>
<section>
	<div class="justify-content-center">
		<h1>Productos de la categoria</h1>
	</div>
		<div class="row" >
			<div v-for="product in products" :key="product.id" class="card mx-2 my-3 card_size col-md-6 col-sm-6">
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
					<a :href="`/products/show/${product.id}`" class="btn btn-primary justify-content-center mx-2 my-3">Ver detalles</a>
				</div>
			</div>
		</div>
</section>
</template>

<script>
export default {
  props: ['products', 'category'],

  components:{ },

  data() {
    return {

	};
  },
  methods: {
    ProductsByCategory(categoryId) {
      // Filtrar productos por ID de categoría
      return this.products.filter((product) => product.category.id === categoryId);
    },

  },

};

</script>