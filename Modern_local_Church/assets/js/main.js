(function(){
  const qs = (s, el=document) => el.querySelector(s);

  // Highlight active nav link
  const path = window.location.pathname.replace(/\/+$/, '');
  const links = Array.from(document.querySelectorAll('[data-nav]'));
  links.forEach(a=>{
    const href = a.getAttribute('href');
    if(!href) return;
    const normalized = href.replace(/\/+$/, '');
    if(path.endsWith(normalized) || (normalized === '/' && (path === '' || path.endsWith('/index.php')))){
      a.classList.add('active');
    }
  });

  // Connect form: simple client-side validation
  const form = qs('#connectForm');
  if(form){
    form.addEventListener('submit', (e)=>{
      const required = ['name','email','phone','message'];
      let ok = true;
      required.forEach(id=>{
        const el = qs('#'+id);
        if(el && !String(el.value||'').trim()){
          ok = false;
          el.style.borderColor = 'rgba(239,68,68,.7)';
        }
      });
      if(!ok){
        e.preventDefault();
        const msg = qs('#formError');
        if(msg) msg.classList.remove('hidden');
      }
    });
  }

})();

