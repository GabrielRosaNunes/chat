# Chat
Projeto de sala de bate papo em tempo real.

# Tecnologias Utilizadas

Front-End : Vue.js
Back-end: Lumen (PHP) e Node.js (Comunicação pelo socket)
Web Socket: Socket.io

# Como testar o projeto?

Para testar o projeto na sua máquina é necessário ter as seguintes tecnologias préviamente instaladas:
  - PHP 7.3 > 
  - Node.js e NPM (versão estável)
  - Vue.js
  
Após a instalação das tecnologias citadas, é necessário efetuar o passo a passo abaixo:

  - Entrar na pasta do chat-php pelo terminal e execute o comando composer update
  - Executar o comando php -S localhost:8000 -t public
  - Entrar na pasta chat-node em outro terminal e executar o comando node index.js
  - Entrar na pasta chat-vue em outro terminal e executar o comando npm install
  - Após o final da instalação das bibliotecas do passo anterior, execute o comando npm run dev.
  
# Imagens do Projeto
### - Login Usuário
![Login](https://raw.githubusercontent.com/GabrielRosaNunes/chat/master/autenticacao.png)
### - Cadastro de Usuário
![Cadastro](https://raw.githubusercontent.com/GabrielRosaNunes/chat/master/cadastro.png)
### - Chat
![Chat](https://raw.githubusercontent.com/GabrielRosaNunes/chat/master/chat.png)
