<template>
    <div class="chat">
        <div class="chat-title">
            <h2>Bem vindo ao Chat {{ name }}</h2>
        </div>
        <div class="chat-content">
            <div class="chat-messages">
              <div v-for="(value,index) in mensagens" :key="index"  class="mensagem">
                <div v-if="!value.alertMessage" :class="value.user == name ? 'user-right': 'user-left'">
                  {{ value.user }} ás {{ value.hour }}
                </div>
                <div v-if="!value.alertMessage" :class="value.user == name ? 'message-right': 'message-left'">
                  {{ value.text }}
                </div>
                <div v-if="value.alertMessage" class="alert-message">
                  {{ value.user }} {{ value.text }}
                </div>
              </div>
            </div>
        </div>
        <div class="chat-text">
          <textarea v-model="texto" cols="97" rows="5"></textarea>
        </div>
        <div class="chat-confirm-text">
          <button @click="enviarMensagem">
            <i class="fas fa-paper-plane"></i>
            Enviar Mensagem
          </button>
        </div>
    </div>
</template>

<script>
import io from 'socket.io-client'
export default {
  name: 'Chat',
  props: {
    name: {
      type: String
    }
  },
  data () {
    return {
      socket: io('localhost:3000', {
        query: {
          name: this.name
        }
      }),
      texto: '',
      mensagens: []
    }
  },
  methods: {
    enviarMensagem () {
      let hour = new Date()
      if (this.texto !== '') {
        this.socket.emit('sendMessage', {
          user: this.name,
          text: this.texto,
          hour: hour.getHours() + ':' + hour.getMinutes(),
          alertMessage: false
        })
      }
      this.texto = ''
    }
  },
  mounted () {
    if (!this.name) {
      this.$router.push('/')
    }
    this.socket.on('newMessage', data => {
      this.mensagens.push(data)
    })
    this.socket.on('userConnected', data => {
      let hour = new Date()
      this.mensagens.push({
        user: data,
        text: 'entrou da sala de bate-papo',
        hour: hour.getHours() + ':' + hour.getMinutes(),
        alertMessage: true
      })
    })
    this.socket.on('userDisconnected', data => {
      let hour = new Date()
      this.mensagens.push({
        user: data,
        text: 'saiu da sala de bate-papo',
        hour: hour.getHours() + ':' + hour.getMinutes(),
        alertMessage: true
      })
    })
  }
}
</script>

<style scoped>
  .mensagem {
    text-align: left;
    margin-left: 10px;
    margin-top:10px;
  }
  .chat-content {
    display: flex;
    justify-content: center;
    margin-bottom: 10px;
  }
  .chat-messages {
    width:80%;
    height: 300px;
    border-radius: 15px;
    overflow-y: auto;
    border: 1px solid rgb(199, 199, 199);
    display: flex;
    flex-direction: column;
  }
  .chat-text {
    margin-bottom:10px;
  }

  .chat-confirm-text > button {
    width: 80%;
    height: 30px;
    border-radius: 5px;
    background-image: linear-gradient(to right, #243949 0%, #517fa4 100%);
    color:white;
    font-weight: bold;
    border:1px solid gray;
  }
  button:hover {
    cursor: pointer;
  }
  button:focus {
    outline:none;
  }
  .user-left {
    float:left;
    clear: both;
    font-size:12px;
    margin-bottom:10px;
  }
  .user-right {
    float:right;
    clear: both;
    margin-right: 10px;
    font-size:12px;
    margin-bottom:10px;
  }
  .message-left {
    float:left;
    clear: both;
    padding: 6px 15px;
    border:1px solid gray;
    background-color: gray;
    border-bottom-right-radius: 18px;
    max-width: 400px;
    color:white;
    display: inline;
  }
  .message-right {
    float: right;
    clear: both;
    padding: 6px 15px;
    border:1px solid #749d9e;
    background-image: linear-gradient(to right, #4a799c 0%, #517fa4 100%);
    border-bottom-left-radius: 18px;
    margin-bottom:10px;
    margin-right: 10px;
    max-width: 400px;
    color:white;
    display: inline;
  }
  .alert-message {
    text-align: center;
    font-size:12px;
  }

  textarea {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    width: 80%;
  }

  .chat-messages::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
    background-color: #F5F5F5;
  }

  .chat-messages::-webkit-scrollbar {
    width: 8px;
    background-color: #F5F5F5;
  }

  .chat-messages::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: rgb(126, 125, 125);
  }
</style>
