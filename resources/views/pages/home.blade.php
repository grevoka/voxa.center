<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Voxa Center — Téléphonie VoIP simplifiée & Agent IA</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
<style>
/* ═══════════════════════════════════════
   INLINE LUCIDE ICON SYSTEM
   ═══════════════════════════════════════ */
.i {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 20px; height: 20px;
  flex-shrink: 0;
}
.i svg {
  width: 100%; height: 100%;
  stroke: currentColor;
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  fill: none;
}
.i-sm { width: 14px; height: 14px; }
.i-xs { width: 12px; height: 12px; }
.i-lg { width: 22px; height: 22px; }
.i-xl { width: 24px; height: 24px; }

/* ═══════════════════════════════════════
   DESIGN SYSTEM
   ═══════════════════════════════════════ */
:root {
  --white: #ffffff;
  --gray-50: #f8fafc;
  --gray-100: #f1f5f9;
  --gray-200: #e2e8f0;
  --gray-300: #cbd5e1;
  --gray-400: #94a3b8;
  --gray-500: #64748b;
  --gray-600: #475569;
  --gray-700: #334155;
  --gray-800: #1e293b;
  --gray-900: #0f172a;

  --primary: #6d28d9;
  --primary-dark: #5b21b6;
  --primary-light: #8b5cf6;
  --primary-50: #f5f3ff;
  --primary-100: #ede9fe;

  --accent: #06b6d4;
  --accent-light: #22d3ee;
  --accent-50: #ecfeff;

  --gradient: linear-gradient(135deg, #06b6d4, #3b82f6, #8b5cf6, #d946ef);

  --success: #059669;
  --success-light: #d1fae5;
  --warning: #d97706;

  --font: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  --mono: 'Fira Code', 'Consolas', monospace;

  --radius-sm: 6px;
  --radius: 10px;
  --radius-lg: 14px;
  --radius-xl: 20px;
  --radius-full: 9999px;

  --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
  --shadow: 0 1px 3px rgba(0,0,0,0.08), 0 1px 2px rgba(0,0,0,0.04);
  --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.08), 0 2px 4px -2px rgba(0,0,0,0.05);
  --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
  --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.08), 0 8px 10px -6px rgba(0,0,0,0.04);
  --shadow-2xl: 0 25px 50px -12px rgba(0,0,0,0.15);
}

* { margin: 0; padding: 0; box-sizing: border-box; }
html { scroll-behavior: smooth; }
body {
  font-family: var(--font);
  color: var(--gray-800);
  background: var(--white);
  line-height: 1.6;
  -webkit-font-smoothing: antialiased;
  overflow-x: hidden;
}

.container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
section { padding: 100px 0; }
h1, h2, h3, h4, h5 { font-weight: 700; line-height: 1.2; color: var(--gray-900); }
a { color: inherit; text-decoration: none; }

/* ── BUTTONS ── */
.btn {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 12px 24px;
  font-family: var(--font); font-size: 15px; font-weight: 600;
  border-radius: var(--radius); cursor: pointer;
  transition: all 0.2s ease; border: none; text-decoration: none; line-height: 1.4;
}
.btn-primary {
  background: var(--gradient); color: var(--white);
  box-shadow: 0 2px 8px rgba(109,40,217,0.3);
}
.btn-primary:hover { opacity: 0.9; box-shadow: 0 4px 16px rgba(109,40,217,0.4); transform: translateY(-1px); }

.btn-outline {
  background: var(--white); color: var(--gray-700);
  border: 1px solid var(--gray-300); box-shadow: var(--shadow-sm);
}
.btn-outline:hover { background: var(--gray-50); border-color: var(--gray-400); transform: translateY(-1px); }

.btn-lg { padding: 14px 32px; font-size: 16px; border-radius: var(--radius-lg); }
.btn-sm { padding: 8px 16px; font-size: 13px; }

/* ── SECTION COMMONS ── */
.section-label {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 5px 14px;
  background: var(--primary-50); color: var(--primary-light);
  font-size: 13px; font-weight: 600;
  border-radius: var(--radius-full);
  margin-bottom: 16px; letter-spacing: 0.3px;
}
.section-title {
  font-size: clamp(30px, 4vw, 44px);
  letter-spacing: -0.8px; margin-bottom: 16px; max-width: 640px;
}
.section-title.center { text-align: center; margin-left: auto; margin-right: auto; }
.section-label.center { display: flex; justify-content: center; }
.section-desc {
  font-size: 18px; color: var(--gray-500);
  max-width: 560px; line-height: 1.7; margin-bottom: 56px;
}
.section-desc.center { text-align: center; margin-left: auto; margin-right: auto; }

/* ═══════ NAVBAR ═══════ */
.navbar {
  position: fixed; top: 0; left: 0; right: 0; z-index: 100;
  padding: 14px 0;
  background: rgba(255,255,255,0.85);
  backdrop-filter: blur(16px) saturate(1.5);
  border-bottom: 1px solid transparent;
  transition: border-color 0.3s, box-shadow 0.3s;
}
.navbar.scrolled { border-bottom-color: var(--gray-200); box-shadow: var(--shadow-sm); }

.navbar-inner { display: flex; align-items: center; justify-content: space-between; }

.navbar-brand {
  display: flex; align-items: center; gap: 10px;
  font-weight: 800; font-size: 19px; color: var(--gray-900);
  text-decoration: none; letter-spacing: -0.5px;
}
.navbar-logo {
  width: 36px; height: 36px;
  border-radius: var(--radius);
  overflow: hidden; flex-shrink: 0;
}
.navbar-logo img { width: 100%; height: 100%; object-fit: contain; }

.navbar-links { display: flex; align-items: center; gap: 32px; }
.navbar-links a { font-size: 14px; font-weight: 500; color: var(--gray-600); transition: color 0.2s; }
.navbar-links a:hover { color: var(--gray-900); }
.navbar-actions { display: flex; align-items: center; gap: 10px; }

/* ═══════ HERO ═══════ */
.hero {
  padding: 160px 0 100px;
  background: linear-gradient(180deg, var(--white) 0%, var(--gray-50) 100%);
  position: relative; overflow: hidden;
}

#networkCanvas {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  pointer-events: none;
  z-index: 0;
}

.hero::before {
  content: ''; position: absolute;
  top: -200px; right: -200px; width: 700px; height: 700px;
  background: radial-gradient(circle, rgba(6,182,212,0.06) 0%, transparent 65%);
  pointer-events: none; z-index: 0;
}
.hero::after {
  content: ''; position: absolute;
  bottom: -100px; left: -100px; width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(217,70,239,0.05) 0%, transparent 65%);
  pointer-events: none; z-index: 0;
}

.hero-inner { position: relative; z-index: 1; text-align: center; max-width: 800px; margin: 0 auto; }

.hero-badge {
  display: inline-flex; align-items: center; gap: 8px;
  padding: 6px 16px 6px 6px;
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-full);
  font-size: 13px; font-weight: 500; color: var(--gray-600);
  margin-bottom: 28px; box-shadow: var(--shadow-sm);
}
.hero-badge-icon {
  width: 26px; height: 26px;
  background: var(--success-light); color: var(--success);
  border-radius: 50%; display: grid; place-items: center;
}

.hero h1 {
  font-size: clamp(40px, 5.5vw, 64px); font-weight: 800;
  letter-spacing: -2px; line-height: 1.08; margin-bottom: 24px;
}
.hero h1 .text-primary { background: var(--gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }

.hero-sub {
  font-size: 19px; color: var(--gray-500);
  max-width: 580px; margin: 0 auto 40px; line-height: 1.7;
}

.hero-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-bottom: 32px; }

.hero-install {
  display: inline-flex; align-items: center; gap: 12px;
  background: var(--gray-900); color: var(--gray-400);
  border-radius: var(--radius); padding: 12px 20px;
  font-family: var(--mono); font-size: 13px;
  cursor: pointer; transition: all 0.2s; box-shadow: var(--shadow-lg);
}
.hero-install:hover { background: var(--gray-800); }
.hero-install code { color: var(--gray-100); }
.hero-install .copy-btn {
  display: flex; align-items: center; gap: 4px;
  font-family: var(--font); font-size: 11px; color: var(--gray-500);
  padding: 3px 10px; background: rgba(255,255,255,0.08);
  border-radius: 4px; font-weight: 500; transition: all 0.2s;
}

/* ── POWERED BY BAR ── */
.powered-bar {
  display: flex; align-items: center; justify-content: center; gap: 24px;
  margin-top: 40px; flex-wrap: wrap;
}
.powered-chip {
  display: inline-flex; align-items: center; gap: 6px;
  padding: 6px 14px;
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: var(--radius-full);
  font-size: 13px; font-weight: 600;
  color: var(--gray-500);
  box-shadow: var(--shadow-sm);
}
.powered-chip .i { color: var(--gray-400); }

/* ── HERO MOCKUP ── */
.hero-mockup {
  margin-top: 64px;
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-xl); overflow: hidden;
  box-shadow: var(--shadow-2xl), 0 0 0 1px rgba(0,0,0,0.03);
  max-width: 820px; margin-left: auto; margin-right: auto;
}
.mockup-bar {
  display: flex; align-items: center; gap: 8px;
  padding: 12px 16px; background: var(--gray-50);
  border-bottom: 1px solid var(--gray-200);
}
.mockup-dot { width: 12px; height: 12px; border-radius: 50%; background: var(--gray-300); }
.mockup-dot.r { background: #f87171; }
.mockup-dot.y { background: #fbbf24; }
.mockup-dot.g { background: #34d399; }
.mockup-url {
  flex: 1; text-align: center; font-size: 12px;
  color: var(--gray-400); font-family: var(--mono);
}

.mockup-body { display: grid; grid-template-columns: 200px 1fr; min-height: 340px; }

.mockup-sidebar {
  border-right: 1px solid var(--gray-200);
  padding: 16px 0; background: var(--gray-50);
}
.sidebar-item {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 16px; font-size: 13px; font-weight: 500;
  color: var(--gray-500); cursor: default; transition: all 0.15s;
}
.sidebar-item:hover { background: var(--gray-100); color: var(--gray-700); }
.sidebar-item.active {
  background: var(--primary-50); color: var(--primary);
  border-right: 2px solid var(--primary);
}

.mockup-main { padding: 24px; }
.mockup-main-header {
  display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;
}
.mockup-main-header h4 { font-size: 15px; font-weight: 700; }
.mockup-status {
  display: flex; align-items: center; gap: 6px;
  font-size: 12px; font-weight: 600; color: var(--success);
  padding: 4px 10px; background: var(--success-light);
  border-radius: var(--radius-full);
}
.mockup-status-dot {
  width: 7px; height: 7px; background: var(--success);
  border-radius: 50%; animation: blink 2s infinite;
}
@keyframes blink { 0%,100% { opacity:1; } 50% { opacity:0.3; } }

.chat-bubble {
  max-width: 82%; padding: 12px 16px; border-radius: 12px;
  font-size: 13px; line-height: 1.55; margin-bottom: 12px;
}
.chat-bubble.caller {
  background: var(--gray-100); color: var(--gray-700);
  margin-left: auto; border-bottom-right-radius: 4px;
}
.chat-bubble.agent {
  background: var(--primary-50); color: var(--gray-800);
  border: 1px solid var(--primary-100); border-bottom-left-radius: 4px;
}
.chat-label {
  font-size: 10px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1px; margin-bottom: 6px;
  display: flex; align-items: center; gap: 5px;
}
.chat-bubble.caller .chat-label { color: var(--gray-400); justify-content: flex-end; }
.chat-bubble.agent .chat-label { color: var(--primary); }

.audio-wave { display: flex; align-items: center; gap: 2px; margin-top: 8px; }
.audio-wave span {
  width: 3px; border-radius: 3px; background: var(--primary-light);
  animation: wave 1.2s ease-in-out infinite;
}
.audio-wave span:nth-child(1) { height: 6px; animation-delay: 0s; }
.audio-wave span:nth-child(2) { height: 12px; animation-delay: 0.12s; }
.audio-wave span:nth-child(3) { height: 8px; animation-delay: 0.24s; }
.audio-wave span:nth-child(4) { height: 16px; animation-delay: 0.36s; }
.audio-wave span:nth-child(5) { height: 10px; animation-delay: 0.48s; }
.audio-wave span:nth-child(6) { height: 6px; animation-delay: 0.6s; }
.audio-wave span:nth-child(7) { height: 12px; animation-delay: 0.72s; }
@keyframes wave {
  0%,100% { transform: scaleY(1); opacity: 0.4; }
  50% { transform: scaleY(1.8); opacity: 1; }
}

/* ═══════ TRUST ═══════ */
.trust-bar { padding: 60px 0; border-bottom: 1px solid var(--gray-100); }
.trust-bar p {
  text-align: center; font-size: 12px; font-weight: 600;
  text-transform: uppercase; letter-spacing: 2px;
  color: var(--gray-400); margin-bottom: 28px;
}
.trust-logos {
  display: flex; justify-content: center; align-items: center;
  gap: 48px; flex-wrap: wrap;
}
.trust-logos span { font-size: 15px; font-weight: 700; color: var(--gray-300); letter-spacing: 0.5px; }

/* ═══════ FEATURES ═══════ */
#features { background: var(--white); }
.features-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }

.feature-card {
  padding: 32px 28px; background: var(--white);
  border: 1px solid var(--gray-200); border-radius: var(--radius-lg);
  transition: all 0.25s ease;
}
.feature-card:hover { border-color: var(--gray-300); box-shadow: var(--shadow-lg); transform: translateY(-4px); }

.feature-card.highlighted {
  background: linear-gradient(135deg, var(--primary-50) 0%, var(--accent-50) 100%);
  border-color: var(--primary-100);
}
.feature-card.highlighted:hover { border-color: var(--primary-light); }

.feature-icon-wrap {
  width: 44px; height: 44px; border-radius: var(--radius);
  background: var(--gray-100); border: 1px solid var(--gray-200);
  display: grid; place-items: center; color: var(--gray-600); margin-bottom: 20px;
}
.feature-card.highlighted .feature-icon-wrap {
  background: var(--gradient); border-color: transparent; color: var(--white);
}

.feature-card h3 {
  font-size: 16px; font-weight: 700; margin-bottom: 8px;
  display: flex; align-items: center; gap: 8px;
}
.badge-new {
  padding: 2px 8px; background: var(--primary); color: var(--white);
  font-size: 10px; font-weight: 700; border-radius: var(--radius-full);
  letter-spacing: 0.5px; text-transform: uppercase;
}
.feature-card p { font-size: 14px; color: var(--gray-500); line-height: 1.65; }

/* ═══════ AI SECTION ═══════ */
#ai { background: var(--gray-50); border-top: 1px solid var(--gray-100); border-bottom: 1px solid var(--gray-100); }
.ai-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 64px; align-items: center; }
.ai-content .section-label { background: var(--accent-50); color: var(--accent); }

.ai-features-list { list-style: none; display: flex; flex-direction: column; gap: 14px; margin-top: 32px; }
.ai-features-list li {
  display: flex; align-items: flex-start; gap: 12px;
  font-size: 15px; color: var(--gray-600); line-height: 1.55;
}
.ai-features-list li .li-icon {
  width: 22px; height: 22px; min-width: 22px;
  background: var(--accent-50); color: var(--accent);
  border-radius: 6px; display: grid; place-items: center; margin-top: 1px;
}

.ai-diagram-card {
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-xl); padding: 32px; box-shadow: var(--shadow-lg);
}
.ai-flow-chain { display: flex; align-items: center; gap: 6px; margin-bottom: 20px; }
.ai-flow-step {
  flex: 1; text-align: center; padding: 14px 10px;
  background: var(--gray-50); border: 1px solid var(--gray-200); border-radius: var(--radius);
}
.ai-flow-step.ai-step { background: var(--accent-50); border-color: rgba(124,58,237,0.2); }
.ai-flow-step-icon { display: grid; place-items: center; margin: 0 auto 6px; color: var(--gray-500); }
.ai-flow-step.ai-step .ai-flow-step-icon { color: var(--accent); }
.ai-flow-step-name { font-size: 12px; font-weight: 700; color: var(--gray-700); }
.ai-flow-step-detail { font-size: 10px; color: var(--gray-400); margin-top: 2px; }
.ai-flow-step.ai-step .ai-flow-step-name { color: var(--accent); }
.ai-flow-arrow { color: var(--gray-300); flex-shrink: 0; }

.ai-duplex-bar {
  display: flex; align-items: center; gap: 8px;
  padding: 10px 14px; background: var(--success-light);
  border-radius: var(--radius); font-size: 12px; font-weight: 600;
  color: var(--success); margin-bottom: 20px;
}
.ai-voices-wrap { display: flex; flex-wrap: wrap; gap: 6px; }
.ai-voice {
  padding: 4px 12px; background: var(--gray-50);
  border: 1px solid var(--gray-200); border-radius: var(--radius-full);
  font-size: 12px; font-weight: 500; color: var(--gray-500);
}

/* ═══════ ARCHITECTURE ═══════ */
#architecture { background: var(--white); }
.arch-card {
  background: var(--gray-900); border-radius: var(--radius-xl);
  padding: 48px; color: var(--white); position: relative; overflow: hidden;
}
.arch-card::after {
  content: ''; position: absolute; top: -100px; right: -100px;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%);
  pointer-events: none;
}
.arch-label-dark {
  font-family: var(--mono); font-size: 12px; color: var(--primary-light);
  margin-bottom: 28px; display: flex; align-items: center; gap: 6px;
}
.arch-grid {
  display: grid; grid-template-columns: repeat(4, 1fr);
  gap: 10px; position: relative; z-index: 1;
}
.arch-node {
  background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);
  border-radius: var(--radius); padding: 16px 14px; text-align: center; transition: all 0.2s;
}
.arch-node:hover { background: rgba(255,255,255,0.1); }
.arch-node.span-2 { grid-column: span 2; }
.arch-node.span-4 { grid-column: span 4; }
.arch-node.ai-node { border-color: rgba(124,58,237,0.35); background: rgba(124,58,237,0.08); }
.arch-node.base-node { border-color: rgba(37,99,235,0.3); background: rgba(37,99,235,0.06); }
.arch-node-port { font-family: var(--mono); font-size: 11px; color: var(--primary-light); margin-bottom: 4px; }
.arch-node.ai-node .arch-node-port { color: var(--accent-light); }
.arch-node-name { font-size: 13px; font-weight: 700; color: var(--white); margin-bottom: 2px; }
.arch-node-detail { font-size: 11px; color: rgba(255,255,255,0.4); }

/* ═══════ PRICING ═══════ */
#pricing { background: var(--gray-50); border-top: 1px solid var(--gray-100); }

.pricing-community {
  max-width: 720px;
  margin: 0 auto 48px;
}

.pricing-card {
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-xl); padding: 40px 32px;
  position: relative; transition: all 0.3s;
}
.pricing-card:hover { box-shadow: var(--shadow-xl); transform: translateY(-4px); }

.pricing-community-inner {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
}

.pricing-tier {
  font-size: 13px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1.5px; color: var(--gray-400); margin-bottom: 12px;
}
.pricing-price {
  font-size: 40px; font-weight: 800; color: var(--gray-900); letter-spacing: -1.5px; margin-bottom: 8px;
}
.pricing-price .price-unit {
  font-size: 16px; font-weight: 500; color: var(--gray-400); letter-spacing: 0;
}
.pricing-desc { font-size: 14px; color: var(--gray-500); line-height: 1.6; margin-bottom: 28px; }
.pricing-divider { height: 1px; background: var(--gray-200); margin-bottom: 24px; }
.pricing-group-label {
  font-size: 11px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1.2px; color: var(--gray-400);
  margin-bottom: 12px; margin-top: 20px;
}
.pricing-group-label:first-of-type { margin-top: 0; }

.pricing-list {
  list-style: none; display: flex; flex-direction: column; gap: 10px; margin-bottom: 32px;
}
.pricing-list li {
  display: flex; align-items: flex-start; gap: 10px;
  font-size: 14px; color: var(--gray-600); line-height: 1.5;
}
.pricing-list li .i { margin-top: 1px; }
.pricing-list li .icon-check { color: var(--success); }
.pricing-list li .icon-x { color: var(--gray-300); }
.pricing-list li.disabled { color: var(--gray-400); }

.pricing-btn {
  display: block; width: 100%; padding: 13px; border-radius: var(--radius);
  font-family: var(--font); font-size: 15px; font-weight: 600;
  text-align: center; cursor: pointer; transition: all 0.2s; border: none;
}
.pricing-btn-outline { background: var(--white); color: var(--gray-700); border: 1px solid var(--gray-300); }
.pricing-btn-outline:hover { background: var(--gray-50); border-color: var(--gray-400); }
.pricing-btn-primary { background: var(--gradient); color: var(--white); box-shadow: 0 2px 8px rgba(109,40,217,0.25); }
.pricing-btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }
.pricing-btn-accent { background: var(--gradient); color: var(--white); box-shadow: 0 2px 8px rgba(109,40,217,0.25); }
.pricing-btn-accent:hover { opacity: 0.9; transform: translateY(-1px); }

/* Services grid */
.services-subtitle {
  text-align: center;
  font-size: 13px; font-weight: 700;
  text-transform: uppercase; letter-spacing: 2px;
  color: var(--gray-400);
  margin-bottom: 24px;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 20px;
  max-width: 1000px;
  margin: 0 auto;
}

.service-card {
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius-xl); padding: 32px 28px;
  position: relative; transition: all 0.3s;
  display: flex; flex-direction: column;
}
.service-card:hover { box-shadow: var(--shadow-xl); transform: translateY(-4px); }

.service-card.primary-border {
  border-color: var(--primary);
  box-shadow: 0 0 0 1px var(--primary), var(--shadow-md);
}

.service-icon {
  width: 48px; height: 48px;
  border-radius: var(--radius);
  display: grid; place-items: center;
  margin-bottom: 20px;
}
.service-icon.blue { background: var(--primary-50); color: var(--primary); }
.service-icon.purple { background: var(--accent-50); color: var(--accent); }
.service-icon.green { background: var(--success-light); color: var(--success); }
.service-icon.orange { background: #fff7ed; color: #ea580c; }

.service-card h3 { font-size: 18px; font-weight: 700; margin-bottom: 4px; }
.service-card .service-price {
  font-size: 28px; font-weight: 800; color: var(--gray-900);
  letter-spacing: -1px; margin-bottom: 4px;
}
.service-card .service-price .unit {
  font-size: 14px; font-weight: 500; color: var(--gray-400); letter-spacing: 0;
}
.service-card .service-from {
  font-size: 12px; color: var(--gray-400); font-weight: 500; margin-bottom: 16px;
}
.service-card .service-desc {
  font-size: 14px; color: var(--gray-500); line-height: 1.6; margin-bottom: 20px; flex: 1;
}

.service-features {
  list-style: none; display: flex; flex-direction: column; gap: 8px; margin-bottom: 24px;
}
.service-features li {
  display: flex; align-items: flex-start; gap: 8px;
  font-size: 13px; color: var(--gray-600); line-height: 1.5;
}
.service-features li .i { margin-top: 1px; }

/* ═══════ STACK ═══════ */
#stack { background: var(--white); border-top: 1px solid var(--gray-100); }
.stack-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 12px; }
.stack-item {
  text-align: center; padding: 24px 12px;
  background: var(--white); border: 1px solid var(--gray-200);
  border-radius: var(--radius); transition: all 0.2s;
}
.stack-item:hover { border-color: var(--gray-300); box-shadow: var(--shadow-md); }
.stack-item.ai-item { border-color: rgba(124,58,237,0.2); background: var(--accent-50); }
.stack-item.asterisk-item { border-color: rgba(37,99,235,0.2); background: var(--primary-50); }
.stack-name { font-size: 14px; font-weight: 700; color: var(--gray-800); margin-bottom: 2px; }
.stack-ver { font-family: var(--mono); font-size: 12px; color: var(--gray-400); }

/* ═══════ CTA ═══════ */
.cta-section {
  padding: 100px 0; text-align: center;
  background: linear-gradient(180deg, var(--gray-50) 0%, var(--white) 100%);
  border-top: 1px solid var(--gray-100);
}
.cta-section h2 { font-size: clamp(30px, 4vw, 46px); letter-spacing: -1px; margin-bottom: 16px; }
.cta-section p { font-size: 18px; color: var(--gray-500); margin-bottom: 36px; }

/* ═══════ FOOTER ═══════ */
footer { background: var(--gray-900); color: var(--gray-400); padding: 64px 0 40px; }
.footer-grid { display: flex; justify-content: space-between; gap: 40px; flex-wrap: wrap; margin-bottom: 48px; }
.footer-brand-text { max-width: 280px; font-size: 13px; line-height: 1.7; color: var(--gray-500); margin-top: 16px; }
.footer-brand .navbar-brand { color: var(--white); }
.footer-cols { display: flex; gap: 64px; }
.footer-col h5 {
  font-size: 12px; font-weight: 700; text-transform: uppercase;
  letter-spacing: 1.5px; color: var(--gray-500); margin-bottom: 16px;
}
.footer-col a { display: block; font-size: 14px; color: var(--gray-400); margin-bottom: 10px; transition: color 0.2s; }
.footer-col a:hover { color: var(--white); }
.footer-bottom {
  padding-top: 24px; border-top: 1px solid rgba(255,255,255,0.08);
  display: flex; justify-content: space-between; align-items: center;
  font-size: 13px; color: var(--gray-600);
}

/* ═══════ RESPONSIVE ═══════ */
@media (max-width: 1000px) {
  .ai-grid { grid-template-columns: 1fr; }
  .mockup-body { grid-template-columns: 1fr; }
  .mockup-sidebar { display: none; }
}
@media (max-width: 900px) {
  .features-grid { grid-template-columns: 1fr 1fr; }
  .services-grid { grid-template-columns: 1fr; max-width: 440px; }
  .pricing-community-inner { grid-template-columns: 1fr; }
  .arch-grid { grid-template-columns: repeat(2, 1fr); }
  .arch-node.span-4 { grid-column: span 2; }
  .navbar-links { display: none; }
  .footer-cols { gap: 40px; }
}
@media (max-width: 600px) {
  .features-grid { grid-template-columns: 1fr; }
  .arch-grid { grid-template-columns: 1fr; }
  .arch-node.span-2, .arch-node.span-4 { grid-column: span 1; }
  .arch-card { padding: 24px; }
  section { padding: 72px 0; }
  .footer-grid { flex-direction: column; }
  .footer-bottom { flex-direction: column; gap: 12px; text-align: center; }
  .ai-flow-chain { flex-direction: column; }
  .ai-flow-arrow { transform: rotate(90deg); }
  .hero { padding: 130px 0 72px; }
  .powered-bar { gap: 12px; }
}

@keyframes fade-up {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.hero-inner > * { animation: fade-up 0.6s ease-out backwards; }
.hero-inner > *:nth-child(1) { animation-delay: 0.05s; }
.hero-inner > *:nth-child(2) { animation-delay: 0.12s; }
.hero-inner > *:nth-child(3) { animation-delay: 0.19s; }
.hero-inner > *:nth-child(4) { animation-delay: 0.26s; }
.hero-inner > *:nth-child(5) { animation-delay: 0.33s; }
.hero-inner > *:nth-child(6) { animation-delay: 0.4s; }
.hero-inner > *:nth-child(7) { animation-delay: 0.47s; }
.hero-mockup { animation: fade-up 0.7s ease-out 0.5s backwards; }
</style>
</head>
<body>

<!-- ═══════════════════════════════════
     SVG ICON SPRITES (hidden)
     ═══════════════════════════════════ -->
<svg xmlns="http://www.w3.org/2000/svg" style="display:none">
  <symbol id="ico-phone-call" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></symbol>
  <symbol id="ico-check" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></symbol>
  <symbol id="ico-x" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></symbol>
  <symbol id="ico-download" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></symbol>
  <symbol id="ico-sparkles" viewBox="0 0 24 24"><path d="M12 3l1.912 5.813a2 2 0 001.275 1.275L21 12l-5.813 1.912a2 2 0 00-1.275 1.275L12 21l-1.912-5.813a2 2 0 00-1.275-1.275L3 12l5.813-1.912a2 2 0 001.275-1.275L12 3z"/></symbol>
  <symbol id="ico-copy" viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1"/></symbol>
  <symbol id="ico-layers" viewBox="0 0 24 24"><polygon points="12 2 2 7 12 12 22 7 12 2"/><polyline points="2 17 12 22 22 17"/><polyline points="2 12 12 17 22 12"/></symbol>
  <symbol id="ico-phone" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></symbol>
  <symbol id="ico-git-branch" viewBox="0 0 24 24"><line x1="6" y1="3" x2="6" y2="15"/><circle cx="18" cy="6" r="3"/><circle cx="6" cy="18" r="3"/><path d="M18 9a9 9 0 01-9 9"/></symbol>
  <symbol id="ico-bot" viewBox="0 0 24 24"><path d="M12 8V4H8"/><rect x="2" y="8" width="20" height="14" rx="2"/><path d="M6 18h.01M18 18h.01M9 13a3 3 0 106 0"/></symbol>
  <symbol id="ico-headphones" viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0118 0v6"/><path d="M21 19a2 2 0 01-2 2h-1a2 2 0 01-2-2v-3a2 2 0 012-2h3zM3 19a2 2 0 002 2h1a2 2 0 002-2v-3a2 2 0 00-2-2H3z"/></symbol>
  <symbol id="ico-bar-chart" viewBox="0 0 24 24"><line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/></symbol>
  <symbol id="ico-shield-check" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></symbol>
  <symbol id="ico-audio-lines" viewBox="0 0 24 24"><path d="M2 10v3M6 6v11M10 3v18M14 8v7M18 5v13M22 10v3"/></symbol>
  <symbol id="ico-music" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></symbol>
  <symbol id="ico-users" viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></symbol>
  <symbol id="ico-arrow-lr" viewBox="0 0 24 24"><polyline points="7 17 2 12 7 7"/><polyline points="17 7 22 12 17 17"/><line x1="2" y1="12" x2="22" y2="12"/></symbol>
  <symbol id="ico-mic" viewBox="0 0 24 24"><path d="M12 2a3 3 0 00-3 3v7a3 3 0 006 0V5a3 3 0 00-3-3z"/><path d="M19 10v2a7 7 0 01-14 0v-2M12 19v3"/></symbol>
  <symbol id="ico-database" viewBox="0 0 24 24"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></symbol>
  <symbol id="ico-phone-off" viewBox="0 0 24 24"><path d="M10.68 13.31a16 16 0 003.41 2.6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.42 19.42 0 01-3.33-2.67M14.68 14.68L2 2"/><path d="M4.22 8.49a19.42 19.42 0 01-2.1-6.31A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91"/></symbol>
  <symbol id="ico-file-text" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></symbol>
  <symbol id="ico-wallet" viewBox="0 0 24 24"><path d="M21 12V7H5a2 2 0 010-4h14v4"/><path d="M3 5v14a2 2 0 002 2h16v-5"/><path d="M18 12a2 2 0 000 4h4v-4z"/></symbol>
  <symbol id="ico-phone-incoming" viewBox="0 0 24 24"><polyline points="16 2 16 8 22 8"/><line x1="23" y1="1" x2="16" y2="8"/><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"/></symbol>
  <symbol id="ico-server" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="8" rx="2" ry="2"/><rect x="2" y="14" width="20" height="8" rx="2" ry="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></symbol>
  <symbol id="ico-cpu" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></symbol>
  <symbol id="ico-brain" viewBox="0 0 24 24"><path d="M9.5 2A2.5 2.5 0 0112 4.5v15a2.5 2.5 0 01-4.96.44 2.5 2.5 0 01-2.96-3.08 3 3 0 01-.34-5.58 2.5 2.5 0 011.32-4.24 2.5 2.5 0 011.98-3A2.5 2.5 0 019.5 2z"/><path d="M14.5 2A2.5 2.5 0 0012 4.5v15a2.5 2.5 0 004.96.44 2.5 2.5 0 002.96-3.08 3 3 0 00.34-5.58 2.5 2.5 0 00-1.32-4.24 2.5 2.5 0 00-1.98-3A2.5 2.5 0 0014.5 2z"/></symbol>
  <symbol id="ico-chevron-right" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></symbol>
  <symbol id="ico-repeat" viewBox="0 0 24 24"><polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 014-4h14"/><polyline points="7 23 3 19 7 15"/><path d="M21 13v2a4 4 0 01-4 4H3"/></symbol>
  <symbol id="ico-terminal" viewBox="0 0 24 24"><polyline points="4 17 10 11 4 5"/><line x1="12" y1="19" x2="20" y2="19"/></symbol>
  <symbol id="ico-box" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></symbol>
  <symbol id="ico-credit-card" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></symbol>
  <symbol id="ico-mail" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></symbol>
  <symbol id="ico-layout-dashboard" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="9"/><rect x="14" y="3" width="7" height="5"/><rect x="14" y="12" width="7" height="9"/><rect x="3" y="16" width="7" height="5"/></symbol>
  <symbol id="ico-list" viewBox="0 0 24 24"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></symbol>
  <symbol id="ico-shield" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></symbol>
  <symbol id="ico-settings" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06A1.65 1.65 0 004.68 15a1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06A1.65 1.65 0 009 4.68a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06A1.65 1.65 0 0019.32 9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z"/></symbol>
  <symbol id="ico-user" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></symbol>
  <symbol id="ico-zap" viewBox="0 0 24 24"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></symbol>
  <symbol id="ico-cloud" viewBox="0 0 24 24"><path d="M18 10h-1.26A8 8 0 109 20h9a5 5 0 000-10z"/></symbol>
</svg>

<!-- ═══════ NAVBAR ═══════ -->
<nav class="navbar" id="navbar">
  <div class="container navbar-inner">
    <a href="/" class="navbar-brand">
      <div class="navbar-logo"><img src="/images/logo.png" alt="Voxa Center"></div>
      Voxa Center
    </a>
    <div class="navbar-links">
      <a href="#features">Fonctionnalités</a>
      <a href="#ai">Agent IA</a>
      <a href="#architecture">Architecture</a>
      <a href="#pricing">Tarifs</a>
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank">GitHub</a>
    </div>
    <div class="navbar-actions">
      <a href="#pricing" class="btn btn-outline btn-sm">Voir les tarifs</a>
      <a href="/nous-contacter" class="btn btn-primary btn-sm">Nous contacter</a>
    </div>
  </div>
</nav>

<!-- ═══════ HERO ═══════ -->
<section class="hero">
  <canvas id="networkCanvas"></canvas>
  <div class="container">
    <div class="hero-inner">
      <div class="hero-badge">
        <span class="hero-badge-icon"><span class="i i-sm" style="color:var(--success)"><svg><use href="#ico-check"/></svg></span></span>
        Open source · Installation en 5 minutes · Propulsé par Asterisk
      </div>

      <h1>La téléphonie VoIP <span class="text-primary">simplifiée</span>,<br>avec une touche d'IA</h1>

      <p class="hero-sub">Voxa Center rend la VoIP accessible à tous. Dessinez vos scénarios d'appels en drag & drop, gérez vos lignes en quelques clics — sans jamais toucher un fichier de config.</p>

      <div class="hero-actions">
        <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn btn-primary btn-lg">
          <span class="i"><svg><use href="#ico-download"/></svg></span>
          Commencer gratuitement
        </a>
        <a href="#features" class="btn btn-outline btn-lg">
          <span class="i"><svg><use href="#ico-layers"/></svg></span>
          Voir les fonctionnalités
        </a>
      </div>

      <div class="hero-install" id="installCmd">
        <span style="color:var(--gray-500)">$</span>
        <code>curl -sSL https://raw.githubusercontent.com/grevoka/Voxa.center.app/main/install.sh | bash</code>
        <span class="copy-btn" id="copyBtn">
          <span class="i i-xs"><svg><use href="#ico-copy"/></svg></span> Copier
        </span>
      </div>

      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="github-link" style="display:inline-flex;align-items:center;gap:8px;margin-top:16px;font-size:14px;font-weight:600;color:var(--gray-500);transition:color 0.2s;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
        Voir sur GitHub
      </a>

      <div class="powered-bar">
        <div class="powered-chip">
          <span class="i i-sm"><svg><use href="#ico-zap"/></svg></span>
          Propulsé par Asterisk 20
        </div>
        <div class="powered-chip">
          <span class="i i-sm"><svg><use href="#ico-bot"/></svg></span>
          Agent IA en option
        </div>
        <div class="powered-chip">
          <span class="i i-sm"><svg><use href="#ico-shield"/></svg></span>
          Debian & Ubuntu
        </div>
      </div>
    </div>

    <!-- MOCKUP — VISUAL CALL FLOW EDITOR -->
    <div class="hero-mockup">
      <div class="mockup-bar">
        <span class="mockup-dot r"></span>
        <span class="mockup-dot y"></span>
        <span class="mockup-dot g"></span>
        <span class="mockup-url">voxa.example.com/callflows/edit/3</span>
      </div>
      <div class="mockup-body">
        <div class="mockup-sidebar">
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-layout-dashboard"/></svg></span> Dashboard</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-phone"/></svg></span> Lignes SIP</div>
          <div class="sidebar-item active"><span class="i i-sm"><svg><use href="#ico-git-branch"/></svg></span> Scénarios</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-bot"/></svg></span> Agent IA</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-list"/></svg></span> Journal CDR</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-headphones"/></svg></span> Softphone</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-shield"/></svg></span> Firewall</div>
          <div class="sidebar-item"><span class="i i-sm"><svg><use href="#ico-settings"/></svg></span> Paramètres</div>
        </div>
        <div class="mockup-main" style="background:var(--gray-50); padding:20px; position:relative; overflow:hidden;">
          <div class="mockup-main-header" style="margin-bottom:16px;">
            <h4>Scénario — Accueil principal</h4>
            <div style="display:flex;gap:8px;">
              <div style="padding:4px 10px; background:var(--white); border:1px solid var(--gray-200); border-radius:6px; font-size:11px; font-weight:600; color:var(--gray-500); display:flex; align-items:center; gap:4px;">
                <span class="i i-xs"><svg><use href="#ico-zap"/></svg></span> Auto-save
              </div>
            </div>
          </div>
          <!-- Visual flow editor mockup -->
          <div style="position:relative; min-height:240px;">
            <!-- Connection lines (SVG) -->
            <svg style="position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:0;" viewBox="0 0 560 240">
              <path d="M95 40 L160 40" stroke="#cbd5e1" stroke-width="2" fill="none"/>
              <path d="M290 40 L355 40" stroke="#cbd5e1" stroke-width="2" fill="none"/>
              <path d="M420 55 L420 100 L160 100 L160 140" stroke="#cbd5e1" stroke-width="2" fill="none" stroke-dasharray="0"/>
              <path d="M420 55 L420 100 L420 140" stroke="#cbd5e1" stroke-width="2" fill="none"/>
              <circle cx="160" cy="40" r="3" fill="#cbd5e1"/>
              <circle cx="355" cy="40" r="3" fill="#cbd5e1"/>
              <circle cx="160" cy="140" r="3" fill="#cbd5e1"/>
              <circle cx="420" cy="140" r="3" fill="#cbd5e1"/>
            </svg>
            <!-- Block: Appel entrant -->
            <div style="position:absolute; top:18px; left:10px; width:85px; padding:10px; background:var(--white); border:2px solid var(--primary); border-radius:10px; text-align:center; box-shadow:0 2px 8px rgba(37,99,235,0.1); z-index:1;">
              <div style="margin:0 auto 4px; width:24px; height:24px; background:var(--primary-50); color:var(--primary); border-radius:6px; display:grid; place-items:center;">
                <span class="i i-xs"><svg><use href="#ico-phone-incoming"/></svg></span>
              </div>
              <div style="font-size:10px; font-weight:700; color:var(--gray-800);">Appel entrant</div>
            </div>
            <!-- Block: Horaires -->
            <div style="position:absolute; top:10px; left:165px; width:120px; padding:10px; background:var(--white); border:1px solid var(--gray-200); border-radius:10px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.04); z-index:1;">
              <div style="display:flex; justify-content:center; gap:4px; margin-bottom:4px;">
                <div style="width:8px; height:8px; border-radius:50%; background:#22c55e;"></div>
                <div style="width:8px; height:8px; border-radius:50%; background:#ef4444;"></div>
              </div>
              <div style="font-size:10px; font-weight:700; color:var(--gray-800);">Horaires</div>
              <div style="font-size:9px; color:var(--gray-400);">Lun-Ven 9h-18h</div>
            </div>
            <!-- Block: IVR -->
            <div style="position:absolute; top:10px; left:360px; width:120px; padding:10px; background:var(--white); border:1px solid var(--gray-200); border-radius:10px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.04); z-index:1;">
              <div style="margin:0 auto 4px; width:24px; height:24px; background:#fff7ed; color:#ea580c; border-radius:6px; display:grid; place-items:center;">
                <span class="i i-xs"><svg><use href="#ico-list"/></svg></span>
              </div>
              <div style="font-size:10px; font-weight:700; color:var(--gray-800);">Menu IVR</div>
              <div style="font-size:9px; color:var(--gray-400);">1 → Ventes · 2 → Support</div>
            </div>
            <!-- Block: File d'attente (branch 1) -->
            <div style="position:absolute; top:120px; left:105px; width:110px; padding:10px; background:var(--white); border:1px solid var(--gray-200); border-radius:10px; text-align:center; box-shadow:0 2px 6px rgba(0,0,0,0.04); z-index:1;">
              <div style="margin:0 auto 4px; width:24px; height:24px; background:var(--success-light); color:var(--success); border-radius:6px; display:grid; place-items:center;">
                <span class="i i-xs"><svg><use href="#ico-users"/></svg></span>
              </div>
              <div style="font-size:10px; font-weight:700; color:var(--gray-800);">File d'attente</div>
              <div style="font-size:9px; color:var(--gray-400);">Équipe Ventes</div>
            </div>
            <!-- Block: Agent IA (branch 2) -->
            <div style="position:absolute; top:120px; left:360px; width:120px; padding:10px; background:linear-gradient(135deg, var(--accent-50), var(--primary-50)); border:1px solid rgba(124,58,237,0.2); border-radius:10px; text-align:center; box-shadow:0 2px 6px rgba(124,58,237,0.08); z-index:1;">
              <div style="margin:0 auto 4px; width:24px; height:24px; background:var(--accent-50); color:var(--accent); border-radius:6px; display:grid; place-items:center;">
                <span class="i i-xs"><svg><use href="#ico-bot"/></svg></span>
              </div>
              <div style="font-size:10px; font-weight:700; color:var(--accent);">Agent IA</div>
              <div style="font-size:9px; color:var(--gray-400);">Support · Coral</div>
            </div>
            <!-- Drag hint -->
            <div style="position:absolute; bottom:8px; right:12px; font-size:10px; color:var(--gray-400); display:flex; align-items:center; gap:4px; z-index:1;">
              <span class="i i-xs"><svg><use href="#ico-git-branch"/></svg></span> Glissez-déposez vos blocs
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ TRUST ═══════ -->
<div class="trust-bar">
  <div class="container">
    <p>Compatible avec vos opérateurs SIP</p>
    <div class="trust-logos">
      <span>OVH Telecom</span><span>Twilio</span><span>Vonage</span><span>Sipgate</span><span>Plivo</span><span>OpenAI</span>
    </div>
  </div>
</div>

<!-- ═══════ FEATURES ═══════ -->
<section id="features">
  <div class="container">
    <div class="section-label"><span class="i i-sm"><svg><use href="#ico-layers"/></svg></span> Fonctionnalités</div>
    <h2 class="section-title">Dessinez votre téléphonie,<br>oubliez les fichiers de config</h2>
    <p class="section-desc">Voxa Center remplace la complexité d'Asterisk par une interface visuelle. Glissez, connectez, c'est en production.</p>

    <div class="features-grid">
      <div class="feature-card highlighted">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-git-branch"/></svg></span></div>
        <h3>Scénarios d'appels visuels</h3>
        <p>Dessinez vos parcours d'appels en drag & drop : sonnerie, IVR, files d'attente, horaires, renvoi, Agent IA, synthèse vocale. Plus besoin d'écrire une seule ligne de config.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-phone"/></svg></span></div>
        <h3>Lignes & Trunks SIP</h3>
        <p>Créez vos lignes et connectez vos opérateurs en quelques clics. Proxy sortant, registration automatique, codecs configurables.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-headphones"/></svg></span></div>
        <h3>Softphone WebRTC</h3>
        <p>Téléphone intégré dans l'espace opérateur. Passez et recevez vos appels directement depuis le navigateur.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-bar-chart"/></svg></span></div>
        <h3>Dashboard & Monitoring</h3>
        <p>Statistiques sur 7 jours, supervision live des appels, journal CDR, appels manqués par poste, durée par opérateur.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-shield-check"/></svg></span></div>
        <h3>Firewall & Sécurité</h3>
        <p>Whitelist / blacklist IP, protection brute-force automatique, 3 modes de sécurité configurables, chiffrement SRTP/TLS.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-music"/></svg></span></div>
        <h3>Files, Conférences & MOH</h3>
        <p>Files d'attente configurables, salles de conférence, messagerie vocale avec notification email, musiques d'attente.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-audio-lines"/></svg></span></div>
        <h3>Synthèse vocale locale</h3>
        <p>Piper TTS avec 3 voix françaises. Preview audio directement dans l'éditeur de scénarios. Aucun cloud requis.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-users"/></svg></span></div>
        <h3>Opérateurs & Caller ID</h3>
        <p>Comptes opérateurs avec gestion des rôles, impersonation admin, numéros sortants et groupes d'accès par opérateur.</p>
      </div>
      <div class="feature-card">
        <div class="feature-icon-wrap"><span class="i"><svg><use href="#ico-bot"/></svg></span></div>
        <h3>Agent IA vocal</h3>
        <p>Ajoutez un agent conversationnel OpenAI Realtime dans vos scénarios. Full-duplex, 8 voix, guardrails, base de connaissances RAG.</p>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ AI SECTION ═══════ -->
<section id="ai">
  <div class="container">
    <div class="ai-grid">
      <div class="ai-content">
        <div class="section-label"><span class="i i-sm"><svg><use href="#ico-sparkles"/></svg></span> Aller plus loin</div>
        <h2 class="section-title">Ajoutez un agent vocal IA à vos scénarios</h2>
        <p class="section-desc" style="margin-bottom:0">En plus de la simplicité de l'éditeur visuel, intégrez un agent conversationnel OpenAI Realtime. Vos appelants dialoguent avec une IA vocale, comme avec un humain.</p>
        <ul class="ai-features-list">
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-arrow-lr"/></svg></span></span> Audio full-duplex — l'appelant peut interrompre l'IA naturellement</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-mic"/></svg></span></span> 8 voix : Coral, Alloy, Ash, Echo, Sage, Shimmer, Verse, Ballad</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-database"/></svg></span></span> Base de connaissances RAG — vos documents contextualisent l'agent</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-shield-check"/></svg></span></span> Guardrails automatiques — cadrage sujet, pas de divulgation IA</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-phone-off"/></svg></span></span> Détection de fin de conversation — raccrochage automatique</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-file-text"/></svg></span></span> Historique consultable — transcription complète et coût estimé</li>
          <li><span class="li-icon"><span class="i i-xs"><svg><use href="#ico-wallet"/></svg></span></span> Dashboard de facturation — suivi budget jour / semaine / mois</li>
        </ul>
      </div>
      <div>
        <div class="ai-diagram-card">
          <div class="ai-flow-chain">
            <div class="ai-flow-step">
              <div class="ai-flow-step-icon"><span class="i i-lg"><svg><use href="#ico-phone-incoming"/></svg></span></div>
              <div class="ai-flow-step-name">Appelant</div>
              <div class="ai-flow-step-detail">Téléphone SIP</div>
            </div>
            <div class="ai-flow-arrow"><span class="i"><svg><use href="#ico-chevron-right"/></svg></span></div>
            <div class="ai-flow-step">
              <div class="ai-flow-step-icon"><span class="i i-lg"><svg><use href="#ico-server"/></svg></span></div>
              <div class="ai-flow-step-name">Asterisk 20</div>
              <div class="ai-flow-step-detail">AudioSocket</div>
            </div>
            <div class="ai-flow-arrow"><span class="i"><svg><use href="#ico-chevron-right"/></svg></span></div>
            <div class="ai-flow-step ai-step">
              <div class="ai-flow-step-icon"><span class="i i-lg"><svg><use href="#ico-cpu"/></svg></span></div>
              <div class="ai-flow-step-name">voxa-ai</div>
              <div class="ai-flow-step-detail">Python bridge</div>
            </div>
            <div class="ai-flow-arrow"><span class="i"><svg><use href="#ico-chevron-right"/></svg></span></div>
            <div class="ai-flow-step ai-step">
              <div class="ai-flow-step-icon"><span class="i i-lg"><svg><use href="#ico-brain"/></svg></span></div>
              <div class="ai-flow-step-name">OpenAI</div>
              <div class="ai-flow-step-detail">Realtime API</div>
            </div>
          </div>
          <div class="ai-duplex-bar">
            <span class="i i-sm"><svg><use href="#ico-repeat"/></svg></span>
            Audio full-duplex bidirectionnel sur toute la chaîne
          </div>
          <div class="ai-voices-wrap">
            <span class="ai-voice">Coral</span><span class="ai-voice">Alloy</span><span class="ai-voice">Ash</span><span class="ai-voice">Echo</span><span class="ai-voice">Sage</span><span class="ai-voice">Shimmer</span><span class="ai-voice">Verse</span><span class="ai-voice">Ballad</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ ARCHITECTURE ═══════ -->
<section id="architecture">
  <div class="container">
    <div class="section-label"><span class="i i-sm"><svg><use href="#ico-box"/></svg></span> Architecture</div>
    <h2 class="section-title">Asterisk 20, installation native</h2>
    <p class="section-desc">Tous les services — y compris Asterisk compilé depuis les sources — tournent nativement sur votre serveur. Compatible Debian 12, Ubuntu 22.04 et 24.04.</p>
    <div class="arch-card">
      <div class="arch-label-dark"><span class="i i-sm"><svg><use href="#ico-terminal"/></svg></span> Serveur Debian 12 · Asterisk 20 PJSIP Realtime</div>
      <div class="arch-grid">
        <div class="arch-node span-2">
          <div class="arch-node-port">:443</div>
          <div class="arch-node-name">Nginx</div>
          <div class="arch-node-detail">HTTPS + WebSocket proxy</div>
        </div>
        <div class="arch-node span-2">
          <div class="arch-node-port">socket</div>
          <div class="arch-node-name">PHP 8.4-FPM</div>
          <div class="arch-node-detail">Laravel 13</div>
        </div>
        <div class="arch-node">
          <div class="arch-node-port">:5060</div>
          <div class="arch-node-name">Asterisk 20</div>
          <div class="arch-node-detail">PJSIP Realtime</div>
        </div>
        <div class="arch-node">
          <div class="arch-node-port">:3306</div>
          <div class="arch-node-name">MariaDB</div>
          <div class="arch-node-detail">10.11</div>
        </div>
        <div class="arch-node">
          <div class="arch-node-port">:6379</div>
          <div class="arch-node-name">Redis 7</div>
          <div class="arch-node-detail">Sessions & Cache</div>
        </div>
        <div class="arch-node">
          <div class="arch-node-port">:8088</div>
          <div class="arch-node-name">WebSocket</div>
          <div class="arch-node-detail">Softphone WebRTC</div>
        </div>
        <div class="arch-node span-2 ai-node">
          <div class="arch-node-port">:9092 localhost</div>
          <div class="arch-node-name">voxa-ai</div>
          <div class="arch-node-detail">AudioSocket — OpenAI Realtime (Python)</div>
        </div>
        <div class="arch-node span-2 ai-node">
          <div class="arch-node-port">/opt/piper</div>
          <div class="arch-node-name">Piper TTS</div>
          <div class="arch-node-detail">3 voix françaises · Synthèse locale</div>
        </div>
        <div class="arch-node span-4 base-node">
          <div class="arch-node-name">Systemd</div>
          <div class="arch-node-detail">Fail2ban · Let's Encrypt · Queue Worker · Cron · Services managés</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════ PRICING ═══════ -->
<section id="pricing">
  <div class="container">
    <div class="section-label center"><span class="i i-sm"><svg><use href="#ico-credit-card"/></svg></span> Tarifs</div>
    <h2 class="section-title center">Logiciel gratuit,<br>services professionnels</h2>
    <p class="section-desc center">Voxa Center est 100% gratuit avec toutes les fonctionnalités. Nos services payants vous accompagnent en production.</p>

    <!-- ── COMMUNITY (full access) ── -->
    <div class="pricing-community">
      <div class="pricing-card">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; flex-wrap:wrap; gap:12px;">
          <div>
            <div class="pricing-tier" style="margin-bottom:4px">Voxa Center</div>
            <div class="pricing-price">Gratuit <span class="price-unit">· Open source</span></div>
          </div>
          <button class="pricing-btn pricing-btn-primary" style="width:auto; padding:12px 28px;" onclick="window.open('https://github.com/grevoka/Voxa.center.app','_blank')">
            <span style="display:flex;align-items:center;gap:8px;">
              <span class="i i-sm" style="color:#fff"><svg><use href="#ico-download"/></svg></span>
              Installer maintenant
            </span>
          </button>
        </div>
        <p class="pricing-desc" style="margin-bottom:24px">Toutes les fonctionnalités incluses, sans restriction. Auto-hébergé sur votre serveur Debian/Ubuntu.</p>
        <div class="pricing-divider"></div>
        <div class="pricing-community-inner">
          <div>
            <div class="pricing-group-label">Téléphonie</div>
            <ul class="pricing-list" style="margin-bottom:0">
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Lignes & Trunks SIP illimités</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Éditeur visuel de scénarios</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Files d'attente & Conférences</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Messagerie vocale + email SMTP</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Firewall SIP & Fail2ban</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Dashboard, CDR & Supervision live</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Console Asterisk intégrée</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Multi-langue FR / EN</li>
            </ul>
          </div>
          <div>
            <div class="pricing-group-label">IA & Avancé</div>
            <ul class="pricing-list" style="margin-bottom:0">
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Agent IA OpenAI Realtime</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Base de connaissances RAG</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Historique IA & facturation</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Piper TTS — synthèse vocale locale</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Softphone WebRTC intégré</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Opérateurs RBAC & Caller ID</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Enregistrement d'appels</li>
              <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Installation automatique 1 clic</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- ── SERVICES PAYANTS ── -->
    <div class="services-subtitle">Services professionnels</div>

    <div class="services-grid">
      <!-- HÉBERGEMENT -->
      <div class="service-card primary-border">
        <div class="service-icon orange"><span class="i i-lg"><svg><use href="#ico-cloud"/></svg></span></div>
        <h3>Hébergement clé en main</h3>
        <div class="service-price">29,90 € <span class="unit">HT / mois</span></div>
        <div class="service-from">À partir de</div>
        <p class="service-desc">Nous hébergeons et maintenons Voxa Center pour vous. Vous n'avez rien à installer ni à administrer.</p>
        <ul class="service-features">
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Serveur dédié & infogéré</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Voxa Center préinstallé et prêt à l'emploi</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Certificats SSL & sauvegardes automatiques</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Mises à jour & maintenance incluses</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Disponibilité garantie 99.9%</li>
        </ul>
        <a href="/nous-contacter" class="pricing-btn pricing-btn-primary" style="text-decoration:none">Choisir l'hébergement</a>
      </div>

      <!-- SUIVI & SUPPORT -->
      <div class="service-card">
        <div class="service-icon blue"><span class="i i-lg"><svg><use href="#ico-headphones"/></svg></span></div>
        <h3>Support & Suivi</h3>
        <div class="service-price">250 € <span class="unit">HT / mois</span></div>
        <div class="service-from">À partir de</div>
        <p class="service-desc">Forfait de suivi technique mensuel pour votre installation Voxa Center en production.</p>
        <ul class="service-features">
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Support technique prioritaire</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Monitoring & alertes proactives</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Mises à jour & patchs de sécurité</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Assistance configuration & debug</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Temps de réponse garanti</li>
        </ul>
        <a href="/nous-contacter" class="pricing-btn pricing-btn-primary" style="text-decoration:none">Souscrire au support</a>
      </div>

      <!-- INSTALLATION -->
      <div class="service-card">
        <div class="service-icon green"><span class="i i-lg"><svg><use href="#ico-server"/></svg></span></div>
        <h3>Aide à l'installation</h3>
        <div class="service-price">299 € <span class="unit">HT</span></div>
        <div class="service-from">À partir de · Prestation unique</div>
        <p class="service-desc">Installation et mise en service complète de Voxa Center sur votre serveur par notre équipe.</p>
        <ul class="service-features">
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Installation & configuration serveur</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Certificats SSL & sécurisation</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Configuration trunks & lignes SIP</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Tests de bon fonctionnement</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Documentation de votre setup</li>
        </ul>
        <a href="/nous-contacter" class="pricing-btn pricing-btn-outline" style="text-decoration:none">Demander un devis</a>
      </div>

      <!-- DÉVELOPPEMENT SUR MESURE -->
      <div class="service-card">
        <div class="service-icon purple"><span class="i i-lg"><svg><use href="#ico-cpu"/></svg></span></div>
        <h3>Développement sur mesure</h3>
        <div class="service-price">Sur devis</div>
        <div class="service-from">Besoins spécifiques & intégrations</div>
        <p class="service-desc">Développement de fonctionnalités personnalisées, intégrations CRM/ERP, et adaptations métier.</p>
        <ul class="service-features">
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Fonctionnalités sur mesure</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Intégrations API & CRM/ERP</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Scénarios d'appels avancés</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Agents IA personnalisés</li>
          <li><span class="i i-sm icon-check"><svg><use href="#ico-check"/></svg></span> Cahier des charges & livraison</li>
        </ul>
        <a href="/nous-contacter" class="pricing-btn pricing-btn-accent" style="text-decoration:none">Discuter de votre projet</a>
      </div>
    </div>

  </div>
</section>

<!-- ═══════ STACK ═══════ -->
<section id="stack">
  <div class="container">
    <div class="section-label"><span class="i i-sm"><svg><use href="#ico-cpu"/></svg></span> Stack technique</div>
    <h2 class="section-title">Technologies éprouvées</h2>
    <p class="section-desc">Chaque composant est choisi pour sa fiabilité en production télécom.</p>
    <div class="stack-grid">
      <div class="stack-item asterisk-item"><div class="stack-name">Asterisk</div><div class="stack-ver">20 PJSIP</div></div>
      <div class="stack-item"><div class="stack-name">PHP</div><div class="stack-ver">8.4 FPM</div></div>
      <div class="stack-item"><div class="stack-name">Laravel</div><div class="stack-ver">13</div></div>
      <div class="stack-item"><div class="stack-name">MariaDB</div><div class="stack-ver">10.11</div></div>
      <div class="stack-item"><div class="stack-name">Redis</div><div class="stack-ver">7</div></div>
      <div class="stack-item"><div class="stack-name">Nginx</div><div class="stack-ver">1.22</div></div>
      <div class="stack-item ai-item"><div class="stack-name">OpenAI</div><div class="stack-ver">Realtime API</div></div>
      <div class="stack-item ai-item"><div class="stack-name">Piper TTS</div><div class="stack-ver">1.2 · FR</div></div>
      <div class="stack-item ai-item"><div class="stack-name">Python</div><div class="stack-ver">3.11</div></div>
      <div class="stack-item"><div class="stack-name">Debian</div><div class="stack-ver">12</div></div>
    </div>
  </div>
</section>

<!-- ═══════ CTA ═══════ -->
<section class="cta-section">
  <div class="container">
    <h2>Votre téléphonie se dessine<br>en quelques minutes</h2>
    <p>Installez Voxa Center gratuitement sur votre serveur Debian ou Ubuntu.</p>
    <div class="hero-actions">
      <a href="https://github.com/grevoka/Voxa.center.app" target="_blank" class="btn btn-primary btn-lg">
        <span class="i"><svg><use href="#ico-download"/></svg></span>
        Commencer gratuitement
      </a>
      <a href="/nous-contacter" class="btn btn-outline btn-lg">
        <span class="i"><svg><use href="#ico-mail"/></svg></span>
        Contacter l'équipe
      </a>
    </div>
  </div>
</section>

@include('partials.footer')

<script>
// Navbar scroll
const nav = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  nav.classList.toggle('scrolled', window.scrollY > 30);
});

// Copy install command
document.getElementById('installCmd').addEventListener('click', function() {
  navigator.clipboard.writeText('curl -sSL https://raw.githubusercontent.com/grevoka/Voxa.center.app/main/install.sh | bash');
  const btn = document.getElementById('copyBtn');
  btn.innerHTML = '<span class="i i-xs" style="color:var(--success)"><svg><use href="#ico-check"/></svg></span> Copié !';
  btn.style.color = 'var(--success)';
  setTimeout(() => {
    btn.innerHTML = '<span class="i i-xs"><svg><use href="#ico-copy"/></svg></span> Copier';
    btn.style.color = '';
  }, 2000);
});

// Scroll reveal
const obs = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.animation = 'fade-up 0.5s ease-out forwards';
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.08 });

document.querySelectorAll('.feature-card, .pricing-card, .service-card, .arch-card, .stack-item, .ai-diagram-card').forEach(el => {
  el.style.opacity = '0';
  el.style.transform = 'translateY(20px)';
  obs.observe(el);
});

// ═══════════════════════════════════════
// NETWORK COMMUNICATION ANIMATION
// ═══════════════════════════════════════
(function() {
  const canvas = document.getElementById('networkCanvas');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  let w, h, nodes, pulses, mouse, raf;
  const NODE_COUNT = 45;
  const CONNECTION_DIST = 180;
  const PULSE_SPEED = 1.2;

  mouse = { x: -1000, y: -1000 };

  function resize() {
    const hero = canvas.parentElement;
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    w = hero.offsetWidth;
    h = hero.offsetHeight;
    canvas.width = w * dpr;
    canvas.height = h * dpr;
    canvas.style.width = w + 'px';
    canvas.style.height = h + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function createNodes() {
    nodes = [];
    for (let i = 0; i < NODE_COUNT; i++) {
      nodes.push({
        x: Math.random() * w,
        y: Math.random() * h,
        vx: (Math.random() - 0.5) * 0.35,
        vy: (Math.random() - 0.5) * 0.35,
        radius: Math.random() * 2 + 1.5,
        type: Math.random() < 0.15 ? 'hub' : 'node' // 15% are "hub" nodes (larger)
      });
    }
    if (nodes.length > 0) {
      nodes[0].type = 'hub';
      nodes[0].radius = 4;
    }
    pulses = [];
  }

  function spawnPulse() {
    if (pulses.length > 25) return;
    // Pick a random connection that exists
    for (let a = 0; a < nodes.length; a++) {
      for (let b = a + 1; b < nodes.length; b++) {
        const dx = nodes[b].x - nodes[a].x;
        const dy = nodes[b].y - nodes[a].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < CONNECTION_DIST && Math.random() < 0.002) {
          const fromA = Math.random() < 0.5;
          pulses.push({
            from: fromA ? a : b,
            to: fromA ? b : a,
            t: 0,
            speed: PULSE_SPEED + Math.random() * 0.6,
            color: Math.random() < 0.3 ? 'accent' : 'primary'
          });
          return;
        }
      }
    }
  }

  function draw() {
    ctx.clearRect(0, 0, w, h);

    // Mouse attraction radius
    const MOUSE_RADIUS = 200;

    // Update node positions
    for (const node of nodes) {
      node.x += node.vx;
      node.y += node.vy;

      // Gentle mouse attraction
      const mdx = mouse.x - node.x;
      const mdy = mouse.y - node.y;
      const mdist = Math.sqrt(mdx * mdx + mdy * mdy);
      if (mdist < MOUSE_RADIUS && mdist > 10) {
        node.vx += (mdx / mdist) * 0.008;
        node.vy += (mdy / mdist) * 0.008;
      }

      // Damping
      node.vx *= 0.999;
      node.vy *= 0.999;

      // Bounds wrap
      if (node.x < -20) node.x = w + 20;
      if (node.x > w + 20) node.x = -20;
      if (node.y < -20) node.y = h + 20;
      if (node.y > h + 20) node.y = -20;
    }

    // Draw connections
    for (let a = 0; a < nodes.length; a++) {
      for (let b = a + 1; b < nodes.length; b++) {
        const dx = nodes[b].x - nodes[a].x;
        const dy = nodes[b].y - nodes[a].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < CONNECTION_DIST) {
          const alpha = (1 - dist / CONNECTION_DIST) * 0.12;
          ctx.beginPath();
          ctx.moveTo(nodes[a].x, nodes[a].y);
          ctx.lineTo(nodes[b].x, nodes[b].y);
          ctx.strokeStyle = 'rgba(139, 92, 246,' + alpha + ')';
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }
    }

    // Draw nodes
    for (const node of nodes) {
      const isHub = node.type === 'hub';
      const r = isHub ? 3.5 : node.radius;

      // Glow for hubs
      if (isHub) {
        ctx.beginPath();
        ctx.arc(node.x, node.y, 10, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(37, 99, 235, 0.06)';
        ctx.fill();
      }

      ctx.beginPath();
      ctx.arc(node.x, node.y, r, 0, Math.PI * 2);
      ctx.fillStyle = isHub ? 'rgba(139, 92, 246, 0.35)' : 'rgba(148, 163, 184, 0.25)';
      ctx.fill();
    }

    // Spawn new pulses
    spawnPulse();

    // Draw & update pulses
    for (let i = pulses.length - 1; i >= 0; i--) {
      const p = pulses[i];
      p.t += p.speed / 100;

      if (p.t >= 1) {
        // Pulse arrived — small flash on destination
        const dest = nodes[p.to];
        ctx.beginPath();
        ctx.arc(dest.x, dest.y, 6, 0, Math.PI * 2);
        ctx.fillStyle = p.color === 'accent'
          ? 'rgba(124, 58, 237, 0.15)'
          : 'rgba(6, 182, 212, 0.15)';
        ctx.fill();
        pulses.splice(i, 1);
        continue;
      }

      const fromN = nodes[p.from];
      const toN = nodes[p.to];
      const px = fromN.x + (toN.x - fromN.x) * p.t;
      const py = fromN.y + (toN.y - fromN.y) * p.t;

      // Pulse trail
      const trailLen = 0.1;
      const t2 = Math.max(0, p.t - trailLen);
      const px2 = fromN.x + (toN.x - fromN.x) * t2;
      const py2 = fromN.y + (toN.y - fromN.y) * t2;

      const grad = ctx.createLinearGradient(px2, py2, px, py);
      if (p.color === 'accent') {
        grad.addColorStop(0, 'rgba(124, 58, 237, 0)');
        grad.addColorStop(1, 'rgba(124, 58, 237, 0.5)');
      } else {
        grad.addColorStop(0, 'rgba(6, 182, 212, 0)');
        grad.addColorStop(1, 'rgba(6, 182, 212, 0.5)');
      }

      ctx.beginPath();
      ctx.moveTo(px2, py2);
      ctx.lineTo(px, py);
      ctx.strokeStyle = grad;
      ctx.lineWidth = 2;
      ctx.stroke();

      // Pulse head dot
      ctx.beginPath();
      ctx.arc(px, py, 2.5, 0, Math.PI * 2);
      ctx.fillStyle = p.color === 'accent'
        ? 'rgba(124, 58, 237, 0.7)'
        : 'rgba(6, 182, 212, 0.7)';
      ctx.fill();
    }

    raf = requestAnimationFrame(draw);
  }

  function init() {
    resize();
    createNodes();
    draw();
  }

  // Mouse tracking on hero
  canvas.parentElement.addEventListener('mousemove', (e) => {
    const rect = canvas.parentElement.getBoundingClientRect();
    mouse.x = e.clientX - rect.left;
    mouse.y = e.clientY - rect.top;
  });
  canvas.parentElement.addEventListener('mouseleave', () => {
    mouse.x = -1000;
    mouse.y = -1000;
  });

  window.addEventListener('resize', () => {
    resize();
    // Reposition nodes that are out of bounds
    for (const node of nodes) {
      if (node.x > w) node.x = Math.random() * w;
      if (node.y > h) node.y = Math.random() * h;
    }
  });

  // Only animate when hero is visible
  const heroObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (!raf) draw();
      } else {
        if (raf) { cancelAnimationFrame(raf); raf = null; }
      }
    });
  }, { threshold: 0 });
  heroObs.observe(canvas.parentElement);

  init();
})();
</script>

</body>
</html>
