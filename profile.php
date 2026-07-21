<?php
require_once __DIR__ . '/config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if (!isset($OPERATORS[$id])) {
    http_response_code(404);
    ?>
    <!DOCTYPE html>
    <html lang="th">
    <head>
        <meta charset="UTF-8">
        <title>404 // Operator Not Found</title>
        <link rel="stylesheet" href="style.css?v=3">
    </head>
    <body>
        <div class="shell">
            <div class="hero">
                <div class="eyebrow">error 404</div>
                <h1>OPERATOR NOT FOUND<span class="cursor"></span></h1>
                <p>ไม่พบข้อมูลผู้ปฏิบัติงานที่ระบุ กรุณากลับไปยังหน้าแดชบอร์ด</p>
            </div>
            <a class="back-link" href="index.php">&lt;&lt; กลับสู่แดชบอร์ด</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

$op = $OPERATORS[$id];
$caseCount = count($op['portfolio']);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($op['codename']); ?> // Operator Profile</title>
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
            <span class="current"><?= htmlspecialchars(strtolower($op['codename'])); ?></span>
        </nav>
        <div class="clock"><?= date('Y-m-d H:i:s'); ?> UTC</div>
    </div>

    <a class="back-link" href="index.php">&lt;&lt; กลับสู่แดชบอร์ด</a>

    <div class="profile-header">
        <div class="profile-avatar">
            <img src="<?= htmlspecialchars($op['avatar']); ?>"
                 alt="<?= htmlspecialchars($op['codename']); ?>"
                 onerror="this.onerror=null; this.style.display='none'; this.insertAdjacentHTML('afterend','<div class=&quot;avatar-fallback&quot;><svg viewBox=&quot;0 0 24 24&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;1.6&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;><path d=&quot;M3 3l18 18&quot;/><path d=&quot;M10.5 5h3l1 2H19a2 2 0 0 1 2 2v8.5&quot;/><path d=&quot;M5 7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11&quot;/><circle cx=&quot;12&quot; cy=&quot;13&quot; r=&quot;3.2&quot;/></svg><span>NO_IMAGE_DATA</span></div>');">
        </div>
        <div class="profile-meta">
            <div class="tag">operator file // OP-0<?= $op['id']; ?></div>
            <h1><?= htmlspecialchars($op['codename']); ?></h1>
            <div class="role-line"><?= htmlspecialchars($op['realname']); ?> — <?= htmlspecialchars($op['role']); ?></div>
            <p class="bio"><?= htmlspecialchars($op['bio']); ?></p>
            <div class="stat-row">
                <span class="stat-chip">specialty: <?= htmlspecialchars($op['specialty']); ?></span>
                <span class="stat-chip">case files: <?= $caseCount; ?></span>
                <span class="stat-chip">status: active</span>
            </div>
        </div>
    </div>

    <div class="section-label">case files [<?= $caseCount; ?>]</div>

    <div class="gallery">
        <?php foreach ($op['portfolio'] as $i => $case): ?>
        <div class="case-card">
            <div class="case-img">
                <span class="img-bg" style="background-image:url('<?= htmlspecialchars($case['image']); ?>');"></span>
                <img src="<?= htmlspecialchars($case['image']); ?>"
                     alt="<?= htmlspecialchars($case['title']); ?>"
                     loading="lazy"
                     onerror="this.onerror=null; this.style.display='none'; this.parentNode.insertAdjacentHTML('beforeend','<div class=&quot;avatar-fallback&quot;><svg viewBox=&quot;0 0 24 24&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;1.6&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;><path d=&quot;M3 3l18 18&quot;/><path d=&quot;M10.5 5h3l1 2H19a2 2 0 0 1 2 2v8.5&quot;/><path d=&quot;M5 7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11&quot;/><circle cx=&quot;12&quot; cy=&quot;13&quot; r=&quot;3.2&quot;/></svg><span>NO_IMAGE_DATA</span></div>');">
            </div>
            <div class="case-body">
                <div class="case-num">FILE_<?= str_pad($i + 1, 2, '0', STR_PAD_LEFT); ?></div>
                <h3><?= htmlspecialchars($case['title']); ?></h3>
                <p><?= htmlspecialchars($case['desc']); ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="footnote">
        <span>viewing: <?= htmlspecialchars($op['codename']); ?></span>
        <span>data source: local /img folder</span>
    </div>

</div>
</body>
</html>