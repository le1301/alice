# Alice - Sistema de Gerenciamento para Salas de Leitura e Biblioteca Escolares

## 📖 Descrição

**Alice** é um sistema desenvolvido para facilitar a organização e gestão de salas de leitura e bibliotecas escolares. Ele oferece uma interface amigável e ferramentas completas para gerenciar empréstimos, acervos, alunos, e gerar relatórios, tornando o dia a dia dos bibliotecários e educadores mais eficiente.

---

## 🚀 Funcionalidades Principais

- **📚 Gerenciamento de Alunos**  
  Cadastro, edição e listagem de alunos com informações detalhadas, incluindo foto e status.

- **📖 Gestão de Livros**  
  Controle total do acervo com funcionalidades para cadastro, edição, busca e listagem de livros.

- **🔄 Empréstimos e Devoluções**  
  Registro de empréstimos, renovação e controle de devoluções com alertas para atrasos.

- **📊 Relatórios Detalhados**  
  Geração de relatórios em HTML e PDF para acompanhamento e análise de dados.

- **🏷️ Cadastro de Editoras e Classificações**  
  Organização do acervo por editoras e códigos de classificação decimal.

- **📈 Painel de Controle**  
  Dashboard com informações resumidas do sistema, incluindo total de livros, alunos e empréstimos.

- **👤 Controle de Usuários**  
  Gerenciamento de usuários do sistema com autenticação segura.

- **🆔 Gerador de Carteirinhas**  
  Criação de carteirinhas personalizadas para alunos, incluindo QR Code.

---

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel (PHP)  
- **Frontend**: Blade Templates (HTML, CSS, JavaScript)  
- **Banco de Dados**: MySQL  
- **Relatórios PDF**: Barryvdh/DomPDF  
- **Autenticação**: Middleware e controle nativo do Laravel  

---

## 📋 Requisitos

Para executar o **Alice**, é necessário:

- PHP 8.1 ou superior  
- Composer  
- Servidor MySQL  
- Servidor Web (Apache ou Nginx)  
- Node.js (opcional, para compilação de assets front-end)  

---

## 💻 Instalação

1. Clone o repositório:
   ```bash
   git clone https://github.com/le1301/alice.git
   cd alice
   ```

2. Instale as dependências:
   ```bash
   composer install
   ```

3. Configure o arquivo `.env`:
   - Copie o arquivo de exemplo:
     ```bash
     cp .env.example .env
     ```
   - Configure as variáveis do banco de dados e outras configurações necessárias.

4. Gere a chave da aplicação:
   ```bash
   php artisan key:generate
   ```

5. Execute as migrações e seeders:
   ```bash
   php artisan migrate --seed
   ```

6. Inicie o servidor:
   ```bash
   php artisan serve
   ```

---

## 🤝 Contribuições

Contribuições são bem-vindas!  
Siga os passos abaixo para contribuir:

1. Faça um fork do projeto.  
2. Crie uma branch para sua funcionalidade:  
   ```bash
   git checkout -b feature/nova-funcionalidade
   ```  
3. Envie suas alterações:  
   ```bash
   git push origin feature/nova-funcionalidade
   ```  
4. Abra um **pull request** no repositório original.

---

## 📜 Licença

Este projeto está licenciado sob a [MIT License](LICENSE).

---

## 📞 Contato

Desenvolvido por **Prof. Me. Leandro Carvalho de Oliveira**.  
Entre em contato:  
- 📞 WhatsApp: [Clique aqui](https://wa.me/5514996583055)  

**Alice** - Inspirando a organização e a leitura nas escolas! 📚✨  
