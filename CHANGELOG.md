# Changelog

Todas as mudanças notáveis deste site são registradas aqui.

Formato baseado em [Keep a Changelog](https://keepachangelog.com/pt-BR/1.1.0/) — cada versão marca um ponto que foi (ou vai ser) publicado no ar, não uma versão de pacote/API. Como convenção de incremento:

- **MAJOR** (`x.0.0`) — redesign ou reestruturação grande do site.
- **MINOR** (`0.x.0`) — conteúdo, seção ou funcionalidade nova visível no site.
- **PATCH** (`0.0.x`) — correção pontual: bug, texto, ajuste de estilo.

## Fluxo de versionamento

1. Ir commitando normalmente durante o desenvolvimento, mantendo os prefixos: `feat`, `fix`, `refactor`, `style`, `chore`, `docs`.
2. Quando um conjunto de mudanças estiver pronto pra ir ao ar, mover os itens de **`[Não lançado]`** aqui embaixo para uma nova seção `[X.Y.Z] — AAAA-MM-DD`.
3. Depois do deploy, marcar o commit: `git tag vX.Y.Z`.

## [Não lançado]

_(sem mudanças pendentes de versão no momento)_

## [1.0.0] — 2026-08-19

Primeira versão marcada do site — reúne tudo que foi feito desde a reescrita inicial em PHP até hoje, já que nenhuma versão havia sido marcada antes.

### Adicionado
- Site institucional MUT Telecom reescrito em PHP 8.3 puro (SSR, sem framework/build step).
- Crédito do desenvolvedor flutuante (canto inferior esquerdo, aparece ao rolar até o fim da página).
- SEO local completo: meta tags de geolocalização, canonical, Open Graph/Twitter Card e dados estruturados `LocalBusiness` (JSON-LD) em todas as páginas.
- URLs limpas sem extensão `.php` (`/planos` em vez de `/planos.php`), com `.htaccess` bloqueando acesso direto a `/includes` e `/assets`.
- Favicons completos (Apple touch icon, Android, Windows tile) e logomarca oficial aplicada em toda a navegação, rodapé e tela de login.

### Alterado
- Estilos inline migrados para classes CSS reutilizáveis em `assets/css/style.css`, eliminando duplicação entre páginas.
- Itens de navegação e botão de tema centralizados em funções compartilhadas (`includes/data.php`).
- Planos residenciais atualizados com os valores reais da empresa (com desconto pontualidade); planos empresariais temporariamente desativados até definição de valores.
- Melhorias de acessibilidade em todas as páginas.
- Sombras de elementos suavizadas.

### Corrigido
- Atributos `data-screen-label` removidos das páginas (limpeza de marcação não utilizada).
