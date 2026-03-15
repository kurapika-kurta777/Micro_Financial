<?php
$current_page = basename($_SERVER['PHP_SELF']);

$portal_pages = ['client_portal.php','portal_loans.php','portal_repayments.php','portal_savings.php','portal_kyc.php'];
$portal_open  = in_array($current_page, $portal_pages);

$nav_items = [
    'CT1 · CLIENT SERVICES' => [
        ['icon' => 'bx-tachometer',  'label' => 'Dashboard',                       'sub' => 'System overview',           'href' => 'dashboard.php'],
        ['icon' => 'bx-user-plus',   'label' => 'Client Registration & KYC',       'sub' => 'Onboard & verify clients',  'href' => 'client_registration.php'],
        ['icon' => 'bx-file',        'label' => 'Loan Application & Disbursement', 'sub' => 'Process & release loans',   'href' => 'loan_application.php'],
        ['icon' => 'bx-money',       'label' => 'Loan Repayment & Installments',   'sub' => 'Track repayment schedules', 'href' => 'loan_repayment.php'],
        ['icon' => 'bx-wallet',      'label' => 'Savings Account Management',      'sub' => 'Manage savings accounts',   'href' => 'savings_account.php'],
        ['icon' => 'bx-group',       'label' => 'Group Lending & Solidarity',      'sub' => 'Cooperative loan programs', 'href' => 'group_lending.php'],
        ['icon' => 'bx-devices',     'label' => 'Client Self-Service Portal',      'sub' => 'Client-facing access hub',  'href' => 'client_portal.php',
            'children' => [
                ['icon' => 'bx-money',    'label' => 'My Loans',       'href' => 'portal_loans.php'],
                ['icon' => 'bx-receipt',  'label' => 'My Repayments',  'href' => 'portal_repayments.php'],
                ['icon' => 'bx-wallet',   'label' => 'My Savings',     'href' => 'portal_savings.php'],
                ['icon' => 'bx-id-card',  'label' => 'My KYC Status',  'href' => 'portal_kyc.php'],
            ]
        ],
    ],
    'CT2 · INSTITUTIONAL OVERSIGHT' => [
        ['icon' => 'bx-bar-chart-alt-2', 'label' => 'Loan Portfolio & Risk',           'sub' => 'Exposure & risk analytics', 'href' => 'loan_portfolio.php'],
        ['icon' => 'bx-signal-5',        'label' => 'Savings & Collection Monitoring', 'sub' => 'Live collection metrics',   'href' => 'savings_monitoring.php'],
        ['icon' => 'bx-transfer-alt',    'label' => 'Disbursement & Fund Tracker',     'sub' => 'Fund flow visibility',      'href' => 'fund_allocation.php'],
        ['icon' => 'bx-shield-alt-2',    'label' => 'Compliance & Audit Trail',        'sub' => 'Regulatory & audit logs',   'href' => 'compliance.php'],
        ['icon' => 'bx-line-chart',      'label' => 'Reports & Performance',           'sub' => 'KPIs & detailed reports',   'href' => 'reports.php'],
        ['icon' => 'bx-cog',             'label' => 'User Management & RBAC',          'sub' => 'Roles, access & users',     'href' => 'user_management.php'],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CORE TRANSACTION — Microfinancial Management System</title>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
:root {
  --navy:        #0f246c;
  --navy-dark:   #091a52;
  --navy-mid:    #162e82;
  --navy-light:  #1e3a9a;
  --blue-500:    #3B82F6;
  --blue-600:    #2563EB;
  --blue-700:    #1E40AF;
  --blue-light:  #93C5FD;
  --green-400:   #4ade80;
  --green-500:   #22c55e;
  --bg:          #F0F4FF;
  --surface:     #FFFFFF;
  --border:      rgba(59,130,246,0.14);
  --text-900:    #0F1E4A;
  --text-600:    #4B5E8A;
  --text-400:    #8EA0C4;
  --sidebar-w:   300px;
  --topbar-h:    64px;
  --transition:  cubic-bezier(0.4,0,0.2,1) 0.3s;
  --sidebar-text:      rgba(255,255,255,0.88);
  --sidebar-muted:     rgba(255,255,255,0.45);
  --sidebar-hover-bg:  rgba(255,255,255,0.07);
  --sidebar-active-bg: rgba(59,130,246,0.22);
  --sidebar-border:    rgba(255,255,255,0.08);
}

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text-900); overflow-x: hidden; }
a { text-decoration: none; color: inherit; }

::-webkit-scrollbar            { width: 4px; }
::-webkit-scrollbar-track      { background: transparent; }
::-webkit-scrollbar-thumb      { background: rgba(255,255,255,0.15); border-radius: 4px; }
::-webkit-scrollbar-thumb:hover{ background: rgba(255,255,255,0.28); }

/* ── Sidebar ── */
.sidebar {
  position: fixed; top: 0; left: 0;
  width: var(--sidebar-w); height: 100vh;
  background: var(--navy);
  display: flex; flex-direction: column;
  z-index: 1000;
  transition: transform var(--transition);
  overflow: hidden;
  box-shadow: 4px 0 32px rgba(9,26,82,0.45);
}

.sidebar-header {
  padding: 28px 24px 20px;
  flex-shrink: 0;
  position: relative; z-index: 1;
  border-bottom: 1px solid var(--sidebar-border);
}

.brand-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
.brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg,var(--blue-600),var(--blue-500)); border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 14px rgba(59,130,246,0.5); flex-shrink: 0; }
.brand-icon i { font-size: 22px; color: #fff; }
.brand-title { font-family: 'Space Grotesk', sans-serif; font-size: 13.5px; font-weight: 700; letter-spacing: 0.12em; color: #fff; text-transform: uppercase; }
.brand-subtitle { font-size: 10px; font-weight: 400; color: var(--sidebar-muted); letter-spacing: 0.04em; margin-top: 2px; }

.status-badge { display: inline-flex; align-items: center; gap: 7px; background: rgba(74,222,128,0.1); border: 1px solid rgba(74,222,128,0.25); border-radius: 20px; padding: 4px 10px 4px 8px; }
.pulse-dot { width: 7px; height: 7px; background: var(--green-400); border-radius: 50%; flex-shrink: 0; animation: pulse-glow 2s ease-in-out infinite; }
@keyframes pulse-glow { 0%,100%{ box-shadow:0 0 0 0 rgba(74,222,128,0.7); opacity:1; } 50%{ box-shadow:0 0 0 5px rgba(74,222,128,0); opacity:0.8; } }
.status-label { font-size: 10px; font-weight: 600; color: var(--green-400); letter-spacing: 0.05em; text-transform: uppercase; }

/* ── Nav ── */
.sidebar-nav { flex: 1; overflow-y: auto; padding: 16px 0 8px; position: relative; z-index: 1; }
.nav-section { margin-bottom: 4px; }
.nav-section-label { display: flex; align-items: center; gap: 8px; padding: 10px 24px 6px; font-size: 9.5px; font-weight: 700; letter-spacing: 0.13em; color: var(--sidebar-muted); text-transform: uppercase; user-select: none; }
.nav-section-label::after { content: ''; flex: 1; height: 1px; background: var(--sidebar-border); }

.nav-item { padding: 0 14px; margin: 1px 0; }
.nav-link { display: flex; align-items: center; gap: 13px; width: 100%; padding: 9px 12px; border-radius: 10px; transition: background var(--transition), transform var(--transition); cursor: pointer; }
.nav-link:hover { background: var(--sidebar-hover-bg); transform: translateX(8px); }
.nav-link.active { background: var(--sidebar-active-bg); }

.icon-wrapper { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(255,255,255,0.06); transition: background var(--transition); }
.nav-link:hover .icon-wrapper, .nav-link.active .icon-wrapper { background: rgba(59,130,246,0.25); }
.icon-wrapper i { font-size: 18px; color: var(--sidebar-muted); transition: color var(--transition); }
.nav-link:hover .icon-wrapper i, .nav-link.active .icon-wrapper i { color: var(--blue-light); }

.nav-text { flex: 1; min-width: 0; line-height: 1.25; }
.main-text { font-size: 12.5px; font-weight: 500; color: var(--sidebar-text); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.nav-link.active .main-text { color: #fff; font-weight: 600; }
.sub-text { font-size: 10px; color: var(--sidebar-muted); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 1px; }

.nav-chevron { opacity: 0; transition: opacity var(--transition); color: var(--blue-light); font-size: 14px; flex-shrink: 0; }
.nav-link:hover .nav-chevron, .nav-link.active .nav-chevron { opacity: 1; }

/* ── Expandable parent nav item ── */
.nav-item-parent .nav-link-parent { display: flex; align-items: center; gap: 13px; width: 100%; padding: 9px 12px; border-radius: 10px; transition: background var(--transition); cursor: pointer; }
.nav-item-parent .nav-link-parent:hover { background: var(--sidebar-hover-bg); }
.nav-item-parent .nav-link-parent.open { background: rgba(59,130,246,0.12); }

/* Toggle arrow */
.nav-toggle-arrow {
  font-size: 15px;
  color: var(--sidebar-muted);
  flex-shrink: 0;
  transition: transform 0.25s cubic-bezier(0.4,0,0.2,1), color 0.2s;
}
.nav-link-parent.open .nav-toggle-arrow {
  transform: rotate(90deg);
  color: var(--blue-light);
}

/* Sub-nav list */
.nav-subnav {
  display: none;
  flex-direction: column;
  gap: 1px;
  margin: 3px 0 4px 14px;
  padding-left: 20px;
  border-left: 2px solid rgba(59,130,246,0.2);
}
.nav-subnav.open { display: flex; }

.nav-sublink {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 7px 10px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 500;
  color: var(--sidebar-muted);
  transition: background var(--transition), color var(--transition), transform var(--transition);
  cursor: pointer;
}
.nav-sublink:hover {
  background: var(--sidebar-hover-bg);
  color: var(--sidebar-text);
  transform: translateX(4px);
}
.nav-sublink.active {
  background: rgba(59,130,246,0.18);
  color: #fff;
  font-weight: 600;
}
.nav-sublink i { font-size: 15px; color: var(--sidebar-muted); flex-shrink: 0; transition: color var(--transition); }
.nav-sublink:hover i, .nav-sublink.active i { color: var(--blue-light); }

/* ── Sidebar footer ── */
.sidebar-footer { flex-shrink: 0; padding: 16px; border-top: 1px solid var(--sidebar-border); position: relative; z-index: 1; }
.footer-card { background: rgba(255,255,255,0.05); border: 1px solid var(--sidebar-border); border-radius: 12px; padding: 12px 14px; display: flex; align-items: center; gap: 12px; }
.footer-icon { width: 34px; height: 34px; background: linear-gradient(135deg,rgba(59,130,246,0.3),rgba(30,64,175,0.3)); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.footer-icon i { font-size: 17px; color: var(--blue-light); }
.footer-info { flex: 1; min-width: 0; }
.footer-title { font-size: 11.5px; font-weight: 600; color: var(--sidebar-text); line-height: 1.3; }
.footer-status { font-size: 10px; color: var(--sidebar-muted); margin-top: 1px; }
.footer-version { font-size: 9px; font-weight: 700; letter-spacing: 0.08em; color: var(--blue-light); background: rgba(59,130,246,0.15); border: 1px solid rgba(59,130,246,0.25); border-radius: 5px; padding: 2px 6px; flex-shrink: 0; }

/* ── Overlay ── */
.sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(9,26,82,0.55); backdrop-filter: blur(2px); z-index: 999; opacity: 0; transition: opacity var(--transition); }
.sidebar-overlay.visible { display: block; opacity: 1; }

/* ── Top Navbar ── */
.top-navbar { position: sticky; top: 0; width: 100%; height: var(--topbar-h); background: var(--surface); border-bottom: 1px solid var(--border); box-shadow: 0 1px 16px rgba(59,130,246,0.08); z-index: 800; }
.navbar-container { max-width: 100vw; height: 100%; display: flex; align-items: center; padding: 0 18px; }
.navbar-content { width: 100%; display: flex; align-items: center; justify-content: space-between; }
.navbar-left { display: flex; align-items: center; }
.toggle-btn { width: 38px; height: 38px; border: 1px solid var(--border); border-radius: 9px; background: var(--bg); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; }
.toggle-btn:hover { background: #e4ecff; border-color: rgba(59,130,246,0.3); transform: scale(1.05); }
.toggle-btn i { font-size: 22px; color: var(--text-600); }
.navbar-right { display: flex; align-items: center; gap: 14px; }
.time-display { display: flex; align-items: center; background: var(--bg); border: 1px solid var(--border); border-radius: 20px; padding: 5px 14px; min-width: 130px; font-family: 'Space Grotesk', sans-serif; font-size: 13px; font-weight: 600; color: var(--text-900); letter-spacing: 0.03em; }
.date-separator { margin: 0 7px; color: var(--text-400); font-size: 13px; }
.icon-btn { width: 38px; height: 38px; border: 1px solid var(--border); border-radius: 9px; background: var(--bg); display: flex; align-items: center; justify-content: center; cursor: pointer; position: relative; transition: background var(--transition); }
.icon-btn:hover { background: #e4ecff; border-color: rgba(59,130,246,0.3); }
.icon-btn i { font-size: 20px; color: var(--text-600); }
.badge-dot { position: absolute; top: 7px; right: 7px; width: 8px; height: 8px; background: #ef4444; border-radius: 50%; border: 1.5px solid var(--surface); animation: pulse-red 2s ease-in-out infinite; }
@keyframes pulse-red { 0%,100%{ box-shadow:0 0 0 0 rgba(239,68,68,0.7); } 50%{ box-shadow:0 0 0 4px rgba(239,68,68,0); } }
.profile-wrapper { position: relative; }
.profile-avatar, .dropdown-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg,var(--blue-600),var(--blue-500)); display: flex; align-items: center; justify-content: center; font-family: 'Space Grotesk', sans-serif; font-size: 13px; font-weight: 700; color: #fff; cursor: pointer; border: 2px solid rgba(59,130,246,0.35); transition: box-shadow 0.2s, transform 0.15s; user-select: none; }
.profile-avatar:hover { box-shadow: 0 0 0 4px rgba(59,130,246,0.18); transform: scale(1.06); }
.profile-dropdown { position: absolute; top: calc(100% + 10px); right: 0; width: 192px; background: var(--surface); border: 1px solid var(--border); border-radius: 13px; box-shadow: 0 8px 40px rgba(59,130,246,0.14),0 2px 8px rgba(9,26,82,0.1); padding: 6px; opacity: 0; transform: translateY(-8px) scale(0.97); pointer-events: none; transition: opacity 0.2s ease, transform 0.2s ease; z-index: 900; }
.profile-dropdown.open { opacity: 1; transform: translateY(0) scale(1); pointer-events: all; }
.dropdown-header { padding: 10px 12px 8px; border-bottom: 1px solid var(--border); margin-bottom: 4px; display: flex; align-items: center; gap: 10px; }
.dropdown-name { font-size: 12.5px; font-weight: 600; color: var(--text-900); }
.dropdown-role { font-size: 10.5px; color: var(--text-400); margin-top: 1px; }
.dropdown-item { display: flex; align-items: center; gap: 9px; padding: 8px 12px; border-radius: 8px; font-size: 12.5px; font-weight: 500; color: var(--text-600); cursor: pointer; transition: background 0.15s, color 0.15s; }
.dropdown-item:hover { background: var(--bg); color: var(--text-900); }
.dropdown-item i { font-size: 16px; color: var(--text-400); transition: color 0.15s; }
.dropdown-item:hover i { color: var(--blue-500); }
.dropdown-item.dropdown-logout { color: #dc2626; }
.dropdown-item.dropdown-logout i { color: #dc2626; }
.dropdown-item.dropdown-logout:hover { background: #fff0f0; color: #b91c1c; }
.dropdown-divider { height: 1px; background: var(--border); margin: 4px 0; }

/* ── Page Wrapper ── */
.page-wrapper { margin-left: var(--sidebar-w); min-height: 100vh; transition: margin-left var(--transition); display: flex; flex-direction: column; }
.page-wrapper.shifted { margin-left: 0; }
.page-content { padding: 32px; flex: 1; }

.demo-notice { background: var(--surface); border: 1px dashed var(--border); border-radius: 16px; padding: 48px 32px; text-align: center; color: var(--text-400); }
.demo-notice i { font-size: 40px; color: var(--blue-light); margin-bottom: 12px; display: block; }
.demo-notice h2 { font-size: 16px; font-weight: 600; color: var(--text-600); margin-bottom: 6px; }
.demo-notice p { font-size: 13px; line-height: 1.6; }

@media (max-width: 768px) {
  .page-wrapper { margin-left: 0; }
  .sidebar { transform: translateX(-100%); }
  .sidebar.open { transform: translateX(0); }
  .time-display { display: none; }
}
</style>
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
  <div class="sidebar-header">
    <div class="brand-logo">
      <div class="brand-icon"><i class='bx bx-building-house'></i></div>
      <div class="brand-text">
        <div class="brand-title">Core Transaction</div>
        <div class="brand-subtitle">Financial Services & Institutional Control</div>
      </div>
    </div>
    <div class="status-badge">
      <span class="pulse-dot"></span>
      <span class="status-label">Online &amp; Operational</span>
    </div>
  </div>

  <nav class="sidebar-nav">
    <?php foreach ($nav_items as $section => $items): ?>
    <div class="nav-section">
      <div class="nav-section-label"><?= htmlspecialchars($section) ?></div>

      <?php foreach ($items as $item):
        $is_active = ($current_page === $item['href']);
        $has_children = !empty($item['children']);
        // Parent is "open" if we're on a child page or the parent itself
        $parent_open = $has_children && $portal_open;
      ?>

        <?php if ($has_children): ?>
        <!-- Expandable nav item -->
        <div class="nav-item nav-item-parent">
          <div class="nav-link-parent <?= $parent_open ? 'open' : '' ?>"
               onclick="toggleNavGroup(this)">
            <div class="icon-wrapper">
              <i class='bx <?= htmlspecialchars($item['icon']) ?>'></i>
            </div>
            <div class="nav-text">
              <div class="main-text"><?= htmlspecialchars($item['label']) ?></div>
              <div class="sub-text"><?= htmlspecialchars($item['sub']) ?></div>
            </div>
            <i class='bx bx-chevron-right nav-toggle-arrow'></i>
          </div>

          <!-- Sub-nav -->
          <div class="nav-subnav <?= $parent_open ? 'open' : '' ?>">
            <!-- Dashboard/portal link as first sub-item -->
            <a href="<?= htmlspecialchars($item['href']) ?>"
               class="nav-sublink <?= $is_active ? 'active' : '' ?>">
              <i class='bx bx-tachometer'></i>
              Overview
            </a>
            <?php foreach ($item['children'] as $child):
              $child_active = ($current_page === $child['href']);
            ?>
            <a href="<?= htmlspecialchars($child['href']) ?>"
               class="nav-sublink <?= $child_active ? 'active' : '' ?>">
              <i class='bx <?= htmlspecialchars($child['icon']) ?>'></i>
              <?= htmlspecialchars($child['label']) ?>
            </a>
            <?php endforeach; ?>
          </div>
        </div>

        <?php else: ?>
        <!-- Regular nav item -->
        <div class="nav-item">
          <a href="<?= htmlspecialchars($item['href']) ?>"
             class="nav-link <?= $is_active ? 'active' : '' ?>">
            <div class="icon-wrapper">
              <i class='bx <?= htmlspecialchars($item['icon']) ?>'></i>
            </div>
            <div class="nav-text">
              <div class="main-text"><?= htmlspecialchars($item['label']) ?></div>
              <div class="sub-text"><?= htmlspecialchars($item['sub']) ?></div>
            </div>
            <i class='bx bx-chevron-right nav-chevron'></i>
          </a>
        </div>
        <?php endif; ?>

      <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
  </nav>

  <div class="sidebar-footer">
    <div class="footer-card">
      <div class="footer-icon"><i class='bx bx-shield-alt-2'></i></div>
      <div class="footer-info">
        <div class="footer-title">Secure Platform</div>
        <div class="footer-status">All systems operational</div>
      </div>
      <div class="footer-version">MFS v1.0</div>
    </div>
  </div>
</aside>

<div class="page-wrapper" id="pageWrapper">
  <nav class="top-navbar" id="topNavbar">
    <div class="navbar-container">
      <div class="navbar-content">
        <div class="navbar-left">
          <button class="toggle-btn" id="toggleBtn" aria-label="Toggle sidebar"><i class='bx bx-menu'></i></button>
        </div>
        <div class="navbar-right">
          <div class="time-display" id="timeDisplay">
            <span id="currentTime"></span>
            <span class="date-separator">•</span>
            <span id="currentDate"></span>
          </div>
          <button class="icon-btn" id="searchBtn" title="Search"><i class='bx bx-search'></i></button>
          <button class="icon-btn" id="notificationBtn" title="Notifications"><i class='bx bx-bell'></i><span class="badge-dot"></span></button>
          <div class="profile-wrapper" id="profileWrapper">
            <div class="profile-avatar" id="profileBtn">AD</div>
            <div class="profile-dropdown" id="profileDropdown">
              <div class="dropdown-header">
                <div class="dropdown-avatar">AD</div>
                <div>
                  <div class="dropdown-name">Admin User</div>
                  <div class="dropdown-role">System Administrator</div>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item"><i class='bx bx-user'></i><span>My Profile</span></a>
              <a href="#" class="dropdown-item"><i class='bx bx-cog'></i><span>Settings</span></a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item dropdown-logout"><i class='bx bx-log-out'></i><span>Log Out</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <main class="page-content">
    <?php if (isset($page_content)) { echo $page_content; } else { ?>
      <div class="demo-notice">
        <i class='bx bx-layout'></i>
        <h2>Layout Shell — layout.php</h2>
        <p>This file provides the sidebar navigation and top navbar only.<br>
           Include or extend it in your page files to add content here.</p>
      </div>
    <?php } ?>
  </main>
</div>

<script>
(function () {
  'use strict';

  const sidebar     = document.getElementById('sidebar');
  const overlay     = document.getElementById('sidebarOverlay');
  const pageWrapper = document.getElementById('pageWrapper');
  const toggleBtn   = document.getElementById('toggleBtn');
  const profileBtn  = document.getElementById('profileBtn');
  const profileDropdown = document.getElementById('profileDropdown');
  const currentTime = document.getElementById('currentTime');
  const currentDate = document.getElementById('currentDate');

  let sidebarOpen = true;

  function isMobile() { return window.innerWidth <= 768; }

  function openSidebar() {
    sidebarOpen = true;
    sidebar.classList.remove('collapsed');
    sidebar.classList.add('open');
    if (isMobile()) overlay.classList.add('visible');
    else pageWrapper.classList.remove('shifted');
  }

  function closeSidebar() {
    sidebarOpen = false;
    sidebar.classList.add('collapsed');
    sidebar.classList.remove('open');
    overlay.classList.remove('visible');
    pageWrapper.classList.add('shifted');
  }

  toggleBtn.addEventListener('click', () => sidebarOpen ? closeSidebar() : openSidebar());
  overlay.addEventListener('click', closeSidebar);
  document.addEventListener('keydown', e => { if (e.key === 'Escape' && isMobile() && sidebarOpen) closeSidebar(); });
  window.addEventListener('resize', () => {
    if (isMobile() && sidebarOpen) { overlay.classList.add('visible'); pageWrapper.classList.remove('shifted'); }
    else if (!isMobile()) { overlay.classList.remove('visible'); if (sidebarOpen) pageWrapper.classList.remove('shifted'); }
  });
  if (isMobile()) { sidebarOpen = false; sidebar.classList.add('collapsed'); pageWrapper.classList.add('shifted'); }

  /* Profile dropdown */
  profileBtn.addEventListener('click', e => { e.stopPropagation(); profileDropdown.classList.toggle('open'); });
  document.addEventListener('click', e => { if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) profileDropdown.classList.remove('open'); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape') profileDropdown.classList.remove('open'); });

  /* Clock */
  var DAYS   = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  var MONTHS = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  function padZ(n) { return String(n).padStart(2,'0'); }
  function updateClock() {
    var now = new Date();
    var h12 = now.getHours() % 12 || 12;
    currentTime.textContent = padZ(h12)+':'+padZ(now.getMinutes())+':'+padZ(now.getSeconds())+' '+(now.getHours()>=12?'PM':'AM');
    currentDate.textContent = DAYS[now.getDay()]+', '+MONTHS[now.getMonth()]+' '+now.getDate()+' '+now.getFullYear();
  }
  updateClock();
  setInterval(updateClock, 1000);
})();

/* ── Nav group toggle ── */
function toggleNavGroup(trigger) {
  const isOpen = trigger.classList.contains('open');
  // Close all other open groups first
  document.querySelectorAll('.nav-link-parent.open').forEach(el => {
    if (el !== trigger) {
      el.classList.remove('open');
      el.nextElementSibling.classList.remove('open');
    }
  });
  // Toggle this one
  trigger.classList.toggle('open', !isOpen);
  trigger.nextElementSibling.classList.toggle('open', !isOpen);
}
</script>

</body>
</html>