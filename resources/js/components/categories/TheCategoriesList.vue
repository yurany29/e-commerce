<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-success" @click="openModal"><i class="fa-solid fa-circle-plus"></i> Agregar Categoria</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered table-sm" id="book_table">
						<thead>
							<tr>
								<th>#</th>
								<th>nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="category in categories" :key="category.id">
								<td>{{ category.id}}</td>
								<td>{{ category.name}}</td>
								<td>
									<div class="d-flex justify-content-center">

										<button type="button" class="btn btn-primary btn-sm" title="Editar" @click="editCategory(category)">
											<i class="fas fa-pencil-alt"></i>
										</button>

										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deleteCategory(category)">
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
				<category-modal :category_data="category" ref="user_modal"/>
			</div>
		</div>
	</section>
</template>

<script>
import {deleteMessage, successMessage} from '@/helpers/Alerts.js'
import CategoryModal from './CategoryModal.vue'

	export default {
		name: '',
		components: {
			CategoryModal
		},
		props: ['categories'],

		data() {
			return {
				modal: null,
				category: null
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#book_table').DataTable()
				const modal_id = document.getElementById('category_modal')
				this.modal = new bootstrap.Modal(modal_id)
				modal_id.addEventListener('hidden.bs.modal', e => {
					this.$refs.user_modal.reset()
				})
			},
			openModal(){
				this.modal.show()
			},

			editCategory(category){
				this.category = category
				this.openModal()
			},
			async deleteCategory({id}){
				if (!await deleteMessage()) return
				try{
					await axios.delete(`/categories/${id}`) //destructurar el id y enviar
					window.location.reload()
					await successMessage({ is_delete : true, reload : true })
				} catch(error){
					console.error(error)
				}
			},
		}
	}
</script>
