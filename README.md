# ⭐ Sistema de Gestão de Feedback

![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)

> Sistema web profissional para gestão completa de produtos, usuários e coleta de feedback com avaliações por estrelas. Desenvolvido com arquitetura MVC e design system moderno.

## 📋 Sobre o Projeto

O **Sistema de Gestão de Feedback** é uma plataforma web completa que oferece uma solução robusta para empresas coletarem e analisarem feedback de produtos. Com interface moderna e intuitiva, permite gerenciamento eficiente de catálogo de produtos, base de usuários e sistema completo de avaliações.

### ✨ Principais Funcionalidades

- 📦 **Gerenciamento de Produtos** - CRUD completo com visualização em modal e validações
- 👥 **Gestão de Usuários** - Sistema robusto de controle de usuários
- ⭐ **Sistema de Avaliação Avançado** - Rating por estrelas com feedback textual
- 💬 **Comentários Detalhados** - Coleta de feedback qualitativo estruturado
- � **Visualização Modal** - Interface moderna com modais para detalhes
- � **Dashboard Intuitivo** - Painel central com acesso rápido a todas funcionalidades
- 🎨 **Design System Profissional** - Interface neutra e moderna com tipografia Inter
- 📱 **Totalmente Responsivo** - Experiência otimizada para todos os dispositivos

## 🚀 Demonstração

### Tela Principal

![Sistema de Feedback](https://i.postimg.cc/mkx5bgyT/Captura-de-tela-2025-09-18-132227.png)

### Sistema de Avaliação por Estrelas

![Rating System](https://i.postimg.cc/gjvBrbg8/Captura-de-tela-2025-09-18-132240.png)

## 🛠️ Tecnologias Utilizadas

### Backend

- **PHP 8.2+** - Linguagem principal
- **MySQL 8.0+** - Banco de dados
- **PDO** - Abstração de banco de dados
- **Arquitetura MVC** - Padrão de projeto

### Frontend

- **HTML5** - Estrutura semântica moderna
- **CSS3** - Design system profissional com custom properties
- **JavaScript ES6+** - Interatividade moderna e sistema de modais
- **Inter Font** - Tipografia profissional do Google Fonts
- **Design Responsivo** - Mobile-first com breakpoints otimizados

### Recursos Especiais

- **Autoload PSR-4** - Carregamento automático de classes
- **Singleton Pattern** - Gerenciamento eficiente de conexões
- **Template System** - Sistema de templates reutilizável
- **Prepared Statements** - Segurança avançada contra SQL Injection
- **Modal System** - Interface moderna com modais responsivos
- **Design System** - Paleta de cores consistente e componentes padronizados

## 📁 Estrutura do Projeto

```
Feedback/
├── 📁 assets/                  # Recursos estáticos
│   ├── 📁 css/
│   │   ├── style.css          # Estilos principais
│   │   └── pages.css          # Estilos específicos
│   └── 📁 js/
│       ├── app.js             # JavaScript principal
│       └── rating.js          # Sistema de estrelas
├── 📁 controller/             # Controladores MVC
│   ├── Feedback.php           # Controller de feedback
│   ├── Produto.php            # Controller de produtos
│   └── Usuario.php            # Controller de usuários
├── 📁 dao/                    # Camada de Acesso a Dados
│   ├── 📁 mysql/
│   │   ├── FeedbackDAO.php    # DAO de feedback
│   │   ├── ProdutoDAO.php     # DAO de produtos
│   │   └── UsuarioDAO.php     # DAO de usuários
│   ├── IFeedbackDAO.php       # Interface feedback
│   ├── IProdutoDAO.php        # Interface produtos
│   └── IUsuarioDAO.php        # Interface usuários
├── 📁 generic/                # Classes genéricas
│   ├── Acao.php               # Classe base para ações
│   ├── Autoload.php           # Sistema de autoload
│   ├── Controller.php         # Controller base
│   ├── MysqlFactory.php       # Factory de conexão
│   └── MysqlSingleton.php     # Singleton do MySQL
├── 📁 public/                 # Views/Páginas públicas
│   ├── 📁 feedback/
│   │   ├── form.php           # Formulário de feedback
│   │   └── listar.php         # Listagem de feedbacks
│   ├── 📁 produto/
│   │   ├── form.php           # Formulário de produtos
│   │   └── listar.php         # Listagem de produtos
│   ├── 📁 usuario/
│   │   ├── form.php           # Formulário de usuários
│   │   └── listar.php         # Listagem de usuários
│   └── home.php               # Página inicial
├── 📁 service/                # Regras de negócio
│   ├── FeedbackService.php    # Serviços de feedback
│   ├── ProdutoService.php     # Serviços de produtos
│   └── UsuarioService.php     # Serviços de usuários
├── 📁 template/               # Sistema de templates
│   ├── BaseTemplate.php       # Template base
│   └── ITemplate.php          # Interface de template
├── .htaccess                  # Configurações Apache
├── config.php                 # Configurações do sistema
├── database.sql               # Script de criação do banco
└── index.php                  # Arquivo principal
```

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais

#### 📦 produtos

```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- nome (VARCHAR(100), NOT NULL)
- descricao (TEXT, NOT NULL)
- preco (DECIMAL(10,2), NOT NULL)
```

#### 👤 usuarios

```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- nome (VARCHAR(100), NOT NULL)
- email (VARCHAR(100), UNIQUE, NOT NULL)
```

#### ⭐ feedback

```sql
- id (INT, AUTO_INCREMENT, PRIMARY KEY)
- usuario_id (INT, FOREIGN KEY)
- produto_id (INT, FOREIGN KEY)
- nota (INT, CHECK nota >= 1 AND nota <= 5)
- comentario (TEXT)
```

### Relacionamentos

- `feedback.usuario_id` → `usuarios.id` (CASCADE)
- `feedback.produto_id` → `produtos.id` (CASCADE)

## 🚀 Como Executar o Projeto

### Pré-requisitos

- **XAMPP** ou **LAMP** (Apache + MySQL + PHP 8.2+)
- **Navegador web** moderno
- **Git** (para clonar o repositório)

### Passo a Passo

1. **Clone o repositório**

   ```bash
   git clone https://github.com/TheuSoft/Feedback.git
   cd Feedback
   ```

2. **Configure o ambiente**

   ```bash
   # Mova o projeto para o diretório do servidor
   # Windows (XAMPP): C:\xampp\htdocs\Feedback
   # Linux (LAMP): /var/www/html/Feedback
   ```

3. **Configure o banco de dados**

   - Abra o **phpMyAdmin**: `http://localhost/phpmyadmin`
   - Crie um novo banco: `feedback_db`
   - Importe o arquivo: `database.sql`

4. **Configure as credenciais**
   Edite o arquivo `config.php`:

   ```php
   define('DB_HOST', '127.0.0.1');
   define('DB_NAME', 'feedback_db');
   define('DB_USER', 'root');        // Seu usuário MySQL
   define('DB_PASS', '');            // Sua senha MySQL
   ```

5. **Inicie o servidor**
   - Inicie o **Apache** e **MySQL** no XAMPP
   - Acesse: `http://localhost/Feedback`

## 🎯 Como Usar

### 1. Cadastrar Produtos

- Acesse: **Produtos** → **Novo Produto**
- Preencha: Nome, Descrição e Preço
- Clique em **Cadastrar**

### 2. Cadastrar Usuários

- Acesse: **Usuários** → **Novo Usuário**
- Preencha: Nome e E-mail
- Clique em **Cadastrar**

### 3. Enviar Feedback

- Acesse: **Feedback** → **Novo Feedback**
- Selecione: **Usuário** e **Produto**
- Avalie: Clique nas **estrelas** (1-5)
- Comente: Digite sua opinião
- Clique em **Cadastrar Feedback**

### 4. Visualizar Feedbacks

- Acesse: **Feedback** → **Lista**
- Veja todas as avaliações com estrelas e comentários

## 🔧 Configurações Avançadas

### Personalização de Notas

No arquivo `config.php`:

```php
define('MIN_RATING', 1);    // Nota mínima
define('MAX_RATING', 5);    // Nota máxima
```

### URL Base

```php
define('BASE_URL', 'http://localhost/Feedback/');
```

### Modo Debug

```php
define('ERROR_REPORTING', true);  // Exibir erros
```

## 📊 Funcionalidades Técnicas

### Arquitetura MVC

- **Model**: Classes DAO e Service para lógica de dados
- **View**: Templates PHP para apresentação
- **Controller**: Classes para controle de fluxo

### Segurança

- ✅ **Prepared Statements** - Prevenção de SQL Injection
- ✅ **Validação de dados** - Frontend e Backend
- ✅ **Sanitização** - Limpeza de inputs
- ✅ **Escape HTML** - Prevenção de XSS

### Performance

- ✅ **Singleton** - Conexão única com BD
- ✅ **Autoload** - Carregamento eficiente de classes
- ✅ **CSS/JS otimizado** - Recursos minificados

## 🎨 Características do Design

- 🌈 **Gradientes modernos** - Visual atrativo
- ⭐ **Sistema de estrelas interativo** - UX intuitiva
- 📱 **Responsivo** - Funciona em todos os dispositivos
- 🎯 **Navegação clara** - Menu intuitivo
- 💫 **Efeitos visuais** - Blur, sombras e transições

## 👨‍💻 Autor

**TheuSoft**

- GitHub: [@TheuSoft](https://github.com/TheuSoft)
- GitHub: [@4N4CL4RA](https://github.com/4N4CL4RA)

⭐ **Se este projeto te ajudou, deixe uma estrela no repositório!**

<div align="center">
  <a href="https://github.com/TheuSoft/Feedback/stargazers" target="_blank">
    <img src="https://img.shields.io/github/stars/TheuSoft/Feedback?style=social" alt="GitHub Star"/>
  </a>
  <br>
  <strong>Feito com ❤️ por TheuSoft e 4N4CL4RA</strong>
</div>
