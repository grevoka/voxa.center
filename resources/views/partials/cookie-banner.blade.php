<div id="cookieBanner" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#0f172a;border-top:1px solid rgba(139,92,246,.2);padding:16px 24px;font-family:'Plus Jakarta Sans',sans-serif;">
  <div style="max-width:1100px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;">
    <div style="flex:1;min-width:280px;">
      <p style="font-size:14px;color:#cbd5e1;line-height:1.6;margin:0;">
        Ce site utilise des <strong style="color:#fff;">cookies techniques</strong> strictement necessaires au fonctionnement (session, securite). Aucun cookie publicitaire ou de tracking.
        <a href="/politique-de-confidentialite" style="color:#8b5cf6;text-decoration:none;font-weight:600;">En savoir plus</a>
      </p>
    </div>
    <div style="display:flex;gap:10px;flex-shrink:0;">
      <button onclick="acceptCookies()" style="background:linear-gradient(135deg,#06b6d4,#3b82f6,#8b5cf6,#d946ef);color:#fff;border:none;border-radius:8px;padding:10px 24px;font-size:13px;font-weight:700;font-family:inherit;cursor:pointer;transition:opacity .2s;">Accepter</button>
      <button onclick="acceptCookies()" style="background:transparent;color:#94a3b8;border:1px solid #334155;border-radius:8px;padding:10px 24px;font-size:13px;font-weight:600;font-family:inherit;cursor:pointer;transition:all .2s;">Fermer</button>
    </div>
  </div>
</div>
<script>
(function(){
  if (document.cookie.indexOf('voxa_cookie_consent=1') !== -1) return;
  var b = document.getElementById('cookieBanner');
  if (b) b.style.display = 'block';
})();
function acceptCookies(){
  document.cookie = 'voxa_cookie_consent=1;path=/;max-age=' + (365*24*60*60) + ';SameSite=Lax';
  var b = document.getElementById('cookieBanner');
  if (b) b.style.display = 'none';
}
</script>
