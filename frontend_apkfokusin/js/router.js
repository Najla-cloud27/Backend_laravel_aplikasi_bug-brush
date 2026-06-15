function showPage(pageId) {
    document.querySelectorAll('.page').forEach(function (p) {
        p.classList.remove('active');
    });
    var page = document.getElementById('page-' + pageId);
    if (page) {
        page.classList.add('active');
    }
}

function handleRoute() {
    var hash = window.location.hash || '#/beranda';
    var route = hash.replace('#/', '').split('/')[0];
    var subRoute = hash.replace('#/', '');
    if (!route) route = 'beranda';

    if (route === 'beranda') {
        showPage('beranda');
        document.title = 'Fokusin - Atur Waktu, Tingkatkan Fokus';
    } else if (hash.startsWith('#') && !hash.startsWith('#/') && hash.length > 1) {
        var sectionId = hash.substring(1);
        showPage('beranda');
        document.title = 'Fokusin - Atur Waktu, Tingkatkan Fokus';
        setTimeout(function () {
            var el = document.getElementById(sectionId);
            if (el) el.scrollIntoView({ behavior: 'smooth' });
        }, 100);
    } else if (route === 'login' || route === 'register') {
        if (isAuthenticated()) {
            window.location.hash = '#/dashboard';
            return;
        }
        showPage(route);
        document.title = route === 'login' ? 'Masuk - Fokusin' : 'Daftar - Fokusin';
    } else if (route === 'dashboard') {
        if (!isAuthenticated()) {
            window.location.hash = '#/login';
            return;
        }
        showPage('dashboard');
        initDashboard();
        document.title = 'Dashboard - Fokusin';
    } else {
        window.location.hash = '#/beranda';
    }
}

function initAuthForms() {
    var loginForm = document.getElementById('loginForm');
    var registerForm = document.getElementById('registerForm');
    var googleLoginBtn = document.getElementById('googleLoginBtn');
    var googleRegisterBtn = document.getElementById('googleRegisterBtn');

    if (loginForm) {
        loginForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            var btn = document.getElementById('loginBtn');
            var text = btn.querySelector('.btn-text');
            var loader = btn.querySelector('.btn-loader');
            text.style.display = 'none';
            loader.style.display = 'inline';
            btn.disabled = true;
            try {
                var email = document.getElementById('loginEmail').value;
                var password = document.getElementById('loginPassword').value;
                await handleLogin(email, password);
                window.location.hash = '#/dashboard';
            } catch (err) {
                var msg = 'Login gagal. Periksa email dan password.';
                if (err.response && err.response.data && err.response.data.message) {
                    msg = err.response.data.message;
                }
                showToast(msg, 'error');
            } finally {
                text.style.display = 'inline';
                loader.style.display = 'none';
                btn.disabled = false;
            }
        });
    }

    if (registerForm) {
        registerForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            var btn = document.getElementById('registerBtn');
            var text = btn.querySelector('.btn-text');
            var loader = btn.querySelector('.btn-loader');
            text.style.display = 'none';
            loader.style.display = 'inline';
            btn.disabled = true;
            try {
                var name = document.getElementById('regName').value;
                var email = document.getElementById('regEmail').value;
                var password = document.getElementById('regPassword').value;
                await handleRegister(name, email, password);
                window.location.hash = '#/dashboard';
            } catch (err) {
                var msg = 'Pendaftaran gagal. Coba lagi.';
                if (err.response && err.response.data && err.response.data.message) {
                    msg = err.response.data.message;
                }
                showToast(msg, 'error');
            } finally {
                text.style.display = 'inline';
                loader.style.display = 'none';
                btn.disabled = false;
            }
        });
    }

    if (googleLoginBtn) {
        googleLoginBtn.addEventListener('click', function () {
            handleGoogleLogin();
        });
    }

    if (googleRegisterBtn) {
        googleRegisterBtn.addEventListener('click', function () {
            handleGoogleLogin();
        });
    }

    var logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', function () {
            handleLogout();
        });
    }
}

function initDashboard() {
    var user = getStoredUser();
    if (!user) return;
    document.getElementById('dashboardUserName').textContent = user.name || 'User';
    document.getElementById('userName').textContent = user.name || 'User';
    document.getElementById('userEmail').textContent = user.email || '';
    if (user.avatar) {
        document.getElementById('userAvatar').src = user.avatar;
    }
    initAvatarUpload();
}

function initAvatarUpload() {
    var wrapper = document.getElementById('avatarWrapper');
    var input = document.getElementById('avatarInput');
    if (!wrapper || !input) return;

    wrapper.addEventListener('click', function () {
        input.click();
    });

    input.addEventListener('change', async function () {
        if (!input.files || !input.files[0]) return;

        var file = input.files[0];
        var maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            showToast('Ukuran foto maksimal 2MB', 'error');
            input.value = '';
            return;
        }

        var formData = new FormData();
        formData.append('name', document.getElementById('userName').textContent || 'User');
        formData.append('avatar', file);

        try {
            var res = await api.post('/user/update', formData);
            var user = getStoredUser();
            user.avatar = res.data.avatar;
            localStorage.setItem('user', JSON.stringify(user));
            document.getElementById('userAvatar').src = res.data.avatar;
            showToast('Foto profil berhasil diubah', 'success');
        } catch (err) {
            var msg = 'Gagal mengupload foto';
            if (err.response && err.response.data && err.response.data.message) {
                msg = err.response.data.message;
            }
            showToast(msg, 'error');
        }

        input.value = '';
    });
}

function showToast(message, type) {
    var toast = document.getElementById('toast');
    if (!toast) return;
    toast.textContent = message;
    toast.className = 'toast toast-' + (type || 'info') + ' show';
    setTimeout(function () {
        toast.classList.remove('show');
    }, 3000);
}

document.addEventListener('DOMContentLoaded', function () {
    if (window.location.search.includes('token=')) {
        handleGoogleCallback();
    }
    handleRoute();
    initAuthForms();
    window.addEventListener('hashchange', handleRoute);

    document.querySelectorAll('.nav-links a[data-nav]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href && href.startsWith('#') && !href.startsWith('#/')) {
                e.preventDefault();
                window.location.hash = href;
            }
            document.querySelectorAll('.nav-links a').forEach(function (l) {
                l.classList.remove('active');
            });
            this.classList.add('active');
        });
    });
});
