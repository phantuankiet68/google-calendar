<template>
    <div class="main">
           <div class="form_login">
                <h2>Đăng nhập</h2>
                <h3 v-if="error">{{ error }}</h3>
                <form  @submit.prevent="login" >
                    <div class="form_login-sub">
                        <input type="text" class="text"  placeholder="Email" v-model="form.username"/>
                        <div class="form_login-icon">
                            <i class='bx bxs-user-circle'></i>
                        </div>
                    </div>
                    <div class="form_login-sub">
                        <input type="password" class="password"  placeholder="Mật khẩu" v-model="form.password"  />
                        <div class="form_login-icon">
                            <i class='bx bxs-key'></i>
                        </div>
                    </div>
 
                    <div class="clear"></div>
                    <div class="submit_login">
                        <input type="submit" value="Đăng nhập">
                    </div>
                </form>

            </div>
        </div>
</template>

<script setup>
    import { reactive, ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter()

    let form = reactive({
        username: '',
        password: '',
    })

    
    let error = ref('')

    const login = async () => {
        await axios.post('/api/login', form)
        .then(response =>{
            if(response.data.status_code === 200){
                localStorage.setItem('token', response.data.token)
                router.push('/home')
            }
            else{
                error.value = response.data.message;
            }

        }).catch(error=>{
            console.log(error);
        })

    }
</script>