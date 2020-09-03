new Vue({
	el: '#crud',
	created: function(){
		this.getUsers();
	},
	data:{
		users:[],
		newStatus:'',
		newName:'',
		newEmail:'',

		fillUser:{
			'id': '',
			'status':'',
			'name': '',
			'email': ''
		},


		errors: [],
		offset: 3,

		pagination:{
			'total': 0,
			'current_page': 0,
			'per_page': 0,
			'last_page': 0,
			'from': 0,
			'to': 0,
		}
	},
	computed: {
		isActived: function() {
			return this.pagination.current_page;
		},
		pagesNumber: function() {
			if(!this.pagination.to){
				return [];
			}

			var from = this.pagination.current_page - this.offset;
			if(from < 1){
				from = 1;
			}

			var to = from + (this.offset * 2);
			if(to >= this.pagination.last_page){
				to = this.pagination.last_page;
			}

			var pagesArray = [];
			while(from <= to){
				pagesArray.push(from);
				from++;
			}
			return pagesArray;
		}
	},
	methods: {

		/*getUsers: function() {
			var urlUsers = 'users';
			axios.get(urlUsers).then(response => {
				//this.users = response.data //para obtener los datos sin paginacion
				this.users = response.data.users.data
				this.pagination = response.data.pagination
			});
		},*/
		getUsers: function(page) {
			var urlUsers = 'users?page='+page;
			axios.get(urlUsers).then(response => {
				//this.users = response.data //para obtener los datos sin paginacion
				this.users = response.data.users.data
				this.pagination = response.data.pagination
			});
		},

		deleteUser: function(user){
			//alert(user.id);
			var url = 'users/' + user.id;
			axios.delete(url).then(response =>{
				this.getUsers();
				toastr.success("Eliminado correctamente");
			});
		},

		createUser: function(){
			var url = 'users';
			axios.post(url, {
				status: this.newStatus,
				name: this.newName,
				email: this.newEmail
			}).then(response => {
				this.getUsers();
				this.newName = '';
				this.newEmail = '';
				this.errors = [];
				$('#create').modal('hide');
				toastr.success("Agregada con exito correctamente");
			}).catch(error => {
				this.errors = error.response.data;
			});
		},

		editUser: function(user){ //mostrar el formulario edit
			this.fillUser.id = user.id;
			this.fillUser.status = user.status;
			this.fillUser.name = user.name;
			this.fillUser.email = user.email;
			$('#edit').modal('show');
		},

		updateUser: function(id){
			//alert('edicion');
			var url = 'users/' + id;
			axios.put(url, this.fillUser).then(response => {
				this.getUsers();
				this.fillUser = {
					'id': '',
					'status':'',
					'name': '',
					'email': ''
				};
				this.errors = [];
				$('#edit').modal('hide');
				toastr.success('tarea actualizada con exito');
			}).catch(error => {
				this.errors = error.response.data;
			});
		},

		changePage: function(page){
			this.pagination.current_page = page;
			this.getUsers(page);
		}


	}
});

/*
var urlUsers = 'https://jsonplaceholder.typicode.com/users';
		new Vue({
			el: '#main',
			created: function() {
				this.getUsers();
			},
			data: {
				lists: []
			},
			methods: {
				getUsers: function() {
					axios.get(urlUsers).then(response => {
						this.lists = response.data
					});
				}
			}
		});

		*/
