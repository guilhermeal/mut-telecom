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
    initCookieBanner();
    initFaqAccordions();
    initPlanToggle();
    initCoverageForm();
    initContactForm();
    initBoletoForm();
    initLoginForm();
    initViabilidadeForm();
    initBoletoActions();
    initNoopLinks();
  });

  /* ---------------- Tema claro/escuro ---------------- */
  function initTheme() {
    var buttons = document.querySelectorAll('#mut-theme-toggle, #mut-theme-toggle-mobile');
    buttons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        var isDark = document.body.classList.toggle('dark');
        try { localStorage.setItem('mut-theme', isDark ? 'dark' : 'light'); } catch (e) {}
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

    var open = function () { drawer.classList.remove('hidden'); };
    var close = function () { drawer.classList.add('hidden'); };

    openBtn.addEventListener('click', open);
    if (closeBtn) closeBtn.addEventListener('click', close);
    drawer.addEventListener('click', function (e) {
      if (e.target === drawer) close();
    });
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
          items.forEach(function (i) { i.classList.remove('is-open'); });
          if (willOpen) item.classList.add('is-open');
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
        pills.forEach(function (p) { p.classList.toggle('is-active', p === pill); });
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

      setTimeout(function () {
        var low = value.toLowerCase();
        var cep = value.replace(/\D/g, '');
        var ok = cities.some(function (c) { return low.indexOf(c) !== -1; }) || /^57\d{3}/.test(cep);
        spinner.classList.add('hidden');
        button.disabled = false;
        (ok ? resultYes : resultNo).classList.remove('hidden');
      }, 850);
    });
  }

  /* ---------------- Formulário de contato ---------------- */
  function initContactForm() {
    var form = document.getElementById('mut-contact-form');
    if (!form) return;
    var successBlock = document.getElementById('mut-contact-success');

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

      Object.keys(fields).forEach(function (key) {
        var errEl = document.getElementById('mut-err-' + key);
        if (errEl) {
          errEl.textContent = errors[key] || '';
          errEl.classList.toggle('hidden', !errors[key]);
        }
      });

      if (Object.keys(errors).length) return;

      form.classList.add('hidden');
      if (successBlock) successBlock.classList.remove('hidden');
    });
  }

  /* ---------------- 2ª via de boleto ---------------- */
  function initBoletoForm() {
    var form = document.getElementById('mut-boleto-form');
    if (!form) return;
    var input = document.getElementById('mut-boleto-input');
    var errorEl = document.getElementById('mut-boleto-error');
    var spinner = document.getElementById('mut-boleto-spinner');
    var resultBlock = document.getElementById('mut-boleto-result');

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var digits = (input.value || '').replace(/\D/g, '');
      errorEl.classList.add('hidden');
      errorEl.textContent = '';

      if (digits.length !== 11 && digits.length !== 14) {
        errorEl.textContent = 'Digite um CPF (11 dígitos) ou CNPJ (14 dígitos) válido.';
        errorEl.classList.remove('hidden');
        if (resultBlock) resultBlock.classList.add('hidden');
        return;
      }

      spinner.classList.remove('hidden');
      if (resultBlock) resultBlock.classList.add('hidden');

      setTimeout(function () {
        spinner.classList.add('hidden');
        if (resultBlock) resultBlock.classList.remove('hidden');
      }, 850);
    });
  }

  function initBoletoActions() {
    var barcode = '00190.00009 03133.174009 12345.678901 8 99990000009990';
    document.querySelectorAll('.mut-boleto-copy, .mut-boleto-pix').forEach(function (btn) {
      btn.addEventListener('click', function () {
        try { navigator.clipboard.writeText(barcode); } catch (e) {}
        var label = btn.querySelector('.mut-boleto-copy-label');
        if (!label) return;
        var original = label.getAttribute('data-original') || label.textContent;
        label.setAttribute('data-original', original);
        label.textContent = 'Copiado!';
        setTimeout(function () { label.textContent = original; }, 1600);
      });
    });
  }

  /* ---------------- Links de placeholder (ex.: "Baixar PDF" mockado) ---------------- */
  function initNoopLinks() {
    document.querySelectorAll('.mut-noop-link').forEach(function (link) {
      link.addEventListener('click', function (e) { e.preventDefault(); });
    });
  }

  /* ---------------- Login — Área do Cliente ---------------- */
  function initLoginForm() {
    var form = document.getElementById('mut-login-form');
    var logoutBtn = document.getElementById('mut-logout');
    var loggedOutView = document.getElementById('mut-logged-out');
    var loggedInView = document.getElementById('mut-logged-in');
    var errorEl = document.getElementById('mut-login-error');

    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();
        var cpf = form.querySelector('[name="cpf"]').value.trim();
        var senha = form.querySelector('[name="senha"]').value.trim();
        if (!cpf || !senha) {
          errorEl.textContent = 'Preencha CPF e senha.';
          errorEl.classList.remove('hidden');
          return;
        }
        errorEl.classList.add('hidden');
        if (loggedOutView) loggedOutView.classList.add('hidden');
        if (loggedInView) loggedInView.classList.remove('hidden');
      });
    }

    if (logoutBtn) {
      logoutBtn.addEventListener('click', function () {
        if (loggedInView) loggedInView.classList.add('hidden');
        if (loggedOutView) loggedOutView.classList.remove('hidden');
        if (form) form.reset();
      });
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

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        errEmail.textContent = 'Digite um e-mail válido.';
        errEmail.classList.remove('hidden');
        hasError = true;
      } else {
        errEmail.classList.add('hidden');
      }

      if (endereco.length < 8) {
        errEndereco.textContent = 'Informe o endereço completo.';
        errEndereco.classList.remove('hidden');
        hasError = true;
      } else {
        errEndereco.classList.add('hidden');
      }

      if (hasError) return;

      form.classList.add('hidden');
      if (successBlock) successBlock.classList.remove('hidden');
    });
  }
})();
