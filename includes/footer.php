<?php declare(strict_types=1); ?>
  </main>

  <!-- ============ FOOTER ============ -->
  <footer class="mut-misc-31">
    <div class="footer-grid mut-misc-62">
      <div style="display: flex; flex-direction: column; align-items: baseline; gap: 8px;">
        <img src="assets/MUT_full_logo.png" alt="MUT Telecom" class="mut-logo mut-logo--xxl mut-logo-light">
        <img src="assets/MUT_full_logo_dark.png" alt="MUT Telecom" class="mut-logo mut-logo--xxl mut-logo-dark">
        <p class="mut-muted-14-4">Operadora regional de fibra óptica, feita pra conectar Alagoas com velocidade.</p>
      </div>
      <nav aria-label="Navegação do rodapé">
        <div class="mut-heading-15-3">Navegação</div>
        <div class="mut-grid-9">
          <a href="planos" class="mut-muted-link mut-misc-3">Planos</a>
          <a href="cobertura" class="mut-muted-link mut-misc-3">Cobertura</a>
          <a href="empresas" class="mut-muted-link mut-misc-3">Para Empresas</a>
          <a href="sobre" class="mut-muted-link mut-misc-3">Sobre</a>
          <a href="ajuda" class="mut-muted-link mut-misc-3">Central de ajuda</a>
        </div>
      </nav>
      <div>
        <h2 class="mut-heading-15-2">Atendimento</h2>
        <div class="mut-grid-11">
          <div class="mut-row-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg><span>WhatsApp: <a href="<?= mut_whatsapp_link("Olá.") ?>" target="_blank" rel="noopener" class="mut-accent-link"><?= e(MUT_PHONE_DISPLAY) ?></a></span></div>
          <div class="mut-row-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg><span><a href="mailto:<?= e(MUT_EMAIL) ?>" class="mut-accent-link"><?= e(MUT_EMAIL) ?></a></span></div>
          <div class="mut-row-19"><svg class="mut-misc-59" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2" stroke-linecap="round"/></svg><span>Seg a Sáb, 8h às 20h</span></div>
        </div>
      </div>
      <div>
        <h2 class="mut-heading-15-2">Cidades atendidas</h2>
        <div class="mut-grid-10">
          <?php foreach (mut_cidades() as $cidade): ?>
          <div><?= e($cidade) ?> — AL</div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="mut-misc-66">
      <div class="mut-row-7">
        <a href="#" aria-label="Instagram da MUT Telecom (abre em nova aba)" target="_blank" rel="noopener" class="mut-social-link mut-card-10"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg></a>
        <a href="#" aria-label="Facebook da MUT Telecom (abre em nova aba)" target="_blank" rel="noopener" class="mut-social-link mut-card-10"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H7v3h3v6h3v-6h3l1-3h-4v-2c0-.6.4-1 1-1z"/></svg></a>
      
        <div class="mut-card-19">
          <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg>Empresa registrada na Anatel
        </div>
      </div>

      <div class="mut-row-22">
        <a href="ajuda" class="mut-drawer-link mut-muted-link mut-misc-8">Contrato de prestação de serviço</a>
        <a href="ajuda" class="mut-drawer-link mut-muted-link mut-misc-8">Política de Privacidade / LGPD</a>
        <a href="ajuda" class="mut-drawer-link mut-muted-link mut-misc-8">Termos de uso</a>
      </div>
    </div>
    <div class="mut-muted-125-2">CNPJ <?= e(MUT_CNPJ) ?> · © <?= date('Y') ?> MUT Telecom. Todos os direitos reservados.</div>
  </footer>

  <!-- ============ WHATSAPP FLOAT ============ -->
  <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" aria-label="Falar no WhatsApp (abre em nova aba)" class="mut-iconbox-58-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="30" height="30" fill="#fff"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.6-6c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.5 6.5 0 0 1-3.2-2.8c-.2-.4.2-.4.6-1.2.1-.2 0-.3 0-.5l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.8.8-1 1.9-.6 3.1.5 1.5 1.5 2.8 2.7 3.8 1.9 1.6 3.5 2 4.5 1.8.7-.1 1.5-.7 1.7-1.3.2-.5.2-1 .1-1.1l-.6-.3z"/></svg></a>

  <!-- ============ CRÉDITO DO DESENVOLVEDOR (flutuante, canto inferior esquerdo) ============ -->
  <!-- Só aparece quando o usuário rola até perto do final da página (ver initDevCreditFloat em main.js). -->
  <a class="mut-iconbox-52" href="https://www.guilhermeal.com.br" target="_blank" rel="noopener" id="mut-dev-credit" title="Este site foi desenvolvido por Guilherme AL" aria-label="Este site foi desenvolvido por Guilherme AL (abre em nova aba)">
    <img class="mut-misc-36" src="assets/logo-guilherme-al.png" alt="" width="22" height="30">
  </a>

  <!-- ============ COOKIE BANNER ============ -->
  <div id="mut-cookie-banner" class="hidden mut-pos-12" role="region" aria-label="Aviso de cookies">
    <div class="mut-card-22">
      <p class="mut-muted-14-5">Usamos cookies para melhorar sua experiência e entender como você usa o site. Ao continuar, você concorda com nossa Política de Privacidade.</p>
      <div class="mut-row-7">
        <a href="ajuda" class="mut-outline-hover-2 mut-btn-7">Saber mais</a>
        <button class="mut-btn-9" type="button" id="mut-cookie-accept">Aceitar</button>
      </div>
    </div>
  </div>

<script src="assets/js/main.js?v=<?= filemtime(__DIR__ . '/../assets/js/main.js') ?>"></script>
</body>
</html>
