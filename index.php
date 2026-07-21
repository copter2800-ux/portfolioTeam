<?php
require_once __DIR__ . '/config.php';
$total = count($OPERATORS);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>OPERATOR_DASHBOARD // Team Console</title>
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
            <a href="index.php" class="is-active">dashboard</a>
            <span class="sep">/</span>
            <a href="team.php">team</a>
        </nav>
        <div class="clock"><?= date('Y-m-d H:i:s'); ?> UTC</div>
    </div>

    <!-- hero row: dashboard hero (left)  +  team portfolio menu (right) -->
    <div class="hero-wrapper">

        <div class="hero">
            <div class="eyebrow">
                <span class="status-dot"></span>
                SYSTEM STATUS // ONLINE
            </div>

            <h1>
                OPERATOR DASHBOARD
                <span class="cursor"></span>
            </h1>

            <p>
                
            </p>

            <div class="hero-stats">
                <div class="hero-box">
                    <h2><?= count($OPERATORS); ?></h2>
                    <span>Operators</span>
                </div>
                <div class="hero-box">
                    <h2><?= count($TEAM_PORTFOLIO); ?></h2>
                    <span>Team Projects</span>
                </div>
                <div class="hero-box">
                    <h2>100%</h2>
                    <span>Online</span>
                </div>
            </div>
        </div>

        <a href="team.php" class="team-dashboard">
            <div class="team-icon">👥</div>
            <div class="team-title">TEAM PORTFOLIO</div>
            <div class="team-desc">
                ดูผลงานรวมของทีม รูปภาพ รายละเอียด
                และโครงการทั้งหมดในที่เดียว
            </div>
            <span class="team-button">View portfolio →</span>
        </a>

    </div>

    <div class="section-label">active operators [<?= $total; ?>]</div>

    <div class="grid">
        <?php foreach ($OPERATORS as $op): ?>
        <a class="card" href="profile.php?id=<?= urlencode($op['id']); ?>">
            <div class="card-top">
                <span class="idx">OP-0<?= $op['id']; ?></span>
                <span><?= htmlspecialchars($op['role']); ?></span>
            </div>
            <div class="avatar-wrap">
                <img src="<?= htmlspecialchars($op['avatar']); ?>"
                     alt="<?= htmlspecialchars($op['codename']); ?>"
                     loading="lazy"
                     onerror="this.onerror=null; this.style.display='none'; this.insertAdjacentHTML('afterend','<div class=&quot;avatar-fallback&quot;><svg viewBox=&quot;0 0 24 24&quot; fill=&quot;none&quot; stroke=&quot;currentColor&quot; stroke-width=&quot;1.6&quot; stroke-linecap=&quot;round&quot; stroke-linejoin=&quot;round&quot;><path d=&quot;M3 3l18 18&quot;/><path d=&quot;M10.5 5h3l1 2H19a2 2 0 0 1 2 2v8.5&quot;/><path d=&quot;M5 7a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h11&quot;/><circle cx=&quot;12&quot; cy=&quot;13&quot; r=&quot;3.2&quot;/></svg><span>NO_IMAGE_DATA</span></div>');">
            </div>
            <div class="card-body">
                <p class="codename"><?= htmlspecialchars($op['codename']); ?></p>
                <p class="role"><?= htmlspecialchars($op['realname']); ?></p>
                <span class="specialty"><?= htmlspecialchars($op['specialty']); ?></span>
                <div class="enter">เปิดดูโปรไฟล์ <span class="arrow">&gt;&gt;</span></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="footnote">
        <span>build: portfolio v2.0</span>
        <span>data source: local /img folder</span>
    </div>

</div>
</body>
</html>