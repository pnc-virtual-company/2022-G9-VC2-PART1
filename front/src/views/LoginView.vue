<template>
    <div style="display: flex;justify-content: space-around;align-items: center; height: 80vh;;">
        <div style="width: 40%;" class="mt-16">
            <LoginComponent @emit-login="loginData" :isNotLogin="isNotValid"/>
        </div>
    </div>
</template>
<script>
import LoginComponent from '@/components/LoginComponent.vue'
import axios from '../axios-http';
export default {
    components: { LoginComponent }, 
    data(){
        return {
            image: 'https://i.pinimg.com/564x/35/8f/c9/358fc916283e21aa785ef5d6fbe56eba.jpg',
        }
    },
    methods: {
        loginData(value){
            // if (this.$route.meta.isAdmin && (/[a-z].[a-z]*@passerellesnumeriques.org*/.test(value.email))) {
            if (this.$route.meta.isAdmin) {
                axios.post('/loginAdmin', value)
                .then((response) => {
                    console.log(response.data);
                    localStorage.setItem("id", (response.data.user.id));
                    localStorage.setItem("user",'teacher' );
                    localStorage.setItem("Authorization", (response.data.token));
                    if (response.data.token) {
                        localStorage.setItem("user",'teacher' );
                        localStorage.setItem("Authorization", (response.data.token));
                        setTimeout(function(){
                            window.location.reload();
                        }, 1000);
                        this.$router.push('/leave');
                    }
                })
            } else if ((/[a-z].[a-z]*@student.passerellesnumeriques.org*/.test(value.email)) && !this.$route.meta.isAdmin ){
                axios.post('/login', value)
                .then((response) => {
                    if (response.data.token) {
                        let id = localStorage.getItem("id");
                        console.log(response.data);
                        localStorage.setItem("id", (response.data.user.id));
                        localStorage.setItem("user",'student' );
                        localStorage.setItem("Authorization", (response.data.token));
                        // setTimeout(function(){
                        //     window.location.reload();
                        // }, 500);
                        this.$router.push('/leave/'+id);
                        console.log('login');
                    } else {
                        console.log('login not success');
                    }
                }).catch((error) => {
                    console.log(error);
                })
            }
        },
        logout() {
            if (this.$route.meta.logout) {
                axios.post('logout')
                .then((response) => {
                    console.log(response.data);
                    localStorage.removeItem("Authorization");
                    localStorage.removeItem("id");
                    localStorage.removeItem("user");
                })
            }
        }
    },
    created() {
        this.logout();
    }
}
</script>
<style>
    
    .login{
        width:30%;
        margin: 5% auto;
    }
    
</style>
