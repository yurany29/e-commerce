<template>
	<div class="modal fade" id="user_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">{{ is_create ? 'Crear' : 'Editar' }} Usuario</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>

				<backend-error :errors="back_errors" />

				<!-- Formulario -->
				<Form @submit="saveUser" :validation-schema="schema" ref="form">
					<div class="modal-body">
						<section class="row">

							<!-- Rol -->
							<div class="col-12 mt-2">
								<Field name="role" v-slot="{ errorMessage, field }" v-model="user.role">
									<label for="role">Rol</label>

									<v-select  id="role" :options="roles_data" label="name" v-model="user.role" :reduce="role => role.id" v-bind="field" placeholder="Seleccione el rol" :clearable="false" :class="`${errorMessage || back_errors['role'] ? 'is-invalid' : ''}`">
									</v-select>
									<span class="invalid-feedback">{{ back_errors['role'] }}</span>

								</Field>
							</div>

							<!-- cedula -->
							<div class="col-12 mt-2">
								<label for="title">Cedula</label>
								<Field name="number_id" v-slot="{ errorMessage, field }" v-model="user.number_id">
									<input type="number" id="number_id" v-model="user.number_id" :class="`form-control ${errorMessage || back_errors['number_id'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['number_id'] }}</span>
								</Field>
							</div>

							<!-- name -->
							<div class="col-12 mt-2">
								<Field name="name" v-slot="{ errorMessage, field }" v-model="user.name">
									<label for="name">Nombre</label>
									<input type="text" id="name" v-model="user.name" :class="`form-control ${errorMessage || back_errors['name'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['name'] }}</span>
								</Field>
							</div>

							<!-- last_name -->
							<div class="col-12 mt-2">
								<Field name="last_name" v-slot="{ errorMessage, field }" v-model="user.last_name">
									<label for="name">Apellido</label>
									<input type="text" id="last_name" v-model="user.last_name" :class="`form-control ${errorMessage || back_errors['last_name'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['last_name'] }}</span>
								</Field>
							</div>

							<!-- email -->
							<div class="col-12 mt-2">
								<Field name="email" v-slot="{ errorMessage, field }" v-model="user.email">
									<label for="email">Correo electronico</label>
									<input type="email" id="email" v-model="user.email" :class="`form-control ${errorMessage || back_errors['email'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['email'] }}</span>

								</Field>
							</div>

							<!-- password -->
							<div class="col-12 mt-2">
								<Field name="password" v-slot="{ errorMessage, field }" v-model="user.password">
									<label for="password">Contraseña</label>
									<input type="password" id="password" v-model="user.password" :class="`form-control ${errorMessage || back_errors['password'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['password'] }}</span>

								</Field>
							</div>

							<!-- confirm password -->
							<div class="col-12 mt-2">
								<Field name="password_confirmation" v-slot="{ errorMessage, field }" v-model="user.password_confirmation">
									<label for="password_confirmation">Confirmar contraseña</label>
									<input type="password" id="password_confirmation" v-model="user.password_confirmation" :class="`form-control ${errorMessage || back_errors['password_confirmation'] ? 'is-invalid' : ''}`" v-bind="field">
									<span class="invalid-feedback">{{ errorMessage }}</span>
									<span class="invalid-feedback">{{ back_errors['password_confirmation'] }}</span>

								</Field>
							</div>
						</section>
					</div>

					<!-- Buttons -->
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="sumbit" class="btn btn-primary">Almacenar</button>
					</div>
				</Form>
			</div>
		</div>
	</div>
</template>
<script>
	import {successMessage, handlerErrors} from '@/helpers/Alerts.js'
	//import BackendError from '../Components/BackendError.vue';
	import {Field, Form} from 'vee-validate';
	import * as yup from 'yup';
	export default {
		props: ['roles_data'],
		components: {Field, Form},

		data() {
			return {
				is_create: true,
				user: {},
				role: null,
				back_errors: {}
			}
		},

		watch:{
		user_data(new_value){
			this.user = {...new_value}
			if (!this.user.id) return
			this.is_create = false
			this.role = this.user.role_id
			}
		},

		computed: {
		schema(){
			return yup.object({
				role: yup.string().required(),
				number_id: yup.number().required().positive().integer(),
				name: yup.string().required(),
				last_name: yup.string().required(),
				email: yup.string().required(),
				password: yup.string().required(),
				password_confirmation: yup.string().required(),
				});
		},
	},

		created(){
			this.index()
		},



		methods: {
			async index() {
			},

			async saveUser() {
			try {
				if (this.is_create) await axios.post('/users', this.user)
				else await axios.post(`/users/${this.user.id}`, this.user)
				await successMessage({ reload: true })
			} catch (error) {
				this.back_errors = await handlerErrors(error)
				}
			},

			reset(){
			this.is_create = true,
			this.user =  {},
			this.role =  null,
			this.$parent.user = {},
			this.back_errors = {},
			setTimeout(() => this.$refs.form.resetForm(),100);
		}



		}
	}
</script>
