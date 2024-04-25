<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-success " @click="openModal">Agregar producto</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="book_table">
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

										<button type="button" class="btn btn-primary btn-sm" title="Editar" @click="editBook(book)">
											<i class="fas fa-pencil-alt"></i>
										</button>

										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deleteBook(book)">
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
				<book-modal :authors_data="authors_data" :book_data="book" ref="book_modal" />
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		name: '',
		components: {},
		props: ['products'],

		data() {
			return {}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#book_table').DataTable()
			}
		}
	}
</script>