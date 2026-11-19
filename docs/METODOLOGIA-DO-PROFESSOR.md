# Metodologia do professor aplicada ao Painel ENADE (Grupo 02)

Fontes: slides e pacotes das Aulas 1–16 na pasta da matéria e a especificação `Projeto_Final_Desenvolvimento_para_Web_2026_2.pdf`. Abaixo, "spec p.N" é a página da especificação e "A12 s25" é a Aula 12, slide 25.

**Regra que manda em tudo (spec p.1):** só se cobra o conteúdo até a Aula 12 (20/10). As Aulas 13–16 "não alteram os requisitos" (spec p.4). Fora do escopo (spec p.5): API REST, testes automatizados, segurança posterior à Aula 12 e arquiteturas não vistas. Ou seja, CSRF, upload `.bin` privado, cabeçalhos HTTP e Vitest **não dão nota**. Ajudam, no máximo, como boa prática.

Pesos (spec p.5): Painel 25 · CRUD + upload 25 · Execução/autenticação 15 · Interface 15 · PHP/SQL/persistência 15 · Documentação/apresentação/equipe 5.

## 1. Aula → padrão do professor → onde entra

| Aula | O que ele ensinou e como faz | Onde entra no Painel | Parte | Issue |
|---|---|---|---|---|
| 2 HTML/formulários | GET para consulta, POST para dados (A2 s12–13); `label for` = `id`, `name` = dado enviado (A2 s18) | filtros por GET; login e ações por POST | B, C | P06, P08 |
| 3 CSS | CSS externo em arquivo próprio (A3 s9); box model e flexbox (A3 s13–26) | `app/assets/css/estilo.css` | D | P05 |
| 4/5 JavaScript | JS em arquivo externo (A4 s5); depurar pelo Console (A4 s6); funções (A5 s17); if/for...of/arrays (A5 s3–13) | `app/assets/js/app.js`: confirmação e validação | D | P10 |
| 6 Bootstrap | CSS antes do seu CSS, `bundle.js` no fim do body (A6 s4); `container > row > col-*` (s8); `col-12 col-md-6` (s10); `.table .table-responsive` + `th scope` (s18); `form-label`/`mb-3` (s20); "Bootstrap mostra, JS decide": `checkValidity()` + `is-invalid` (s21); cards (s22); navbar com toggler (s23); modal de confirmação (s25); alert/badge/toast (s26) | layout, cards do painel, tabela de histórico, selo de origem, formulários | D, B | P05, P06, P07, P10 |
| 8 PHP + MySQLi | `publicar/` + `includes/` + `banco/` fora da web (A8 s7, s26); `conexao.php` com `mysqli_report` + `set_charset('utf8mb4')` (s22); `prepare` → `bind_param` → `get_result()->fetch_all` (s23); `foreach` gera card (s10); JOIN (s27) | conexão (feita), consultas do painel | A, B | P03, P06 |
| 12 CRUD + login + upload | Arquivos: `formulario.php` (novo e `?id=`), `salvar.php` (INSERT/UPDATE), `excluir.php` (POST) (A12 s5, s16). Validação no servidor com `$erros[]` (s11); POST → Redirect → GET (s12); `filter_input` no id + 404 (s13); `WHERE id = ?` (s14); excluir por POST com `confirm()` no cliente (s15). Login com `password_hash`/`password_verify` + `session_regenerate_id` + mensagem genérica (s18–20). Guarda em `includes/autenticacao.php` no topo de cada página (s21); logout = `session_start/unset/destroy` + redirect (s22). Upload: `multipart` + `accept` (s23), ordem erro → tamanho → extensão → novo nome → mover (s24), `bin2hex(random_bytes(8)) . '.' . $ext` em `uploads/`, sem gravar o caminho se mover falhar (s25). No pacote, `excluir.php` apaga o arquivo físico (`unlink`) e `app.js` faz a confirmação com `data-confirm`. | login (feito), CRUD de ações, anexo | A, C | P04, P08, P09 |
| 13 Segurança (não cobrada) | prepared contra injeção (A13 s11); `htmlspecialchars` na saída (s14); `session_regenerate_id` (s19–20); CSRF (s17), `.bin` privado (s23–24) e cabeçalhos (s27) | usar só o que já é da Aula 12: prepared + `htmlspecialchars` + regenerate. **Não** fazer CSRF nem `.bin` | todos | — |
| 16 Testes/depuração | "funcionou uma vez" não é critério (A16 s6); menor teste que prova o risco (s9); arrumar, agir, conferir (s12); matriz ação × entrada × esperado (s21); depurar em 5 passos: reproduzir, isolar, hipótese, provar, corrigir (s27); DevTools Network (s28) e Console (s29) | testes cruzados manuais com tabela de casos | todos | P11 |
| 7, 14, 15 React/API | opcionais ou fora do escopo (spec p.4–5) | não usar | — | — |

## 2. O que o professor cobra e o plano não tem (ou tem diferente)

| Cobrança | Fonte | Situação no plano | Critério afetado |
|---|---|---|---|
| Painel **mostra as ações da oferta** e dá acesso ao CRUD | spec p.3, tabela 6 "Ações" | plano põe as ações só no CRUD | Painel (25) |
| Com só 1 edição: mostrar o registro e avisar "série histórica limitada" | spec p.3 "Histórico" | não aparece | Painel (25) |
| Ponto forte e ponto de atenção são **interpretações do grupo** | spec p.6 | a base usa o texto "sugerido" do CSV | Painel (25) |
| **Duas observações** sobre os indicadores | spec p.1 §3 e rubrica | o plano tem as duas, mas só para a fala (seção 9) | Painel (25) + Apresentação (5) |
| README com 6 itens: tecnologias, instalação, configuração do banco, usuário demo, execução e **limitações**, mais a regra de exclusão do anexo | spec p.4 e p.7 | o README do repositório não tem "Limitações" nem a regra do anexo | Execução (15) + Documentação (5) |
| Upload "segue o exemplo dado em aula" (Aula 12, não 13) | spec p.4 e p.7 | o plano está certo; atenção para não copiar o `.bin` da Aula 13 | CRUD/upload (25) |
| Demonstrar **validação e largura reduzida** | spec p.5 §12 | parte D tem; incluir no roteiro P14 | Interface (15) |
| Não precisa: CSRF, MIME avançado, testes automatizados, React | spec p.1, p.5, p.7 | plano já exclui | economiza tempo |

## 3. Meio-termo: estilo do Murilo × padrão do professor

Regra: usar **os nomes de pasta e arquivo que os slides mostram**, porque é o que o professor reconhece na correção. Não criar `repositorio_*.php`, `bootstrap.php`, `funcoes.php` gigante nem classes: a spec p.4 diz que camadas não são obrigatórias e nenhum slide exige isso. Dentro de cada arquivo, vale o estilo do guia: cabeçalho, comentários-título, prepared e `htmlspecialchars` direto.

- **A (Murilo):** seguir A12 s5/s21. Mover a conexão para `app/includes/conexao.php`. Criar `app/includes/autenticacao.php` com o guarda de 5 linhas do s21, porque várias páginas da parte C vão precisar dele e assim não fica copiado 5 vezes. Deixar o `logout.php` igual ao s22. A configuração pode continuar no topo do `conexao.php` (A8 s22 separa em `config.php`; separar é opcional).
- **B (Leo Quadros):** consultas preparadas no topo do `painel.php`, como já está (A8 s23), sem `repositorio_painel.php`. Cards (A6 s22), `progress` para FG e CE, histórico em `.table-responsive` (A6 s18), badge de origem (A6 s26). Se a mesma consulta servir em dois lugares, uma função no próprio arquivo.
- **C (Leonardo de Bortoli):** copiar os nomes do CRUD da Aula 12 em `app/acoes/`: `formulario.php`, `salvar.php`, `excluir.php` e `visualizar.php` (a spec pede "visualizar"). O SQL fica dentro de cada arquivo, sem `repositorio_acoes.php`. Constantes no topo do `salvar.php`: `TAMANHO_MAXIMO_ANEXO = 2 * 1024 * 1024` e `EXTENSOES_PERMITIDAS = ['pdf', 'png', 'jpg', 'jpeg']`. Situações em lista igual ao CHECK do banco.
- **D (Guilherme Reis):** `app/includes/cabecalho.php` e `rodape.php`, como na A12 s5, porque a mesma navbar vai estar em 4 ou mais páginas. Também `assets/css/estilo.css` (A3 s9) e `assets/js/app.js` (A4 s5) com só duas coisas: o `data-confirm` do `app.js` da Aula 12 e o `checkValidity()` com `is-invalid` (A6 s21).

## 4. Checklist antes de abrir o PR

**A — Murilo Alves**
- [ ] Guarda `includes/autenticacao.php` incluído no topo de todas as páginas internas (A12 s21).
- [ ] Login com `password_verify` + `session_regenerate_id(true)` + mensagem genérica (A12 s19–20).
- [ ] Logout destrói a sessão e volta ao login (A12 s22).
- [ ] `estrutura.sql` e `dados_iniciais.sql` importam do zero; 3 ofertas, 33 resultados e 1 usuário (A8 s16–17, A12 s26).
- [ ] Sem senha real; banco fora de `app/` (A8 s26).

**B — Leo Quadros**
- [ ] Filtros por GET (A2 s12); oferta e ano inválidos não quebram a página.
- [ ] Toda consulta com `prepare` + `bind_param` (A8 s23); saída com `htmlspecialchars` (A13 s14).
- [ ] Cards com nota contínua, faixa e participação (spec p.3); FG e CE em barras de 0 a 100.
- [ ] Histórico com todas as edições em `.table-responsive` e selo de origem por linha (A6 s18, s26).
- [ ] "Sem dados para esta oferta/edição" e "série histórica limitada" (spec p.3).
- [ ] Ações da oferta listadas no painel com link para o CRUD (spec p.3).
- [ ] Ponto forte e ponto de atenção revisados pelo grupo; duas observações visíveis (spec p.6, rubrica).

**C — Leonardo de Bortoli**
- [ ] Mapa do CRUD igual ao A12 s16 (GET formulário, POST salvar e excluir).
- [ ] Validação no servidor com `$erros[]` e mensagem que explica (A12 s11).
- [ ] POST → Redirect → GET (A12 s12); id com `filter_input` e 404 (A12 s13); `WHERE id = ?` (A12 s14).
- [ ] Excluir só por POST com `confirm()` (A12 s15).
- [ ] Upload na ordem do A12 s24: erro, ≤ 2 MB, extensão, nome novo, `move_uploaded_file`. Sem gravar no banco se mover falhar (A12 s25).
- [ ] Editar: manter, substituir e remover o anexo. Excluir a ação apaga o arquivo, como o `excluir.php` da Aula 12, e isso vai escrito no README (spec p.7).
- [ ] Uma ação de demonstração com anexo nos dados (spec p.7).

**D — Guilherme Reis**
- [ ] Bootstrap antes do CSS próprio; `bundle.js` no fim, se usar navbar com toggler ou modal (A6 s4, s23, s25).
- [ ] Grid `col-12 col-md-*` testado em 375 px (A6 s10; spec p.5).
- [ ] Formulários com `form-label`/`mb-3` e `is-invalid` (A6 s20–21).
- [ ] `app.js` externo com confirmação de exclusão (A4 s5; `app.js` da Aula 12).
- [ ] Mensagens de sucesso e erro em `alert` (A6 s26; spec p.4).
- [ ] ZIP testado numa pasta nova seguindo só o README (spec p.4).

**Todos (P11):** tabela de casos com ação, entrada, esperado, obtido e quem corrige (A16 s21). Erro achado → reproduzir, isolar, hipótese, provar e corrigir (A16 s27). Formulário e upload conferidos no DevTools Network (A16 s28); erros de JS no Console (A16 s29).

## 5. Mudanças sugeridas nas issues (acrescentar ao critério de aceite)

- **P01:** "Registrar também se ponto forte/atenção podem vir do CSV ou devem ser escritos pelo grupo (spec p.6)."
- **P02:** "Estrutura de pastas da Aula 12 (A12 s5): `app/includes/`, `app/acoes/`, `app/assets/css`, `app/assets/js`, `app/uploads/`."
- **P03:** "Revisor importa do zero e confere 3 ofertas, 33 resultados e 1 usuário, e que um INSERT com participantes > inscritos é recusado."
- **P04:** "Guarda em `app/includes/autenticacao.php` (A12 s21) e logout como A12 s22."
- **P05:** "Bootstrap (A6 s4), grid `col-12 col-md-*` (A6 s10), `cabecalho.php`/`rodape.php` em `app/includes/` (A12 s5), CSS em `assets/css/estilo.css` (A3 s9); testado em 375 px."
- **P06:** "Cards (A6 s22), histórico `.table-responsive` (A6 s18), aviso de série limitada com 1 edição (spec p.3), lista de ações da oferta com link para o CRUD (spec p.3); consultas preparadas (A8 s23)."
- **P07:** "Barras de 0 a 100 para FG e CE; selo de origem em cada linha; ponto forte/atenção revisados pelo grupo; duas observações visíveis no painel (spec p.1, p.6)."
- **P08:** "Arquivos `acoes/formulario.php`, `salvar.php`, `excluir.php` e `visualizar.php` (A12 s16); validação `$erros[]` (s11); PRG (s12); `filter_input` + 404 (s13); excluir por POST com confirmação (s15)."
- **P09:** "Ordem de upload do A12 s24–25, 2 MB, PDF/PNG/JPG/JPEG, nome `bin2hex(random_bytes(8)).ext` em `app/uploads/`; manter/substituir/remover; regra de exclusão no README; 1 ação demo com anexo (spec p.7). Sem `.bin` da Aula 13."
- **P10:** "`assets/js/app.js` com `data-confirm` (`app.js` da Aula 12) e `checkValidity()` + `is-invalid` (A6 s21); mensagens em `alert` (A6 s26)."
- **P11:** "Tabela de casos no formato da A16 s21, depuração em 5 passos (A16 s27), DevTools Network/Console (A16 s28–29). Testes manuais bastam (spec p.5)."
- **P12:** "README com as 6 seções da spec p.4 (incluindo Limitações) + regra de exclusão do anexo (spec p.7) + decisões 2 MB/33 linhas."
- **P13:** "ZIP `DW_Grupo02_PainelENADE.zip` só com README.md, app/, banco/ e docs/contribuicoes.pdf (spec p.4); sem uploads de teste nem senha real."
- **P14:** "Roteiro da spec p.5 §12: login, filtros, indicadores, histórico, desempenho, duas observações, CRUD, envio e consulta de anexo, validação e largura reduzida, em até 8 min, com os 4."

**A base (parte A) precisa mudar?** Sim, só 3 ajustes pequenos para ficar no padrão da Aula 12:
1. `app/conexao.php` → `app/includes/conexao.php`.
2. Novo `app/includes/autenticacao.php` (guarda do A12 s21), usado no `painel.php` no lugar do `if` direto.
3. `logout.php` com as 4 linhas do A12 s22, mais uma seção "Limitações" e a regra do anexo no README.

O resto da base (prepared, `password_hash`, regenerate, `htmlspecialchars`, `banco/estrutura.sql` + `dados_iniciais.sql`) já segue as Aulas 8 e 12. Não precisa de CSRF nem `.bin` (spec p.1).
