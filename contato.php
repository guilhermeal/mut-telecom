<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/data.php';

$pageTitle = 'Contato — MUT Telecom';
$pageDescription = 'Fale com a MUT Telecom por WhatsApp, telefone, e-mail ou formulário. Tire dúvidas, peça orçamento ou agende sua instalação.';

require __DIR__ . '/includes/header.php';
?>
<div>
      <section class="mut-misc-6">
        <div class="mut-container-760">
          <div class="mut-eyebrow">Contato</div>
          <h1 class="mut-heading-46">Fale com a gente</h1>
          <p class="mut-muted-17">Tire dúvidas, peça orçamento ou agende sua instalação. Respondemos rapidinho.</p>
        </div>
      </section>
      <section class="sec-pad mut-misc-18">
        <div class="split mut-misc-61">
          <!-- form -->
          <div class="mut-card-15">
            <div id="mut-contact-success" class="hidden mut-misc-89" role="status" aria-live="polite">
              <div class="mut-iconbox-64" aria-hidden="true"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg></div>
              <h3 class="mut-misc-41">Mensagem enviada!</h3>
              <p class="mut-muted-15-3">Recebemos seu contato e retornaremos em breve. Obrigado!</p>
            </div>
            <form class="mut-grid-12" id="mut-contact-form" novalidate>
              <div>
                <label class="mut-misc" for="mut-contact-nome">Nome completo</label>
                <input id="mut-contact-nome" name="nome" class="mut-input" placeholder="Seu nome" aria-describedby="mut-err-nome">
                <div id="mut-err-nome" class="hidden mut-misc-2" role="alert"></div>
              </div>
              <div class="grid-2 mut-grid-18">
                <div>
                  <label class="mut-misc" for="mut-contact-tel">Telefone / WhatsApp</label>
                  <input id="mut-contact-tel" name="tel" type="tel" class="mut-input" placeholder="(82) 9 9999-9999" aria-describedby="mut-err-tel">
                  <div id="mut-err-tel" class="hidden mut-misc-2" role="alert"></div>
                </div>
                <div>
                  <label class="mut-misc" for="mut-contact-cidade">Cidade</label>
                  <select id="mut-contact-cidade" name="cidade" class="mut-input" aria-describedby="mut-err-cidade">
                    <option value="">Selecione...</option><option value="Murici">Murici</option><option value="Messias">Messias</option><option value="Rio Largo">Rio Largo</option><option value="Branquinha">Branquinha</option>
                  </select>
                  <div id="mut-err-cidade" class="hidden mut-misc-2" role="alert"></div>
                </div>
              </div>
              <div>
                <label class="mut-misc" for="mut-contact-assunto">Assunto</label>
                <select id="mut-contact-assunto" name="assunto" class="mut-input">
                  <option>Contratar plano</option><option>Suporte técnico</option><option>Financeiro / 2ª via</option><option>Planos empresariais</option><option>Outro assunto</option>
                </select>
              </div>
              <div>
                <label class="mut-misc" for="mut-contact-mensagem">Mensagem</label>
                <textarea id="mut-contact-mensagem" name="mensagem" class="mut-input mut-input--textarea" placeholder="Como podemos ajudar?" rows="4" aria-describedby="mut-err-mensagem"></textarea>
                <div id="mut-err-mensagem" class="hidden mut-misc-2" role="alert"></div>
              </div>
              <button type="submit" class="mut-lift mut-btn-20">Enviar mensagem</button>
            </form>
          </div>
          <!-- contact cards -->
          <div class="mut-grid-4">
            <a href="<?= e(mut_whatsapp_float_link()) ?>" target="_blank" rel="noopener" class="mut-lift mut-card-17"><div class="mut-misc-95"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="22" height="22" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2z"/></svg></div><div><div class="mut-heading-15">WhatsApp</div><div class="mut-muted-135">(82) 9 9999-9999</div></div></a>
            <div class="mut-card-8"><div class="mut-iconbox-44-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3 19.5 19.5 0 0 1-6-6 19.8 19.8 0 0 1-3-8.6A2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1 1 .4 1.9.7 2.8a2 2 0 0 1-.5 2.1L8.1 9.9a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.8.7a2 2 0 0 1 1.7 2z"/></svg></div><div><div class="mut-heading-15">Telefone</div><div class="mut-muted-135">(82) 3000-0000</div></div></div>
            <div class="mut-card-8"><div class="mut-iconbox-44-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg></div><div><div class="mut-heading-15">E-mail</div><div class="mut-muted-135">contato@muttelecom.com.br</div></div></div>
            <div class="mut-card-18"><div class="mut-iconbox-44-2"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="21" height="21" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0z"/><circle cx="12" cy="10" r="2.5"/></svg></div><div><div class="mut-heading-15">Endereço</div><div class="mut-muted-135">[Av. Principal, 000 — Centro, Murici/AL]</div></div></div>
            <div class="mut-misc-25">mapa do Google (incorporar)</div>
          </div>
        </div>
      </section>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
