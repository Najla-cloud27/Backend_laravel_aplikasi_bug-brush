function getStoredUser() {
    const data = localStorage.getItem('user');
    return data ? JSON.parse(data) : null;
}

function getToken() {
    return localStorage.getItem('token');
}

function isAuthenticated() {
    return !!getToken();
}

async function handleLogin(email, password) {
    const res = await api.post('/login', { email, password });
    const { token, user } = res.data;
    localStorage.setItem('token', token);
    localStorage.setItem('user', JSON.stringify(user));
    return user;
}

async function handleRegister(name, email, password) {
    const res = await api.post('/register', { name, email, password });
    const { token, user } = res.data;
    localStorage.setItem('token', token);
    localStorage.setItem('user', JSON.stringify(user));
    return user;
}

async function handleGoogleLogin() {
    const res = await api.get('/auth/google/redirect');
    window.location.href = res.data.url;
}

function handleLogout() {
    api.post('/logout').catch(function () {});
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    window.location.hash = '#/beranda';
}

function handleGoogleCallback() {
    const params = new URLSearchParams(window.location.search);
    const token = params.get('token');
    if (token) {
        localStorage.setItem('token', token);
        api.get('/user', {
            headers: { Authorization: `Bearer ${token}` }
        }).then(function (res) {
            localStorage.setItem('user', JSON.stringify(res.data));
            window.location.hash = '#/dashboard';
        }).catch(function () {
            window.location.hash = '#/login';
        });
        history.replaceState(null, '', window.location.pathname);
    }
}
