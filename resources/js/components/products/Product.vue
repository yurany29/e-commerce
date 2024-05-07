<template>
	<div class="card mx-2 my-3 card_size col-md-6 col-sm-6">
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
			<a :href="`/products/show/${product.id}`" class="btn btn-primary justify-content-center mx-4 my-3">Ver detalles</a>
		</div>
	</div>

</template>
<script>
	export default {
		props: ['product'],

		components: {},

		data() {
			return {}
		},
		methods: {}
	}
</script>
