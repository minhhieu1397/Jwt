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

                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="user.password" type="password" name="password"
                            class="form-control">
                        </div>
                        
                        <div class="button-create">
                            <button @click="login(user)" class="btn btn-primary">Update</button>
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
            }
        },
        methods: {
            login(user) {
               axios.post('/api/login', {email: this.user.email, password: this.user.password})
                .then(response => {
                    this.Jwt = response.data;
                    document.cookie = 'jwt=' +  this.Jwt;
                    this.$router.push({ path: '/Home',  params: { id: '123' } })
                })
                .catch(error => {
                   console.log('vvvvvvvvvvv');
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
