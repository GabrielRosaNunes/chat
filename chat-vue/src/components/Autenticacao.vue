<template>
    <div>
        <div class="title">
            <h2>Bem Vindo ao Chat</h2>
        </div>
        <strong>Login</strong>
        <div class="content-alerta">
          <div v-if="error" class="alerta">
            <center>{{ errorText }}</center>
          </div>
        </div>
        <div class="content">
            <div class="input">
                <input v-model="email" type="email">
            </div>
            <div class="buttons">
                <button @click="logar">
                  <i class="fas fa-sign-in-alt"></i>
                  Logar
                </button>
                <p>Não possui cadastro? Clique <router-link tag="a" to="/cadastro">aqui</router-link> para realizá-lo</p>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'MeuComponente',
  data () {
    return {
      email: '',
      error: false,
      errorText: ''
    }
  },
  methods: {
    logar () {
      let post = new FormData()
      post.append('email', this.email)
      if (this.email !== '') {
        axios.post('http://localhost:8000/login', post).then(
          (response) => {
            if (response.status === 200 && response.data['status']) {
              this.$router.push({
                name: 'Chat',
                params: {
                  name: response.data['message']['user_name']
                }
              })
            } else {
              this.errorText = response.data['message']
              this.error = true
            }
          }, (error) => {
            console.log(error)
          }
        )
      }
    }
  }
}
</script>

<style scoped>
    .input {
      margin-bottom:10px;
    }

    .buttons > button {
      background-image: linear-gradient(to right, #243949 0%, #517fa4 100%);
      width: 60%;
      height: 30px;
      color:white;
      font-weight: bold;
      border-radius: 7px;
      border:1px solid #749d9e;
    }
    button:hover {
      cursor: pointer;
    }
    button:focus {
      outline: none;
    }

    .input input {
      width: 60%;
      height: 30px;
      font-size: 18px;
      margin-top: 10px;
      padding-left:6px;
      border-radius:7px;
      border:1px solid gray;
    }

    .input input[type=email]:focus {
      outline:none;
      width: 60%;
      height: 30px;
      font-size: 18px;
      padding-left:6px;
      border-radius:7px;
      border:2px solid rgba(76, 147, 194, 0.521);
    }

    .alerta {
      margin-bottom:10px;
      padding:6px 20px;
      border-radius: 35px;
      color: rgb(173, 68, 68);
      border: 1px solid rgb(156, 41, 41);
      background-color: rgb(255, 215, 215);
    }
    .content-alerta {
      margin-top:10px;
      display: flex;
      justify-content: center;
    }
</style>
