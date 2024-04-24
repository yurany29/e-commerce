<template>
	<section class="d-flex flex-wrap justify-content-center">

		<div v-for="product in products" :key="product.id" class="card mx-2 my-3 card_size">
			<img src="" class="card-img-top" alt="Portada Libro">
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
			<div class="card-footer">
				<div class="d-grid gap-2">
					<button class="btn btn-outline-success" type="button">
						Solicitar
					</button>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		components: {},
		props: ['products'],

		//components:{}
		data() {
			return {}
		}
	}
</script>

<style>
</style>