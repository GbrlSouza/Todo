# 📝 To-Do (CRUD)

Um projeto simples de lista de tarefas (CRUD - Create, Read, Update, Delete) desenvolvido com uma combinação de tecnologias leves e modernas para Front-end e um Back-end em PHP com persistência de dados em arquivo XML.

## 🚀 Tecnologias Utilizadas

| Camada | Tecnologia | Função |
| :--- | :--- | :--- |
| **Front-end** (UI) | **DaisyUI** | Biblioteca de componentes (classes CSS) baseada em Tailwind CSS para uma interface moderna e responsiva. |
| **Estilo** | **Tailwind CSS** | Framework CSS utility-first para estilização rápida e flexível. |
| **Back-end** (Lógica) | **PHP (Puro)** | Responsável por processar requisições, manipular e salvar os dados. |
| **Banco de Dados** (Persistência) | **XML** | Um arquivo XML simples (`config/xml_data.xml`) atua como o banco de dados editável, manipulado pelas funções nativas do PHP (`SimpleXML`). |

## 📁 Estrutura do Projeto

O projeto segue uma estrutura de arquivos simples para facilidade de desenvolvimento:

```
todo/
├── index.php             \# Tela principal: Listagem de tarefas e formulário de adição.
├── processar.php         \# Roteador de ações: Lógica de Back-end (Criação, Edição, Deleção).
├── config/
│   └── xml\_data.xml     \# O arquivo XML de dados.
└── includes/
├── functions.php         \# Funções PHP para manipular o XML (CRUD).
└── head.php              \# Configuração do HTML e inclusão do DaisyUI/Tailwind CSS.
```

## 🛠️ Como Instalar e Rodar

Para rodar este projeto, você precisa de um ambiente que suporte PHP (como XAMPP, WAMP, MAMP ou um servidor web com PHP instalado).

### Pré-requisitos

* Servidor Web (Apache, Nginx, etc.)
* PHP 7.4 ou superior

### Passos para Instalação

1.  **Clone o repositório:**
    ```bash
    git clone https://github.com/GbrlSouza/Todo
    cd Todo
    ```

2.  **Configure o servidor:**
    Mova a pasta `todo` para o diretório de documentos do seu servidor web (ex: `htdocs` no XAMPP).

3.  **Garantir a permissão de escrita:**
    O PHP precisa de permissão de escrita no arquivo `config/xml_data.xml` para salvar as alterações (criação, edição e exclusão de tarefas).

4.  **Acesse no navegador:**
    Inicie seu servidor e acesse o projeto (normalmente em `http://localhost/todo`).

## ⚙️ Funcionalidades CRUD

O projeto oferece as seguintes operações:

| Operação | Tela / Ação | Back-end (PHP) |
| :--- | :--- | :--- |
| **Create** (Criar) | Formulário na `index.php` | Função `add_task()` em `processar.php` |
| **Read** (Ler) | Listagem na `index.php` | Função `get_all_tasks()` em `functions.php` |
| **Update** (Atualizar) | Botão "Concluir" na listagem | Função `toggle_task_status()` em `processar.php` |
| **Delete** (Deletar) | Botão "Excluir" na listagem | Função `delete_task()` em `processar.php` |

## 💡 Manipulação de XML

A persistência dos dados é feita através da manipulação do arquivo `config/xml_data.xml`. As funções em `includes/functions.php` utilizam a extensão **`SimpleXML`** do PHP para:

1.  Carregar o arquivo (`simplexml_load_file`).
2.  Navegar e modificar os nós.
3.  Salvar as alterações de volta no arquivo (`$xml->asXML('config/xml_data.xml')`).
