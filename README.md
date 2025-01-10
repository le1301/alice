<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
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

>>>>>>> 431e98a938ab09018068d0c7a44a96960620e916
