<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="api-calling">
                    <div class="create-form">
                        <div class="form-group">
                            <label>Username</label>
                            <input v-model="user.email" type="text" name="email"
                            class="form-control">
                        </div>

                        <div class="button-create">
                            <button @click="update(user)" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: '',
                },
                errors: [],
                Jwt: '',
                id: '',
                myCookie: ''
            }
        },
        methods: {
            update(user) {
                this.myCookie = document.cookie;
                var name = 'Jwt' + "=";
                var ca = this.myCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf('jwt') == 0) {
                        this.Jwt=  c.substring(name.length,c.length);
                        console.log(this.Jwt);
                    }
                }
                console.log(ca);
                
                axios.put('/api/user/' + 1, {email: this.user.email, jwt: this.Jwt})
				.then(response => {
                    this.success = 'Cập nhập thành công'
				})
				.catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            },
        },
        created() {
            this.id = this.$route.params.id;
            console.log(this.id)
        },
        mounted() {
            console.log(this.$route.params.user)
            
        }
    }
</script>
