<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

        <style>
            *, *::before, *::after {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            :root {
                --bg: #0c0c0f;
                --card-bg: #13131a;
                --border: rgba(255,255,255,0.07);
                --accent: #c9a84c;
                --accent-dim: rgba(201,168,76,0.12);
                --text-primary: #eeeae0;
                --text-muted: #6b6b72;
                --text-sub: #9a9a9a;
            }

            body {
                background-color: var(--bg);
                font-family: 'DM Sans', sans-serif;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 2rem;
                overflow: hidden;
            }

            body::before {
                content: '';
                position: fixed;
                top: -20%;
                left: 50%;
                transform: translateX(-50%);
                width: 700px;
                height: 400px;
                background: radial-gradient(ellipse, rgba(201,168,76,0.06) 0%, transparent 70%);
                pointer-events: none;
            }

            body::after {
                content: '';
                position: fixed;
                bottom: -10%;
                right: 10%;
                width: 500px;
                height: 300px;
                background: radial-gradient(ellipse, rgba(100, 80, 200, 0.05) 0%, transparent 70%);
                pointer-events: none;
            }

            .wrapper {
                width: 100%;
                max-width: 860px;
                animation: fadeUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
            }

            @keyframes fadeUp {
                from { opacity: 0; transform: translateY(24px); }
                to   { opacity: 1; transform: translateY(0); }
            }

            .label {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                font-size: 11px;
                font-weight: 500;
                letter-spacing: 0.12em;
                text-transform: uppercase;
                color: var(--accent);
                margin-bottom: 1.5rem;
                padding: 0.35rem 0.85rem;
                border: 1px solid rgba(201,168,76,0.25);
                border-radius: 100px;
                background: var(--accent-dim);
            }

            .label-dot {
                width: 5px;
                height: 5px;
                border-radius: 50%;
                background: var(--accent);
                animation: blink 2s ease-in-out infinite;
            }

            @keyframes blink {
                0%, 100% { opacity: 1; }
                50% { opacity: 0.3; }
            }

            .card {
                background: var(--card-bg);
                border: 1px solid var(--border);
                border-radius: 20px;
                padding: 3rem 3.5rem;
                position: relative;
                overflow: hidden;
            }

            .card::before {
                content: '';
                position: absolute;
                top: 0; left: 0; right: 0;
                height: 1px;
                background: linear-gradient(90deg, transparent, rgba(201,168,76,0.35), transparent);
            }

            .card-deco {
                position: absolute;
                top: -40px; right: -40px;
                width: 180px; height: 180px;
                border-radius: 50%;
                border: 1px solid rgba(201,168,76,0.07);
                pointer-events: none;
            }

            .card-deco::after {
                content: '';
                position: absolute;
                inset: 20px;
                border-radius: 50%;
                border: 1px solid rgba(201,168,76,0.04);
            }

            .card-inner {
                position: relative;
                display: flex;
                flex-direction: column;
            }

            .card-inner::before {
                content: '';
                position: absolute;
                left: -3.5rem;
                top: 0; bottom: 0;
                width: 3px;
                background: linear-gradient(to bottom, var(--accent), transparent);
                border-radius: 0 2px 2px 0;
            }

            .greeting {
                font-size: 11px;
                letter-spacing: 0.08em;
                text-transform: uppercase;
                color: var(--text-muted);
                margin-bottom: 0.75rem;
            }

            .name {
                font-family: 'Playfair Display', serif;
                font-size: 2rem;
                font-weight: 600;
                color: var(--text-primary);
                line-height: 1.2;
                margin-bottom: 0.5rem;
            }

            .nim-row {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 2rem;
            }

            .nim-tag {
                font-size: 11.5px;
                letter-spacing: 0.06em;
                color: var(--text-muted);
            }

            .nim {
                font-size: 13px;
                font-weight: 500;
                color: var(--text-sub);
                letter-spacing: 0.05em;
                background: rgba(255,255,255,0.04);
                padding: 3px 10px;
                border-radius: 6px;
                border: 1px solid rgba(255,255,255,0.07);
            }

            .btn {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                background: #ffffff;
                color: #0c0c0f;
                font-size: 0.875rem;
                font-weight: 500;
                font-family: 'DM Sans', sans-serif;
                padding: 0.7rem 1.4rem;
                border-radius: 10px;
                border: none;
                cursor: pointer;
                text-decoration: none;
                transition: background 0.2s, transform 0.2s, box-shadow 0.2s;
                box-shadow: 0 2px 20px rgba(255,255,255,0.08);
                width: fit-content;
            }

            .btn:hover {
                background: #f0f0ee;
                transform: translateY(-2px);
                box-shadow: 0 6px 30px rgba(255,255,255,0.13);
            }

            .btn svg {
                width: 15px;
                height: 15px;
                opacity: 0.55;
                flex-shrink: 0;
            }

            .meta {
                margin-top: 2rem;
                padding-top: 1.5rem;
                border-top: 1px solid var(--border);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .meta-text {
                font-size: 11.5px;
                color: var(--text-muted);
                letter-spacing: 0.03em;
            }

            .meta-badge {
                display: inline-flex;
                align-items: center;
                gap: 6px;
                font-size: 11px;
                color: var(--text-muted);
            }

            .meta-badge span {
                display: inline-block;
                width: 6px; height: 6px;
                border-radius: 50%;
                background: #3fb950;
                box-shadow: 0 0 6px rgba(63,185,80,0.6);
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="label">
                <span class="label-dot"></span>
                Praktikum Pemrograman Web
            </div>

            <div class="card">
                <div class="card-deco"></div>
                <div class="card-inner">
                    <p class="greeting">Mahasiswa</p>
                    <h1 class="name">Irfansyah Ridho Aninda</h1>
                    <div class="nim-row">
                        <span class="nim-tag">NIM</span>
                        <span class="nim">20230140223</span>
                    </div>

                    <a href="#" class="btn">
                        <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 2h7l4 4v8H2V2z" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                            <path d="M9 2v4h4" stroke="currentColor" stroke-width="1.4" stroke-linejoin="round"/>
                            <path d="M5 9h6M5 11.5h4" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                        </svg>
                        Modul Pertemuan 1
                    </a>

                    <div class="meta">
                        <span class="meta-text">Teknik Informatika · 2026</span>
                        <span class="meta-badge">
                            <span></span>
                            Active Session
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>