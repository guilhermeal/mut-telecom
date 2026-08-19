<?php
/**
 * Dados estáticos do site MUT Telecom.
 * Centraliza planos, FAQ, depoimentos e cidades atendidas
 * para serem renderizados no servidor (SSR) por todas as páginas.
 */

declare(strict_types=1);

const MUT_WHATSAPP_NUMBER = '5582999999999';

/**
 * Monta um link de WhatsApp com mensagem pré-preenchida.
 */
function mut_whatsapp_link(string $mensagem): string
{
    return 'https://wa.me/' . MUT_WHATSAPP_NUMBER . '?text=' . rawurlencode($mensagem);
}

function mut_whatsapp_float_link(): string
{
    return mut_whatsapp_link('Olá! Gostaria de saber mais sobre os planos da MUT Telecom.');
}

function mut_whatsapp_plan_link(string $nomePlano): string
{
    return mut_whatsapp_link('Olá! Quero assinar o plano ' . $nomePlano . ' da MUT Telecom.');
}

/**
 * @return array<int, array<string, mixed>>
 */
function mut_residential_plans(): array
{
    return [
        ['nome' => 'MUT 300', 'vel' => '300', 'unit' => 'Mega', 'preco' => '79,90', 'destaque' => false, 'combos' => false,
            'features' => ['Wi-Fi 5 incluso', 'Instalação grátis', 'Suporte local 24h', 'Sem fidelidade']],
        ['nome' => 'MUT 500', 'vel' => '500', 'unit' => 'Mega', 'preco' => '99,90', 'destaque' => true, 'combos' => true,
            'features' => ['Wi-Fi 6 incluso', 'Instalação grátis', 'Suporte local 24h', 'App do assinante']],
        ['nome' => 'MUT 700', 'vel' => '700', 'unit' => 'Mega', 'preco' => '119,90', 'destaque' => false, 'combos' => true,
            'features' => ['Wi-Fi 6 incluso', 'Instalação grátis', 'Suporte prioritário', 'App do assinante']],
        ['nome' => 'MUT GIGA', 'vel' => '1', 'unit' => 'Giga', 'preco' => '149,90', 'destaque' => false, 'combos' => false,
            'features' => ['Wi-Fi 6 mesh', 'Instalação grátis', 'Suporte VIP', 'IP dinâmico']],
    ];
}

/**
 * @return array<int, array<string, mixed>>
 */
function mut_business_plans(): array
{
    return [
        ['nome' => 'MUT Office 500', 'vel' => '500', 'unit' => 'Mega', 'preco' => '149,90', 'destaque' => false, 'combos' => false,
            'features' => ['IP dinâmico', 'Suporte comercial', 'Wi-Fi 6 incluso', 'SLA 8h úteis']],
        ['nome' => 'MUT Office 700', 'vel' => '700', 'unit' => 'Mega', 'preco' => '229,90', 'destaque' => true, 'combos' => false,
            'features' => ['IP fixo opcional', 'Suporte prioritário', 'Wi-Fi 6 mesh', 'SLA 4h úteis']],
        ['nome' => 'MUT Office GIGA', 'vel' => '1', 'unit' => 'Giga', 'preco' => '399,90', 'destaque' => false, 'combos' => false,
            'features' => ['IP fixo incluso', 'Gerente de conta', 'Link dedicado', 'SLA 2h úteis']],
    ];
}

/**
 * Adiciona o link de WhatsApp calculado a cada plano de uma lista.
 *
 * @param array<int, array<string, mixed>> $plans
 * @return array<int, array<string, mixed>>
 */
function mut_plans_with_links(array $plans): array
{
    return array_map(static function (array $plan): array {
        $plan['wa'] = mut_whatsapp_plan_link($plan['nome']);
        return $plan;
    }, $plans);
}

/**
 * @return array<int, array{q: string, a: string}>
 */
function mut_faqs(): array
{
    return [
        ['q' => 'A MUT atende minha rua?', 'a' => 'Atendemos Murici, Messias, Rio Largo e Branquinha, e estamos sempre expandindo a rede. Use o verificador de cobertura com seu CEP ou endereço para confirmar a disponibilidade exata.'],
        ['q' => 'Qual o prazo de instalação?', 'a' => 'Após a contratação e confirmação de viabilidade, a instalação é feita em até [48h], com técnico da sua região e em horário combinado com você.'],
        ['q' => 'Como funciona o suporte?', 'a' => 'Suporte local e humano, de gente da sua região — sem robô. Você fala com a gente por WhatsApp, telefone ou pela área do cliente.'],
        ['q' => 'Posso pagar por Pix ou boleto?', 'a' => 'Sim. Você pode pagar por Pix, boleto ou cartão. A 2ª via do boleto fica disponível a qualquer momento aqui no site.'],
        ['q' => 'Tem fidelidade?', 'a' => 'Temos planos com e sem fidelidade. As condições de cada plano são apresentadas de forma transparente antes da contratação — sem surpresas.'],
    ];
}

/**
 * @return array<int, array{texto: string, nome: string, cidade: string, inicial: string}>
 */
function mut_depoimentos(): array
{
    return [
        ['texto' => 'Melhor internet que já tive aqui em Murici! Não cai mais durante as aulas online dos meninos.', 'nome' => 'Ana Beatriz', 'cidade' => 'Murici — AL', 'inicial' => 'A'],
        ['texto' => 'Trabalho de casa e a estabilidade da MUT mudou meu dia a dia. Suporte responde rapidinho.', 'nome' => 'Carlos Henrique', 'cidade' => 'Rio Largo — AL', 'inicial' => 'C'],
        ['texto' => 'Instalaram em dois dias e o Wi-Fi pega na casa toda. Atendimento da região faz diferença.', 'nome' => 'Juliana Santos', 'cidade' => 'Messias — AL', 'inicial' => 'J'],
    ];
}

/**
 * @return array<int, string>
 */
function mut_cidades(): array
{
    return ['Murici', 'Messias', 'Rio Largo', 'Branquinha'];
}

/**
 * @return array<int, string>
 */
function mut_partners(): array
{
    return array_fill(0, 6, 'Parceiro');
}

/**
 * Faturas mockadas (placeholder até a integração com a API financeira).
 *
 * @return array<int, array{venc: string, valor: string, status: string, cor: string, bg: string}>
 */
function mut_faturas_mock(): array
{
    return [
        ['venc' => '10/06/2026', 'valor' => 'R$ 99,90', 'status' => 'Em aberto', 'cor' => '#b8860b', 'bg' => 'rgba(184,134,11,.12)'],
        ['venc' => '10/05/2026', 'valor' => 'R$ 99,90', 'status' => 'Pago', 'cor' => '#1f8a5b', 'bg' => 'rgba(31,138,91,.12)'],
        ['venc' => '10/04/2026', 'valor' => 'R$ 99,90', 'status' => 'Pago', 'cor' => '#1f8a5b', 'bg' => 'rgba(31,138,91,.12)'],
    ];
}

/**
 * Ícone SVG do WhatsApp (reutilizado em vários pontos do layout).
 */
function mut_icon_whatsapp(int $size = 18): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="currentColor"><path d="M12 2a10 10 0 0 0-8.7 14.9L2 22l5.3-1.4A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-3 .8.8-2.9-.2-.3A8 8 0 1 1 12 20zm4.6-6c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1l-.8 1c-.1.2-.3.2-.5.1a6.5 6.5 0 0 1-3.2-2.8c-.2-.4.2-.4.6-1.2.1-.2 0-.3 0-.5l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.8.8-1 1.9-.6 3.1.5 1.5 1.5 2.8 2.7 3.8 1.9 1.6 3.5 2 4.5 1.8.7-.1 1.5-.7 1.7-1.3.2-.5.2-1 .1-1.1l-.6-.3z"/></svg>';
}

/**
 * Escapa texto para saída segura em HTML.
 */
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Renderiza o cartão de um plano (usado nas páginas Home, Planos e Empresas).
 *
 * @param array<string, mixed> $plan
 */
function mut_render_plan_card(array $plan): void
{
    ?>
            <div class="mut-card-hover-sm" style="position:relative; background:var(--background); border:1px solid var(--border); border-radius:24px; padding:30px 26px; display:flex; flex-direction:column; box-shadow:var(--shadow-sm); transition:transform .2s, box-shadow .2s;">
<?php if ($plan['destaque']): ?>
              <div style="position:absolute; inset:0; border:2px solid var(--accent); border-radius:24px; pointer-events:none;"></div>
              <div style="position:absolute; top:-13px; left:50%; transform:translateX(-50%); background:var(--accent); color:#fff; font-size:12px; font-weight:700; padding:6px 16px; border-radius:999px; white-space:nowrap; box-shadow:0 3px 8px rgba(195,9,8,.22);">MAIS ASSINADO</div>
<?php endif; ?>
              <div style="font-family:'Archivo',sans-serif; font-weight:700; font-size:16px; color:var(--muted);"><?= e($plan['nome']) ?></div>
              <div style="display:flex; align-items:baseline; gap:6px; margin:10px 0 4px;"><span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:46px; line-height:1; letter-spacing:-2px; color:var(--primary);"><?= e($plan['vel']) ?></span><span style="font-size:18px; font-weight:600; color:var(--foreground);"><?= e($plan['unit']) ?></span></div>
              <div style="display:flex; align-items:baseline; gap:3px; margin-top:14px; padding-bottom:18px; border-bottom:1px solid var(--border);"><span style="font-size:15px; color:var(--muted);">R$</span><span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:30px;"><?= e($plan['preco']) ?></span><span style="font-size:14px; color:var(--muted);">/mês</span></div>
              <div style="display:grid; gap:11px; margin:20px 0 22px;">
<?php foreach ($plan['features'] as $feat): ?>
                <div style="display:flex; align-items:center; gap:10px; font-size:14px; color:var(--foreground);"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M20 6L9 17l-5-5"/></svg><?= e($feat) ?></div>
<?php endforeach; ?>
<?php if ($plan['combos']): ?>
                <div style="display:flex; align-items:center; gap:10px; font-size:14px; color:var(--accent); font-weight:600;"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 3v18l7-5 7 5V3z"/></svg>Combos de streaming</div>
<?php endif; ?>
              </div>
              <a href="<?= e($plan['wa']) ?>" target="_blank" rel="noopener" class="mut-lift" style="margin-top:auto; text-align:center; padding:13px; border-radius:12px; font-weight:700; font-size:14.5px; color:var(--accent-fg); background:var(--accent); cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:transform .18s; text-decoration:none;"><?= mut_icon_whatsapp(17) ?>Assinar agora</a>
            </div>
<?php
}

/**
 * Renderiza o par de botões Residencial/Empresarial que alterna os grupos
 * de planos exibidos (comportamento client-side, ver assets/js/main.js).
 */
function mut_render_plan_toggle(string $wrapperBg = 'var(--background)'): void
{
    ?>
          <div style="display:flex; justify-content:center; margin-bottom:44px;">
            <div role="tablist" aria-label="Tipo de plano" style="display:inline-flex; background:<?= e($wrapperBg) ?>; border:1px solid var(--border); border-radius:13px; padding:5px; gap:4px;">
              <button type="button" id="mut-plan-tab-residencial" role="tab" aria-selected="true" aria-controls="mut-plan-panel-residencial" class="mut-plan-pill is-active" data-plan-type="residencial">Residencial</button>
              <button type="button" id="mut-plan-tab-empresarial" role="tab" aria-selected="false" aria-controls="mut-plan-panel-empresarial" class="mut-plan-pill" data-plan-type="empresarial">Empresarial</button>
            </div>
          </div>
<?php
}
