<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fokusin</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('image/fokus_selese.png') }}" type="favicon">
    <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
    <style>
        :root {
            --primary-blue: #0754B0;
            --text-dark: #003060;
            --text-light: #4A5568;
            --yellow-accent: #FFD233;
            --blob-blue: #93D0FF;
            --blob-yellow: #FFD55CBF;
            --shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
            --border-radius-lg: 44px;
            --border-radius-md: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
            background-color: #F8FBFF;
            min-height: 100vh;
            position: relative;
        }

        .bg-decoration {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
            pointer-events: none;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(200px);
        }

        .blob-blue {
            width: 1600px;
            height: 600px;
            top: -200px;
            right: -200px;
            background: var(--blob-blue);
            transform: rotate(-79deg);
            opacity: 0.5;
        }

        .blob-yellow {
            width: 600px;
            height: 600px;
            bottom: -100px;
            left: -200px;
            background: var(--blob-yellow);
            opacity: 0.4;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        li { list-style: none; }
        a { text-decoration: none; transition: 0.3s; }

        .header {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1100px;
            z-index: 1000;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 999px;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgba(255,255,255,0.35);
            box-shadow:
                0 8px 32px rgba(255,255,255,0.15),
                inset 0 1px 1px rgba(255,255,255,0.25),
                0px 10px 30px rgba(0,0,0,0.06);
            width: 100%;
            max-width: 1100px;
            margin: 0 auto 30px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-weight: 800;
            font-size: 24px;
            color: var(--primary-blue);
            letter-spacing: 0.5px;
        }

        .logo-icon {
            width: 28px;
            margin: 0 4px;
        }

        .nav-links {
            display: flex;
            gap: 35px;
        }

        .nav-links a {
            font-weight: 500;
            font-size: 15px;
            color: var(--text-dark);
            opacity: 0.7;
        }

        .nav-links a.active, .nav-links a:hover {
            opacity: 1;
            color: var(--primary-blue);
        }

        .btn-download {
            background: #FFD233;
            color: #003060;
            font-weight: 700;
            font-size: 16px;
            padding: 13px 34px;
            border-radius: 999px;
            border: 2px solid #FFD233;
            box-shadow:
                0 0 0 3px rgba(255,255,255,0.9),
                0 0 0 5px #FFD233,
                0 6px 14px rgba(255, 210, 51, 0.18);
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn-download:hover {
            background: #FFDB52;
            transform: translateY(-2px);
            box-shadow:
                0 0 0 3px rgba(255,255,255,0.95),
                0 0 0 5px #FFD233,
                0 8px 18px rgba(255, 210, 51, 0.24);
        }

        .hero {
            min-height: auto;
            padding: 140px 0 120px;
            display: flex;
            align-items: center;
            background: #8fc7ff;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            width: 950px;
            height: 950px;
            background: rgba(255, 224, 133, 0.78);
            border-radius: 50%;
            filter: blur(180px);
            top: -260px;
            left: -260px;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 950px;
            height: 950px;
            background: rgba(34, 158, 255, 0.58);
            border-radius: 50%;
            filter: blur(190px);
            top: -200px;
            right: -280px;
            z-index: 0;
        }

        .hero-container,
        .navbar {
            position: relative;
            z-index: 2;
        }

        .hero-container {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            align-items: center;
            gap: 90px;
            background: rgba(255, 255, 255, 0.28);
            border-radius: 40px;
            padding: 60px;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.35);
        }

        .hero-content {
            max-width: 600px;
            position: relative;
        }

        .hero-title {
            font-size: 64px;
            font-weight: 800;
            line-height: 1.08;
            margin-bottom: 35px;
            color: #0754B0;
        }

        .title-underline {
            width: 190px;
            height: 8px;
            background: #0754B0;
            border-radius: 999px;
            margin-top: 14px;
        }

        .text-yellow {
            color: var(--yellow-accent);
        }

        .hero-subtitle {
            font-size: 18px;
            color: var(--primary-blue);
            max-width: 480px;
            font-weight: 500;
            opacity: 0.95;
        }

        .hero-image {
            flex: 1;
            display: flex;
            justify-content: flex-end;
        }

        .phone-mockup {
            width: 100%;
            max-width: 480px;
            filter: drop-shadow(0px 30px 60px rgba(0,0,0,0.12));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .section-title {
            text-align: center;
            font-size: 34px;
            font-weight: 800;
            margin-bottom: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .logo-inline {
            color: var(--primary-blue);
            display: flex;
            align-items: center;
        }

        .logo-inline img {
            width: 32px;
        }

        .features {
            padding: 80px 0;
            background: linear-gradient(
                90deg,
                #FFD55CBF 0%,
                #dff1ff 50%,
                #93D0FF 70%
            );
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.45);
            padding: 45px 35px;
            border-radius: var(--border-radius-md);
            text-align: center;
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid rgba(255, 255, 255, 0.6);
            min-height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            cursor: pointer;
        }

        .feature-card:hover {
            background: white;
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0px 20px 40px rgba(0,0,0,0.06);
        }

        .feature-icon-wrapper {
            width: 90px;
            height: 90px;
            margin: 0 auto 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .feature-icon-wrapper img {
            max-width: 100%;
        }

        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: var(--primary-blue);
            font-weight: 700;
        }

        .feature-card p {
            font-size: 15px;
            color: #0754B0;
            opacity: 0.85;
            line-height: 1.7;
            max-width: 260px;
            margin: 0 auto;
        }

        .how-it-works {
            padding: 100px 0;
            background: linear-gradient(
                90deg,
                #8cc8ff 0%,
                #f6efc7 50%,
                #8cc8ff 100%
            );
        }

        .steps-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
        }

        .step-card {
            text-align: center;
            position: relative;
            cursor: pointer;
        }

        .step-number {
            width: 38px;
            height: 38px;
            background: var(--primary-blue);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            margin: 0 auto 25px;
            box-shadow: 0 4px 10px rgba(7, 84, 176, 0.3);
        }

        .step-illustration {
            height: 190px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
        }

        .step-illustration img {
            max-height: 100%;
            transition: 0.5s ease;
        }

        .step-card:hover .step-illustration img {
            transform: scale(1.1);
        }

        .step-card h3 {
            color: var(--primary-blue);
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .step-description {
            font-size: 19.43px;
            line-height: 25.25px;
            font-weight: 500;
            color: var(--primary-blue);
            max-width: 320px;
            margin: 0 auto;
        }

        .footer {
            padding: 100px 0 40px;
            background: linear-gradient(
                90deg,
                #d9d39c 0%,
                #8cc8ff 100%
            );
            position: relative;
        }

        .footer-container {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            justify-content: space-between;
            gap: 80px;
            align-items: start;
            margin-bottom: 80px;
        }

        .footer .logo {
            margin-bottom: 25px;
        }

        .footer-info p {
            font-size: 19.43px;
            line-height: 25.25px;
            font-weight: 500;
            color: var(--primary-blue);
            max-width: 400px;
            opacity: 1;
        }

        .footer-links-group {
            display: contents;
        }

        .footer-col h4 {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 30px;
        }

        .footer-col ul li {
            margin-bottom: 18px;
        }

        .footer-col ul li a {
            font-size: 19.43px;
            font-weight: 500;
            color: var(--primary-blue);
            opacity: 1;
            transition: 0.3s;
        }

        .footer-col ul li a:hover {
            text-decoration: underline;
            opacity: 0.8;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 40px;
        }

        .footer-bottom p {
            font-size: 19.43px;
            font-weight: 500;
            color: var(--primary-blue);
            opacity: 0.8;
        }

        .blob-blue {
            opacity: 0.7;
        }

        .blob-yellow {
            opacity: 0.6;
        }

        .hamburger {
            display: none;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background: var(--primary-blue);
            margin: 5px 0;
            transition: 0.4s;
        }

        @media (max-width: 1024px){
            .hero-container{
                grid-template-columns: 1fr;
                text-align: center;
                gap: 50px;
                padding: 40px;
            }
            .hero-content{
                max-width: 100%;
            }
            .hero-image{
                justify-content: center;
            }
            .title-underline{
                margin: 15px auto 0;
            }
            .hero-title{
                font-size: 50px;
            }
            .navbar{
                padding: 14px 25px;
            }
        }

        @media (max-width: 768px){
            .nav-links{
                display: none;
            }
            .hamburger{
                display: block;
            }
            .navbar{
                padding: 14px 18px;
            }
            .logo{
                font-size: 20px;
            }
            .btn-download{
               padding: 10px 24px;
               font-size: 14px;
            }
            .hero{
                padding: 120px 0 80px;
            }
            .hero-container{
                grid-template-columns: 1fr;
                padding: 30px 20px;
                gap: 40px;
                border-radius: 30px;
            }
            .hero-title{
                font-size: 38px;
                text-align: center;
            }
            .hero-subtitle{
                font-size: 16px;
                text-align: center;
                margin: auto;
            }
            .hero-image{
                justify-content: center;
            }
            .phone-mockup{
                max-width: 320px;
            }
            .title-underline{
                margin: 15px auto 0;
            }
            .features-grid{
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .feature-card{
                min-height: auto;
                padding: 35px 25px;
            }
            .steps-grid{
                grid-template-columns: 1fr;
                gap: 50px;
            }
            .footer-container{
                grid-template-columns: 1fr;
                gap: 50px;
                text-align: center;
            }
            .footer-info p{
                margin: auto;
            }
            .hero::before,
            .hero::after{
                width: 500px;
                height: 500px;
                filter: blur(120px);
            }
            .blob-blue{
                width: 700px;
            }
            .blob-yellow{
                width: 350px;
                height: 350px;
            }
        }

        @media (max-width: 480px){
            .hero-title{
                font-size: 30px;
                line-height: 1.2;
            }
            .hero-subtitle{
                font-size: 14px;
            }
            .section-title{
                font-size: 26px;
            }
            .phone-mockup{
                max-width: 260px;
            }
            .feature-card h3{
                font-size: 20px;
            }
            .feature-card p{
                font-size: 14px;
            }
        }

        img{
            max-width: 100%;
            height: auto;
            display: block;
        }

        .page { display: none; }
        .page.active { display: block; }

        .hero-actions { margin-top: 30px; }

        .btn-primary {
            display: inline-block;
            background: #FFD233;
            color: #003060;
            font-weight: 700;
            font-size: 16px;
            padding: 14px 40px;
            border-radius: 999px;
            border: 2px solid #FFD233;
            box-shadow: 0 0 0 3px rgba(255,255,255,0.9), 0 0 0 5px #FFD233, 0 6px 14px rgba(255,210,51,0.18);
            cursor: pointer;
            transition: all 0.25s ease;
        }

        .btn-primary:hover {
            background: #FFDB52;
            transform: translateY(-2px);
        }

        .toast {
            position: fixed;
            top: 90px;
            right: 20px;
            padding: 14px 24px;
            border-radius: 12px;
            font-weight: 500;
            font-size: 14px;
            z-index: 9999;
            opacity: 0;
            transform: translateX(100px);
            transition: all 0.4s ease;
            pointer-events: none;
            max-width: 360px;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
            pointer-events: auto;
        }

        .toast-error { background: #FEE2E2; color: #991B1B; border: 1px solid #FCA5A5; }
        .toast-success { background: #D1FAE5; color: #065F46; border: 1px solid #6EE7B7; }
        .toast-info { background: #DBEAFE; color: #1E40AF; border: 1px solid #93C5FD; }

        .btn-login {
            background: #0754B0;
            color: #fff !important;
            font-weight: 600;
            font-size: 14px;
            padding: 8px 22px;
            border-radius: 999px;
            transition: all 0.25s ease;
            opacity: 1 !important;
        }

        .btn-login:hover {
            background: #06408a;
            transform: translateY(-1px);
        }

        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 120px 20px 60px;
        }

        .auth-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 44px;
            padding: 50px 40px;
            width: 100%;
            max-width: 440px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.05);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .auth-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 28px;
            color: var(--primary-blue);
            margin-bottom: 20px;
            gap: 4px;
        }

        .auth-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .auth-header p {
            font-size: 15px;
            color: var(--primary-blue);
            opacity: 0.8;
        }

        .auth-form { margin-bottom: 20px; }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 6px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid rgba(7, 84, 176, 0.2);
            border-radius: 14px;
            font-size: 15px;
            font-family: 'Poppins', sans-serif;
            background: rgba(255, 255, 255, 0.7);
            outline: none;
            transition: border 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: var(--primary-blue);
            background: #fff;
        }

        .btn-auth-submit {
            width: 100%;
            padding: 14px;
            background: var(--primary-blue);
            color: #fff;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-auth-submit:hover {
            background: #06408a;
            transform: translateY(-1px);
        }

        .btn-auth-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 20px 0;
            color: var(--primary-blue);
            font-size: 14px;
            opacity: 0.6;
        }

        .auth-divider::before,
        .auth-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(7, 84, 176, 0.2);
        }

        .btn-google {
            width: 100%;
            padding: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            background: #fff;
            border: 1px solid rgba(7, 84, 176, 0.2);
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            cursor: pointer;
            transition: all 0.25s;
            margin-bottom: 24px;
        }

        .btn-google:hover {
            background: #f8f9fa;
            border-color: var(--primary-blue);
            transform: translateY(-1px);
        }

        .auth-footer-text {
            text-align: center;
            font-size: 14px;
            color: var(--text-dark);
            opacity: 0.7;
        }

        .auth-footer-text a {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: underline;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            padding-top: 80px;
        }

        .dashboard-sidebar {
            width: 270px;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.6);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 80px;
            left: 0;
            bottom: 0;
        }

        .sidebar-header {
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(7, 84, 176, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header .auth-logo {
            font-size: 22px;
            justify-content: flex-start;
            margin-bottom: 0;
        }

        .sidebar-nav {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            font-weight: 500;
            font-size: 15px;
            color: var(--text-dark);
            opacity: 0.7;
            transition: all 0.2s;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background: rgba(7, 84, 176, 0.1);
            opacity: 1;
            color: var(--primary-blue);
        }

        .sidebar-link span { font-size: 8px; }

        .sidebar-footer {
            padding-top: 20px;
            border-top: 1px solid rgba(7, 84, 176, 0.1);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
        }

        .avatar-wrapper {
            position: relative;
            width: 40px;
            height: 40px;
            cursor: pointer;
            flex-shrink: 0;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            background: var(--primary-blue);
        }
        .avatar-overlay {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
        .avatar-wrapper:hover .avatar-overlay {
            opacity: 1;
        }
        .avatar-overlay svg {
            width: 18px;
            height: 18px;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
            color: var(--text-dark);
        }

        .user-email {
            font-size: 12px;
            color: var(--text-dark);
            opacity: 0.6;
        }

        .btn-logout {
            width: 100%;
            padding: 10px;
            background: transparent;
            border: 1px solid rgba(7, 84, 176, 0.2);
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            color: #991B1B;
            cursor: pointer;
            transition: all 0.25s;
        }

        .btn-logout:hover {
            background: #FEE2E2;
            border-color: #FCA5A5;
        }

        .dashboard-main {
            flex: 1;
            margin-left: 270px;
            padding: 40px;
            min-height: calc(100vh - 80px);
        }

        .dashboard-welcome {
            margin-bottom: 40px;
        }

        .dashboard-welcome h1 {
            font-size: 28px;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
        }

        .dashboard-welcome p {
            font-size: 16px;
            color: var(--primary-blue);
            opacity: 0.8;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 24px;
            padding: 30px;
            text-align: center;
            transition: 0.3s;
        }

        .stat-card:hover {
            background: rgba(255, 255, 255, 0.7);
            transform: translateY(-4px);
        }

        .stat-card h3 {
            font-size: 16px;
            font-weight: 600;
            color: var(--primary-blue);
            opacity: 0.8;
            margin-bottom: 12px;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 800;
            color: var(--text-dark);
        }

        @media (max-width: 768px) {
            .dashboard-sidebar {
                display: none;
            }
            .dashboard-main {
                margin-left: 0;
                padding: 20px;
            }
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            .auth-card {
                padding: 30px 24px;
            }
        }

        @media (max-width: 1024px) and (min-width: 769px) {
            .dashboard-sidebar {
                width: 220px;
            }
            .dashboard-main {
                margin-left: 220px;
            }
            .dashboard-stats {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 769px) and (max-width: 1024px){
            .hero-container{
                padding: 50px 40px;
                gap: 40px;
            }
            .hero-title{
                font-size: 48px;
            }
            .hero-subtitle{
                font-size: 17px;
            }
            .phone-mockup{
                max-width: 350px;
            }
            .features-grid{
                grid-template-columns: repeat(3, 1fr);
                gap: 20px;
            }
            .feature-card{
                padding: 30px 20px;
                min-height: 300px;
            }
            .feature-card h3{
                font-size: 18px;
            }
            .feature-card p{
                font-size: 13px;
                line-height: 1.5;
            }
            .steps-grid{
                grid-template-columns: repeat(3, 1fr);
                gap: 25px;
            }
            .step-illustration{
                height: 130px;
            }
            .step-card h3{
                font-size: 18px;
            }
            .step-description{
                font-size: 14px;
                line-height: 1.5;
            }
            .footer-container{
                gap: 40px;
            }
            .footer-col h4{
                font-size: 20px;
            }
            .footer-col ul li a{
                font-size: 16px;
            }
        }

        @media (max-width: 430px){
            .navbar{
                padding: 12px 14px;
                gap: 10px;
            }
            .logo{
                font-size: 18px;
            }
            .logo-icon{
                width: 22px;
            }
            .btn-download{
                padding: 8px 14px;
                font-size: 11px;
            }
            .hero-container{
                padding: 25px 16px;
            }
            .hero-title{
                font-size: 28px;
                line-height: 1.2;
            }
            .hero-subtitle{
                font-size: 13px;
                line-height: 1.6;
            }
            .phone-mockup{
                max-width: 230px;
            }
            .section-title{
                font-size: 24px;
            }
            .feature-card{
                padding: 28px 20px;
            }
            .feature-card h3{
                font-size: 18px;
            }
            .feature-card p{
                font-size: 13px;
            }
            .step-description{
                font-size: 14px;
            }
            .footer-col h4{
                font-size: 20px;
            }
            .footer-col ul li a{
                font-size: 15px;
            }
        }
        /* MODAL DOWNLOAD */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }
        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        .modal-box {
            background: #fff;
            border-radius: 24px;
            padding: 36px 40px 28px;
            max-width: 420px;
            width: 90%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            transform: scale(0.92);
            transition: transform 0.25s ease;
        }
        .modal-overlay.active .modal-box {
            transform: scale(1);
        }
        .modal-icon {
            width: 56px;
            height: 56px;
            margin: 0 auto 16px;
            background: #eef4ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-icon svg {
            width: 28px;
            height: 28px;
        }
        .modal-box h3 {
            font-size: 20px;
            color: var(--text-dark);
            margin-bottom: 8px;
        }
        .modal-box p {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 24px;
            line-height: 1.6;
        }
        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .modal-actions .btn-yakin {
            padding: 10px 32px;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            background: var(--primary-blue);
            color: #fff;
            transition: background 0.2s;
        }
        .modal-actions .btn-yakin:hover {
            background: #043d82;
        }
        .modal-actions .btn-batal {
            padding: 10px 32px;
            border: 1px solid #d0d5dd;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            background: #fff;
            color: var(--text-dark);
            transition: background 0.2s;
        }
        .modal-actions .btn-batal:hover {
            background: #f2f4f7;
        }
    </style>
</head>
<body>

    <div class="bg-decoration">
        <div class="blob blob-blue"></div>
        <div class="blob blob-yellow"></div>
    </div>

    <header class="header">
        <nav class="navbar">
            <a href="#/beranda" class="logo">
                <span class="logo-f">F</span>
                <img src="{{ asset('image/logoframe.png') }}" alt="Logo Icon" class="logo-icon">
                <span class="logo-text">KUSIN</span>
            </a>
            <ul class="nav-links" id="navLinks">
                <li><a href="#beranda" class="active" data-nav>Beranda</a></li>
                <li><a href="#fitur" data-nav>Fitur</a></li>
                <li><a href="#cara-kerja" data-nav>Cara Kerja</a></li>
            </ul>

            <a href="#" class="btn-download" id="btnDownload" download>Download App</a>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <div id="toast" class="toast"></div>

    <!-- MODAL DOWNLOAD -->
    <div class="modal-overlay" id="modalDownload">
        <div class="modal-box">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#0754B0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            </div>
            <h3>Download Aplikasi</h3>
            <p>Apakah kamu yakin ingin mendownload aplikasi Fokusin?</p>
            <div class="modal-actions">
                <button class="btn-batal" id="btnBatalDownload">Batal</button>
                <a href="http://fokusin.najlahaura.my.id/fokusin.apk" id="btnYakinDownload" download>Yakin</a>
            </div>
        </div>
    </div>

    <main id="app">
        <div id="page-beranda" class="page active">
            <section id="beranda" class="hero">
                <div class="container hero-container">
                    <div class="hero-content">
                        <h1 class="hero-title">
                            Atur Waktu,<br>
                            <span class="text-yellow">Tingkatkan Fokus,</span><br>
                            Raih Tujuanmu
                            <div class="title-underline"></div>
                        </h1>
                        <p class="hero-subtitle">
                            Fokusin adalah aplikasi manajemen waktu yang membantumu tetap terorganisir, fokus, dalam produktif setiap hari
                        </p>
                        <div class="hero-actions">
                            <a href="#/login" class="btn-primary" data-nav>Mulai Sekarang</a>
                        </div>
                    </div>
                    <div class="hero-image">
                        <img src="{{ asset('image/logo.png') }}" alt="Fokusin App Mockup" class="phone-mockup">
                    </div>
                </div>
            </section>

            <section id="fitur" class="features">
                <div class="container">
                    <h2 class="section-title">Fitur Utama <span class="logo-inline">F<img src="{{ asset('image/logoframe.png') }}" alt="">KUSIN</span></h2>
                    <div class="features-grid">
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <img src="{{ asset('image/pomodoro.png') }}" alt="Pomodoro Icon">
                            </div>
                            <h3>Pomodoro</h3>
                            <p>Atur waktu belajar dan tingkatkan fokus dengan teknik Pomodoro yang efektif.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <img src="{{ asset('image/todolist.png') }}" alt="To Do List Icon">
                            </div>
                            <h3>To Do List</h3>
                            <p>Buat daftar tugas harian dan selesaikan dengan lebih mudah.</p>
                        </div>
                        <div class="feature-card">
                            <div class="feature-icon-wrapper">
                                <img src="{{ asset('image/motivasi.png') }}" alt="Motivasi Icon">
                            </div>
                            <h3>Motivasi</h3>
                            <p>Dapatkan motivasi harian dan tetap semangat dalam mencapai tujuan.</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="cara-kerja" class="how-it-works">
                <div class="container">
                    <h2 class="section-title">Cara Kerja <span class="logo-inline">F<img src="{{ asset('image/logoframe.png') }}" alt="">KUSIN</span></h2>
                    <div class="steps-grid">
                        <div class="step-card">
                            <div class="step-number">1</div>
                            <div class="step-illustration">
                                <img src="{{ asset('image/icon_tugas.png') }}" alt="Buat Tugas Illustration">
                            </div>
                            <h3>Buat Tugas</h3>
                            <p class="step-description">Tambahkan tugas yang ingin kamu kerjakan setiap hari</p>
                        </div>
                        <div class="step-card">
                            <div class="step-number">2</div>
                            <div class="step-illustration">
                                <img src="{{ asset('image/pengingat.png') }}" alt="Atur Pengingat Illustration">
                            </div>
                            <h3>Atur Pengingat</h3>
                            <p class="step-description">Tentukan waktu dan dapatkan pengingat tepat waktu</p>
                        </div>
                        <div class="step-card">
                            <div class="step-number">3</div>
                            <div class="step-illustration">
                                <img src="{{ asset('image/fokus_selese.png') }}" alt="Fokus & Selesai Illustration">
                            </div>
                            <h3>Fokus & Selesai</h3>
                            <p class="step-description">Fokus pada tugasmu dan raih tujuanmu setiap hari</p>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="footer">
                <div class="container footer-container">
                    <div class="footer-info">
                        <div class="logo">
                            <span class="logo-f">F</span>
                            <img src="{{ asset('image/logoframe.png') }}" alt="Logo Icon" class="logo-icon">
                            <span class="logo-text">KUSIN</span>
                        </div>
                        <p>Aplikasi manajemen waktu untuk membantumu tetap fokus, terorganisir, dan produktif setiap hari.</p>
                    </div>
                    <div class="footer-links-group">
                        <div class="footer-col">
                            <h4>Navigasi</h4>
                            <ul>
                                <li><a href="#beranda">Beranda</a></li>
                                <li><a href="#fitur">Fitur</a></li>
                                <li><a href="#cara-kerja">Cara Kerja</a></li>
                            </ul>
                        </div>
                        <div class="footer-col">
                            <h4>Fitur</h4>
                            <ul>
                                <li><a href="#/login">Pomodoro</a></li>
                                <li><a href="#/login">To do List</a></li>
                                <li><a href="#/login">Motivasi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <p>&copy; 2024 Fokusin. All rights reserved.</p>
                </div>
            </footer>
        </div>

        <div id="page-login" class="page">
            <div class="auth-container">
                <div class="auth-card">
                    <div class="auth-header">
                        <div class="auth-logo">
                            <span class="logo-f">F</span>
                            <img src="{{ asset('image/logoframe.png') }}" alt="Logo" class="logo-icon">
                            <span class="logo-text">KUSIN</span>
                        </div>
                        <h2>Selamat Datang</h2>
                        <p>Masuk untuk melanjutkan</p>
                    </div>
                    <form id="loginForm" class="auth-form">
                        <div class="form-group">
                            <label for="loginEmail">Email</label>
                            <input type="email" id="loginEmail" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="loginPassword">Password</label>
                            <input type="password" id="loginPassword" placeholder="Masukkan password" required>
                        </div>
                        <button type="submit" class="btn-auth-submit" id="loginBtn">
                            <span class="btn-text">Masuk</span>
                            <span class="btn-loader" style="display:none">Memproses...</span>
                        </button>
                    </form>
                    <div class="auth-divider">
                        <span>atau</span>
                    </div>
                    <button class="btn-google" id="googleLoginBtn">
                        <svg width="20" height="20" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59A14.5 14.5 0 0 1 9.5 24c0-1.59.28-3.14.76-4.59l-7.98-6.19A23.99 23.99 0 0 0 0 24c0 3.77.87 7.35 2.56 10.56l7.97-5.97z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 5.97C6.51 42.62 14.62 48 24 48z"/></svg>
                        Masuk dengan Google
                    </button>
                    <p class="auth-footer-text">
                        Belum punya akun? <a href="#/register" data-nav>Daftar</a>
                    </p>
                </div>
            </div>
        </div>

        <div id="page-register" class="page">
            <div class="auth-container">
                <div class="auth-card">
                    <div class="auth-header">
                        <div class="auth-logo">
                            <span class="logo-f">F</span>
                            <img src="{{ asset('image/logoframe.png') }}" alt="Logo" class="logo-icon">
                            <span class="logo-text">KUSIN</span>
                        </div>
                        <h2>Buat Akun</h2>
                        <p>Daftar untuk memulai</p>
                    </div>
                    <form id="registerForm" class="auth-form">
                        <div class="form-group">
                            <label for="regName">Nama</label>
                            <input type="text" id="regName" placeholder="Masukkan nama" required>
                        </div>
                        <div class="form-group">
                            <label for="regEmail">Email</label>
                            <input type="email" id="regEmail" placeholder="Masukkan email" required>
                        </div>
                        <div class="form-group">
                            <label for="regPassword">Password</label>
                            <input type="password" id="regPassword" placeholder="Minimal 8 karakter" required>
                        </div>
                        <button type="submit" class="btn-auth-submit" id="registerBtn">
                            <span class="btn-text">Daftar</span>
                            <span class="btn-loader" style="display:none">Memproses...</span>
                        </button>
                    </form>
                    <div class="auth-divider">
                        <span>atau</span>
                    </div>
                    <button class="btn-google" id="googleRegisterBtn">
                        <svg width="20" height="20" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59A14.5 14.5 0 0 1 9.5 24c0-1.59.28-3.14.76-4.59l-7.98-6.19A23.99 23.99 0 0 0 0 24c0 3.77.87 7.35 2.56 10.56l7.97-5.97z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 5.97C6.51 42.62 14.62 48 24 48z"/></svg>
                        Daftar dengan Google
                    </button>
                    <p class="auth-footer-text">
                        Sudah punya akun? <a href="#/login" data-nav>Masuk</a>
                    </p>
                </div>
            </div>
        </div>

        <div id="page-dashboard" class="page">
            <div class="dashboard-container">
                <div class="dashboard-sidebar">
                    <div class="sidebar-header">
                        <div class="auth-logo">
                            <span class="logo-f">F</span>
                            <img src="{{ asset('image/logoframe.png') }}" alt="Logo" class="logo-icon">
                            <span class="logo-text">KUSIN</span>
                        </div>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="#/dashboard" class="sidebar-link active" data-nav>
                            <span>&#9679;</span> Beranda
                        </a>
                        <a href="#/dashboard/tugas" class="sidebar-link" data-nav>
                            <span>&#9679;</span> Tugas
                        </a>
                        <a href="#/dashboard/fokus" class="sidebar-link" data-nav>
                            <span>&#9679;</span> Fokus
                        </a>
                        <a href="#/dashboard/progres" class="sidebar-link" data-nav>
                            <span>&#9679;</span> Progres
                        </a>
                        <a href="#/dashboard/kutipan" class="sidebar-link" data-nav>
                            <span>&#9679;</span> Kutipan
                        </a>
                    </nav>
                    <div class="sidebar-footer">
                        <div class="sidebar-user" id="sidebarUser">
                            <div class="avatar-wrapper" id="avatarWrapper">
                                <img src="{{ asset('image/logoframe.png') }}" alt="Avatar" class="user-avatar" id="userAvatar">
                                <div class="avatar-overlay">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                                </div>
                            </div>
                            <input type="file" id="avatarInput" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" style="display:none">
                            <div>
                                <p class="user-name" id="userName">User</p>
                                <p class="user-email" id="userEmail">user@email.com</p>
                            </div>
                        </div>
                        <button class="btn-logout" id="logoutBtn">Keluar</button>
                    </div>
                </div>
                <div class="dashboard-main">
                    <div id="dashboardContent">
                        <div class="dashboard-welcome">
                            <h1>Halo, <span id="dashboardUserName">User</span>!</h1>
                            <p>Selamat datang di Fokusin. Mulai atur waktumu dan tingkatkan produktivitas!</p>
                        </div>
                        <div class="dashboard-stats">
                            <div class="stat-card">
                                <h3>Total Tugas</h3>
                                <p class="stat-number" id="statTugas">0</p>
                            </div>
                            <div class="stat-card">
                                <h3>Selesai</h3>
                                <p class="stat-number" id="statSelesai">0</p>
                            </div>
                            <div class="stat-card">
                                <h3>Fokus Hari Ini</h3>
                                <p class="stat-number" id="statFokus">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = '{{ url('/api') }}';

        const api = axios.create({
            baseURL: API_BASE_URL,
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            },
        });

        api.interceptors.request.use(function (config) {
            const token = localStorage.getItem('token');
            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }
            return config;
        });

        api.interceptors.response.use(
            function (response) {
                return response;
            },
            function (error) {
                if (error.response && error.response.status === 401) {
                    localStorage.removeItem('token');
                    localStorage.removeItem('user');
                    if (window.location.hash.startsWith('#/dashboard')) {
                        window.location.hash = '#/login';
                    }
                }
                return Promise.reject(error);
            }
        );

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

            /* MODAL DOWNLOAD */
            var btnDownload = document.getElementById('btnDownload');
            var modalDownload = document.getElementById('modalDownload');
            var btnYakin = document.getElementById('btnYakinDownload');
            var btnBatal = document.getElementById('btnBatalDownload');

            

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
                    if (APK_DOWNLOAD_URL) {
                        var a = document.createElement('a');
                        a.href = APK_DOWNLOAD_URL;
                        a.download = '';
                        document.body.appendChild(a);
                        a.click();
                        document.body.removeChild(a);
                    }
                });
            }

            if (modalDownload) {
                modalDownload.addEventListener('click', function (e) {
                    if (e.target === modalDownload) {
                        modalDownload.classList.remove('active');
                    }
                });
            }

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
    </script>

</body>
</html>
