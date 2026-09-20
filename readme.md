<p align="center">
  <img src="./assets/banner-hackathon.png" alt="1° Hackathon FATEC Itaquera" width="600">
</p>

# Professor Mensuring — Trilha PHP Iniciante

Projeto base da trilha **PHP Iniciante** do Pré-Hackathon da FATEC Itaquera. É uma versão simplificada do **Professor Mensuring**, uma aplicação para avaliar professores por matéria, construída com PHP puro, MySQL e HTML/CSS.

> ⚠️ **Este projeto foi entregue incompleto de propósito.** A ideia não é que ele funcione 100% pronto — é que você entenda o código existente e complete o que falta. Veja a seção [O que falta fazer](#o-que-falta-fazer-desafios) abaixo.

## 📺 Aulas

Todo o desenvolvimento deste projeto foi gravado e está disponível na playlist:

**[Assista à playlist completa aqui](https://www.youtube.com/playlist?list=PLC2N4JRAGB5E)**

| # | Aula | Duração |
|---|------|---------|
| 01 | O que é Banco de Dados e Modelagem Relacional \| PHP Iniciante · Pré-Hackathon | 12:54 |
| 02 | Criando o Banco de Dados na Prática com MySQL e… | 50:21 |
| 03 | Conectando o PHP ao Banco de Dados com PDO \| PHP Iniciante · Pré-Hackathon | 26:25 |
| 04 | Por que o PHP Precisa do Apache? \| PHP Iniciante · Pré-Hackathon | 11:05 |
| 05 | HTML: Teoria e Prática \| HTML Iniciante · Pré-Hackathon | 39:28 |
| 06 | CSS | — |
| 07 | Manipulando o Banco com PHP | — |

## 🚀 Como rodar o projeto

O Docker **não é obrigatório** — ele é só a forma mais rápida de subir o ambiente, porque evita ficar instalando PHP e MySQL na mão. Use a opção que preferir:

### Opção 1: Docker

Pré-requisito: ter o [Docker](https://docs.docker.com/get-started/) instalado.

```bash
git clone https://github.com/Pre-Hackton-Fatec-Itaquera/trilha-iniciante-php.git
cd trilha-iniciante-php
docker compose up -d
```

- Aplicação: [http://localhost:8000](http://localhost:8000)
- phpMyAdmin: [http://localhost:8080](http://localhost:8080) (usuário `root`, senha `root`)

O banco de dados já é criado e populado automaticamente na primeira vez que o container sobe, usando `database/schema.sql`.

### Opção 2: XAMPP (ou similar — WAMP, MAMP, Laragon)

Pré-requisito: ter o [XAMPP](https://www.apachefriends.org/pt_br/index.html) instalado (ou outro pacote com PHP + Apache + MySQL).

1. Clone ou copie a pasta do projeto para dentro de `htdocs` (no XAMPP, geralmente `C:\xampp\htdocs\` no Windows).
2. Abra o painel de controle do XAMPP e inicie os módulos **Apache** e **MySQL**.
3. Abra o phpMyAdmin (normalmente em [http://localhost/phpmyadmin](http://localhost/phpmyadmin)), crie um banco chamado `professor_mensuring` e importe o arquivo `database/schema.sql`.
4. Abra `config/config.php` e ajuste os dados de conexão para o do seu XAMPP — geralmente `$host = 'localhost'`, `$user = 'root'` e `$password = ''` (senha vazia é o padrão do XAMPP, diferente do `root`/`root` usado no Docker).
5. Acesse [http://localhost/trilha-iniciante-php](http://localhost/trilha-iniciante-php) (o caminho depende de como você nomeou a pasta dentro de `htdocs`).

## 📁 Estrutura do projeto

```
Hackathon/
├── assets/
│   └── style.css
├── config/
│   └── config.php        → conexão com o banco via PDO
├── database/
│   └── schema.sql         → criação das tabelas + dados de exemplo
├── includes/
│   ├── cabecalho.php
│   └── rodape.php
├── index.php               → listagem de professores + formulário de avaliação
├── docker-compose.yml
└── dockerfile
```

## 🧩 O que falta fazer (desafios)

O projeto cobre o básico: cadastro de professores e matérias no banco, conexão via PDO, listagem com a média de cada professor, e um formulário para criar novas avaliações. A partir daqui, o desafio é seu:

1. **Usar os campos `comentario` e `criadoEm`.**
   Esses dois campos já existem na tabela `avaliacoes` e já são preenchidos ao criar uma avaliação — mas hoje nada na tela exibe o comentário ou a data de quando a avaliação foi feita. Só a média aparece. Que tal mostrar a lista de avaliações de cada professor, com nota, comentário e data?

2. **Resolver a inconsistência entre professor e matéria.**
   Hoje a interface deixa o usuário escolher qualquer combinação de professor + matéria no formulário, mesmo que esse professor não lecione aquela matéria (o `<select>` de matérias sempre lista todas). O banco tem uma trava real para isso — repare na `FOREIGN KEY` composta de `avaliacoes` apontando para `professor_materia` — então uma combinação inválida hoje quebra com um erro feio na tela, em vez de uma mensagem amigável.
   Duas direções possíveis: (a) um `try/catch` em volta do `INSERT`, tratando a exceção do PDO e mostrando um erro claro; (b) uma nova query que traga só as matérias daquele professor, filtrando o `<select>` antes mesmo do envio (dá pra fazer isso com JavaScript, atualizando as opções quando o professor for selecionado, sem recarregar a página).

3. **Melhorar o layout.**
   O CSS atual é funcional, mas simples. Ideias: deixar responsivo para telas menores, mostrar a nota com estrelas em vez de só o número, tratar o estado de "nenhum professor cadastrado ainda".

Fique à vontade para ir além dessas três sugestões — qualquer melhoria é bem-vinda. Algumas outras ideias, se quiser mais desafio:

- Validação mais específica no formulário (hoje o erro é genérico — "Preencha corretamente os campos!" — sem dizer qual campo está errado).
- Uma forma de editar ou remover uma avaliação já criada.
- Paginação na listagem de professores, para quando a lista crescer.

## 📚 Tecnologias e conceitos para estudar

| Tecnologia | Documentação oficial | Conceitos-chave para revisar |
|---|---|---|
| PHP | [php.net/manual](https://www.php.net/manual/pt_BR/) | sintaxe básica, superglobais (`$_POST`, `$_SERVER`), funções, `foreach` |
| PDO | [php.net/manual/pdo](https://www.php.net/manual/pt_BR/book.pdo.php) | prepared statements, bind de parâmetros, fetch modes |
| MySQL | [dev.mysql.com/doc](https://dev.mysql.com/doc/) | modelagem relacional, chaves estrangeiras, `JOIN`, `GROUP BY` |
| HTML | [MDN: HTML](https://developer.mozilla.org/pt-BR/docs/Web/HTML) | estrutura semântica, formulários (`form`, `select`, `input`) |
| CSS | [MDN: CSS](https://developer.mozilla.org/pt-BR/docs/Web/CSS) | seletores, Flexbox, box model |

**Bônus:** [Docker](https://docs.docker.com/) — usado aqui só para evitar problemas de instalação no dia do hackathon (todo mundo sobe o mesmo ambiente com um único comando), não é o foco de aprendizado da trilha.

## 📂 Materiais complementares

[Acesse a pasta com materiais de apoio](https://drive.google.com/drive/folders/1ThKPtUmNaNbXKlB960bwD6JMNgE_qi-C)

## ✍️ Autor

**José Victor Xavier Silva**
[LinkedIn](https://www.linkedin.com/in/zevitor/)