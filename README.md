# Painel ENADE - Grupo 02 (recorte R01)

Projeto Final de Desenvolvimento para Web 2026/2. Ofertas do recorte: Administração presencial (O01), Administração EaD (O02) e Tecnologia em Gestão Comercial EaD (O32). O plano do grupo está em `docs/Plano_Grupo_02_Painel_ENADE.pdf`.

O que o professor ensinou em cada aula e como aplicar em cada parte (com checklist para o PR): [docs/METODOLOGIA-DO-PROFESSOR.md](docs/METODOLOGIA-DO-PROFESSOR.md).

## Como rodar

1. No phpMyAdmin, crie o banco `painel_enade` (agrupamento `utf8mb4_unicode_ci`). Com ele selecionado, importe `banco/estrutura.sql` e depois `banco/dados_iniciais.sql`.
2. Se o seu MySQL não for o padrão do XAMPP (usuário `root` sem senha), troque os dados no topo de `app/conexao.php`. Não suba senha real para o repositório.
3. XAMPP: copie a pasta para `htdocs/` e abra `http://localhost/<pasta>/app/`. Ou, na pasta do projeto: `php -S localhost:8000 -t app` e abra `http://localhost:8000/`.

Usuário de demonstração: login `demo`, senha `enade2026`.

Tecnologias: PHP 8 com MySQLi, MySQL/MariaDB, HTML e Bootstrap 5.3 (o CSS está copiado em `app/assets/vendor/bootstrap/` para funcionar sem internet).

## Divisão

| Parte | Quem | Revisa |
|---|---|---|
| A - Base e autenticação | Murilo Alves | Leo Quadros (B) |
| B - Painel e indicadores | Leo Quadros | Guilherme Reis (D) |
| C - Ações e anexos | Leonardo de Bortoli | Murilo Alves (A) |
| D - Interface e integração | Guilherme Reis | Murilo Alves (A) |

Leonardo de Bortoli pediu "o 3". Estamos supondo que é a parte C; se não for, avise que a gente troca.
Murilo não consegue trabalhar no projeto em 28/11 (prova de SO).

As tarefas P01 a P14 do plano estão nas issues, com dono, revisor, critério de aceite e prazo. O label de cada parte (A-base, B-painel, C-acoes, D-interface) mostra de quem é a tarefa, e o label de status (A fazer, Fazendo, Revisão, Pronto) funciona como quadro.

## Regras do grupo

Cada um trabalha na sua branch (por exemplo `b-painel`) e abre um Pull Request para a `main`. O PR só entra depois de 1 revisão de outro integrante. Ninguém faz push direto na `main`.

## Já feito (parte A)

Banco com as 4 tabelas e as regras mínimas, os 33 resultados do CSV R01 (5 oficiais e 28 simulados), usuário de demonstração, login, logout, bloqueio do painel sem login e o painel inicial com o filtro de oferta e de edição.

Prazo final: apresentação e entrega em 01/12.
