# Ordem de Serviço - Robôs para Ensino

Este projeto é um sistema web desenvolvido para gerenciar ordens de serviço relacionadas a robôs educacionais. Ele permite o cadastro e acompanhamento de ações, usuários e projetos, visando otimizar a organização e manutenção de robôs utilizados em ambientes educacionais.

## 📌 Funcionalidades

- **Cadastro de usuários:** Permite o registro de novos usuários no sistema.
- **Gerenciamento de ações:** Possibilita o cadastro, edição e exclusão de ações relacionadas às ordens de serviço.
- **Envio de e-mails:** Utiliza o PHPMailer para envio de notificações por e-mail.
- **Interface amigável:** Desenvolvida com HTML, CSS e SCSS para uma melhor experiência do usuário.
- **Banco de dados:** Estruturação e manipulação de dados utilizando MySQL.

## 🛠️ Tecnologias Utilizadas

- **Frontend:** HTML, CSS, SCSS, JavaScript
- **Backend:** PHP
- **Banco de Dados:** MySQL
- **Bibliotecas:** PHPMailer


## ⚙️ Configure o Ambiente

1. **Instale um servidor local:**
   - Recomendados: [XAMPP](https://www.apachefriends.org/), [WAMP](https://www.wampserver.com/) ou [Laragon](https://laragon.org/).

2. **Importe o banco de dados:**
   - Acesse o **phpMyAdmin** (geralmente disponível em `http://localhost/phpmyadmin`).
   - Crie um novo banco de dados com o nome que preferir.
   - Importe o arquivo `ordemservico.sql` que está no repositório.

3. **Coloque o projeto no diretório do servidor:**
   - Copie todos os arquivos do repositório para a pasta `htdocs` (XAMPP) ou `www` (WAMP).

4. **Acesse o sistema no navegador:**
   - Vá para:
     ```
     http://localhost/Ordem-Servico-Robos-para-Ensino
     ```

## 📷 Capturas de Tela

### Página de Autenticação
![Página de Autenticação](./pagina_autenticacao.jpeg)

### Página de Gerenciamento
![Página de Gerenciamento](./pagina_gerenciamento.jpeg)

### Página de Gerenciamento de Usuários
![Página de Gerenciamento de Usuários](./pagina_gerenciamento_usuarios.jpeg)

### Página de Adicionar Projeto
![Página de Adicionar Projeto](./pagina_adicionar_projeto.jpeg)

### Página de Apresentação
![Página de Apresentação](./pagina_apresentacao.jpeg)

### Página de Apresentação de Oficinas
![Página de Apresentação Oficinas](./pagina_apresentacao_oficinas.jpeg)





