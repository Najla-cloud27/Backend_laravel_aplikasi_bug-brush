document.addEventListener('DOMContentLoaded', function () {
    var navbar = document.querySelector('.navbar');
    var hamburger = document.getElementById('hamburger');
    var navMenu = document.getElementById('navLinks');

    function initLandingScroll() {
        var berandaPage = document.getElementById('page-beranda');
        if (!berandaPage || !berandaPage.classList.contains('active')) return;

        var sections = berandaPage.querySelectorAll('section');
        var navLinks = document.querySelectorAll('.nav-links a[data-nav]');

        if (window.scrollY > 50) {
            navbar.style.padding = '10px 35px';
            navbar.style.background = 'rgba(255, 255, 255, 0.95)';
        } else {
            navbar.style.padding = '12px 35px';
            navbar.style.background = 'rgba(255, 255, 255, 0.85)';
        }

        var current = '';
        sections.forEach(function (section) {
            var sectionTop = section.offsetTop;
            if (window.pageYOffset >= sectionTop - 150) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(function (link) {
            link.classList.remove('active');
            if (link.getAttribute('href').includes(current)) {
                link.classList.add('active');
            }
        });
    }

    window.addEventListener('scroll', initLandingScroll);

    hamburger.addEventListener('click', function () {
        navMenu.classList.toggle('active');
        if (navMenu.classList.contains('active')) {
            navMenu.style.display = 'flex';
            navMenu.style.flexDirection = 'column';
            navMenu.style.position = 'absolute';
            navMenu.style.top = '80px';
            navMenu.style.left = '0';
            navMenu.style.width = '100%';
            navMenu.style.background = 'white';
            navMenu.style.padding = '30px';
            navMenu.style.boxShadow = '0 10px 30px rgba(0,0,0,0.1)';
        } else {
            navMenu.style.display = '';
        }
    });

    function initRevealAnimations() {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });

        var itemsToAnimate = document.querySelectorAll('#page-beranda.active .feature-card, #page-beranda.active .step-card, #page-beranda.active .hero-content');
        itemsToAnimate.forEach(function (item) {
            item.style.opacity = '0';
            item.style.transform = 'translateY(40px)';
            item.style.transition = 'all 0.8s ease-out';
            revealObserver.observe(item);
        });
    }

    initRevealAnimations();

    /* MODAL DOWNLOAD */
    var btnDownload = document.getElementById('btnDownload');
    var modalDownload = document.getElementById('modalDownload');
    var btnYakin = document.getElementById('btnYakinDownload');
    var btnBatal = document.getElementById('btnBatalDownload');
    var downloadUrl = 'http://fokusin.najlahaura.my.id/fokusin.apk';

    if (btnDownload && modalDownload) {
        btnDownload.addEventListener('click', function (e) {
            e.preventDefault();
            modalDownload.classList.add('active');
        });
    }

    if (btnBatal && modalDownload) {
        btnBatal.addEventListener('click', function () {
            modalDownload.classList.remove('active');
        });
    }

    if (btnYakin && modalDownload) {
        btnYakin.addEventListener('click', function () {
            modalDownload.classList.remove('active');
            var link = document.createElement('a');
            link.href = downloadUrl;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }

    if (modalDownload) {
        modalDownload.addEventListener('click', function (e) {
            if (e.target === modalDownload) {
                modalDownload.classList.remove('active');
            }
        });
    }

    var origHashChange = window.onhashchange;
    window.addEventListener('hashchange', function () {
        setTimeout(function () {
            initLandingScroll();
            initRevealAnimations();
            if (navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                navMenu.style.display = '';
            }
        }, 50);
    });
});
