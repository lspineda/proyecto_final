<template>
	<div class="wrap">
		<div class="body">



			<div class="table-responsive">

				<table class="table table-condensed table-hover">
					<thead>
						<tr>
							<th>Nombre</th>
							<th class="align-center">Permisos</th>
							<th class="align-center">Editar</th>
							<th class="align-center">Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="(value, index) in roles">
							<td>{{ value.name }}</td>
							<td class="align-center">
								<button @click="perMission(value.id)" type="button"
									class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
									<i class="material-icons">vpn_key</i>
								</button>
							</td>

							<td class="align-center">
								<button @click="editRole(value.id)" type="button"
									class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
									<i class="material-icons">edit</i>
								</button>
							</td>

							<td class="align-center">
								<button @click="deleteRole(value.id)" type="button"
									class="btn bg-pink btn-circle waves-effect waves-circle waves-float">
									<i class="material-icons">delete</i>
								</button>
							</td>
						</tr>

					</tbody>
				</table>


			</div>




			<div class="row">

				<update-role></update-role>
				<assign-role></assign-role>

			</div>



		</div>
	</div>
</template>

<script>

import { EventBus } from '../../vue-asset';
import mixin from '../../mixin';

import UpdateRole from './UpdateRole.vue'
import AssignRole from './AssignRole.vue'

export default {

	mixins: [mixin],

	components: {

		'update-role': UpdateRole,
		'assign-role': AssignRole

	},

	data() {

		return {

			roles: [],

		}


	},
	created() {

		var _this = this;
		this.getData();

		EventBus.$on('role-created', function () {
			_this.getData();
		});

	},

	methods: {


		getData() {

			axios.get(base_url + 'role-list')
				.then(response => {

					this.roles = response.data;

				})

		},

		perMission(id) {

			EventBus.$emit('assign-permission', id);

		},


		editRole(id) {

			EventBus.$emit('role-edit', id);

		},

		deleteRole(id) {

			Swal({
				title: '¿Estás seguro?',
				text: "¡No podrás revertir esto!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '¡Sí, eliminar!',
				cancelButtonText: 'Cancelar'
			}, () => {



			}).then((result) => {
				if (result.value) {

					axios.get(base_url + 'role/delete/' + id)
						.then(res => {

							EventBus.$emit('role-created', 1);
							this.successAlert(res.data);
						})


				}
			})

		}


	}

}





</script>