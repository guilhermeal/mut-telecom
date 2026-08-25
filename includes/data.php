<?php
/**
 * Dados estáticos do site MUT Telecom.
 * Centraliza planos, FAQ, depoimentos e cidades atendidas
 * para serem renderizados no servidor (SSR) por todas as páginas.
 */

declare(strict_types=1);

/**
 * Dados institucionais mockados, centralizados aqui para alimentar tanto o
 * rodapé quanto as tags de SEO/JSON-LD/Open Graph em includes/header.php.
 * TODO: substituir por dados reais da empresa quando disponíveis.
 */
/**
 * Liga/desliga a exibição dos planos empresariais (toggle Residencial/Empresarial
 * e a seção de planos em empresas.php) enquanto não há valores reais definidos.
 * Reverter para true assim que os planos empresariais forem confirmados.
 */
const MUT_BUSINESS_PLANS_ENABLED = false;

const MUT_SITE_URL = 'https://www.muttelecom.com.br';
const MUT_PHONE_DISPLAY = '0800 042 0055';
const MUT_PHONE_TEL = '08000420055';
const MUT_PHONE_ZAP = '558000420055';
const MUT_EMAIL = 'contato@muttelecom.com.br';
const MUT_CNPJ = '08.375.171/0001-07';

/**
 * Endereço da sede (matriz), usado no rodapé (texto real, sinal de SEO local)
 * e no endereço do JSON-LD LocalBusiness. Os demais endereços por cidade
 * atendida ficam em mut_office_addresses().
 */
const MUT_HQ_ADDRESS = 'Rua Firmino de Queiroz, 101A';
const MUT_HQ_CITY = 'Murici';
const MUT_HQ_POSTAL_CODE = '57820-000';

/**
 * Monta um link de WhatsApp com mensagem pré-preenchida.
 */
function mut_whatsapp_link(string $mensagem): string
{
    return 'https://wa.me/' . MUT_PHONE_ZAP . '?text=' . rawurlencode($mensagem);
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
    $features = ['Roteador incluso', 'App de canais', 'App de filmes e séries', '100% fibra óptica', 'Suporte rápido', 'Ultra velocidade', 'Wi-Fi 6'];

    return [
        ['nome' => 'MUT 240', 'vel' => '240', 'unit' => 'Mega', 'precoOriginal' => '74,90', 'preco' => '69,90', 'destaque' => false, 'combos' => false,
            'features' => $features],
        ['nome' => 'MUT 320', 'vel' => '320', 'unit' => 'Mega', 'precoOriginal' => '84,90', 'preco' => '79,90', 'destaque' => false, 'combos' => false,
            'features' => $features],
        ['nome' => 'MUT 500', 'vel' => '500', 'unit' => 'Mega', 'precoOriginal' => '94,90', 'preco' => '89,90', 'destaque' => true, 'combos' => false,
            'features' => $features],
        ['nome' => 'MUT 700', 'vel' => '700', 'unit' => 'Mega', 'precoOriginal' => '104,90', 'preco' => '99,90', 'destaque' => false, 'combos' => false,
            'features' => $features],
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
 * Depoimentos mockados (placeholder até termos depoimentos reais de clientes).
 *
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
 * Endereços físicos dos escritórios da MUT, por cidade atendida.
 *
 * @return array<int, array{cidade: string, endereco: string}>
 */
function mut_office_addresses(): array
{
    return [
        ['cidade' => 'Murici', 'endereco' => 'Rua Firmino de Queiroz, 101A'],
        ['cidade' => 'Messias', 'endereco' => 'Rua Floriano Peixoto, S/N'],
        ['cidade' => 'Rio Largo', 'endereco' => 'Conjunto Jarbas Maia Oiticica, Quadra A5, nº 01'],
        ['cidade' => 'Branquinha', 'endereco' => 'Rua Prado Omena, S/N'],
    ];
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
 * 'statusClasse' é o modificador CSS (.mut-status--*) correspondente ao status.
 *
 * @return array<int, array{venc: string, valor: string, status: string, statusClasse: string}>
 */
function mut_faturas_mock(): array
{
    return [
        ['venc' => '10/06/2026', 'valor' => 'R$ 89,90', 'status' => 'Em aberto', 'statusClasse' => 'aberto'],
        ['venc' => '10/05/2026', 'valor' => 'R$ 89,90', 'status' => 'Pago', 'statusClasse' => 'pago'],
        ['venc' => '10/04/2026', 'valor' => 'R$ 89,90', 'status' => 'Pago', 'statusClasse' => 'pago'],
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
 * Ícone SVG de rolo de filme, usado no link "Filmes e Séries" do menu Acesso Rápido.
 */
function mut_icon_film(int $size = 16): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M7 4v16M17 4v16M3 9h4M3 15h4M17 9h4M17 15h4"/></svg>';
}

/**
 * Ícone SVG de TV, usado nos links "TV MUT" do menu Acesso Rápido.
 */
function mut_icon_tv(int $size = 16): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="6" width="18" height="13" rx="2"/><path d="M8 2l4 4 4-4"/></svg>';
}

/**
 * Ícone SVG de smartphone, usado nos links "App MUT" do menu Acesso Rápido.
 */
function mut_icon_smartphone(int $size = 16): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="2" width="12" height="20" rx="2"/><path d="M11 18h2"/></svg>';
}

/**
 * Ícone SVG do Instagram (mesmo traçado usado no rodapé).
 */
function mut_icon_instagram(int $size = 16): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor"/></svg>';
}

/**
 * Ícone SVG do Instagram (mesmo traçado usado no rodapé).
 */
function mut_icon_webmail(int $size = 16): string
{
    return '<svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="' . $size . '" height="' . $size . '" fill="none" stroke="var(--primary)" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M2 7l10 6 10-6"/></svg>';
}

/**
 * Dados estruturados LocalBusiness (schema.org) para o JSON-LD do <head>.
 * Reflete o que já está publicado no rodapé (endereço da sede, telefone,
 * e-mail, horário, cidades atendidas).
 *
 * @return array<string, mixed>
 */
function mut_local_business_jsonld(): array
{
    return [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'MUT Telecom',
        'image' => MUT_SITE_URL . '/assets/og-image.jpg',
        'description' => 'Internet de fibra óptica em Murici, Messias, Rio Largo e Branquinha, com atendimento local e suporte de verdade.',
        'telephone' => MUT_PHONE_DISPLAY,
        'email' => MUT_EMAIL,
        'url' => MUT_SITE_URL,
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => MUT_HQ_ADDRESS,
            'addressLocality' => MUT_HQ_CITY,
            'addressRegion' => 'AL',
            'postalCode' => MUT_HQ_POSTAL_CODE,
            'addressCountry' => 'BR',
        ],
        'areaServed' => mut_cidades(),
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '08:00',
                'closes' => '20:00',
            ],
        ],
    ];
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
            <div class="mut-card-hover-sm mut-card-26">
<?php if ($plan['destaque']): ?>
              <div class="mut-pos"></div>
              <div class="mut-pos-5">MAIS ASSINADO</div>
<?php endif; ?>
              <div class="mut-muted-16"><?= e($plan['nome']) ?></div>
              <div class="mut-row-4"><span class="mut-heading-46-3"><?= e($plan['vel']) ?></span><span class="mut-misc-50"><?= e($plan['unit']) ?></span></div>
              <div class="mut-plan-price-block">
<?php if (!empty($plan['precoOriginal'])): ?>
                <div class="mut-plan-original-price">De R$ <?= e($plan['precoOriginal']) ?>/mês</div>
<?php endif; ?>
                <div class="mut-plan-price-row"><span class="mut-muted-15-2">R$</span><span class="mut-heading-30"><?= e($plan['preco']) ?></span><span class="mut-muted-14-2">/mês</span></div>
<?php if (!empty($plan['precoOriginal'])): ?>
                <div class="mut-plan-discount-note">com desconto pontualidade</div>
<?php endif; ?>
              </div>
              <div class="mut-grid-3">
<?php foreach ($plan['features'] as $feat): ?>
                <div class="mut-row-13"><svg class="mut-misc-15" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="var(--primary)" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg><?= e($feat) ?></div>
<?php endforeach; ?>
<?php if ($plan['combos']): ?>
                <div class="mut-row-12"><svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M5 3v18l7-5 7 5V3z"/></svg>Combos de streaming</div>
<?php endif; ?>
              </div>
              <a href="<?= e($plan['wa']) ?>" target="_blank" rel="noopener" class="mut-lift mut-btn-6"><?= mut_icon_whatsapp(17) ?>Assinar agora</a>
            </div>
<?php
}

/**
 * Itens do menu principal (usados na navbar desktop e na drawer mobile),
 * ver includes/header.php.
 *
 * @return array<int, array{href: string, label: string}>
 */
function mut_main_nav_items(): array
{
    return [
        ['href' => 'planos', 'label' => 'Planos'],
        ['href' => 'cobertura', 'label' => 'Cobertura'],
        ['href' => 'empresas', 'label' => 'Para Empresas'],
        ['href' => 'sobre', 'label' => 'Sobre'],
        ['href' => 'ajuda', 'label' => 'Ajuda'],
    ];
}

/**
 * Links rápidos (canais externos: apps, WhatsApp, redes sociais), espelhando
 * https://linktr.ee/muttelecom — exibidos no menu suspenso "Acesso Rápido" da
 * navbar (ver includes/header.php e mut_render_quick_links_dropdown()).
 *
 * @return array<int, array{href: string, label: string, icon: string}>
 */
function mut_quick_links(): array
{
    return [
        ['href' => mut_whatsapp_float_link(), 'label' => 'WhatsApp', 'icon' => mut_icon_whatsapp(16)],
        ['href' => 'http://locadora.murici.net/', 'label' => 'Filmes e Séries', 'icon' => mut_icon_film()],
        ['href' => 'https://play.google.com/store/apps/details?id=br.com.veloo.tv7', 'label' => 'TV MUT — Android', 'icon' => mut_icon_tv()],
        ['href' => 'https://apps.apple.com/br/app/mais-tv/id1506825469', 'label' => 'TV MUT — iOS', 'icon' => mut_icon_tv()],
        ['href' => 'https://play.google.com/store/apps/details?id=com.hubsoft_client_app.muricinet', 'label' => 'App MUT — Android', 'icon' => mut_icon_smartphone()],
        ['href' => 'https://apps.apple.com/us/app/muricinet/id1569076918', 'label' => 'App MUT — iOS', 'icon' => mut_icon_smartphone()],
        ['href' => 'https://www.instagram.com/muttelecom/', 'label' => 'Instagram', 'icon' => mut_icon_instagram()],
        ['href' => 'https://webmail.dreamhost.com/?clearSession=true&_user=@muttelecom.com.br', 'label' => 'Webmail MUT', 'icon' => mut_icon_webmail()],
    ];
}

/**
 * Renderiza o menu suspenso "Acesso Rápido" com os canais externos da MUT
 * (apps, WhatsApp, redes sociais). Usado na navbar desktop; o mesmo conteúdo
 * é listado inline na drawer mobile.
 */
function mut_render_quick_links_dropdown(): void
{
    ?>
        <div class="mut-nav-dropdown" id="mut-quick-links-dropdown">
          <button type="button" class="mut-nav-link mut-nav-dropdown-btn" id="mut-quick-links-btn" aria-haspopup="true" aria-expanded="false" aria-controls="mut-quick-links-menu">
            Acesso Rápido
            <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          <div class="mut-nav-dropdown-menu hidden" id="mut-quick-links-menu" role="menu" aria-label="Acesso rápido">
<?php foreach (mut_quick_links() as $link): ?>
            <a href="<?= e($link['href']) ?>" class="mut-nav-dropdown-item" role="menuitem" target="_blank" rel="noopener"><?= $link['icon'] ?><?= e($link['label']) ?></a>
<?php endforeach; ?>
          </div>
        </div>
<?php
}

/**
 * Renderiza um link de navegação, marcando aria-current quando aplicável.
 * Usado tanto na navbar desktop (mut-nav-link) quanto na drawer mobile (mut-drawer-link)
 * — o estilo base de cada variante vive em assets/css/style.css.
 */
function mut_render_nav_link(string $href, string $label, string $class): void
{
    ?>
        <a href="<?= e($href) ?>" class="<?= e($class) ?>"<?= mut_nav_current($href) ?>><?= e($label) ?></a>
<?php
}

/**
 * Renderiza o botão de alternância de tema (sol/lua), reutilizado na navbar
 * desktop e no cabeçalho mobile — os dois só diferem em id e na transição CSS.
 */
function mut_render_theme_toggle_button(string $id, bool $withTransition = true): void
{
    $class = 'mut-theme-btn' . ($withTransition ? ' mut-theme-btn--transition' : '');
    ?>
        <button type="button" id="<?= e($id) ?>" class="<?= e($class) ?>" aria-label="Ativar tema escuro" aria-pressed="false">
          <svg class="theme-icon-sun" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="theme-icon-moon" aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="19" height="19" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/></svg>
        </button>
<?php
}

/**
 * Renderiza o par de botões Residencial/Empresarial que alterna os grupos
 * de planos exibidos (comportamento client-side, ver assets/js/main.js).
 */
function mut_render_plan_toggle(string $variant = 'on-background'): void
{
    $wrapperClass = 'mut-plan-toggle-wrap mut-plan-toggle-wrap--' . ($variant === 'on-surface' ? 'on-surface' : 'on-background');
    ?>
          <div class="mut-plan-toggle-outer">
            <div role="tablist" aria-label="Tipo de plano" class="<?= e($wrapperClass) ?>">
              <button type="button" id="mut-plan-tab-residencial" role="tab" aria-selected="true" aria-controls="mut-plan-panel-residencial" class="mut-plan-pill is-active" data-plan-type="residencial">Residencial</button>
              <button type="button" id="mut-plan-tab-empresarial" role="tab" aria-selected="false" aria-controls="mut-plan-panel-empresarial" class="mut-plan-pill" data-plan-type="empresarial">Empresarial</button>
            </div>
          </div>
<?php
}
