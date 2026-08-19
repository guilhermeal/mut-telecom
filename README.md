# MUT Telecom

Site institucional da MUT Telecom — operadora regional de fibra óptica em Alagoas. Feito pra carregar rápido, funcionar sem enrolação e ser fácil de manter.

## Sobre

PHP puro, servidor a servidor, sem framework e sem build step. Cada página é um arquivo `.php` na raiz; o que se repete — cabeçalho, rodapé, dados de planos, FAQ, links de WhatsApp — vive em `includes/`. Estilo em `assets/css/style.css`, interações em `assets/js/main.js`, ambos sem dependências externas.

Tema claro/escuro, formulários com validação client-side, URLs limpas e SEO local já configurados.

## Rodando localmente

```bash
php -S localhost:8000
```

Sem `composer`, sem `npm`, sem passo de build. Abre e já tá no ar.

## Estrutura

```
├── index.php, planos.php, ...   → uma página, um arquivo
├── includes/
│   ├── header.php               → <head>, navbar, drawer mobile
│   ├── footer.php               → rodapé, WhatsApp float, cookie banner
│   └── data.php                 → planos, FAQ, cidades, helpers compartilhados
└── assets/
    ├── css/style.css
    ├── js/main.js
    └── favicon/
```

## Versionamento

Histórico de mudanças em [`CHANGELOG.md`](./CHANGELOG.md). Cada versão marcada com `git tag` corresponde a um ponto que foi publicado.

---

Desenvolvido por **Guilherme Almeida** — [guilhermeal.com.br](https://www.guilhermeal.com.br)
