<?php
require_once __DIR__ . '/config.php';

function status_meta(string $status): array {
    $s = strtolower(trim($status));
    if (str_contains($s, 'complete')) return ['tcard-status--done',  'Completed'];
    if (str_contains($s, 'progress')) return ['tcard-status--prog',  'In Progress'];
    if (str_contains($s, 'proto'))    return ['tcard-status--proto', 'Prototype'];
    return ['', htmlspecialchars($status)];
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TEAM PORTFOLIO // Operator Console</title>
<link rel="stylesheet" href="style.css?v=3">
</head>
<body>
<div class="shell">

    <div class="termbar">
        <div class="dots">
            <span class="dot d1"></span>
            <span class="dot d2"></span>
            <span class="dot d3"></span>
        </div>
        <nav class="term-nav" aria-label="Site">
            <a href="index.php">dashboard</a>
            <span class="sep">/</span>
            <a href="team.php" class="is-active">team</a>
        </nav>
        <div class="clock"><?= date('Y-m-d H:i:s'); ?> UTC</div>
    </div>

    <a class="back-link" href="index.php">&lt;&lt; กลับ Dashboard</a>

    <div class="hero">
        <div class="eyebrow"><span class="status-dot"></span> </div>
        <h1> TEAM PORTFOLIO<span class="cursor"></span></h1>
        <p>
            ผลงานรวมของทีม Portfolio
        </p>
    </div>

    <div class="section-label">team projects [<?= count($TEAM_PORTFOLIO); ?>]</div>

    <div class="projects-grid" id="projects-grid">
        <?php foreach ($TEAM_PORTFOLIO as $i => $project):
            [$statusClass, $statusLabel] = status_meta($project['status'] ?? '');
        ?>
        <a class="tcard" href="project.php?id=<?= urlencode($i); ?>"
           data-idx="<?= (int) $i; ?>"
           aria-describedby="hud-panel">
            <span class="tcard-spot"></span>

            <div class="tcard-media">
                <span class="img-bg" style="background-image:url('<?= htmlspecialchars($project['image']); ?>');"></span>
                <img src="<?= htmlspecialchars($project['image']); ?>"
                     alt="<?= htmlspecialchars($project['title']); ?>"
                     loading="lazy"
                     onerror="this.onerror=null; this.style.display='none'; this.parentNode.insertAdjacentHTML('beforeend','<div class=&quot;avatar-fallback&quot;><svg viewBox=&quot;0 0 24 24&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;1.6&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;><path d=&quot;M3 3l18 18&quot;/><path d=&quot;M10.5 5h3l1 2H19a2 2 0 0 1 2 2v8.5&quot;/><path d=&quot;M5 7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11&quot;/><circle cx=&quot;12&quot; cy=&quot;13&quot; r=&quot;3.2&quot;/></svg><span>NO_IMAGE_DATA</span></div>');">
                <?php if ($statusLabel): ?>
                <span class="tcard-status <?= $statusClass; ?>">
                    <span class="tcard-dot"></span><?= $statusLabel; ?>
                </span>
                <?php endif; ?>
            </div>

            <div class="tcard-body">
                <span class="tcard-kicker">Team Project · <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></span>
                <h3 class="tcard-title"><?= htmlspecialchars($project['title']); ?></h3>
                <p class="tcard-desc"><?= htmlspecialchars($project['desc']); ?></p>

                <?php if (!empty($project['skills'])): ?>
                <div class="tcard-tags">
                    <?php foreach (array_slice($project['skills'], 0, 3) as $sk): ?>
                        <span class="tcard-tag"><?= htmlspecialchars($sk); ?></span>
                    <?php endforeach; ?>
                    <?php if (count($project['skills']) > 3): ?>
                        <span class="tcard-tag">+<?= count($project['skills']) - 3; ?></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="tcard-cta">
                    <span>เปิดดูโปรเจกต์</span>
                    <span class="arrow">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14M13 6l6 6-6 6"/>
                        </svg>
                    </span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="footnote">
        <span>viewing: team portfolio</span>
        <span>data source: local /img folder</span>
    </div>

</div>

<!-- reusable floating dossier panel (single node, never duplicated → no layout shift) -->
<aside class="hud-panel" id="hud-panel" role="tooltip" aria-hidden="true">
    <span class="hud-scan" aria-hidden="true"></span>
    <div class="hud-body"></div>
</aside>

<!-- project data for the dossier; HEX flags make it safe to embed inside <script> -->
<script id="portfolio-data" type="application/json">
<?= json_encode($TEAM_PORTFOLIO, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE); ?>
</script>

<script>
(function () {
    'use strict';

    var raw = document.getElementById('portfolio-data');
    var DATA = [];
    try { DATA = JSON.parse(raw.textContent) || []; } catch (e) { DATA = []; }

    var panel   = document.getElementById('hud-panel');
    var body    = panel.querySelector('.hud-body');
    var grid    = document.getElementById('projects-grid');
    var canHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    function esc(v) {
        return String(v == null ? '' : v)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    function statusMeta(status) {
        var s = String(status || '').toLowerCase();
        if (s.indexOf('complete') > -1) return ['tcard-status--done',  'Completed'];
        if (s.indexOf('progress') > -1) return ['tcard-status--prog',  'In Progress'];
        if (s.indexOf('proto')    > -1) return ['tcard-status--proto', 'Prototype'];
        return ['', status || ''];
    }

    // build panel markup for a project index (only renders fields that exist)
    function render(idx) {
        var p = DATA[idx];
        if (!p) return;

        var sm = statusMeta(p.status);
        var rows = [];
        function row(label, val) { if (val) rows.push('<dt>' + esc(label) + '</dt><dd>' + esc(val) + '</dd>'); }
        if (sm[1]) rows.push('<dt>Status</dt><dd><span class="tcard-dot" style="display:inline-block;vertical-align:middle;margin-right:6px"></span>' + esc(sm[1]) + '</dd>');
        row('Role', p.role);
        row('Year', p.year);
        row('Frontend', p.frontend);
        row('Backend', p.backend);
        row('Database', p.database);
        row('Performance', p.performance);

        var chips = '';
        if (Array.isArray(p.skills) && p.skills.length) {
            chips = '<div class="hud-label">Tech stack</div><div class="hud-chips">' +
                p.skills.map(function (s) { return '<span>' + esc(s) + '</span>'; }).join('') + '</div>';
        }

        var feats = '';
        if (Array.isArray(p.features) && p.features.length) {
            feats = '<div class="hud-label">Features</div><ul class="hud-feats">' +
                p.features.slice(0, 4).map(function (f) { return '<li>' + esc(f) + '</li>'; }).join('') + '</ul>';
        }

        var summary = p.summary || p.desc || '';
        var href = 'project.php?id=' + encodeURIComponent(idx);

        var svgGit  = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-3.16 19.49c.5.09.68-.22.68-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.09 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.64 0 0 .84-.27 2.75 1.02a9.5 9.5 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.37.2 2.39.1 2.64.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85v2.74c0 .27.18.58.69.48A10 10 0 0 0 12 2z"/></svg>';
        var svgLink = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M10 14 21 3M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>';
        var svgArrow= '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>';

        var actions = [];
        if (p.github) actions.push('<a class="hud-btn hud-btn--ghost" href="' + esc(p.github) + '" target="_blank" rel="noopener">' + svgGit + 'GitHub</a>');
        if (p.demo)   actions.push('<a class="hud-btn hud-btn--primary" href="' + esc(p.demo) + '" target="_blank" rel="noopener">' + svgLink + 'Live demo</a>');
        actions.push('<a class="hud-btn ' + (p.demo ? 'hud-btn--ghost' : 'hud-btn--primary') + '" href="' + href + '">' + svgArrow + 'Dossier</a>');

        body.innerHTML =
            '<div class="hud-eyebrow">// dossier · ' + String(idx + 1).padStart(2, '0') + '</div>' +
            '<div class="hud-name ' + sm[0] + '">' + esc(p.title || 'Untitled') + '</div>' +
            (rows.length ? '<dl class="hud-rows">' + rows.join('') + '</dl>' : '') +
            (summary ? '<div class="hud-sep"></div><p class="hud-summary">' + esc(summary) + '</p>' : '') +
            chips + feats +
            '<div class="hud-actions">' + actions.join('') + '</div>';
    }

    // edge-aware positioning: prefer right of card, fall back to left, then clamp
    function place(card) {
        var r = card.getBoundingClientRect();
        var pw = panel.offsetWidth, ph = panel.offsetHeight, GAP = 16, M = 12;
        var x;
        if (r.right + GAP + pw <= window.innerWidth - M) x = r.right + GAP;
        else if (r.left - GAP - pw >= M)                 x = r.left - GAP - pw;
        else x = Math.min(Math.max(r.left, M), window.innerWidth - pw - M);
        var y = Math.min(Math.max(r.top, M), window.innerHeight - ph - M);
        panel.style.left = Math.round(x) + 'px';
        panel.style.top  = Math.round(y) + 'px';
    }

    var activeCard = null, rafId = 0;

    function show(card) {
        if (!canHover) return;
        activeCard = card;
        render(+card.dataset.idx);
        place(card);
        panel.classList.add('is-visible');
        panel.setAttribute('aria-hidden', 'false');
    }
    function hide(card) {
        if (activeCard !== card) return;
        activeCard = null;
        panel.classList.remove('is-visible');
        panel.setAttribute('aria-hidden', 'true');
    }

    // one delegated pointermove: card spotlight vars + ambient cursor glow + panel reposition (rAF throttled)
    var lastX = 0, lastY = 0;
    function onMove(e) {
        lastX = e.clientX; lastY = e.clientY;
        var card = e.target.closest ? e.target.closest('.tcard') : null;
        if (card) {
            var r = card.getBoundingClientRect();
            card.style.setProperty('--mx', ((e.clientX - r.left) / r.width * 100) + '%');
            card.style.setProperty('--my', ((e.clientY - r.top) / r.height * 100) + '%');
        }
        if (rafId) return;
        rafId = requestAnimationFrame(function () {
            rafId = 0;
            document.documentElement.style.setProperty('--px', lastX + 'px');
            document.documentElement.style.setProperty('--py', lastY + 'px');
            if (activeCard) place(activeCard);
        });
    }

    if (canHover && grid) {
        window.addEventListener('pointermove', onMove, { passive: true });

        grid.addEventListener('pointerenter', function (e) {
            var card = e.target.closest && e.target.closest('.tcard');
            if (card) show(card);
        }, true);
        grid.addEventListener('pointerleave', function (e) {
            var card = e.target.closest && e.target.closest('.tcard');
            if (card) hide(card);
        }, true);

        // keyboard accessibility: dossier on focus, dismissable with Escape
        grid.addEventListener('focusin', function (e) {
            var card = e.target.closest && e.target.closest('.tcard');
            if (card) show(card);
        });
        grid.addEventListener('focusout', function (e) {
            var card = e.target.closest && e.target.closest('.tcard');
            if (card) hide(card);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && activeCard) hide(activeCard);
        });
        window.addEventListener('scroll', function () { if (activeCard) place(activeCard); }, { passive: true });
    }
})();
</script>
</body>
</html>