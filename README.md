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

  1 - Entrar na pasta do chat-php pelo terminal e execute o comando composer update
  2 - Executar o comando php -S localhost:8000 -t public
  3 - Entrar na pasta chat-node em outro terminal e executar o comando node index.js
  4 - Entrar na pasta chat-vue em outro terminal e executar o comando npm install
  5 - Após o final da instalação das bibliotecas do passo 4, execute o comando npm run dev.
