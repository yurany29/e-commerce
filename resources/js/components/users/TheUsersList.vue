<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-success" @click="openModal">Agregar usuario</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="book_table">
						<thead>
							<tr>
								<th>Cedula</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Correo Electronico</th>
								<th>Rol</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="user in users" :key="user.id">
								<td>{{ user.number_id }}</td>
								<td>{{ user.name }}</td>
								<td>{{ user.last_name }}</td>
								<td>{{ user.email }}</td>
								<td>{{ user.roles[0].name}}</td>
								<td>
									<div class="d-flex justify-content-center">

										<button type="button" class="btn btn-primary btn-sm" title="Editar" @click="editUser(user)">
											<i class="fas fa-pencil-alt"></i>
										</button>

										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deleteUser(user)">
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
				<user-modal :roles_data="roles_data" :user_data="user" ref="user_modal" />
			</div>
		</div>
	</section>
</template>

<script>
	import {deleteMessage, successMessage} from '@/helpers/Alerts.js'
	import UserModal from './UserModal.vue';

	export default {
		name: '',
		components: {
			UserModal
		},
		props: ['users', 'roles_data'],

		data() {
			return {
				modal: null,
				user: null
			}
		},

		mounted(){
			this.index()
		},

		methods: {
			async index() {
				$('#book_table').DataTable()
				const modal_id = document.getElementById('user_modal')
				this.modal = new bootstrap.Modal(modal_id)
				modal_id.addEventListener('hidden.bs.modal', e => {
					this.$refs.user_modal.reset()
				})
			},
			openModal(){
				this.modal.show()
			},

			editUser(user){
				this.user = user
				this.openModal()
			},
			async deleteUser({id}){
				if (!await deleteMessage()) return
				try{
					await axios.delete(`/users/${id}`) //destructurar el id y enviar
					window.location.reload()
					await successMessage({ is_delete : true, reload : true })
				} catch(error){
					console.error(error)
				}
			},
		}
	}
</script>

