document.addEventListener('DOMContentLoaded', () => {
  const root = document.getElementById('spa-root');
  if (!root) return;

  root.innerHTML = `
    <div style="display:flex;align-items:center;gap:.5rem;">
      <span>SPA area is ready.</span>
      <button id="helloBtn" style="padding:.25rem .5rem;border:1px solid #ccc;border-radius:4px;">Click</button>
    </div>
    <p id="helloOut" style="margin-top:.5rem;color:#555"></p>
  `;

  const btn = document.getElementById('helloBtn');
  const out = document.getElementById('helloOut');
  btn?.addEventListener('click', () => {
    out.textContent = 'Hello! Component is working.';
  });
});
