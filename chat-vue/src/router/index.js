import Vue from 'vue'
import Router from 'vue-router'
import Autenticacao from '@/components/Autenticacao'
import Cadastro from '@/components/Cadastro'
import Chat from '@/components/Chat'

Vue.use(Router)

export default new Router({
  mode: `history`,
  routes: [
    {
      path: '/',
      name: 'Autenticacao',
      component: Autenticacao
    },
    {
      path: '/cadastro',
      name: 'Cadastro',
      component: Cadastro
    },
    {
      path: '/chat',
      name: 'Chat',
      component: Chat,
      props: true
    }
  ]
})
