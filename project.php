<?php
require_once __DIR__ . '/config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : -1;

if (!isset($TEAM_PORTFOLIO[$id])) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="th">
    <head>
        <meta charset="UTF-8">
        <title>404 // Project Not Found</title>
        <link rel="stylesheet" href="style.css?v=3">
    </head>
    <body>
        <div class="shell">
            <div class="hero">
                <div class="eyebrow">error 404</div>
                <h1>PROJECT NOT FOUND<span class="cursor"></span></h1>
                <p>ไม่พบข้อมูลโปรเจกต์ที่ระบุ กรุณากลับไปยังหน้า Team Portfolio</p>
            </div>
            <a class="back-link" href="team.php">&lt;&lt; กลับ Team Portfolio</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$p = $TEAM_PORTFOLIO[$id];

function pd_status(string $status): array {
    $s = strtolower(trim($status));
    if (str_contains($s, 'complete')) return ['pd-status--done',  'Completed'];
    if (str_contains($s, 'progress')) return ['pd-status--prog',  'In Progress'];
    if (str_contains($s, 'proto'))    return ['pd-status--proto', 'Prototype'];
    return ['', $status];
}
[$statusClass, $statusLabel] = pd_status($p['status'] ?? '');
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($p['title']); ?> // Team Project</title>
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
            <a href="team.php">team</a>
            <span class="sep">/</span>
            <span class="current">project <?= str_pad($id + 1, 2, '0', STR_PAD_LEFT); ?></span>
        </nav>
        <div class="clock"><?= date('Y-m-d H:i:s'); ?> UTC</div>
    </div>

    <a class="back-link" href="team.php">&lt;&lt; กลับ Team Portfolio</a>

    <div class="pd-hero">
        <div class="pd-banner">
            <span class="img-bg" style="background-image:url('<?= htmlspecialchars($p['image']); ?>');"></span>
            <img src="<?= htmlspecialchars($p['image']); ?>"
                 alt="<?= htmlspecialchars($p['title']); ?>"
                 onerror="this.onerror=null; this.style.display='none'; this.parentNode.insertAdjacentHTML('beforeend','<div class=&quot;avatar-fallback&quot;><svg viewBox=&quot;0 0 24 24&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;1.6&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;><path d=&quot;M3 3l18 18&quot;/><path d=&quot;M10.5 5h3l1 2H19a2 2 0 0 1 2 2v8.5&quot;/><path d=&quot;M5 7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11&quot;/><circle cx=&quot;12&quot; cy=&quot;13&quot; r=&quot;3.2&quot;/></svg><span>NO_IMAGE_DATA</span></div>');">
        </div>
        <div class="pd-head">
            <div class="pd-kicker">
                <span>Team Project · <?= str_pad($id + 1, 2, '0', STR_PAD_LEFT); ?></span>
                <?php if ($statusLabel): ?>
                <span class="pd-status <?= $statusClass; ?>">
                    <span class="tcard-dot"></span><?= htmlspecialchars($statusLabel); ?>
                </span>
                <?php endif; ?>
            </div>
            <h1 class="pd-title"><?= htmlspecialchars($p['title']); ?></h1>
            <p class="pd-summary"><?= htmlspecialchars($p['summary'] ?? $p['desc']); ?></p>
        </div>
    </div>

    <div class="section-label">project details</div>

    <div class="pd-grid">

        <?php if (!empty($p['features'])): ?>
        <div class="pd-block">
            <div class="pd-block-head">
                <span class="ic">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l2.4 6.9H22l-6 4.4 2.3 7L12 16l-6.3 4.3 2.3-7-6-4.4h7.6z"/>
                    </svg>
                </span>
                จุดเด่นของผลงาน
            </div>
            <ul>
                <?php foreach ($p['features'] as $f): ?>
                    <li><?= htmlspecialchars($f); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($p['use_cases'])): ?>
        <div class="pd-block">
            <div class="pd-block-head">
                <span class="ic">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="4.5"/><circle cx="12" cy="12" r="1"/>
                    </svg>
                </span>
                ประโยชน์ &amp; การนำไปใช้
            </div>
            <ul>
                <?php foreach ($p['use_cases'] as $u): ?>
                    <li><?= htmlspecialchars($u); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <?php if (!empty($p['skills'])): ?>
        <div class="pd-block">
            <div class="pd-block-head">
                <span class="ic">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <rect x="9" y="9" width="6" height="6"/>
                        <path d="M9 2v2M15 2v2M9 20v2M15 20v2M2 9h2M2 15h2M20 9h2M20 15h2"/>
                    </svg>
                </span>
                เทคโนโลยี &amp; สกิลที่ใช้
            </div>
            <div class="pd-chips">
                <?php foreach ($p['skills'] as $sk): ?>
                    <span><?= htmlspecialchars($sk); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($p['future'])): ?>
        <div class="pd-block">
            <div class="pd-block-head">
                <span class="ic">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4.5 16.5c-1.5 1.3-2 5-2 5s3.7-.5 5-2c.7-.8.7-2 0-2.8a2 2 0 0 0-3 0z"/>
                        <path d="M12 15l-3-3a11 11 0 0 1 8-9c2 0 4 2 4 4a11 11 0 0 1-9 8z"/>
                        <circle cx="15" cy="9" r="1"/>
                    </svg>
                </span>
                แนวทางการต่อยอด
            </div>
            <ul>
                <?php foreach ($p['future'] as $fu): ?>
                    <li><?= htmlspecialchars($fu); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

    </div>

    <div class="footnote">
        <span>viewing: <?= htmlspecialchars($p['title']); ?></span>
        <span>data source: local /img folder</span>
    </div>

</div>
</body>
</html>