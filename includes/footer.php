  </main>

  <!-- ============ FOOTER ============ -->
  <footer style="background:var(--surface); border-top:1px solid var(--border); padding:64px 0 0;">
    <div class="footer-grid" style="max-width:1240px; margin:0 auto; padding:0 24px; display:grid; grid-template-columns:1.6fr 1fr 1.2fr 1fr; gap:40px;">
      <div>
        <div style="position:relative; display:inline-block; font-family:'Archivo',sans-serif; font-weight:800; font-size:26px; letter-spacing:-1.5px; color:var(--primary); line-height:1;">MUT<svg viewBox="0 0 24 24" width="13" height="13" fill="var(--accent)" style="position:absolute; top:-8px; right:-7px;"><path d="M13 2L4 14h6l-1 8 9-12h-6z"/></svg></div>
        <div style="font-family:'Archivo',sans-serif; font-size:11px; font-weight:600; letter-spacing:2px; color:var(--muted); margin-top:6px;">CONECTADOS AO FUTURO</div>
        <p style="font-size:14px; line-height:1.55; color:var(--muted); margin:16px 0 18px; max-width:300px;">Operadora regional de fibra óptica, feita pra conectar Alagoas com velocidade e atendimento de verdade.</p>
        <div style="display:inline-flex; align-items:center; gap:8px; padding:7px 13px; border-radius:9px; background:var(--background); border:1px solid var(--border); font-size:12.5px; font-weight:600; color:var(--muted);"><svg viewBox="0 0 24 24" width="15" height="15" fill="none" stroke="var(--primary)" stroke-width="2"><path d="M12 2l8 4v6c0 5-3.5 8-8 10-4.5-2-8-5-8-10V6z"/></svg>Empresa registrada na Anatel</div>
      </div>
      <div>
        <div style="font-family:'Archivo',sans-serif; font-weight:700; font-size:15px; margin-bottom:16px;">Navegação</div>
        <div style="display:grid; gap:11px; font-size:14px;">
          <a href="planos.php" class="mut-muted-link" style="color:var(--muted); cursor:pointer; text-decoration:none;">Planos</a>
          <a href="cobertura.php" class="mut-muted-link" style="color:var(--muted); cursor:pointer; text-decoration:none;">Cobertura</a>
          <a href="empresas.php" class="mut-muted-link" style="color:var(--muted); cursor:pointer; text-decoration:none;">Para Empresas</a>
          <a href="sobre.php" class="mut-muted-link" style="color:var(--muted); cursor:pointer; text-decoration:none;">Sobre</a>
          <a href="ajuda.php" class="mut-muted-link" style="color:var(--muted); cursor:pointer; text-decoration:none;">Central de ajuda</a>
        </div>
      </div>
      <div>
        <div style="font-family:'Archivo',sans-serif; font-weight:700; font-size:15px; margin-bottom:16px;">Atendimento</div>
        <div style="display:grid; gap:12px; font-size:14px; color:var(--muted);">
          <div style="display:flex; align-items:center; gap:9px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2" stroke-linecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg>(82) 3000-0000</div>
          <div style="display:flex; align-items:center; gap:9px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg>WhatsApp (82) 9 9999-9999</div>
          <div style="display:flex; align-items:center; gap:9px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg>contato@muttelecom.com.br</div>
          <div style="display:flex; align-items:flex-start; gap:9px;"><svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2" style="margin-top:2px;"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2" stroke-linecap="round"/></svg>Seg a Sáb, 8h às 20h</div>
        </div>
      </div>
      <div>
        <div style="font-family:'Archivo',sans-serif; font-weight:700; font-size:15px; margin-bottom:16px;">Cidades atendidas</div>
        <div style="display:grid; gap:11px; font-size:14px; color:var(--muted);">
<?php foreach (mut_cidades() as $cidade): ?>
          <div><?= e($cidade) ?> — AL</div>
<?php endforeach; ?>
        </div>
      </div>
    </div>
    <div style="max-width:1240px; margin:38px auto 0; padding:22px 24px; border-top:1px solid var(--border); display:flex; flex-wrap:wrap; gap:18px; align-items:center; justify-content:space-between;">
      <div style="display:flex; gap:10px;">
        <a href="#" aria-label="Instagram" class="mut-social-link" style="width:38px; height:38px; border-radius:10px; border:1px solid var(--border); background:var(--background); display:flex; align-items:center; justify-content:center; color:var(--muted); cursor:pointer; text-decoration:none;"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg></a>
        <a href="#" aria-label="Facebook" class="mut-social-link" style="width:38px; height:38px; border-radius:10px; border:1px solid var(--border); background:var(--background); display:flex; align-items:center; justify-content:center; color:var(--muted); cursor:pointer; text-decoration:none;"><svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M14 9h3V6h-3c-2.2 0-4 1.8-4 4v2H7v3h3v6h3v-6h3l1-3h-4v-2c0-.6.4-1 1-1z"/></svg></a>
      </div>
      <div style="display:flex; flex-wrap:wrap; gap:18px; font-size:12.5px; color:var(--muted);">
        <a href="ajuda.php" class="mut-muted-link" style="cursor:pointer; text-decoration:none;">Contrato de prestação de serviço</a>
        <a href="ajuda.php" class="mut-muted-link" style="cursor:pointer; text-decoration:none;">Política de Privacidade / LGPD</a>
        <a href="ajuda.php" class="mut-muted-link" style="cursor:pointer; text-decoration:none;">Termos de uso</a>
      </div>
    </div>
    <div style="text-align:center; padding:18px 24px 26px; font-size:12.5px; color:var(--muted);">CNPJ 00.000.000/0001-00 · © <?= date('Y') ?> MUT Telecom. Todos os direitos reservados.</div>
  </footer>

  <!-- ============ WHATSAPP FLOAT ============ -->
  <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" aria-label="Falar no WhatsApp" style="position:fixed; bottom:24px; right:24px; z-index:55; width:58px; height:58px; border-radius:50%; background:#25d366; display:flex; align-items:center; justify-content:center; box-shadow:0 8px 24px rgba(37,211,102,.45); animation:mutPulse 2.4s infinite; cursor:pointer;"><svg viewBox="0 0 24 24" width="30" height="30" fill="#fff"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.6-6c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.5 6.5 0 0 1-3.2-2.8c-.2-.4.2-.4.6-1.2.1-.2 0-.3 0-.5l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.8.8-1 1.9-.6 3.1.5 1.5 1.5 2.8 2.7 3.8 1.9 1.6 3.5 2 4.5 1.8.7-.1 1.5-.7 1.7-1.3.2-.5.2-1 .1-1.1l-.6-.3z"/></svg></a>

  <!-- ============ COOKIE BANNER ============ -->
  <div id="mut-cookie-banner" class="hidden" style="position:fixed; bottom:0; left:0; right:0; z-index:54; padding:16px;">
    <div style="max-width:1000px; margin:0 auto; background:var(--background); border:1px solid var(--border); border-radius:16px; box-shadow:var(--shadow); padding:18px 22px; display:flex; flex-wrap:wrap; align-items:center; gap:16px; justify-content:space-between;">
      <p style="margin:0; font-size:14px; color:var(--muted); line-height:1.5; flex:1; min-width:240px;">Usamos cookies para melhorar sua experiência e entender como você usa o site. Ao continuar, você concorda com nossa Política de Privacidade.</p>
      <div style="display:flex; gap:10px;">
        <a href="ajuda.php" style="padding:11px 18px; border-radius:11px; font-weight:600; font-size:14px; color:var(--primary); border:1.5px solid var(--border); cursor:pointer; text-decoration:none;" class="mut-outline-hover-2">Saber mais</a>
        <button type="button" id="mut-cookie-accept" style="padding:11px 22px; border-radius:11px; font-weight:700; font-size:14px; color:#fff; background:var(--primary); border:none; cursor:pointer;">Aceitar</button>
      </div>
    </div>
  </div>

<script src="assets/js/main.js"></script>
</body>
</html>
