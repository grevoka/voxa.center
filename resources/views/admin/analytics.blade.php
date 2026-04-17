@extends('layouts.admin')
@section('title', __('Analytics'))

@push('styles')
<style>
.analytics-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;margin-bottom:28px}
.analytics-header h1{font-size:28px;font-weight:800;color:var(--navy);margin:0}
.period-tabs{display:flex;gap:4px;background:#fff;border:1.5px solid var(--border);border-radius:10px;padding:3px}
.period-tab{padding:7px 14px;font-size:13px;font-weight:600;border-radius:7px;cursor:pointer;color:var(--slate);border:none;background:transparent;font-family:var(--font);transition:all .15s}
.period-tab.active{background:var(--mid);color:#fff}
.period-tab:hover:not(.active){background:var(--bg);color:var(--ink)}
.live-dot{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#059669;background:#ecfdf5;padding:6px 14px;border-radius:999px;border:1px solid #a7f3d0}
.live-dot .dot{width:8px;height:8px;background:#059669;border-radius:50%;animation:livePulse 2s infinite}
@keyframes livePulse{0%,100%{opacity:1}50%{opacity:.3}}

/* KPI CARDS */
.kpi-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px}
.kpi-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:22px 24px;transition:all .15s}
.kpi-card:hover{border-color:var(--lav-bdr);box-shadow:0 4px 16px rgba(37,99,235,.06)}
.kpi-label{font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:var(--slate);margin-bottom:8px;display:flex;align-items:center;gap:6px}
.kpi-label i{font-size:14px}
.kpi-value{font-family:var(--mono);font-size:32px;font-weight:700;color:var(--ink);line-height:1}
.kpi-change{font-size:12px;font-weight:700;margin-top:6px;display:inline-flex;align-items:center;gap:3px}
.kpi-change.up{color:#059669}.kpi-change.down{color:#dc2626}.kpi-change.neutral{color:var(--slate)}
.kpi-sub{font-size:12px;color:var(--slate);margin-top:6px}

/* CHART */
.chart-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:24px;margin-bottom:28px}
.chart-card h3{font-size:16px;font-weight:700;color:var(--navy);margin:0 0 20px}
.chart-card canvas{width:100%!important;height:280px!important}

/* DATA TABLES */
.data-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:28px}
.data-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;overflow:hidden}
.data-card .dh{display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--border)}
.data-card .dh h3{font-size:15px;font-weight:700;color:var(--navy);margin:0;display:flex;align-items:center;gap:8px}
.data-card .dh h3 i{color:var(--mid);font-size:16px}
.data-row{display:flex;align-items:center;padding:10px 20px;border-bottom:1px solid #f1f5f9;font-size:14px;gap:12px}
.data-row:last-child{border-bottom:none}
.data-row:hover{background:#fafbfe}
.data-rank{font-family:var(--mono);font-size:11px;font-weight:700;color:var(--slate);width:20px;text-align:center}
.data-name{flex:1;font-weight:500;color:var(--ink);overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.data-value{font-family:var(--mono);font-size:13px;font-weight:600;color:var(--mid)}
.data-bar{height:4px;background:#f1f5f9;border-radius:4px;flex:0 0 60px;overflow:hidden}
.data-bar-fill{height:100%;background:var(--mid);border-radius:4px;transition:width .3s}
.data-empty{padding:32px 20px;text-align:center;color:var(--slate);font-size:14px}

/* PIE CHARTS */
.pie-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:28px}
.pie-card{background:#fff;border:1.5px solid var(--border);border-radius:14px;padding:20px}
.pie-card h3{font-size:14px;font-weight:700;color:var(--navy);margin:0 0 16px;display:flex;align-items:center;gap:6px}
.pie-card h3 i{color:var(--mid)}
.pie-card canvas{width:100%!important;height:180px!important}

/* Loading */
.analytics-loading{text-align:center;padding:60px;color:var(--slate);font-size:14px}
.analytics-loading i{font-size:24px;display:block;margin-bottom:12px;animation:spin 1s linear infinite}
@keyframes spin{from{transform:rotate(0)}to{transform:rotate(360deg)}}

@media(max-width:900px){.kpi-grid{grid-template-columns:repeat(2,1fr)}.data-grid{grid-template-columns:1fr}.pie-grid{grid-template-columns:repeat(2,1fr)!important}}
@media(max-width:600px){.pie-grid{grid-template-columns:1fr!important}}
</style>
@endpush

@section('content')
<div class="analytics-header">
  <div>
    <h1><i class="bi bi-graph-up" style="color:var(--mid)"></i> {{ __('Analytics') }}</h1>
    <p style="font-size:14px;color:var(--slate);margin:4px 0 0">{{ __('Statistiques de consultation du site') }}</p>
  </div>
  <div style="display:flex;align-items:center;gap:12px">
    <a href="{{ route('admin.analytics.visitors') }}" class="btn-admin outline" style="font-size:12px"><i class="bi bi-people"></i> {{ __('Visiteurs') }}</a>
    <span class="live-dot"><span class="dot"></span> <span id="liveCount">0</span> {{ __('en ligne') }}</span>
    <div class="period-tabs" id="periodTabs">
      <button class="period-tab" data-period="today">{{ __('Today') }}</button>
      <button class="period-tab" data-period="7d">7j</button>
      <button class="period-tab active" data-period="30d">30j</button>
      <button class="period-tab" data-period="90d">90j</button>
      <button class="period-tab" data-period="12m">12m</button>
    </div>
  </div>
</div>

<!-- KPIs -->
<div class="kpi-grid">
  <div class="kpi-card">
    <div class="kpi-label"><i class="bi bi-people"></i> {{ __('Visitors') }}</div>
    <div class="kpi-value" id="kpiVisitors">—</div>
    <div class="kpi-change neutral" id="kpiVisitorsChange"></div>
  </div>
  <div class="kpi-card">
    <div class="kpi-label"><i class="bi bi-eye"></i> {{ __('Pages vues') }}</div>
    <div class="kpi-value" id="kpiPageviews">—</div>
    <div class="kpi-change neutral" id="kpiPageviewsChange"></div>
  </div>
  <div class="kpi-card">
    <div class="kpi-label"><i class="bi bi-arrow-return-left"></i> {{ __('Taux de rebond') }}</div>
    <div class="kpi-value" id="kpiBounce">—</div>
    <div class="kpi-sub">{{ __('1 seule page visitee') }}</div>
  </div>
  <div class="kpi-card">
    <div class="kpi-label"><i class="bi bi-clock"></i> {{ __('Duree moyenne') }}</div>
    <div class="kpi-value" id="kpiDuration">—</div>
    <div class="kpi-sub">{{ __('par session') }}</div>
  </div>
</div>

<!-- CHART -->
<div class="chart-card">
  <h3><i class="bi bi-bar-chart-line" style="color:var(--mid)"></i> {{ __('Visitors & Pages vues') }}</h3>
  <canvas id="mainChart"></canvas>
</div>

<!-- DATA TABLES -->
<div class="data-grid">
  <div class="data-card">
    <div class="dh"><h3><i class="bi bi-file-earmark-text"></i> {{ __('Pages les plus visitees') }}</h3></div>
    <div id="topPages"><div class="data-empty"><i class="bi bi-hourglass-split"></i> {{ __('Chargement...') }}</div></div>
  </div>
  <div class="data-card">
    <div class="dh"><h3><i class="bi bi-box-arrow-in-right"></i> {{ __('Sources de trafic') }}</h3></div>
    <div id="referrers"><div class="data-empty"><i class="bi bi-hourglass-split"></i> {{ __('Chargement...') }}</div></div>
  </div>
</div>

<!-- PIE CHARTS -->
<div class="pie-grid" style="grid-template-columns:repeat(4,1fr)">
  <div class="pie-card">
    <h3><i class="bi bi-signpost-split"></i> {{ __('Sources') }}</h3>
    <canvas id="sourcesChart"></canvas>
  </div>
  <div class="pie-card">
    <h3><i class="bi bi-laptop"></i> {{ __('Appareils') }}</h3>
    <canvas id="devicesChart"></canvas>
  </div>
  <div class="pie-card">
    <h3><i class="bi bi-globe"></i> {{ __('Navigateurs') }}</h3>
    <canvas id="browsersChart"></canvas>
  </div>
  <div class="pie-card">
    <h3><i class="bi bi-cpu"></i> {{ __('Systemes') }}</h3>
    <canvas id="osChart"></canvas>
  </div>
</div>

<!-- BOTS -->
<div class="data-card" style="margin-bottom:28px">
  <div class="dh">
    <h3><i class="bi bi-robot"></i> {{ __('Bots & Crawlers') }}</h3>
    <span id="botTotal" style="font-family:var(--mono);font-size:14px;font-weight:700;color:var(--slate)"></span>
  </div>
  <div id="topBots"><div class="data-empty"><i class="bi bi-hourglass-split"></i> {{ __('Chargement...') }}</div></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
(function(){
  const API = '{{ route("admin.analytics.data") }}';
  let period = '{{ $period }}';
  let mainChart, devicesChart, browsersChart, osChart, sourcesChart;

  const colors = ['#6d28d9','#3b82f6','#06b6d4','#d946ef','#f59e0b','#10b981','#ef4444','#8b5cf6'];
  const chartFont = {family:"'Plus Jakarta Sans',sans-serif"};

  // ─── Load Data ───
  async function load(){
    const res = await fetch(API + '?period=' + period);
    const data = await res.json();
    renderKPIs(data.kpis);
    renderMainChart(data.chart);
    renderTable('topPages', data.top_pages, 'path', 'views');
    renderReferrers(data.referrers);
    renderSourcesPie(data.sources);
    renderPie('devicesChart', devicesChart, data.devices, 'device', 'visits');
    renderPie('browsersChart', browsersChart, data.browsers, 'browser', 'visits');
    renderPie('osChart', osChart, data.os, 'os', 'visits');
    document.getElementById('liveCount').textContent = data.kpis.live;
    renderBots(data.bots);
  }

  // ─── KPIs ───
  function renderKPIs(k){
    document.getElementById('kpiVisitors').textContent = k.visitors.toLocaleString('fr-FR');
    document.getElementById('kpiPageviews').textContent = k.pageviews.toLocaleString('fr-FR');
    document.getElementById('kpiBounce').textContent = k.bounce_rate + '%';
    const m = Math.floor(k.avg_duration / 60);
    const s = k.avg_duration % 60;
    document.getElementById('kpiDuration').textContent = m + 'm ' + String(s).padStart(2,'0') + 's';

    renderChange('kpiVisitorsChange', k.visitors_change);
    renderChange('kpiPageviewsChange', k.pageviews_change);
  }

  function renderChange(id, val){
    const el = document.getElementById(id);
    if(val === 0){el.className='kpi-change neutral';el.innerHTML='— vs periode precedente';return;}
    const up = val > 0;
    el.className = 'kpi-change ' + (up ? 'up' : 'down');
    el.innerHTML = '<i class="bi bi-arrow-' + (up?'up':'down') + '"></i> ' + (up?'+':'') + val + '% vs periode precedente';
  }

  // ─── Main Chart ───
  function renderMainChart(chartData){
    const ctx = document.getElementById('mainChart').getContext('2d');
    if(mainChart) mainChart.destroy();

    mainChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: chartData.map(d => d.date),
        datasets: [
          {
            label: 'Visiteurs',
            data: chartData.map(d => d.visitors),
            backgroundColor: 'rgba(109,40,217,0.15)',
            borderColor: '#6d28d9',
            borderWidth: 2,
            borderRadius: 6,
            order: 2,
          },
          {
            label: 'Pages vues',
            data: chartData.map(d => d.pageviews),
            type: 'line',
            borderColor: '#06b6d4',
            backgroundColor: 'rgba(6,182,212,0.08)',
            borderWidth: 2.5,
            pointRadius: 0,
            pointHoverRadius: 5,
            tension: 0.35,
            fill: true,
            order: 1,
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {mode:'index',intersect:false},
        plugins: {
          legend: {position:'top',align:'end',labels:{font:chartFont,usePointStyle:true,pointStyle:'circle',padding:16}},
          tooltip: {backgroundColor:'#0f172a',titleFont:chartFont,bodyFont:chartFont,padding:12,cornerRadius:8},
        },
        scales: {
          x: {grid:{display:false},ticks:{font:{...chartFont,size:11},color:'#94a3b8',maxRotation:0}},
          y: {beginAtZero:true,grid:{color:'#f1f5f9'},ticks:{font:{...chartFont,size:11},color:'#94a3b8'}},
        }
      }
    });
  }

  // ─── Data Tables ───
  function renderTable(containerId, rows, nameKey, valueKey){
    const c = document.getElementById(containerId);
    if(!rows || rows.length === 0){c.innerHTML='<div class="data-empty">{{ __("Aucune donnee") }}</div>';return;}
    const max = rows[0][valueKey];
    c.innerHTML = rows.map((r,i) =>
      '<div class="data-row">' +
        '<span class="data-rank">' + (i+1) + '</span>' +
        '<span class="data-name">' + escHtml(r[nameKey]) + '</span>' +
        '<div class="data-bar"><div class="data-bar-fill" style="width:' + Math.round(r[valueKey]/max*100) + '%"></div></div>' +
        '<span class="data-value">' + r[valueKey].toLocaleString('fr-FR') + '</span>' +
      '</div>'
    ).join('');
  }

  function renderReferrers(rows){
    const c = document.getElementById('referrers');
    if(!rows || rows.length === 0){c.innerHTML='<div class="data-empty">{{ __("Trafic direct uniquement") }}</div>';return;}
    const max = rows[0].visits;
    c.innerHTML = rows.map((r,i) =>
      '<div class="data-row">' +
        '<span class="data-rank">' + (i+1) + '</span>' +
        '<span class="data-name">' + escHtml(r.referrer_host) + '</span>' +
        '<div class="data-bar"><div class="data-bar-fill" style="width:' + Math.round(r.visits/max*100) + '%;background:#06b6d4"></div></div>' +
        '<span class="data-value">' + r.visitors.toLocaleString('fr-FR') + '</span>' +
      '</div>'
    ).join('');
  }

  // ─── Pie Charts ───
  // ─── Sources Pie ───
  const sourceLabels = {direct:'{{ __("Trafic direct") }}',search:'{{ __("Moteurs de recherche") }}',social:'{{ __("Reseaux sociaux") }}',referral:'{{ __("Sites referents") }}'};
  const sourceColors = {direct:'#94a3b8',search:'#6d28d9',social:'#d946ef',referral:'#06b6d4'};
  function renderSourcesPie(rows){
    const ctx = document.getElementById('sourcesChart').getContext('2d');
    if(sourcesChart) sourcesChart.destroy();
    const labels = rows.map(r => sourceLabels[r.source] || r.source);
    const data = rows.map(r => r.visits);
    const bg = rows.map(r => sourceColors[r.source] || '#94a3b8');
    sourcesChart = new Chart(ctx, {
      type:'doughnut',
      data:{labels,datasets:[{data,backgroundColor:bg,borderWidth:2,borderColor:'#fff'}]},
      options:{responsive:true,maintainAspectRatio:false,cutout:'60%',plugins:{legend:{position:'bottom',labels:{font:{...chartFont,size:11},padding:10,usePointStyle:true,pointStyle:'circle'}},tooltip:{backgroundColor:'#0f172a',titleFont:chartFont,bodyFont:chartFont,padding:10,cornerRadius:8}}}
    });
  }

  function renderPie(canvasId, chartRef, rows, nameKey, valueKey){
    const ctx = document.getElementById(canvasId).getContext('2d');
    if(chartRef) chartRef.destroy();

    const labels = rows.map(r => r[nameKey] || 'Inconnu');
    const data = rows.map(r => r[valueKey]);

    const chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: colors.slice(0, labels.length),
          borderWidth: 2,
          borderColor: '#fff',
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '60%',
        plugins: {
          legend: {position:'bottom',labels:{font:{...chartFont,size:11},padding:10,usePointStyle:true,pointStyle:'circle'}},
          tooltip: {backgroundColor:'#0f172a',titleFont:chartFont,bodyFont:chartFont,padding:10,cornerRadius:8},
        }
      }
    });

    // Store reference
    if(canvasId === 'devicesChart') devicesChart = chart;
    else if(canvasId === 'browsersChart') browsersChart = chart;
    else if(canvasId === 'osChart') osChart = chart;
  }

  // ─── Period Tabs ───
  document.querySelectorAll('.period-tab').forEach(tab => {
    tab.addEventListener('click', function(){
      document.querySelectorAll('.period-tab').forEach(t => t.classList.remove('active'));
      this.classList.add('active');
      period = this.dataset.period;
      load();
    });
  });

  function escHtml(s){const d=document.createElement('div');d.textContent=s;return d.innerHTML;}

  // ─── Bots ───
  const botIcons = {'Googlebot':'🔍','Google':'🔍','Googlebot Images':'🖼️','Google Ads':'📢','Google Lighthouse':'💡','Google PageSpeed':'⚡',
    'Bingbot':'🔎','Bing Preview':'🔎','DuckDuckBot':'🦆','Yahoo Slurp':'🔎','Baidu Spider':'🔎','YandexBot':'🔎',
    'OpenAI GPTBot':'🤖','ChatGPT User':'🤖','OpenAI SearchBot':'🤖','Anthropic ClaudeBot':'🧠','Anthropic Claude':'🧠','Anthropic AI':'🧠',
    'Common Crawl':'📚','Cohere AI':'🤖','Meta AI':'👁️','Perplexity Bot':'🔮','AmazonBot':'📦',
    'Facebook Crawler':'👤','Twitter Bot':'🐦','LinkedIn Bot':'💼','Discord Bot':'🎮','Slack Bot':'💬','Telegram Bot':'✈️',
    'SEMrush Bot':'📊','Ahrefs Bot':'📊','Moz DotBot':'📊','Majestic Bot':'📊',
    'UptimeRobot':'🟢','Pingdom':'🟢','GTmetrix':'📐',
    'Shodan':'🔒','Censys Scanner':'🔒','ZGrab Scanner':'🔒',
    'cURL':'⌨️','Wget':'⌨️','Python Requests':'🐍','Python':'🐍','Go HTTP':'⌨️','Headless Chrome':'👻'};
  function renderBots(bots){
    document.getElementById('botTotal').textContent = bots.total.toLocaleString('fr-FR') + ' hits';
    const c = document.getElementById('topBots');
    if(!bots.top || bots.top.length === 0){c.innerHTML='<div class="data-empty">{{ __("Aucun bot detecte") }}</div>';return;}
    const max = bots.top[0].hits;
    c.innerHTML = bots.top.map((r,i) => {
      const icon = botIcons[r.bot_name] || '🤖';
      return '<div class="data-row">' +
        '<span class="data-rank">' + (i+1) + '</span>' +
        '<span style="font-size:18px;width:24px;text-align:center">' + icon + '</span>' +
        '<span class="data-name">' + escHtml(r.bot_name) + '</span>' +
        '<div class="data-bar"><div class="data-bar-fill" style="width:' + Math.round(r.hits/max*100) + '%;background:#94a3b8"></div></div>' +
        '<span class="data-value" style="color:var(--slate)">' + r.hits.toLocaleString('fr-FR') + '</span>' +
      '</div>';
    }).join('');
  }

  // ─── Init ───
  load();
  // Refresh live count every 60s
  setInterval(async () => {
    try{
      const r = await fetch(API + '?period=' + period);
      const d = await r.json();
      document.getElementById('liveCount').textContent = d.kpis.live;
    }catch(e){}
  }, 60000);
})();
</script>
@endsection
