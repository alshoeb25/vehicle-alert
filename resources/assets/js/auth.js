(() => {
  const api = (path) => `${window.API_BASE}${path}`;

  const handle = async (e, type) => {
    e.preventDefault();
    const form = e.target;
    const submitBtn = form.querySelector('button, input[type="submit"]');
    const errEl = form.querySelector('.form-error') || (() => { const d = document.createElement('div'); d.className='form-error'; d.style.color='red'; d.style.marginTop='8px'; form.appendChild(d); return d;})();
    errEl.textContent = '';
    if (submitBtn) submitBtn.disabled = true;
    try {
      if (type === 'login') {
        const email = form.querySelector('[name="email"]').value.trim();
        const password = form.querySelector('[name="password"]').value;
        const res = await fetch(api('/auth/login'), { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ email, password }) });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || 'Login failed');
        localStorage.setItem('token', data.token);
        window.location.href = 'index.html';
      } else if (type === 'signup') {
        const name = form.querySelector('[name="name"]').value.trim();
        const email = form.querySelector('[name="email"]').value.trim();
        const password = form.querySelector('[name="password"]').value;
        const confirm = form.querySelector('[name="confirmPassword"]')?.value;
        if (confirm && confirm !== password) throw new Error('Passwords do not match');
        const res = await fetch(api('/auth/signup'), { method: 'POST', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify({ name, email, password }) });
        const data = await res.json();
        if (!res.ok) throw new Error(data.error || 'Signup failed');
        localStorage.setItem('token', data.token);
        window.location.href = 'index.html';
      }
    } catch (err) {
      errEl.textContent = err.message;
    } finally {
      if (submitBtn) submitBtn.disabled = false;
    }
  };

  document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.querySelector('#login-form');
    if (loginForm) loginForm.addEventListener('submit', (e) => handle(e, 'login'));
    const signupForm = document.querySelector('#signup-form');
    if (signupForm) signupForm.addEventListener('submit', (e) => handle(e, 'signup'));
  });
})();
