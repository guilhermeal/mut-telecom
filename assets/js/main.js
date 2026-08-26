/**
 * MUT Telecom — interações client-side.
 * O conteúdo é sempre renderizado no servidor (PHP); este arquivo cuida
 * apenas de comportamento visual que precisa acontecer sem recarregar a página
 * (tema, menu mobile, acordeões, formulários mockados etc).
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    initTheme();
    initHeaderShadow();
    initDrawer();
    initQuickLinksDropdown();
    initCookieBanner();
    initDevCreditFloat();
    initFaqAccordions();
    initPlanToggle();
    initCoverageForm();
    initContactForm();
    initBoletoForm();
    initLoginForm();
    initViabilidadeForm();
  });

  /* ---------------- Tema claro/escuro ---------------- */
  function initTheme() {
    var buttons = document.querySelectorAll('#mut-theme-toggle, #mut-theme-toggle-mobile');
    if (!buttons.length) return;

    var syncButtons = function () {
      var isDark = document.body.classList.contains('dark');
      buttons.forEach(function (btn) {
        btn.setAttribute('aria-pressed', String(isDark));
        btn.setAttribute('aria-label', isDark ? 'Ativar tema claro' : 'Ativar tema escuro');
      });
    };

    syncButtons();
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var isDark = document.body.classList.toggle('dark');
        try { localStorage.setItem('mut-theme', isDark ? 'dark' : 'light'); } catch (e) {}
        syncButtons();
      });
    });
  }

  /* ---------------- Sombra da navbar ao rolar ---------------- */
  function initHeaderShadow() {
    var header = document.getElementById('mut-header');
    if (!header) return;
    var update = function () {
      header.classList.toggle('nav-scrolled', window.scrollY > 12);
    };
    window.addEventListener('scroll', update, { passive: true });
    update();
  }

  /* ---------------- Menu mobile (drawer) ---------------- */
  function initDrawer() {
    var drawer = document.getElementById('mut-drawer');
    var openBtn = document.getElementById('mut-drawer-open');
    var closeBtn = document.getElementById('mut-drawer-close');
    if (!drawer || !openBtn) return;

    var open = function () {
      drawer.classList.remove('hidden');
      openBtn.setAttribute('aria-expanded', 'true');
      // move o foco para dentro do diálogo, como esperado em menus modais
      if (closeBtn) closeBtn.focus();
      document.addEventListener('keydown', onKeydown);
    };
    var close = function () {
      drawer.classList.add('hidden');
      openBtn.setAttribute('aria-expanded', 'false');
      openBtn.focus();
      document.removeEventListener('keydown', onKeydown);
    };
    var onKeydown = function (e) {
      if (e.key === 'Escape') close();
    };

    openBtn.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    drawer.addEventListener('click', function (e) {
      if (e.target === drawer) close();
    });
  }

  /* ---------------- Menu suspenso "Acesso Rápido" (navbar desktop) ---------------- */
  function initQuickLinksDropdown() {
    var wrap = document.getElementById('mut-quick-links-dropdown');
    var btn = document.getElementById('mut-quick-links-btn');
    var menu = document.getElementById('mut-quick-links-menu');
    if (!wrap || !btn || !menu) return;

    var open = function () {
      menu.classList.remove('hidden');
      btn.setAttribute('aria-expanded', 'true');
      wrap.setAttribute('data-open', 'true');
      document.addEventListener('click', onClickOutside);
      document.addEventListener('keydown', onKeydown);
    };
    var close = function () {
      menu.classList.add('hidden');
      btn.setAttribute('aria-expanded', 'false');
      wrap.removeAttribute('data-open');
      document.removeEventListener('click', onClickOutside);
      document.removeEventListener('keydown', onKeydown);
    };
    var onClickOutside = function (e) {
      if (!wrap.contains(e.target)) close();
    };
    var onKeydown = function (e) {
      if (e.key === 'Escape') { close(); btn.focus(); }
    };

    btn.addEventListener('click', function (e) {
      e.stopPropagation();
      if (menu.classList.contains('hidden')) open(); else close();
    });
  }

  /* ---------------- Crédito do desenvolvedor (flutuante, some até o fim da página) ---------------- */
  function initDevCreditFloat() {
    var badge = document.getElementById('mut-dev-credit');
    if (!badge) return;

    var THRESHOLD = 250; // px de distância do rodapé a partir da qual o botão aparece

    var update = function () {
      var doc = document.documentElement;
      var scrollBottom = window.scrollY + window.innerHeight;
      var nearBottom = scrollBottom >= (doc.scrollHeight - THRESHOLD);
      badge.classList.toggle('is-visible', nearBottom);
    };

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
  }

  /* ---------------- Banner de cookies ---------------- */
  function initCookieBanner() {
    var banner = document.getElementById('mut-cookie-banner');
    var accept = document.getElementById('mut-cookie-accept');
    if (!banner) return;

    var accepted = false;
    try { accepted = !!localStorage.getItem('mut-cookie-ok'); } catch (e) {}
    if (!accepted) banner.classList.remove('hidden');

    if (accept) {
      accept.addEventListener('click', function () {
        try { localStorage.setItem('mut-cookie-ok', '1'); } catch (e) {}
        banner.classList.add('hidden');
      });
    }
  }

  /* ---------------- Acordeão de FAQ ---------------- */
  function initFaqAccordions() {
    document.querySelectorAll('.mut-faq-list').forEach(function (list) {
      var items = list.querySelectorAll('.mut-faq-item');
      items.forEach(function (item) {
        var btn = item.querySelector('.mut-faq-toggle');
        if (!btn) return;
        btn.addEventListener('click', function () {
          var willOpen = !item.classList.contains('is-open');
          items.forEach(function (i) {
            i.classList.remove('is-open');
            var b = i.querySelector('.mut-faq-toggle');
            if (b) b.setAttribute('aria-expanded', 'false');
          });
          if (willOpen) {
            item.classList.add('is-open');
            btn.setAttribute('aria-expanded', 'true');
          }
        });
      });
    });
  }

  /* ---------------- Toggle Residencial / Empresarial ---------------- */
  function initPlanToggle() {
    var pills = document.querySelectorAll('.mut-plan-pill');
    if (!pills.length) return;
    var groups = document.querySelectorAll('.mut-plan-group');

    pills.forEach(function (pill) {
      pill.addEventListener('click', function () {
        var type = pill.getAttribute('data-plan-type');
        pills.forEach(function (p) {
          var active = p === pill;
          p.classList.toggle('is-active', active);
          p.setAttribute('aria-selected', String(active));
          p.setAttribute('tabindex', active ? '0' : '-1');
        });
        groups.forEach(function (g) {
          g.classList.toggle('is-visible', g.getAttribute('data-plan-group') === type);
        });
      });
    });
  }

  /* ---------------- Verificador de cobertura ---------------- */
  function initCoverageForm() {
    var form = document.getElementById('mut-coverage-form');
    if (!form) return;
    var input = document.getElementById('mut-coverage-input');
    var button = document.getElementById('mut-coverage-submit');
    var spinner = document.getElementById('mut-coverage-spinner');
    var resultYes = document.getElementById('mut-coverage-yes');
    var resultNo = document.getElementById('mut-coverage-no');
    var cities = ['murici', 'messias', 'rio largo', 'branquinha'];

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var value = (input.value || '').trim();
      if (!value) return;

      resultYes.classList.add('hidden');
      resultNo.classList.add('hidden');
      spinner.classList.remove('hidden');
      button.disabled = true;
      button.setAttribute('aria-busy', 'true');

      setTimeout(function () {
        var low = value.toLowerCase();
        var cep = value.replace(/\D/g, '');
        var ok = cities.some(function (c) { return low.indexOf(c) !== -1; }) || /^57\d{3}/.test(cep);
        spinner.classList.add('hidden');
        button.disabled = false;
        button.setAttribute('aria-busy', 'false');
        (ok ? resultYes : resultNo).classList.remove('hidden');
      }, 850);
    });
  }

  /* ---------------- Formulário de contato ---------------- */
  function initContactForm() {
    var form = document.getElementById('mut-contact-form');
    if (!form) return;
    var successBlock = document.getElementById('mut-contact-success');
    var formError = document.getElementById('mut-contact-form-error');
    var spinner = document.getElementById('mut-contact-spinner');
    var submitBtn = form.querySelector('button[type="submit"]');

    var fields = {
      nome: form.querySelector('[name="nome"]'),
      tel: form.querySelector('[name="tel"]'),
      cidade: form.querySelector('[name="cidade"]'),
      mensagem: form.querySelector('[name="mensagem"]'),
    };

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var errors = {};
      if (!fields.nome.value.trim()) errors.nome = 'Informe seu nome.';
      if ((fields.tel.value || '').replace(/\D/g, '').length < 10) errors.tel = 'Telefone/WhatsApp inválido.';
      if (!fields.cidade.value) errors.cidade = 'Selecione sua cidade.';
      if (fields.mensagem.value.trim().length < 5) errors.mensagem = 'Escreva uma mensagem.';

      var firstInvalid = null;
      Object.keys(fields).forEach(function (key) {
        var errEl = document.getElementById('mut-err-' + key);
        if (errEl) {
          errEl.textContent = errors[key] || '';
          errEl.classList.toggle('hidden', !errors[key]);
        }
        if (fields[key]) {
          fields[key].setAttribute('aria-invalid', String(!!errors[key]));
          if (errors[key] && !firstInvalid) firstInvalid = fields[key];
        }
      });

      if (Object.keys(errors).length) {
        if (firstInvalid) firstInvalid.focus();
        return;
      }

      if (formError) { formError.classList.add('hidden'); formError.textContent = ''; }
      if (spinner) spinner.classList.remove('hidden');
      if (submitBtn) submitBtn.disabled = true;

      var payload = new FormData(form);

      fetch('/api/contato.php', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: payload,
      })
        .then(function (res) { return res.json().then(function (json) { return { status: res.status, json: json }; }); })
        .then(function (result) {
          if (result.status === 200 && result.json && result.json.ok) {
            form.classList.add('hidden');
            if (successBlock) successBlock.classList.remove('hidden');
            return;
          }
          var message = (result.json && result.json.message) || 'Não foi possível enviar sua mensagem agora. Tente novamente em instantes ou fale pelo WhatsApp.';
          if (formError) { formError.textContent = message; formError.classList.remove('hidden'); }
        })
        .catch(function () {
          if (formError) {
            formError.textContent = 'Falha de conexão. Verifique sua internet e tente novamente, ou fale pelo WhatsApp.';
            formError.classList.remove('hidden');
          }
        })
        .finally(function () {
          if (spinner) spinner.classList.add('hidden');
          if (submitBtn) submitBtn.disabled = false;
        });
    });
  }

  /* ---------------- 2ª via de boleto (fluxo público, sem login) ---------------- */
  function initBoletoForm() {
    var form = document.getElementById('mut-boleto-form');
    if (!form) return;
    var input = document.getElementById('mut-boleto-input');
    var errorEl = document.getElementById('mut-boleto-error');
    var spinner = document.getElementById('mut-boleto-spinner');
    var resultBlock = document.getElementById('mut-boleto-result');
    var rowsEl = document.getElementById('mut-boleto-rows');
    var emptyBlock = document.getElementById('mut-boleto-empty');
    var submitBtn = form.querySelector('button[type="submit"]');

    aplicarMascaraCpfCnpj(input);

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var limpo = sanitizarCpfCnpj(input.value);
      errorEl.classList.add('hidden');
      errorEl.textContent = '';
      input.removeAttribute('aria-invalid');
      if (resultBlock) resultBlock.classList.add('hidden');
      if (emptyBlock) emptyBlock.classList.add('hidden');

      // O backend, por enquanto, só aceita CPF/CNPJ puramente numérico —
      // CNPJ alfanumérico é aceito na máscara (para não travar quando o
      // backend for atualizado), mas ainda barrado aqui antes do envio.
      var somenteDigitos = /^[0-9]+$/.test(limpo);

      if (!somenteDigitos || (limpo.length !== 11 && limpo.length !== 14)) {
        errorEl.textContent = somenteDigitos
          ? 'Digite um CPF (11 dígitos) ou CNPJ (14 dígitos) válido.'
          : 'CNPJ alfanumérico ainda não é aceito nesta consulta — digite um CPF ou CNPJ numérico.';
        errorEl.classList.remove('hidden');
        input.setAttribute('aria-invalid', 'true');
        input.focus();
        return;
      }

      spinner.classList.remove('hidden');
      if (submitBtn) submitBtn.disabled = true;

      fetch('/hub-api/api/boletos/consultar', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({ cpf_cnpj: limpo }),
      })
        .then(function (res) { return res.json().then(function (json) { return { status: res.status, json: json }; }); })
        .then(function (result) {
          if (result.status !== 200 || !result.json || !result.json.ok) {
            var msg = (result.json && result.json.message) || 'Não foi possível consultar seus boletos agora. Tente novamente em instantes.';
            errorEl.textContent = msg;
            errorEl.classList.remove('hidden');
            return;
          }

          var boletos = result.json.boletos || [];

          if (!boletos.length) {
            if (emptyBlock) {
              emptyBlock.textContent = result.json.message || 'Nenhuma fatura em aberto — você está em dia!';
              emptyBlock.classList.remove('hidden');
            }
            return;
          }

          renderBoletosPublicos(boletos);
          if (resultBlock) resultBlock.classList.remove('hidden');
        })
        .catch(function () {
          errorEl.textContent = 'Falha de conexão. Verifique sua internet e tente novamente.';
          errorEl.classList.remove('hidden');
        })
        .finally(function () {
          spinner.classList.add('hidden');
          if (submitBtn) submitBtn.disabled = false;
        });
    });

    function renderBoletosPublicos(boletos) {
      if (!rowsEl) return;
      rowsEl.innerHTML = '';

      boletos.forEach(function (b) {
        var row = document.createElement('div');
        row.className = 'mut-grid-14';
        row.setAttribute('role', 'row');

        var vencCell = document.createElement('div');
        vencCell.className = 'mut-misc-16';
        vencCell.setAttribute('role', 'cell');
        vencCell.textContent = b.vencimento || '—';
        row.appendChild(vencCell);

        var valorCell = document.createElement('div');
        valorCell.className = 'mut-heading-x';
        valorCell.setAttribute('role', 'cell');
        valorCell.textContent = formatarValor(b.valor);
        row.appendChild(valorCell);

        var statusCell = document.createElement('div');
        statusCell.setAttribute('role', 'cell');
        if (b.pagamento_presencial) {
          var badge = document.createElement('span');
          badge.className = 'mut-status mut-status--aberto';
          badge.textContent = 'Pagamento na loja';
          statusCell.appendChild(badge);
        } else {
          var badgeAberto = document.createElement('span');
          badgeAberto.className = 'mut-status mut-status--aberto';
          badgeAberto.textContent = 'Em aberto';
          statusCell.appendChild(badgeAberto);
        }
        row.appendChild(statusCell);

        var acoesCell = document.createElement('div');
        acoesCell.className = 'mut-row-26';
        acoesCell.setAttribute('role', 'cell');

        if (b.pagamento_presencial) {
          var aviso = document.createElement('span');
          aviso.className = 'mut-misc-55';
          aviso.style.margin = '0';
          aviso.textContent = 'Dirija-se ao escritório da MUT para pagar.';
          acoesCell.appendChild(aviso);
        } else {
          if (b.codigo_barras) {
            acoesCell.appendChild(criarBotaoCopiar('Código', b.codigo_barras, 'Copiar código de barras do boleto de ' + (b.vencimento || '')));
          }
          if (b.pix_copia_cola) {
            acoesCell.appendChild(criarBotaoCopiar('Pix', b.pix_copia_cola, 'Copiar Pix copia e cola do boleto de ' + (b.vencimento || '')));
          }
        }

        // Nunca há botão de PDF nesta tela pública (sem login) — o PDF
        // completo carrega dados pessoais do titular, e essa tela mostra
        // só os códigos de pagamento, propositalmente. PDF só existe na
        // Área do Cliente (autenticada). Ver PROGRESSO.md.

        row.appendChild(acoesCell);
        rowsEl.appendChild(row);
      });
    }
  }

  function criarBotaoCopiar(label, texto, ariaLabel) {
    var btn = document.createElement('button');
    btn.type = 'button';
    btn.className = 'mut-boleto-copy mut-card-9';
    btn.setAttribute('aria-label', ariaLabel);
    btn.title = ariaLabel;

    var labelEl = document.createElement('span');
    labelEl.className = 'mut-boleto-copy-label';
    labelEl.setAttribute('aria-live', 'polite');
    labelEl.textContent = label;
    btn.appendChild(labelEl);

    btn.addEventListener('click', function () {
      var original = labelEl.textContent;
      copiarParaAreaDeTransferencia(texto).then(function () {
        labelEl.textContent = 'Copiado!';
      }).catch(function () {
        labelEl.textContent = 'Não copiou';
      }).finally(function () {
        setTimeout(function () { labelEl.textContent = original; }, 1600);
      });
    });

    return btn;
  }

  /**
   * navigator.clipboard só funciona em contexto seguro (HTTPS ou localhost)
   * — em HTTP puro com outro hostname (ex.: ambiente de teste local) o
   * navegador nem expõe a API, e o clique falharia em silêncio. Aqui
   * caímos para o método antigo (textarea temporário + execCommand) nesse
   * caso, que funciona em qualquer contexto.
   */
  function copiarParaAreaDeTransferencia(texto) {
    if (navigator.clipboard && window.isSecureContext) {
      return navigator.clipboard.writeText(texto);
    }

    return new Promise(function (resolve, reject) {
      try {
        var textarea = document.createElement('textarea');
        textarea.value = texto;
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.focus();
        textarea.select();
        var ok = document.execCommand('copy');
        document.body.removeChild(textarea);
        ok ? resolve() : reject();
      } catch (e) {
        reject(e);
      }
    });
  }

  function formatarValor(valor) {
    if (typeof valor !== 'number') return valor || '—';
    return valor.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
  }

  /**
   * ---------------- Máscara de CPF/CNPJ (com suporte a CNPJ alfanumérico) ----------------
   *
   * O novo CNPJ alfanumérico da Receita Federal (vigente a partir de julho
   * de 2026, ver https://blog.tecnospeed.com.br/cnpj-alfanumerico/) tem 14
   * posições: as 12 primeiras podem ser letras (A-Z maiúsculas) OU dígitos,
   * e as 2 últimas (dígitos verificadores) continuam SEMPRE numéricas. CPF
   * continua sendo sempre 11 dígitos numéricos, sem mudança.
   *
   * limparEntradaCpfCnpj() já filtra caractere a caractere enquanto o
   * cliente digita, então o campo nunca aceita um caractere inválido pra
   * posição em que está (ex.: letra na posição do dígito verificador).
   */

  /**
   * Remove tudo que não é permitido na posição atual, sem aplicar máscara
   * ainda — usado a cada tecla digitada. Trunca em 14 caracteres úteis.
   */
  function limparEntradaCpfCnpj(bruto) {
    var limpo = '';
    var chars = (bruto || '').toUpperCase().split('');

    for (var i = 0; i < chars.length && limpo.length < 14; i++) {
      var c = chars[i];
      var posicao = limpo.length;
      // Posições 12 e 13 (os 2 últimos caracteres, índice 0-based) são
      // sempre dígito verificador — só aceita número ali, mesmo que o
      // usuário esteja digitando um CNPJ alfanumérico.
      var somenteDigito = posicao >= 12;
      var permitido = somenteDigito ? /[0-9]/.test(c) : /[0-9A-Z]/.test(c);
      if (permitido) limpo += c;
    }

    return limpo;
  }

  /**
   * Aplica a máscara visual (pontuação) por cima do valor já limpo.
   * Até 11 caracteres, formata como CPF (000.000.000-00). A partir do 12º,
   * assume que é CNPJ e formata como AA.AAA.AAA/0001-00.
   */
  function mascararCpfCnpj(bruto) {
    var limpo = limparEntradaCpfCnpj(bruto);

    if (limpo.length <= 11) {
      // CPF: 000.000.000-00
      return limpo
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d)/, '$1.$2')
        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }

    // CNPJ (alfanumérico nas 12 primeiras posições): AA.AAA.AAA/0001-00
    return limpo
      .replace(/([0-9A-Z]{2})([0-9A-Z])/, '$1.$2')
      .replace(/([0-9A-Z]{3})([0-9A-Z])/, '$1.$2')
      .replace(/([0-9A-Z]{3})([0-9A-Z])/, '$1/$2')
      .replace(/([0-9A-Z]{4})(\d)/, '$1-$2');
  }

  /**
   * Remove toda a pontuação da máscara antes de enviar ao backend — o
   * Laravel (por enquanto) só valida CPF/CNPJ puramente numérico, então
   * esta função também é o ponto único onde, no futuro, entraria a
   * conversão/validação extra para CNPJ alfanumérico real.
   */
  function sanitizarCpfCnpj(valor) {
    return (valor || '').toUpperCase().replace(/[^0-9A-Z]/g, '');
  }

  /**
   * Liga a máscara em tempo real a um <input>: aplica a cada tecla,
   * preservando a posição do cursor o melhor possível.
   */
  function aplicarMascaraCpfCnpj(input) {
    if (!input) return;
    input.setAttribute('maxlength', '18'); // 14 chars úteis + 4 de pontuação (CNPJ)
    input.setAttribute('autocomplete', input.getAttribute('autocomplete') || 'off');
    input.setAttribute('autocapitalize', 'characters');

    input.addEventListener('input', function () {
      var posicaoAntes = input.selectionStart;
      var tamanhoAntes = input.value.length;

      input.value = mascararCpfCnpj(input.value);

      var tamanhoDepois = input.value.length;
      var novaPosicao = posicaoAntes + (tamanhoDepois - tamanhoAntes);
      input.setSelectionRange(novaPosicao, novaPosicao);
    });
  }

  /* ---------------- Login — Área do Cliente ---------------- */
  function initLoginForm() {
    var form = document.getElementById('mut-login-form');
    var logoutBtn = document.getElementById('mut-logout');
    var loggedOutView = document.getElementById('mut-logged-out');
    var loggedInView = document.getElementById('mut-logged-in');
    var errorEl = document.getElementById('mut-login-error');
    var spinner = document.getElementById('mut-login-spinner');
    var anoSelect = document.getElementById('mut-faturas-ano');

    if (!form && !logoutBtn) return; // página não tem essa tela

    if (anoSelect) {
      var anoAtual = new Date().getFullYear();
      [anoAtual - 1, anoAtual, anoAtual + 1].forEach(function (ano) {
        var opt = document.createElement('option');
        opt.value = String(ano);
        opt.textContent = String(ano);
        if (ano === anoAtual) opt.selected = true;
        anoSelect.appendChild(opt);
      });
      anoSelect.addEventListener('change', function () {
        carregarFaturas(parseInt(anoSelect.value, 10));
      });
    }

    if (form) {
      var submitBtn = form.querySelector('button[type="submit"]');
      var cpfFieldInicial = form.querySelector('[name="cpf"]');
      aplicarMascaraCpfCnpj(cpfFieldInicial);

      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var cpfField = form.querySelector('[name="cpf"]');
        var senhaField = form.querySelector('[name="senha"]');
        var cpf = sanitizarCpfCnpj(cpfField.value);
        var senha = senhaField.value;

        errorEl.classList.add('hidden');
        errorEl.textContent = '';

        // Login, por enquanto, só aceita CPF/CNPJ numérico (mesma restrição
        // temporária do backend explicada em initBoletoForm).
        var somenteDigitos = /^[0-9]*$/.test(cpf);

        if (!cpf || !senha || !somenteDigitos) {
          errorEl.textContent = !somenteDigitos
            ? 'CNPJ alfanumérico ainda não é aceito no login — digite um CPF ou CNPJ numérico.'
            : 'Preencha CPF e senha.';
          errorEl.classList.remove('hidden');
          cpfField.setAttribute('aria-invalid', String(!cpf || !somenteDigitos));
          senhaField.setAttribute('aria-invalid', String(!senha));
          (!cpf || !somenteDigitos ? cpfField : senhaField).focus();
          return;
        }
        cpfField.removeAttribute('aria-invalid');
        senhaField.removeAttribute('aria-invalid');

        if (spinner) spinner.classList.remove('hidden');
        if (submitBtn) submitBtn.disabled = true;

        fetch('/hub-api/cliente/login', {
          method: 'POST',
          credentials: 'include',
          headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
          body: JSON.stringify({ cpf_cnpj: cpf, senha: senha }),
        })
          .then(function (res) { return res.json().then(function (json) { return { status: res.status, json: json }; }); })
          .then(function (result) {
            if (result.status !== 200 || !result.json || !result.json.ok) {
              errorEl.textContent = (result.json && result.json.message) || 'Não foi possível entrar agora. Tente novamente em instantes.';
              errorEl.classList.remove('hidden');
              return;
            }

            senhaField.value = ''; // nunca manter a senha em memória depois do envio
            mostrarAreaLogada(result.json.primeiro_nome);
          })
          .catch(function () {
            errorEl.textContent = 'Falha de conexão. Verifique sua internet e tente novamente.';
            errorEl.classList.remove('hidden');
          })
          .finally(function () {
            if (spinner) spinner.classList.add('hidden');
            if (submitBtn) submitBtn.disabled = false;
          });
      });
    }

    if (logoutBtn) {
      logoutBtn.addEventListener('click', function () {
        fetch('/hub-api/cliente/logout', {
          method: 'POST',
          credentials: 'include',
          headers: { 'Accept': 'application/json' },
        }).finally(function () {
          if (loggedInView) loggedInView.classList.add('hidden');
          if (loggedOutView) {
            loggedOutView.classList.remove('hidden');
            var cpfField = form && form.querySelector('[name="cpf"]');
            if (cpfField) cpfField.focus();
          }
          if (form) form.reset();
        });
      });
    }

    function mostrarAreaLogada(primeiroNome) {
      if (loggedOutView) loggedOutView.classList.add('hidden');
      if (loggedInView) {
        loggedInView.classList.remove('hidden');
        var heading = loggedInView.querySelector('h2');
        if (heading) {
          heading.textContent = primeiroNome ? ('Olá, ' + primeiroNome + ' 👋') : 'Olá 👋';
          heading.setAttribute('tabindex', '-1');
          heading.focus();
        }
      }
      carregarPlano();
      carregarFaturas(anoSelect ? parseInt(anoSelect.value, 10) : new Date().getFullYear());
      carregarProximoVencimento();
    }

    function carregarProximoVencimento() {
      var el = document.getElementById('mut-proximo-vencimento');
      if (!el) return;

      // Sempre o ano atual, independente do seletor de ano da tabela —
      // este card é um indicador fixo do dashboard, não segue o filtro.
      fetch('/hub-api/cliente/faturas?ano=' + new Date().getFullYear(), {
        credentials: 'include',
        headers: { 'Accept': 'application/json' },
      })
        .then(function (res) { return res.json(); })
        .then(function (json) {
          if (!json || !json.ok || !json.faturas || !json.faturas.length) {
            el.textContent = '—';
            return;
          }

          var proxima = null;
          var proximaData = null;

          json.faturas.forEach(function (f) {
            if (f.pago) return;
            var data = parseDataBr(f.vencimento);
            if (!data) return;
            if (!proximaData || data < proximaData) {
              proximaData = data;
              proxima = f;
            }
          });

          el.textContent = proxima ? proxima.vencimento : 'Em dia';
        })
        .catch(function () {
          el.textContent = '—';
        });
    }

    function parseDataBr(str) {
      // "dd/mm/aaaa" -> Date, para poder comparar/ordenar.
      if (!str) return null;
      var partes = str.split('/');
      if (partes.length !== 3) return null;
      var dia = parseInt(partes[0], 10);
      var mes = parseInt(partes[1], 10);
      var ano = parseInt(partes[2], 10);
      if (!dia || !mes || !ano) return null;
      return new Date(ano, mes - 1, dia);
    }

    function carregarPlano() {
      var nomeEl = document.getElementById('mut-plano-nome');
      var statusEl = document.getElementById('mut-plano-status');
      if (!nomeEl) return;

      fetch('/hub-api/cliente/plano', { credentials: 'include', headers: { 'Accept': 'application/json' } })
        .then(function (res) { return res.json(); })
        .then(function (json) {
          if (!json || !json.ok || !json.planos || !json.planos.length) {
            nomeEl.textContent = '—';
            if (statusEl) statusEl.textContent = '';
            return;
          }
          var plano = json.planos[0];
          nomeEl.textContent = plano.nome_plano || '—';
          if (statusEl) statusEl.textContent = plano.status || '';
        })
        .catch(function () {
          nomeEl.textContent = '—';
        });
    }

    function carregarFaturas(ano) {
      var loadingEl = document.getElementById('mut-faturas-loading');
      var emptyEl = document.getElementById('mut-faturas-empty');
      var errorFaturasEl = document.getElementById('mut-faturas-error');
      var tableEl = document.getElementById('mut-faturas-table');
      var rowsEl = document.getElementById('mut-faturas-rows');

      if (!tableEl) return;

      tableEl.classList.add('hidden');
      if (emptyEl) emptyEl.classList.add('hidden');
      if (errorFaturasEl) errorFaturasEl.classList.add('hidden');
      if (loadingEl) loadingEl.classList.remove('hidden');

      var url = '/hub-api/cliente/faturas' + (ano ? '?ano=' + encodeURIComponent(ano) : '');

      fetch(url, { credentials: 'include', headers: { 'Accept': 'application/json' } })
        .then(function (res) { return res.json().then(function (json) { return { status: res.status, json: json }; }); })
        .then(function (result) {
          if (loadingEl) loadingEl.classList.add('hidden');

          if (result.status !== 200 || !result.json || !result.json.ok) {
            if (errorFaturasEl) {
              errorFaturasEl.textContent = (result.json && result.json.message) || 'Não foi possível carregar suas faturas agora.';
              errorFaturasEl.classList.remove('hidden');
            }
            return;
          }

          var faturas = result.json.faturas || [];
          if (!faturas.length) {
            if (emptyEl) emptyEl.classList.remove('hidden');
            return;
          }

          renderFaturas(faturas, result.json.ano);
          tableEl.classList.remove('hidden');
        })
        .catch(function () {
          if (loadingEl) loadingEl.classList.add('hidden');
          if (errorFaturasEl) {
            errorFaturasEl.textContent = 'Falha de conexão. Tente novamente em instantes.';
            errorFaturasEl.classList.remove('hidden');
          }
        });

      function renderFaturas(faturas, anoUsado) {
        if (!rowsEl) return;
        rowsEl.innerHTML = '';

        faturas.forEach(function (f) {
          var row = document.createElement('div');
          row.className = 'mut-grid-16';
          row.setAttribute('role', 'row');

          var vencCell = document.createElement('div');
          vencCell.className = 'mut-misc-16';
          vencCell.setAttribute('role', 'cell');
          vencCell.textContent = f.vencimento || '—';
          row.appendChild(vencCell);

          var valorCell = document.createElement('div');
          valorCell.className = 'mut-heading-x';
          valorCell.setAttribute('role', 'cell');
          valorCell.textContent = formatarValor(f.valor);
          row.appendChild(valorCell);

          var statusCell = document.createElement('div');
          statusCell.setAttribute('role', 'cell');
          var badge = document.createElement('span');
          badge.className = 'mut-status ' + (f.pago ? 'mut-status--pago' : 'mut-status--aberto');
          badge.textContent = f.pago ? 'Pago' : (f.status || 'Em aberto');
          statusCell.appendChild(badge);
          row.appendChild(statusCell);

          var acaoCell = document.createElement('div');
          acaoCell.className = 'mut-row-26';
          acaoCell.setAttribute('role', 'cell');

          if (f.pago) {
            // Fatura já paga: nem código/PIX (não faz sentido pagar de
            // novo) nem PDF (bloqueado nesta fase) — só a data do pagamento.
            var pagoEm = document.createElement('span');
            pagoEm.className = 'mut-misc-55';
            pagoEm.style.margin = '0';
            pagoEm.textContent = f.data_pagamento ? ('Pago em ' + f.data_pagamento) : 'Pago';
            acaoCell.appendChild(pagoEm);
          } else if (f.pagamento_presencial || !f.id_fatura) {
            var aviso = document.createElement('span');
            aviso.className = 'mut-misc-55';
            aviso.style.margin = '0';
            aviso.textContent = 'Pague no escritório da MUT';
            acaoCell.appendChild(aviso);
          } else {
            if (f.codigo_barras) {
              acaoCell.appendChild(criarBotaoCopiar('Código', f.codigo_barras, 'Copiar código de barras do boleto de ' + (f.vencimento || '')));
            }
            if (f.pix_copia_cola) {
              acaoCell.appendChild(criarBotaoCopiar('Pix', f.pix_copia_cola, 'Copiar Pix copia e cola do boleto de ' + (f.vencimento || '')));
            }

            var pdfLink = document.createElement('a');
            pdfLink.href = '/hub-api/cliente/faturas/' + encodeURIComponent(f.id_fatura) + '/pdf?ano=' + encodeURIComponent(anoUsado);
            pdfLink.target = '_blank';
            pdfLink.rel = 'noopener';
            pdfLink.className = 'mut-card-24';
            pdfLink.setAttribute('aria-label', 'Baixar PDF da fatura de ' + (f.vencimento || ''));
            pdfLink.textContent = 'PDF';
            acaoCell.appendChild(pdfLink);
          }

          row.appendChild(acaoCell);
          rowsEl.appendChild(row);
        });
      }
    }
  }

  /* ---------------- Análise de viabilidade ---------------- */
  function initViabilidadeForm() {
    var form = document.getElementById('mut-viab-form');
    if (!form) return;
    var successBlock = document.getElementById('mut-viab-success');
    var emailInput = form.querySelector('[name="email"]');
    var enderecoInput = form.querySelector('[name="endereco"]');
    var errEmail = document.getElementById('mut-viab-err-email');
    var errEndereco = document.getElementById('mut-viab-err-endereco');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var email = emailInput.value.trim();
      var endereco = enderecoInput.value.trim();
      var hasError = false;
      var firstInvalid = null;

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errEmail.textContent = 'Digite um e-mail válido.';
        errEmail.classList.remove('hidden');
        emailInput.setAttribute('aria-invalid', 'true');
        hasError = true;
        firstInvalid = emailInput;
      } else {
        errEmail.classList.add('hidden');
        emailInput.removeAttribute('aria-invalid');
      }

      if (endereco.length < 8) {
        errEndereco.textContent = 'Informe o endereço completo.';
        errEndereco.classList.remove('hidden');
        enderecoInput.setAttribute('aria-invalid', 'true');
        hasError = true;
        if (!firstInvalid) firstInvalid = enderecoInput;
      } else {
        errEndereco.classList.add('hidden');
        enderecoInput.removeAttribute('aria-invalid');
      }

      if (hasError) {
        if (firstInvalid) firstInvalid.focus();
        return;
      }

      form.classList.add('hidden');
      if (successBlock) successBlock.classList.remove('hidden');
    });
  }
})();
