<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form class="form-horizontal" role="form">
                            <div class="form-group" :class="{'has-error' : errorsEmail}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" v-model="loginDetails.email" required autofocus>

                                    <span v-if="errorsEmail" class="help-block">
                                        <strong>{{emailError}}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error' : errorsPassword}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" v-model="loginDetails.password" name="password" required>

                                    <span v-if="errorsPassword" class="help-block">
                                        <strong>{{ password }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" v-model="loginDetails.remember" name="remember" > Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" @click.prevent="loginPost" class="btn btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link" href="">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var HttpResource = require('vue-resource');
    export default {
        name: "login",
        data(){
            return {
                loginDetails:{
                    email: '',
                    password: '',
                    remember: true
                },
                errorsEmail: false,
                errorsPassword: false,
                emailError: null,
                passwordError: null
            }
        },
        methods:{
            loginPost(){
                let vm = this;
                HttpResource.Http.post("https://agencia.com.devel/proyecto_agencia_viajes/agencia_viaje/agencia_viaje/public/login", vm.loginDetails).then(response =>{
                    console.log(response);
                    window.location.href = "https://agencia.com.devel/proyecto_agencia_viajes/agencia_viaje/agencia_viaje/public/home";
                }, response => {
                    debugger;
                    var errors = response;
                    console.log(errors);
                    if(errors.statusText === 'unprocessable Entity' || errors.status === 422){
                        if(errors.data){
                            if(errors.data.errors.email){
                                vm.errorsEmail = true;
                                vm.emailError = _.isArray(errors.data.errors.email) ? errors.data.errors.email[0]: errors.data.errors.email;
                            }
                        if(errors.data.errors.password){
                            vm.errorsPassword = true;
                            vm.passwordError = _.isArray(errors.data.errors.password) ? errors.data.errors.password[0]: errors.data.errors.password;
                        }

                        }
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>