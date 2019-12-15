<template>
    <div id="app">
      <div class="title">
        <h2>Cadastro de Usuario</h2>
      </div>
      <div class="content-alerta">
        <div v-if="error" class="alerta">
          <center>{{ errorText }}</center>
        </div>
      </div>
      <div class="group-form">
        <p>Nome</p>
        <input v-model="name" type="text">
      </div>
      <div class="group-form">
        <p>Email</p>
        <input v-model="email" type="email">
      </div>
      <div class="buttons-form">
        <button class="btn-confirm" @click="newUser">
          <i class="fas fa-check"></i>
          Confirmar
        </button>
        <router-link tag="button" to="/">
          <i class="fas fa-times"></i>
          Cancelar
        </router-link>
      </div>
    </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Cadastro',
  data () {
    return {
      name: '',
      email: '',
      error: false,
      errorText: ''
    }
  },
  methods: {
    newUser () {
      if (this.name !== '' && this.email !== '') {
        let form = new FormData()
        form.append('name', this.name)
        form.append('email', this.email)
        axios.post('http://localhost:8000', form).then(
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
  .group-form {
    margin-bottom:20px;
    width: 100%;
  }

  .group-form p {
    font-weight: bold;
  }
  input {
    width: 60%;
    height: 30px;
    font-size: 18px;
    border-radius:7px;
    padding-left:6px;
    border:1px solid gray;
  }
  input:focus {
    outline:none;
    width: 60%;
    height: 30px;
    font-size: 18px;
    border-radius:7px;
    padding-left:6px;
    border:2px solid rgba(76, 147, 194, 0.521);
  }

  .buttons-form > button {
      width: 30%;
      height: 30px;
      border-radius: 7px;
      border:1px solid gray;
  }
  button:hover {
      cursor: pointer;
  }

  button:focus {
    outline:none;
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
    display: flex;
    justify-content: center;
  }

  .btn-confirm {
    background-image: linear-gradient(to right, #243949 0%, #517fa4 100%);
    color:white;
    font-weight: bold;
  }
</style>
