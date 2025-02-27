# Test-Kabum - Portal Administrativo

## 📌 Sobre 
Este documento do **Test-Kabum** é um **Portal Administrativo** desenvolvido em **PHP e MySQL**, com um sistema seguro de **autenticação**, **gestão de clientes e endereços**, e **controle de permissões** para administradores.  

🔹 **Principais funcionalidades**:  
✅ Login e autenticação de usuários   
✅ Area administrativa para os guardiões (users)   
✅ CRUD completo de Clientes e Endereços    
✅ API ViaCEP integrada para busca automática de endereços    
✅ Permissões diferenciadas para **admins** e **usuários comuns**  
✅ Testes automatizados com PHPUnit  
✅ Responsivo  

---

## 🚀 Tecnologias Utilizadas
- **Back-end:** PHP (puro)  
- **Banco de Dados:** MySQL  
- **Front-end:** HTML, CSS e JavaScript  
- **Gerenciamento de dependências:** Composer  
- **Testes Automatizados:** PHPUnit  
- **API Externa:** ViaCEP  

---

## 📂 Estrutura do Projeto com arquitetura SOLID e Clean code

```  
test-kabum/
│
├── app/
│   ├── config/               # Configuração do sistema
│   ├── controllers/          # Lógica dos controladores (working)
│   ├── models/               # Modelos de dados (working)
│   ├── repositories/         # Repositórios do banco de dados (working)
│   ├── services/             # Regras de negócio e autenticação
│   └── views/                # Arquivos de visualização (working)
│
├── public/                   # Arquivos públicos acessíveis via navegador
│   ├── acessoNegado.php
│   ├── adicionarClientes.php
│   ├── adicionarEnderecos.php
│   ├── clientes.php
│   ├── dashboard.php
│   ├── editarClients.php
│   ├── editarEnderecos.php
│   ├── excluirClientes.php
│   ├── excluirEnderecos.php
│   ├── formsLogin.html
│   ├── gerenciarEnderecos.php
│   ├── login.php
│   ├── logout.php
│   └── assets/
│       ├── css/              # Estilos do sistema
│       ├── js/               # Scripts JS (formatarCampos.js, buscarCep.js)
│
├── tests/                    # Testes automatizados com PHPUnit e manuais
│   ├── AuthTest.php
│   ├── ClientesTests.php 
│   ├── create_users.php
│   ├── DatabaseTests.php 
│   ├── EnderecosTests.php 
│   ├── test_clients.php
│   ├── test_connection.php
│   ├── TestCase.php
│
│
├── .gitignore                # Arquivos ignorados pelo Git
├── composer.json             # Dependências PHP (phpdotenv, PHPUnit)
├── .env                      # Configuração do banco de dados
└── README.md                 # Documentação inicial do projeto
```

---

## 🔧 Configuração e Instalação

### **1️⃣ Clonar o Repositório**
```bash
git clone https://github.com/seu-usuario/test-kabum.git
cd test-kabum
```

### **2️⃣ Configurar Variáveis de Ambiente**
Renomeie o arquivo **`.env.example`** para **`.env`** e configure com os dados do banco de dados:
```env
DB_HOST=127.0.0.1
DB_NAME=test_kabum
DB_USER=root
DB_PASS=senha
```

### **3️⃣ Instalar Dependências**
```bash
composer install
```

### **4️⃣ Criar o Banco de Dados**
Execute o script SQL para criar as tabelas:
```bash
mysql -u root -p test_kabum < database.sql
```

### **5️⃣ Iniciar o Servidor**
```bash
php -S localhost:8000 -t public/
```
📌 **Agora, acesse:** `http://localhost:8000` no navegador

---

## 🛠 Testes Automatizados
No PHPUnit:
```bash
vendor/bin/phpunit tests 
```

📌 **Testes disponíveis:**
- **DatabaseTest:** Valida a conexão com o banco de dados
- **AuthTest:** Testa login e autenticação de usuários
- **ClientesTest:** Testa cadastro de clientes
- **EnderecosTest:** Testa cadastro de endereços

---

## 👮 Sistema de Permissões
🚀 **O sistema diferencia entre:**  
- **👑 Admin:** Pode **cadastrar, editar, excluir clientes e usuários**.  
- **👤 Usuário Comum:** Pode **visualizar, mas não excluir registros**.  

---

## 📌 Funcionalidades Implementadas
✅ **Login seguro com hash de senha (`password_hash`)**  
✅ **CRUD completo de Usuários, Clientes e Endereços**  
✅ **API ViaCEP para buscar endereço pelo CEP**  
✅ **Sistema de Permissões para Admins e Usuários Comuns**  
✅ **Testes Automatizados para garantir funcionamento**  

---

## 🌐 Deploy e Hospedagem
Estou hospedando esse projeto temporariamente no **Railway**.  


---

## 📢 Contato e Contribuição
📌 **Autor:** Lucas Barcelos  
📌 **GitHub:** [https://github.com/barcelos-lucas](https://github.com/barcelos-lucas)  
📌 **Contribuições:** Pull Requests são bem-vindos! s2

---

## 🎯 Conclusão
Este **Portal Administrativo** será um projeto com continuidade e foi construído com foco em **segurança, escalabilidade e boas práticas** . Se precisar de suporte ou melhorias, fique à vontade para abrir **issues** no repositório do GitHub. s2  
