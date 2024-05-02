<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-success " @click="openModal"><i class="fa-solid fa-circle-plus"></i> Agregar producto</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="product_table">
						<thead>
							<tr>
								<th>#</th>
								<th>nombre</th>
								<th>Precio</th>
								<th>Descripcion</th>
								<th>Stock</th>
								<th>Categoria</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="product in products" :key="product.id">
								<td>{{ product.id}}</td>
								<td>{{ product.name}}</td>
								<td>{{ product.price}}</td>
								<td>{{ product.description}}</td>
								<td>{{ product.stock}}</td>
								<td>{{ product.category.name}}</td>
								<td>
									<div class="d-flex justify-content-center">

										<button type="button" class="btn btn-primary btn-sm" title="Editar" @click="editProduct(product)">
											<i class="fas fa-pencil-alt"></i>
										</button>

										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deleteProduct(product)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<product-modal :categories_data="categories_data" :product_data="product" ref="product_modal" />
			</div>
		</div>
	</section>
</template>

<script>
	import { deleteMessage, successMessage } from '@/helpers/Alerts.js'
	import ProductModal from './ProductModal.vue'

	export default {
		name: '',
		components: {
			ProductModal
		},
		props: ['products', 'categories_data'],

		data() {
			return {
				modal: null,
				product: null
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#product_table').DataTable()
				const modal_id = document.getElementById('product_modal')
				this.modal = new bootstrap.Modal(modal_id)
				modal_id.addEventListener('hidden.bs.modal', e => {
					this.$refs.product_modal.reset()
				})
			},
			openModal() {
				this.modal.show()
			},

			editProduct(product) {
				this.product = product
				this.openModal()
			},
			async deleteProduct({ id }) {
				if (!(await deleteMessage())) return
				try {
					await axios.delete(`/products/${id}`) //destructurar el id y enviar
					await successMessage({ is_delete: true, reload: true })
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
