<?php
require __DIR__ . '/api-config.php';
$boot = [
  'view' => 'buyer',
  'buyer' => !empty($_SESSION['buyer_id']) ? ['name' => (string)($_SESSION['buyer_name'] ?? ''), 'email' => (string)($_SESSION['buyer_email'] ?? '')] : null,
  'seller' => !empty($_SESSION['seller_id']) ? ['name' => (string)($_SESSION['seller_name'] ?? ''), 'email' => (string)($_SESSION['seller_email'] ?? '')] : null,
  'routes' => ['buyer' => 'index.php', 'seller' => 'sellerindex.php', 'auth' => 'auth.php', 'data' => 'api-buyer-data.php']
];
$bootTag = '<script>window.EASYBUY_BOOT=' . json_encode($boot, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . ';</script>';
$buyerPage = <<<'HTML'
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#111827">
    <meta name="description" content="EasyBuy — a student-to-student campus marketplace for affordable textbooks, tech and everyday essentials.">
    <title>EasyBuy | Campus Marketplace</title>
    <link rel="icon" type="image/jpeg" href="images/images.jpg">
    <style>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@400;600;700;800&display=swap');

:root {
    --blue: #2874f0;
    --navy: #14213d;
    --cyan: #dff7ff;
    --peach: #fff0e8;
    --purple: #eee8ff;
    --ink: #1c2940;
    --muted: #718096;
    --paper: #f6f9ff;
    --white: #fff;
    --line: #e4ebf5;
    --shadow: 0 18px 48px #1d477b12
}

* {
    box-sizing: border-box
}

html {
    scroll-behavior: smooth
}

body {
    margin: 0;
    font-family: 'DM Sans', sans-serif;
    color: var(--ink);
    background: var(--paper)
}

a {
    color: inherit;
    text-decoration: none
}

button,
input,
select {
    font: inherit
}

button {
    cursor: pointer;
    border: 0
}

.wrap {
    width: min(1180px, 92%);
    margin: auto
}

.topline {
    background: var(--navy);
    color: #eaf3ff;
    text-align: center;
    padding: 8px;
    font-size: 12px;
    letter-spacing: .2px
}

.navbar {
    position: sticky;
    top: 0;
    z-index: 50;
    background: #ffffffed;
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--line)
}

.navinner {
    min-height: 76px;
    display: flex;
    align-items: center;
    gap: 24px
}

.logo {
    font: 800 25px Manrope;
    color: var(--navy);
    letter-spacing: -1px
}

.logo b {
    color: var(--blue)
}

.navlinks {
    display: flex;
    gap: 21px;
    align-items: center;
    font-weight: 600;
    font-size: 14px;
    margin-left: auto
}

.navlinks a:hover {
    color: var(--blue)
}

.navactions {
    display: flex;
    gap: 10px;
    align-items: center
}

.search {
    width: 210px;
    border: 1px solid var(--line);
    background: #f7faff;
    border-radius: 13px;
    padding: 11px 13px;
    outline: none
}

.pillbtn,
.primary,
.secondary {
    border-radius: 12px;
    padding: 12px 17px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: .2s
}

.primary {
    background: var(--blue);
    color: white;
    box-shadow: 0 8px 18px #2874f026
}

.primary:hover {
    transform: translateY(-2px);
    background: #155ed8
}

.secondary {
    background: #fff;
    border: 1px solid var(--line);
    color: var(--ink)
}

.secondary:hover {
    border-color: var(--blue);
    color: var(--blue)
}

.cartbtn {
    background: var(--navy);
    color: #fff;
    border-radius: 12px;
    padding: 11px 14px;
    font-weight: 700
}

.hero {
    padding: 52px 0 34px
}

.hero-grid {
    display: grid;
    grid-template-columns: 1.05fr .95fr;
    gap: 34px;
    align-items: center
}

.eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e5f1ff;
    color: #2467c9;
    border-radius: 99px;
    padding: 8px 12px;
    font-weight: 700;
    font-size: 12px
}

.hero h1 {
    font: 800 clamp(38px, 5vw, 62px)/1.06 Manrope;
    letter-spacing: -2.5px;
    margin: 19px 0 16px;
    color: var(--navy)
}

.hero h1 span {
    color: var(--blue)
}

.hero p {
    font-size: 17px;
    line-height: 1.7;
    color: #66758b;
    max-width: 540px
}

.hero-actions {
    display: flex;
    gap: 12px;
    margin-top: 25px;
    flex-wrap: wrap
}

.hero-stats {
    display: flex;
    gap: 25px;
    margin-top: 30px
}

.stat strong {
    display: block;
    font: 800 20px Manrope;
    color: var(--navy)
}

.stat span {
    font-size: 12px;
    color: var(--muted)
}

.hero-art {
    min-height: 400px;
    border-radius: 34px;
    background: linear-gradient(140deg, #dff7ff, #eae8ff 58%, #fff0e8);
    position: relative;
    overflow: hidden;
    padding: 20px;
    display: grid;
    place-items: center
}

.hero-art:before,
.hero-art:after {
    content: '';
    position: absolute;
    border-radius: 50%;
    background: #ffffff77
}

.hero-art:before {
    width: 270px;
    height: 270px;
    top: -80px;
    right: -60px
}

.hero-art:after {
    width: 190px;
    height: 190px;
    bottom: -80px;
    left: -40px
}

.hero-product {
    width: min(72%, 350px);
    position: relative;
    z-index: 2;
    transform: rotateY(-12deg) rotateX(4deg);
    filter: drop-shadow(0 25px 20px #304a6b2c);
    animation: float 5s ease-in-out infinite
}

.float-card {
    position: absolute;
    z-index: 3;
    background: #fff;
    border: 1px solid #ffffffbd;
    box-shadow: var(--shadow);
    border-radius: 16px;
    padding: 12px 15px;
    font-weight: 700;
    font-size: 13px
}

.float-card small {
    display: block;
    color: var(--muted);
    font-weight: 500;
    margin-top: 3px
}

.fc1 {
    top: 35px;
    left: 22px
}

.fc2 {
    right: 20px;
    bottom: 35px
}

.section {
    padding: 34px 0 48px
}

.sectionhead {
    display: flex;
    align-items: end;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 22px
}

.sectionhead h2 {
    font: 800 clamp(25px, 3vw, 34px) Manrope;
    letter-spacing: -1px;
    margin: 0;
    color: var(--navy)
}

.sectionhead p {
    color: var(--muted);
    margin: 7px 0 0
}

.textlink {
    color: var(--blue);
    font-weight: 700
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px
}

.category {
    border-radius: 20px;
    padding: 18px;
    background: #fff;
    border: 1px solid var(--line);
    display: flex;
    align-items: center;
    gap: 14px;
    transition: .25s;
    cursor: pointer
}

.category:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow);
    border-color: #bcd5ff
}

.category img {
    width: 65px;
    height: 65px;
    object-fit: contain;
    border-radius: 15px;
    background: #f4f8ff
}

.category strong {
    display: block;
    font-size: 14px
}

.category small {
    display: block;
    color: var(--muted);
    margin-top: 5px
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px
}

.product-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 20px;
    padding: 12px;
    position: relative;
    transition: transform .25s, box-shadow .25s;
    transform-style: preserve-3d;
    perspective: 1000px
}

.product-card:hover {
    transform: translateY(-6px) rotateX(2deg) rotateY(-2deg);
    box-shadow: 0 20px 40px #163d701b
}

.product-image-wrap {
    background: linear-gradient(145deg, #f0f7ff, #fff2ed);
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    cursor: pointer
}

.product-image {
    display: block;
    width: 100%;
    aspect-ratio: 1.13;
    object-fit: contain;
    transition: transform .5s;
    transform-style: preserve-3d
}

.product-card:hover .product-image {
    transform: scale(1.045) rotateY(-5deg)
}

.tag {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #fff;
    border-radius: 99px;
    padding: 6px 9px;
    font-size: 10px;
    font-weight: 800;
    color: #356
}

.heart {
    position: absolute;
    top: 9px;
    right: 9px;
    background: #fff;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-size: 17px;
    box-shadow: 0 3px 10px #2342
}

.product-name {
    font-weight: 800;
    margin: 12px 2px 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis
}

.product-category {
    font-size: 11px;
    color: var(--muted)
}

.rating {
    font-size: 12px;
    color: #9a6a0b;
    margin: 7px 2px
}

.price-row {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin: 7px 2px
}

.price {
    font-weight: 800;
    font-size: 20px;
    color: var(--navy)
}

.oldprice {
    font-size: 12px;
    color: #99a3b4;
    text-decoration: line-through
}

.discount {
    font-size: 11px;
    font-weight: 800;
    color: #0d956c
}

.sellerline {
    font-size: 11px;
    color: var(--muted);
    margin: 8px 2px
}

.card-actions {
    display: flex;
    gap: 7px;
    margin-top: 11px
}

.card-actions button {
    flex: 1;
    padding: 10px 6px;
    font-size: 12px;
    border-radius: 10px
}

.addbtn {
    background: #e8f1ff;
    color: #215fbe;
    font-weight: 800
}

.viewbtn {
    background: var(--navy);
    color: #fff;
    font-weight: 800
}

.deals {
    border-radius: 28px;
    background: linear-gradient(110deg, #172846, #254f89);
    padding: 28px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    overflow: hidden;
    position: relative
}

.deals:after {
    content: '☾';
    font-size: 210px;
    position: absolute;
    right: 18%;
    top: -80px;
    color: #ffffff0c
}

.deals h2 {
    font: 800 30px Manrope;
    margin: 0
}

.deals p {
    color: #d4e5ff
}

.deal-clock {
    display: flex;
    gap: 9px
}

.timebox {
    background: #ffffff1b;
    border: 1px solid #ffffff2b;
    border-radius: 12px;
    padding: 12px;
    min-width: 55px;
    text-align: center;
    font-weight: 800
}

.timebox small {
    display: block;
    font-size: 9px;
    font-weight: 500;
    color: #c9dbf4
}

.campus-band {
    background: #e8f7ff;
    border-radius: 24px;
    padding: 25px;
    display: flex;
    justify-content: space-between;
    gap: 20px;
    align-items: center
}

.campus-band h3 {
    font: 800 23px Manrope;
    margin: 0
}

.campus-band p {
    color: #60738b;
    margin: 7px 0 0
}

.footer {
    background: #101e35;
    color: #dce7f6;
    margin-top: 45px;
    padding: 42px 0 20px
}

.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr;
    gap: 35px
}

.footer h3 {
    color: white
}

.footer p,
.footer a {
    color: #b8c7dc;
    font-size: 13px;
    line-height: 1.8
}

.footerlinks {
    display: grid;
    gap: 6px
}

.copyright {
    border-top: 1px solid #ffffff20;
    margin-top: 28px;
    padding-top: 17px;
    font-size: 12px;
    color: #91a4bf
}

.page-title {
    padding: 35px 0 20px
}

.page-title h1 {
    font: 800 36px Manrope;
    margin: 0;
    color: var(--navy)
}

.filters {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin: 15px 0 24px
}

.filters input,
.filters select {
    border: 1px solid var(--line);
    border-radius: 12px;
    background: white;
    padding: 11px 13px
}

.detail-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 35px;
    padding: 35px 0
}

.detail-visual {
    background: linear-gradient(145deg, #dff7ff, #f3edff, #fff1e8);
    border-radius: 28px;
    position: relative;
    padding: 30px;
    display: grid;
    place-items: center;
    min-height: 400px;
    perspective: 1100px;
    overflow: hidden
}

.detail-visual img {
    width: min(100%, 480px);
    max-height: 430px;
    object-fit: contain;
    transition: transform .35s;
    transform-style: preserve-3d;
    filter: drop-shadow(0 25px 20px #263a5b25)
}

.rotate-controls {
    position: absolute;
    bottom: 17px;
    display: flex;
    gap: 8px
}

.rotate-controls button {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 9px 12px;
    font-weight: 700
}

.detail-info h1 {
    font: 800 35px Manrope;
    line-height: 1.15;
    margin: 12px 0
}

.detail-info .price {
    font-size: 30px
}

.detail-info p {
    color: #65748b;
    line-height: 1.8
}

.specs {
    border-top: 1px solid var(--line);
    margin-top: 22px
}

.specrow {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    padding: 12px 0;
    border-bottom: 1px solid var(--line);
    font-size: 13px
}

.specrow span:first-child {
    color: var(--muted)
}

.detail-actions {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    flex-wrap: wrap
}

.cart-layout {
    display: grid;
    grid-template-columns: 1.5fr .8fr;
    gap: 24px
}

.cart-item {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 17px;
    padding: 14px;
    display: flex;
    gap: 15px;
    align-items: center;
    margin-bottom: 12px
}

.cart-item img {
    width: 100px;
    height: 95px;
    object-fit: contain;
    border-radius: 12px;
    background: #f3f7ff
}

.cart-item-info {
    flex: 1
}

.qty {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 8px
}

.qty button {
    background: #eaf2ff;
    border-radius: 7px;
    width: 27px;
    height: 27px
}

.summary {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 20px;
    padding: 22px;
    height: max-content
}

.summary h3 {
    margin-top: 0
}

.sumrow {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    color: #64738a
}

.sumtotal {
    border-top: 1px solid var(--line);
    font-size: 20px;
    font-weight: 800;
    color: var(--navy)
}

.formcard {
    max-width: 760px;
    margin: 20px auto;
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 22px;
    padding: 25px
}

.formgrid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px
}

.field {
    display: grid;
    gap: 7px;
    margin-bottom: 14px
}

.field label {
    font-weight: 700;
    font-size: 13px
}

.field input,
.field textarea,
.field select {
    width: 100%;
    border: 1px solid var(--line);
    border-radius: 11px;
    padding: 12px;
    outline: none
}

.field textarea {
    min-height: 100px;
    resize: vertical
}

.empty {
    padding: 50px;
    text-align: center;
    color: var(--muted);
    background: #fff;
    border-radius: 20px
}

.loading-screen {
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: #f6f9ff;
    display: grid;
    place-items: center;
    transition: opacity .35s, visibility .35s
}

.loading-screen.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none
}

.moon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #e9f1ff;
    box-shadow: 0 0 0 12px #2874f012, 0 0 60px #2874f045;
    position: relative;
    animation: moonPulse 1.6s ease-in-out infinite
}

.moon:after {
    content: '';
    position: absolute;
    width: 84px;
    height: 84px;
    top: -7px;
    left: 24px;
    background: #f6f9ff;
    border-radius: 50%
}

.loader-label {
    margin-top: 25px;
    text-align: center;
    color: #55709a;
    font-weight: 700;
    letter-spacing: 1px;
    font-size: 12px
}

@keyframes moonPulse {
    50% {
        transform: scale(1.07);
        box-shadow: 0 0 0 19px #2874f00a, 0 0 75px #2874f05c
    }
}

@keyframes float {
    50% {
        transform: translateY(-10px) rotateY(-8deg) rotateX(4deg)
    }
}

@media(max-width:980px) {
    .navinner {
        flex-wrap: wrap;
        padding: 12px 0
    }

    .navlinks {
        order: 3;
        width: 100%;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap
    }

    .navactions {
        margin-left: auto
    }

    .search {
        width: 150px
    }

    .hero-grid {
        grid-template-columns: 1fr 1fr
    }

    .category-grid {
        grid-template-columns: repeat(2, 1fr)
    }

    .product-grid {
        grid-template-columns: repeat(3, 1fr)
    }
}

@media(max-width:700px) {
    .navinner {
        gap: 10px
    }

    .logo {
        font-size: 22px
    }

    .navlinks {
        font-size: 12px;
        gap: 12px
    }

    .navactions .search {
        display: none
    }

    .hero {
        padding-top: 28px
    }

    .hero-grid,
    .detail-grid,
    .cart-layout {
        grid-template-columns: 1fr
    }

    .hero-art {
        min-height: 310px
    }

    .hero-stats {
        gap: 16px
    }

    .product-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px
    }

    .product-card {
        padding: 8px;
        border-radius: 16px
    }

    .product-name {
        font-size: 13px
    }

    .card-actions {
        flex-direction: column
    }

    .card-actions button {
        padding: 9px
    }

    .deals {
        align-items: flex-start;
        flex-direction: column
    }

    .deal-clock {
        gap: 6px
    }

    .timebox {
        min-width: 47px;
        padding: 9px
    }

    .campus-band {
        align-items: flex-start;
        flex-direction: column
    }

    .footer-grid {
        grid-template-columns: 1fr
    }

    .detail-visual {
        min-height: 310px
    }

    .detail-info h1 {
        font-size: 29px
    }

    .formgrid {
        grid-template-columns: 1fr
    }

    .cart-item {
        align-items: flex-start
    }

    .cart-item img {
        width: 75px;
        height: 75px
    }

    .section {
        padding: 25px 0 35px
    }

    .sectionhead {
        align-items: flex-start;
        flex-direction: column
    }

    .category {
        padding: 12px;
        gap: 10px
    }

    .category img {
        width: 48px;
        height: 48px
    }

    .category strong {
        font-size: 12px
    }
}

@media(prefers-reduced-motion:reduce) {

    *,
    *:before,
    *:after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
        scroll-behavior: auto !important
    }
}


/* EasyBuy side navigation and connected features — inherits the original theme */
.eb-menu-toggle {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid var(--line);
    background: #fff;
    color: var(--navy);
    border-radius: 11px;
    padding: 10px 12px;
    font-weight: 800;
    cursor: pointer;
    white-space: nowrap
}

.eb-menu-toggle:hover {
    border-color: #bcd5ff;
    background: #f4f8ff
}

.eb-menu-label {
    font-size: 12px
}

.eb-side-overlay {
    position: fixed;
    inset: 0;
    z-index: 10020;
    background: #0d1c34a8;
    opacity: 0;
    visibility: hidden;
    transition: opacity .22s, visibility .22s
}

.eb-side-overlay.open {
    opacity: 1;
    visibility: visible
}

.eb-sidebar {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: min(340px, 88vw);
    overflow: auto;
    background: #fff;
    padding: 20px 16px;
    box-shadow: 15px 0 50px #10234225;
    transform: translateX(-102%);
    transition: transform .25s
}

.eb-side-overlay.open .eb-sidebar {
    transform: translateX(0)
}

.eb-side-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2px 4px 18px;
    border-bottom: 1px solid var(--line)
}

.eb-side-head .logo {
    color: var(--navy);
    font-size: 25px
}

.eb-side-close {
    width: 35px;
    height: 35px;
    border-radius: 10px;
    background: #f1f5fb;
    color: var(--navy);
    font-size: 25px;
    cursor: pointer
}

.eb-side-caption {
    font-size: 10px;
    letter-spacing: 1.2px;
    color: #8190a5;
    font-weight: 900;
    margin: 20px 8px 8px
}

.eb-side-categories,
.eb-side-tools {
    display: grid;
    gap: 3px
}

.eb-side-categories a,
.eb-side-tools a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 10px;
    border-radius: 10px;
    color: var(--navy);
    font-weight: 700;
    font-size: 13px
}

.eb-side-categories a:hover,
.eb-side-tools a:hover {
    background: #edf5ff;
    color: #1e63c7
}

.eb-side-categories a>span:first-child {
    width: 24px;
    text-align: center;
    font-size: 17px
}

.eb-side-arrow {
    margin-left: auto;
    color: #98a6ba;
    font-size: 20px
}

.eb-side-tools a>span {
    flex: 1
}

.eb-side-note {
    background: #f2f7ff;
    color: #64748b;
    border-radius: 12px;
    padding: 12px;
    font-size: 11px;
    line-height: 1.6;
    margin-top: 20px
}

.eb-menu-open {
    overflow: hidden
}

.eb-feature-grid {
    display: grid;
    grid-template-columns: minmax(280px, .8fr) minmax(0, 1.2fr);
    gap: 20px;
    margin-bottom: 22px
}

.eb-panel {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 20px;
    padding: 22px;
    margin-bottom: 20px;
    box-shadow: 0 6px 25px #1d3b6508
}

.eb-panel h2 {
    font: 800 21px Manrope;
    margin: 0 0 10px;
    color: var(--navy)
}

.eb-panel h3 {
    color: var(--navy)
}

.eb-panel .field {
    margin: 15px 0
}

.eb-panel .field label {
    display: block
}

.eb-panel input,
.eb-panel select {
    box-sizing: border-box;
    width: 100%;
    min-width: 0;
    border: 1px solid var(--line);
    border-radius: 11px;
    padding: 12px;
    background: #fff;
    color: var(--navy);
    font: inherit
}

.eb-action-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 14px
}

.eb-action-row .primary,
.eb-action-row .secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 11px;
    padding: 12px 15px;
    text-decoration: none;
    font-weight: 800;
    font-size: 13px;
    cursor: pointer
}

.eb-action-row .secondary {
    border: 1px solid var(--line);
    background: #fff;
    color: var(--navy)
}

.eb-help {
    font-size: 12px;
    color: var(--muted);
    line-height: 1.6
}

.eb-map-panel iframe {
    display: none;
    width: 100%;
    height: 350px;
    border: 0;
    border-radius: 14px;
    background: #f0f5fc
}

.eb-map-placeholder {
    height: 350px;
    border-radius: 14px;
    background: linear-gradient(140deg, #eaf5ff, #f4f0ff);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 15px
}

.eb-map-pin {
    font-size: 45px
}

.eb-map-placeholder h3 {
    margin: 10px 0 4px
}

.eb-map-placeholder p {
    color: var(--muted);
    font-size: 13px
}

.eb-college-list {
    margin-top: 6px
}

.eb-college-chips {
    display: flex;
    gap: 9px;
    flex-wrap: wrap;
    margin-top: 15px
}

.eb-college-chip {
    border: 1px solid var(--line);
    border-radius: 999px;
    background: #f7faff;
    color: var(--navy);
    padding: 9px 12px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer
}

.eb-college-chip:hover {
    background: #e6f0ff;
    border-color: #bcd5ff
}

.eb-tracking-top {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    flex-wrap: wrap
}

.eb-tracking-top h2 {
    margin-bottom: 4px
}

.eb-order-card {
    display: flex;
    gap: 15px;
    padding: 18px 0;
    border-top: 1px solid var(--line)
}

.eb-order-icon {
    width: 48px;
    height: 48px;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    background: #edf5ff;
    border-radius: 14px;
    font-size: 22px
}

.eb-order-info {
    flex: 1;
    min-width: 0
}

.eb-order-info p {
    font-size: 13px;
    line-height: 1.6;
    color: #61718a
}

.eb-order-line {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap
}

.eb-status {
    font-size: 11px;
    background: #eaf8f1;
    color: #12805c;
    border-radius: 99px;
    padding: 5px 9px;
    font-weight: 800
}

.eb-progress {
    display: flex;
    gap: 7px;
    flex-wrap: wrap;
    margin: 14px 0
}

.eb-progress span {
    font-size: 10px;
    color: #8b98aa;
    background: #f0f3f8;
    border-radius: 99px;
    padding: 7px 9px
}

.eb-progress span.done {
    color: #087f5b;
    background: #e4f7ee
}

.eb-track-help {
    background: #f3f8ff
}

.eb-empty {
    text-align: center;
    padding: 35px 15px
}

.eb-empty>div {
    font-size: 42px
}

.eb-empty p {
    color: var(--muted);
    font-size: 13px
}

.eb-wiki-search {
    display: flex;
    gap: 10px;
    margin-top: 12px
}

.eb-wiki-search input {
    flex: 1
}

.eb-wiki-search button {
    white-space: nowrap
}

.eb-wiki-results {
    display: grid;
    gap: 12px;
    margin-top: 18px
}

.eb-wiki-card {
    display: flex;
    gap: 16px;
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 16px
}

.eb-wiki-card img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 12px;
    background: #f0f5fb
}

.eb-wiki-card h3 {
    margin: 0 0 7px;
    font-size: 17px
}

.eb-wiki-card h3 a {
    color: var(--navy)
}

.eb-wiki-card p {
    font-size: 13px;
    color: #62728a;
    line-height: 1.65;
    margin: 0 0 8px
}

.eb-wiki-card .textlink {
    font-size: 12px
}

@media(max-width:850px) {
    .eb-feature-grid {
        grid-template-columns: 1fr
    }

    .eb-map-panel iframe,
    .eb-map-placeholder {
        height: 300px
    }

    .eb-menu-label {
        display: none
    }

    .eb-menu-toggle {
        padding: 10px
    }

    .eb-menu-toggle span:first-child {
        font-size: 18px
    }
}

@media(max-width:560px) {
    .eb-panel {
        padding: 16px;
        border-radius: 16px
    }

    .eb-wiki-search {
        flex-direction: column
    }

    .eb-wiki-card {
        padding: 12px;
        gap: 10px
    }

    .eb-wiki-card img {
        width: 72px;
        height: 72px
    }

    .eb-wiki-card h3 {
        font-size: 14px
    }

    .eb-order-card {
        gap: 10px
    }

    .eb-order-icon {
        width: 38px;
        height: 38px
    }

    .eb-action-row>* {
        flex: 1
    }

    .eb-map-panel iframe,
    .eb-map-placeholder {
        height: 250px
    }
}


/* EasyBuy account pages — matching the existing blue/white theme */
#ebAccountLinks {
    display: grid;
    gap: 4px;
    padding: 8px 0;
    border-top: 1px solid var(--line);
    margin-top: 8px
}

#ebAccountLinks a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 13px;
    border-radius: 12px;
    color: var(--ink);
    font-weight: 600;
    font-size: 14px
}

#ebAccountLinks a:hover {
    background: #eaf2ff;
    color: var(--blue)
}

.eb-auth-wrap {
    min-height: 62vh;
    padding: 46px 16px 70px;
    display: grid;
    place-items: center;
    background: radial-gradient(ellipse at top left, #e1f2ff 0, transparent 48%), var(--paper)
}

.eb-auth-card {
    width: min(100%, 490px);
    background: #fff;
    border: 1px solid var(--line);
    border-radius: 25px;
    padding: clamp(24px, 5vw, 42px);
    box-shadow: 0 22px 70px #173b6812
}

.eb-auth-logo {
    display: inline-block;
    margin-bottom: 28px
}

.eb-auth-kicker {
    color: var(--blue);
    font-size: 11px;
    letter-spacing: 1.6px;
    font-weight: 800
}

.eb-auth-card h1 {
    font: 800 clamp(28px, 4vw, 36px)/1.15 Manrope;
    color: var(--navy);
    letter-spacing: -1px;
    margin: 9px 0 10px
}

.eb-auth-sub {
    color: var(--muted);
    font-size: 14px;
    line-height: 1.65;
    margin: 0 0 22px
}

.eb-auth-form {
    display: grid;
    gap: 16px
}

.eb-auth-form label {
    display: grid;
    gap: 7px;
    font-size: 13px;
    font-weight: 700;
    color: var(--ink)
}

.eb-auth-form input {
    width: 100%;
    min-width: 0;
    padding: 13px 14px;
    border: 1px solid #dbe5f2;
    border-radius: 12px;
    background: #fbfdff;
    outline: none;
    color: var(--ink)
}

.eb-auth-form input:focus {
    border-color: var(--blue);
    box-shadow: 0 0 0 3px #2874f018
}

.eb-auth-form .primary {
    width: 100%;
    margin-top: 4px
}

.eb-auth-hint {
    font-size: 12px;
    color: var(--muted);
    line-height: 1.55;
    margin: 0
}

.eb-auth-switch {
    text-align: center;
    font-size: 13px;
    color: var(--muted);
    margin: 21px 0 16px
}

.eb-auth-switch a,
.eb-auth-back {
    color: var(--blue);
    font-weight: 700
}

.eb-auth-back {
    display: inline-block;
    font-size: 13px;
    margin-top: 10px
}

.eb-auth-message {
    display: none;
    border-radius: 11px;
    padding: 10px 12px;
    margin: 0 0 13px;
    font-size: 13px;
    line-height: 1.5
}

.eb-auth-message:not(:empty) {
    display: block
}

.eb-auth-message.error {
    color: #9d2424;
    background: #fff0f0
}

.eb-auth-message.success {
    color: #146c43;
    background: #e9f9f0
}

.eb-profile {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 17px;
    background: #f5f8ff;
    border: 1px solid var(--line);
    border-radius: 17px;
    margin: 22px 0
}

.eb-profile-avatar {
    width: 58px;
    height: 58px;
    flex: 0 0 58px;
    display: grid;
    place-items: center;
    background: linear-gradient(135deg, #2874f0, #65b5ff);
    color: white;
    border-radius: 18px;
    font: 800 25px Manrope
}

.eb-profile h2 {
    font: 800 20px Manrope;
    color: var(--navy);
    margin: 0 0 5px;
    overflow-wrap: anywhere
}

.eb-profile p {
    font-size: 13px;
    color: var(--muted);
    margin: 0;
    overflow-wrap: anywhere
}

.eb-profile-details {
    display: grid;
    gap: 10px;
    margin: 18px 0 23px
}

.eb-profile-details>div {
    display: flex;
    justify-content: space-between;
    gap: 14px;
    padding: 12px 0;
    border-bottom: 1px solid var(--line);
    font-size: 13px
}

.eb-profile-details span {
    color: var(--muted)
}

.eb-profile-details strong {
    text-align: right;
    overflow-wrap: anywhere
}

.eb-auth-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap
}

.eb-auth-actions>* {
    flex: 1
}

.eb-sell-notice {
    padding: 12px 14px;
    margin-top: 15px;
    background: #e9f9f0;
    border: 1px solid #c8efda;
    color: #146c43;
    border-radius: 12px;
    font-size: 13px;
    font-weight: 700
}

@media(max-width:600px) {
    .eb-auth-wrap {
        padding: 26px 12px 45px
    }

    .eb-auth-card {
        border-radius: 19px
    }

    .eb-auth-actions {
        display: grid
    }

    .eb-profile-details>div {
        align-items: flex-start;
        flex-direction: column;
        gap: 4px
    }

    .eb-profile-details strong {
        text-align: left
    }
}

/* EasyBuy login gate, page-transition loader, and animated cart */
html.eb-auth-pending body> :not(#loading) {
    visibility: hidden !important
}

html.eb-auth-pending #loading {
    visibility: visible !important;
    opacity: 1 !important
}

body.eb-guest-mode .topline,
body.eb-guest-mode .navbar,
body.eb-guest-mode .footer {
    display: none !important
}

body.eb-guest-mode #app {
    min-height: 100vh;
    display: grid;
    align-items: center
}

.eb-loader-scene {
    width: 220px;
    height: 125px;
    margin: auto;
    position: relative;
    overflow: hidden
}

.eb-loader-moon {
    position: absolute;
    left: 12px;
    top: 10px;
    width: 47px;
    height: 47px;
    border-radius: 50%;
    background: #e5efff;
    box-shadow: 0 0 0 9px #2874f014, 0 0 28px #2874f044;
    animation: ebMoonGlow 1.5s ease-in-out infinite
}

.eb-loader-moon:after {
    content: "";
    position: absolute;
    width: 44px;
    height: 44px;
    left: 13px;
    top: -5px;
    background: #f6f9ff;
    border-radius: 50%
}

.eb-loader-flower {
    position: absolute;
    right: 25px;
    top: 0;
    color: #ff91b6;
    font-size: 34px;
    transform-origin: center;
    animation: ebFlowerSpin 3s linear infinite
}

.eb-loader-track {
    position: absolute;
    left: 8px;
    right: 8px;
    bottom: 23px;
    height: 3px;
    background: #dce8fb;
    border-radius: 8px
}

.eb-running-basket {
    position: absolute;
    left: 0;
    top: -29px;
    font-size: 27px;
    filter: drop-shadow(0 4px 3px #15386b22);
    animation: ebBasketRun 1.25s ease-in-out infinite alternate
}

.loader-label {
    margin-top: 10px
}

@keyframes ebBasketRun {
    from {
        left: 0;
        transform: translateY(0) rotate(-8deg)
    }

    to {
        left: calc(100% - 31px);
        transform: translateY(-5px) rotate(8deg)
    }
}

@keyframes ebFlowerSpin {
    to {
        transform: rotate(360deg)
    }
}

@keyframes ebMoonGlow {
    50% {
        transform: scale(1.08);
        box-shadow: 0 0 0 14px #2874f00b, 0 0 42px #2874f066
    }
}

.eb-add-cart-icon {
    display: inline-block;
    margin-right: 5px;
    transform-origin: 50% 85%
}

.eb-cart-added .eb-add-cart-icon {
    animation: ebAddToBasket .55s ease
}

.eb-cart-icon {
    display: inline-block;
    transform-origin: 50% 80%
}

.eb-cart-bounce {
    animation: ebCartBounce .55s ease
}

@keyframes ebAddToBasket {
    0% {
        transform: translateY(-9px) rotate(-15deg) scale(.85)
    }

    55% {
        transform: translateY(2px) rotate(12deg) scale(1.18)
    }

    100% {
        transform: translateY(0) rotate(0) scale(1)
    }
}

@keyframes ebCartBounce {

    0%,
    100% {
        transform: translateY(0) rotate(0)
    }

    35% {
        transform: translateY(-7px) rotate(-12deg)
    }

    70% {
        transform: translateY(1px) rotate(8deg)
    }
}

@media(prefers-reduced-motion:reduce) {

    .eb-loader-moon,
    .eb-loader-flower,
    .eb-running-basket,
    .eb-cart-added .eb-add-cart-icon,
    .eb-cart-bounce {
        animation: none !important
    }
}

/* Signup confirmation field and reliable product artwork */
.eb-auth-form input[type="password"] {
    letter-spacing: .02em
}

.eb-auth-form input:invalid:not(:placeholder-shown) {
    border-color: #e49b9b
}

.product-image-wrap {
    min-height: 190px;
    background: linear-gradient(145deg, #f2f7ff, #fff9f4)
}

.product-image {
    object-fit: contain;
    object-position: center;
    padding: 8px;
    box-sizing: border-box
}

.hero-product,
.detail-product {
    object-fit: contain
}

#ebMenuToggle {
    box-shadow: 0 5px 18px #1c4b8c12
}

.eb-side-categories a {
    min-height: 42px
}

@media(max-width:600px) {
    .eb-side-categories a {
        padding: 12px 10px
    }

    .product-image-wrap {
        min-height: 150px
    }
}


/* Wishlist interaction: keep the heart above the image and independently clickable. */
.product-image-wrap { cursor: default !important; }
.product-image-wrap .heart { z-index: 10 !important; position: absolute; pointer-events: auto; cursor: pointer; }
.product-image-wrap .product-image { pointer-events: none; }

/* Order page: polished return request and purchase feedback cards only. */
.page-title section.eb-panel:has(#ebReturnForm),
.page-title section.eb-panel:has(.ebFeedbackForm) {
  box-sizing: border-box;
  padding: clamp(20px, 3vw, 30px);
  margin: 24px 0 !important;
  border: 1px solid #e4e9f5;
  border-radius: 22px;
  background: linear-gradient(145deg, #ffffff 0%, #fbfcff 100%);
  box-shadow: 0 12px 32px rgba(30, 55, 105, .07);
}
.page-title section.eb-panel:has(#ebReturnForm) h2,
.page-title section.eb-panel:has(.ebFeedbackForm) h2 {
  display: flex;
  align-items: center;
  gap: 10px;
  margin: 0 0 12px;
  color: #17336c;
  font-size: clamp(21px, 2vw, 27px);
  line-height: 1.3;
  letter-spacing: -.45px;
}
.page-title section.eb-panel:has(#ebReturnForm) h2:before { content: "↩"; display:grid; place-items:center; width:40px; height:40px; flex:0 0 40px; border-radius:13px; background:#eaf1ff; color:#2458d7; font-size:22px; }
.page-title section.eb-panel:has(.ebFeedbackForm) h2:before { content: "★"; display:grid; place-items:center; width:40px; height:40px; flex:0 0 40px; border-radius:13px; background:#fff5d9; color:#c98208; font-size:22px; }
.page-title section.eb-panel:has(#ebReturnForm) > p,
.page-title section.eb-panel:has(.ebFeedbackForm) > p { color:#5c6780; line-height:1.65; }
#ebReturnForm, .ebFeedbackForm { display:grid; gap:14px; margin-top:18px; }
#ebReturnForm label, .ebFeedbackForm label { display:grid; gap:8px; color:#263858; font-weight:700; font-size:14px; }
#ebReturnForm textarea, .ebFeedbackForm textarea,
.ebFeedbackForm select { box-sizing:border-box; width:100%; min-width:0; padding:13px 15px; border:1px solid #dce3f1; border-radius:12px; background:#fff; color:#202d48; font:inherit; line-height:1.5; outline:none; transition:border-color .18s, box-shadow .18s; }
#ebReturnForm textarea, .ebFeedbackForm textarea { min-height:105px; resize:vertical; }
#ebReturnForm textarea:focus, .ebFeedbackForm textarea:focus, .ebFeedbackForm select:focus { border-color:#4777ed; box-shadow:0 0 0 4px rgba(55,102,224,.12); }
#ebReturnForm button, .ebFeedbackForm button { justify-self:start; min-height:46px; padding:12px 20px; border:0; border-radius:12px; background:#285bd8; color:#fff; font-weight:750; cursor:pointer; box-shadow:0 7px 16px rgba(40,91,216,.17); }
#ebReturnForm button:hover, .ebFeedbackForm button:hover { background:#1949bf; transform:translateY(-1px); }
#ebReturnNotice, #ebFeedbackNotice { padding:0; margin:0; color:#2354c5; font-weight:650; }
.ebFeedbackForm { padding:18px 0 !important; border-top:1px solid #e8edf6 !important; }
.ebFeedbackForm > strong { color:#202f50; font-size:17px; margin-bottom:2px; }
.ebFeedbackForm > p { margin:0; padding:12px 14px; border-radius:12px; background:#f4f7ff; color:#34466c; line-height:1.7; }
.ebFeedbackForm > p:first-letter { color:#e7a323; }
@media (min-width:700px) { #ebReturnForm textarea { max-width:100%; } .ebFeedbackForm { grid-template-columns:1fr; } }
@media (max-width:520px) { .page-title section.eb-panel:has(#ebReturnForm), .page-title section.eb-panel:has(.ebFeedbackForm) { padding:18px; border-radius:17px; } #ebReturnForm button, .ebFeedbackForm button { width:100%; justify-self:stretch; } }

</style>
    <style>
/* EasyBuy Modern UI Layer — additive overrides; keep style.css for feature compatibility */
:root {
  --blue: #5b5ce2;
  --navy: #15172b;
  --cyan: #e7eaff;
  --peach: #fff0e5;
  --purple: #ecebff;
  --ink: #20223a;
  --muted: #777b92;
  --paper: #f7f7fb;
  --white: #fff;
  --line: #e8e8f1;
  --shadow: 0 18px 50px rgba(27, 29, 72, .08);
  --modern-accent: #5b5ce2;
  --modern-dark: #15172b;
}

* {
  box-sizing: border-box
}

body {
  font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
  color: var(--ink);
  background: var(--paper);
  letter-spacing: -.01em
}

.topline {
  background: #15172b;
  color: #e9eaff;
  padding: 9px 14px;
  font-size: 11px;
  letter-spacing: .035em
}

.navbar {
  background: rgba(255, 255, 255, .9);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(226, 227, 240, .9)
}

.navinner {
  min-height: 78px;
  gap: clamp(12px, 2vw, 26px)
}

.logo {
  font-size: 27px;
  letter-spacing: -1.5px;
  color: #15172b
}

.logo b {
  color: #5b5ce2
}

.navlinks {
  gap: clamp(10px, 1.6vw, 22px);
  font-size: 13px
}

.navlinks a {
  transition: color .2s ease
}

.navlinks a:hover {
  color: #5b5ce2
}

.search {
  border-color: #e5e6f0;
  background: #f8f8fc;
  border-radius: 14px;
  padding: 12px 14px;
  transition: border-color .2s, box-shadow .2s
}

.search:focus,
.filters input:focus,
.filters select:focus {
  outline: none;
  border-color: #a6a7f4;
  box-shadow: 0 0 0 4px rgba(91, 92, 226, .09)
}

.cartbtn {
  background: #15172b;
  border-radius: 14px;
  padding: 12px 15px;
  box-shadow: 0 8px 18px rgba(21, 23, 43, .12);
  transition: transform .2s
}

.cartbtn:hover {
  transform: translateY(-2px)
}

.primary,
.secondary,
.pillbtn {
  border-radius: 14px;
  padding: 13px 18px;
  font-size: 13px;
  transition: transform .2s, box-shadow .2s, background .2s
}

.primary {
  background: #5b5ce2;
  box-shadow: 0 9px 22px rgba(91, 92, 226, .22)
}

.primary:hover {
  background: #494ad1;
  box-shadow: 0 13px 26px rgba(91, 92, 226, .26)
}

.secondary {
  background: #fff;
  border-color: #e7e7f0
}

.secondary:hover {
  border-color: #b8b9f5;
  color: #4b4cd5
}

.hero {
  padding: clamp(38px, 6vw, 76px) 0 42px
}

.hero-grid {
  gap: clamp(24px, 4vw, 56px)
}

.eyebrow {
  background: #ececff;
  color: #4e4fc7;
  border: 1px solid #e1e1ff;
  padding: 8px 12px;
  font-size: 10px;
  letter-spacing: .075em
}

.hero h1 {
  font-size: clamp(40px, 5.3vw, 68px);
  line-height: 1.02;
  letter-spacing: -.055em;
  color: #15172b;
  margin: 22px 0 17px
}

.hero h1 span {
  color: #5b5ce2
}

.hero p {
  font-size: 16px;
  line-height: 1.8;
  color: #72768d
}

.hero-stats {
  gap: clamp(14px, 3vw, 32px)
}

.stat strong {
  font-size: 19px;
  color: #20223a
}

.stat span {
  font-size: 11px
}

.hero-art {
  min-height: 390px;
  border-radius: 34px;
  background: radial-gradient(circle at 70% 25%, #fdf1e8 0, transparent 28%), linear-gradient(145deg, #e9eaff 0%, #f0efff 50%, #e6f6f5 100%);
  box-shadow: inset 0 0 0 1px #ffffffc9
}

.float-card {
  border: 1px solid #ffffffd9;
  box-shadow: 0 14px 38px rgba(35, 38, 83, .12);
  border-radius: 17px;
  padding: 13px 16px
}

.section {
  padding: 30px 0 48px
}

.sectionhead {
  margin-bottom: 24px
}

.sectionhead h2 {
  font-size: clamp(25px, 3vw, 34px);
  letter-spacing: -.045em;
  color: #17192f
}

.sectionhead p {
  font-size: 13px;
  color: #82859a
}

.textlink {
  color: #5556d8;
  font-size: 13px
}

.category-grid {
  gap: 14px
}

.category {
  border-radius: 19px;
  padding: 16px;
  border-color: #e9e9f2;
  box-shadow: 0 4px 16px rgba(31, 33, 76, .025);
  transition: transform .22s, border-color .22s, box-shadow .22s
}

.category:hover {
  transform: translateY(-4px);
  box-shadow: 0 14px 30px rgba(31, 33, 76, .08);
  border-color: #c9c9fa
}

.category img {
  border-radius: 14px;
  background: #f3f3fc
}

.category strong {
  font-size: 13px
}

.category small {
  font-size: 11px;
  color: #85879a
}

.product-grid {
  gap: 17px
}

.product-card {
  border-radius: 21px;
  padding: 11px;
  border-color: #e9e9f2;
  box-shadow: 0 5px 18px rgba(31, 33, 76, .025);
  transition: transform .24s, border-color .24s, box-shadow .24s
}

.product-card:hover {
  transform: translateY(-5px);
  border-color: #d8d8fa;
  box-shadow: 0 18px 38px rgba(31, 33, 76, .09)
}

.product-image-wrap {
  border-radius: 15px;
  background: linear-gradient(145deg, #f4f4ff, #fff7f1);
  min-height: 180px
}

.product-image {
  aspect-ratio: 1.08;
  padding: 10px
}

.tag {
  background: #fff;
  color: #5556c9;
  border: 1px solid #eeeefe;
  font-size: 9px;
  letter-spacing: .025em
}

.heart {
  box-shadow: 0 4px 12px rgba(31, 33, 76, .08);
  color: #5556d8
}

.product-name {
  font-size: 13px;
  letter-spacing: -.015em
}

.product-category {
  font-size: 10px;
  text-transform: uppercase;
  letter-spacing: .055em;
  color: #8b8da0
}

.rating {
  font-size: 11px;
  color: #b17b2e
}

.price {
  font-size: 19px;
  color: #17192f
}

.oldprice {
  font-size: 11px
}

.discount {
  font-size: 10px
}

.sellerline {
  font-size: 10px;
  color: #83869b
}

.card-actions {
  gap: 7px
}

.card-actions button {
  border-radius: 11px;
  padding: 11px 6px;
  font-size: 11px
}

.addbtn {
  background: #eeeeff;
  color: #4d4ec9
}

.addbtn:hover {
  background: #e3e3ff
}

.viewbtn {
  background: #17192f
}

.viewbtn:hover {
  background: #303252
}

.deals {
  border-radius: 27px;
  background: linear-gradient(115deg, #17192f, #34366e);
  padding: clamp(22px, 3vw, 34px);
  box-shadow: 0 16px 38px rgba(25, 27, 62, .12)
}

.deals h2 {
  font-size: clamp(24px, 3vw, 32px);
  letter-spacing: -.04em
}

.deals p {
  font-size: 13px;
  color: #d1d3f3
}

.timebox {
  border-radius: 13px;
  background: #ffffff14;
  border-color: #ffffff25
}

.campus-band {
  border: 1px solid #e7e7f6;
  border-radius: 24px;
  background: linear-gradient(110deg, #f0efff, #edf8f7);
  padding: clamp(20px, 3vw, 30px)
}

.campus-band h3 {
  font-size: clamp(20px, 2.5vw, 25px);
  letter-spacing: -.035em
}

.footer {
  background: #15172b;
  margin-top: 48px;
  padding: 46px 0 22px
}

.footer-grid {
  gap: 40px
}

.footer h3 {
  font-size: 13px;
  letter-spacing: .02em
}

.footer p,
.footer a {
  font-size: 12px;
  color: #b8bad0
}

.copyright {
  font-size: 11px;
  color: #999bb5
}

.page-title {
  padding-top: 44px;
  padding-bottom: 32px
}

.page-title h1 {
  letter-spacing: -.05em;
  color: #17192f
}

.filters input,
.filters select {
  border: 1px solid #e5e6f0;
  border-radius: 13px;
  background: #fff;
  padding: 12px 14px;
  color: #272943
}

.eb-panel,
.eb-auth-card {
  border: 1px solid #e8e8f2;
  border-radius: 24px;
  box-shadow: 0 16px 46px rgba(27, 29, 72, .07)
}

.eb-panel {
  background: #fff
}

.eb-panel input,
.eb-panel select,
.eb-auth-form input {
  border-color: #e4e5f0;
  border-radius: 13px;
  background: #fcfcff
}

.eb-auth-wrap {
  background: radial-gradient(ellipse at top left, #ececff 0, transparent 45%), var(--paper)
}

.eb-auth-card {
  box-shadow: 0 22px 65px rgba(27, 29, 72, .09)
}

.eb-auth-kicker {
  color: #5b5ce2
}

.eb-auth-card h1 {
  letter-spacing: -.05em;
  color: #17192f
}

.eb-auth-form input:focus {
  border-color: #a6a7f4;
  box-shadow: 0 0 0 4px rgba(91, 92, 226, .09)
}

.eb-profile-avatar {
  background: linear-gradient(135deg, #5b5ce2, #8b8cf7)
}

.eb-menu-toggle {
  border-radius: 0 15px 15px 0 !important;
  background: #17192f !important;
  box-shadow: 0 8px 25px rgba(21, 23, 43, .16) !important
}

.eb-side-categories {
  border-color: #e8e8f2 !important;
  box-shadow: 0 18px 45px rgba(27, 29, 72, .13) !important;
  border-radius: 0 18px 18px 0 !important
}

.eb-side-categories a:hover {
  background: #eeeeff !important;
  color: #5051d1 !important
}

#loading {
  background: rgba(247, 247, 251, .97)
}

.loader-label {
  font-size: 10px;
  font-weight: 800;
  letter-spacing: .11em;
  color: #73759b;
  text-align: center
}

:focus-visible {
  outline: 3px solid rgba(91, 92, 226, .45);
  outline-offset: 3px
}

button:active,
.primary:active,
.secondary:active {
  transform: scale(.985)
}

@media(max-width:1000px) {
  .navinner {
    flex-wrap: wrap;
    padding: 13px 0
  }

  .navlinks {
    order: 3;
    width: 100%;
    justify-content: center;
    margin: 0;
    padding: 4px 0
  }

  .navactions {
    margin-left: auto
  }

  .search {
    width: min(34vw, 230px)
  }

  .hero-grid {
    grid-template-columns: 1fr 1fr
  }

  .product-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr))
  }
}

@media(max-width:760px) {
  .hero-grid {
    grid-template-columns: 1fr
  }

  .hero-art {
    min-height: 310px
  }

  .category-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr))
  }

  .product-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 12px
  }

  .product-card {
    padding: 9px
  }

  .product-image-wrap {
    min-height: 145px
  }

  .product-name {
    font-size: 12px
  }

  .price {
    font-size: 17px
  }

  .deals {
    align-items: flex-start;
    flex-wrap: wrap
  }

  .deal-clock {
    order: 3
  }

  .footer-grid {
    grid-template-columns: 1fr 1fr
  }

  .footer-grid>div:first-child {
    grid-column: 1/-1
  }
}

@media(max-width:480px) {
  .topline {
    font-size: 10px
  }

  .navinner {
    gap: 10px
  }

  .logo {
    font-size: 24px
  }

  .navlinks {
    gap: 14px;
    font-size: 12px;
    overflow-x: auto;
    justify-content: flex-start
  }

  .navactions {
    width: 100%
  }

  .search {
    width: 100%;
    flex: 1;
    min-width: 0
  }

  .hero {
    padding-top: 32px
  }

  .hero h1 {
    font-size: 42px
  }

  .hero-art {
    min-height: 260px;
    border-radius: 24px
  }

  .hero-stats {
    gap: 16px
  }

  .stat strong {
    font-size: 16px
  }

  .category {
    padding: 12px;
    gap: 9px
  }

  .category img {
    width: 48px;
    height: 48px
  }

  .category strong {
    font-size: 12px
  }

  .category small {
    font-size: 10px
  }

  .product-grid {
    gap: 9px
  }

  .product-image-wrap {
    min-height: 125px
  }

  .product-image {
    aspect-ratio: 1;
    padding: 5px
  }

  .card-actions button {
    font-size: 10px;
    padding: 10px 4px
  }

  .deals {
    border-radius: 21px
  }

  .deals h2 {
    font-size: 24px
  }

  .footer-grid {
    grid-template-columns: 1fr
  }

  .footer-grid>div:first-child {
    grid-column: auto
  }
}

@media(prefers-reduced-motion:reduce) {

  *,
  *::before,
  *::after {
    scroll-behavior: auto !important;
    transition: none !important
  }
}

/* Floating category launcher: fixed at the left edge; category list opens downward. */
.eb-floating-categories {
  position: fixed;
  left: 0;
  top: 12%;
  z-index: 10030;
  width: 230px;
  font-family: inherit
}

.eb-floating-toggle {
  display: flex;
  align-items: center;
  gap: 9px;
  border: 1px solid #d8d9ff;
  border-left: 0;
  border-radius: 0 15px 15px 0;
  padding: 13px 14px;
  background: linear-gradient(135deg, #5b5ce2, #7b68ee);
  color: #fff;
  font-weight: 850;
  box-shadow: 0 12px 28px #5b5ce244;
  cursor: pointer
}

.eb-floating-toggle>span:first-child {
  font-size: 20px
}

.eb-floating-chevron {
  margin-left: auto;
  transition: transform .2s
}

.eb-floating-categories.expanded .eb-floating-chevron {
  transform: rotate(180deg)
}

.eb-floating-panel {
  position: absolute;
  left: 8px;
  top: calc(100% + 8px);
  width: 270px;
  max-height: min(65vh, 560px);
  overflow: auto;
  background: #fff;
  border: 1px solid #e3e4ff;
  border-radius: 18px;
  box-shadow: 0 22px 55px #191a3a30;
  padding: 10px;
  animation: ebDrop .18s ease-out
}

.eb-floating-panel[hidden] {
  display: none
}

.eb-floating-panel-title {
  font-size: 10px;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: #7778b5;
  font-weight: 900;
  padding: 10px 12px
}

.eb-floating-panel>a {
  display: flex;
  align-items: center;
  gap: 11px;
  padding: 11px 12px;
  border-radius: 12px;
  text-decoration: none;
  color: #252642;
  font-weight: 750;
  font-size: 13px
}

.eb-floating-panel>a:hover {
  background: #eeeeff;
  color: #4d4ed0
}

.eb-cat-emoji {
  width: 30px;
  height: 30px;
  display: grid;
  place-items: center;
  border-radius: 10px;
  background: #f0efff;
  font-size: 16px
}

.eb-floating-panel>a .eb-side-arrow {
  margin-left: auto
}

.eb-floating-shortcuts {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  border-top: 1px solid #eeeef8;
  padding: 12px 4px 4px;
  margin-top: 6px
}

.eb-floating-shortcuts a {
  padding: 7px 9px;
  border-radius: 9px;
  background: #f5f5fc;
  color: #5556c9;
  font-size: 11px;
  font-weight: 800;
  text-decoration: none
}

.eb-confirmed-banner,
.eb-packing-card {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 13px 14px;
  border-radius: 14px;
  margin: 12px 0
}

.eb-confirmed-banner {
  background: #e8f9ef;
  border: 1px solid #c4f0d5
}

.eb-confirmed-tick {
  width: 32px;
  height: 32px;
  display: grid;
  place-items: center;
  border-radius: 50%;
  background: #16a36a;
  color: #fff;
  font-size: 20px;
  font-weight: 900
}

.eb-confirmed-banner strong,
.eb-packing-card strong {
  display: block;
  font-size: 13px;
  color: #163d2b
}

.eb-confirmed-banner small,
.eb-packing-card small {
  display: block;
  margin-top: 3px;
  font-size: 11px;
  color: #68778a
}

.eb-packing-card {
  background: #f1f2ff;
  border: 1px solid #dfdfff
}

.eb-packing-icon {
  font-size: 25px
}

.eb-packing-card strong {
  color: #3839a5
}

.eb-progress span {
  padding: 8px 10px
}

.eb-progress span.done {
  font-weight: 800
}

@keyframes ebDrop {
  from {
    opacity: 0;
    transform: translateY(-7px)
  }

  to {
    opacity: 1;
    transform: translateY(0)
  }
}

@media(max-width:600px) {
  .eb-floating-categories {
    top: 13%;
    width: 180px
  }

  .eb-floating-toggle {
    padding: 11px 12px;
    font-size: 12px
  }

  .eb-floating-panel {
    width: min(270px, 85vw);
    max-height: 58vh
  }

  .eb-order-info {
    min-width: 0
  }
}

/* Live map and route details */
.eb-leaflet-map {
  height: 440px;
  min-height: 320px;
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
  background: #eef3f8;
  border: 1px solid #dbe4ef;
  z-index: 1
}

.eb-route-summary {
  margin-top: 16px;
  padding: 16px;
  border-radius: 14px;
  background: #f0f7ff;
  border: 1px solid #cfe2ff;
  color: #17365f
}

.eb-route-summary p {
  margin: 8px 0 0;
  line-height: 1.55;
  font-size: 13px
}

.eb-route-metrics {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px
}

.eb-route-metrics div {
  display: flex;
  flex-direction: column;
  gap: 5px
}

.eb-route-metrics small {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: .06em;
  color: #526987
}

.eb-route-metrics strong {
  font-size: 25px;
  color: #1d4ed8
}

.eb-map-fallback {
  padding: 30px;
  text-align: center;
  color: #475569
}

.eb-map-panel .eb-action-row {
  margin-top: 14px
}

.eb-leaflet-map .leaflet-control-attribution {
  font-size: 10px
}

@media(max-width:760px) {
  .eb-leaflet-map {
    height: 330px;
    min-height: 280px
  }

  .eb-route-metrics strong {
    font-size: 21px
  }
}

/* Product page campus availability and student details */
.eb-product-campus {
  margin: 34px auto 18px;
  padding: clamp(18px, 3vw, 30px);
  border: 1px solid #e4e6fb;
  border-radius: 22px;
  background: linear-gradient(135deg, #fff, #f8f8ff);
  box-shadow: 0 12px 34px rgba(31, 33, 76, .05)
}

.eb-campus-heading h2 {
  margin: 8px 0;
  font-size: clamp(20px, 3vw, 27px);
  color: #20213d
}

.eb-campus-heading p {
  color: var(--muted);
  font-size: 13px;
  line-height: 1.6
}

.eb-campus-form {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 12px;
  margin: 20px 0
}

.eb-campus-form .field {
  margin: 0
}

.eb-campus-form label {
  display: block;
  margin-bottom: 6px;
  font-size: 12px;
  font-weight: 800;
  color: #4a4c69
}

.eb-campus-form input,
.eb-campus-form select {
  width: 100%;
  min-height: 44px;
  padding: 11px 12px;
  border: 1px solid #dedff1;
  border-radius: 11px;
  background: #fff;
  color: #252642;
  font: inherit;
  font-size: 13px
}

.eb-campus-status {
  display: flex;
  flex-direction: column;
  gap: 5px;
  padding: 14px 16px;
  border-radius: 14px;
  background: #f1f2ff;
  border: 1px solid #e1e2ff;
  margin: 12px 0;
  color: #33366c
}

.eb-campus-status strong {
  font-size: 14px
}

.eb-campus-status span {
  font-size: 12px;
  line-height: 1.6
}

.eb-campus-status.is-match {
  background: #eaf9f0;
  border-color: #c7eed5;
  color: #17623c
}

.eb-campus-status.is-outside {
  background: #fff4e6;
  border-color: #ffdfb2;
  color: #854c0b
}

.eb-campus-status.is-warning {
  background: #fff4e6;
  border-color: #ffdfb2;
  color: #854c0b
}

@media(max-width:620px) {
  .eb-campus-form {
    grid-template-columns: 1fr
  }

  .eb-floating-categories {
    top: 20%
  }
}


/* EasyBuy premium white and royal-blue finishing layer */
:root {
  --eb-royal: #155eef;
  --eb-royal-dark: #123b91;
  --eb-blue-soft: #edf4ff
}

.navbar {
  background: #fff;
  border-bottom: 1px solid #e5ecf8
}

.logo b,
.navlinks a:hover,
.textlink {
  color: var(--eb-royal) !important
}

.primary,
.addbtn {
  background: var(--eb-royal) !important;
  color: #fff !important
}

.primary:hover,
.addbtn:hover {
  background: var(--eb-royal-dark) !important
}

.viewbtn {
  background: #123b91 !important;
  color: #fff !important
}

.category:hover,
.product-card:hover {
  border-color: #9dbdff !important
}

.eb-floating-toggle {
  background: linear-gradient(135deg, #155eef, #123b91) !important;
  border-color: #b8d0ff !important;
  box-shadow: 0 12px 28px #155eef35 !important
}

.eb-floating-panel {
  border-color: #c8dcff !important
}

.eb-floating-panel-title {
  color: #155eef !important
}

.eb-floating-panel>a:hover {
  background: #edf4ff !important;
  color: #123b91 !important
}

.eb-cat-emoji {
  background: #edf4ff !important
}

.eb-floating-shortcuts {
  display: grid;
  grid-template-columns: 1fr;
  gap: 4px
}

.eb-floating-shortcuts a {
  display: flex;
  align-items: center;
  gap: 9px;
  padding: 9px 10px;
  background: #f5f8ff;
  color: #17459b;
  border: 1px solid transparent
}

.eb-floating-shortcuts a:hover {
  background: #e7f0ff;
  border-color: #c8dcff
}

.eb-floating-shortcuts a span {
  width: 20px;
  text-align: center
}

.eb-auth-kicker {
  color: #155eef !important
}

.eb-profile-avatar {
  background: linear-gradient(135deg, #155eef, #123b91) !important
}

@media(max-width:600px) {
  .eb-floating-panel {
    max-height: 70vh
  }

  .eb-floating-shortcuts {
    grid-template-columns: 1fr 1fr
  }

  .eb-floating-shortcuts a {
    font-size: 10px;
    padding: 8px 6px
  }
}

/* Contact, AI-assisted message drafts, and refund request additions — reuse EasyBuy theme tokens. */
.eb-contact-layout {
  display: grid;
  grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
  gap: 22px;
  padding-bottom: 70px;
  align-items: start
}

.eb-contact-layout>.eb-panel {
  padding: clamp(18px, 3vw, 28px);
  border-radius: 22px
}

.eb-contact-layout h2 {
  margin: 0 0 20px;
  color: var(--ink, #17192f);
  font-size: 1.2rem
}

.eb-contact-layout .field {
  margin-bottom: 16px
}

.eb-contact-layout .field label {
  display: block;
  margin-bottom: 8px;
  font-weight: 650;
  color: var(--ink, #17192f)
}

.eb-contact-layout input,
.eb-contact-layout select,
.eb-contact-layout textarea {
  width: 100%;
  padding: 12px 14px;
  border: 1px solid #e4e5f0;
  border-radius: 12px;
  background: #fcfcff;
  color: var(--ink, #17192f);
  font: inherit
}

.eb-contact-layout textarea {
  resize: vertical
}

.eb-helper-box {
  padding: 16px;
  margin: 16px 0;
  border-radius: 15px;
  background: linear-gradient(135deg, #f0f1ff, #f7f8ff);
  border: 1px solid #dedfff
}

.eb-helper-box strong {
  color: #4c4dc5
}

.eb-helper-box p,
.eb-help {
  font-size: .88rem;
  color: var(--muted, #737b91);
  line-height: 1.6;
  margin: 8px 0 12px
}

.eb-inline-status {
  margin-top: 12px;
  color: #3b4bb5;
  font-size: .9rem;
  line-height: 1.5
}

.eb-message-card {
  padding: 15px 0;
  border-bottom: 1px solid #ececf4;
  overflow-wrap: anywhere
}

.eb-message-card:last-child {
  border-bottom: 0
}

.eb-message-card>p {
  margin: 8px 0;
  color: var(--ink, #22243a);
  line-height: 1.55
}

.eb-message-meta {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  align-items: center;
  flex-wrap: wrap;
  font-size: .88rem
}

.eb-message-meta strong {
  color: #4c4dc5
}

.eb-message-meta time,
.eb-message-card time {
  font-size: .76rem;
  color: var(--muted, #737b91)
}

.eb-message-product {
  font-size: .8rem;
  color: var(--muted, #737b91)
}

.eb-message-status {
  display: inline-block;
  padding: 4px 8px;
  border-radius: 99px;
  background: #f1f2ff;
  color: #5557bf;
  font-size: .72rem
}

.eb-refund-status {
  padding: 5px 9px;
  border-radius: 99px;
  background: #fff4df;
  color: #8a5a00;
  font-size: .75rem;
  font-weight: 700
}

.eb-empty-note {
  padding: 14px;
  border-radius: 12px;
  background: #f7f8fc;
  color: var(--muted, #737b91);
  line-height: 1.6
}

@media(max-width:800px) {
  .eb-contact-layout {
    grid-template-columns: 1fr;
    gap: 16px
  }

  .eb-contact-layout>.eb-panel {
    border-radius: 18px
  }
}

/* AI chat helper: animated draft and reply states */
.eb-typing {
  display: flex;
  align-items: center;
  gap: 5px;
  min-height: 20px;
  margin-top: 8px;
  color: var(--muted, #737b91);
  font-size: .82rem
}

.eb-typing span {
  display: inline-block;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #6264d8;
  animation: ebTyping 1s infinite ease-in-out
}

.eb-typing span:nth-child(2) {
  animation-delay: .15s
}

.eb-typing span:nth-child(3) {
  animation-delay: .3s
}

.eb-typing small {
  margin-left: 6px
}

.eb-typing[hidden],
.eb-ai-loading[hidden] {
  display: none
}

.eb-ai-loading {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 14px;
  margin-top: 12px;
  border-radius: 14px;
  background: #f3f3ff;
  border: 1px solid #e2e2ff;
  animation: ebFadeIn .25s ease-out
}

.eb-ai-loading p {
  margin: 4px 0 0;
  color: var(--muted, #737b91);
  font-size: .84rem
}

.eb-ai-avatar {
  display: grid;
  place-items: center;
  width: 34px;
  height: 34px;
  border-radius: 50%;
  background: #e3e4ff;
  font-size: 1.1rem
}

.eb-ai-message {
  padding: 14px;
  margin: 10px 0;
  border: 1px solid #e1e2ff;
  border-radius: 14px;
  background: linear-gradient(135deg, #f8f8ff, #fff)
}

.eb-contact-layout button:disabled {
  opacity: .65;
  cursor: wait
}

@keyframes ebTyping {

  0%,
  60%,
  100% {
    transform: translateY(0);
    opacity: .45
  }

  30% {
    transform: translateY(-5px);
    opacity: 1
  }
}

@keyframes ebFadeIn {
  from {
    opacity: 0;
    transform: translateY(5px)
  }

  to {
    opacity: 1;
    transform: translateY(0)
  }
}

/* EasyBuy professional automatic category carousel + seller actions */
:root {
  --blue: #0875f9;
  --navy: #102b63
}

.eb-carousel {
  position: relative;
  overflow: hidden;
  min-height: 360px;
  margin: 20px auto 0;
  width: min(1400px, calc(100% - 28px));
  border-radius: 24px;
  background: #eaf4ff;
  box-shadow: 0 18px 45px rgba(14, 65, 135, .13)
}

.eb-slides {
  position: relative;
  min-height: 360px
}

.eb-slide {
  position: absolute;
  inset: 0;
  display: grid;
  grid-template-columns: 1.05fr .95fr;
  align-items: center;
  gap: 16px;
  padding: 34px clamp(24px, 5vw, 72px);
  opacity: 0;
  visibility: hidden;
  transform: translateX(3%);
  transition: opacity .65s ease, transform .65s ease, visibility .65s;
  background: linear-gradient(110deg, #f7fbff 0%, #e5f2ff 58%, #cfe7ff 100%)
}

.eb-slide:before {
  content: "";
  position: absolute;
  inset: 0;
  background-image: var(--slide-image);
  background-size: cover;
  background-position: center;
  opacity: .06;
  pointer-events: none
}

.eb-slide.active {
  position: relative;
  opacity: 1;
  visibility: visible;
  transform: translateX(0)
}

.eb-slide-copy,
.eb-slide-art {
  position: relative;
  z-index: 1
}

.eb-slide-copy h1 {
  font-size: clamp(30px, 4.2vw, 54px);
  line-height: 1.06;
  letter-spacing: -1.8px;
  color: #102b63;
  margin: 14px 0
}

.eb-slide-copy h1 span {
  color: #0875f9
}

.eb-slide-copy p {
  max-width: 520px;
  color: #294b7b;
  font-size: clamp(14px, 1.5vw, 18px);
  line-height: 1.6
}

.eb-slide-copy .eyebrow {
  display: inline-flex;
  padding: 7px 12px;
  border-radius: 30px;
  background: #d7eaff;
  color: #0754b6;
  font-weight: 800;
  font-size: 12px;
  letter-spacing: .6px
}

.eb-slide-art {
  height: 260px;
  display: flex;
  align-items: center;
  justify-content: center
}

.eb-slide-art img {
  max-width: 90%;
  max-height: 245px;
  object-fit: contain;
  filter: drop-shadow(0 18px 18px rgba(22, 59, 108, .12));
  transition: transform .6s
}

.eb-slide.active .eb-slide-art img {
  transform: translateY(-3px) scale(1.03)
}

.eb-carousel-arrow {
  position: absolute;
  z-index: 3;
  top: 50%;
  transform: translateY(-50%);
  width: 42px;
  height: 42px;
  border: 1px solid #c4ddfb;
  border-radius: 50%;
  background: #fff;
  color: #0754b6;
  font-size: 30px;
  line-height: 1;
  cursor: pointer;
  box-shadow: 0 5px 15px #123c6a20
}

.eb-carousel-arrow.prev {
  left: 12px
}

.eb-carousel-arrow.next {
  right: 12px
}

.eb-carousel-dots {
  position: absolute;
  z-index: 3;
  bottom: 16px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 8px
}

.eb-carousel-dots button {
  width: 9px;
  height: 9px;
  border: 0;
  border-radius: 50%;
  padding: 0;
  background: #9bbbe0;
  cursor: pointer
}

.eb-carousel-dots button.active {
  width: 25px;
  border-radius: 8px;
  background: #0875f9
}

.eb-slide-count {
  position: absolute;
  right: 18px;
  top: 16px;
  background: #0875f9;
  color: white;
  font-weight: 800;
  font-size: 12px;
  padding: 6px 10px;
  border-radius: 20px
}

.hero-mini-trust {
  font-size: 12px;
  color: #275487;
  margin-top: 16px
}

.eb-availability {
  font-size: 12px;
  font-weight: 700;
  margin: 8px 0;
  color: #16845b
}

.eb-availability.unavailable {
  color: #c13b48
}

.eb-contact-actions {
  display: flex;
  gap: 8px;
  margin-top: 10px
}

.eb-contact-actions a {
  flex: 1;
  text-align: center;
  border-radius: 9px;
  padding: 9px 7px;
  font-size: 12px;
  font-weight: 800;
  border: 1px solid #c8d9ef;
  background: #f6fbff;
  color: #0754b6
}

.eb-contact-actions .eb-whatsapp-seller {
  background: #e9fff2;
  border-color: #b7e9c9;
  color: #137c42
}

.eb-contact-actions a:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 12px #1a4b8014
}

@media(max-width:720px) {
  .eb-carousel {
    width: calc(100% - 16px);
    border-radius: 16px;
    margin-top: 10px
  }

  .eb-slides,
  .eb-slide {
    min-height: 430px
  }

  .eb-slide {
    grid-template-columns: 1fr;
    padding: 28px 25px 48px;
    gap: 0;
    align-content: center
  }

  .eb-slide-copy h1 {
    font-size: 34px;
    letter-spacing: -1px
  }

  .eb-slide-copy p {
    font-size: 14px
  }

  .eb-slide-art {
    height: 140px
  }

  .eb-slide-art img {
    max-height: 135px;
    max-width: 65%
  }

  .eb-carousel-arrow {
    width: 34px;
    height: 34px;
    font-size: 24px
  }

  .eb-carousel-arrow.prev {
    left: 7px
  }

  .eb-carousel-arrow.next {
    right: 7px
  }

  .eb-contact-actions {
    flex-direction: row
  }

  .eb-contact-actions a {
    font-size: 11px
  }
}

.eb-contact-actions .is-unavailable {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  opacity: .58;
  cursor: not-allowed;
  transform: none;
  box-shadow: none
}

.eb-detail-contact {
  margin: 16px 0 12px;
  gap: 10px;
  flex-wrap: wrap
}

.eb-detail-contact a,
.eb-detail-contact span {
  padding: 12px 14px;
  font-size: 14px
}

.eb-detail-contact .eb-call-seller {
  background: #eaf3ff;
  border-color: #bdd6ff;
  color: #1749b5
}

.eb-detail-contact .eb-whatsapp-seller {
  background: #e9fff2;
  border-color: #b7e9c9;
  color: #137c42
}

.eb-detail-contact a {
  min-width: 145px
}

.eb-contact-actions a,
.eb-contact-actions span {
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  transition: transform .18s ease, box-shadow .18s ease
}

.eb-contact-actions a:focus-visible {
  outline: 3px solid #8dbbff;
  outline-offset: 2px
}

/* Discover page and product-specific messaging CTA */
.detail-message-cta {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 12px;
  margin: 16px 0;
  padding: 14px;
  background: #eff6ff;
  border: 1px solid #dbeafe;
  border-radius: 14px
}

.detail-message-cta span {
  font-size: 12px;
  color: #52627a
}

.discover-category-icon {
  width: 64px;
  height: 64px;
  display: grid;
  place-items: center;
  border-radius: 14px;
  background: #eaf2ff;
  font-size: 32px;
  flex-shrink: 0
}

.page-title .section {
  margin-top: 30px
}

.page-title .sectionhead {
  margin-bottom: 18px
}

/* Persistent order/tracking UI */
.eb-tracking-timeline {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 10px;
  margin: 24px 0
}

.eb-track-step {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 9px;
  text-align: center;
  color: var(--muted);
  font-size: 13px
}

.eb-track-step span {
  width: 34px;
  height: 34px;
  border-radius: 50%;
  display: grid;
  place-items: center;
  border: 2px solid #cbd5e1;
  background: #fff;
  color: #64748b;
  font-weight: 800
}

.eb-track-step.done span {
  border-color: #1763e9;
  background: #1763e9;
  color: #fff
}

.eb-track-step.done strong {
  color: #1749b5
}

.eb-order-status {
  display: inline-flex;
  align-items: center;
  border-radius: 999px;
  background: #eaf2ff;
  color: #1749b5;
  padding: 7px 12px;
  font-size: 12px
}

.eb-action-row {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 16px
}

.eb-action-row .primary,
.eb-action-row .secondary {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  text-decoration: none
}

#sellerOrders select {
  padding: 10px;
  border: 1px solid #dbe3f0;
  border-radius: 10px;
  background: white;
  color: #14213d;
  margin: 4px
}

#sellerMessages form {
  display: flex;
  gap: 8px;
  margin-top: 10px;
  flex-wrap: wrap
}

#sellerMessages input {
  flex: 1;
  min-width: 180px;
  padding: 10px;
  border: 1px solid #dbe3f0;
  border-radius: 10px
}

@media(max-width:600px) {
  .eb-tracking-timeline {
    grid-template-columns: repeat(2, minmax(0, 1fr))
  }

  .eb-action-row>* {
    width: 100%
  }
}


/* EasyBuy product image alignment: keep every card image inside the same frame. */
.product-image-wrap {
  height: 250px;
  min-height: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}
.product-image-wrap > .product-image {
  display: block;
  width: 100%;
  height: 100%;
  max-height: 100%;
  aspect-ratio: auto;
  object-fit: contain;
  object-position: center;
  padding: 10px;
  box-sizing: border-box;
}
.product-image-wrap .tag,
.product-image-wrap .heart {
  position: absolute;
  z-index: 2;
}
.detail-product {
  display: block;
  width: 100%;
  max-height: 520px;
  object-fit: contain;
  object-position: center;
}
@media (max-width: 700px) {
  .product-image-wrap { height: 205px; }
}


/* Wishlist interaction: keep the heart above the image and independently clickable. */
.product-image-wrap { cursor: default !important; }
.product-image-wrap .heart { z-index: 10 !important; position: absolute; pointer-events: auto; cursor: pointer; }
.product-image-wrap .product-image { pointer-events: none; }

/* Inventory availability states */
.eb-stock-in { color: #16845b; }
.eb-stock-out { color: #c13b48; }
.eb-cart-stock { display: block; font-size: 12px; color: #16845b; margin: 4px 0; }
.eb-cart-stock.unavailable { color: #c13b48; }
button:disabled { opacity: .55; cursor: not-allowed !important; }

</style>
    <style>
/* EasyBuy 2026 feature pack: floating navigation, Discover research, buyer/seller chat */
:root {
    --eb-royal: #2459d3;
    --eb-royal-dark: #1745ad;
    --eb-ink: #14213d;
    --eb-muted: #69758c;
    --eb-line: #e5eaf3;
    --eb-soft: #f4f7fd
}

.eb-research-page,
.eb-chat-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 42px 30px 80px 110px
}

.eb-research-hero {
    position: relative;
    overflow: hidden;
    border-radius: 30px;
    padding: clamp(28px, 5vw, 62px);
    background: linear-gradient(125deg, #f5f8ff 0%, #fff 56%, #eaf1ff 100%);
    border: 1px solid #e5ecfb
}

.eb-research-hero:after {
    content: "";
    position: absolute;
    width: 260px;
    height: 260px;
    border: 45px solid #dce7ff80;
    border-radius: 50%;
    right: -70px;
    top: -105px;
    pointer-events: none
}

.eb-research-kicker {
    font-size: 11px;
    letter-spacing: 2px;
    font-weight: 850;
    color: var(--eb-royal)
}

.eb-research-hero h1,
.eb-chat-heading h1 {
    font-size: clamp(34px, 5vw, 58px);
    letter-spacing: -2px;
    line-height: 1.08;
    margin: 14px 0;
    color: var(--eb-ink)
}

.eb-research-hero>p,
.eb-chat-heading>p {
    max-width: 650px;
    color: var(--eb-muted);
    line-height: 1.7
}

.eb-research-form {
    position: relative;
    z-index: 1;
    display: flex;
    gap: 10px;
    max-width: 800px;
    margin-top: 28px;
    padding: 7px;
    background: white;
    border: 1px solid #dfe6f3;
    border-radius: 17px;
    box-shadow: 0 12px 35px #1b3c7910
}

.eb-research-form input {
    min-width: 0;
    flex: 1;
    border: 0;
    outline: 0;
    padding: 13px 14px;
    font-size: 15px;
    background: transparent;
    color: var(--eb-ink)
}

.eb-research-form button,
.eb-chat-send {
    border: 0;
    border-radius: 12px;
    padding: 13px 22px;
    background: var(--eb-royal);
    color: white;
    font-weight: 800;
    cursor: pointer;
    transition: background .2s, transform .2s
}

.eb-research-form button:hover,
.eb-chat-send:hover {
    background: var(--eb-royal-dark);
    transform: translateY(-1px)
}

.eb-research-form button:disabled,
.eb-chat-send:disabled {
    opacity: .6;
    cursor: wait;
    transform: none
}

.eb-research-note {
    font-size: 12px !important;
    margin: 12px 0 0
}

.eb-research-results-wrap {
    padding: 34px 0 0
}

.eb-research-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: end;
    gap: 20px;
    margin-bottom: 20px
}

.eb-research-toolbar .eyebrow {
    color: var(--eb-royal);
    font-size: 10px;
    font-weight: 850;
    letter-spacing: 1.5px
}

.eb-research-toolbar h2 {
    margin: 6px 0 0;
    color: var(--eb-ink);
    font-size: 24px
}

.eb-research-count {
    color: var(--eb-muted);
    font-size: 13px
}

.eb-research-status {
    padding: 15px 17px;
    margin-bottom: 16px;
    border-radius: 13px;
    background: #f4f7fc;
    color: #66738a;
    font-size: 14px
}

.eb-research-status.is-error {
    background: #fff0f0;
    color: #a12d37
}

.eb-research-status.is-success {
    background: #effaf4;
    color: #176943
}

.eb-research-status button,
.eb-chat-error button {
    margin-left: 10px;
    border: 0;
    border-radius: 8px;
    padding: 7px 12px;
    background: var(--eb-royal);
    color: #fff;
    cursor: pointer
}

.eb-spinner {
    display: inline-block;
    width: 15px;
    height: 15px;
    border: 2px solid #cbd8f2;
    border-top-color: var(--eb-royal);
    border-radius: 50%;
    vertical-align: middle;
    margin-right: 9px;
    animation: ebspin .7s linear infinite
}

@keyframes ebspin {
    to {
        transform: rotate(360deg)
    }
}

.eb-research-results {
    display: grid;
    gap: 12px
}

.eb-research-card {
    display: flex;
    gap: 18px;
    padding: 22px;
    border: 1px solid var(--eb-line);
    border-radius: 18px;
    background: white;
    box-shadow: 0 4px 18px #152a4a06;
    transition: transform .2s, border-color .2s
}

.eb-research-card:hover {
    transform: translateY(-2px);
    border-color: #c7d7f8
}

.eb-research-index {
    font-size: 12px;
    font-weight: 850;
    color: #9aa8bf;
    padding-top: 4px
}

.eb-research-card-body {
    min-width: 0
}

.eb-research-card h3 {
    font-size: 17px;
    line-height: 1.45;
    margin: 0 0 8px
}

.eb-research-card h3 a {
    color: #1b3f8d;
    text-decoration: none
}

.eb-research-card h3 a:hover {
    text-decoration: underline
}

.eb-research-card p {
    color: #68758a;
    line-height: 1.65;
    margin: 0 0 12px;
    font-size: 14px;
    overflow-wrap: anywhere
}

.eb-source-link {
    font-size: 12px;
    color: var(--eb-royal);
    font-weight: 750;
    text-decoration: none;
    overflow-wrap: anywhere
}

.eb-source-link span {
    font-size: 15px
}

.eb-chat-heading {
    margin-bottom: 26px
}

.eb-chat-heading h1 {
    font-size: clamp(32px, 4vw, 48px)
}

.eb-chat-layout-new {
    display: grid;
    grid-template-columns: minmax(280px, .85fr) minmax(0, 1.15fr);
    gap: 22px;
    align-items: start
}

.eb-chat-compose,
.eb-chat-history {
    border: 1px solid var(--eb-line);
    border-radius: 22px;
    background: white;
    box-shadow: 0 10px 35px #14213d08;
    overflow: hidden
}

.eb-chat-card-head {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 22px;
    border-bottom: 1px solid var(--eb-line)
}

.eb-chat-card-head h2 {
    margin: 0;
    font-size: 18px;
    color: var(--eb-ink)
}

.eb-chat-card-head p {
    margin: 5px 0 0;
    color: var(--eb-muted);
    font-size: 12px
}

.eb-chat-icon {
    width: 42px;
    height: 42px;
    display: grid;
    place-items: center;
    border-radius: 13px;
    background: #edf3ff;
    color: var(--eb-royal);
    font-size: 21px
}

#ebRealMessageForm {
    padding: 22px;
    display: grid;
    gap: 9px
}

#ebRealMessageForm label {
    font-size: 12px;
    font-weight: 800;
    color: #46536a;
    margin-top: 5px
}

#ebRealMessageForm input,
#ebRealMessageForm select,
#ebRealMessageForm textarea {
    width: 100%;
    border: 1px solid #dce3ef;
    border-radius: 11px;
    background: #fbfcff;
    padding: 12px 13px;
    color: var(--eb-ink);
    font: inherit;
    outline: none
}

#ebRealMessageForm input:focus,
#ebRealMessageForm select:focus,
#ebRealMessageForm textarea:focus {
    border-color: #85a8f5;
    box-shadow: 0 0 0 3px #2459d315
}

.eb-chat-send {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin-top: 8px
}

.eb-chat-status {
    font-size: 12px;
    line-height: 1.6;
    overflow-wrap: anywhere
}

.eb-chat-status.success {
    color: #137449
}

.eb-chat-status.error {
    color: #b32635
}

.eb-chat-status.loading {
    color: var(--eb-royal)
}

.eb-chat-saved-note {
    margin: 0 22px 22px;
    padding: 14px 16px;
    border-radius: 13px;
    background: #f4f7fd
}

.eb-chat-saved-note strong {
    font-size: 12px;
    color: var(--eb-royal)
}

.eb-chat-saved-note p {
    font-size: 12px;
    color: var(--eb-muted);
    margin: 5px 0 0;
    line-height: 1.5
}

.eb-chat-card-head>button {
    margin-left: auto;
    border: 1px solid var(--eb-line);
    border-radius: 10px;
    background: white;
    color: var(--eb-royal);
    font-size: 20px;
    width: 38px;
    height: 38px;
    cursor: pointer
}

.eb-chat-threads {
    padding: 18px;
    display: grid;
    gap: 14px;
    max-height: 850px;
    overflow: auto
}

.eb-chat-thread {
    border: 1px solid var(--eb-line);
    border-radius: 16px;
    overflow: hidden
}

.eb-chat-thread-top {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 13px 14px;
    background: #f8faff;
    border-bottom: 1px solid var(--eb-line)
}

.eb-chat-avatar {
    width: 35px;
    height: 35px;
    display: grid;
    place-items: center;
    border-radius: 50%;
    background: #dfe9ff;
    color: var(--eb-royal);
    font-weight: 850
}

.eb-chat-thread-top strong {
    display: block;
    color: var(--eb-ink);
    font-size: 12px;
    overflow-wrap: anywhere
}

.eb-chat-thread-top small {
    display: block;
    margin-top: 4px;
    color: var(--eb-muted);
    font-size: 11px
}

.eb-chat-message-count {
    margin-left: auto;
    font-size: 10px;
    color: var(--eb-muted);
    white-space: nowrap
}

.eb-chat-bubbles {
    display: grid;
    gap: 10px;
    padding: 14px
}

.eb-chat-bubble {
    max-width: 90%;
    padding: 12px 14px;
    border-radius: 14px;
    background: #f1f4f9
}

.eb-chat-bubble.mine {
    justify-self: end;
    background: #eaf1ff;
    border-bottom-right-radius: 4px
}

.eb-chat-bubble.theirs {
    justify-self: start;
    border-bottom-left-radius: 4px
}

.eb-chat-sender {
    font-size: 10px;
    font-weight: 850;
    color: var(--eb-royal);
    margin-bottom: 5px
}

.eb-chat-bubble p {
    font-size: 13px;
    line-height: 1.55;
    color: #2f3d54;
    margin: 0;
    white-space: pre-wrap;
    overflow-wrap: anywhere
}

.eb-chat-bubble time {
    display: block;
    font-size: 9px;
    color: #8792a5;
    margin-top: 7px
}

.eb-chat-empty {
    text-align: center;
    padding: 35px 18px;
    color: var(--eb-muted);
    font-size: 13px;
    line-height: 1.6
}

.eb-chat-empty>span {
    font-size: 26px;
    color: var(--eb-royal)
}

.eb-chat-empty h3 {
    color: var(--eb-ink);
    margin: 8px 0 4px
}

.eb-chat-empty p {
    margin: 0
}

.eb-chat-error {
    padding: 20px;
    background: #fff5f5;
    color: #9b2934;
    border-radius: 12px;
    font-size: 13px
}

.eb-chat-error p {
    overflow-wrap: anywhere
}

.sr-only {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0
}

@media(max-width:1050px) {

    .eb-research-page,
    .eb-chat-page {
        padding-left: 88px
    }

    .eb-chat-layout-new {
        grid-template-columns: 1fr
    }

    .eb-chat-threads {
        max-height: 650px
    }
}

@media(max-width:680px) {

    .eb-research-page,
    .eb-chat-page {
        padding: 24px 14px 100px
    }

    .eb-research-hero {
        padding: 26px 18px;
        border-radius: 22px
    }

    .eb-research-hero h1 {
        letter-spacing: -1.2px
    }

    .eb-research-form {
        padding: 5px;
        gap: 4px
    }

    .eb-research-form input {
        padding: 10px 8px;
        font-size: 13px
    }

    .eb-research-form button {
        padding: 11px 12px;
        font-size: 12px
    }

    .eb-research-card {
        padding: 16px;
        gap: 10px
    }

    .eb-research-card h3 {
        font-size: 15px
    }

    .eb-research-toolbar h2 {
        font-size: 20px
    }

    .eb-chat-heading {
        padding: 0 3px
    }

    .eb-chat-card-head {
        padding: 17px
    }

    .ebRealMessageForm {
        padding: 17px
    }

    .eb-chat-threads {
        padding: 12px
    }

    .eb-chat-bubble {
        max-width: 96%
    }
}

@media(prefers-reduced-motion:reduce) {
    .eb-spinner {
        animation: none
    }
}

/* WhatsApp-inspired EasyBuy chat workspace */
.eb-wa-page {
    max-width: 1500px;
    padding-top: 28px;
    padding-bottom: 70px
}

.eb-wa-shell {
    height: min(790px, calc(100vh - 100px));
    min-height: 560px;
    display: grid;
    grid-template-columns: minmax(270px, 360px) minmax(0, 1fr);
    overflow: hidden;
    border: 1px solid #dbe2e9;
    border-radius: 18px;
    background: #fff;
    box-shadow: 0 18px 55px #172b4d12
}

.eb-wa-sidebar {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    border-right: 1px solid #dce2e8;
    background: #fff
}

.eb-wa-sidebar-head {
    height: 76px;
    padding: 13px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #f0f2f5;
    border-bottom: 1px solid #e1e6eb
}

.eb-wa-profile {
    display: flex;
    align-items: center;
    gap: 11px;
    min-width: 0
}

.eb-wa-my-avatar,
.eb-wa-contact-avatar {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #d9fdd3;
    color: #236b35;
    font-weight: 800;
    font-size: 16px
}

.eb-wa-profile strong,
.eb-wa-profile small {
    display: block
}

.eb-wa-profile strong {
    font-size: 14px;
    color: #17212b
}

.eb-wa-profile small {
    font-size: 11px;
    color: #667781;
    margin-top: 3px
}

.eb-wa-new {
    width: 39px;
    height: 39px;
    border: 0;
    border-radius: 50%;
    background: #d9fdd3;
    color: #176b3a;
    font-size: 26px;
    line-height: 1;
    cursor: pointer
}

.eb-wa-search {
    margin: 10px 12px;
    padding: 0 13px;
    height: 39px;
    display: flex;
    align-items: center;
    gap: 10px;
    border-radius: 9px;
    background: #f0f2f5;
    color: #667781
}

.eb-wa-search span {
    font-size: 21px
}

.eb-wa-search input {
    min-width: 0;
    width: 100%;
    border: 0;
    outline: 0;
    background: transparent;
    font-size: 13px;
    color: #263238
}

.eb-wa-contacts {
    flex: 1;
    overflow-y: auto;
    min-height: 0
}

.eb-wa-contact {
    width: 100%;
    display: flex;
    gap: 12px;
    align-items: center;
    text-align: left;
    padding: 13px 14px;
    border: 0;
    border-bottom: 1px solid #f0f2f5;
    background: white;
    cursor: pointer;
    transition: background .15s
}

.eb-wa-contact:hover {
    background: #f5f6f6
}

.eb-wa-contact.active {
    background: #f0f2f5
}

.eb-wa-contact-avatar {
    background: #dce6f5;
    color: #385779
}

.eb-wa-contact-copy {
    flex: 1;
    min-width: 0;
    display: block
}

.eb-wa-contact-line {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px
}

.eb-wa-contact-line strong {
    font-size: 13px;
    font-weight: 650;
    color: #17212b;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap
}

.eb-wa-contact-line time {
    font-size: 10px;
    color: #667781;
    white-space: nowrap
}

.eb-wa-contact-preview {
    display: block;
    margin-top: 5px;
    font-size: 12px;
    color: #667781;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap
}

.eb-wa-contact-product {
    display: block;
    margin-top: 4px;
    color: #128c7e;
    font-size: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap
}

.eb-wa-conversation {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    background-color: #efeae2;
    background-image: radial-gradient(#d6d0c7 0.65px, transparent .65px);
    background-size: 14px 14px
}

.eb-wa-chat-head {
    height: 76px;
    flex: 0 0 76px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f0f2f5;
    border-bottom: 1px solid #dce2e8
}

.eb-wa-chat-head strong,
.eb-wa-chat-head small {
    display: block
}

.eb-wa-chat-head strong {
    font-size: 14px;
    color: #17212b;
    overflow-wrap: anywhere
}

.eb-wa-chat-head small {
    font-size: 11px;
    color: #667781;
    margin-top: 4px
}

.eb-wa-chat-person {
    min-width: 0;
    flex: 1
}

.eb-wa-contact-avatar.large {
    width: 43px;
    height: 43px;
    flex-basis: 43px
}

.eb-wa-chat-placeholder-avatar {
    width: 43px;
    height: 43px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #dce6f5;
    color: #526b83
}

.eb-wa-chat-head>button {
    margin-left: auto;
    border: 0;
    border-radius: 50%;
    width: 38px;
    height: 38px;
    background: transparent;
    color: #667781;
    font-size: 24px;
    cursor: pointer
}

.eb-wa-chat-head>button:hover {
    background: #e3e7eb
}

.eb-wa-messages {
    flex: 1;
    min-height: 0;
    overflow-y: auto;
    padding: 22px clamp(14px, 4vw, 55px);
    display: flex;
    flex-direction: column;
    gap: 7px
}

.eb-wa-date-chip {
    align-self: center;
    margin: 0 0 12px;
    padding: 6px 12px;
    border-radius: 8px;
    background: #fff8d5;
    color: #54656f;
    font-size: 10px;
    box-shadow: 0 1px 1px #0000000b
}

.eb-wa-message-row {
    width: 100%;
    display: flex
}

.eb-wa-message-row.outgoing {
    justify-content: flex-end
}

.eb-wa-message-row.incoming {
    justify-content: flex-start
}

.eb-wa-bubble {
    max-width: min(78%, 600px);
    padding: 9px 11px 6px;
    border-radius: 9px;
    box-shadow: 0 1px 1px #00000010;
    background: #fff;
    overflow-wrap: anywhere
}

.eb-wa-message-row.outgoing .eb-wa-bubble {
    background: #d9fdd3;
    border-top-right-radius: 3px
}

.eb-wa-message-row.incoming .eb-wa-bubble {
    border-top-left-radius: 3px
}

.eb-wa-bubble p {
    margin: 0;
    color: #17212b;
    font-size: 13px;
    line-height: 1.55;
    white-space: pre-wrap
}

.eb-wa-bubble time {
    display: block;
    text-align: right;
    margin-top: 4px;
    font-size: 9px;
    color: #667781
}

.eb-wa-bubble time span {
    color: #34a9df;
    letter-spacing: -2px;
    margin-left: 3px
}

.eb-wa-composer {
    position: relative;
    display: flex;
    align-items: flex-end;
    gap: 10px;
    padding: 12px 17px;
    background: #f0f2f5;
    border-top: 1px solid #dce2e8
}

.eb-wa-composer>button {
    flex: 0 0 40px;
    width: 40px;
    height: 40px;
    border: 0;
    border-radius: 50%;
    background: transparent;
    color: #667781;
    font-size: 22px;
    cursor: pointer
}

.eb-wa-composer>button:last-of-type {
    background: #128c7e;
    color: white;
    font-size: 18px
}

.eb-wa-composer>button:disabled {
    opacity: .4;
    cursor: not-allowed
}

.eb-wa-composer textarea {
    flex: 1;
    min-width: 0;
    max-height: 110px;
    resize: vertical;
    border: 0;
    border-radius: 9px;
    padding: 12px 14px;
    background: #fff;
    color: #17212b;
    font-size: 13px;
    line-height: 1.4;
    outline: 0
}

.eb-wa-composer #ebWaStatus {
    position: absolute;
    left: 70px;
    bottom: 2px;
    font-size: 10px;
    color: #667781
}

.eb-wa-composer #ebWaStatus.is-error {
    color: #b32635
}

.eb-wa-composer #ebWaStatus.is-sent {
    color: #087f5b
}

.eb-wa-quick-replies {
    position: absolute;
    z-index: 3;
    bottom: 68px;
    left: 17px;
    padding: 9px;
    display: flex;
    gap: 7px;
    flex-wrap: wrap;
    border: 1px solid #dbe2e9;
    border-radius: 12px;
    background: #fff;
    box-shadow: 0 8px 25px #172b4d20
}

.eb-wa-quick-replies[hidden],
.eb-wa-new-form[hidden] {
    display: none
}

.eb-wa-quick-replies button {
    border: 1px solid #dbe2e9;
    background: #f8fafb;
    border-radius: 18px;
    padding: 7px 10px;
    font-size: 11px;
    color: #35545a;
    cursor: pointer
}

.eb-wa-welcome {
    margin: auto;
    max-width: 420px;
    text-align: center;
    padding: 35px 22px;
    color: #667781
}

.eb-wa-welcome-mark {
    width: 65px;
    height: 65px;
    margin: 0 auto 18px;
    display: grid;
    place-items: center;
    border-radius: 22px;
    background: #d9fdd3;
    color: #128c7e;
    font-weight: 900;
    font-size: 20px
}

.eb-wa-welcome h2 {
    color: #41525d;
    font-size: 22px;
    margin: 0 0 9px
}

.eb-wa-welcome p {
    font-size: 13px;
    line-height: 1.7;
    margin: 0 0 18px
}

.eb-wa-welcome>span {
    font-size: 10px
}

.eb-wa-welcome.compact {
    margin: auto
}

.eb-wa-list-empty {
    padding: 35px 18px;
    text-align: center;
    color: #667781;
    font-size: 12px;
    line-height: 1.6
}

.eb-wa-list-empty strong {
    color: #41525d
}

.eb-wa-list-empty p {
    margin: 6px 0
}

.eb-wa-list-empty button {
    margin-top: 8px;
    border: 0;
    border-radius: 8px;
    padding: 8px 12px;
    background: #128c7e;
    color: #fff;
    cursor: pointer
}

.eb-wa-list-empty.error {
    color: #a12d37
}

.eb-wa-new-form {
    position: absolute;
    z-index: 5;
    top: 66px;
    left: 10px;
    right: 10px;
    padding: 17px;
    display: grid;
    gap: 8px;
    background: #fff;
    border: 1px solid #dbe2e9;
    border-radius: 14px;
    box-shadow: 0 12px 38px #172b4d24
}

.eb-wa-form-head {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4px;
    color: #17212b
}

.eb-wa-form-head button {
    border: 0;
    background: transparent;
    color: #667781;
    font-size: 23px;
    cursor: pointer
}

.eb-wa-new-form label {
    font-size: 11px;
    font-weight: 700;
    color: #52616b
}

.eb-wa-new-form input,
.eb-wa-new-form select {
    width: 100%;
    min-width: 0;
    border: 1px solid #dbe2e9;
    border-radius: 8px;
    padding: 10px;
    font-size: 12px;
    outline-color: #128c7e
}

.eb-wa-start {
    border: 0;
    border-radius: 8px;
    background: #128c7e;
    color: #fff;
    padding: 11px;
    font-weight: 700;
    cursor: pointer
}

.eb-wa-new-form p {
    font-size: 11px;
    color: #b32635;
    margin: 0;
    overflow-wrap: anywhere
}

@media(max-width:900px) {
    .eb-wa-page {
        padding: 16px 10px 90px
    }

    .eb-wa-shell {
        grid-template-columns: minmax(220px, 34%) minmax(0, 1fr);
        height: calc(100vh - 135px);
        min-height: 500px
    }

    .eb-wa-messages {
        padding: 18px 12px
    }

    .eb-wa-bubble {
        max-width: 90%
    }
}

@media(max-width:600px) {
    .eb-wa-page {
        padding: 10px 7px 88px
    }

    .eb-wa-shell {
        height: calc(100vh - 112px);
        min-height: 520px;
        grid-template-columns: 1fr;
        border-radius: 12px
    }

    .eb-wa-sidebar {
        border-right: 0
    }

    .eb-wa-conversation {
        display: none
    }

    .eb-wa-shell.eb-wa-show-chat .eb-wa-sidebar {
        display: none
    }

    .eb-wa-shell.eb-wa-show-chat .eb-wa-conversation {
        display: flex
    }

    .eb-wa-chat-head {
        height: 65px;
        flex-basis: 65px;
        padding: 9px 12px
    }

    .eb-wa-messages {
        padding: 16px 10px
    }

    .eb-wa-composer {
        padding: 9px 7px;
        gap: 5px
    }

    .eb-wa-composer>button {
        flex-basis: 35px;
        width: 35px;
        height: 38px
    }

    .eb-wa-composer textarea {
        padding: 11px 9px
    }

    .eb-wa-composer #ebWaStatus {
        left: 50px
    }

    .eb-wa-contact {
        padding: 12px 10px
    }
}

.eb-wa-back {
    display: none
}

@media(max-width:600px) {
    .eb-wa-back {
        display: block;
        flex: 0 0 28px;
        width: 28px;
        height: 38px;
        border: 0;
        background: transparent;
        color: #54656f;
        font-size: 32px;
        line-height: 1;
        cursor: pointer;
        padding: 0
    }

    .eb-wa-chat-head {
        gap: 8px
    }
}

</style>
    <style>
/* EasyBuy responsive navigation enhancement — additive; existing site theme is retained. */
.navbar {
  position: sticky;
  top: 0;
  z-index: 1000;
}

.navinner {
  gap: 14px;
}

.navlinks {
  display: flex;
  align-items: center;
  gap: clamp(8px, 1.1vw, 18px);
  flex-wrap: wrap;
}

.navlinks a,
.eb-nav-parent {
  color: var(--ink, #17233d);
  text-decoration: none;
  font: inherit;
  font-weight: 600;
  font-size: 14px;
}

.eb-nav-group {
  position: relative;
}

.eb-nav-parent {
  border: 0;
  background: transparent;
  cursor: pointer;
  padding: 8px 2px;
}

.eb-nav-submenu {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  min-width: 205px;
  padding: 8px;
  background: #fff;
  border: 1px solid #dce5f5;
  border-radius: 12px;
  box-shadow: 0 14px 32px #14264a20;
  z-index: 1200;
}

.eb-nav-group.eb-open .eb-nav-submenu {
  display: grid;
  gap: 2px;
}

.eb-nav-submenu a {
  display: block;
  padding: 9px 10px;
  border-radius: 8px;
  white-space: nowrap;
}

.eb-nav-submenu a:hover,
.navlinks a:hover {
  background: #eef4ff;
  color: #164fbd;
}

.navlinks a[aria-current="page"] {
  color: #164fbd;
  text-decoration: underline;
  text-underline-offset: 5px;
}

.eb-menu-toggle {
  display: none;
  border: 1px solid #dce5f5;
  background: white;
  border-radius: 10px;
  padding: 8px 12px;
  font-size: 20px;
  cursor: pointer;
  color: #164fbd;
}

.cartbtn {
  position: relative;
}

#cartCount {
  min-width: 19px;
  height: 19px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 999px;
  background: #164fbd;
  color: white;
  font-size: 11px;
  font-weight: 800;
  padding: 0 5px;
}

[hidden] {
  display: none !important;
}

@media (max-width: 980px) {
  .navinner {
    position: relative;
    flex-wrap: wrap;
  }

  .eb-menu-toggle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    order: 2;
  }

  .navactions {
    margin-left: auto;
    order: 3;
  }

  .navlinks {
    display: none;
    order: 4;
    width: 100%;
    flex-direction: column;
    align-items: stretch;
    gap: 3px;
    padding: 10px;
    background: #fff;
    border: 1px solid #e2e9f6;
    border-radius: 14px;
    box-shadow: 0 12px 28px #14264a16;
  }

  .navlinks.eb-nav-visible {
    display: flex;
  }

  .navlinks>a,
  .eb-nav-parent {
    display: block;
    width: 100%;
    text-align: left;
    padding: 11px 10px;
    border-radius: 8px;
  }

  .eb-nav-submenu {
    position: static;
    box-shadow: none;
    border: 0;
    border-left: 2px solid #dce8ff;
    margin: 0 0 5px 10px;
    border-radius: 0;
  }

  .eb-nav-group.eb-open .eb-nav-submenu {
    display: grid;
  }
}

@media (max-width: 560px) {
  .navactions .search {
    width: min(48vw, 190px);
  }

  .logo {
    font-size: 23px;
  }
}


/* === EasyBuy Neon Motion theme (additive overrides) === */
:root {
  --eb-neon-blue: #1687ff;
  --eb-neon-cyan: #26dfff;
  --eb-neon-purple: #7857ff;
  --eb-night: #030b28;
}

body {
  background-color: #f5f8ff;
}

.navbar {
  background: linear-gradient(115deg, #030a25 0%, #071746 55%, #08123a 100%) !important;
  border-bottom: 1px solid rgba(38, 223, 255, .38) !important;
  box-shadow: 0 8px 30px rgba(4, 13, 48, .18), 0 1px 0 rgba(38, 223, 255, .25);
  transition: box-shadow .25s ease, background .25s ease, padding .25s ease;
}

.navbar::after {
  content: "";
  position: absolute;
  inset: auto 0 -1px;
  height: 2px;
  background: linear-gradient(90deg, transparent, #1687ff, #26dfff, #7857ff, transparent);
  background-size: 220% 100%;
  animation: ebNeonSweep 5s linear infinite;
  pointer-events: none;
}

.navbar .logo,
.navbar .brand,
.navinner .logo {
  color: #f5f8ff !important;
  text-shadow: 0 0 18px rgba(22, 135, 255, .24);
}

.navlinks a,
.eb-nav-parent {
  color: #eaf2ff !important;
  position: relative;
  transition: color .2s ease, background .2s ease, transform .2s ease, text-shadow .2s ease;
}

.navlinks>a::after,
.eb-nav-parent::after {
  content: "";
  position: absolute;
  left: 10px;
  right: 10px;
  bottom: 3px;
  height: 2px;
  border-radius: 999px;
  background: linear-gradient(90deg, var(--eb-neon-blue), var(--eb-neon-cyan));
  transform: scaleX(0);
  transform-origin: center;
  transition: transform .24s ease;
  box-shadow: 0 0 12px rgba(38, 223, 255, .8);
}

.navlinks>a:hover::after,
.eb-nav-parent:hover::after,
.navlinks>a[aria-current="page"]::after {
  transform: scaleX(1);
}

.navlinks a:hover,
.eb-nav-parent:hover {
  color: #fff !important;
  background: rgba(22, 135, 255, .13) !important;
  text-shadow: 0 0 12px rgba(38, 223, 255, .65);
  transform: translateY(-1px);
}

.eb-nav-submenu {
  background: rgba(3, 12, 43, .97) !important;
  border: 1px solid rgba(38, 223, 255, .55) !important;
  box-shadow: 0 14px 38px rgba(0, 0, 0, .3), 0 0 18px rgba(22, 135, 255, .15) !important;
  backdrop-filter: blur(16px);
  transform: translateY(7px);
  opacity: 0;
  transition: transform .2s ease, opacity .2s ease;
}

.eb-nav-group.eb-open .eb-nav-submenu {
  transform: translateY(0);
  opacity: 1;
}

.eb-nav-submenu a {
  color: #eaf2ff !important;
}

.eb-nav-submenu a:hover {
  background: rgba(22, 135, 255, .22) !important;
}

.eb-menu-toggle {
  background: rgba(7, 23, 70, .95) !important;
  color: #fff !important;
  border-color: rgba(38, 223, 255, .5) !important;
  box-shadow: 0 0 15px rgba(22, 135, 255, .16);
}

.cartbtn {
  background: linear-gradient(135deg, #10162e, #151a36) !important;
  border: 1px solid rgba(38, 223, 255, .4);
  box-shadow: 0 0 18px rgba(22, 135, 255, .14);
  transition: transform .2s ease, box-shadow .2s ease;
}

.cartbtn:hover {
  transform: translateY(-2px) scale(1.025);
  box-shadow: 0 0 22px rgba(22, 135, 255, .28);
}

#cartCount {
  background: linear-gradient(135deg, #1687ff, #2454ff) !important;
  box-shadow: 0 0 12px rgba(22, 135, 255, .55);
}

.eb-cart-bump {
  animation: ebCartBump .42s ease;
}

@keyframes ebNeonSweep {
  to {
    background-position: 220% 0;
  }
}

@keyframes ebCartBump {

  0%,
  100% {
    transform: scale(1);
  }

  35% {
    transform: scale(1.16) rotate(-5deg);
  }

  70% {
    transform: scale(.96) rotate(4deg);
  }
}

@media (max-width:980px) {
  .navlinks {
    background: rgba(3, 12, 43, .98) !important;
    border-color: rgba(38, 223, 255, .45) !important;
    box-shadow: 0 16px 35px rgba(0, 0, 0, .3), 0 0 18px rgba(22, 135, 255, .14) !important;
    backdrop-filter: blur(16px);
  }

  .eb-nav-submenu {
    background: rgba(5, 17, 53, .98) !important;
  }
}

@media (prefers-reduced-motion: reduce) {
  .navbar::after {
    animation: none;
  }

  *,
  *::before,
  *::after {
    transition-duration: .01ms !important;
    animation-duration: .01ms !important;
    animation-iteration-count: 1 !important;
    scroll-behavior: auto !important;
  }
}

/* Requested EasyBuy white + royal-blue navigation refinement (no dark navy/neon theme). */
:root {
  --eb-neon-blue: #2874f0;
  --eb-neon-cyan: #2874f0;
  --eb-neon-purple: #2874f0;
  --eb-night: #ffffff
}

body {
  background: #f6f9ff
}

.topline {
  background: #2874f0 !important;
  color: #fff !important
}

.navbar {
  background: #ffffff !important;
  border-bottom: 1px solid #e4ebf5 !important;
  box-shadow: 0 6px 22px #2874f012 !important
}

.navbar::after {
  height: 2px;
  background: linear-gradient(90deg, transparent, #2874f0, #70a4ff, transparent) !important;
  opacity: .7
}

.navbar .logo,
.navbar .brand,
.navinner .logo {
  color: #1c2940 !important;
  text-shadow: none !important
}

.navlinks a,
.eb-nav-parent {
  color: #1c2940 !important;
  text-shadow: none !important
}

.navlinks a:hover,
.eb-nav-parent:hover {
  color: #2874f0 !important;
  background: #eef4ff !important;
  text-shadow: none !important
}

.navlinks a[aria-current="page"] {
  color: #2874f0 !important;
  text-decoration: none !important;
  background: #eef4ff;
  border-radius: 8px
}

.navlinks>a::after,
.eb-nav-parent::after {
  background: #2874f0 !important;
  box-shadow: none !important
}

.eb-nav-submenu {
  background: #fff !important;
  border: 1px solid #dce5f5 !important;
  box-shadow: 0 14px 32px #14264a20 !important;
  backdrop-filter: none !important
}

.eb-nav-submenu a {
  color: #1c2940 !important
}

.eb-nav-submenu a:hover {
  background: #eef4ff !important;
  color: #164fbd !important
}

.eb-menu-toggle {
  background: #fff !important;
  color: #2874f0 !important;
  border: 1px solid #dce5f5 !important;
  box-shadow: none !important
}

.cartbtn {
  background: #2874f0 !important;
  color: #fff !important;
  border: 1px solid #2874f0 !important;
  box-shadow: 0 5px 14px #2874f022 !important
}

#cartCount {
  background: #fff !important;
  color: #2874f0 !important;
  box-shadow: none !important
}

.eb-history-empty {
  text-align: center;
  padding: 54px 20px;
  background: #fff;
  border: 1px solid #e4ebf5;
  border-radius: 22px
}

.eb-history-empty h3 {
  margin: 10px 0 6px;
  color: #1c2940
}

.eb-history-empty p {
  color: #718096;
  margin: 0 auto 20px;
  max-width: 430px
}

.eb-history-icon {
  margin: auto;
  width: 58px;
  height: 58px;
  display: grid;
  place-items: center;
  border-radius: 18px;
  background: #eef4ff;
  color: #2874f0;
  font-size: 28px
}

.eb-floating-categories {
  display: none !important
}

@media(max-width:980px) {
  .navlinks {
    background: #fff !important;
    border-color: #e2e9f6 !important;
    box-shadow: 0 12px 28px #14264a16 !important;
    backdrop-filter: none !important
  }

  .eb-nav-submenu {
    background: #fff !important
  }
}

@media(prefers-reduced-motion:reduce) {
  .navbar::after {
    animation: none
  }
}

</style>
</head>

<body>
    <div class="loading-screen" id="loading">
        <div>
            <div class="eb-loader-scene" aria-label="EasyBuy is loading">
                <div class="eb-loader-moon"></div>
                <div class="eb-loader-flower">✿</div>
                <div class="eb-loader-track"><span class="eb-running-basket">🛒</span></div>
            </div>
            <div class="loader-label" id="loaderLabel">EASYBUY · LOADING YOUR CAMPUS</div>
        </div>
    </div>
    <div class="topline">🎓 Student-to-student marketplace · Save more, waste less · Meet safely on campus</div>
    <header class="navbar">
        <div class="wrap navinner">
            <a class="logo" href="#home">Easy<b>buy.</b></a>
            <button class="eb-menu-toggle" id="ebMenuToggle" type="button" aria-expanded="false" aria-controls="ebNavPanel" aria-label="Open navigation menu">☰</button>
            <nav class="navlinks" id="ebNavPanel" aria-label="Main navigation">
                <a href="#home" data-public-nav>Home</a>
                <a href="#shop" data-public-nav>Shop</a>
                <a href="#discover" data-public-nav>Discover</a>
                <div class="eb-nav-group">
                    <button type="button" class="eb-nav-parent" aria-expanded="false" data-menu-parent="categories">Categories⌄</button>
                    <div class="eb-nav-submenu" data-menu="categories">
                        <a href="#shop?category=Books">Books</a><a href="#shop?category=Stationery%20Kits">Stationery Kits</a>
                        <a href="#shop?category=Electronics">Electronics</a><a href="#shop?category=Accessories">Accessories</a>
                        <a href="#shop?category=College%20Essentials">College Essentials</a><a href="#shop?category=Lab%20Equipment">Lab Equipment</a>
                    </div>
                </div>
                <div class="eb-nav-group" data-auth-only hidden>
                    <button type="button" class="eb-nav-parent" aria-expanded="false" data-menu-parent="sell">Sell⌄</button>
                    <div class="eb-nav-submenu" data-menu="sell">
                        <a href="#sell">Start Selling</a><a href="sellerindex.php">Seller Studio</a><a href="#my-products">My Products</a><a href="#product-history">Product History</a>
                    </div>
                </div>
                <div class="eb-nav-group" data-auth-only hidden>
                    <button type="button" class="eb-nav-parent" aria-expanded="false" data-menu-parent="account">👤 My Account⌄</button>
                    <div class="eb-nav-submenu" data-menu="account">
                        <a href="#account">👤 Profile</a>
                        <a href="#orders">📦 My Orders</a>
                        <a href="#tracking">🚚 Track Order</a>
                        <a href="#wishlist">♡ Wishlist</a>
                        <a href="#product-history">🕘 Product History</a>
                        <a href="#messages">✉ Messages</a>
                        <a href="#refunds">↩ Refunds</a>
                        <a href="#cart">🛒 Cart</a>
                        <a href="#location">📍 Location</a>
                        <a href="#help">❔ Help Centre</a>
                        <a href="#contact">☎ Contact</a>
                        <a href="#logout" data-logout-link>↪ Logout</a>
                    </div>
                </div>
                <a href="#login" data-guest-nav>Login</a><a href="#signup" data-guest-nav>Register</a>
            </nav>
            <div class="navactions">
                <input class="search" id="navSearch" placeholder="Search products…" aria-label="Search products">
                <a class="cartbtn" href="#cart" aria-label="Open shopping cart"><span class="eb-cart-icon">🛒</span><span
            id="cartCount">0</span></a>
            </div>
        </div>
    </header>
    <main id="app"></main>
    <footer class="footer">
        <div class="wrap">
            <div class="footer-grid">
                <div>
                    <a class="logo" href="#home" style="color:white">easy<b>buy.</b></a>
                    <p>A friendly student marketplace to buy, sell, and reuse campus essentials. Always meet in a public campus spot and inspect items before paying.</p>
                </div>
                <div>
                    <h3>Explore</h3>
                    <div class="footerlinks">
                        <a href="#shop">Shop products</a>
                        <a href="#sell">Sell an item</a>
                        <a href="#orders">My orders</a>
                        <a href="#help">Help centre</a>
                        <a href="#contact">Contact</a>
                        <a href="#feedback">Feedback</a>
                        <a href="#location">College route map</a>
                    </div>
                </div>
                <div>
                    <h3>Student safety</h3>
                    <p>Image results are fetched from Google Books and Wikimedia Commons when available. Confirm seller identity, product condition and college meeting point before paying.</p>
                </div>
            </div>
            <div class="copyright">© 2026 EasyBuy Campus Marketplace · Live public image and map APIs</div>
        </div>
    </footer>
    <script>
        document.documentElement.classList.add("eb-auth-pending");
    </script>
    
    
    
    
    
    
    
    
    
    
    
    
<script>

/* ===== js/products.js ===== */
window.EASYBUY_PRODUCTS = [
  {
    id: "EB101",
    name: "Scientific Calculator",
    category: "Calculators",
    price: 349,
    oldPrice: 499,
    subtitle: "Casio-style scientific calculator",
    condition: "Used · Very good",
    college: "SASTRA University",
    description:
      "Mathematics, engineering, and statistics calculations. 240 functions, dual-line display, hard case included.",
    image: "images/scientific calculator.jpg",
    rating: 4.2,
    reviews: 19,
    stock: 4,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB102",
    name: "Engineering Mathematics Vol. 1",
    category: "Books",
    price: 120,
    oldPrice: 220,
    subtitle: "Engineering Mathematics textbook",
    condition: "Used · Good",
    college: "SASTRA University",
    description:
      "Clear worked examples and practice problems. Notes are neat; a few highlights on selected pages.",
    image: "images/College Mathematics.jpg",
    rating: 4.3,
    reviews: 26,
    stock: 5,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB103",
    name: "Campus Backpack",
    category: "Bags",
    price: 399,
    oldPrice: 699,
    subtitle: "Water-resistant college backpack",
    condition: "First-hand · New",
    college: "Bharathidasan University",
    description:
      "Fits books, a 15-inch laptop, and daily essentials. Padded straps and front organiser pocket.",
    image: "images/Laptop Backpack.jpg",
    rating: 4.4,
    reviews: 33,
    stock: 6,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB104",
    name: "Wireless Headphones",
    category: "Electronics",
    price: 599,
    oldPrice: 999,
    subtitle: "Bluetooth over-ear headphones",
    condition: "Used · Very good",
    college: "SRM Institute of Science and Technology",
    description:
      "Wireless listening, cushioned ear pads, built-in mic, charging cable included.",
    image: "images/Bluetooth Headphones.jpg",
    rating: 4.5,
    reviews: 40,
    stock: 7,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB105",
    name: "Lab Coat",
    category: "Lab Equipment",
    price: 249,
    oldPrice: 399,
    subtitle: "White cotton lab coat",
    condition: "Used · Like new",
    college: "Annamalai University",
    description:
      "Clean white coat with front pockets. Check your department requirements before purchase.",
    image: "images/Basic Lab Equipment Set.jpg",
    rating: 4.6,
    reviews: 47,
    stock: 8,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Like new",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB106",
    name: "Stationery Starter Kit",
    category: "Stationery Kits",
    price: 99,
    oldPrice: 179,
    subtitle: "Pens, pencils, ruler and sticky notes",
    condition: "First-hand · New",
    college: "SASTRA University",
    description:
      "Everyday class kit with 3 pens, 2 pencils, ruler, eraser, and pastel sticky notes.",
    image: "images/Student Stationery Kit.jpg",
    rating: 4.7,
    reviews: 54,
    stock: 9,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB107",
    name: "USB-C Flash Drive 64GB",
    category: "Electronics",
    price: 249,
    oldPrice: 399,
    subtitle: "64GB USB flash drive",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Compact storage for class notes and project files. USB-C connector; verify device compatibility.",
    image: "images/USB-C Flash Drive.jpg",
    rating: 4.8,
    reviews: 61,
    stock: 10,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB108",
    name: "Graph Notebook Pack",
    category: "Books",
    price: 89,
    oldPrice: 149,
    subtitle: "Pack of 3 graph notebooks",
    condition: "First-hand · New",
    college: "Bharathiar University",
    description:
      "Three A4 graph notebooks suitable for lab records, maths and diagrams.",
    image: "images/Graph Notebook Pack.jpg",
    rating: 4.1,
    reviews: 68,
    stock: 11,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB109",
    name: "Safety Goggles",
    category: "Lab Equipment",
    price: 79,
    oldPrice: 129,
    subtitle: "Clear protective lab goggles",
    condition: "Used · Very good",
    college: "SRM Institute of Science and Technology",
    description:
      "Clear protective eyewear for appropriate supervised lab activities. Follow campus safety rules.",
    image: "images/Safety Goggles.jpg",
    rating: 4.2,
    reviews: 12,
    stock: 3,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB110",
    name: "Classic Campus T-shirt",
    category: "T-Shirts",
    price: 199,
    oldPrice: 299,
    subtitle: "Cotton everyday T-shirt",
    condition: "First-hand · New",
    college: "SASTRA University",
    description:
      "Soft cotton everyday tee. Select your size and confirm fit with the seller before ordering.",
    image: "images/Classic Campus T-shirt.jpg",
    rating: 4.1,
    reviews: 12,
    stock: 3,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB111",
    name: "Wireless Mouse",
    category: "Electronics",
    price: 299,
    oldPrice: 499,
    subtitle: "2.4GHz wireless mouse",
    condition: "Used · Good",
    college: "VIT Chennai",
    description:
      "Comfortable compact mouse with USB receiver. Great for library and laptop work.",
    image: "images/Wireless Mouse.jpg",
    rating: 4.2,
    reviews: 19,
    stock: 4,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Good",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB112",
    name: "Minimalist Pencil Pouch",
    category: "Accessories",
    price: 79,
    oldPrice: 149,
    subtitle: "Zipper pencil pouch",
    condition: "First-hand · New",
    college: "Annamalai University",
    description:
      "Lightweight pouch with space for pens, pencils, eraser and small accessories.",
    image: "images/Minimalist Pencil Pouch.jpg",
    rating: 4.3,
    reviews: 26,
    stock: 5,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB113",
    name: "Intro to Python Programming",
    category: "Books",
    price: 159,
    oldPrice: 299,
    subtitle: "Beginner Python programming book",
    condition: "Used · Very good",
    college: "SASTRA University",
    description:
      "Beginner-friendly programming text covering variables, loops, functions and small exercises.",
    image: "images/Intro to Python Programming.jpg",
    rating: 4.4,
    reviews: 33,
    stock: 6,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB114",
    name: "Digital Vernier Caliper",
    category: "Lab Equipment",
    price: 449,
    oldPrice: 699,
    subtitle: "Digital measuring caliper",
    condition: "Used · Good",
    college: "Bharathidasan University",
    description:
      "Digital measurement tool for approved lab use. Confirm range and calibration with seller.",
    image: "images/Digital Vernier Caliper.jpg",
    rating: 4.5,
    reviews: 40,
    stock: 7,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB115",
    name: "Laptop Stand",
    category: "Accessories",
    price: 349,
    oldPrice: 599,
    subtitle: "Foldable aluminium laptop stand",
    condition: "Used · Very good",
    college: "VIT Chennai",
    description:
      "Foldable stand for a more comfortable desk setup. Check laptop dimensions before buying.",
    image: "images/Laptop Stand.jpg",
    rating: 4.6,
    reviews: 47,
    stock: 8,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB116",
    name: "A4 Document Folder",
    category: "Stationery Kits",
    price: 59,
    oldPrice: 99,
    subtitle: "Snap-lock document folder",
    condition: "First-hand · New",
    college: "SASTRA University",
    description:
      "Keep assignments, certificates and printed notes organised in a lightweight folder.",
    image: "images/A4 Document Folder.jpg",
    rating: 4.7,
    reviews: 54,
    stock: 9,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB117",
    name: "Scientific Lab Notebook",
    category: "Books",
    price: 69,
    oldPrice: 119,
    subtitle: "Ruled lab observation notebook",
    condition: "First-hand · New",
    college: "SRM Institute of Science and Technology",
    description:
      "Ruled pages for observations and calculations. Check your college record format before use.",
    image: "images/Scientific Lab Notebook.jpg",
    rating: 4.8,
    reviews: 61,
    stock: 10,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB118",
    name: "Reusable Water Bottle",
    category: "Accessories",
    price: 149,
    oldPrice: 249,
    subtitle: "750ml reusable bottle",
    condition: "First-hand · New",
    college: "Annamalai University",
    description:
      "Lightweight reusable bottle for campus days. Wash before first use.",
    image: "images/Reusable Water Bottle.jpg",
    rating: 4.1,
    reviews: 68,
    stock: 11,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB119",
    name: "Portable Bluetooth Speaker",
    category: "Electronics",
    price: 499,
    oldPrice: 799,
    subtitle: "Compact Bluetooth speaker",
    condition: "Used · Very good",
    college: "Bharathiar University",
    description:
      "Portable speaker for personal listening. Includes charging cable; test before accepting purchase.",
    image: "images/Portable Bluetooth Speaker.jpg",
    rating: 4.2,
    reviews: 12,
    stock: 3,
    seller: "Campus Seller",
    specs: {
      Condition: "Used · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB120",
    name: "Drawing Geometry Set",
    category: "Stationery Kits",
    price: 129,
    oldPrice: 199,
    subtitle: "Student geometry instrument set",
    condition: "First-hand · New",
    college: "SASTRA University",
    description:
      "Geometry tools in a compact case for classroom drawing and maths work.",
    image: "images/Drawing Geometry Set.jpg",
    rating: 4.1,
    reviews: 12,
    stock: 3,
    seller: "Campus Seller",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0121",
    name: "USB-C Flash Drive",
    category: "Electronics",
    price: 1280,
    oldPrice: 1541,
    subtitle: "USB-C Flash Drive for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "USB-C Flash Drive. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Flash Drive.jpg",
    rating: 4.8,
    reviews: 69,
    stock: 8,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0122",
    name: "Bluetooth Headphones",
    category: "Electronics",
    price: 230,
    oldPrice: 303,
    subtitle: "Bluetooth Headphones for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Bluetooth Headphones. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Headphones.jpg",
    rating: 4.5,
    reviews: 43,
    stock: 11,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0123",
    name: "USB-C Hub",
    category: "Electronics",
    price: 515,
    oldPrice: 615,
    subtitle: "USB-C Hub for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "USB-C Hub. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Hub.jpg",
    rating: 4.5,
    reviews: 55,
    stock: 10,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0124",
    name: "Laptop Cooling Pad",
    category: "Electronics",
    price: 477,
    oldPrice: 687,
    subtitle: "Laptop Cooling Pad for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Laptop Cooling Pad. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Cooling Pad.jpg",
    rating: 4.3,
    reviews: 66,
    stock: 2,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0125",
    name: "Laptop Stand",
    category: "Electronics",
    price: 218,
    oldPrice: 310,
    subtitle: "Laptop Stand for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Laptop Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Stand.jpg",
    rating: 4.4,
    reviews: 64,
    stock: 4,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0126",
    name: "Webcam",
    category: "Electronics",
    price: 1284,
    oldPrice: 1714,
    subtitle: "Webcam for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Webcam. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Webcam.jpg",
    rating: 4.4,
    reviews: 50,
    stock: 1,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0127",
    name: "USB Microphone",
    category: "Electronics",
    price: 248,
    oldPrice: 296,
    subtitle: "USB Microphone for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "USB Microphone. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Microphone.jpg",
    rating: 4.4,
    reviews: 76,
    stock: 2,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0128",
    name: "Portable SSD Enclosure",
    category: "Electronics",
    price: 1091,
    oldPrice: 1564,
    subtitle: "Portable SSD Enclosure for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Portable SSD Enclosure. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable SSD Enclosure.jpg",
    rating: 4.6,
    reviews: 12,
    stock: 9,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0129",
    name: "HDMI Adapter",
    category: "Electronics",
    price: 1269,
    oldPrice: 1698,
    subtitle: "HDMI Adapter for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "HDMI Adapter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HDMI Adapter.jpg",
    rating: 4.5,
    reviews: 27,
    stock: 10,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0130",
    name: "USB-C Cable",
    category: "Electronics",
    price: 675,
    oldPrice: 891,
    subtitle: "USB-C Cable for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB-C Cable. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Cable.jpg",
    rating: 4.1,
    reviews: 3,
    stock: 3,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0131",
    name: "Laptop Charger",
    category: "Electronics",
    price: 1286,
    oldPrice: 1627,
    subtitle: "Laptop Charger for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Laptop Charger. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Charger.jpg",
    rating: 4.2,
    reviews: 15,
    stock: 8,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0132",
    name: "Power Bank",
    category: "Electronics",
    price: 647,
    oldPrice: 836,
    subtitle: "Power Bank for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Power Bank. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Power Bank.jpg",
    rating: 4.0,
    reviews: 69,
    stock: 7,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0133",
    name: "Bluetooth Speaker",
    category: "Electronics",
    price: 1421,
    oldPrice: 1866,
    subtitle: "Bluetooth Speaker for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Bluetooth Speaker. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Speaker.jpg",
    rating: 4.7,
    reviews: 77,
    stock: 3,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0134",
    name: "Wired Earphones",
    category: "Electronics",
    price: 211,
    oldPrice: 277,
    subtitle: "Wired Earphones for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Wired Earphones. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wired Earphones.jpg",
    rating: 4.5,
    reviews: 26,
    stock: 10,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0135",
    name: "Wireless Keyboard",
    category: "Electronics",
    price: 822,
    oldPrice: 1119,
    subtitle: "Wireless Keyboard for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Wireless Keyboard. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wireless Keyboard.jpg",
    rating: 4.5,
    reviews: 60,
    stock: 7,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0136",
    name: "Mechanical Keyboard",
    category: "Electronics",
    price: 257,
    oldPrice: 343,
    subtitle: "Mechanical Keyboard for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Mechanical Keyboard. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mechanical Keyboard.jpg",
    rating: 4.8,
    reviews: 57,
    stock: 2,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0137",
    name: "Laptop Sleeve",
    category: "Electronics",
    price: 182,
    oldPrice: 218,
    subtitle: "Laptop Sleeve for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Laptop Sleeve. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sleeve.jpg",
    rating: 4.4,
    reviews: 20,
    stock: 6,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0138",
    name: "Screen Cleaning Kit",
    category: "Electronics",
    price: 511,
    oldPrice: 630,
    subtitle: "Screen Cleaning Kit for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Screen Cleaning Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Screen Cleaning Kit.jpg",
    rating: 4.8,
    reviews: 80,
    stock: 12,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0139",
    name: "USB Desk Lamp",
    category: "Electronics",
    price: 780,
    oldPrice: 921,
    subtitle: "USB Desk Lamp for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "USB Desk Lamp. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Desk Lamp.jpg",
    rating: 4.1,
    reviews: 54,
    stock: 7,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0140",
    name: "Ethernet Adapter",
    category: "Electronics",
    price: 168,
    oldPrice: 233,
    subtitle: "Ethernet Adapter for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Ethernet Adapter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ethernet Adapter.jpg",
    rating: 4.5,
    reviews: 12,
    stock: 8,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0141",
    name: "Card Reader",
    category: "Electronics",
    price: 1231,
    oldPrice: 1625,
    subtitle: "Card Reader for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Card Reader. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Card Reader.jpg",
    rating: 4.4,
    reviews: 44,
    stock: 4,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0142",
    name: "Phone Tripod",
    category: "Electronics",
    price: 806,
    oldPrice: 1078,
    subtitle: "Phone Tripod for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Phone Tripod. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Tripod.jpg",
    rating: 4.1,
    reviews: 55,
    stock: 10,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0143",
    name: "Phone Holder",
    category: "Electronics",
    price: 1441,
    oldPrice: 2053,
    subtitle: "Phone Holder for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Phone Holder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Holder.jpg",
    rating: 4.7,
    reviews: 53,
    stock: 8,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0144",
    name: "USB Fan",
    category: "Electronics",
    price: 784,
    oldPrice: 1020,
    subtitle: "USB Fan for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "USB Fan. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Fan.jpg",
    rating: 4.6,
    reviews: 65,
    stock: 10,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0145",
    name: "Rechargeable Torch",
    category: "Electronics",
    price: 596,
    oldPrice: 843,
    subtitle: "Rechargeable Torch for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Rechargeable Torch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Rechargeable Torch.webp",
    rating: 4.9,
    reviews: 29,
    stock: 11,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0146",
    name: "Smart Plug",
    category: "Electronics",
    price: 1156,
    oldPrice: 1406,
    subtitle: "Smart Plug for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Smart Plug. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Smart Plug.jpg",
    rating: 4.9,
    reviews: 77,
    stock: 7,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0147",
    name: "USB Extension Hub",
    category: "Electronics",
    price: 1106,
    oldPrice: 1486,
    subtitle: "USB Extension Hub for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "USB Extension Hub. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Extension Hub.jpg",
    rating: 4.2,
    reviews: 65,
    stock: 2,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0148",
    name: "Laptop Privacy Filter",
    category: "Electronics",
    price: 307,
    oldPrice: 396,
    subtitle: "Laptop Privacy Filter for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Laptop Privacy Filter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Privacy Filter.jpg",
    rating: 4.5,
    reviews: 81,
    stock: 9,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0149",
    name: "Webcam Cover",
    category: "Electronics",
    price: 243,
    oldPrice: 291,
    subtitle: "Webcam Cover for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Webcam Cover. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Webcam Cover.jpg",
    rating: 4.4,
    reviews: 31,
    stock: 1,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0150",
    name: "Mini Projector",
    category: "Electronics",
    price: 1081,
    oldPrice: 1516,
    subtitle: "Mini Projector for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Mini Projector. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Projector.jpg",
    rating: 4.6,
    reviews: 53,
    stock: 9,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0151",
    name: "Portable Monitor Stand",
    category: "Electronics",
    price: 1082,
    oldPrice: 1483,
    subtitle: "Portable Monitor Stand for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Portable Monitor Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Monitor Stand.jpg",
    rating: 4.6,
    reviews: 18,
    stock: 2,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0152",
    name: "Gaming Mouse Pad",
    category: "Electronics",
    price: 1200,
    oldPrice: 1733,
    subtitle: "Gaming Mouse Pad for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Gaming Mouse Pad. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gaming Mouse Pad.jpg",
    rating: 4.4,
    reviews: 69,
    stock: 1,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0153",
    name: "Laptop Lock",
    category: "Electronics",
    price: 142,
    oldPrice: 206,
    subtitle: "Laptop Lock for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Laptop Lock. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Lock.jpg",
    rating: 4.1,
    reviews: 9,
    stock: 3,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0154",
    name: "USB Wi-Fi Adapter",
    category: "Electronics",
    price: 1385,
    oldPrice: 1710,
    subtitle: "USB Wi-Fi Adapter for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB Wi-Fi Adapter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Wi-Fi Adapter.jpg",
    rating: 4.5,
    reviews: 72,
    stock: 4,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0155",
    name: "Bluetooth Receiver",
    category: "Electronics",
    price: 1339,
    oldPrice: 1790,
    subtitle: "Bluetooth Receiver for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Bluetooth Receiver. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Receiver.jpg",
    rating: 4.0,
    reviews: 15,
    stock: 12,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0156",
    name: "Type-C OTG Adapter",
    category: "Electronics",
    price: 118,
    oldPrice: 155,
    subtitle: "Type-C OTG Adapter for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Type-C OTG Adapter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Type-C OTG Adapter.jpg",
    rating: 4.5,
    reviews: 5,
    stock: 5,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0157",
    name: "USB Desk Clock",
    category: "Electronics",
    price: 230,
    oldPrice: 309,
    subtitle: "USB Desk Clock for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "USB Desk Clock. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Desk Clock.jpg",
    rating: 4.1,
    reviews: 25,
    stock: 6,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0158",
    name: "Cable Organiser",
    category: "Electronics",
    price: 1155,
    oldPrice: 1576,
    subtitle: "Cable Organiser for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Cable Organiser. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cable Organiser.jpg",
    rating: 4.0,
    reviews: 32,
    stock: 9,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0159",
    name: "Surge Protector",
    category: "Electronics",
    price: 595,
    oldPrice: 765,
    subtitle: "Surge Protector for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Surge Protector. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Surge Protector.jpg",
    rating: 4.2,
    reviews: 17,
    stock: 6,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0160",
    name: "HDMI Cable",
    category: "Electronics",
    price: 1137,
    oldPrice: 1379,
    subtitle: "HDMI Cable for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "HDMI Cable. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HDMI Cable.jpg",
    rating: 4.2,
    reviews: 35,
    stock: 6,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0161",
    name: "DisplayPort Cable",
    category: "Electronics",
    price: 450,
    oldPrice: 594,
    subtitle: "DisplayPort Cable for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "DisplayPort Cable. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/DisplayPort Cable.jpg",
    rating: 4.7,
    reviews: 47,
    stock: 1,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0162",
    name: "USB-C to HDMI Adapter",
    category: "Electronics",
    price: 1109,
    oldPrice: 1325,
    subtitle: "USB-C to HDMI Adapter for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB-C to HDMI Adapter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C to HDMI Adapter.jpg",
    rating: 4.2,
    reviews: 74,
    stock: 8,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0163",
    name: "Wireless Presenter.jpg",
    category: "Electronics",
    price: 152,
    oldPrice: 202,
    subtitle: "Wireless Presenter.jpg for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Wireless Presenter.jpg. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wireless Presenter.jpg",
    rating: 4.7,
    reviews: 48,
    stock: 1,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0164",
    name: "Stylus Pen",
    category: "Electronics",
    price: 1399,
    oldPrice: 1687,
    subtitle: "Stylus Pen for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Stylus Pen. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Stylus Pen.png",
    rating: 4.7,
    reviews: 44,
    stock: 4,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0165",
    name: "Tablet Stand",
    category: "Electronics",
    price: 218,
    oldPrice: 258,
    subtitle: "Tablet Stand for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Tablet Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tablet Stand.jpg",
    rating: 4.3,
    reviews: 3,
    stock: 2,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0166",
    name: "Phone Charging Dock",
    category: "Electronics",
    price: 416,
    oldPrice: 511,
    subtitle: "Phone Charging Dock for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Phone Charging Dock. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Charging Dock.jpg",
    rating: 4.3,
    reviews: 59,
    stock: 4,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0167",
    name: "Fast Charger",
    category: "Electronics",
    price: 1139,
    oldPrice: 1414,
    subtitle: "Fast Charger for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Fast Charger. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fast Charger.jpg",
    rating: 4.7,
    reviews: 6,
    stock: 3,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0168",
    name: "Earbud Case",
    category: "Electronics",
    price: 1084,
    oldPrice: 1497,
    subtitle: "Earbud Case for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Earbud Case. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Earbud Case.jpg",
    rating: 4.4,
    reviews: 30,
    stock: 10,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0169",
    name: "Headphone Stand",
    category: "Electronics",
    price: 865,
    oldPrice: 1080,
    subtitle: "Headphone Stand for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Headphone Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Headphone Stand.jpg",
    rating: 4.0,
    reviews: 17,
    stock: 8,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0170",
    name: "USB Microphone — Student Edition 01",
    category: "Electronics",
    price: 774,
    oldPrice: 1078,
    subtitle: "USB Microphone — Student Edition 01 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB Microphone — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Microphone.jpg",
    rating: 4.9,
    reviews: 28,
    stock: 2,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0171",
    name: "Wired Earphones — Student Edition 02",
    category: "Electronics",
    price: 729,
    oldPrice: 1014,
    subtitle: "Wired Earphones — Student Edition 02 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Wired Earphones — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wired Earphones.jpg",
    rating: 4.9,
    reviews: 21,
    stock: 5,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0172",
    name: "Card Reader — Student Edition 03",
    category: "Electronics",
    price: 1385,
    oldPrice: 1766,
    subtitle: "Card Reader — Student Edition 03 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Card Reader — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Card Reader.jpg",
    rating: 4.8,
    reviews: 77,
    stock: 2,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0173",
    name: "Laptop Privacy Filter — Student Edition 04",
    category: "Electronics",
    price: 473,
    oldPrice: 600,
    subtitle:
      "Laptop Privacy Filter — Student Edition 04 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Laptop Privacy Filter — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Privacy Filter.jpg",
    rating: 4.1,
    reviews: 60,
    stock: 6,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0174",
    name: "Bluetooth Receiver — Student Edition 05",
    category: "Electronics",
    price: 111,
    oldPrice: 155,
    subtitle:
      "Bluetooth Receiver — Student Edition 05 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Bluetooth Receiver — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Receiver.jpg",
    rating: 4.5,
    reviews: 16,
    stock: 6,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0175",
    name: "USB-C to HDMI Adapter — Student Edition 06",
    category: "Electronics",
    price: 400,
    oldPrice: 520,
    subtitle:
      "USB-C to HDMI Adapter — Student Edition 06 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "USB-C to HDMI Adapter — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C to HDMI Adapter.jpg",
    rating: 4.4,
    reviews: 38,
    stock: 12,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0176",
    name: "Headphone Stand — Student Edition 07",
    category: "Electronics",
    price: 854,
    oldPrice: 1015,
    subtitle: "Headphone Stand — Student Edition 07 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Headphone Stand — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Headphone Stand.jpg",
    rating: 4.1,
    reviews: 17,
    stock: 8,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0177",
    name: "Webcam — Student Edition 08",
    category: "Electronics",
    price: 1492,
    oldPrice: 2150,
    subtitle: "Webcam — Student Edition 08 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Webcam — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Webcam.jpg",
    rating: 4.2,
    reviews: 46,
    stock: 2,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0178",
    name: "Bluetooth Speaker — Student Edition 09",
    category: "Electronics",
    price: 1444,
    oldPrice: 2074,
    subtitle:
      "Bluetooth Speaker — Student Edition 09 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Bluetooth Speaker — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Speaker.jpg",
    rating: 4.8,
    reviews: 47,
    stock: 9,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0179",
    name: "Ethernet Adapter — Student Edition 10",
    category: "Electronics",
    price: 924,
    oldPrice: 1315,
    subtitle:
      "Ethernet Adapter — Student Edition 10 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Ethernet Adapter — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ethernet Adapter.jpg",
    rating: 4.3,
    reviews: 31,
    stock: 6,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0180",
    name: "USB Extension Hub — Student Edition 11",
    category: "Electronics",
    price: 118,
    oldPrice: 144,
    subtitle:
      "USB Extension Hub — Student Edition 11 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "USB Extension Hub — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Extension Hub.jpg",
    rating: 4.3,
    reviews: 64,
    stock: 9,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0181",
    name: "USB Wi-Fi Adapter — Student Edition 12",
    category: "Electronics",
    price: 1267,
    oldPrice: 1694,
    subtitle:
      "USB Wi-Fi Adapter — Student Edition 12 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "USB Wi-Fi Adapter — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Wi-Fi Adapter.jpg",
    rating: 4.7,
    reviews: 12,
    stock: 10,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0182",
    name: "DisplayPort Cable — Student Edition 13",
    category: "Electronics",
    price: 99,
    oldPrice: 129,
    subtitle:
      "DisplayPort Cable — Student Edition 13 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "DisplayPort Cable — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/DisplayPort Cable.jpg",
    rating: 4.4,
    reviews: 70,
    stock: 10,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0183",
    name: "Earbud Case — Student Edition 14",
    category: "Electronics",
    price: 969,
    oldPrice: 1172,
    subtitle: "Earbud Case — Student Edition 14 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Earbud Case — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Earbud Case.jpg",
    rating: 4.1,
    reviews: 50,
    stock: 11,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0184",
    name: "Laptop Stand — Student Edition 15",
    category: "Electronics",
    price: 1061,
    oldPrice: 1331,
    subtitle: "Laptop Stand — Student Edition 15 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Laptop Stand — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Stand.jpg",
    rating: 4.7,
    reviews: 74,
    stock: 9,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0185",
    name: "Power Bank — Student Edition 16",
    category: "Electronics",
    price: 713,
    oldPrice: 1015,
    subtitle: "Power Bank — Student Edition 16 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Power Bank — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Power Bank.jpg",
    rating: 4.3,
    reviews: 80,
    stock: 1,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0186",
    name: "USB Desk Lamp — Student Edition 17",
    category: "Electronics",
    price: 1238,
    oldPrice: 1575,
    subtitle: "USB Desk Lamp — Student Edition 17 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB Desk Lamp — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Desk Lamp.jpg",
    rating: 4.5,
    reviews: 79,
    stock: 6,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0187",
    name: "Smart Plug — Student Edition 18",
    category: "Electronics",
    price: 1037,
    oldPrice: 1322,
    subtitle: "Smart Plug — Student Edition 18 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Smart Plug — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Smart Plug.jpg",
    rating: 4.7,
    reviews: 86,
    stock: 1,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0188",
    name: "Laptop Lock — Student Edition 19",
    category: "Electronics",
    price: 1461,
    oldPrice: 2035,
    subtitle: "Laptop Lock — Student Edition 19 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Laptop Lock — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Lock.jpg",
    rating: 4.5,
    reviews: 72,
    stock: 2,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0189",
    name: "HDMI Cable — Student Edition 20",
    category: "Electronics",
    price: 1032,
    oldPrice: 1352,
    subtitle: "HDMI Cable — Student Edition 20 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "HDMI Cable — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HDMI Cable.jpg",
    rating: 4.6,
    reviews: 9,
    stock: 7,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0190",
    name: "Fast Charger — Student Edition 21",
    category: "Electronics",
    price: 610,
    oldPrice: 732,
    subtitle: "Fast Charger — Student Edition 21 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Fast Charger — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fast Charger.jpg",
    rating: 4.5,
    reviews: 47,
    stock: 2,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0191",
    name: "Laptop Cooling Pad — Student Edition 22",
    category: "Electronics",
    price: 838,
    oldPrice: 1161,
    subtitle:
      "Laptop Cooling Pad — Student Edition 22 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Laptop Cooling Pad — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Cooling Pad.jpg",
    rating: 4.0,
    reviews: 8,
    stock: 7,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0192",
    name: "Laptop Charger — Student Edition 23",
    category: "Electronics",
    price: 291,
    oldPrice: 373,
    subtitle: "Laptop Charger — Student Edition 23 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Laptop Charger — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Charger.jpg",
    rating: 4.3,
    reviews: 11,
    stock: 7,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0193",
    name: "Screen Cleaning Kit — Student Edition 24",
    category: "Electronics",
    price: 944,
    oldPrice: 1257,
    subtitle:
      "Screen Cleaning Kit — Student Edition 24 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Screen Cleaning Kit — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Screen Cleaning Kit.jpg",
    rating: 4.0,
    reviews: 52,
    stock: 1,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0194",
    name: "Rechargeable Torch — Student Edition 25",
    category: "Electronics",
    price: 1039,
    oldPrice: 1455,
    subtitle:
      "Rechargeable Torch — Student Edition 25 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Rechargeable Torch — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Rechargeable Torch.webp",
    rating: 4.1,
    reviews: 14,
    stock: 9,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0195",
    name: "Gaming Mouse Pad — Student Edition 26",
    category: "Electronics",
    price: 871,
    oldPrice: 1168,
    subtitle:
      "Gaming Mouse Pad — Student Edition 26 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Gaming Mouse Pad — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gaming Mouse Pad.jpg",
    rating: 4.7,
    reviews: 53,
    stock: 5,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0196",
    name: "Surge Protector — Student Edition 27",
    category: "Electronics",
    price: 1406,
    oldPrice: 1906,
    subtitle: "Surge Protector — Student Edition 27 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Surge Protector — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Surge Protector.jpg",
    rating: 4.1,
    reviews: 58,
    stock: 9,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0197",
    name: "Phone Charging Dock — Student Edition 28",
    category: "Electronics",
    price: 1314,
    oldPrice: 1742,
    subtitle:
      "Phone Charging Dock — Student Edition 28 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Phone Charging Dock — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Charging Dock.jpg",
    rating: 4.4,
    reviews: 4,
    stock: 7,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0198",
    name: "USB-C Hub — Student Edition 29",
    category: "Electronics",
    price: 195,
    oldPrice: 233,
    subtitle: "USB-C Hub — Student Edition 29 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "USB-C Hub — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Hub.jpg",
    rating: 4.4,
    reviews: 67,
    stock: 10,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0199",
    name: "USB-C Cable — Student Edition 30",
    category: "Electronics",
    price: 251,
    oldPrice: 320,
    subtitle: "USB-C Cable — Student Edition 30 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "USB-C Cable — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Cable.jpg",
    rating: 4.0,
    reviews: 38,
    stock: 7,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0200",
    name: "Laptop Sleeve — Student Edition 31",
    category: "Electronics",
    price: 791,
    oldPrice: 943,
    subtitle: "Laptop Sleeve — Student Edition 31 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Laptop Sleeve — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sleeve.jpg",
    rating: 4.5,
    reviews: 74,
    stock: 3,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0201",
    name: "USB Fan — Student Edition 32",
    category: "Electronics",
    price: 1132,
    oldPrice: 1356,
    subtitle: "USB Fan — Student Edition 32 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "USB Fan — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Fan.jpg",
    rating: 4.3,
    reviews: 52,
    stock: 9,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0202",
    name: "Portable Monitor Stand — Student Edition 33",
    category: "Electronics",
    price: 536,
    oldPrice: 743,
    subtitle:
      "Portable Monitor Stand — Student Edition 33 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Portable Monitor Stand — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Monitor Stand.jpg",
    rating: 4.5,
    reviews: 75,
    stock: 1,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0203",
    name: "Cable Organiser — Student Edition 34",
    category: "Electronics",
    price: 1127,
    oldPrice: 1357,
    subtitle: "Cable Organiser — Student Edition 34 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Cable Organiser — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cable Organiser.jpg",
    rating: 4.3,
    reviews: 53,
    stock: 4,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0204",
    name: "Tablet Stand — Student Edition 35",
    category: "Electronics",
    price: 1228,
    oldPrice: 1581,
    subtitle: "Tablet Stand — Student Edition 35 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Tablet Stand — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tablet Stand.jpg",
    rating: 4.5,
    reviews: 22,
    stock: 5,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0205",
    name: "Bluetooth Headphones — Student Edition 36",
    category: "Electronics",
    price: 1320,
    oldPrice: 1712,
    subtitle:
      "Bluetooth Headphones — Student Edition 36 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Bluetooth Headphones — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bluetooth Headphones.jpg",
    rating: 4.4,
    reviews: 69,
    stock: 5,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0206",
    name: "HDMI Adapter — Student Edition 37",
    category: "Electronics",
    price: 164,
    oldPrice: 194,
    subtitle: "HDMI Adapter — Student Edition 37 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "HDMI Adapter — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HDMI Adapter.jpg",
    rating: 4.1,
    reviews: 8,
    stock: 12,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0207",
    name: "Mechanical Keyboard — Student Edition 38",
    category: "Electronics",
    price: 813,
    oldPrice: 1070,
    subtitle:
      "Mechanical Keyboard — Student Edition 38 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Mechanical Keyboard — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mechanical Keyboard.jpg",
    rating: 4.5,
    reviews: 29,
    stock: 12,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0208",
    name: "Phone Holder — Student Edition 39",
    category: "Electronics",
    price: 1374,
    oldPrice: 1725,
    subtitle: "Phone Holder — Student Edition 39 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Phone Holder — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Holder.jpg",
    rating: 4.0,
    reviews: 39,
    stock: 4,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0209",
    name: "Mini Projector — Student Edition 40",
    category: "Electronics",
    price: 408,
    oldPrice: 543,
    subtitle: "Mini Projector — Student Edition 40 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Mini Projector — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Projector.jpg",
    rating: 4.8,
    reviews: 41,
    stock: 2,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0210",
    name: "USB Desk Clock — Student Edition 41",
    category: "Electronics",
    price: 718,
    oldPrice: 922,
    subtitle: "USB Desk Clock — Student Edition 41 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "USB Desk Clock — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Desk Clock.jpg",
    rating: 4.9,
    reviews: 84,
    stock: 6,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0211",
    name: "Stylus Pen — Student Edition 42",
    category: "Electronics",
    price: 810,
    oldPrice: 1079,
    subtitle: "Stylus Pen — Student Edition 42 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Stylus Pen — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Stylus Pen.png",
    rating: 4.3,
    reviews: 32,
    stock: 2,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0212",
    name: "USB-C Flash Drive — Student Edition 43",
    category: "Electronics",
    price: 442,
    oldPrice: 569,
    subtitle:
      "USB-C Flash Drive — Student Edition 43 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "USB-C Flash Drive — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB-C Flash Drive.jpg",
    rating: 4.6,
    reviews: 34,
    stock: 12,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0213",
    name: "Portable SSD Enclosure — Student Edition 44",
    category: "Electronics",
    price: 1152,
    oldPrice: 1407,
    subtitle:
      "Portable SSD Enclosure — Student Edition 44 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Portable SSD Enclosure — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable SSD Enclosure.jpg",
    rating: 4.7,
    reviews: 16,
    stock: 8,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0214",
    name: "Wireless Keyboard — Student Edition 45",
    category: "Electronics",
    price: 912,
    oldPrice: 1204,
    subtitle:
      "Wireless Keyboard — Student Edition 45 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Wireless Keyboard — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wireless Keyboard.jpg",
    rating: 4.2,
    reviews: 45,
    stock: 7,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0215",
    name: "Phone Tripod — Student Edition 46",
    category: "Electronics",
    price: 1252,
    oldPrice: 1492,
    subtitle: "Phone Tripod — Student Edition 46 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Phone Tripod — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Tripod.jpg",
    rating: 4.7,
    reviews: 11,
    stock: 12,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0216",
    name: "Webcam Cover — Student Edition 47",
    category: "Electronics",
    price: 1381,
    oldPrice: 1950,
    subtitle: "Webcam Cover — Student Edition 47 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Webcam Cover — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Webcam Cover.jpg",
    rating: 4.3,
    reviews: 33,
    stock: 9,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0217",
    name: "Web Development Basics",
    category: "Books",
    price: 45,
    oldPrice: 65,
    subtitle: "Web Development Basics for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Web Development Basics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Web Development Basics.jpg",
    rating: 4.1,
    reviews: 64,
    stock: 12,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0218",
    name: "Python Programming for Beginners",
    category: "Books",
    price: 186,
    oldPrice: 235,
    subtitle: "Python Programming for Beginners for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Python Programming for Beginners. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Python Programming for Beginner.jpg",
    rating: 4.6,
    reviews: 54,
    stock: 1,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0219",
    name: "Java Programming",
    category: "Books",
    price: 245,
    oldPrice: 335,
    subtitle: "Java Programming for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Java Programming. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Java Programming.jpg",
    rating: 4.4,
    reviews: 31,
    stock: 5,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0220",
    name: "C Programming Handbook",
    category: "Books",
    price: 207,
    oldPrice: 286,
    subtitle: "C Programming Handbook for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "C Programming Handbook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/C Programming Handbook.jpg",
    rating: 4.4,
    reviews: 70,
    stock: 11,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0221",
    name: "C++ Fundamentals",
    category: "Books",
    price: 233,
    oldPrice: 290,
    subtitle: "C++ Fundamentals for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "C++ Fundamentals. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/C++ Fundamentals.jpg",
    rating: 4.8,
    reviews: 23,
    stock: 6,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0222",
    name: "Database Management Systems",
    category: "Books",
    price: 213,
    oldPrice: 296,
    subtitle: "Database Management Systems for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Database Management Systems. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Database Management Systems.jpg",
    rating: 4.5,
    reviews: 5,
    stock: 6,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0223",
    name: "Operating Systems Notes",
    category: "Books",
    price: 283,
    oldPrice: 359,
    subtitle: "Operating Systems Notes for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Operating Systems Notes. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Operating Systems Notes.jpg",
    rating: 4.6,
    reviews: 38,
    stock: 11,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0224",
    name: "Computer Networks",
    category: "Books",
    price: 294,
    oldPrice: 352,
    subtitle: "Computer Networks for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Computer Networks. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Computer Networks.jpg",
    rating: 4.8,
    reviews: 83,
    stock: 10,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0225",
    name: "Software Engineering",
    category: "Books",
    price: 58,
    oldPrice: 79,
    subtitle: "Software Engineering for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Software Engineering. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Software Engineering.jpg",
    rating: 4.3,
    reviews: 46,
    stock: 6,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0226",
    name: "Data Structures in C",
    category: "Books",
    price: 296,
    oldPrice: 388,
    subtitle: "Data Structures in C for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Data Structures in C. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Data Structures in C.jpg",
    rating: 4.6,
    reviews: 47,
    stock: 2,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0227",
    name: "Algorithms Made Easy",
    category: "Books",
    price: 270,
    oldPrice: 348,
    subtitle: "Algorithms Made Easy for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Algorithms Made Easy. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Algorithms Made Easy.jpg",
    rating: 4.3,
    reviews: 50,
    stock: 10,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0228",
    name: "Discrete Mathematics",
    category: "Books",
    price: 114,
    oldPrice: 163,
    subtitle: "Discrete Mathematics for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Discrete Mathematics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Discrete Mathematics.jpg",
    rating: 4.3,
    reviews: 82,
    stock: 12,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0229",
    name: "Engineering Mathematics",
    category: "Books",
    price: 50,
    oldPrice: 70,
    subtitle: "Engineering Mathematics for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Engineering Mathematics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Engineering Mathematics.jpg",
    rating: 4.6,
    reviews: 50,
    stock: 6,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0230",
    name: "Statistics for Computing",
    category: "Books",
    price: 297,
    oldPrice: 407,
    subtitle: "Statistics for Computing for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Statistics for Computing. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Statistics for Computing.jpg",
    rating: 4.6,
    reviews: 18,
    stock: 9,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0231",
    name: "Business Communication",
    category: "Books",
    price: 289,
    oldPrice: 408,
    subtitle: "Business Communication for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Business Communication. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Business Communication.jpg",
    rating: 4.7,
    reviews: 81,
    stock: 11,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0232",
    name: "English Grammar Guide",
    category: "Books",
    price: 66,
    oldPrice: 86,
    subtitle: "English Grammar Guide for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "English Grammar Guide. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/English Grammar Guide.jpg",
    rating: 4.1,
    reviews: 71,
    stock: 3,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0233",
    name: "Technical Writing",
    category: "Books",
    price: 102,
    oldPrice: 139,
    subtitle: "Technical Writing for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Technical Writing. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Technical Writing.jpg",
    rating: 4.8,
    reviews: 45,
    stock: 1,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0234",
    name: "Computer Architecture",
    category: "Books",
    price: 58,
    oldPrice: 78,
    subtitle: "Computer Architecture for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Computer Architecture. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Computer Architecture.jpg",
    rating: 4.6,
    reviews: 70,
    stock: 8,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0235",
    name: "Digital Logic Design",
    category: "Books",
    price: 93,
    oldPrice: 118,
    subtitle: "Digital Logic Design for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Digital Logic Design. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Logic Design.jpg",
    rating: 4.3,
    reviews: 55,
    stock: 7,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0236",
    name: "Object Oriented Programming",
    category: "Books",
    price: 113,
    oldPrice: 154,
    subtitle: "Object Oriented Programming for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Object Oriented Programming. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Object Oriented Programming.jpg",
    rating: 4.9,
    reviews: 19,
    stock: 5,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0237",
    name: "HTML and CSS Guide",
    category: "Books",
    price: 139,
    oldPrice: 187,
    subtitle: "HTML and CSS Guide for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "HTML and CSS Guide. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HTML and CSS Guide.jpg",
    rating: 4.9,
    reviews: 10,
    stock: 7,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0238",
    name: "JavaScript Essentials",
    category: "Books",
    price: 280,
    oldPrice: 391,
    subtitle: "JavaScript Essentials for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "JavaScript Essentials. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/JavaScript Essentials.png",
    rating: 4.1,
    reviews: 61,
    stock: 8,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0239",
    name: "PHP and MySQL Basics",
    category: "Books",
    price: 235,
    oldPrice: 285,
    subtitle: "PHP and MySQL Basics for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "PHP and MySQL Basics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/PHP and MySQL Basics.jpg",
    rating: 4.8,
    reviews: 56,
    stock: 10,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0240",
    name: "Cloud Computing Intro",
    category: "Books",
    price: 267,
    oldPrice: 377,
    subtitle: "Cloud Computing Intro for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Cloud Computing Intro. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cloud Computing Intro.jpg",
    rating: 4.4,
    reviews: 37,
    stock: 9,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0241",
    name: "Cyber Security Basics",
    category: "Books",
    price: 286,
    oldPrice: 391,
    subtitle: "Cyber Security Basics for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Cyber Security Basics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cyber Security Basics.jpg",
    rating: 4.8,
    reviews: 52,
    stock: 6,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0242",
    name: "Artificial Intelligence Intro",
    category: "Books",
    price: 99,
    oldPrice: 126,
    subtitle: "Artificial Intelligence Intro for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Artificial Intelligence Intro. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Artificial Intelligence Intro.jpg",
    rating: 4.2,
    reviews: 59,
    stock: 1,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0243",
    name: "Machine Learning Primer",
    category: "Books",
    price: 147,
    oldPrice: 212,
    subtitle: "Machine Learning Primer for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Machine Learning Primer. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Machine Learning Primer.jpg",
    rating: 4.3,
    reviews: 82,
    stock: 8,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0244",
    name: "Data Analytics with Python",
    category: "Books",
    price: 206,
    oldPrice: 296,
    subtitle: "Data Analytics with Python for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Data Analytics with Python. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Data Analytics with Python.jpg",
    rating: 4.4,
    reviews: 71,
    stock: 6,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0245",
    name: "Linux Command Line",
    category: "Books",
    price: 233,
    oldPrice: 283,
    subtitle: "Linux Command Line for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Linux Command Line. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Linux Command Line.jpg",
    rating: 4.7,
    reviews: 50,
    stock: 11,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0246",
    name: "Computer Graphics",
    category: "Books",
    price: 155,
    oldPrice: 222,
    subtitle: "Computer Graphics for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Computer Graphics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Computer Graphics.jpg",
    rating: 4.5,
    reviews: 10,
    stock: 1,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0247",
    name: "Compiler Design",
    category: "Books",
    price: 166,
    oldPrice: 216,
    subtitle: "Compiler Design for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Compiler Design. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compiler Design.jpg",
    rating: 4.3,
    reviews: 65,
    stock: 4,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0248",
    name: "Theory of Computation",
    category: "Books",
    price: 60,
    oldPrice: 84,
    subtitle: "Theory of Computation for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Theory of Computation. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Theory of Computation.jpg",
    rating: 4.0,
    reviews: 43,
    stock: 7,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0249",
    name: "Mobile App Development",
    category: "Books",
    price: 241,
    oldPrice: 302,
    subtitle: "Mobile App Development for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Mobile App Development. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mobile App Development.jpg",
    rating: 4.4,
    reviews: 86,
    stock: 6,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0250",
    name: "UI UX Design Workbook",
    category: "Books",
    price: 112,
    oldPrice: 144,
    subtitle: "UI UX Design Workbook for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "UI UX Design Workbook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/UI UX Design Workbook.jpg",
    rating: 4.3,
    reviews: 8,
    stock: 12,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0251",
    name: "Project Management",
    category: "Books",
    price: 124,
    oldPrice: 161,
    subtitle: "Project Management for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Project Management. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Project Management.jpg",
    rating: 4.6,
    reviews: 29,
    stock: 10,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0252",
    name: "Entrepreneurship Basics",
    category: "Books",
    price: 265,
    oldPrice: 368,
    subtitle: "Entrepreneurship Basics for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Entrepreneurship Basics. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Entrepreneurship Basics.jpg",
    rating: 4.0,
    reviews: 58,
    stock: 7,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0253",
    name: "Accounting Fundamentals",
    category: "Books",
    price: 215,
    oldPrice: 285,
    subtitle: "Accounting Fundamentals for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Accounting Fundamentals. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Accounting Fundamentals.jpg",
    rating: 4.2,
    reviews: 43,
    stock: 2,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0254",
    name: "Economics for Students",
    category: "Books",
    price: 59,
    oldPrice: 79,
    subtitle: "Economics for Students for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Economics for Students. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Economics for Students.jpg",
    rating: 4.4,
    reviews: 57,
    stock: 4,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0255",
    name: "Environmental Science",
    category: "Books",
    price: 109,
    oldPrice: 130,
    subtitle: "Environmental Science for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Environmental Science. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Environmental Science.jpg",
    rating: 4.3,
    reviews: 82,
    stock: 9,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0256",
    name: "Physics Lab Manual",
    category: "Books",
    price: 269,
    oldPrice: 353,
    subtitle: "Physics Lab Manual for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Physics Lab Manual. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Physics Lab Manual.jpg",
    rating: 4.7,
    reviews: 53,
    stock: 1,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0257",
    name: "Chemistry Practical Record",
    category: "Books",
    price: 95,
    oldPrice: 120,
    subtitle: "Chemistry Practical Record for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Chemistry Practical Record. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Chemistry Practical Record.jpg",
    rating: 4.6,
    reviews: 11,
    stock: 3,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0258",
    name: "Biology Lab Guide",
    category: "Books",
    price: 268,
    oldPrice: 364,
    subtitle: "Biology Lab Guide for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Biology Lab Guide. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Biology Lab Guide.jpg",
    rating: 4.7,
    reviews: 28,
    stock: 8,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0259",
    name: "Research Methodology",
    category: "Books",
    price: 266,
    oldPrice: 317,
    subtitle: "Research Methodology for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Research Methodology. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Research Methodology.jpg",
    rating: 4.9,
    reviews: 71,
    stock: 8,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0260",
    name: "Aptitude Practice Book",
    category: "Books",
    price: 94,
    oldPrice: 116,
    subtitle: "Aptitude Practice Book for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Aptitude Practice Book. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Aptitude Practice Book.jpg",
    rating: 4.2,
    reviews: 8,
    stock: 4,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0261",
    name: "Verbal Ability Workbook",
    category: "Books",
    price: 68,
    oldPrice: 88,
    subtitle: "Verbal Ability Workbook for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Verbal Ability Workbook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Verbal Ability Workbook.jpg",
    rating: 4.7,
    reviews: 25,
    stock: 3,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0262",
    name: "Logical Reasoning Guide",
    category: "Books",
    price: 116,
    oldPrice: 147,
    subtitle: "Logical Reasoning Guide for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Logical Reasoning Guide. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Logical Reasoning Guide.jpg",
    rating: 4.0,
    reviews: 64,
    stock: 2,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0263",
    name: "Placement Preparation",
    category: "Books",
    price: 158,
    oldPrice: 218,
    subtitle: "Placement Preparation for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Placement Preparation. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Placement Preparation.jpg",
    rating: 4.8,
    reviews: 64,
    stock: 6,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0264",
    name: "Interview Questions for IT",
    category: "Books",
    price: 227,
    oldPrice: 306,
    subtitle: "Interview Questions for IT for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Interview Questions for IT. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Interview Questions for IT.jpg",
    rating: 4.4,
    reviews: 27,
    stock: 2,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0265",
    name: "Resume Writing Guide",
    category: "Books",
    price: 242,
    oldPrice: 338,
    subtitle: "Resume Writing Guide for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Resume Writing Guide. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Resume Writing Guide.jpg",
    rating: 4.9,
    reviews: 21,
    stock: 5,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0266",
    name: "Public Speaking Handbook",
    category: "Books",
    price: 259,
    oldPrice: 373,
    subtitle: "Public Speaking Handbook for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Public Speaking Handbook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Public Speaking Handbook.jpg",
    rating: 4.2,
    reviews: 18,
    stock: 7,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0267",
    name: "Computer Networks — Student Edition 01",
    category: "Books",
    price: 248,
    oldPrice: 306,
    subtitle:
      "Computer Networks — Student Edition 01 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Computer Networks — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Computer Networks.jpg",
    rating: 4.1,
    reviews: 50,
    stock: 5,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0268",
    name: "Business Communication — Student Edition 02",
    category: "Books",
    price: 181,
    oldPrice: 250,
    subtitle:
      "Business Communication — Student Edition 02 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Business Communication — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Business Communication.jpg",
    rating: 4.7,
    reviews: 14,
    stock: 1,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0269",
    name: "JavaScript Essentials — Student Edition 03",
    category: "Books",
    price: 203,
    oldPrice: 242,
    subtitle:
      "JavaScript Essentials — Student Edition 03 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "JavaScript Essentials — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/JavaScript Essentials.png",
    rating: 4.3,
    reviews: 40,
    stock: 11,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0270",
    name: "Linux Command Line — Student Edition 04",
    category: "Books",
    price: 238,
    oldPrice: 335,
    subtitle:
      "Linux Command Line — Student Edition 04 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Linux Command Line — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Linux Command Line.jpg",
    rating: 4.8,
    reviews: 55,
    stock: 12,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0271",
    name: "Entrepreneurship Basics — Student Edition 05",
    category: "Books",
    price: 116,
    oldPrice: 152,
    subtitle:
      "Entrepreneurship Basics — Student Edition 05 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Entrepreneurship Basics — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Entrepreneurship Basics.jpg",
    rating: 4.8,
    reviews: 42,
    stock: 1,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0272",
    name: "Research Methodology — Student Edition 06",
    category: "Books",
    price: 40,
    oldPrice: 60,
    subtitle:
      "Research Methodology — Student Edition 06 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Research Methodology — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Research Methodology.jpg",
    rating: 4.4,
    reviews: 5,
    stock: 10,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0273",
    name: "Public Speaking Handbook — Student Edition 07",
    category: "Books",
    price: 277,
    oldPrice: 341,
    subtitle:
      "Public Speaking Handbook — Student Edition 07 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Public Speaking Handbook — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Public Speaking Handbook.jpg",
    rating: 4.3,
    reviews: 8,
    stock: 8,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0274",
    name: "Operating Systems Notes — Student Edition 08",
    category: "Books",
    price: 95,
    oldPrice: 116,
    subtitle:
      "Operating Systems Notes — Student Edition 08 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Operating Systems Notes — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Operating Systems Notes.jpg",
    rating: 4.0,
    reviews: 5,
    stock: 9,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0275",
    name: "Statistics for Computing — Student Edition 09",
    category: "Books",
    price: 65,
    oldPrice: 90,
    subtitle:
      "Statistics for Computing — Student Edition 09 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Statistics for Computing — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Statistics for Computing.jpg",
    rating: 4.6,
    reviews: 7,
    stock: 5,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0276",
    name: "HTML and CSS Guide — Student Edition 10",
    category: "Books",
    price: 189,
    oldPrice: 242,
    subtitle:
      "HTML and CSS Guide — Student Edition 10 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "HTML and CSS Guide — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HTML and CSS Guide.jpg",
    rating: 4.7,
    reviews: 77,
    stock: 5,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0277",
    name: "Data Analytics with Python — Student Edition 11",
    category: "Books",
    price: 218,
    oldPrice: 310,
    subtitle:
      "Data Analytics with Python — Student Edition 11 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Data Analytics with Python — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Data Analytics with Python.jpg",
    rating: 4.0,
    reviews: 65,
    stock: 9,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0278",
    name: "Project Management — Student Edition 12",
    category: "Books",
    price: 262,
    oldPrice: 373,
    subtitle:
      "Project Management — Student Edition 12 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Project Management — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Project Management.jpg",
    rating: 4.5,
    reviews: 74,
    stock: 11,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0279",
    name: "Biology Lab Guide — Student Edition 13",
    category: "Books",
    price: 133,
    oldPrice: 172,
    subtitle:
      "Biology Lab Guide — Student Edition 13 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Biology Lab Guide — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Biology Lab Guide.jpg",
    rating: 4.4,
    reviews: 39,
    stock: 3,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0280",
    name: "Resume Writing Guide — Student Edition 14",
    category: "Books",
    price: 290,
    oldPrice: 366,
    subtitle:
      "Resume Writing Guide — Student Edition 14 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Resume Writing Guide — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Resume Writing Guide.jpg",
    rating: 4.5,
    reviews: 37,
    stock: 8,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0281",
    name: "Database Management Systems — Student Edition 15",
    category: "Books",
    price: 108,
    oldPrice: 128,
    subtitle:
      "Database Management Systems — Student Edition 15 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Database Management Systems — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Database Management Systems.jpg",
    rating: 4.8,
    reviews: 72,
    stock: 3,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0282",
    name: "Engineering Mathematics — Student Edition 16",
    category: "Books",
    price: 268,
    oldPrice: 365,
    subtitle:
      "Engineering Mathematics — Student Edition 16 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Engineering Mathematics — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Engineering Mathematics.jpg",
    rating: 4.8,
    reviews: 63,
    stock: 5,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0283",
    name: "Object Oriented Programming — Student Edition 17",
    category: "Books",
    price: 57,
    oldPrice: 78,
    subtitle:
      "Object Oriented Programming — Student Edition 17 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Object Oriented Programming — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Object Oriented Programming.jpg",
    rating: 4.5,
    reviews: 21,
    stock: 2,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0284",
    name: "Machine Learning Primer — Student Edition 18",
    category: "Books",
    price: 124,
    oldPrice: 147,
    subtitle:
      "Machine Learning Primer — Student Edition 18 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Machine Learning Primer — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Machine Learning Primer.jpg",
    rating: 4.6,
    reviews: 64,
    stock: 9,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0285",
    name: "UI UX Design Workbook — Student Edition 19",
    category: "Books",
    price: 252,
    oldPrice: 337,
    subtitle:
      "UI UX Design Workbook — Student Edition 19 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "UI UX Design Workbook — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/UI UX Design Workbook.jpg",
    rating: 4.7,
    reviews: 25,
    stock: 4,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0286",
    name: "Chemistry Practical Record — Student Edition 20",
    category: "Books",
    price: 85,
    oldPrice: 112,
    subtitle:
      "Chemistry Practical Record — Student Edition 20 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Chemistry Practical Record — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Chemistry Practical Record.jpg",
    rating: 4.4,
    reviews: 39,
    stock: 6,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0287",
    name: "Interview Questions for IT — Student Edition 21",
    category: "Books",
    price: 172,
    oldPrice: 229,
    subtitle:
      "Interview Questions for IT — Student Edition 21 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Interview Questions for IT — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Interview Questions for IT.jpg",
    rating: 4.2,
    reviews: 12,
    stock: 10,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0288",
    name: "C++ Fundamentals — Student Edition 22",
    category: "Books",
    price: 257,
    oldPrice: 368,
    subtitle:
      "C++ Fundamentals — Student Edition 22 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "C++ Fundamentals — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/C++ Fundamentals.jpg",
    rating: 4.8,
    reviews: 70,
    stock: 7,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0289",
    name: "Discrete Mathematics — Student Edition 23",
    category: "Books",
    price: 109,
    oldPrice: 154,
    subtitle:
      "Discrete Mathematics — Student Edition 23 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Discrete Mathematics — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Discrete Mathematics.jpg",
    rating: 4.1,
    reviews: 29,
    stock: 9,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0290",
    name: "Digital Logic Design — Student Edition 24",
    category: "Books",
    price: 128,
    oldPrice: 170,
    subtitle:
      "Digital Logic Design — Student Edition 24 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Digital Logic Design — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Logic Design.jpg",
    rating: 4.5,
    reviews: 49,
    stock: 1,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0291",
    name: "Artificial Intelligence Intro — Student Edition 25",
    category: "Books",
    price: 168,
    oldPrice: 228,
    subtitle:
      "Artificial Intelligence Intro — Student Edition 25 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Artificial Intelligence Intro — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Artificial Intelligence Intro.jpg",
    rating: 4.2,
    reviews: 79,
    stock: 3,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0292",
    name: "Mobile App Development — Student Edition 26",
    category: "Books",
    price: 186,
    oldPrice: 258,
    subtitle:
      "Mobile App Development — Student Edition 26 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Mobile App Development — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mobile App Development.jpg",
    rating: 4.3,
    reviews: 54,
    stock: 3,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0293",
    name: "Physics Lab Manual — Student Edition 27",
    category: "Books",
    price: 294,
    oldPrice: 385,
    subtitle:
      "Physics Lab Manual — Student Edition 27 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Physics Lab Manual — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Physics Lab Manual.jpg",
    rating: 4.5,
    reviews: 74,
    stock: 7,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0294",
    name: "Placement Preparation — Student Edition 28",
    category: "Books",
    price: 141,
    oldPrice: 173,
    subtitle:
      "Placement Preparation — Student Edition 28 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Placement Preparation — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Placement Preparation.jpg",
    rating: 4.4,
    reviews: 7,
    stock: 11,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0295",
    name: "C Programming Handbook — Student Edition 29",
    category: "Books",
    price: 264,
    oldPrice: 373,
    subtitle:
      "C Programming Handbook — Student Edition 29 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "C Programming Handbook — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/C Programming Handbook.jpg",
    rating: 4.9,
    reviews: 20,
    stock: 3,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0296",
    name: "Algorithms Made Easy — Student Edition 30",
    category: "Books",
    price: 268,
    oldPrice: 322,
    subtitle:
      "Algorithms Made Easy — Student Edition 30 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Algorithms Made Easy — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Algorithms Made Easy.jpg",
    rating: 4.0,
    reviews: 26,
    stock: 2,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0297",
    name: "Computer Architecture — Student Edition 31",
    category: "Books",
    price: 162,
    oldPrice: 214,
    subtitle:
      "Computer Architecture — Student Edition 31 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Computer Architecture — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Computer Architecture.jpg",
    rating: 4.1,
    reviews: 58,
    stock: 9,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0298",
    name: "Cyber Security Basics — Student Edition 32",
    category: "Books",
    price: 161,
    oldPrice: 199,
    subtitle:
      "Cyber Security Basics — Student Edition 32 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Cyber Security Basics — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cyber Security Basics.jpg",
    rating: 4.2,
    reviews: 84,
    stock: 5,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0299",
    name: "Theory of Computation — Student Edition 33",
    category: "Books",
    price: 201,
    oldPrice: 257,
    subtitle:
      "Theory of Computation — Student Edition 33 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Theory of Computation — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Theory of Computation.jpg",
    rating: 4.4,
    reviews: 26,
    stock: 11,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0300",
    name: "Environmental Science — Student Edition 34",
    category: "Books",
    price: 281,
    oldPrice: 377,
    subtitle:
      "Environmental Science — Student Edition 34 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Environmental Science — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Environmental Science.jpg",
    rating: 4.6,
    reviews: 11,
    stock: 10,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0301",
    name: "Logical Reasoning Guide — Student Edition 35",
    category: "Books",
    price: 161,
    oldPrice: 207,
    subtitle:
      "Logical Reasoning Guide — Student Edition 35 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Logical Reasoning Guide — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Logical Reasoning Guide.jpg",
    rating: 4.2,
    reviews: 73,
    stock: 4,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0302",
    name: "Java Programming — Student Edition 36",
    category: "Books",
    price: 135,
    oldPrice: 194,
    subtitle:
      "Java Programming — Student Edition 36 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Java Programming — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Java Programming.jpg",
    rating: 4.1,
    reviews: 36,
    stock: 7,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0303",
    name: "Data Structures in C — Student Edition 37",
    category: "Books",
    price: 106,
    oldPrice: 126,
    subtitle:
      "Data Structures in C — Student Edition 37 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Data Structures in C — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Data Structures in C.jpg",
    rating: 4.5,
    reviews: 86,
    stock: 1,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0304",
    name: "Technical Writing — Student Edition 38",
    category: "Books",
    price: 227,
    oldPrice: 276,
    subtitle:
      "Technical Writing — Student Edition 38 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Technical Writing — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Technical Writing.jpg",
    rating: 4.7,
    reviews: 75,
    stock: 8,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0305",
    name: "Cloud Computing Intro — Student Edition 39",
    category: "Books",
    price: 200,
    oldPrice: 246,
    subtitle:
      "Cloud Computing Intro — Student Edition 39 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Cloud Computing Intro — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cloud Computing Intro.jpg",
    rating: 4.6,
    reviews: 28,
    stock: 12,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0306",
    name: "Compiler Design — Student Edition 40",
    category: "Books",
    price: 69,
    oldPrice: 89,
    subtitle: "Compiler Design — Student Edition 40 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Compiler Design — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compiler Design.jpg",
    rating: 4.5,
    reviews: 55,
    stock: 3,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0307",
    name: "Economics for Students — Student Edition 41",
    category: "Books",
    price: 198,
    oldPrice: 268,
    subtitle:
      "Economics for Students — Student Edition 41 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Economics for Students — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Economics for Students.jpg",
    rating: 4.2,
    reviews: 6,
    stock: 8,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0308",
    name: "Verbal Ability Workbook — Student Edition 42",
    category: "Books",
    price: 149,
    oldPrice: 183,
    subtitle:
      "Verbal Ability Workbook — Student Edition 42 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Verbal Ability Workbook — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Verbal Ability Workbook.jpg",
    rating: 4.4,
    reviews: 62,
    stock: 5,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0309",
    name: "Python Programming for Beginners — Student Edition 43",
    category: "Books",
    price: 140,
    oldPrice: 168,
    subtitle:
      "Python Programming for Beginners — Student Edition 43 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Python Programming for Beginners — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Python Programming for Beginner.jpg",
    rating: 4.0,
    reviews: 86,
    stock: 12,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0310",
    name: "Software Engineering — Student Edition 44",
    category: "Books",
    price: 175,
    oldPrice: 233,
    subtitle:
      "Software Engineering — Student Edition 44 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Software Engineering — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Software Engineering.jpg",
    rating: 4.4,
    reviews: 25,
    stock: 12,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0311",
    name: "English Grammar Guide — Student Edition 45",
    category: "Books",
    price: 271,
    oldPrice: 380,
    subtitle:
      "English Grammar Guide — Student Edition 45 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "English Grammar Guide — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/English Grammar Guide.jpg",
    rating: 4.6,
    reviews: 60,
    stock: 10,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0312",
    name: "PHP and MySQL Basics — Student Edition 46",
    category: "Books",
    price: 47,
    oldPrice: 67,
    subtitle:
      "PHP and MySQL Basics — Student Edition 46 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "PHP and MySQL Basics — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/PHP and MySQL Basics.jpg",
    rating: 4.2,
    reviews: 38,
    stock: 9,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0313",
    name: "Pastel Highlighter Set",
    category: "Stationery Kits",
    price: 169,
    oldPrice: 225,
    subtitle: "Pastel Highlighter Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Pastel Highlighter Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pastel Highlighter Set.jpg",
    rating: 4.4,
    reviews: 56,
    stock: 2,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0314",
    name: "Gel Pen Pack",
    category: "Stationery Kits",
    price: 170,
    oldPrice: 210,
    subtitle: "Gel Pen Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Gel Pen Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gel Pen Pack.webp",
    rating: 4.2,
    reviews: 17,
    stock: 1,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0315",
    name: "Blue Ballpoint Pens",
    category: "Stationery Kits",
    price: 67,
    oldPrice: 87,
    subtitle: "Blue Ballpoint Pens for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Blue Ballpoint Pens. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Blue Ballpoint Pens.jpg",
    rating: 4.8,
    reviews: 78,
    stock: 11,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0316",
    name: "Black Ballpoint Pens",
    category: "Stationery Kits",
    price: 145,
    oldPrice: 172,
    subtitle: "Black Ballpoint Pens for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Black Ballpoint Pens. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Black Ballpoint Pens.jpg",
    rating: 4.7,
    reviews: 73,
    stock: 8,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0317",
    name: "Mechanical Pencil Set",
    category: "Stationery Kits",
    price: 89,
    oldPrice: 116,
    subtitle: "Mechanical Pencil Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Mechanical Pencil Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mechanical Pencil Set.jpg",
    rating: 4.5,
    reviews: 16,
    stock: 10,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0318",
    name: "HB Pencil Pack",
    category: "Stationery Kits",
    price: 137,
    oldPrice: 188,
    subtitle: "HB Pencil Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "HB Pencil Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HB Pencil Pack.jpg",
    rating: 4.5,
    reviews: 10,
    stock: 12,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0319",
    name: "A4 Notebook Set",
    category: "Stationery Kits",
    price: 182,
    oldPrice: 224,
    subtitle: "A4 Notebook Set for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "A4 Notebook Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/A4 Notebook Set.jpg",
    rating: 4.1,
    reviews: 85,
    stock: 4,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0320",
    name: "Ruled Notebook Pack",
    category: "Stationery Kits",
    price: 57,
    oldPrice: 77,
    subtitle: "Ruled Notebook Pack for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Ruled Notebook Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ruled Notebook Pack.jpg",
    rating: 4.8,
    reviews: 63,
    stock: 9,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0321",
    name: "Graph Notebook Pack",
    category: "Stationery Kits",
    price: 27,
    oldPrice: 47,
    subtitle: "Graph Notebook Pack for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Graph Notebook Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Graph Notebook Pack.jpg",
    rating: 4.6,
    reviews: 82,
    stock: 4,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0322",
    name: "Sticky Notes Set",
    category: "Stationery Kits",
    price: 26,
    oldPrice: 46,
    subtitle: "Sticky Notes Set for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Sticky Notes Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sticky Notes Set.jpg",
    rating: 4.7,
    reviews: 44,
    stock: 3,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0323",
    name: "Index Tabs",
    category: "Stationery Kits",
    price: 85,
    oldPrice: 117,
    subtitle: "Index Tabs for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Index Tabs. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Index Tabs.jpg",
    rating: 4.9,
    reviews: 34,
    stock: 1,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0324",
    name: "Binder Clips Set",
    category: "Stationery Kits",
    price: 170,
    oldPrice: 228,
    subtitle: "Binder Clips Set for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Binder Clips Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Binder Clips Set.jpg",
    rating: 4.8,
    reviews: 74,
    stock: 4,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0325",
    name: "Paper Clips Box",
    category: "Stationery Kits",
    price: 103,
    oldPrice: 137,
    subtitle: "Paper Clips Box for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Paper Clips Box. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paper Clips Box.jpg",
    rating: 4.2,
    reviews: 34,
    stock: 2,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0326",
    name: "Correction Tape",
    category: "Stationery Kits",
    price: 193,
    oldPrice: 233,
    subtitle: "Correction Tape for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Correction Tape. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Correction Tape.jpg",
    rating: 4.5,
    reviews: 21,
    stock: 3,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0327",
    name: "Eraser Pack",
    category: "Stationery Kits",
    price: 112,
    oldPrice: 158,
    subtitle: "Eraser Pack for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Eraser Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Eraser Pack.jpg",
    rating: 4.8,
    reviews: 3,
    stock: 7,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0328",
    name: "Sharpener Set",
    category: "Stationery Kits",
    price: 121,
    oldPrice: 164,
    subtitle: "Sharpener Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Sharpener Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sharpener Set.jpg",
    rating: 4.1,
    reviews: 28,
    stock: 10,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0329",
    name: "Scale and Ruler Set",
    category: "Stationery Kits",
    price: 69,
    oldPrice: 97,
    subtitle: "Scale and Ruler Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Scale and Ruler Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Scale and Ruler Set.jpg",
    rating: 4.0,
    reviews: 17,
    stock: 2,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0330",
    name: "Geometry Box",
    category: "Stationery Kits",
    price: 187,
    oldPrice: 269,
    subtitle: "Geometry Box for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Geometry Box. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Geometry Box.jpg",
    rating: 4.2,
    reviews: 21,
    stock: 4,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0331",
    name: "Compass Set",
    category: "Stationery Kits",
    price: 163,
    oldPrice: 229,
    subtitle: "Compass Set for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Compass Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compass Set.jpg",
    rating: 4.1,
    reviews: 54,
    stock: 7,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0332",
    name: "Protractor Set",
    category: "Stationery Kits",
    price: 136,
    oldPrice: 170,
    subtitle: "Protractor Set for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Protractor Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Protractor Set.jpg",
    rating: 4.1,
    reviews: 77,
    stock: 5,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0333",
    name: "Permanent Marker Set",
    category: "Stationery Kits",
    price: 181,
    oldPrice: 241,
    subtitle: "Permanent Marker Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Permanent Marker Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Permanent Marker Set.jpg",
    rating: 4.4,
    reviews: 18,
    stock: 9,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0334",
    name: "Whiteboard Marker Set",
    category: "Stationery Kits",
    price: 152,
    oldPrice: 217,
    subtitle: "Whiteboard Marker Set for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Whiteboard Marker Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Whiteboard Marker Set.jpg",
    rating: 4.5,
    reviews: 27,
    stock: 6,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0335",
    name: "Fine Liner Pens",
    category: "Stationery Kits",
    price: 156,
    oldPrice: 190,
    subtitle: "Fine Liner Pens for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Fine Liner Pens. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fine Liner Pens.jpg",
    rating: 4.1,
    reviews: 51,
    stock: 6,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0336",
    name: "Brush Pen Set",
    category: "Stationery Kits",
    price: 109,
    oldPrice: 129,
    subtitle: "Brush Pen Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Brush Pen Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Brush Pen Set.jpg",
    rating: 4.2,
    reviews: 39,
    stock: 7,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0337",
    name: "Calligraphy Starter Kit",
    category: "Stationery Kits",
    price: 84,
    oldPrice: 104,
    subtitle: "Calligraphy Starter Kit for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Calligraphy Starter Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calligraphy Starter Kit.jpg",
    rating: 4.3,
    reviews: 74,
    stock: 6,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0338",
    name: "Desk Organiser",
    category: "Stationery Kits",
    price: 49,
    oldPrice: 69,
    subtitle: "Desk Organiser for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Desk Organiser. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desk Organiser.jpg",
    rating: 4.7,
    reviews: 47,
    stock: 10,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0339",
    name: "Pencil Pouch",
    category: "Stationery Kits",
    price: 73,
    oldPrice: 93,
    subtitle: "Pencil Pouch for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Pencil Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pencil Pouch.jpg",
    rating: 4.5,
    reviews: 43,
    stock: 5,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0340",
    name: "Document Folder",
    category: "Stationery Kits",
    price: 123,
    oldPrice: 158,
    subtitle: "Document Folder for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Document Folder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Folder.jpg",
    rating: 4.3,
    reviews: 55,
    stock: 2,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0341",
    name: "Plastic File Set",
    category: "Stationery Kits",
    price: 187,
    oldPrice: 250,
    subtitle: "Plastic File Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Plastic File Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plastic File Set.jpg",
    rating: 4.8,
    reviews: 49,
    stock: 4,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0342",
    name: "Report Cover Pack",
    category: "Stationery Kits",
    price: 80,
    oldPrice: 100,
    subtitle: "Report Cover Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Report Cover Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Report Cover Pack.jpg",
    rating: 4.4,
    reviews: 81,
    stock: 3,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0343",
    name: "A4 Paper Ream",
    category: "Stationery Kits",
    price: 165,
    oldPrice: 203,
    subtitle: "A4 Paper Ream for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "A4 Paper Ream. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/A4 Paper Ream.jpg",
    rating: 4.8,
    reviews: 39,
    stock: 11,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0344",
    name: "Colour Paper Pack",
    category: "Stationery Kits",
    price: 113,
    oldPrice: 145,
    subtitle: "Colour Paper Pack for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Colour Paper Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Colour Paper Pack.jpg",
    rating: 4.8,
    reviews: 15,
    stock: 3,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0345",
    name: "Craft Paper Set",
    category: "Stationery Kits",
    price: 114,
    oldPrice: 158,
    subtitle: "Craft Paper Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Craft Paper Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Craft Paper Set.jpg",
    rating: 4.8,
    reviews: 30,
    stock: 4,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0346",
    name: "Glue Stick Pack",
    category: "Stationery Kits",
    price: 97,
    oldPrice: 129,
    subtitle: "Glue Stick Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Glue Stick Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glue Stick Pack.jpg",
    rating: 4.1,
    reviews: 23,
    stock: 2,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0347",
    name: "Liquid Glue Bottle",
    category: "Stationery Kits",
    price: 142,
    oldPrice: 181,
    subtitle: "Liquid Glue Bottle for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Liquid Glue Bottle. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Liquid Glue Bottle.webp",
    rating: 4.2,
    reviews: 86,
    stock: 4,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0348",
    name: "Scissors",
    category: "Stationery Kits",
    price: 59,
    oldPrice: 84,
    subtitle: "Scissors for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Scissors. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Scissors.jpg",
    rating: 4.1,
    reviews: 26,
    stock: 10,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0349",
    name: "Tape Dispenser",
    category: "Stationery Kits",
    price: 55,
    oldPrice: 75,
    subtitle: "Tape Dispenser for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Tape Dispenser. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tape Dispenser.jpg",
    rating: 4.6,
    reviews: 33,
    stock: 9,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0350",
    name: "Transparent Tape Pack",
    category: "Stationery Kits",
    price: 179,
    oldPrice: 254,
    subtitle: "Transparent Tape Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Transparent Tape Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Transparent Tape Pack.jpg",
    rating: 4.2,
    reviews: 14,
    stock: 3,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0351",
    name: "Double-sided Tape",
    category: "Stationery Kits",
    price: 63,
    oldPrice: 89,
    subtitle: "Double-sided Tape for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Double-sided Tape. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Double-sided Tape.jpg",
    rating: 4.7,
    reviews: 32,
    stock: 1,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0352",
    name: "Stapler Set",
    category: "Stationery Kits",
    price: 137,
    oldPrice: 195,
    subtitle: "Stapler Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Stapler Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Stapler Set.jpg",
    rating: 4.1,
    reviews: 81,
    stock: 11,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0353",
    name: "Staple Pins Box",
    category: "Stationery Kits",
    price: 146,
    oldPrice: 176,
    subtitle: "Staple Pins Box for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Staple Pins Box. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Staple Pins Box.jpg",
    rating: 4.8,
    reviews: 70,
    stock: 2,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0354",
    name: "Hole Punch",
    category: "Stationery Kits",
    price: 99,
    oldPrice: 123,
    subtitle: "Hole Punch for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Hole Punch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Hole Punch.jpg",
    rating: 4.8,
    reviews: 24,
    stock: 1,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0355",
    name: "Paper Cutter",
    category: "Stationery Kits",
    price: 101,
    oldPrice: 124,
    subtitle: "Paper Cutter for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Paper Cutter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paper Cutter.jpg",
    rating: 4.7,
    reviews: 3,
    stock: 8,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0356",
    name: "Drawing Pencils",
    category: "Stationery Kits",
    price: 70,
    oldPrice: 95,
    subtitle: "Drawing Pencils for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Drawing Pencils. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Drawing Pencils.jpg",
    rating: 4.7,
    reviews: 39,
    stock: 6,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0357",
    name: "Colour Pencil Set",
    category: "Stationery Kits",
    price: 174,
    oldPrice: 214,
    subtitle: "Colour Pencil Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Colour Pencil Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Colour Pencil Set.jpg",
    rating: 4.7,
    reviews: 11,
    stock: 2,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0358",
    name: "Sketch Pen Pack",
    category: "Stationery Kits",
    price: 152,
    oldPrice: 211,
    subtitle: "Sketch Pen Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Sketch Pen Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sketch Pen Pack.jpg",
    rating: 4.6,
    reviews: 7,
    stock: 5,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0359",
    name: "Watercolour Set",
    category: "Stationery Kits",
    price: 160,
    oldPrice: 193,
    subtitle: "Watercolour Set for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Watercolour Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Watercolour Set.jpg",
    rating: 4.1,
    reviews: 64,
    stock: 2,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0360",
    name: "Paint Brush Set",
    category: "Stationery Kits",
    price: 113,
    oldPrice: 161,
    subtitle: "Paint Brush Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Paint Brush Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paint Brush Set.jpg",
    rating: 4.0,
    reviews: 49,
    stock: 1,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0361",
    name: "Canvas Notebook",
    category: "Stationery Kits",
    price: 106,
    oldPrice: 151,
    subtitle: "Canvas Notebook for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Canvas Notebook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Notebook.jpg",
    rating: 4.8,
    reviews: 18,
    stock: 6,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0362",
    name: "Flash Cards",
    category: "Stationery Kits",
    price: 38,
    oldPrice: 58,
    subtitle: "Flash Cards for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Flash Cards. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Flash Cards.jpg",
    rating: 4.7,
    reviews: 42,
    stock: 4,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0363",
    name: "Ruled Notebook Pack — Student Edition 01",
    category: "Stationery Kits",
    price: 36,
    oldPrice: 56,
    subtitle:
      "Ruled Notebook Pack — Student Edition 01 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Ruled Notebook Pack — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ruled Notebook Pack.jpg",
    rating: 4.1,
    reviews: 18,
    stock: 11,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0364",
    name: "Eraser Pack — Student Edition 02",
    category: "Stationery Kits",
    price: 140,
    oldPrice: 195,
    subtitle: "Eraser Pack — Student Edition 02 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Eraser Pack — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Eraser Pack.jpg",
    rating: 4.3,
    reviews: 7,
    stock: 4,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0365",
    name: "Whiteboard Marker Set — Student Edition 03",
    category: "Stationery Kits",
    price: 172,
    oldPrice: 234,
    subtitle:
      "Whiteboard Marker Set — Student Edition 03 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Whiteboard Marker Set — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Whiteboard Marker Set.jpg",
    rating: 4.1,
    reviews: 45,
    stock: 1,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0366",
    name: "Plastic File Set — Student Edition 04",
    category: "Stationery Kits",
    price: 28,
    oldPrice: 48,
    subtitle:
      "Plastic File Set — Student Edition 04 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Plastic File Set — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plastic File Set.jpg",
    rating: 4.0,
    reviews: 32,
    stock: 1,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0367",
    name: "Scissors — Student Edition 05",
    category: "Stationery Kits",
    price: 166,
    oldPrice: 197,
    subtitle: "Scissors — Student Edition 05 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Scissors — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Scissors.jpg",
    rating: 4.3,
    reviews: 54,
    stock: 3,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0368",
    name: "Paper Cutter — Student Edition 06",
    category: "Stationery Kits",
    price: 165,
    oldPrice: 234,
    subtitle: "Paper Cutter — Student Edition 06 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Paper Cutter — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paper Cutter.jpg",
    rating: 4.2,
    reviews: 33,
    stock: 8,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0369",
    name: "Flash Cards — Student Edition 07",
    category: "Stationery Kits",
    price: 182,
    oldPrice: 253,
    subtitle: "Flash Cards — Student Edition 07 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Flash Cards — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Flash Cards.jpg",
    rating: 4.6,
    reviews: 5,
    stock: 1,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0370",
    name: "A4 Notebook Set — Student Edition 08",
    category: "Stationery Kits",
    price: 49,
    oldPrice: 69,
    subtitle: "A4 Notebook Set — Student Edition 08 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "A4 Notebook Set — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/A4 Notebook Set.jpg",
    rating: 4.2,
    reviews: 6,
    stock: 9,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0371",
    name: "Correction Tape — Student Edition 09",
    category: "Stationery Kits",
    price: 95,
    oldPrice: 120,
    subtitle: "Correction Tape — Student Edition 09 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Correction Tape — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Correction Tape.jpg",
    rating: 4.0,
    reviews: 19,
    stock: 11,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0372",
    name: "Permanent Marker Set — Student Edition 10",
    category: "Stationery Kits",
    price: 168,
    oldPrice: 204,
    subtitle:
      "Permanent Marker Set — Student Edition 10 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Permanent Marker Set — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Permanent Marker Set.jpg",
    rating: 4.0,
    reviews: 64,
    stock: 2,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0373",
    name: "Document Folder — Student Edition 11",
    category: "Stationery Kits",
    price: 138,
    oldPrice: 164,
    subtitle: "Document Folder — Student Edition 11 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Document Folder — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Folder.jpg",
    rating: 4.8,
    reviews: 10,
    stock: 10,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0374",
    name: "Liquid Glue Bottle — Student Edition 12",
    category: "Stationery Kits",
    price: 23,
    oldPrice: 43,
    subtitle:
      "Liquid Glue Bottle — Student Edition 12 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Liquid Glue Bottle — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Liquid Glue Bottle.jpg",
    rating: 4.4,
    reviews: 69,
    stock: 8,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0375",
    name: "Hole Punch — Student Edition 13",
    category: "Stationery Kits",
    price: 80,
    oldPrice: 100,
    subtitle: "Hole Punch — Student Edition 13 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Hole Punch — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Hole Punch.jpg",
    rating: 4.1,
    reviews: 85,
    stock: 6,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0376",
    name: "Canvas Notebook — Student Edition 14",
    category: "Stationery Kits",
    price: 188,
    oldPrice: 256,
    subtitle: "Canvas Notebook — Student Edition 14 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Canvas Notebook — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Notebook.jpg",
    rating: 4.5,
    reviews: 11,
    stock: 11,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0377",
    name: "HB Pencil Pack — Student Edition 15",
    category: "Stationery Kits",
    price: 48,
    oldPrice: 68,
    subtitle: "HB Pencil Pack — Student Edition 15 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "HB Pencil Pack — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/HB Pencil Pack.jpg",
    rating: 4.6,
    reviews: 82,
    stock: 10,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0378",
    name: "Paper Clips Box — Student Edition 16",
    category: "Stationery Kits",
    price: 47,
    oldPrice: 67,
    subtitle: "Paper Clips Box — Student Edition 16 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Paper Clips Box — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paper Clips Box.jpg",
    rating: 4.8,
    reviews: 59,
    stock: 8,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0379",
    name: "Protractor Set — Student Edition 17",
    category: "Stationery Kits",
    price: 107,
    oldPrice: 127,
    subtitle: "Protractor Set — Student Edition 17 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Protractor Set — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Protractor Set.jpg",
    rating: 4.6,
    reviews: 50,
    stock: 10,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0380",
    name: "Pencil Pouch — Student Edition 18",
    category: "Stationery Kits",
    price: 129,
    oldPrice: 184,
    subtitle: "Pencil Pouch — Student Edition 18 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Pencil Pouch — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pencil Pouch.jpg",
    rating: 4.4,
    reviews: 84,
    stock: 6,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0381",
    name: "Glue Stick Pack — Student Edition 19",
    category: "Stationery Kits",
    price: 25,
    oldPrice: 45,
    subtitle: "Glue Stick Pack — Student Edition 19 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Glue Stick Pack — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glue Stick Pack.jpg",
    rating: 4.7,
    reviews: 75,
    stock: 4,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0382",
    name: "Staple Pins Box — Student Edition 20",
    category: "Stationery Kits",
    price: 189,
    oldPrice: 226,
    subtitle: "Staple Pins Box — Student Edition 20 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Staple Pins Box — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Staple Pins Box.jpg",
    rating: 4.6,
    reviews: 66,
    stock: 6,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0383",
    name: "Paint Brush Set — Student Edition 21",
    category: "Stationery Kits",
    price: 174,
    oldPrice: 230,
    subtitle: "Paint Brush Set — Student Edition 21 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Paint Brush Set — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Paint Brush Set.jpg",
    rating: 4.5,
    reviews: 81,
    stock: 1,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0384",
    name: "Mechanical Pencil Set — Student Edition 22",
    category: "Stationery Kits",
    price: 96,
    oldPrice: 130,
    subtitle:
      "Mechanical Pencil Set — Student Edition 22 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Mechanical Pencil Set — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mechanical Pencil Set.jpg",
    rating: 4.4,
    reviews: 50,
    stock: 2,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0385",
    name: "Binder Clips Set — Student Edition 23",
    category: "Stationery Kits",
    price: 67,
    oldPrice: 96,
    subtitle:
      "Binder Clips Set — Student Edition 23 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Binder Clips Set — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Binder Clips Set.jpg",
    rating: 4.6,
    reviews: 33,
    stock: 7,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0386",
    name: "Compass Set — Student Edition 24",
    category: "Stationery Kits",
    price: 110,
    oldPrice: 148,
    subtitle: "Compass Set — Student Edition 24 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Compass Set — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compass Set.jpg",
    rating: 4.3,
    reviews: 50,
    stock: 1,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0387",
    name: "Desk Organiser — Student Edition 25",
    category: "Stationery Kits",
    price: 88,
    oldPrice: 114,
    subtitle: "Desk Organiser — Student Edition 25 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Desk Organiser — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desk Organiser.jpg",
    rating: 4.9,
    reviews: 9,
    stock: 5,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0388",
    name: "Craft Paper Set — Student Edition 26",
    category: "Stationery Kits",
    price: 180,
    oldPrice: 251,
    subtitle: "Craft Paper Set — Student Edition 26 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Craft Paper Set — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Craft Paper Set.jpg",
    rating: 4.3,
    reviews: 18,
    stock: 8,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0389",
    name: "Stapler Set — Student Edition 27",
    category: "Stationery Kits",
    price: 33,
    oldPrice: 53,
    subtitle: "Stapler Set — Student Edition 27 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Stapler Set — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Stapler Set.jpg",
    rating: 4.0,
    reviews: 54,
    stock: 8,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0390",
    name: "Watercolour Set — Student Edition 28",
    category: "Stationery Kits",
    price: 167,
    oldPrice: 223,
    subtitle: "Watercolour Set — Student Edition 28 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Watercolour Set — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Watercolour Set.jpg",
    rating: 4.1,
    reviews: 7,
    stock: 4,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0391",
    name: "Black Ballpoint Pens — Student Edition 29",
    category: "Stationery Kits",
    price: 194,
    oldPrice: 255,
    subtitle:
      "Black Ballpoint Pens — Student Edition 29 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Black Ballpoint Pens — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Black Ballpoint Pens.jpg",
    rating: 4.8,
    reviews: 42,
    stock: 2,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0392",
    name: "Index Tabs — Student Edition 30",
    category: "Stationery Kits",
    price: 169,
    oldPrice: 227,
    subtitle: "Index Tabs — Student Edition 30 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Index Tabs — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Index Tabs.jpg",
    rating: 4.0,
    reviews: 66,
    stock: 1,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0393",
    name: "Geometry Box — Student Edition 31",
    category: "Stationery Kits",
    price: 157,
    oldPrice: 201,
    subtitle: "Geometry Box — Student Edition 31 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Geometry Box — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Geometry Box.jpg",
    rating: 4.3,
    reviews: 65,
    stock: 7,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0394",
    name: "Calligraphy Starter Kit — Student Edition 32",
    category: "Stationery Kits",
    price: 24,
    oldPrice: 44,
    subtitle:
      "Calligraphy Starter Kit — Student Edition 32 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Calligraphy Starter Kit — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calligraphy Starter Kit.jpg",
    rating: 4.4,
    reviews: 34,
    stock: 11,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0395",
    name: "Colour Paper Pack — Student Edition 33",
    category: "Stationery Kits",
    price: 87,
    oldPrice: 111,
    subtitle:
      "Colour Paper Pack — Student Edition 33 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Colour Paper Pack — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Colour Paper Pack.jpg",
    rating: 4.7,
    reviews: 14,
    stock: 12,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0396",
    name: "Double-sided Tape — Student Edition 34",
    category: "Stationery Kits",
    price: 31,
    oldPrice: 51,
    subtitle:
      "Double-sided Tape — Student Edition 34 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Double-sided Tape — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Double-sided Tape.jpg",
    rating: 4.2,
    reviews: 8,
    stock: 9,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0397",
    name: "Sketch Pen Pack — Student Edition 35",
    category: "Stationery Kits",
    price: 180,
    oldPrice: 218,
    subtitle: "Sketch Pen Pack — Student Edition 35 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Sketch Pen Pack — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sketch Pen Pack.jpg",
    rating: 4.1,
    reviews: 56,
    stock: 3,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0398",
    name: "Blue Ballpoint Pens — Student Edition 36",
    category: "Stationery Kits",
    price: 85,
    oldPrice: 122,
    subtitle:
      "Blue Ballpoint Pens — Student Edition 36 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Blue Ballpoint Pens — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Blue Ballpoint Pens.jpg",
    rating: 4.0,
    reviews: 16,
    stock: 4,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0399",
    name: "Sticky Notes Set — Student Edition 37",
    category: "Stationery Kits",
    price: 120,
    oldPrice: 143,
    subtitle:
      "Sticky Notes Set — Student Edition 37 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Sticky Notes Set — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sticky Notes Set.jpg",
    rating: 4.4,
    reviews: 59,
    stock: 5,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0400",
    name: "Scale and Ruler Set — Student Edition 38",
    category: "Stationery Kits",
    price: 24,
    oldPrice: 44,
    subtitle:
      "Scale and Ruler Set — Student Edition 38 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Scale and Ruler Set — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Scale and Ruler Set.jpg",
    rating: 4.6,
    reviews: 69,
    stock: 11,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0401",
    name: "Brush Pen Set — Student Edition 39",
    category: "Stationery Kits",
    price: 52,
    oldPrice: 72,
    subtitle: "Brush Pen Set — Student Edition 39 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Brush Pen Set — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Brush Pen Set.jpg",
    rating: 4.7,
    reviews: 21,
    stock: 7,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0402",
    name: "A4 Paper Ream — Student Edition 40",
    category: "Stationery Kits",
    price: 156,
    oldPrice: 219,
    subtitle: "A4 Paper Ream — Student Edition 40 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "A4 Paper Ream — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/A4 Paper Ream.jpg",
    rating: 4.7,
    reviews: 30,
    stock: 6,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0403",
    name: "Transparent Tape Pack — Student Edition 41",
    category: "Stationery Kits",
    price: 168,
    oldPrice: 210,
    subtitle:
      "Transparent Tape Pack — Student Edition 41 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Transparent Tape Pack — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Transparent Tape Pack.jpg",
    rating: 4.1,
    reviews: 39,
    stock: 5,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0404",
    name: "Colour Pencil Set — Student Edition 42",
    category: "Stationery Kits",
    price: 152,
    oldPrice: 183,
    subtitle:
      "Colour Pencil Set — Student Edition 42 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Colour Pencil Set — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Colour Pencil Set.jpg",
    rating: 4.2,
    reviews: 84,
    stock: 10,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0405",
    name: "Gel Pen Pack — Student Edition 43",
    category: "Stationery Kits",
    price: 56,
    oldPrice: 76,
    subtitle: "Gel Pen Pack — Student Edition 43 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Gel Pen Pack — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gel Pen Pack.webp",
    rating: 4.3,
    reviews: 57,
    stock: 6,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0406",
    name: "Graph Notebook Pack — Student Edition 44",
    category: "Stationery Kits",
    price: 131,
    oldPrice: 169,
    subtitle:
      "Graph Notebook Pack — Student Edition 44 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Graph Notebook Pack — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Graph Notebook Pack.jpg",
    rating: 4.7,
    reviews: 46,
    stock: 10,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0407",
    name: "Sharpener Set — Student Edition 45",
    category: "Stationery Kits",
    price: 34,
    oldPrice: 54,
    subtitle: "Sharpener Set — Student Edition 45 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Sharpener Set — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sharpener Set.jpg",
    rating: 4.4,
    reviews: 35,
    stock: 1,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0408",
    name: "Fine Liner Pens — Student Edition 46",
    category: "Stationery Kits",
    price: 68,
    oldPrice: 95,
    subtitle: "Fine Liner Pens — Student Edition 46 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Fine Liner Pens — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fine Liner Pens.jpg",
    rating: 4.7,
    reviews: 79,
    stock: 11,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0409",
    name: "Report Cover Pack — Student Edition 47",
    category: "Stationery Kits",
    price: 65,
    oldPrice: 91,
    subtitle:
      "Report Cover Pack — Student Edition 47 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Report Cover Pack — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Report Cover Pack.jpg",
    rating: 4.2,
    reviews: 44,
    stock: 7,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0410",
    name: "Basic Desktop Calculator",
    category: "Calculators",
    price: 424,
    oldPrice: 517,
    subtitle: "Basic Desktop Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Basic Desktop Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desktop Calculator.jpg",
    rating: 4.8,
    reviews: 82,
    stock: 6,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0411",
    name: "Solar Pocket Calculator",
    category: "Calculators",
    price: 452,
    oldPrice: 560,
    subtitle: "Solar Pocket Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Solar Pocket Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solar Pocket Calculator.jpg",
    rating: 4.3,
    reviews: 6,
    stock: 9,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0412",
    name: "Financial Calculator",
    category: "Calculators",
    price: 792,
    oldPrice: 996,
    subtitle: "Financial Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Financial Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Financial Calculator.jpg",
    rating: 4.6,
    reviews: 86,
    stock: 7,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0413",
    name: "Graphing Calculator",
    category: "Calculators",
    price: 331,
    oldPrice: 464,
    subtitle: "Graphing Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Graphing Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.0,
    reviews: 52,
    stock: 3,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0414",
    name: "Student Calculator",
    category: "Calculators",
    price: 371,
    oldPrice: 480,
    subtitle: "Student Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Student Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Calculator.jpg",
    rating: 4.6,
    reviews: 44,
    stock: 3,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0415",
    name: "Two-line Scientific Calculator",
    category: "Calculators",
    price: 772,
    oldPrice: 1073,
    subtitle: "Two-line Scientific Calculator for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Two-line Scientific Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/scientific calculator.jpg",
    rating: 4.3,
    reviews: 74,
    stock: 5,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0416",
    name: "12-digit Desk Calculator",
    category: "Calculators",
    price: 761,
    oldPrice: 950,
    subtitle: "12-digit Desk Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "12-digit Desk Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/12-digit Desk Calculator.jpg",
    rating: 4.3,
    reviews: 56,
    stock: 10,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0417",
    name: "Compact Pocket Calculator",
    category: "Calculators",
    price: 797,
    oldPrice: 1141,
    subtitle: "Compact Pocket Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Compact Pocket Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Pocket Calculator.jpg",
    rating: 4.5,
    reviews: 23,
    stock: 5,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0418",
    name: "Exam Calculator",
    category: "Calculators",
    price: 849,
    oldPrice: 1076,
    subtitle: "Exam Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Exam Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Exam Calculator.jpg",
    rating: 4.4,
    reviews: 23,
    stock: 5,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0419",
    name: "Engineering Calculator",
    category: "Calculators",
    price: 177,
    oldPrice: 239,
    subtitle: "Engineering Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Engineering Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Engineering Calculator.jpg",
    rating: 4.1,
    reviews: 35,
    stock: 10,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0420",
    name: "Statistics Calculator",
    category: "Calculators",
    price: 695,
    oldPrice: 825,
    subtitle: "Statistics Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Statistics Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.1,
    reviews: 79,
    stock: 4,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0421",
    name: "Business Calculator",
    category: "Calculators",
    price: 475,
    oldPrice: 644,
    subtitle: "Business Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Business Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.2,
    reviews: 37,
    stock: 6,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0422",
    name: "Printing Calculator",
    category: "Calculators",
    price: 131,
    oldPrice: 168,
    subtitle: "Printing Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Printing Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Printing Calculator.jpg",
    rating: 4.5,
    reviews: 40,
    stock: 4,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0423",
    name: "Dual Power Calculator",
    category: "Calculators",
    price: 344,
    oldPrice: 436,
    subtitle: "Dual Power Calculator for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Dual Power Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dual Power Calculator.jpg",
    rating: 4.2,
    reviews: 77,
    stock: 7,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0424",
    name: "Large Display Calculator",
    category: "Calculators",
    price: 869,
    oldPrice: 1157,
    subtitle: "Large Display Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Large Display Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Large Display Calculator.jpg",
    rating: 4.9,
    reviews: 28,
    stock: 9,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0425",
    name: "Foldable Calculator",
    category: "Calculators",
    price: 753,
    oldPrice: 974,
    subtitle: "Foldable Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Foldable Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Calculator.jpg",
    rating: 4.5,
    reviews: 49,
    stock: 4,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0426",
    name: "Travel Calculator",
    category: "Calculators",
    price: 591,
    oldPrice: 723,
    subtitle: "Travel Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Travel Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Calculator.jpg",
    rating: 4.2,
    reviews: 27,
    stock: 7,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0427",
    name: "Classroom Calculator",
    category: "Calculators",
    price: 250,
    oldPrice: 306,
    subtitle: "Classroom Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Classroom Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classroom Calculator.jpg",
    rating: 4.3,
    reviews: 51,
    stock: 2,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0428",
    name: "Rechargeable Calculator",
    category: "Calculators",
    price: 617,
    oldPrice: 771,
    subtitle: "Rechargeable Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Rechargeable Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Rechargeable Calculator.jpg",
    rating: 4.9,
    reviews: 70,
    stock: 3,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0429",
    name: "Calculator Hard Case",
    category: "Calculators",
    price: 381,
    oldPrice: 511,
    subtitle: "Calculator Hard Case for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Calculator Hard Case. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Hard Case.jpg",
    rating: 4.3,
    reviews: 29,
    stock: 6,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0430",
    name: "Calculator Pouch",
    category: "Calculators",
    price: 842,
    oldPrice: 1055,
    subtitle: "Calculator Pouch for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Calculator Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Pouch.jpg",
    rating: 4.5,
    reviews: 54,
    stock: 3,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0431",
    name: "Calculator Protective Cover",
    category: "Calculators",
    price: 137,
    oldPrice: 197,
    subtitle: "Calculator Protective Cover for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Calculator Protective Cover. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Protective Cover.jpg",
    rating: 4.2,
    reviews: 18,
    stock: 5,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0432",
    name: "Calculator Screen Guard",
    category: "Calculators",
    price: 812,
    oldPrice: 1086,
    subtitle: "Calculator Screen Guard for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Calculator Screen Guard. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Screen Guard.jpg",
    rating: 4.4,
    reviews: 25,
    stock: 9,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0433",
    name: "Calculator Battery Pack",
    category: "Calculators",
    price: 205,
    oldPrice: 253,
    subtitle: "Calculator Battery Pack for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Calculator Battery Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Battery Pack.jpg",
    rating: 4.1,
    reviews: 49,
    stock: 8,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0434",
    name: "Calculator Stand",
    category: "Calculators",
    price: 782,
    oldPrice: 999,
    subtitle: "Calculator Stand for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Calculator Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Stand.jpg",
    rating: 4.2,
    reviews: 19,
    stock: 7,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0435",
    name: "Mini Keypad Calculator",
    category: "Calculators",
    price: 769,
    oldPrice: 1112,
    subtitle: "Mini Keypad Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Mini Keypad Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Calculator.jpg",
    rating: 4.3,
    reviews: 42,
    stock: 5,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0436",
    name: "Office Calculator",
    category: "Calculators",
    price: 656,
    oldPrice: 842,
    subtitle: "Office Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Office Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Office Calculator.jpg",
    rating: 4.7,
    reviews: 73,
    stock: 4,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0437",
    name: "Accounting Calculator",
    category: "Calculators",
    price: 284,
    oldPrice: 376,
    subtitle: "Accounting Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Accounting Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Accounting Calculator.jpg",
    rating: 4.3,
    reviews: 64,
    stock: 2,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0438",
    name: "Tax Calculator",
    category: "Calculators",
    price: 402,
    oldPrice: 497,
    subtitle: "Tax Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Tax Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tax Calculator.jpg",
    rating: 4.5,
    reviews: 55,
    stock: 1,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0439",
    name: "Percentage Calculator",
    category: "Calculators",
    price: 132,
    oldPrice: 170,
    subtitle: "Percentage Calculator for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Percentage Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Percentage Calculator.jpg",
    rating: 4.7,
    reviews: 38,
    stock: 6,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0440",
    name: "Fraction Calculator",
    category: "Calculators",
    price: 531,
    oldPrice: 644,
    subtitle: "Fraction Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Fraction Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fraction Calculator.jpg",
    rating: 4.4,
    reviews: 27,
    stock: 4,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0441",
    name: "Programmable Calculator",
    category: "Calculators",
    price: 839,
    oldPrice: 1030,
    subtitle: "Programmable Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Programmable Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Programmable Calculator.jpg",
    rating: 4.3,
    reviews: 15,
    stock: 5,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0442",
    name: "Matrix Calculator",
    category: "Calculators",
    price: 138,
    oldPrice: 176,
    subtitle: "Matrix Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Matrix Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Matrix Calculator.jpg",
    rating: 4.2,
    reviews: 8,
    stock: 12,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0443",
    name: "Complex Number Calculator",
    category: "Calculators",
    price: 796,
    oldPrice: 1102,
    subtitle: "Complex Number Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Complex Number Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Complex Number Calculator.jpg",
    rating: 4.1,
    reviews: 46,
    stock: 12,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0444",
    name: "Trigonometry Calculator",
    category: "Calculators",
    price: 146,
    oldPrice: 184,
    subtitle: "Trigonometry Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Trigonometry Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Trigonometry Calculator.jpg",
    rating: 4.0,
    reviews: 33,
    stock: 3,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0445",
    name: "Scientific Calculator with Cover",
    category: "Calculators",
    price: 778,
    oldPrice: 1034,
    subtitle: "Scientific Calculator with Cover for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Scientific Calculator with Cover. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/scientific calculator.jpg",
    rating: 4.3,
    reviews: 41,
    stock: 2,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0446",
    name: "Desktop Calculator with Check",
    category: "Calculators",
    price: 251,
    oldPrice: 350,
    subtitle: "Desktop Calculator with Check for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Desktop Calculator with Check. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desktop Calculator with Check.jpg",
    rating: 4.2,
    reviews: 6,
    stock: 11,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0447",
    name: "Student Solar Calculator",
    category: "Calculators",
    price: 535,
    oldPrice: 691,
    subtitle: "Student Solar Calculator for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Student Solar Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Solar Calculator.jpg",
    rating: 4.3,
    reviews: 60,
    stock: 5,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0448",
    name: "Compact Scientific Calculator",
    category: "Calculators",
    price: 635,
    oldPrice: 797,
    subtitle: "Compact Scientific Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Compact Scientific Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Scientific Calculator.jpg",
    rating: 4.8,
    reviews: 26,
    stock: 12,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0449",
    name: "Ergonomic Desk Calculator",
    category: "Calculators",
    price: 151,
    oldPrice: 186,
    subtitle: "Ergonomic Desk Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Ergonomic Desk Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ergonomic Desk Calculator.jpg",
    rating: 4.7,
    reviews: 12,
    stock: 10,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0450",
    name: "Wide Display Calculator",
    category: "Calculators",
    price: 309,
    oldPrice: 373,
    subtitle: "Wide Display Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Wide Display Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wide Display Calculator.jpg",
    rating: 4.7,
    reviews: 86,
    stock: 4,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0451",
    name: "12-digit Pocket Calculator",
    category: "Calculators",
    price: 762,
    oldPrice: 907,
    subtitle: "12-digit Pocket Calculator for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "12-digit Pocket Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/12-digit Pocket Calculator.jpg",
    rating: 4.1,
    reviews: 41,
    stock: 5,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0452",
    name: "10-digit Desktop Calculator",
    category: "Calculators",
    price: 314,
    oldPrice: 399,
    subtitle: "10-digit Desktop Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "10-digit Desktop Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/10-digit Desktop Calculator.jpg",
    rating: 4.9,
    reviews: 43,
    stock: 4,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0453",
    name: "Portable Exam Calculator",
    category: "Calculators",
    price: 581,
    oldPrice: 723,
    subtitle: "Portable Exam Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Portable Exam Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Exam Calculator.jpg",
    rating: 4.3,
    reviews: 78,
    stock: 1,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0454",
    name: "Lab Calculation Tool",
    category: "Calculators",
    price: 186,
    oldPrice: 235,
    subtitle: "Lab Calculation Tool for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Lab Calculation Tool. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Calculation Tool.jpg",
    rating: 4.6,
    reviews: 29,
    stock: 5,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0455",
    name: "Statistics Student Calculator",
    category: "Calculators",
    price: 318,
    oldPrice: 453,
    subtitle: "Statistics Student Calculator for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Statistics Student Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Statistics Student Calculator.jpg",
    rating: 4.5,
    reviews: 37,
    stock: 4,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0456",
    name: "Business Student Calculator",
    category: "Calculators",
    price: 705,
    oldPrice: 974,
    subtitle: "Business Student Calculator for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Business Student Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Business Student Calculator.jpg",
    rating: 4.2,
    reviews: 27,
    stock: 5,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0457",
    name: "Dual-line Pocket Calculator",
    category: "Calculators",
    price: 236,
    oldPrice: 326,
    subtitle: "Dual-line Pocket Calculator for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Dual-line Pocket Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dual-line Pocket Calculator.jpg",
    rating: 4.2,
    reviews: 9,
    stock: 1,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0458",
    name: "Basic Solar Calculator",
    category: "Calculators",
    price: 833,
    oldPrice: 999,
    subtitle: "Basic Solar Calculator for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Basic Solar Calculator. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Solar Calculator.jpg",
    rating: 4.2,
    reviews: 35,
    stock: 11,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0459",
    name: "12-digit Desk Calculator — Student Edition 01",
    category: "Calculators",
    price: 149,
    oldPrice: 214,
    subtitle:
      "12-digit Desk Calculator — Student Edition 01 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "12-digit Desk Calculator — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/12-digit Desk Calculator.jpg",
    rating: 4.8,
    reviews: 29,
    stock: 3,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0460",
    name: "Dual Power Calculator — Student Edition 02",
    category: "Calculators",
    price: 315,
    oldPrice: 397,
    subtitle:
      "Dual Power Calculator — Student Edition 02 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Dual Power Calculator — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dual Power Calculator.jpg",
    rating: 4.2,
    reviews: 36,
    stock: 6,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0461",
    name: "Calculator Pouch — Student Edition 03",
    category: "Calculators",
    price: 403,
    oldPrice: 554,
    subtitle:
      "Calculator Pouch — Student Edition 03 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Calculator Pouch — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.9,
    reviews: 8,
    stock: 2,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0462",
    name: "Accounting Calculator — Student Edition 04",
    category: "Calculators",
    price: 605,
    oldPrice: 811,
    subtitle:
      "Accounting Calculator — Student Edition 04 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Accounting Calculator — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Accounting Calculator.jpg",
    rating: 4.2,
    reviews: 11,
    stock: 2,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0463",
    name: "Trigonometry Calculator — Student Edition 05",
    category: "Calculators",
    price: 798,
    oldPrice: 986,
    subtitle:
      "Trigonometry Calculator — Student Edition 05 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Trigonometry Calculator — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Trigonometry Calculator.jpg",
    rating: 4.0,
    reviews: 22,
    stock: 8,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0464",
    name: "12-digit Pocket Calculator — Student Edition 06",
    category: "Calculators",
    price: 607,
    oldPrice: 761,
    subtitle:
      "12-digit Pocket Calculator — Student Edition 06 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "12-digit Pocket Calculator — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/12-digit Pocket Calculator.jpg",
    rating: 4.9,
    reviews: 46,
    stock: 10,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0465",
    name: "Basic Solar Calculator — Student Edition 07",
    category: "Calculators",
    price: 136,
    oldPrice: 168,
    subtitle:
      "Basic Solar Calculator — Student Edition 07 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Basic Solar Calculator — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Solar Calculator.jpg",
    rating: 4.8,
    reviews: 11,
    stock: 6,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0466",
    name: "Two-line Scientific Calculator — Student Edition 08",
    category: "Calculators",
    price: 303,
    oldPrice: 431,
    subtitle:
      "Two-line Scientific Calculator — Student Edition 08 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Two-line Scientific Calculator — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Two-line Scientific Calculator #U2014.jpg",
    rating: 4.3,
    reviews: 11,
    stock: 7,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0467",
    name: "Printing Calculator — Student Edition 09",
    category: "Calculators",
    price: 744,
    oldPrice: 929,
    subtitle:
      "Printing Calculator — Student Edition 09 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Printing Calculator — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Printing Calculator.webp",
    rating: 4.1,
    reviews: 66,
    stock: 7,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0468",
    name: "Calculator Hard Case — Student Edition 10",
    category: "Calculators",
    price: 776,
    oldPrice: 1124,
    subtitle:
      "Calculator Hard Case — Student Edition 10 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Calculator Hard Case — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Hard Case.jpg",
    rating: 4.9,
    reviews: 81,
    stock: 11,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0469",
    name: "Office Calculator — Student Edition 11",
    category: "Calculators",
    price: 284,
    oldPrice: 355,
    subtitle:
      "Office Calculator — Student Edition 11 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Office Calculator — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Office Calculator.jpg",
    rating: 4.4,
    reviews: 44,
    stock: 9,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0470",
    name: "Complex Number Calculator — Student Edition 12",
    category: "Calculators",
    price: 616,
    oldPrice: 734,
    subtitle:
      "Complex Number Calculator — Student Edition 12 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Complex Number Calculator — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Complex Number Calculator.jpg",
    rating: 4.6,
    reviews: 56,
    stock: 9,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0471",
    name: "Wide Display Calculator — Student Edition 13",
    category: "Calculators",
    price: 279,
    oldPrice: 403,
    subtitle:
      "Wide Display Calculator — Student Edition 13 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Wide Display Calculator — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wide Display Calculator.jpg",
    rating: 4.9,
    reviews: 53,
    stock: 10,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0472",
    name: "Dual-line Pocket Calculator — Student Edition 14",
    category: "Calculators",
    price: 671,
    oldPrice: 952,
    subtitle:
      "Dual-line Pocket Calculator — Student Edition 14 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Dual-line Pocket Calculator — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dual-line Pocket Calculator.jpg",
    rating: 4.8,
    reviews: 63,
    stock: 3,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0473",
    name: "Student Calculator — Student Edition 15",
    category: "Calculators",
    price: 832,
    oldPrice: 1057,
    subtitle:
      "Student Calculator — Student Edition 15 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Student Calculator — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Calculator.jpg",
    rating: 4.4,
    reviews: 69,
    stock: 3,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0474",
    name: "Business Calculator — Student Edition 16",
    category: "Calculators",
    price: 448,
    oldPrice: 537,
    subtitle:
      "Business Calculator — Student Edition 16 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Business Calculator — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.6,
    reviews: 70,
    stock: 10,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0475",
    name: "Rechargeable Calculator — Student Edition 17",
    category: "Calculators",
    price: 276,
    oldPrice: 398,
    subtitle:
      "Rechargeable Calculator — Student Edition 17 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Rechargeable Calculator — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.5,
    reviews: 76,
    stock: 2,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0476",
    name: "Mini Keypad Calculator — Student Edition 18",
    category: "Calculators",
    price: 704,
    oldPrice: 925,
    subtitle:
      "Mini Keypad Calculator — Student Edition 18 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Mini Keypad Calculator — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Calculator.jpg",
    rating: 4.5,
    reviews: 20,
    stock: 3,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0477",
    name: "Matrix Calculator — Student Edition 19",
    category: "Calculators",
    price: 420,
    oldPrice: 566,
    subtitle:
      "Matrix Calculator — Student Edition 19 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Matrix Calculator — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Calculator.jpg",
    rating: 4.5,
    reviews: 25,
    stock: 12,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0478",
    name: "Ergonomic Desk Calculator — Student Edition 20",
    category: "Calculators",
    price: 638,
    oldPrice: 919,
    subtitle:
      "Ergonomic Desk Calculator — Student Edition 20 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Ergonomic Desk Calculator — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Ergonomic Desk Calculator.jpg",
    rating: 4.1,
    reviews: 80,
    stock: 8,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0479",
    name: "Business Student Calculator — Student Edition 21",
    category: "Calculators",
    price: 890,
    oldPrice: 1271,
    subtitle:
      "Business Student Calculator — Student Edition 21 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Business Student Calculator — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Business Student Calculator.jpg",
    rating: 4.2,
    reviews: 17,
    stock: 10,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0480",
    name: "Graphing Calculator — Student Edition 22",
    category: "Calculators",
    price: 467,
    oldPrice: 601,
    subtitle:
      "Graphing Calculator — Student Edition 22 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Graphing Calculator — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Graphing Calculator #U2014 Student Edition 22.jpg",
    rating: 4.7,
    reviews: 25,
    stock: 5,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0481",
    name: "Statistics Calculator — Student Edition 23",
    category: "Calculators",
    price: 859,
    oldPrice: 1171,
    subtitle:
      "Statistics Calculator — Student Edition 23 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Statistics Calculator — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Statistics Calculator.jpg",
    rating: 4.1,
    reviews: 63,
    stock: 11,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0482",
    name: "Classroom Calculator — Student Edition 24",
    category: "Calculators",
    price: 664,
    oldPrice: 877,
    subtitle:
      "Classroom Calculator — Student Edition 24 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Classroom Calculator — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classroom Calculator.jpg",
    rating: 4.8,
    reviews: 66,
    stock: 11,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0483",
    name: "Calculator Stand — Student Edition 25",
    category: "Calculators",
    price: 499,
    oldPrice: 660,
    subtitle:
      "Calculator Stand — Student Edition 25 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Calculator Stand — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Stand.jpg",
    rating: 4.8,
    reviews: 81,
    stock: 12,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0484",
    name: "Programmable Calculator — Student Edition 26",
    category: "Calculators",
    price: 561,
    oldPrice: 749,
    subtitle:
      "Programmable Calculator — Student Edition 26 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Programmable Calculator — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Programmable Calculator.jpg",
    rating: 4.4,
    reviews: 35,
    stock: 5,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0485",
    name: "Compact Scientific Calculator — Student Edition 27",
    category: "Calculators",
    price: 831,
    oldPrice: 1012,
    subtitle:
      "Compact Scientific Calculator — Student Edition 27 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Compact Scientific Calculator — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Scientific Calculator.jpg",
    rating: 4.7,
    reviews: 83,
    stock: 8,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0486",
    name: "Statistics Student Calculator — Student Edition 28",
    category: "Calculators",
    price: 648,
    oldPrice: 795,
    subtitle:
      "Statistics Student Calculator — Student Edition 28 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Statistics Student Calculator — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Statistics Student Calculator.jpg",
    rating: 4.8,
    reviews: 23,
    stock: 2,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0487",
    name: "Financial Calculator — Student Edition 29",
    category: "Calculators",
    price: 172,
    oldPrice: 241,
    subtitle:
      "Financial Calculator — Student Edition 29 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Financial Calculator — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Financial Calculator.jpg",
    rating: 4.6,
    reviews: 60,
    stock: 8,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0488",
    name: "Engineering Calculator — Student Edition 30",
    category: "Calculators",
    price: 889,
    oldPrice: 1076,
    subtitle:
      "Engineering Calculator — Student Edition 30 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Engineering Calculator — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Engineering Calculator.jpg",
    rating: 4.6,
    reviews: 36,
    stock: 11,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0489",
    name: "Travel Calculator — Student Edition 31",
    category: "Calculators",
    price: 851,
    oldPrice: 1220,
    subtitle:
      "Travel Calculator — Student Edition 31 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Travel Calculator — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Calculator.jpg",
    rating: 4.7,
    reviews: 64,
    stock: 9,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0490",
    name: "Calculator Battery Pack — Student Edition 32",
    category: "Calculators",
    price: 229,
    oldPrice: 326,
    subtitle:
      "Calculator Battery Pack — Student Edition 32 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Calculator Battery Pack — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Battery Pack.jpg",
    rating: 4.2,
    reviews: 17,
    stock: 3,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0491",
    name: "Fraction Calculator — Student Edition 33",
    category: "Calculators",
    price: 296,
    oldPrice: 389,
    subtitle:
      "Fraction Calculator — Student Edition 33 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Fraction Calculator — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Fraction Calculator.jpg",
    rating: 4.4,
    reviews: 62,
    stock: 8,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0492",
    name: "Student Solar Calculator — Student Edition 34",
    category: "Calculators",
    price: 471,
    oldPrice: 658,
    subtitle:
      "Student Solar Calculator — Student Edition 34 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Student Solar Calculator — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Solar Calculator.jpg",
    rating: 4.1,
    reviews: 84,
    stock: 3,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0493",
    name: "Lab Calculation Tool — Student Edition 35",
    category: "Calculators",
    price: 106,
    oldPrice: 151,
    subtitle:
      "Lab Calculation Tool — Student Edition 35 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Lab Calculation Tool — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Calculation Tool.jpg",
    rating: 4.7,
    reviews: 67,
    stock: 8,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0494",
    name: "Solar Pocket Calculator — Student Edition 36",
    category: "Calculators",
    price: 186,
    oldPrice: 251,
    subtitle:
      "Solar Pocket Calculator — Student Edition 36 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Solar Pocket Calculator — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solar Pocket Calculator.jpg",
    rating: 4.6,
    reviews: 24,
    stock: 8,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0495",
    name: "Exam Calculator — Student Edition 37",
    category: "Calculators",
    price: 499,
    oldPrice: 681,
    subtitle: "Exam Calculator — Student Edition 37 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Exam Calculator — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Exam Calculator.jpg",
    rating: 4.5,
    reviews: 62,
    stock: 9,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0496",
    name: "Foldable Calculator — Student Edition 38",
    category: "Calculators",
    price: 428,
    oldPrice: 589,
    subtitle:
      "Foldable Calculator — Student Edition 38 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Foldable Calculator — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Calculator.jpg",
    rating: 4.2,
    reviews: 22,
    stock: 12,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0497",
    name: "Calculator Screen Guard — Student Edition 39",
    category: "Calculators",
    price: 782,
    oldPrice: 978,
    subtitle:
      "Calculator Screen Guard — Student Edition 39 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Calculator Screen Guard — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Screen Guard.jpg",
    rating: 4.4,
    reviews: 65,
    stock: 11,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0498",
    name: "Percentage Calculator — Student Edition 40",
    category: "Calculators",
    price: 236,
    oldPrice: 309,
    subtitle:
      "Percentage Calculator — Student Edition 40 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Percentage Calculator — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Percentage Calculator.jpg",
    rating: 4.1,
    reviews: 64,
    stock: 2,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0499",
    name: "Desktop Calculator with Check — Student Edition 41",
    category: "Calculators",
    price: 326,
    oldPrice: 395,
    subtitle:
      "Desktop Calculator with Check — Student Edition 41 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Desktop Calculator with Check — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desktop Calculator with Check.jpg",
    rating: 4.7,
    reviews: 72,
    stock: 1,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0500",
    name: "Portable Exam Calculator — Student Edition 42",
    category: "Calculators",
    price: 306,
    oldPrice: 427,
    subtitle:
      "Portable Exam Calculator — Student Edition 42 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Portable Exam Calculator — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Exam Calculator.jpg",
    rating: 4.4,
    reviews: 56,
    stock: 1,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0501",
    name: "Basic Desktop Calculator — Student Edition 43",
    category: "Calculators",
    price: 106,
    oldPrice: 143,
    subtitle:
      "Basic Desktop Calculator — Student Edition 43 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Basic Desktop Calculator — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Desktop Calculator #U2014 Student Edition 43.jpg",
    rating: 4.5,
    reviews: 73,
    stock: 6,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0502",
    name: "Compact Pocket Calculator — Student Edition 44",
    category: "Calculators",
    price: 825,
    oldPrice: 1086,
    subtitle:
      "Compact Pocket Calculator — Student Edition 44 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Compact Pocket Calculator — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Pocket Calculator.jpg",
    rating: 4.6,
    reviews: 16,
    stock: 3,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0503",
    name: "Large Display Calculator — Student Edition 45",
    category: "Calculators",
    price: 633,
    oldPrice: 776,
    subtitle:
      "Large Display Calculator — Student Edition 45 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Large Display Calculator — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Large Display Calculator.jpg",
    rating: 4.6,
    reviews: 5,
    stock: 12,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0504",
    name: "Calculator Protective Cover — Student Edition 46",
    category: "Calculators",
    price: 257,
    oldPrice: 335,
    subtitle:
      "Calculator Protective Cover — Student Edition 46 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Calculator Protective Cover — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Calculator Protective Cover.jpg",
    rating: 4.1,
    reviews: 5,
    stock: 7,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0505",
    name: "Tax Calculator — Student Edition 47",
    category: "Calculators",
    price: 537,
    oldPrice: 655,
    subtitle: "Tax Calculator — Student Edition 47 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Tax Calculator — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tax Calculator.jpg",
    rating: 4.0,
    reviews: 48,
    stock: 6,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0506",
    name: "Scientific Calculator with Cover — Student Edition 48",
    category: "Calculators",
    price: 773,
    oldPrice: 1070,
    subtitle:
      "Scientific Calculator with Cover — Student Edition 48 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Scientific Calculator with Cover — Student Edition 48. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Scientific Calculator with Cover.jpg",
    rating: 4.0,
    reviews: 24,
    stock: 10,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0507",
    name: "10-digit Desktop Calculator — Student Edition 49",
    category: "Calculators",
    price: 555,
    oldPrice: 727,
    subtitle:
      "10-digit Desktop Calculator — Student Edition 49 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "10-digit Desktop Calculator — Student Edition 49. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/10-digit Desktop Calculator.jpg",
    rating: 4.3,
    reviews: 33,
    stock: 1,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0508",
    name: "Scientific Calculator — Student Edition 50",
    category: "Calculators",
    price: 733,
    oldPrice: 972,
    subtitle:
      "Scientific Calculator — Student Edition 50 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Scientific Calculator — Student Edition 50. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/scientific calculator.jpg",
    rating: 4.1,
    reviews: 58,
    stock: 2,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0509",
    name: "White Lab Coat",
    category: "Lab Equipment",
    price: 372,
    oldPrice: 510,
    subtitle: "White Lab Coat for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "White Lab Coat. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/White Lab Coat.jpg",
    rating: 4.7,
    reviews: 50,
    stock: 2,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0510",
    name: "Nitrile Gloves Pack",
    category: "Lab Equipment",
    price: 175,
    oldPrice: 239,
    subtitle: "Nitrile Gloves Pack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Nitrile Gloves Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Nitrile Gloves Pack.jpg",
    rating: 4.7,
    reviews: 80,
    stock: 11,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0511",
    name: "Lab Notebook",
    category: "Lab Equipment",
    price: 342,
    oldPrice: 414,
    subtitle: "Lab Notebook for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Lab Notebook. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Notebook.jpg",
    rating: 4.8,
    reviews: 4,
    stock: 4,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0512",
    name: "Glass Beaker Set",
    category: "Lab Equipment",
    price: 262,
    oldPrice: 311,
    subtitle: "Glass Beaker Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Glass Beaker Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass beaker Set.jpg",
    rating: 4.5,
    reviews: 15,
    stock: 9,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0513",
    name: "Measuring Cylinder",
    category: "Lab Equipment",
    price: 249,
    oldPrice: 295,
    subtitle: "Measuring Cylinder for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Measuring Cylinder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Measuring Cylinder.jpg",
    rating: 4.9,
    reviews: 12,
    stock: 3,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0514",
    name: "Conical Flask",
    category: "Lab Equipment",
    price: 348,
    oldPrice: 444,
    subtitle: "Conical Flask for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Conical Flask. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Conical Flask.jpg",
    rating: 4.1,
    reviews: 39,
    stock: 7,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0515",
    name: "Test Tube Rack",
    category: "Lab Equipment",
    price: 735,
    oldPrice: 900,
    subtitle: "Test Tube Rack for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Test Tube Rack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Test Tube Rack.jpg",
    rating: 4.1,
    reviews: 31,
    stock: 1,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0516",
    name: "Test Tube Set",
    category: "Lab Equipment",
    price: 454,
    oldPrice: 636,
    subtitle: "Test Tube Set for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Test Tube Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Test Tube Set.jpg",
    rating: 4.9,
    reviews: 72,
    stock: 11,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0517",
    name: "Glass Dropper Set",
    category: "Lab Equipment",
    price: 361,
    oldPrice: 505,
    subtitle: "Glass Dropper Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Glass Dropper Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass Dropper Set.jpg",
    rating: 4.2,
    reviews: 22,
    stock: 6,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0518",
    name: "Pipette Bulb",
    category: "Lab Equipment",
    price: 615,
    oldPrice: 882,
    subtitle: "Pipette Bulb for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Pipette Bulb. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pipette Bulb.jpg",
    rating: 4.7,
    reviews: 58,
    stock: 12,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0519",
    name: "Plastic Pipette Set",
    category: "Lab Equipment",
    price: 221,
    oldPrice: 297,
    subtitle: "Plastic Pipette Set for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Plastic Pipette Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plastic Pipette Set.jpg",
    rating: 4.9,
    reviews: 10,
    stock: 4,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0520",
    name: "Vernier Caliper",
    category: "Lab Equipment",
    price: 535,
    oldPrice: 773,
    subtitle: "Vernier Caliper for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Vernier Caliper. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Vernier Caliper.jpg",
    rating: 4.9,
    reviews: 86,
    stock: 7,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0521",
    name: "Micrometer Screw Gauge",
    category: "Lab Equipment",
    price: 160,
    oldPrice: 193,
    subtitle: "Micrometer Screw Gauge for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Micrometer Screw Gauge. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Micrometer Screw Gauge.jpg",
    rating: 4.7,
    reviews: 45,
    stock: 7,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0522",
    name: "Digital Stopwatch",
    category: "Lab Equipment",
    price: 55,
    oldPrice: 75,
    subtitle: "Digital Stopwatch for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Digital Stopwatch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Stopwatch.jpg",
    rating: 4.6,
    reviews: 19,
    stock: 3,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0523",
    name: "Lab Thermometer",
    category: "Lab Equipment",
    price: 500,
    oldPrice: 722,
    subtitle: "Lab Thermometer for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Lab Thermometer. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Thermometer.jpg",
    rating: 4.8,
    reviews: 29,
    stock: 12,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0524",
    name: "Digital Thermometer",
    category: "Lab Equipment",
    price: 244,
    oldPrice: 303,
    subtitle: "Digital Thermometer for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Digital Thermometer. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Thermometer.jpg",
    rating: 4.8,
    reviews: 51,
    stock: 12,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0525",
    name: "Pocket Weighing Scale",
    category: "Lab Equipment",
    price: 571,
    oldPrice: 801,
    subtitle: "Pocket Weighing Scale for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Pocket Weighing Scale. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket Weighing Scale.jpg",
    rating: 4.2,
    reviews: 57,
    stock: 5,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0526",
    name: "Laboratory Balance",
    category: "Lab Equipment",
    price: 317,
    oldPrice: 459,
    subtitle: "Laboratory Balance for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Laboratory Balance. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laboratory Balance.webp",
    rating: 4.3,
    reviews: 21,
    stock: 5,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0527",
    name: "Wash Bottle",
    category: "Lab Equipment",
    price: 258,
    oldPrice: 373,
    subtitle: "Wash Bottle for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Wash Bottle. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wash Bottle.jpg",
    rating: 4.4,
    reviews: 27,
    stock: 10,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0528",
    name: "Funnel Set",
    category: "Lab Equipment",
    price: 725,
    oldPrice: 1009,
    subtitle: "Funnel Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Funnel Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Funnel Set.jpg",
    rating: 4.1,
    reviews: 59,
    stock: 6,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0529",
    name: "Filter Paper Pack",
    category: "Lab Equipment",
    price: 66,
    oldPrice: 89,
    subtitle: "Filter Paper Pack for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Filter Paper Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Filter Paper Pack.jpg",
    rating: 4.7,
    reviews: 37,
    stock: 8,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0530",
    name: "Petri Dish Set",
    category: "Lab Equipment",
    price: 716,
    oldPrice: 1015,
    subtitle: "Petri Dish Set for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Petri Dish Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Petri Dish Set.jpg",
    rating: 4.7,
    reviews: 40,
    stock: 11,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0531",
    name: "Glass Stirring Rods",
    category: "Lab Equipment",
    price: 636,
    oldPrice: 905,
    subtitle: "Glass Stirring Rods for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Glass Stirring Rods. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass Stirring Rod.png",
    rating: 4.2,
    reviews: 81,
    stock: 11,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0532",
    name: "Spatula Set",
    category: "Lab Equipment",
    price: 206,
    oldPrice: 255,
    subtitle: "Spatula Set for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Spatula Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Spatula Set.jpg",
    rating: 4.3,
    reviews: 48,
    stock: 4,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0533",
    name: "Forceps Set",
    category: "Lab Equipment",
    price: 799,
    oldPrice: 1024,
    subtitle: "Forceps Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Forceps Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Forceps Set.jpg",
    rating: 4.6,
    reviews: 64,
    stock: 1,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0534",
    name: "Clamp Stand",
    category: "Lab Equipment",
    price: 669,
    oldPrice: 866,
    subtitle: "Clamp Stand for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Clamp Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Clamp Stand.jpg",
    rating: 4.3,
    reviews: 85,
    stock: 1,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0535",
    name: "Retort Stand",
    category: "Lab Equipment",
    price: 367,
    oldPrice: 447,
    subtitle: "Retort Stand for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Retort Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Retort Stand.jpg",
    rating: 4.4,
    reviews: 38,
    stock: 1,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0536",
    name: "Burette Clamp",
    category: "Lab Equipment",
    price: 61,
    oldPrice: 84,
    subtitle: "Burette Clamp for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Burette Clamp. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Burette Clamp.jpg",
    rating: 4.8,
    reviews: 30,
    stock: 11,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0537",
    name: "Lab Apron",
    category: "Lab Equipment",
    price: 199,
    oldPrice: 274,
    subtitle: "Lab Apron for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Lab Apron. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Apron.jpg",
    rating: 4.6,
    reviews: 4,
    stock: 8,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0538",
    name: "Face Shield.jpg",
    category: "Lab Equipment",
    price: 253,
    oldPrice: 317,
    subtitle: "Face Shield.jpg for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Face Shield.jpg. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Face Shield.jpg",
    rating: 4.2,
    reviews: 8,
    stock: 9,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0539",
    name: "Safety Face Mask Pack",
    category: "Lab Equipment",
    price: 324,
    oldPrice: 408,
    subtitle: "Safety Face Mask Pack for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Safety Face Mask Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Safety Face Mask Pack.jpg",
    rating: 4.0,
    reviews: 7,
    stock: 1,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0540",
    name: "Dissection Kit",
    category: "Lab Equipment",
    price: 141,
    oldPrice: 190,
    subtitle: "Dissection Kit for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Dissection Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dissection Kit.jpg",
    rating: 4.0,
    reviews: 85,
    stock: 8,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0541",
    name: "Prepared Microscope Slides",
    category: "Lab Equipment",
    price: 241,
    oldPrice: 308,
    subtitle: "Prepared Microscope Slides for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Prepared Microscope Slides. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Prepared Microscope Slides.jpg",
    rating: 4.9,
    reviews: 63,
    stock: 9,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0542",
    name: "Slide Cover Glass",
    category: "Lab Equipment",
    price: 576,
    oldPrice: 754,
    subtitle: "Slide Cover Glass for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Slide Cover Glass. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Slide Cover Glass.jpg",
    rating: 4.8,
    reviews: 68,
    stock: 4,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0543",
    name: "Microscope Cleaning Kit",
    category: "Lab Equipment",
    price: 433,
    oldPrice: 610,
    subtitle: "Microscope Cleaning Kit for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Microscope Cleaning Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Microscope Cleaning Kit.jpg",
    rating: 4.8,
    reviews: 5,
    stock: 12,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0544",
    name: "Magnifying Glass",
    category: "Lab Equipment",
    price: 192,
    oldPrice: 261,
    subtitle: "Magnifying Glass for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Magnifying Glass. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Magnifying Glass.jpg",
    rating: 4.5,
    reviews: 63,
    stock: 1,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0545",
    name: "Hand Lens",
    category: "Lab Equipment",
    price: 216,
    oldPrice: 267,
    subtitle: "Hand Lens for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Hand Lens. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Hand Lens.jpg",
    rating: 4.0,
    reviews: 68,
    stock: 7,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0546",
    name: "pH Paper Strips",
    category: "Lab Equipment",
    price: 76,
    oldPrice: 96,
    subtitle: "pH Paper Strips for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "pH Paper Strips. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/pH Paper Strips.jpg",
    rating: 4.4,
    reviews: 27,
    stock: 1,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0547",
    name: "pH Meter",
    category: "Lab Equipment",
    price: 492,
    oldPrice: 587,
    subtitle: "pH Meter for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "pH Meter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/pH Meter.jpg",
    rating: 4.5,
    reviews: 63,
    stock: 11,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0548",
    name: "Conductivity Meter",
    category: "Lab Equipment",
    price: 772,
    oldPrice: 1110,
    subtitle: "Conductivity Meter for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Conductivity Meter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Conductivity Meter.jpg",
    rating: 4.2,
    reviews: 6,
    stock: 10,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0549",
    name: "Circuit Breadboard",
    category: "Lab Equipment",
    price: 631,
    oldPrice: 902,
    subtitle: "Circuit Breadboard for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Circuit Breadboard. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Circuit Breadboard.jpg",
    rating: 4.6,
    reviews: 52,
    stock: 12,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0550",
    name: "Jumper Wire Kit",
    category: "Lab Equipment",
    price: 559,
    oldPrice: 786,
    subtitle: "Jumper Wire Kit for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Jumper Wire Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Jumper Wire Kit.jpg",
    rating: 4.0,
    reviews: 4,
    stock: 9,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0551",
    name: "Multimeter",
    category: "Lab Equipment",
    price: 735,
    oldPrice: 969,
    subtitle: "Multimeter for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Multimeter. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multimeter.jpg",
    rating: 4.9,
    reviews: 84,
    stock: 5,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0552",
    name: "Solderless Breadboard",
    category: "Lab Equipment",
    price: 237,
    oldPrice: 281,
    subtitle: "Solderless Breadboard for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Solderless Breadboard. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solderless Breadboard.webp",
    rating: 4.0,
    reviews: 78,
    stock: 11,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0553",
    name: "Alligator Clip Leads",
    category: "Lab Equipment",
    price: 570,
    oldPrice: 745,
    subtitle: "Alligator Clip Leads for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Alligator Clip Leads. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Alligator Clip Leads.jpg",
    rating: 4.7,
    reviews: 50,
    stock: 8,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0554",
    name: "Resistor Kit",
    category: "Lab Equipment",
    price: 165,
    oldPrice: 218,
    subtitle: "Resistor Kit for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Resistor Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Resistor Kit.jpg",
    rating: 4.5,
    reviews: 69,
    stock: 3,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0555",
    name: "LED Component Kit",
    category: "Lab Equipment",
    price: 124,
    oldPrice: 153,
    subtitle: "LED Component Kit for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "LED Component Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/LED Component Kit.jpg",
    rating: 4.7,
    reviews: 40,
    stock: 2,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0556",
    name: "Physics Lab Record",
    category: "Lab Equipment",
    price: 244,
    oldPrice: 333,
    subtitle: "Physics Lab Record for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Physics Lab Record. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Physics Lab Record.jpg",
    rating: 4.5,
    reviews: 84,
    stock: 10,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0557",
    name: "Test Tube Rack — Student Edition 01",
    category: "Lab Equipment",
    price: 242,
    oldPrice: 287,
    subtitle: "Test Tube Rack — Student Edition 01 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Test Tube Rack — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Test Tube Rack.jpg",
    rating: 4.8,
    reviews: 65,
    stock: 2,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0558",
    name: "Micrometer Screw Gauge — Student Edition 02",
    category: "Lab Equipment",
    price: 291,
    oldPrice: 421,
    subtitle:
      "Micrometer Screw Gauge — Student Edition 02 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Micrometer Screw Gauge — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Micrometer Screw Gauge.jpg",
    rating: 4.8,
    reviews: 21,
    stock: 3,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0559",
    name: "Funnel Set — Student Edition 03",
    category: "Lab Equipment",
    price: 742,
    oldPrice: 879,
    subtitle: "Funnel Set — Student Edition 03 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Funnel Set — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Funnel Set.jpg",
    rating: 4.7,
    reviews: 16,
    stock: 4,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0560",
    name: "Retort Stand — Student Edition 04",
    category: "Lab Equipment",
    price: 230,
    oldPrice: 319,
    subtitle: "Retort Stand — Student Edition 04 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Retort Stand — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Retort Stand.jpg",
    rating: 4.1,
    reviews: 82,
    stock: 12,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0561",
    name: "Slide Cover Glass — Student Edition 05",
    category: "Lab Equipment",
    price: 139,
    oldPrice: 186,
    subtitle:
      "Slide Cover Glass — Student Edition 05 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Slide Cover Glass — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Slide Cover Glass.jpg",
    rating: 4.1,
    reviews: 12,
    stock: 5,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0562",
    name: "Circuit Breadboard — Student Edition 06",
    category: "Lab Equipment",
    price: 577,
    oldPrice: 796,
    subtitle:
      "Circuit Breadboard — Student Edition 06 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Circuit Breadboard — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Circuit Breadboard.jpg",
    rating: 4.6,
    reviews: 22,
    stock: 5,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0563",
    name: "Physics Lab Record — Student Edition 07",
    category: "Lab Equipment",
    price: 173,
    oldPrice: 229,
    subtitle:
      "Physics Lab Record — Student Edition 07 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Physics Lab Record — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Physics Lab Record.jpg",
    rating: 4.1,
    reviews: 30,
    stock: 11,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0564",
    name: "Conical Flask — Student Edition 08",
    category: "Lab Equipment",
    price: 109,
    oldPrice: 156,
    subtitle: "Conical Flask — Student Edition 08 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Conical Flask — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Conical Flask - Student Edition 08.jpg",
    rating: 4.1,
    reviews: 86,
    stock: 7,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0565",
    name: "Vernier Caliper — Student Edition 09",
    category: "Lab Equipment",
    price: 591,
    oldPrice: 847,
    subtitle: "Vernier Caliper — Student Edition 09 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Vernier Caliper — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Vernier Caliper.jpg",
    rating: 4.9,
    reviews: 42,
    stock: 5,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0566",
    name: "Wash Bottle — Student Edition 10",
    category: "Lab Equipment",
    price: 529,
    oldPrice: 738,
    subtitle: "Wash Bottle — Student Edition 10 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Wash Bottle — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Wash Bottle.jpg",
    rating: 4.6,
    reviews: 42,
    stock: 6,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0567",
    name: "Clamp Stand — Student Edition 11",
    category: "Lab Equipment",
    price: 139,
    oldPrice: 169,
    subtitle: "Clamp Stand — Student Edition 11 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Clamp Stand — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Clamp Stand.jpg",
    rating: 4.3,
    reviews: 78,
    stock: 9,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0568",
    name: "Prepared Microscope Slides — Student Edition 12",
    category: "Lab Equipment",
    price: 580,
    oldPrice: 700,
    subtitle:
      "Prepared Microscope Slides — Student Edition 12 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Prepared Microscope Slides — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Prepared Microscope Slides.jpg",
    rating: 4.3,
    reviews: 53,
    stock: 12,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0569",
    name: "Conductivity Meter — Student Edition 13",
    category: "Lab Equipment",
    price: 126,
    oldPrice: 170,
    subtitle:
      "Conductivity Meter — Student Edition 13 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Conductivity Meter — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Conductivity Meter.jpg",
    rating: 4.7,
    reviews: 40,
    stock: 4,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public sConical Flaskpot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0570",
    name: "LED Component Kit — Student Edition 14",
    category: "Lab Equipment",
    price: 587,
    oldPrice: 705,
    subtitle:
      "LED Component Kit — Student Edition 14 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "LED Component Kit — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/LED Component Kit.jpg",
    rating: 4.4,
    reviews: 43,
    stock: 9,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0571",
    name: "Measuring Cylinder — Student Edition 15",
    category: "Lab Equipment",
    price: 76,
    oldPrice: 96,
    subtitle:
      "Measuring Cylinder — Student Edition 15 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Measuring Cylinder — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Measuring Cylinder.jpg",
    rating: 4.7,
    reviews: 70,
    stock: 10,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0572",
    name: "Digital Vernier Caliper — Student Edition 16",
    category: "Lab Equipment",
    price: 476,
    oldPrice: 683,
    subtitle:
      "Digital Vernier Caliper — Student Edition 16 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Digital Vernier Caliper — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Vernier Caliper.jpg",
    rating: 4.3,
    reviews: 3,
    stock: 1,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0573",
    name: "Laboratory Balance — Student Edition 17",
    category: "Lab Equipment",
    price: 473,
    oldPrice: 647,
    subtitle:
      "Laboratory Balance — Student Edition 17 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Laboratory Balance — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laboratory Balance.webp",
    rating: 4.5,
    reviews: 29,
    stock: 12,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0574",
    name: "Forceps Set — Student Edition 18",
    category: "Lab Equipment",
    price: 443,
    oldPrice: 560,
    subtitle: "Forceps Set — Student Edition 18 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Forceps Set — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Forceps Set.jpg",
    rating: 4.6,
    reviews: 71,
    stock: 12,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0575",
    name: "Dissection Kit — Student Edition 19",
    category: "Lab Equipment",
    price: 167,
    oldPrice: 211,
    subtitle: "Dissection Kit — Student Edition 19 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Dissection Kit — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Dissection Kit.jpg",
    rating: 4.2,
    reviews: 79,
    stock: 12,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0576",
    name: "pH Meter — Student Edition 20",
    category: "Lab Equipment",
    price: 650,
    oldPrice: 901,
    subtitle: "pH Meter — Student Edition 20 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "pH Meter — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/pH Meter.jpg",
    rating: 4.5,
    reviews: 10,
    stock: 2,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0577",
    name: "Resistor Kit — Student Edition 21",
    category: "Lab Equipment",
    price: 677,
    oldPrice: 870,
    subtitle: "Resistor Kit — Student Edition 21 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Resistor Kit — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Resistor Kit.jpg",
    rating: 4.5,
    reviews: 38,
    stock: 1,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0578",
    name: "Glass Beaker Set — Student Edition 22",
    category: "Lab Equipment",
    price: 362,
    oldPrice: 502,
    subtitle:
      "Glass Beaker Set — Student Edition 22 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Glass Beaker Set — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass beaker Set.jpg",
    rating: 4.1,
    reviews: 44,
    stock: 9,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0579",
    name: "Plastic Pipette Set — Student Edition 23",
    category: "Lab Equipment",
    price: 137,
    oldPrice: 173,
    subtitle:
      "Plastic Pipette Set — Student Edition 23 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Plastic Pipette Set — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plastic Pipette Set.jpg",
    rating: 4.7,
    reviews: 54,
    stock: 2,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0580",
    name: "Pocket Weighing Scale — Student Edition 24",
    category: "Lab Equipment",
    price: 161,
    oldPrice: 213,
    subtitle:
      "Pocket Weighing Scale — Student Edition 24 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Pocket Weighing Scale — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket Weighing Scale.jpg",
    rating: 4.8,
    reviews: 18,
    stock: 6,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0581",
    name: "Spatula Set — Student Edition 25",
    category: "Lab Equipment",
    price: 554,
    oldPrice: 760,
    subtitle: "Spatula Set — Student Edition 25 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Spatula Set — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Spatula Set.jpg",
    rating: 4.7,
    reviews: 6,
    stock: 3,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0582",
    name: "Safety Face Mask Pack — Student Edition 26",
    category: "Lab Equipment",
    price: 455,
    oldPrice: 562,
    subtitle:
      "Safety Face Mask Pack — Student Edition 26 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Safety Face Mask Pack — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Safety Face Mask Pack.jpg",
    rating: 4.1,
    reviews: 73,
    stock: 6,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0583",
    name: "pH Paper Strips — Student Edition 27",
    category: "Lab Equipment",
    price: 382,
    oldPrice: 506,
    subtitle: "pH Paper Strips — Student Edition 27 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "pH Paper Strips — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/pH Paper Strips.jpg",
    rating: 4.0,
    reviews: 12,
    stock: 7,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0584",
    name: "Alligator Clip Leads — Student Edition 28",
    category: "Lab Equipment",
    price: 546,
    oldPrice: 732,
    subtitle:
      "Alligator Clip Leads — Student Edition 28 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Alligator Clip Leads — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Alligator Clip Leads.jpg",
    rating: 4.5,
    reviews: 43,
    stock: 2,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0585",
    name: "Lab Notebook — Student Edition 29",
    category: "Lab Equipment",
    price: 718,
    oldPrice: 859,
    subtitle: "Lab Notebook — Student Edition 29 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Lab Notebook — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lab Notebook.jpg",
    rating: 4.1,
    reviews: 19,
    stock: 2,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0586",
    name: "Pipette Bulb — Student Edition 30",
    category: "Lab Equipment",
    price: 410,
    oldPrice: 565,
    subtitle: "Pipette Bulb — Student Edition 30 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Pipette Bulb — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laboratory Pipette.jpg",
    rating: 4.8,
    reviews: 48,
    stock: 12,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0587",
    name: "Digital Thermometer — Student Edition 31",
    category: "Lab Equipment",
    price: 568,
    oldPrice: 807,
    subtitle:
      "Digital Thermometer — Student Edition 31 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Digital Thermometer — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laboratory Thermometer.jpg",
    rating: 4.1,
    reviews: 54,
    stock: 5,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0588",
    name: "Glass Stirring Rods — Student Edition 32",
    category: "Lab Equipment",
    price: 264,
    oldPrice: 363,
    subtitle:
      "Glass Stirring Rods — Student Edition 32 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Glass Stirring Rods — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass Stirring Rods.jpg",
    rating: 4.9,
    reviews: 15,
    stock: 4,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0589",
    name: "Face Shield.jpg — Student Edition 33",
    category: "Lab Equipment",
    price: 79,
    oldPrice: 99,
    subtitle: "Face Shield.jpg — Student Edition 33 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Face Shield.jpg — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Face Shield.jpg",
    rating: 4.4,
    reviews: 15,
    stock: 7,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0590",
    name: "Hand Lens — Student Edition 34",
    category: "Lab Equipment",
    price: 504,
    oldPrice: 598,
    subtitle: "Hand Lens — Student Edition 34 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Hand Lens — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Hand Lens.jpg",
    rating: 4.1,
    reviews: 7,
    stock: 3,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0591",
    name: "Solderless Breadboard — Student Edition 35",
    category: "Lab Equipment",
    price: 747,
    oldPrice: 992,
    subtitle:
      "Solderless Breadboard — Student Edition 35 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Solderless Breadboard — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solderless Breadboard.webp",
    rating: 4.8,
    reviews: 36,
    stock: 2,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0592",
    name: "Nitrile Gloves Pack — Student Edition 36",
    category: "Lab Equipment",
    price: 466,
    oldPrice: 559,
    subtitle:
      "Nitrile Gloves Pack — Student Edition 36 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Nitrile Gloves Pack — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Nitrile Gloves Pack.jpg",
    rating: 4.6,
    reviews: 27,
    stock: 3,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0593",
    name: "Glass Dropper Set — Student Edition 37",
    category: "Lab Equipment",
    price: 666,
    oldPrice: 952,
    subtitle:
      "Glass Dropper Set — Student Edition 37 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Glass Dropper Set — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glass Dropper Set.jpg",
    rating: 4.8,
    reviews: 54,
    stock: 12,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0594",
    name: "Lab Thermometer — Student Edition 38",
    category: "Lab Equipment",
    price: 680,
    oldPrice: 825,
    subtitle: "Lab Thermometer — Student Edition 38 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Lab Thermometer — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laboratory Thermometer.jpg",
    rating: 4.2,
    reviews: 24,
    stock: 12,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0595",
    name: "Petri Dish Set — Student Edition 39",
    category: "Lab Equipment",
    price: 79,
    oldPrice: 114,
    subtitle: "Petri Dish Set — Student Edition 39 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Petri Dish Set — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Petri Dish.jpg",
    rating: 4.4,
    reviews: 11,
    stock: 3,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0596",
    name: "Lab Apron — Student Edition 40",
    category: "Lab Equipment",
    price: 561,
    oldPrice: 723,
    subtitle: "Lab Apron — Student Edition 40 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Lab Apron — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Lab Equipment Set.jpg",
    rating: 4.1,
    reviews: 25,
    stock: 11,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0597",
    name: "Magnifying Glass — Student Edition 41",
    category: "Lab Equipment",
    price: 266,
    oldPrice: 321,
    subtitle:
      "Magnifying Glass — Student Edition 41 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Magnifying Glass — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Magnifying Glass.jpg",
    rating: 4.1,
    reviews: 10,
    stock: 8,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0598",
    name: "Multimeter — Student Edition 42",
    category: "Lab Equipment",
    price: 577,
    oldPrice: 814,
    subtitle: "Multimeter — Student Edition 42 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Multimeter — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multimeter.jpg",
    rating: 4.2,
    reviews: 13,
    stock: 9,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0599",
    name: "Safety Goggles — Student Edition 43",
    category: "Lab Equipment",
    price: 564,
    oldPrice: 773,
    subtitle: "Safety Goggles — Student Edition 43 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Safety Goggles — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Safety Goggles.jpg",
    rating: 4.7,
    reviews: 19,
    stock: 4,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0600",
    name: "Test Tube Set — Student Edition 44",
    category: "Lab Equipment",
    price: 474,
    oldPrice: 680,
    subtitle: "Test Tube Set — Student Edition 44 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Test Tube Set — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/test tube.jpg",
    rating: 4.6,
    reviews: 83,
    stock: 5,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0601",
    name: "Digital Stopwatch — Student Edition 45",
    category: "Lab Equipment",
    price: 140,
    oldPrice: 172,
    subtitle:
      "Digital Stopwatch — Student Edition 45 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Digital Stopwatch — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Digital Stopwatch.jpg",
    rating: 4.1,
    reviews: 59,
    stock: 5,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0602",
    name: "Filter Paper Pack — Student Edition 46",
    category: "Lab Equipment",
    price: 243,
    oldPrice: 313,
    subtitle:
      "Filter Paper Pack — Student Edition 46 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Filter Paper Pack — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Filter Paper Pack.jpg",
    rating: 4.6,
    reviews: 72,
    stock: 4,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0603",
    name: "Burette Clamp — Student Edition 47",
    category: "Lab Equipment",
    price: 721,
    oldPrice: 883,
    subtitle: "Burette Clamp — Student Edition 47 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Burette Clamp — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Burette Clamp.jpg",
    rating: 4.4,
    reviews: 31,
    stock: 1,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0604",
    name: "Microscope Cleaning Kit — Student Edition 48",
    category: "Lab Equipment",
    price: 427,
    oldPrice: 511,
    subtitle:
      "Microscope Cleaning Kit — Student Edition 48 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Microscope Cleaning Kit — Student Edition 48. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Microscope Cleaning Kit.jpg",
    rating: 4.5,
    reviews: 38,
    stock: 12,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0605",
    name: "Jumper Wire Kit — Student Edition 49",
    category: "Lab Equipment",
    price: 638,
    oldPrice: 783,
    subtitle: "Jumper Wire Kit — Student Edition 49 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Jumper Wire Kit — Student Edition 49. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Jumper Wire Kit.jpg",
    rating: 4.7,
    reviews: 35,
    stock: 8,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0606",
    name: "Laptop Sleeve",
    category: "Accessories",
    price: 143,
    oldPrice: 197,
    subtitle: "Laptop Sleeve for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Laptop Sleeve. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sleeve.jpg",
    rating: 4.2,
    reviews: 32,
    stock: 9,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0607",
    name: "ID Card Holder",
    category: "Accessories",
    price: 142,
    oldPrice: 194,
    subtitle: "ID Card Holder for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "ID Card Holder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/ID Card Holder.jpg",
    rating: 4.2,
    reviews: 6,
    stock: 4,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0608",
    name: "Lanyard Set",
    category: "Accessories",
    price: 295,
    oldPrice: 359,
    subtitle: "Lanyard Set for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Lanyard Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lanyard Set.jpg",
    rating: 4.2,
    reviews: 63,
    stock: 6,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0609",
    name: "Keychain",
    category: "Accessories",
    price: 213,
    oldPrice: 288,
    subtitle: "Keychain for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Keychain. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Keychain.jpg",
    rating: 4.0,
    reviews: 61,
    stock: 5,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0610",
    name: "Insulated Bottle",
    category: "Accessories",
    price: 350,
    oldPrice: 455,
    subtitle: "Insulated Bottle for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Insulated Bottle. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Insulated Bottle.jpg",
    rating: 4.6,
    reviews: 68,
    stock: 1,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0611",
    name: "Lunch Box",
    category: "Accessories",
    price: 384,
    oldPrice: 509,
    subtitle: "Lunch Box for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Lunch Box. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lunch Box.jpg",
    rating: 4.4,
    reviews: 31,
    stock: 4,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0612",
    name: "Compact Umbrella",
    category: "Accessories",
    price: 161,
    oldPrice: 226,
    subtitle: "Compact Umbrella for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Compact Umbrella. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Umbrella.jpg",
    rating: 4.5,
    reviews: 43,
    stock: 7,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0613",
    name: "Desk Organiser",
    category: "Accessories",
    price: 314,
    oldPrice: 394,
    subtitle: "Desk Organiser for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Desk Organiser. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desk Organiser.jpg",
    rating: 4.2,
    reviews: 40,
    stock: 6,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0614",
    name: "Cable Organiser",
    category: "Accessories",
    price: 368,
    oldPrice: 459,
    subtitle: "Cable Organiser for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Cable Organiser. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cable Organiser.jpg",
    rating: 4.3,
    reviews: 8,
    stock: 5,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0615",
    name: "Laptop Cleaning Kit",
    category: "Accessories",
    price: 133,
    oldPrice: 165,
    subtitle: "Laptop Cleaning Kit for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Laptop Cleaning Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Cleaning Kit.jpg",
    rating: 4.3,
    reviews: 27,
    stock: 7,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0616",
    name: "Phone Stand",
    category: "Accessories",
    price: 227,
    oldPrice: 269,
    subtitle: "Phone Stand for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Phone Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Stand.jpg",
    rating: 4.0,
    reviews: 55,
    stock: 1,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0617",
    name: "Tablet Stand",
    category: "Accessories",
    price: 291,
    oldPrice: 398,
    subtitle: "Tablet Stand for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Tablet Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tablet Stand.jpg",
    rating: 4.2,
    reviews: 49,
    stock: 8,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0618",
    name: "Book Stand",
    category: "Accessories",
    price: 337,
    oldPrice: 439,
    subtitle: "Book Stand for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Book Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Stand.jpg",
    rating: 4.9,
    reviews: 35,
    stock: 5,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0619",
    name: "Reading Light",
    category: "Accessories",
    price: 45,
    oldPrice: 65,
    subtitle: "Reading Light for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Reading Light. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reading Light.jpg",
    rating: 4.3,
    reviews: 53,
    stock: 6,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0620",
    name: "Reusable Tote Bag",
    category: "Accessories",
    price: 312,
    oldPrice: 387,
    subtitle: "Reusable Tote Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Reusable Tote Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Tote Bag.jpg",
    rating: 4.8,
    reviews: 9,
    stock: 1,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0621",
    name: "Coin Purse",
    category: "Accessories",
    price: 338,
    oldPrice: 428,
    subtitle: "Coin Purse for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Coin Purse. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Coin Purse.jpg",
    rating: 4.8,
    reviews: 61,
    stock: 3,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0622",
    name: "Wallet",
    category: "Accessories",
    price: 65,
    oldPrice: 85,
    subtitle: "Wallet for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Wallet. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Campus Wallet.jpg",
    rating: 4.0,
    reviews: 39,
    stock: 6,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0623",
    name: "Card Holder",
    category: "Accessories",
    price: 263,
    oldPrice: 314,
    subtitle: "Card Holder for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Card Holder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Card Holder.jpg",
    rating: 4.9,
    reviews: 49,
    stock: 4,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0624",
    name: "Watch Strap",
    category: "Accessories",
    price: 75,
    oldPrice: 95,
    subtitle: "Watch Strap for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Watch Strap. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Watch Strap.jpg",
    rating: 4.7,
    reviews: 8,
    stock: 8,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0625",
    name: "Sunglasses Case",
    category: "Accessories",
    price: 132,
    oldPrice: 191,
    subtitle: "Sunglasses Case for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Sunglasses Case. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sunglasses Case.jpg",
    rating: 4.3,
    reviews: 19,
    stock: 11,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0626",
    name: "Glasses Cleaning Kit",
    category: "Accessories",
    price: 347,
    oldPrice: 444,
    subtitle: "Glasses Cleaning Kit for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Glasses Cleaning Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glasses Cleaning Kit.jpg",
    rating: 4.0,
    reviews: 47,
    stock: 12,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0627",
    name: "Earbud Pouch",
    category: "Accessories",
    price: 122,
    oldPrice: 175,
    subtitle: "Earbud Pouch for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Earbud Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Earbud Pouch.jpg",
    rating: 4.1,
    reviews: 28,
    stock: 1,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0628",
    name: "Headphone Case",
    category: "Accessories",
    price: 238,
    oldPrice: 337,
    subtitle: "Headphone Case for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Headphone Case. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Headphone Case.jpg",
    rating: 4.3,
    reviews: 65,
    stock: 7,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0629",
    name: "USB Cable Pouch",
    category: "Accessories",
    price: 307,
    oldPrice: 367,
    subtitle: "USB Cable Pouch for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "USB Cable Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Cable Pouch.jpg",
    rating: 4.2,
    reviews: 83,
    stock: 11,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0630",
    name: "Travel Pouch",
    category: "Accessories",
    price: 253,
    oldPrice: 366,
    subtitle: "Travel Pouch for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Travel Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Pouch.jpg",
    rating: 4.4,
    reviews: 81,
    stock: 9,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0631",
    name: "Badge Holder",
    category: "Accessories",
    price: 66,
    oldPrice: 92,
    subtitle: "Badge Holder for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Badge Holder. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Badge Holder.jpg",
    rating: 4.6,
    reviews: 5,
    stock: 8,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0632",
    name: "College ID Reel",
    category: "Accessories",
    price: 264,
    oldPrice: 338,
    subtitle: "College ID Reel for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "College ID Reel. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College ID Reel.jpg",
    rating: 4.6,
    reviews: 51,
    stock: 4,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0633",
    name: "Foldable Phone Stand",
    category: "Accessories",
    price: 34,
    oldPrice: 54,
    subtitle: "Foldable Phone Stand for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Foldable Phone Stand. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Phone Stand.jpg",
    rating: 4.0,
    reviews: 35,
    stock: 10,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0634",
    name: "Phone Grip",
    category: "Accessories",
    price: 155,
    oldPrice: 188,
    subtitle: "Phone Grip for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Phone Grip. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Grip.jpg",
    rating: 4.3,
    reviews: 73,
    stock: 11,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0635",
    name: "Screen Cleaning Cloth",
    category: "Accessories",
    price: 363,
    oldPrice: 462,
    subtitle: "Screen Cleaning Cloth for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Screen Cleaning Cloth. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Screen Cleaning Cloth.jpg",
    rating: 4.6,
    reviews: 65,
    stock: 11,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0636",
    name: "Laptop Sticker Pack",
    category: "Accessories",
    price: 45,
    oldPrice: 65,
    subtitle: "Laptop Sticker Pack for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Laptop Sticker Pack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sticker Pack.jpg",
    rating: 4.5,
    reviews: 28,
    stock: 6,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0637",
    name: "Planner",
    category: "Accessories",
    price: 339,
    oldPrice: 445,
    subtitle: "Planner for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Planner. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Planner.jpg",
    rating: 4.4,
    reviews: 76,
    stock: 6,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0638",
    name: "Weekly Planner Pad",
    category: "Accessories",
    price: 202,
    oldPrice: 273,
    subtitle: "Weekly Planner Pad for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Weekly Planner Pad. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Weekly Planner Pad.jpg",
    rating: 4.2,
    reviews: 72,
    stock: 1,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0639",
    name: "Bookmark Set",
    category: "Accessories",
    price: 175,
    oldPrice: 240,
    subtitle: "Bookmark Set for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Bookmark Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bookmark Set.jpg",
    rating: 4.5,
    reviews: 85,
    stock: 3,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0640",
    name: "Book Sleeve",
    category: "Accessories",
    price: 29,
    oldPrice: 49,
    subtitle: "Book Sleeve for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Book Sleeve. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Sleeve.jpg",
    rating: 4.8,
    reviews: 48,
    stock: 12,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0641",
    name: "Reusable Cutlery Set",
    category: "Accessories",
    price: 304,
    oldPrice: 390,
    subtitle: "Reusable Cutlery Set for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Reusable Cutlery Set. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Cutlery Set.jpg",
    rating: 4.6,
    reviews: 43,
    stock: 11,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0642",
    name: "Travel Mug",
    category: "Accessories",
    price: 59,
    oldPrice: 80,
    subtitle: "Travel Mug for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Travel Mug. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Mug.jpg",
    rating: 4.3,
    reviews: 8,
    stock: 1,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0643",
    name: "Thermal Flask",
    category: "Accessories",
    price: 141,
    oldPrice: 187,
    subtitle: "Thermal Flask for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Thermal Flask. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Thermal Flask.jpg",
    rating: 4.3,
    reviews: 21,
    stock: 11,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0644",
    name: "Mini Desk Fan",
    category: "Accessories",
    price: 264,
    oldPrice: 346,
    subtitle: "Mini Desk Fan for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Mini Desk Fan. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Desk Fan.jpg",
    rating: 4.0,
    reviews: 66,
    stock: 10,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0645",
    name: "Clip-on Reading Light",
    category: "Accessories",
    price: 340,
    oldPrice: 419,
    subtitle: "Clip-on Reading Light for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Clip-on Reading Light. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Clip-on Reading Light.jpg",
    rating: 4.1,
    reviews: 75,
    stock: 3,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0646",
    name: "Rain Cover",
    category: "Accessories",
    price: 198,
    oldPrice: 264,
    subtitle: "Rain Cover for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Rain Cover. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Rain CoverV.jpg",
    rating: 4.7,
    reviews: 7,
    stock: 12,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0647",
    name: "Reflective Key Tag",
    category: "Accessories",
    price: 69,
    oldPrice: 98,
    subtitle: "Reflective Key Tag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Reflective Key Tag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reflective Key Tag.jpg",
    rating: 4.6,
    reviews: 60,
    stock: 1,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0648",
    name: "Bag Charm",
    category: "Accessories",
    price: 40,
    oldPrice: 60,
    subtitle: "Bag Charm for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Bag Charm. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bag Charm.jpg",
    rating: 4.7,
    reviews: 79,
    stock: 3,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0649",
    name: "Zip Pouch",
    category: "Accessories",
    price: 121,
    oldPrice: 155,
    subtitle: "Zip Pouch for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Zip Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Zip Pouch.jpg",
    rating: 4.6,
    reviews: 22,
    stock: 11,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0650",
    name: "Document Wallet",
    category: "Accessories",
    price: 371,
    oldPrice: 469,
    subtitle: "Document Wallet for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Document Wallet. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Wallet.jpg",
    rating: 4.5,
    reviews: 40,
    stock: 12,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0651",
    name: "Portable Sewing Kit",
    category: "Accessories",
    price: 277,
    oldPrice: 330,
    subtitle: "Portable Sewing Kit for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Portable Sewing Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Sewing Kit.jpg",
    rating: 4.1,
    reviews: 5,
    stock: 12,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0652",
    name: "Safety Pin Kit",
    category: "Accessories",
    price: 332,
    oldPrice: 405,
    subtitle: "Safety Pin Kit for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Safety Pin Kit. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Safety Pin Kit.jpg",
    rating: 4.7,
    reviews: 25,
    stock: 9,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0653",
    name: "Compact Mirror",
    category: "Accessories",
    price: 356,
    oldPrice: 491,
    subtitle: "Compact Mirror for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Compact Mirror. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Mirror.jpg",
    rating: 4.0,
    reviews: 84,
    stock: 8,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0654",
    name: "Lunch Box — Student Edition 01",
    category: "Accessories",
    price: 341,
    oldPrice: 463,
    subtitle: "Lunch Box — Student Edition 01 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Lunch Box — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lunch Box.jpg",
    rating: 4.8,
    reviews: 81,
    stock: 2,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0655",
    name: "Book Stand — Student Edition 02",
    category: "Accessories",
    price: 138,
    oldPrice: 193,
    subtitle: "Book Stand — Student Edition 02 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Book Stand — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Stand.jpg",
    rating: 4.6,
    reviews: 68,
    stock: 8,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0656",
    name: "Sunglasses Case — Student Edition 03",
    category: "Accessories",
    price: 350,
    oldPrice: 476,
    subtitle: "Sunglasses Case — Student Edition 03 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Sunglasses Case — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sunglasses Case.jpg",
    rating: 4.8,
    reviews: 69,
    stock: 5,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0657",
    name: "College ID Reel — Student Edition 04",
    category: "Accessories",
    price: 323,
    oldPrice: 433,
    subtitle: "College ID Reel — Student Edition 04 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "College ID Reel — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College ID Reel.jpg",
    rating: 4.7,
    reviews: 61,
    stock: 10,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0658",
    name: "Bookmark Set — Student Edition 05",
    category: "Accessories",
    price: 325,
    oldPrice: 397,
    subtitle: "Bookmark Set — Student Edition 05 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Bookmark Set — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bookmark Set.jpg",
    rating: 4.5,
    reviews: 16,
    stock: 10,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0659",
    name: "Rain Cover — Student Edition 06",
    category: "Accessories",
    price: 142,
    oldPrice: 195,
    subtitle: "Rain Cover — Student Edition 06 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Rain Cover — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Rain CoverV.jpg",
    rating: 4.4,
    reviews: 62,
    stock: 1,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0660",
    name: "Compact Mirror — Student Edition 07",
    category: "Accessories",
    price: 259,
    oldPrice: 307,
    subtitle: "Compact Mirror — Student Edition 07 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Compact Mirror — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Mirror.jpg",
    rating: 4.1,
    reviews: 41,
    stock: 9,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0661",
    name: "Insulated Bottle — Student Edition 08",
    category: "Accessories",
    price: 118,
    oldPrice: 169,
    subtitle:
      "Insulated Bottle — Student Edition 08 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Insulated Bottle — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Insulated Bottle.jpg",
    rating: 4.4,
    reviews: 75,
    stock: 7,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0662",
    name: "Tablet Stand — Student Edition 09",
    category: "Accessories",
    price: 298,
    oldPrice: 403,
    subtitle: "Tablet Stand — Student Edition 09 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Tablet Stand — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tablet Stand.jpg",
    rating: 4.3,
    reviews: 78,
    stock: 4,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0663",
    name: "Watch Strap — Student Edition 10",
    category: "Accessories",
    price: 61,
    oldPrice: 87,
    subtitle: "Watch Strap — Student Edition 10 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Watch Strap — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Watch Strap.jpg",
    rating: 4.5,
    reviews: 5,
    stock: 1,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0664",
    name: "Badge Holder — Student Edition 11",
    category: "Accessories",
    price: 375,
    oldPrice: 522,
    subtitle: "Badge Holder — Student Edition 11 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Badge Holder — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Badge Holder.jpg",
    rating: 4.7,
    reviews: 70,
    stock: 11,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0665",
    name: "Weekly Planner Pad — Student Edition 12",
    category: "Accessories",
    price: 82,
    oldPrice: 108,
    subtitle:
      "Weekly Planner Pad — Student Edition 12 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Weekly Planner Pad — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Weekly Planner Pad.jpg",
    rating: 4.0,
    reviews: 54,
    stock: 2,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0666",
    name: "Clip-on Reading Light — Student Edition 13",
    category: "Accessories",
    price: 226,
    oldPrice: 295,
    subtitle:
      "Clip-on Reading Light — Student Edition 13 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Clip-on Reading Light — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Clip-on Reading Light.jpg",
    rating: 4.5,
    reviews: 29,
    stock: 11,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0667",
    name: "Safety Pin Kit — Student Edition 14",
    category: "Accessories",
    price: 117,
    oldPrice: 141,
    subtitle: "Safety Pin Kit — Student Edition 14 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Safety Pin Kit — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Safety Pin Kit.jpg",
    rating: 4.4,
    reviews: 6,
    stock: 10,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0668",
    name: "Reusable Water Bottle — Student Edition 15",
    category: "Accessories",
    price: 320,
    oldPrice: 418,
    subtitle:
      "Reusable Water Bottle — Student Edition 15 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Reusable Water Bottle — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Water Bottle.jpg",
    rating: 4.2,
    reviews: 83,
    stock: 7,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0669",
    name: "Phone Stand — Student Edition 16",
    category: "Accessories",
    price: 376,
    oldPrice: 474,
    subtitle: "Phone Stand — Student Edition 16 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Phone Stand — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Stand.jpg",
    rating: 4.0,
    reviews: 17,
    stock: 9,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0670",
    name: "Card Holder — Student Edition 17",
    category: "Accessories",
    price: 278,
    oldPrice: 370,
    subtitle: "Card Holder — Student Edition 17 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Card Holder — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Card Holder.jpg",
    rating: 4.6,
    reviews: 86,
    stock: 7,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0671",
    name: "Travel Pouch — Student Edition 18",
    category: "Accessories",
    price: 83,
    oldPrice: 116,
    subtitle: "Travel Pouch — Student Edition 18 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Travel Pouch — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Pouch.jpg",
    rating: 4.1,
    reviews: 81,
    stock: 7,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0672",
    name: "Planner — Student Edition 19",
    category: "Accessories",
    price: 31,
    oldPrice: 51,
    subtitle: "Planner — Student Edition 19 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Planner — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Planner.jpg",
    rating: 4.8,
    reviews: 55,
    stock: 5,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0673",
    name: "Mini Desk Fan — Student Edition 20",
    category: "Accessories",
    price: 30,
    oldPrice: 50,
    subtitle: "Mini Desk Fan — Student Edition 20 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Mini Desk Fan — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Desk Fan.jpg",
    rating: 4.6,
    reviews: 70,
    stock: 9,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0674",
    name: "Portable Sewing Kit — Student Edition 21",
    category: "Accessories",
    price: 82,
    oldPrice: 106,
    subtitle:
      "Portable Sewing Kit — Student Edition 21 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Portable Sewing Kit — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Portable Sewing Kit.jpg",
    rating: 4.4,
    reviews: 53,
    stock: 7,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0675",
    name: "Keychain — Student Edition 22",
    category: "Accessories",
    price: 288,
    oldPrice: 356,
    subtitle: "Keychain — Student Edition 22 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Keychain — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Keychain.jpg",
    rating: 4.5,
    reviews: 52,
    stock: 12,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0676",
    name: "Laptop Cleaning Kit — Student Edition 23",
    category: "Accessories",
    price: 121,
    oldPrice: 144,
    subtitle:
      "Laptop Cleaning Kit — Student Edition 23 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Laptop Cleaning Kit — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Cleaning Kit.jpg",
    rating: 4.4,
    reviews: 41,
    stock: 10,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0677",
    name: "Wallet — Student Edition 24",
    category: "Accessories",
    price: 399,
    oldPrice: 539,
    subtitle: "Wallet — Student Edition 24 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Wallet — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Campus Wallet.jpg",
    rating: 4.3,
    reviews: 70,
    stock: 6,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0678",
    name: "USB Cable Pouch — Student Edition 25",
    category: "Accessories",
    price: 394,
    oldPrice: 477,
    subtitle: "USB Cable Pouch — Student Edition 25 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "USB Cable Pouch — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/USB Cable Pouch.jpg",
    rating: 4.3,
    reviews: 54,
    stock: 12,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0679",
    name: "Laptop Sticker Pack — Student Edition 26",
    category: "Accessories",
    price: 377,
    oldPrice: 538,
    subtitle:
      "Laptop Sticker Pack — Student Edition 26 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Laptop Sticker Pack — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sticker Pack.jpg",
    rating: 4.9,
    reviews: 37,
    stock: 1,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0680",
    name: "Thermal Flask — Student Edition 27",
    category: "Accessories",
    price: 382,
    oldPrice: 514,
    subtitle: "Thermal Flask — Student Edition 27 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Thermal Flask — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Thermal Flask.jpg",
    rating: 4.4,
    reviews: 80,
    stock: 8,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0681",
    name: "Document Wallet — Student Edition 28",
    category: "Accessories",
    price: 309,
    oldPrice: 399,
    subtitle: "Document Wallet — Student Edition 28 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Document Wallet — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Wallet.jpg",
    rating: 4.7,
    reviews: 44,
    stock: 12,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0682",
    name: "Lanyard Set — Student Edition 29",
    category: "Accessories",
    price: 78,
    oldPrice: 103,
    subtitle: "Lanyard Set — Student Edition 29 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Lanyard Set — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lanyard Set.jpg",
    rating: 4.5,
    reviews: 22,
    stock: 6,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0683",
    name: "Cable Organiser — Student Edition 30",
    category: "Accessories",
    price: 183,
    oldPrice: 236,
    subtitle: "Cable Organiser — Student Edition 30 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Cable Organiser — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Cable Organiser.jpg",
    rating: 4.3,
    reviews: 6,
    stock: 3,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0684",
    name: "Coin Purse — Student Edition 31",
    category: "Accessories",
    price: 80,
    oldPrice: 103,
    subtitle: "Coin Purse — Student Edition 31 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Coin Purse — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Coin Purse.jpg",
    rating: 4.6,
    reviews: 64,
    stock: 3,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0685",
    name: "Headphone Case — Student Edition 32",
    category: "Accessories",
    price: 359,
    oldPrice: 452,
    subtitle: "Headphone Case — Student Edition 32 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Headphone Case — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Headphone Case.jpg",
    rating: 4.8,
    reviews: 63,
    stock: 6,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0686",
    name: "Screen Cleaning Cloth — Student Edition 33",
    category: "Accessories",
    price: 367,
    oldPrice: 531,
    subtitle:
      "Screen Cleaning Cloth — Student Edition 33 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Screen Cleaning Cloth — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Screen Cleaning Cloth.jpg",
    rating: 4.4,
    reviews: 45,
    stock: 6,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0687",
    name: "Travel Mug — Student Edition 34",
    category: "Accessories",
    price: 179,
    oldPrice: 231,
    subtitle: "Travel Mug — Student Edition 34 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Travel Mug — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Mug.jpg",
    rating: 4.6,
    reviews: 24,
    stock: 3,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0688",
    name: "Zip Pouch — Student Edition 35",
    category: "Accessories",
    price: 309,
    oldPrice: 432,
    subtitle: "Zip Pouch — Student Edition 35 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Zip Pouch — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Zip Pouch.jpg",
    rating: 4.3,
    reviews: 20,
    stock: 12,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0689",
    name: "ID Card Holder — Student Edition 36",
    category: "Accessories",
    price: 300,
    oldPrice: 403,
    subtitle: "ID Card Holder — Student Edition 36 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "ID Card Holder — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/ID Card Holder.jpg",
    rating: 4.2,
    reviews: 49,
    stock: 2,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0690",
    name: "Desk Organiser — Student Edition 37",
    category: "Accessories",
    price: 372,
    oldPrice: 472,
    subtitle: "Desk Organiser — Student Edition 37 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Desk Organiser — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Desk Organiser.jpg",
    rating: 4.1,
    reviews: 49,
    stock: 1,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0691",
    name: "Reusable Tote Bag — Student Edition 38",
    category: "Accessories",
    price: 114,
    oldPrice: 156,
    subtitle:
      "Reusable Tote Bag — Student Edition 38 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Reusable Tote Bag — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Tote Bag.jpg",
    rating: 4.8,
    reviews: 24,
    stock: 10,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0692",
    name: "Earbud Pouch — Student Edition 39",
    category: "Accessories",
    price: 347,
    oldPrice: 491,
    subtitle: "Earbud Pouch — Student Edition 39 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Earbud Pouch — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Earbud Pouch.jpg",
    rating: 4.3,
    reviews: 38,
    stock: 5,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0693",
    name: "Phone Grip — Student Edition 40",
    category: "Accessories",
    price: 186,
    oldPrice: 244,
    subtitle: "Phone Grip — Student Edition 40 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Phone Grip — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Phone Grip.jpg",
    rating: 4.1,
    reviews: 16,
    stock: 10,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0694",
    name: "Reusable Cutlery Set — Student Edition 41",
    category: "Accessories",
    price: 61,
    oldPrice: 84,
    subtitle:
      "Reusable Cutlery Set — Student Edition 41 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Reusable Cutlery Set — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Cutlery Set.jpg",
    rating: 4.7,
    reviews: 9,
    stock: 1,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0695",
    name: "Bag Charm — Student Edition 42",
    category: "Accessories",
    price: 397,
    oldPrice: 504,
    subtitle: "Bag Charm — Student Edition 42 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Bag Charm — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Bag Charm.jpg",
    rating: 4.7,
    reviews: 82,
    stock: 2,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0696",
    name: "Laptop Sleeve — Student Edition 43",
    category: "Accessories",
    price: 162,
    oldPrice: 198,
    subtitle: "Laptop Sleeve — Student Edition 43 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Laptop Sleeve — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Sleeve.jpg",
    rating: 4.0,
    reviews: 36,
    stock: 9,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0697",
    name: "Compact Umbrella — Student Edition 44",
    category: "Accessories",
    price: 151,
    oldPrice: 184,
    subtitle:
      "Compact Umbrella — Student Edition 44 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Compact Umbrella — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Umbrella.jpg",
    rating: 4.8,
    reviews: 82,
    stock: 7,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0698",
    name: "Reading Light — Student Edition 45",
    category: "Accessories",
    price: 228,
    oldPrice: 322,
    subtitle: "Reading Light — Student Edition 45 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Reading Light — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reading Light.jpg",
    rating: 4.7,
    reviews: 5,
    stock: 10,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0699",
    name: "Glasses Cleaning Kit — Student Edition 46",
    category: "Accessories",
    price: 44,
    oldPrice: 64,
    subtitle:
      "Glasses Cleaning Kit — Student Edition 46 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Glasses Cleaning Kit — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Glasses Cleaning Kit.jpg",
    rating: 4.6,
    reviews: 18,
    stock: 5,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0700",
    name: "Foldable Phone Stand — Student Edition 47",
    category: "Accessories",
    price: 250,
    oldPrice: 306,
    subtitle:
      "Foldable Phone Stand — Student Edition 47 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Foldable Phone Stand — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Phone Stand.jpg",
    rating: 4.0,
    reviews: 71,
    stock: 7,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0701",
    name: "Book Sleeve — Student Edition 48",
    category: "Accessories",
    price: 359,
    oldPrice: 496,
    subtitle: "Book Sleeve — Student Edition 48 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Book Sleeve — Student Edition 48. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Sleeve.jpg",
    rating: 4.1,
    reviews: 51,
    stock: 2,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0702",
    name: "Reflective Key Tag — Student Edition 49",
    category: "Accessories",
    price: 151,
    oldPrice: 209,
    subtitle:
      "Reflective Key Tag — Student Edition 49 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Reflective Key Tag — Student Edition 49. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reflective Key Tag.jpg",
    rating: 4.5,
    reviews: 81,
    stock: 9,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0703",
    name: "Plain Cotton T-shirt",
    category: "T-Shirts",
    price: 142,
    oldPrice: 169,
    subtitle: "Plain Cotton T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Plain Cotton T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plain Cotton T-shirt.webp",
    rating: 4.3,
    reviews: 40,
    stock: 3,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0704",
    name: "Oversized Graphic T-shirt",
    category: "T-Shirts",
    price: 165,
    oldPrice: 232,
    subtitle: "Oversized Graphic T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Oversized Graphic T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Oversized Graphic T-shirt.jpg",
    rating: 4.6,
    reviews: 52,
    stock: 4,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0705",
    name: "College Club T-shirt",
    category: "T-Shirts",
    price: 336,
    oldPrice: 467,
    subtitle: "College Club T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "College Club T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College Club T-shirt.jpg",
    rating: 4.3,
    reviews: 17,
    stock: 5,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0706",
    name: "Minimal Logo T-shirt",
    category: "T-Shirts",
    price: 278,
    oldPrice: 375,
    subtitle: "Minimal Logo T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Minimal Logo T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Logo T-shirt.jpg",
    rating: 4.4,
    reviews: 68,
    stock: 5,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0707",
    name: "Striped Cotton T-shirt",
    category: "T-Shirts",
    price: 170,
    oldPrice: 201,
    subtitle: "Striped Cotton T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Striped Cotton T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Striped Cotton T-shirt.jpg",
    rating: 4.7,
    reviews: 23,
    stock: 12,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0708",
    name: "Round Neck T-shirt",
    category: "T-Shirts",
    price: 263,
    oldPrice: 319,
    subtitle: "Round Neck T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Round Neck T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Round Neck T-shirt.jpg",
    rating: 4.5,
    reviews: 33,
    stock: 3,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0709",
    name: "V-neck T-shirt",
    category: "T-Shirts",
    price: 106,
    oldPrice: 140,
    subtitle: "V-neck T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "V-neck T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/V-neck T-shirt.jpg",
    rating: 4.1,
    reviews: 36,
    stock: 10,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0710",
    name: "Relaxed Fit T-shirt",
    category: "T-Shirts",
    price: 126,
    oldPrice: 162,
    subtitle: "Relaxed Fit T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Relaxed Fit T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Relaxed Fit T-shirt.jpg",
    rating: 4.2,
    reviews: 38,
    stock: 9,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0711",
    name: "Sports Training T-shirt",
    category: "T-Shirts",
    price: 221,
    oldPrice: 297,
    subtitle: "Sports Training T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Sports Training T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sports Training T-shirt.jpg",
    rating: 4.2,
    reviews: 22,
    stock: 12,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0712",
    name: "Quick Dry T-shirt",
    category: "T-Shirts",
    price: 309,
    oldPrice: 389,
    subtitle: "Quick Dry T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Quick Dry T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Quick Dry T-shirt.jpg",
    rating: 4.2,
    reviews: 22,
    stock: 2,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0713",
    name: "Polo T-shirt",
    category: "T-Shirts",
    price: 151,
    oldPrice: 194,
    subtitle: "Polo T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Polo T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Polo T-shirt.jpg",
    reviews: 81,
    stock: 5,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0714",
    name: "Long Sleeve T-shirt",
    category: "T-Shirts",
    price: 314,
    oldPrice: 436,
    subtitle: "Long Sleeve T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Long Sleeve T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Long Sleeve T-shirt.jpg",
    rating: 4.1,
    reviews: 72,
    stock: 9,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0715",
    name: "Pocket T-shirt",
    category: "T-Shirts",
    price: 341,
    oldPrice: 450,
    subtitle: "Pocket T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Pocket T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket T-shirt.jpg",
    rating: 4.5,
    reviews: 40,
    stock: 1,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0716",
    name: "Vintage Style T-shirt",
    category: "T-Shirts",
    price: 244,
    oldPrice: 299,
    subtitle: "Vintage Style T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Vintage Style T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Vintage Style T-shirt.jpg",
    rating: 4.5,
    reviews: 13,
    stock: 12,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0717",
    name: "Typography T-shirt",
    category: "T-Shirts",
    price: 318,
    oldPrice: 396,
    subtitle: "Typography T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Typography T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Typography T-shirt.jpg",
    rating: 4.8,
    reviews: 36,
    stock: 5,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0718",
    name: "Abstract Print T-shirt",
    category: "T-Shirts",
    price: 204,
    oldPrice: 255,
    subtitle: "Abstract Print T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Abstract Print T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Abstract Print T-shirt.jpg",
    rating: 4.1,
    reviews: 70,
    stock: 12,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0719",
    name: "Monochrome T-shirt",
    category: "T-Shirts",
    price: 277,
    oldPrice: 348,
    subtitle: "Monochrome T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Monochrome T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Monochrome T-shirt.jpg",
    rating: 4.2,
    reviews: 8,
    stock: 11,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0720",
    name: "Pastel Cotton T-shirt",
    category: "T-Shirts",
    price: 176,
    oldPrice: 243,
    subtitle: "Pastel Cotton T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Pastel Cotton T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pastel Cotton T-shirt.jpg",
    rating: 4.8,
    reviews: 44,
    stock: 7,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0721",
    name: "Campus Event T-shirt",
    category: "T-Shirts",
    price: 396,
    oldPrice: 484,
    subtitle: "Campus Event T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Campus Event T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Campus Event T-shirt.jpg",
    rating: 4.8,
    reviews: 41,
    stock: 11,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0722",
    name: "Team T-shirt",
    category: "T-Shirts",
    price: 355,
    oldPrice: 477,
    subtitle: "Team T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Team T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Team T-shirt.jpg",
    rating: 4.6,
    reviews: 11,
    stock: 7,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0723",
    name: "Basic Everyday Tee",
    category: "T-Shirts",
    price: 282,
    oldPrice: 374,
    subtitle: "Basic Everyday Tee for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Basic Everyday Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Everyday Tee.jpg",
    rating: 4.3,
    reviews: 18,
    stock: 5,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0724",
    name: "Boxy Fit T-shirt",
    category: "T-Shirts",
    price: 116,
    oldPrice: 164,
    subtitle: "Boxy Fit T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Boxy Fit T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Boxy Fit T-shirt.jpg",
    rating: 4.6,
    reviews: 56,
    stock: 1,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0725",
    name: "Raglan Sleeve T-shirt",
    category: "T-Shirts",
    price: 287,
    oldPrice: 345,
    subtitle: "Raglan Sleeve T-shirt for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Raglan Sleeve T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Raglan Sleeve T-shirt.jpg",
    rating: 4.6,
    reviews: 46,
    stock: 3,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0726",
    name: "Henley T-shirt",
    category: "T-Shirts",
    price: 346,
    oldPrice: 433,
    subtitle: "Henley T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Henley T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Henley T-shirt.jpg",
    rating: 4.4,
    reviews: 57,
    stock: 4,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0727",
    name: "Organic Cotton T-shirt",
    category: "T-Shirts",
    price: 326,
    oldPrice: 462,
    subtitle: "Organic Cotton T-shirt for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Organic Cotton T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Organic Cotton T-shirt.jpg",
    rating: 4.6,
    reviews: 35,
    stock: 10,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0728",
    name: "Heavyweight Cotton Tee",
    category: "T-Shirts",
    price: 367,
    oldPrice: 524,
    subtitle: "Heavyweight Cotton Tee for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Heavyweight Cotton Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Heavyweight Cotton Tee.jpg",
    rating: 4.4,
    reviews: 3,
    stock: 4,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0729",
    name: "Lightweight Summer Tee",
    category: "T-Shirts",
    price: 296,
    oldPrice: 405,
    subtitle: "Lightweight Summer Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Lightweight Summer Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Summer Tee.jpg",
    rating: 4.2,
    reviews: 23,
    stock: 7,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0730",
    name: "Graphic Art T-shirt",
    category: "T-Shirts",
    price: 337,
    oldPrice: 425,
    subtitle: "Graphic Art T-shirt for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Graphic Art T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Graphic Art T-shirt.jpg",
    rating: 4.0,
    reviews: 27,
    stock: 12,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0731",
    name: "Minimal Line Art Tee",
    category: "T-Shirts",
    price: 234,
    oldPrice: 322,
    subtitle: "Minimal Line Art Tee for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Minimal Line Art Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Line Art Tee.jpg",
    rating: 4.8,
    reviews: 76,
    stock: 5,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0732",
    name: "Nature Print T-shirt",
    category: "T-Shirts",
    price: 202,
    oldPrice: 274,
    subtitle: "Nature Print T-shirt for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Nature Print T-shirt. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Nature Print T-shirt.jpg",
    rating: 4.2,
    reviews: 31,
    stock: 4,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0733",
    name: "Retro College Tee",
    category: "T-Shirts",
    price: 366,
    oldPrice: 473,
    subtitle: "Retro College Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Retro College Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Retro College Tee.jpg",
    rating: 4.5,
    reviews: 56,
    stock: 7,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0734",
    name: "Classic Striped Tee",
    category: "T-Shirts",
    price: 263,
    oldPrice: 359,
    subtitle: "Classic Striped Tee for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Classic Striped Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classic Striped Tee.jpg",
    rating: 4.2,
    reviews: 39,
    stock: 5,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0735",
    name: "Solid Colour Tee",
    category: "T-Shirts",
    price: 245,
    oldPrice: 317,
    subtitle: "Solid Colour Tee for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Solid Colour Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solid Colour Tee.jpg",
    rating: 4.4,
    reviews: 42,
    stock: 2,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0736",
    name: "Sleeveless Sports Tee",
    category: "T-Shirts",
    price: 164,
    oldPrice: 205,
    subtitle: "Sleeveless Sports Tee for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Sleeveless Sports Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sleeveless Sports Tee.jpg",
    rating: 4.6,
    reviews: 31,
    stock: 8,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0737",
    name: "Crew Neck Tee",
    category: "T-Shirts",
    price: 120,
    oldPrice: 142,
    subtitle: "Crew Neck Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Crew Neck Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Crew Neck Tee.webp",
    rating: 4.3,
    reviews: 57,
    stock: 6,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0738",
    name: "Drop Shoulder Tee",
    category: "T-Shirts",
    price: 339,
    oldPrice: 478,
    subtitle: "Drop Shoulder Tee for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Drop Shoulder Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Drop Shoulder Tee.jpg",
    rating: 4.2,
    reviews: 41,
    stock: 12,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0739",
    name: "Contrast Sleeve Tee",
    category: "T-Shirts",
    price: 277,
    oldPrice: 341,
    subtitle: "Contrast Sleeve Tee for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Contrast Sleeve Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Contrast Sleeve Tee1.jpg",
    rating: 4.4,
    reviews: 12,
    stock: 9,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0740",
    name: "Pocket Logo Tee",
    category: "T-Shirts",
    price: 353,
    oldPrice: 471,
    subtitle: "Pocket Logo Tee for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Pocket Logo Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket Logo Tee.jpg",
    rating: 4.3,
    reviews: 61,
    stock: 6,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0741",
    name: "Relaxed Campus Tee",
    category: "T-Shirts",
    price: 263,
    oldPrice: 326,
    subtitle: "Relaxed Campus Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Relaxed Campus Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Relaxed Campus Tee.jpg",
    rating: 4.1,
    reviews: 44,
    stock: 3,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0742",
    name: "Printed Cotton Tee",
    category: "T-Shirts",
    price: 132,
    oldPrice: 171,
    subtitle: "Printed Cotton Tee for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Printed Cotton Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Printed Cotton Tee.jpg",
    rating: 4.7,
    reviews: 69,
    stock: 9,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0743",
    name: "Casual Weekend Tee",
    category: "T-Shirts",
    price: 140,
    oldPrice: 192,
    subtitle: "Casual Weekend Tee for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Casual Weekend Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Casual Weekend Tee.jpg",
    rating: 4.3,
    reviews: 69,
    stock: 8,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0744",
    name: "Study Club Tee",
    category: "T-Shirts",
    price: 148,
    oldPrice: 187,
    subtitle: "Study Club Tee for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Study Club Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Study Club Tee.jpg",
    rating: 4.7,
    reviews: 49,
    stock: 7,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0745",
    name: "Student Society Tee",
    category: "T-Shirts",
    price: 380,
    oldPrice: 471,
    subtitle: "Student Society Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Student Society Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Society Tee..jpg",
    rating: 4.5,
    reviews: 25,
    stock: 6,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0746",
    name: "Everyday Layering Tee",
    category: "T-Shirts",
    price: 384,
    oldPrice: 497,
    subtitle: "Everyday Layering Tee for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Everyday Layering Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Everyday Layering Tee.jpg",
    rating: 4.7,
    reviews: 69,
    stock: 1,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0747",
    name: "Soft Cotton Tee",
    category: "T-Shirts",
    price: 238,
    oldPrice: 300,
    subtitle: "Soft Cotton Tee for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Soft Cotton Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Soft Cotton Tee.jpg",
    rating: 4.2,
    reviews: 61,
    stock: 3,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0748",
    name: "Athletic Fit Tee",
    category: "T-Shirts",
    price: 177,
    oldPrice: 212,
    subtitle: "Athletic Fit Tee for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Athletic Fit Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Athletic Fit Tee.jpg",
    rating: 4.8,
    reviews: 53,
    stock: 4,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0749",
    name: "Oversized Plain Tee",
    category: "T-Shirts",
    price: 230,
    oldPrice: 319,
    subtitle: "Oversized Plain Tee for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Oversized Plain Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Oversized Plain Tee.webp",
    rating: 4.4,
    reviews: 45,
    stock: 11,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0750",
    name: "Small Emblem Tee",
    category: "T-Shirts",
    price: 111,
    oldPrice: 141,
    subtitle: "Small Emblem Tee for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Small Emblem Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Small Emblem Tee.jpg",
    rating: 4.4,
    reviews: 10,
    stock: 10,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0751",
    name: "Classic Fit Tee",
    category: "T-Shirts",
    price: 288,
    oldPrice: 398,
    subtitle: "Classic Fit Tee for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Classic Fit Tee. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classic Fit Tee.jpg",
    rating: 4.3,
    reviews: 20,
    stock: 11,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0752",
    name: "V-neck T-shirt — Student Edition 01",
    category: "T-Shirts",
    price: 297,
    oldPrice: 392,
    subtitle: "V-neck T-shirt — Student Edition 01 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "V-neck T-shirt — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/V-neck T-shirt.jpg",
    rating: 4.1,
    reviews: 31,
    stock: 1,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0753",
    name: "Vintage Style T-shirt — Student Edition 02",
    category: "T-Shirts",
    price: 244,
    oldPrice: 338,
    subtitle:
      "Vintage Style T-shirt — Student Edition 02 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Vintage Style T-shirt — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Vintage Style T-shirt.jpg",
    rating: 4.1,
    reviews: 84,
    stock: 5,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0754",
    name: "Basic Everyday Tee — Student Edition 03",
    category: "T-Shirts",
    price: 303,
    oldPrice: 372,
    subtitle:
      "Basic Everyday Tee — Student Edition 03 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Basic Everyday Tee — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Basic Everyday Tee.jpg",
    rating: 4.2,
    reviews: 82,
    stock: 12,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0755",
    name: "Graphic Art T-shirt — Student Edition 04",
    category: "T-Shirts",
    price: 189,
    oldPrice: 268,
    subtitle:
      "Graphic Art T-shirt — Student Edition 04 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Graphic Art T-shirt — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Graphic Art T-shirt.jpg",
    rating: 4.9,
    reviews: 23,
    stock: 2,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0756",
    name: "Crew Neck Tee — Student Edition 05",
    category: "T-Shirts",
    price: 260,
    oldPrice: 339,
    subtitle: "Crew Neck Tee — Student Edition 05 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Crew Neck Tee — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Crew Neck Tee.webp",
    rating: 4.6,
    reviews: 7,
    stock: 1,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0757",
    name: "Study Club Tee — Student Edition 06",
    category: "T-Shirts",
    price: 272,
    oldPrice: 350,
    subtitle: "Study Club Tee — Student Edition 06 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Study Club Tee — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Study Club Tee.jpg",
    rating: 4.9,
    reviews: 38,
    stock: 7,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0758",
    name: "Classic Fit Tee — Student Edition 07",
    category: "T-Shirts",
    price: 298,
    oldPrice: 378,
    subtitle: "Classic Fit Tee — Student Edition 07 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Classic Fit Tee — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classic Fit Tee.jpg",
    rating: 4.0,
    reviews: 16,
    stock: 7,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0759",
    name: "Round Neck T-shirt — Student Edition 08",
    category: "T-Shirts",
    price: 266,
    oldPrice: 318,
    subtitle:
      "Round Neck T-shirt — Student Edition 08 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Round Neck T-shirt — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Round Neck T-shirt.jpg",
    rating: 4.3,
    reviews: 14,
    stock: 2,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0760",
    name: "Pocket T-shirt — Student Edition 09",
    category: "T-Shirts",
    price: 313,
    oldPrice: 381,
    subtitle: "Pocket T-shirt — Student Edition 09 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Pocket T-shirt — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket T-shirt.jpg",
    rating: 4.8,
    reviews: 4,
    stock: 3,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0761",
    name: "Team T-shirt — Student Edition 10",
    category: "T-Shirts",
    price: 167,
    oldPrice: 207,
    subtitle: "Team T-shirt — Student Edition 10 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Team T-shirt — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Team T-shirt.jpg",
    rating: 4.1,
    reviews: 51,
    stock: 5,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0762",
    name: "Lightweight Summer Tee — Student Edition 11",
    category: "T-Shirts",
    price: 177,
    oldPrice: 255,
    subtitle:
      "Lightweight Summer Tee — Student Edition 11 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Lightweight Summer Tee — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Summer Tee.jpg",
    rating: 4.0,
    reviews: 51,
    stock: 8,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0763",
    name: "Sleeveless Sports Tee — Student Edition 12",
    category: "T-Shirts",
    price: 319,
    oldPrice: 430,
    subtitle:
      "Sleeveless Sports Tee — Student Edition 12 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Sleeveless Sports Tee — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sleeveless Sports Tee.jpg",
    rating: 4.3,
    reviews: 16,
    stock: 8,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0764",
    name: "Casual Weekend Tee — Student Edition 13",
    category: "T-Shirts",
    price: 162,
    oldPrice: 235,
    subtitle:
      "Casual Weekend Tee — Student Edition 13 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Casual Weekend Tee — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Casual Weekend Tee.jpg",
    rating: 4.9,
    reviews: 25,
    stock: 4,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0765",
    name: "Small Emblem Tee — Student Edition 14",
    category: "T-Shirts",
    price: 374,
    oldPrice: 445,
    subtitle:
      "Small Emblem Tee — Student Edition 14 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Small Emblem Tee — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Small Emblem Tee.jpg",
    rating: 4.1,
    reviews: 41,
    stock: 1,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0766",
    name: "Striped Cotton T-shirt — Student Edition 15",
    category: "T-Shirts",
    price: 191,
    oldPrice: 240,
    subtitle:
      "Striped Cotton T-shirt — Student Edition 15 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Striped Cotton T-shirt — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Striped Cotton T-shirt.jpg",
    rating: 4.2,
    reviews: 65,
    stock: 10,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0767",
    name: "Long Sleeve T-shirt — Student Edition 16",
    category: "T-Shirts",
    price: 115,
    oldPrice: 162,
    subtitle:
      "Long Sleeve T-shirt — Student Edition 16 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Long Sleeve T-shirt — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Long Sleeve T-shirt.jpg",
    rating: 4.3,
    reviews: 60,
    stock: 4,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0768",
    name: "Campus Event T-shirt — Student Edition 17",
    category: "T-Shirts",
    price: 280,
    oldPrice: 337,
    subtitle:
      "Campus Event T-shirt — Student Edition 17 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Campus Event T-shirt — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Campus Event T-shirt.jpg",
    rating: 4.4,
    reviews: 32,
    stock: 4,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0769",
    name: "Heavyweight Cotton Tee — Student Edition 18",
    category: "T-Shirts",
    price: 215,
    oldPrice: 254,
    subtitle:
      "Heavyweight Cotton Tee — Student Edition 18 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Heavyweight Cotton Tee — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Heavyweight Cotton Tee.jpg",
    rating: 4.4,
    reviews: 8,
    stock: 11,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0770",
    name: "Solid Colour Tee — Student Edition 19",
    category: "T-Shirts",
    price: 132,
    oldPrice: 169,
    subtitle:
      "Solid Colour Tee — Student Edition 19 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Solid Colour Tee — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Solid Colour Tee.jpg",
    rating: 4.2,
    reviews: 75,
    stock: 9,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0771",
    name: "Printed Cotton Tee — Student Edition 20",
    category: "T-Shirts",
    price: 377,
    oldPrice: 544,
    subtitle:
      "Printed Cotton Tee — Student Edition 20 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Printed Cotton Tee — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Printed Cotton Tee.jpg",
    rating: 4.0,
    reviews: 28,
    stock: 7,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0772",
    name: "Oversized Plain Tee — Student Edition 21",
    category: "T-Shirts",
    price: 348,
    oldPrice: 420,
    subtitle:
      "Oversized Plain Tee — Student Edition 21 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Oversized Plain Tee — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Oversized Plain Tee.webp",
    rating: 4.5,
    reviews: 30,
    stock: 9,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0773",
    name: "Minimal Logo T-shirt — Student Edition 22",
    category: "T-Shirts",
    price: 347,
    oldPrice: 426,
    subtitle:
      "Minimal Logo T-shirt — Student Edition 22 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Minimal Logo T-shirt — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Logo T-shirt.jpg",
    rating: 4.2,
    reviews: 17,
    stock: 6,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0774",
    name: "Polo T-shirt — Student Edition 23",
    category: "T-Shirts",
    price: 388,
    oldPrice: 489,
    subtitle: "Polo T-shirt — Student Edition 23 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Polo T-shirt — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Polo T-shirt.jpg",
    rating: 4.2,
    reviews: 73,
    stock: 5,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0775",
    name: "Pastel Cotton T-shirt — Student Edition 24",
    category: "T-Shirts",
    price: 146,
    oldPrice: 191,
    subtitle:
      "Pastel Cotton T-shirt — Student Edition 24 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Pastel Cotton T-shirt — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pastel Cotton T-shirt.jpg",
    rating: 4.6,
    reviews: 58,
    stock: 10,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0776",
    name: "Organic Cotton T-shirt — Student Edition 25",
    category: "T-Shirts",
    price: 197,
    oldPrice: 256,
    subtitle:
      "Organic Cotton T-shirt — Student Edition 25 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Organic Cotton T-shirt — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Organic Cotton T-shirt.jpg",
    rating: 4.5,
    reviews: 68,
    stock: 8,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0777",
    name: "Classic Striped Tee — Student Edition 26",
    category: "T-Shirts",
    price: 300,
    oldPrice: 373,
    subtitle:
      "Classic Striped Tee — Student Edition 26 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Classic Striped Tee — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classic Striped Tee.jpg",
    rating: 4.4,
    reviews: 50,
    stock: 11,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0778",
    name: "Relaxed Campus Tee — Student Edition 27",
    category: "T-Shirts",
    price: 197,
    oldPrice: 235,
    subtitle:
      "Relaxed Campus Tee — Student Edition 27 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Relaxed Campus Tee — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Relaxed Campus Tee.jpg",
    rating: 4.5,
    reviews: 42,
    stock: 11,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0779",
    name: "Athletic Fit Tee — Student Edition 28",
    category: "T-Shirts",
    price: 234,
    oldPrice: 312,
    subtitle:
      "Athletic Fit Tee — Student Edition 28 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Athletic Fit Tee — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Athletic Fit Tee.jpg",
    rating: 4.7,
    reviews: 78,
    stock: 10,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0780",
    name: "College Club T-shirt — Student Edition 29",
    category: "T-Shirts",
    price: 231,
    oldPrice: 285,
    subtitle:
      "College Club T-shirt — Student Edition 29 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "College Club T-shirt — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College Club T-shirt.jpg",
    rating: 4.3,
    reviews: 64,
    stock: 10,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0781",
    name: "Quick Dry T-shirt — Student Edition 30",
    category: "T-Shirts",
    price: 279,
    oldPrice: 345,
    subtitle:
      "Quick Dry T-shirt — Student Edition 30 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Quick Dry T-shirt — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Quick Dry T-shirt.jpg",
    rating: 4.5,
    reviews: 84,
    stock: 5,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0782",
    name: "Monochrome T-shirt — Student Edition 31",
    category: "T-Shirts",
    price: 117,
    oldPrice: 159,
    subtitle:
      "Monochrome T-shirt — Student Edition 31 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Monochrome T-shirt — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Monochrome T-shirt.jpg",
    rating: 4.4,
    reviews: 29,
    stock: 7,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0783",
    name: "Henley T-shirt — Student Edition 32",
    category: "T-Shirts",
    price: 273,
    oldPrice: 363,
    subtitle: "Henley T-shirt — Student Edition 32 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Henley T-shirt — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Henley T-shirt.jpg",
    rating: 4.6,
    reviews: 76,
    stock: 9,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0784",
    name: "Retro College Tee — Student Edition 33",
    category: "T-Shirts",
    price: 110,
    oldPrice: 143,
    subtitle:
      "Retro College Tee — Student Edition 33 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Retro College Tee — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Retro College Tee.jpg",
    rating: 4.6,
    reviews: 81,
    stock: 10,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0785",
    name: "Pocket Logo Tee — Student Edition 34",
    category: "T-Shirts",
    price: 235,
    oldPrice: 310,
    subtitle: "Pocket Logo Tee — Student Edition 34 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Pocket Logo Tee — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pocket Logo Tee.jpg",
    rating: 4.5,
    reviews: 42,
    stock: 7,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0786",
    name: "Soft Cotton Tee — Student Edition 35",
    category: "T-Shirts",
    price: 224,
    oldPrice: 313,
    subtitle: "Soft Cotton Tee — Student Edition 35 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Soft Cotton Tee — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Soft Cotton Tee.jpg",
    rating: 4.7,
    reviews: 54,
    stock: 4,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0787",
    name: "Oversized Graphic T-shirt — Student Edition 36",
    category: "T-Shirts",
    price: 207,
    oldPrice: 261,
    subtitle:
      "Oversized Graphic T-shirt — Student Edition 36 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Oversized Graphic T-shirt — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Oversized Graphic T-shirt.jpg",
    rating: 4.3,
    reviews: 74,
    stock: 11,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0788",
    name: "Sports Training T-shirt — Student Edition 37",
    category: "T-Shirts",
    price: 313,
    oldPrice: 419,
    subtitle:
      "Sports Training T-shirt — Student Edition 37 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Sports Training T-shirt — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sports Training T-shirt.jpg",
    rating: 4.4,
    reviews: 79,
    stock: 2,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0789",
    name: "Abstract Print T-shirt — Student Edition 38",
    category: "T-Shirts",
    price: 312,
    oldPrice: 408,
    subtitle:
      "Abstract Print T-shirt — Student Edition 38 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Abstract Print T-shirt — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Abstract Print T-shirt.jpg",
    rating: 4.5,
    reviews: 55,
    stock: 9,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0790",
    name: "Raglan Sleeve T-shirt — Student Edition 39",
    category: "T-Shirts",
    price: 153,
    oldPrice: 207,
    subtitle:
      "Raglan Sleeve T-shirt — Student Edition 39 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Raglan Sleeve T-shirt — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Raglan Sleeve T-shirt.jpg",
    rating: 4.8,
    reviews: 27,
    stock: 2,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0791",
    name: "Nature Print T-shirt — Student Edition 40",
    category: "T-Shirts",
    price: 186,
    oldPrice: 253,
    subtitle:
      "Nature Print T-shirt — Student Edition 40 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Nature Print T-shirt — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Nature Print T-shirt.jpg",
    rating: 4.4,
    reviews: 66,
    stock: 8,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0792",
    name: "Contrast Sleeve Tee — Student Edition 41",
    category: "T-Shirts",
    price: 170,
    oldPrice: 227,
    subtitle:
      "Contrast Sleeve Tee — Student Edition 41 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Contrast Sleeve Tee — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Contrast Sleeve Tee.jpg",
    rating: 4.8,
    reviews: 16,
    stock: 8,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0793",
    name: "Everyday Layering Tee — Student Edition 42",
    category: "T-Shirts",
    price: 103,
    oldPrice: 144,
    subtitle:
      "Everyday Layering Tee — Student Edition 42 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Everyday Layering Tee — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Everyday Layering Tee.jpg",
    rating: 4.6,
    reviews: 73,
    stock: 8,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0794",
    name: "Plain Cotton T-shirt — Student Edition 43",
    category: "T-Shirts",
    price: 397,
    oldPrice: 501,
    subtitle:
      "Plain Cotton T-shirt — Student Edition 43 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Plain Cotton T-shirt — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Plain Cotton T-shirt.webp",
    rating: 4.1,
    reviews: 16,
    stock: 6,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0795",
    name: "Relaxed Fit T-shirt — Student Edition 44",
    category: "T-Shirts",
    price: 359,
    oldPrice: 462,
    subtitle:
      "Relaxed Fit T-shirt — Student Edition 44 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Relaxed Fit T-shirt — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Relaxed Fit T-shirt.jpg",
    rating: 4.5,
    reviews: 64,
    stock: 6,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0796",
    name: "Typography T-shirt — Student Edition 45",
    category: "T-Shirts",
    price: 277,
    oldPrice: 369,
    subtitle:
      "Typography T-shirt — Student Edition 45 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Typography T-shirt — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Typography T-shirt.jpg",
    rating: 4.1,
    reviews: 66,
    stock: 1,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0797",
    name: "Boxy Fit T-shirt — Student Edition 46",
    category: "T-Shirts",
    price: 172,
    oldPrice: 245,
    subtitle:
      "Boxy Fit T-shirt — Student Edition 46 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Boxy Fit T-shirt — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Boxy Fit T-shirt.jpg",
    rating: 4.4,
    reviews: 61,
    stock: 12,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0798",
    name: "Minimal Line Art Tee — Student Edition 47",
    category: "T-Shirts",
    price: 366,
    oldPrice: 473,
    subtitle:
      "Minimal Line Art Tee — Student Edition 47 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Minimal Line Art Tee — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Line Art Tee.jpg",
    rating: 4.4,
    reviews: 50,
    stock: 2,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0799",
    name: "Drop Shoulder Tee — Student Edition 48",
    category: "T-Shirts",
    price: 349,
    oldPrice: 494,
    subtitle:
      "Drop Shoulder Tee — Student Edition 48 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Drop Shoulder Tee — Student Edition 48. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Drop Shoulder Tee.jpg",
    rating: 4.8,
    reviews: 49,
    stock: 1,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0800",
    name: "Student Society Tee — Student Edition 49",
    category: "T-Shirts",
    price: 360,
    oldPrice: 490,
    subtitle:
      "Student Society Tee — Student Edition 49 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Student Society Tee — Student Edition 49. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Student Society Tee..jpg",
    rating: 4.3,
    reviews: 9,
    stock: 3,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0801",
    name: "Classic Campus T-shirt — Student Edition 50",
    category: "T-Shirts",
    price: 251,
    oldPrice: 303,
    subtitle:
      "Classic Campus T-shirt — Student Edition 50 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Classic Campus T-shirt — Student Edition 50. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Classic Campus T-shirt.jpg",
    rating: 4.3,
    reviews: 76,
    stock: 10,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0802",
    name: "Laptop Backpack",
    category: "Bags",
    price: 435,
    oldPrice: 578,
    subtitle: "Laptop Backpack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Laptop Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Backpack.jpg",
    rating: 4.0,
    reviews: 14,
    stock: 1,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0803",
    name: "Canvas Tote Bag",
    category: "Bags",
    price: 124,
    oldPrice: 150,
    subtitle: "Canvas Tote Bag for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Canvas Tote Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tote Bag.jpg",
    rating: 4.6,
    reviews: 7,
    stock: 3,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0804",
    name: "Messenger Bag",
    category: "Bags",
    price: 773,
    oldPrice: 1012,
    subtitle: "Messenger Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Messenger Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Messenger Bag.jpg",
    rating: 4.1,
    reviews: 19,
    stock: 3,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0805",
    name: "Sling Bag",
    category: "Bags",
    price: 244,
    oldPrice: 320,
    subtitle: "Sling Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Sling Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sling Bag.jpg",
    rating: 4.0,
    reviews: 79,
    stock: 8,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0806",
    name: "Mini Backpack",
    category: "Bags",
    price: 133,
    oldPrice: 190,
    subtitle: "Mini Backpack for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Mini Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Backpack.jpg",
    rating: 4.8,
    reviews: 4,
    stock: 6,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0807",
    name: "Travel Duffel Bag",
    category: "Bags",
    price: 395,
    oldPrice: 505,
    subtitle: "Travel Duffel Bag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Travel Duffel Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Duffel Bag #U2014 Student.jpg",
    rating: 4.5,
    reviews: 23,
    stock: 4,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0808",
    name: "Gym Drawstring Bag",
    category: "Bags",
    price: 689,
    oldPrice: 881,
    subtitle: "Gym Drawstring Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Gym Drawstring Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gym Drawstring Bag.jpg",
    rating: 4.8,
    reviews: 19,
    stock: 10,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0809",
    name: "Laptop Messenger Bag",
    category: "Bags",
    price: 395,
    oldPrice: 471,
    subtitle: "Laptop Messenger Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Laptop Messenger Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Messenger Bag.webp",
    rating: 4.1,
    reviews: 63,
    stock: 2,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0810",
    name: "Water-resistant Backpack",
    category: "Bags",
    price: 291,
    oldPrice: 400,
    subtitle: "Water-resistant Backpack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Water-resistant Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Water-resistant Backpack.jpg",
    rating: 4.1,
    reviews: 49,
    stock: 6,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0811",
    name: "Book Carry Bag",
    category: "Bags",
    price: 360,
    oldPrice: 434,
    subtitle: "Book Carry Bag for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Book Carry Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Carry Bag.jpg",
    rating: 4.4,
    reviews: 30,
    stock: 11,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0812",
    name: "Foldable Shopping Bag",
    category: "Bags",
    price: 247,
    oldPrice: 294,
    subtitle: "Foldable Shopping Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Foldable Shopping Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Shopping Bag.jpg",
    rating: 4.3,
    reviews: 75,
    stock: 5,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0813",
    name: "Lunch Tote Bag",
    category: "Bags",
    price: 419,
    oldPrice: 596,
    subtitle: "Lunch Tote Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Lunch Tote Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lunch Tote Bag.jpg",
    rating: 4.2,
    reviews: 17,
    stock: 9,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0814",
    name: "Pencil Case Bag",
    category: "Bags",
    price: 193,
    oldPrice: 259,
    subtitle: "Pencil Case Bag for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Pencil Case Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pencil Case Bag.jpg",
    rating: 4.5,
    reviews: 46,
    stock: 6,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0815",
    name: "Document Bag",
    category: "Bags",
    price: 518,
    oldPrice: 737,
    subtitle: "Document Bag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Document Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Bag.webp",
    rating: 4.8,
    reviews: 85,
    stock: 4,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0816",
    name: "Crossbody Bag",
    category: "Bags",
    price: 148,
    oldPrice: 181,
    subtitle: "Crossbody Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Crossbody Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Crossbody Bag.webp",
    rating: 4.3,
    reviews: 37,
    stock: 4,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0817",
    name: "Compact Shoulder Bag",
    category: "Bags",
    price: 246,
    oldPrice: 299,
    subtitle: "Compact Shoulder Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Compact Shoulder Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Shoulder Bag.jpg",
    rating: 4.6,
    reviews: 73,
    stock: 2,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0818",
    name: "Sports Backpack",
    category: "Bags",
    price: 158,
    oldPrice: 206,
    subtitle: "Sports Backpack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Sports Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sports Backpack.jpg",
    rating: 4.2,
    reviews: 48,
    stock: 3,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0819",
    name: "Roll-top Backpack",
    category: "Bags",
    price: 395,
    oldPrice: 505,
    subtitle: "Roll-top Backpack for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Roll-top Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Roll-top Backpack.jpg",
    rating: 4.5,
    reviews: 28,
    stock: 12,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0820",
    name: "Lightweight Daypack",
    category: "Bags",
    price: 663,
    oldPrice: 821,
    subtitle: "Lightweight Daypack for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Lightweight Daypack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Daypack.webp",
    rating: 4.3,
    reviews: 29,
    stock: 10,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0821",
    name: "Padded Laptop Bag",
    category: "Bags",
    price: 431,
    oldPrice: 575,
    subtitle: "Padded Laptop Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Padded Laptop Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Padded Laptop Bag.jpg",
    rating: 4.2,
    reviews: 16,
    stock: 5,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0822",
    name: "College Tote",
    category: "Bags",
    price: 357,
    oldPrice: 510,
    subtitle: "College Tote for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "College Tote. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College Tote.jpg",
    rating: 4.2,
    reviews: 23,
    stock: 10,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0823",
    name: "Weekend Travel Bag",
    category: "Bags",
    price: 470,
    oldPrice: 597,
    subtitle: "Weekend Travel Bag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Weekend Travel Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Weekend Travel Bag.jpg",
    rating: 4.1,
    reviews: 86,
    stock: 7,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0824",
    name: "Organizer Backpack",
    category: "Bags",
    price: 558,
    oldPrice: 756,
    subtitle: "Organizer Backpack for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Organizer Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Organizer Backpack.jpg",
    rating: 4.1,
    reviews: 75,
    stock: 9,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0825",
    name: "Anti-splash Backpack",
    category: "Bags",
    price: 615,
    oldPrice: 771,
    subtitle: "Anti-splash Backpack for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Anti-splash Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Anti-splash Backpack.jpg",
    rating: 4.7,
    reviews: 40,
    stock: 9,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0826",
    name: "Minimal Canvas Backpack",
    category: "Bags",
    price: 257,
    oldPrice: 342,
    subtitle: "Minimal Canvas Backpack for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Minimal Canvas Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Canvas Backpack.jpg",
    rating: 4.5,
    reviews: 81,
    stock: 10,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0827",
    name: "Zip-top Tote",
    category: "Bags",
    price: 415,
    oldPrice: 530,
    subtitle: "Zip-top Tote for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Zip-top Tote. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Zip-top Tote.jpg",
    rating: 4.3,
    reviews: 55,
    stock: 4,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0828",
    name: "Multi-pocket Backpack",
    category: "Bags",
    price: 776,
    oldPrice: 957,
    subtitle: "Multi-pocket Backpack for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Multi-pocket Backpack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multi-pocket Backpack.jpg",
    rating: 4.6,
    reviews: 74,
    stock: 10,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0829",
    name: "Slim Laptop Sleeve Bag",
    category: "Bags",
    price: 575,
    oldPrice: 711,
    subtitle: "Slim Laptop Sleeve Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Slim Laptop Sleeve Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Slim Laptop Sleeve Bag.jpg",
    rating: 4.4,
    reviews: 68,
    stock: 2,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0830",
    name: "Utility Sling Bag",
    category: "Bags",
    price: 608,
    oldPrice: 735,
    subtitle: "Utility Sling Bag for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Utility Sling Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Utility Sling Bag.jpg",
    rating: 4.5,
    reviews: 82,
    stock: 11,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0831",
    name: "Gym Duffle",
    category: "Bags",
    price: 136,
    oldPrice: 166,
    subtitle: "Gym Duffle for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Gym Duffle. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gym Duffle.jpg",
    rating: 4.5,
    reviews: 29,
    stock: 11,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0832",
    name: "Reusable Grocery Tote",
    category: "Bags",
    price: 512,
    oldPrice: 705,
    subtitle: "Reusable Grocery Tote for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Reusable Grocery Tote. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Grocery Tote.jpg",
    rating: 4.6,
    reviews: 76,
    stock: 1,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0833",
    name: "Large Book Tote",
    category: "Bags",
    price: 257,
    oldPrice: 343,
    subtitle: "Large Book Tote for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Large Book Tote. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Large Book Tote.jpg",
    rating: 4.2,
    reviews: 11,
    stock: 2,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0834",
    name: "Compact Crossbody",
    category: "Bags",
    price: 621,
    oldPrice: 782,
    subtitle: "Compact Crossbody for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Compact Crossbody. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Crossbody.jpg",
    rating: 4.5,
    reviews: 67,
    stock: 7,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0835",
    name: "School Satchel",
    category: "Bags",
    price: 180,
    oldPrice: 242,
    subtitle: "School Satchel for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "School Satchel. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/School Satchel.jpg",
    rating: 4.8,
    reviews: 85,
    stock: 8,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0836",
    name: "Travel Organizer Bag",
    category: "Bags",
    price: 231,
    oldPrice: 298,
    subtitle: "Travel Organizer Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Travel Organizer Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Organizer Bag.webp",
    rating: 4.6,
    reviews: 10,
    stock: 1,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0837",
    name: "Laptop Briefcase",
    category: "Bags",
    price: 478,
    oldPrice: 636,
    subtitle: "Laptop Briefcase for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Laptop Briefcase. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Briefcase.webp",
    rating: 4.6,
    reviews: 16,
    stock: 8,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0838",
    name: "Messenger Satchel",
    category: "Bags",
    price: 338,
    oldPrice: 445,
    subtitle: "Messenger Satchel for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Messenger Satchel. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Messenger Satchel.jpg",
    rating: 4.1,
    reviews: 52,
    stock: 10,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0839",
    name: "Drawstring Sports Bag",
    category: "Bags",
    price: 430,
    oldPrice: 579,
    subtitle: "Drawstring Sports Bag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Drawstring Sports Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Drawstring Sports Bag.jpg",
    rating: 4.1,
    reviews: 59,
    stock: 10,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0840",
    name: "Foldable Daypack",
    category: "Bags",
    price: 133,
    oldPrice: 164,
    subtitle: "Foldable Daypack for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Foldable Daypack. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Daypack.jpg",
    rating: 4.4,
    reviews: 3,
    stock: 7,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0841",
    name: "Water Bottle Side Bag",
    category: "Bags",
    price: 233,
    oldPrice: 311,
    subtitle: "Water Bottle Side Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Water Bottle Side Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Water Bottle Side Bag.jpg",
    rating: 4.8,
    reviews: 66,
    stock: 6,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0842",
    name: "Camera Shoulder Bag",
    category: "Bags",
    price: 775,
    oldPrice: 1098,
    subtitle: "Camera Shoulder Bag for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Camera Shoulder Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Camera Shoulder Bag.jpg",
    rating: 4.0,
    reviews: 77,
    stock: 4,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0843",
    name: "Canvas Messenger Bag",
    category: "Bags",
    price: 271,
    oldPrice: 368,
    subtitle: "Canvas Messenger Bag for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Canvas Messenger Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Messenger Bag.jpg",
    rating: 4.7,
    reviews: 81,
    stock: 4,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0844",
    name: "Everyday Carry Bag",
    category: "Bags",
    price: 563,
    oldPrice: 762,
    subtitle: "Everyday Carry Bag for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Everyday Carry Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Everyday Carry Bag.jpg",
    rating: 4.5,
    reviews: 54,
    stock: 8,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0845",
    name: "Lightweight Tote",
    category: "Bags",
    price: 720,
    oldPrice: 860,
    subtitle: "Lightweight Tote for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Lightweight Tote. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Tote.jpg",
    rating: 4.7,
    reviews: 48,
    stock: 9,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0846",
    name: "Padded Tablet Bag",
    category: "Bags",
    price: 328,
    oldPrice: 396,
    subtitle: "Padded Tablet Bag for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Padded Tablet Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Padded Tablet Bag.jpg",
    rating: 4.4,
    reviews: 34,
    stock: 10,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0847",
    name: "Multi-use Utility Bag",
    category: "Bags",
    price: 333,
    oldPrice: 428,
    subtitle: "Multi-use Utility Bag for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Multi-use Utility Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multi-use Utility Bag.jpg",
    rating: 4.8,
    reviews: 30,
    stock: 3,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0848",
    name: "Small Crossbody Pouch",
    category: "Bags",
    price: 571,
    oldPrice: 803,
    subtitle: "Small Crossbody Pouch for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Small Crossbody Pouch. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Small Crossbody Pouch.jpg",
    rating: 4.2,
    reviews: 64,
    stock: 8,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0849",
    name: "Travel Toiletry Bag",
    category: "Bags",
    price: 163,
    oldPrice: 192,
    subtitle: "Travel Toiletry Bag for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Travel Toiletry Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Toiletry Bag.jpg",
    rating: 4.2,
    reviews: 70,
    stock: 10,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0850",
    name: "Compact Duffel Bag",
    category: "Bags",
    price: 121,
    oldPrice: 170,
    subtitle: "Compact Duffel Bag for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Compact Duffel Bag. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Duffel Bag.jpg",
    rating: 4.9,
    reviews: 76,
    stock: 10,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0851",
    name: "Gym Drawstring Bag — Student Edition 01",
    category: "Bags",
    price: 118,
    oldPrice: 158,
    subtitle:
      "Gym Drawstring Bag — Student Edition 01 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Gym Drawstring Bag — Student Edition 01. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gym Drawstring Bag.jpg",
    rating: 4.5,
    reviews: 20,
    stock: 5,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0852",
    name: "Document Bag — Student Edition 02",
    category: "Bags",
    price: 636,
    oldPrice: 890,
    subtitle: "Document Bag — Student Edition 02 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Document Bag — Student Edition 02. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Document Bag.webp",
    rating: 4.5,
    reviews: 60,
    stock: 7,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0853",
    name: "College Tote — Student Edition 03",
    category: "Bags",
    price: 383,
    oldPrice: 494,
    subtitle: "College Tote — Student Edition 03 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "College Tote — Student Edition 03. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/College Tote.jpg",
    rating: 4.1,
    reviews: 75,
    stock: 2,
    seller: "Campus Seller 38",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0854",
    name: "Slim Laptop Sleeve Bag — Student Edition 04",
    category: "Bags",
    price: 606,
    oldPrice: 865,
    subtitle:
      "Slim Laptop Sleeve Bag — Student Edition 04 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Slim Laptop Sleeve Bag — Student Edition 04. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Slim Laptop Sleeve Bag.jpg",
    rating: 4.8,
    reviews: 77,
    stock: 3,
    seller: "Campus Seller 39",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0855",
    name: "Travel Organizer Bag — Student Edition 05",
    category: "Bags",
    price: 572,
    oldPrice: 713,
    subtitle:
      "Travel Organizer Bag — Student Edition 05 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Travel Organizer Bag — Student Edition 05. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Organizer Bag.webp",
    rating: 4.5,
    reviews: 42,
    stock: 7,
    seller: "Campus Seller 40",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0856",
    name: "Canvas Messenger Bag — Student Edition 06",
    category: "Bags",
    price: 202,
    oldPrice: 250,
    subtitle:
      "Canvas Messenger Bag — Student Edition 06 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Canvas Messenger Bag — Student Edition 06. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Messenger Bag.jpg",
    rating: 4.5,
    reviews: 54,
    stock: 7,
    seller: "Campus Seller 41",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0857",
    name: "Compact Duffel Bag — Student Edition 07",
    category: "Bags",
    price: 434,
    oldPrice: 625,
    subtitle:
      "Compact Duffel Bag — Student Edition 07 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Compact Duffel Bag — Student Edition 07. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Duffel Bag.jpg",
    rating: 4.3,
    reviews: 18,
    stock: 4,
    seller: "Campus Seller 42",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0858",
    name: "Travel Duffel Bag — Student Edition 08",
    category: "Bags",
    price: 210,
    oldPrice: 278,
    subtitle:
      "Travel Duffel Bag — Student Edition 08 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Travel Duffel Bag — Student Edition 08. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Duffel Bag #U2014 Student.jpg",
    rating: 4.4,
    reviews: 20,
    stock: 6,
    seller: "Campus Seller 43",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0859",
    name: "Pencil Case Bag — Student Edition 09",
    category: "Bags",
    price: 316,
    oldPrice: 422,
    subtitle: "Pencil Case Bag — Student Edition 09 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Pencil Case Bag — Student Edition 09. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Pencil Case Bag.jpg",
    rating: 4.8,
    reviews: 54,
    stock: 9,
    seller: "Campus Seller 44",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0860",
    name: "Padded Laptop Bag — Student Edition 10",
    category: "Bags",
    price: 458,
    oldPrice: 558,
    subtitle:
      "Padded Laptop Bag — Student Edition 10 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Padded Laptop Bag — Student Edition 10. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Padded Laptop Bag.jpg",
    rating: 4.7,
    reviews: 55,
    stock: 3,
    seller: "Campus Seller 45",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0861",
    name: "Multi-pocket Backpack — Student Edition 11",
    category: "Bags",
    price: 572,
    oldPrice: 807,
    subtitle:
      "Multi-pocket Backpack — Student Edition 11 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Multi-pocket Backpack — Student Edition 11. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multi-pocket Backpack.jpg",
    rating: 4.4,
    reviews: 34,
    stock: 9,
    seller: "Campus Seller 46",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0862",
    name: "School Satchel — Student Edition 12",
    category: "Bags",
    price: 200,
    oldPrice: 267,
    subtitle: "School Satchel — Student Edition 12 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "School Satchel — Student Edition 12. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/School Satchel.jpg",
    rating: 4.4,
    reviews: 47,
    stock: 9,
    seller: "Campus Seller 47",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0863",
    name: "Camera Shoulder Bag — Student Edition 13",
    category: "Bags",
    price: 414,
    oldPrice: 554,
    subtitle:
      "Camera Shoulder Bag — Student Edition 13 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Camera Shoulder Bag — Student Edition 13. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Camera Shoulder Bag.jpg",
    rating: 4.2,
    reviews: 73,
    stock: 12,
    seller: "Campus Seller 48",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0864",
    name: "Travel Toiletry Bag — Student Edition 14",
    category: "Bags",
    price: 485,
    oldPrice: 612,
    subtitle:
      "Travel Toiletry Bag — Student Edition 14 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Travel Toiletry Bag — Student Edition 14. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Travel Toiletry Bag.jpg",
    rating: 4.3,
    reviews: 21,
    stock: 4,
    seller: "Campus Seller 01",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0865",
    name: "Mini Backpack — Student Edition 15",
    category: "Bags",
    price: 335,
    oldPrice: 431,
    subtitle: "Mini Backpack — Student Edition 15 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Mini Backpack — Student Edition 15. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Mini Backpack.jpg",
    rating: 4.5,
    reviews: 69,
    stock: 9,
    seller: "Campus Seller 02",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0866",
    name: "Lunch Tote Bag — Student Edition 16",
    category: "Bags",
    price: 623,
    oldPrice: 890,
    subtitle: "Lunch Tote Bag — Student Edition 16 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Lunch Tote Bag — Student Edition 16. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lunch Tote Bag.jpg",
    rating: 4.1,
    reviews: 67,
    stock: 2,
    seller: "Campus Seller 03",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0867",
    name: "Lightweight Daypack — Student Edition 17",
    category: "Bags",
    price: 491,
    oldPrice: 689,
    subtitle:
      "Lightweight Daypack — Student Edition 17 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Lightweight Daypack — Student Edition 17. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Daypack.webp",
    rating: 4.5,
    reviews: 5,
    stock: 2,
    seller: "Campus Seller 04",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0868",
    name: "Zip-top Tote — Student Edition 18",
    category: "Bags",
    price: 148,
    oldPrice: 191,
    subtitle: "Zip-top Tote — Student Edition 18 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Zip-top Tote — Student Edition 18. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Zip-top Tote.jpg",
    rating: 4.5,
    reviews: 31,
    stock: 11,
    seller: "Campus Seller 05",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0869",
    name: "Compact Crossbody — Student Edition 19",
    category: "Bags",
    price: 437,
    oldPrice: 564,
    subtitle:
      "Compact Crossbody — Student Edition 19 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Compact Crossbody — Student Edition 19. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Crossbody.jpg",
    rating: 4.6,
    reviews: 72,
    stock: 1,
    seller: "Campus Seller 06",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0870",
    name: "Water Bottle Side Bag — Student Edition 20",
    category: "Bags",
    price: 755,
    oldPrice: 941,
    subtitle:
      "Water Bottle Side Bag — Student Edition 20 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Water Bottle Side Bag — Student Edition 20. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Water Bottle Side Bag.jpg",
    rating: 4.2,
    reviews: 12,
    stock: 9,
    seller: "Campus Seller 07",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0871",
    name: "Small Crossbody Pouch — Student Edition 21",
    category: "Bags",
    price: 504,
    oldPrice: 642,
    subtitle:
      "Small Crossbody Pouch — Student Edition 21 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Small Crossbody Pouch — Student Edition 21. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Small Crossbody Pouch.jpg",
    rating: 4.7,
    reviews: 16,
    stock: 11,
    seller: "Campus Seller 08",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0872",
    name: "Sling Bag — Student Edition 22",
    category: "Bags",
    price: 332,
    oldPrice: 441,
    subtitle: "Sling Bag — Student Edition 22 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Sling Bag — Student Edition 22. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sling Bag.jpg",
    rating: 4.1,
    reviews: 44,
    stock: 6,
    seller: "Campus Seller 09",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0873",
    name: "Foldable Shopping Bag — Student Edition 23",
    category: "Bags",
    price: 470,
    oldPrice: 572,
    subtitle:
      "Foldable Shopping Bag — Student Edition 23 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Foldable Shopping Bag — Student Edition 23. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Shopping Bag.jpg",
    rating: 4.9,
    reviews: 4,
    stock: 4,
    seller: "Campus Seller 10",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0874",
    name: "Roll-top Backpack — Student Edition 24",
    category: "Bags",
    price: 752,
    oldPrice: 993,
    subtitle:
      "Roll-top Backpack — Student Edition 24 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Roll-top Backpack — Student Edition 24. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Roll-top Backpack.jpg",
    rating: 4.6,
    reviews: 74,
    stock: 8,
    seller: "Campus Seller 11",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0875",
    name: "Minimal Canvas Backpack — Student Edition 25",
    category: "Bags",
    price: 612,
    oldPrice: 805,
    subtitle:
      "Minimal Canvas Backpack — Student Edition 25 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Minimal Canvas Backpack — Student Edition 25. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Minimal Canvas Backpack.jpg",
    rating: 4.9,
    reviews: 14,
    stock: 2,
    seller: "Campus Seller 12",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0876",
    name: "Large Book Tote — Student Edition 26",
    category: "Bags",
    price: 758,
    oldPrice: 1041,
    subtitle: "Large Book Tote — Student Edition 26 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Large Book Tote — Student Edition 26. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Large Book Tote.jpg",
    rating: 4.5,
    reviews: 50,
    stock: 11,
    seller: "Campus Seller 13",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0877",
    name: "Foldable Daypack — Student Edition 27",
    category: "Bags",
    price: 570,
    oldPrice: 707,
    subtitle:
      "Foldable Daypack — Student Edition 27 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Foldable Daypack — Student Edition 27. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Foldable Daypack.jpg",
    rating: 4.7,
    reviews: 27,
    stock: 1,
    seller: "Campus Seller 14",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0878",
    name: "Multi-use Utility Bag — Student Edition 28",
    category: "Bags",
    price: 258,
    oldPrice: 360,
    subtitle:
      "Multi-use Utility Bag — Student Edition 28 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Multi-use Utility Bag — Student Edition 28. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Multi-use Utility Bag.jpg",
    rating: 4.3,
    reviews: 66,
    stock: 11,
    seller: "Campus Seller 15",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0879",
    name: "Messenger Bag — Student Edition 29",
    category: "Bags",
    price: 698,
    oldPrice: 838,
    subtitle: "Messenger Bag — Student Edition 29 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Messenger Bag — Student Edition 29. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Canvas Messenger Bag.jpg",
    rating: 4.2,
    reviews: 13,
    stock: 4,
    seller: "Campus Seller 16",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0880",
    name: "Book Carry Bag — Student Edition 30",
    category: "Bags",
    price: 155,
    oldPrice: 225,
    subtitle: "Book Carry Bag — Student Edition 30 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Book Carry Bag — Student Edition 30. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Book Carry Bag.jpg",
    rating: 4.4,
    reviews: 84,
    stock: 9,
    seller: "Campus Seller 17",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0881",
    name: "Sports Backpack — Student Edition 31",
    category: "Bags",
    price: 600,
    oldPrice: 816,
    subtitle: "Sports Backpack — Student Edition 31 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Sports Backpack — Student Edition 31. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Sports Backpack.jpg",
    rating: 4.1,
    reviews: 9,
    stock: 8,
    seller: "Campus Seller 18",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0882",
    name: "Anti-splash Backpack — Student Edition 32",
    category: "Bags",
    price: 464,
    oldPrice: 672,
    subtitle:
      "Anti-splash Backpack — Student Edition 32 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Anti-splash Backpack — Student Edition 32. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Anti-splash Backpack.jpg",
    rating: 4.6,
    reviews: 84,
    stock: 11,
    seller: "Campus Seller 19",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0883",
    name: "Reusable Grocery Tote — Student Edition 33",
    category: "Bags",
    price: 293,
    oldPrice: 390,
    subtitle:
      "Reusable Grocery Tote — Student Edition 33 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Reusable Grocery Tote — Student Edition 33. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Reusable Grocery Tote.jpg",
    rating: 4.0,
    reviews: 31,
    stock: 4,
    seller: "Campus Seller 20",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0884",
    name: "Drawstring Sports Bag — Student Edition 34",
    category: "Bags",
    price: 486,
    oldPrice: 683,
    subtitle:
      "Drawstring Sports Bag — Student Edition 34 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Drawstring Sports Bag — Student Edition 34. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Drawstring Sports Bag.jpg",
    rating: 4.9,
    reviews: 67,
    stock: 1,
    seller: "Campus Seller 21",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0885",
    name: "Padded Tablet Bag — Student Edition 35",
    category: "Bags",
    price: 549,
    oldPrice: 702,
    subtitle:
      "Padded Tablet Bag — Student Edition 35 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Padded Tablet Bag — Student Edition 35. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Padded Tablet Bag.jpg",
    rating: 4.2,
    reviews: 59,
    stock: 7,
    seller: "Campus Seller 22",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0886",
    name: "Canvas Tote Bag — Student Edition 36",
    category: "Bags",
    price: 433,
    oldPrice: 533,
    subtitle: "Canvas Tote Bag — Student Edition 36 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Canvas Tote Bag — Student Edition 36. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Tote Bag.jpg",
    rating: 4.5,
    reviews: 85,
    stock: 3,
    seller: "Campus Seller 23",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0887",
    name: "Water-resistant Backpack — Student Edition 37",
    category: "Bags",
    price: 148,
    oldPrice: 194,
    subtitle:
      "Water-resistant Backpack — Student Edition 37 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Water-resistant Backpack — Student Edition 37. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Water-resistant Backpack.jpg",
    rating: 4.4,
    reviews: 28,
    stock: 10,
    seller: "Campus Seller 24",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0888",
    name: "Compact Shoulder Bag — Student Edition 38",
    category: "Bags",
    price: 727,
    oldPrice: 874,
    subtitle:
      "Compact Shoulder Bag — Student Edition 38 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Compact Shoulder Bag — Student Edition 38. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Compact Shoulder Bag.jpg",
    rating: 4.6,
    reviews: 9,
    stock: 7,
    seller: "Campus Seller 25",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0889",
    name: "Organizer Backpack — Student Edition 39",
    category: "Bags",
    price: 501,
    oldPrice: 678,
    subtitle:
      "Organizer Backpack — Student Edition 39 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Organizer Backpack — Student Edition 39. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Organizer Backpack.jpg",
    rating: 4.2,
    reviews: 56,
    stock: 5,
    seller: "Campus Seller 26",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0890",
    name: "Gym Duffle — Student Edition 40",
    category: "Bags",
    price: 750,
    oldPrice: 895,
    subtitle: "Gym Duffle — Student Edition 40 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Gym Duffle — Student Edition 40. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Gym Duffle.jpg",
    rating: 4.0,
    reviews: 19,
    stock: 1,
    seller: "Campus Seller 27",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0891",
    name: "Messenger Satchel — Student Edition 41",
    category: "Bags",
    price: 134,
    oldPrice: 194,
    subtitle:
      "Messenger Satchel — Student Edition 41 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Messenger Satchel — Student Edition 41. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Messenger Satchel.jpg",
    rating: 4.4,
    reviews: 82,
    stock: 12,
    seller: "Campus Seller 28",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0892",
    name: "Lightweight Tote — Student Edition 42",
    category: "Bags",
    price: 243,
    oldPrice: 302,
    subtitle:
      "Lightweight Tote — Student Edition 42 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Lightweight Tote — Student Edition 42. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Lightweight Tote.jpg",
    rating: 4.7,
    reviews: 58,
    stock: 11,
    seller: "Campus Seller 29",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0893",
    name: "Laptop Backpack — Student Edition 43",
    category: "Bags",
    price: 739,
    oldPrice: 973,
    subtitle: "Laptop Backpack — Student Edition 43 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathiar University",
    description:
      "Laptop Backpack — Student Edition 43. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Backpack.jpg",
    rating: 4.8,
    reviews: 37,
    stock: 1,
    seller: "Campus Seller 30",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathiar University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0894",
    name: "Laptop Messenger Bag — Student Edition 44",
    category: "Bags",
    price: 780,
    oldPrice: 1014,
    subtitle:
      "Laptop Messenger Bag — Student Edition 44 for student and campus use",
    condition: "Second-hand · Like new",
    college: "University of Madras",
    description:
      "Laptop Messenger Bag — Student Edition 44. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Messenger Bag.webp",
    rating: 4.4,
    reviews: 8,
    stock: 12,
    seller: "Campus Seller 31",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "University of Madras",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0895",
    name: "Crossbody Bag — Student Edition 45",
    category: "Bags",
    price: 607,
    oldPrice: 822,
    subtitle: "Crossbody Bag — Student Edition 45 for student and campus use",
    condition: "First-hand · New",
    college: "Saveetha Institute of Medical and Technical Sciences",
    description:
      "Crossbody Bag — Student Edition 45. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Crossbody Bag.webp",
    rating: 4.9,
    reviews: 80,
    stock: 11,
    seller: "Campus Seller 32",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "Saveetha Institute of Medical and Technical Sciences",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0896",
    name: "Weekend Travel Bag — Student Edition 46",
    category: "Bags",
    price: 681,
    oldPrice: 840,
    subtitle:
      "Weekend Travel Bag — Student Edition 46 for student and campus use",
    condition: "Second-hand · Good",
    college: "SASTRA University",
    description:
      "Weekend Travel Bag — Student Edition 46. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Weekend Travel Bag.jpg",
    rating: 4.0,
    reviews: 47,
    stock: 4,
    seller: "Campus Seller 33",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "SASTRA University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0897",
    name: "Utility Sling Bag — Student Edition 47",
    category: "Bags",
    price: 309,
    oldPrice: 369,
    subtitle:
      "Utility Sling Bag — Student Edition 47 for student and campus use",
    condition: "Second-hand · Very good",
    college: "Bharathidasan University",
    description:
      "Utility Sling Bag — Student Edition 47. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Utility Sling Bag.jpg",
    rating: 4.6,
    reviews: 3,
    stock: 10,
    seller: "Campus Seller 34",
    specs: {
      Condition: "Second-hand · Very good",
      "Listed by": "Bharathidasan University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0898",
    name: "Laptop Briefcase — Student Edition 48",
    category: "Bags",
    price: 293,
    oldPrice: 379,
    subtitle:
      "Laptop Briefcase — Student Edition 48 for student and campus use",
    condition: "Second-hand · Like new",
    college: "SRM Institute of Science and Technology",
    description:
      "Laptop Briefcase — Student Edition 48. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Briefcase.webp",
    rating: 4.6,
    reviews: 54,
    stock: 8,
    seller: "Campus Seller 35",
    specs: {
      Condition: "Second-hand · Like new",
      "Listed by": "SRM Institute of Science and Technology",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0899",
    name: "Everyday Carry Bag — Student Edition 49",
    category: "Bags",
    price: 314,
    oldPrice: 439,
    subtitle:
      "Everyday Carry Bag — Student Edition 49 for student and campus use",
    condition: "First-hand · New",
    college: "VIT Chennai",
    description:
      "Everyday Carry Bag — Student Edition 49. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Everyday Carry Bag.jpg",
    rating: 4.0,
    reviews: 85,
    stock: 9,
    seller: "Campus Seller 36",
    specs: {
      Condition: "First-hand · New",
      "Listed by": "VIT Chennai",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
  {
    id: "EB0900",
    name: "Campus Backpack — Student Edition 50",
    category: "Bags",
    price: 732,
    oldPrice: 1049,
    subtitle: "Campus Backpack — Student Edition 50 for student and campus use",
    condition: "Second-hand · Good",
    college: "Annamalai University",
    description:
      "Campus Backpack — Student Edition 50. Student-budget friendly campus listing. Review the condition and specifications before purchase; arrange a safe public campus handover with the seller.",
    image: "images/Laptop Backpack.jpg",
    rating: 4.6,
    reviews: 29,
    stock: 2,
    seller: "Campus Seller 37",
    specs: {
      Condition: "Second-hand · Good",
      "Listed by": "Annamalai University",
      Delivery: "Meet at campus public spot",
      "Seller response": "Usually within a day",
    },
  },
];


/* ===== js/image-api-config.js ===== */
window.EASYBUY_IMAGE_API_CONFIG = { enabled: false };


/* ===== js/image-api.js ===== */
/* EasyBuy live product image API
   Books: Google Books Volume API (front-cover thumbnails only).
   Other categories: Wikimedia Commons MediaSearch API (licensed media, where available).
   Requests are lazy-loaded as product cards enter view; results are cached and image URLs are deduplicated.
   API search results are not guaranteed to match every exact retail SKU; local product art remains fallback.
*/
(() => {
  "use strict";
  const products = window.EASYBUY_PRODUCTS || [];
  const byId = new Map(products.map((p) => [String(p.id), p]));
  const config = window.EASYBUY_IMAGE_API_CONFIG || {};
  if (config.enabled === false) return;
  const cacheKey = "eb_live_product_images_v3";
  const readCache = () => {
    try {
      const v = JSON.parse(localStorage.getItem(cacheKey) || "{}");
      return v && typeof v === "object" ? v : {};
    } catch (_) {
      return {};
    }
  };
  const cache = readCache(),
    usedUrls = new Set();
  Object.values(cache).forEach((v) => {
    const u = typeof v === "string" ? v : v?.url;
    if (u) usedUrls.add(u);
  });
  const pending = new Set(),
    failed = new Set(),
    queue = [];
  let active = 0;
  const MAX_ACTIVE = 2;
  const clean = (s) =>
    String(s || "")
      .toLowerCase()
      .replace(/[^a-z0-9]+/g, " ")
      .trim();
  const stop = new Set([
    "edition",
    "student",
    "used",
    "new",
    "good",
    "very",
    "with",
    "for",
    "and",
    "the",
    "book",
    "guide",
    "product",
    "campus",
    "college",
    "item",
    "set",
    "pack",
    "model",
  ]);
  const words = (s) =>
    clean(s)
      .split(" ")
      .filter((w) => w.length > 2 && !stop.has(w));
  const isBook = (p) =>
    String(p?.category || "").toLowerCase() === "books" ||
    /\b(book|textbook|programming guide|crash course|complete reference)\b/i.test(
      String(p?.name || ""),
    );
  const categoryTerms = {
    Electronics: "consumer electronics computer accessories",
    Books: "programming textbook front cover",
    "Stationery Kits": "stationery pens pencils notebooks school supplies",
    Calculators: "scientific calculator handheld calculator",
    "Lab Equipment": "laboratory equipment scientific instrument",
    Accessories: "student backpack everyday accessories",
    "T-Shirts": "t shirt clothing apparel",
    Bags: "backpack school bag luggage",
  };
  function apply(id, url) {
    if (!url) return;
    document.querySelectorAll("img[data-eb-product-image]").forEach((img) => {
      if (
        String(img.dataset.ebProductImage) === String(id) &&
        img.dataset.ebApiApplied !== "1"
      ) {
        img.dataset.ebApiApplied = "1";
        img.src = url;
        img.dataset.ebImageSource = "live-api";
      }
    });
  }
  function score(name, title) {
    const a = new Set(words(name)),
      b = new Set(words(title));
    if (!a.size || !b.size) return 0;
    let hit = 0;
    a.forEach((w) => {
      if (b.has(w)) hit++;
    });
    return hit / a.size;
  }
  async function getBook(p) {
    const name = String(p.name || "")
      .replace(/[—–-]\s*(edition|student edition).*$/i, "")
      .trim();
    const url =
      "https://www.googleapis.com/books/v1/volumes?" +
      new URLSearchParams({
        q: "intitle:" + name,
        printType: "books",
        maxResults: "20",
        orderBy: "relevance",
      });
    const r = await fetch(url);
    if (!r.ok) throw Error("Google Books API " + r.status);
    const data = await r.json();
    const candidates = (data.items || [])
      .map((item) => {
        const v = item.volumeInfo || {},
          im = v.imageLinks || {};
        let u =
          im.large ||
          im.medium ||
          im.thumbnail ||
          im.small ||
          im.smallThumbnail ||
          "";
        u = u.replace(/^http:/i, "https:").replace("&edge=curl", "");
        return {
          url: u,
          title: v.title || "",
          score: score(name, v.title || ""),
        };
      })
      .filter((x) => x.url && /^https:\/\//i.test(x.url) && x.score >= 0.3)
      .sort((a, b) => b.score - a.score);
    return candidates.find((x) => !usedUrls.has(x.url)) || null;
  }
  async function getCommons(p) {
    const name = String(p.name || "")
      .replace(/[—–-]\s*(edition|student edition).*$/i, "")
      .trim();
    const cat = String(p.category || "");
    const terms = categoryTerms[cat] || "product photo";
    const q = `filetype:bitmap "${name}" ${terms}`;
    const url =
      "https://commons.wikimedia.org/w/api.php?" +
      new URLSearchParams({
        action: "query",
        format: "json",
        origin: "*",
        generator: "search",
        gsrsearch: q,
        gsrnamespace: "6",
        gsrlimit: "20",
        prop: "imageinfo",
        iiprop: "url|extmetadata",
        iiurlwidth: "720",
      });
    const r = await fetch(url);
    if (!r.ok) throw Error("Wikimedia Commons API " + r.status);
    const data = await r.json();
    const pages = Object.values(data.query?.pages || {})
      .map((page) => {
        const ii = page.imageinfo?.[0] || {},
          meta = ii.extmetadata || {};
        const title = String(page.title || "").replace(/^File:/, "");
        return {
          url: ii.thumburl || ii.url || "",
          title,
          score: score(name, title),
          license: meta.LicenseShortName?.value || "",
          sourcePage: meta.ImageDescription?.source || "",
        };
      })
      .filter((x) => x.url && /^https:\/\//i.test(x.url) && x.score >= 0.22)
      .sort((a, b) => b.score - a.score);
    return pages.find((x) => !usedUrls.has(x.url)) || null;
  }
  async function lookup(p) {
    const id = String(p.id),
      old = cache[id],
      oldUrl = typeof old === "string" ? old : old?.url;
    if (oldUrl) {
      apply(id, oldUrl);
      return;
    }
    if (pending.has(id) || failed.has(id)) return;
    pending.add(id);
    try {
      let result = isBook(p) ? await getBook(p) : await getCommons(p);
      if (result?.url && !usedUrls.has(result.url)) {
        const record = {
          url: result.url,
          source: isBook(p) ? "Google Books" : "Wikimedia Commons",
          title: result.title || p.name,
          license: result.license || "",
        };
        cache[id] = record;
        usedUrls.add(result.url);
        try {
          localStorage.setItem(cacheKey, JSON.stringify(cache));
        } catch (_) {}
        apply(id, result.url);
      } else failed.add(id);
    } catch (err) {
      console.warn(
        "EasyBuy image API unavailable; retaining the product-specific local image:",
        p.name,
        err,
      );
      failed.add(id);
    } finally {
      pending.delete(id);
      active--;
      pump();
    }
  }
  function pump() {
    while (active < MAX_ACTIVE && queue.length) {
      active++;
      lookup(queue.shift());
    }
  }
  const queued = new Set();
  function queueImage(img) {
    const id = String(img.dataset.ebProductImage || ""),
      p = byId.get(id);
    if (!p || queued.has(id) || pending.has(id) || failed.has(id)) return;
    const old = cache[id],
      u = typeof old === "string" ? old : old?.url;
    if (u) {
      apply(id, u);
      return;
    }
    queued.add(id);
    queue.push(p);
    pump();
  }
  function scan() {
    document
      .querySelectorAll("img[data-eb-product-image]")
      .forEach((img) => (observer ? observer.observe(img) : queueImage(img)));
  }
  const observer =
    "IntersectionObserver" in window
      ? new IntersectionObserver(
          (entries) =>
            entries.forEach((e) => {
              if (e.isIntersecting) {
                queueImage(e.target);
                observer.unobserve(e.target);
              }
            }),
          { rootMargin: "420px 0px" },
        )
      : null;
  if (document.readyState === "loading")
    document.addEventListener("DOMContentLoaded", scan, { once: true });
  else scan();
  const target = document.querySelector("#app");
  if (target && "MutationObserver" in window)
    new MutationObserver(scan).observe(target, {
      childList: true,
      subtree: true,
    });
  window.EasyBuyImages = {
    sourceFor: (id) => cache[String(id)] || null,
    clearCache: () => {
      localStorage.removeItem(cacheKey);
      location.reload();
    },
  };
})();


/* ===== js/app.js ===== */
(() => {
  const products = window.EASYBUY_PRODUCTS || [];
  const savedListings = (() => {
    try {
      return JSON.parse(localStorage.getItem("eb_listings") || "[]");
    } catch (_) {
      return [];
    }
  })();
  savedListings.forEach((x, i) => {
    const id = x.id || "user-" + (x.createdAt || i);
    if (!products.some((p) => String(p.id) === String(id)))
      products.push({
        id,
        name: x.name,
        category: x.category,
        price: Number(x.price) || 0,
        oldPrice: Number(x.price) || 0,
        condition: x.condition || "Second-hand · Good",
        college: x.college || "Student seller",
        seller_name: x.seller_name || getDisplaySellerName(),
        contact: x.contact || "",
        description: x.description || "",
        subtitle: "Student listing",
        image:
          x.image ||
          "images/categories/" +
            ({
              Electronics: "electronics",
              Books: "books",
              "Stationery Kits": "stationery",
              Calculators: "calculators",
              "Lab Equipment": "lab-equipment",
              Accessories: "accessories",
              "T-Shirts": "clothing",
              Bags: "bags",
            }[x.category] || "accessories") +
            ".svg",
        rating: 5,
        reviews: 0,
        stock: 1,
        specs: {
          Seller: "Student listing",
          Condition: x.condition || "Second-hand · Good",
        },
      });
  });
  const $ = (s) => document.querySelector(s);
  const app = $("#app");
  const readArray = (key) => {
    try {
      const value = JSON.parse(localStorage.getItem(key) || "[]");
      return Array.isArray(value) ? value : [];
    } catch (_) {
      return [];
    }
  };
  // Migrate wishlist data from older builds and normalize both ID-only and
  // object-shaped entries. Older versions used different keys / stored full
  // product objects, which made saved products disappear from the wishlist.
  function readWishlist() {
    const candidates = ["eb_wish", "eb_wishlist", "easybuy_wishlist", "easybuy_wish"];
    let raw = [];
    for (const key of candidates) {
      const value = readArray(key);
      if (value.length) { raw = value; break; }
    }
    const ids = raw.map((item) => {
      if (item && typeof item === "object") {
        return item.id ?? item.productId ?? item.product_id ?? item.code ?? "";
      }
      return item;
    }).filter((id) => id !== null && id !== undefined && String(id).trim() !== "")
      .map((id) => String(id));
    return [...new Set(ids)];
  }
  let cart = readArray("eb_cart"),
    wishlist = readWishlist(),
    orders = readArray("eb_orders"),
    rotation = 0;
  const money = (n) => "₹" + Number(n).toLocaleString("en-IN");
  const escapeHtml = (value) => String(value ?? "").replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));
  // Courier tracking must point to an actual external carrier site, never back to this EasyBuy app.
  function getCourierTrackingUrl(value) {
    const raw = String(value || "").trim();
    if (!raw) return "";
    try {
      const u = new URL(raw, window.location.href);
      if (!/^https?:$/.test(u.protocol)) return "";
      if (u.origin === window.location.origin) return "";
      if (["localhost", "127.0.0.1", "::1"].includes(u.hostname.toLowerCase())) return "";
      return u.href;
    } catch (_) { return ""; }
  }
  function getDisplaySellerName() {
    try { const email = sessionStorage.getItem("easybuy_js_session_v1"); const users = JSON.parse(localStorage.getItem("easybuy_js_users_v1") || "[]"); const user = Array.isArray(users) ? users.find((u) => u.email === email) : null; return user?.name || "EasyBuy Student Seller"; }
    catch (_) { return "EasyBuy Student Seller"; }
  }
  function dateRange(daysMin, daysMax) {
    const fmt = (d) => d.toLocaleDateString("en-IN", { day: "numeric", month: "short", year: "numeric" });
    const start = new Date(); start.setHours(0,0,0,0); start.setDate(start.getDate() + daysMin);
    const end = new Date(); end.setHours(0,0,0,0); end.setDate(end.getDate() + daysMax);
    return { start: start.toISOString().slice(0,10), end: end.toISOString().slice(0,10), label: `${fmt(start)} – ${fmt(end)}` };
  }
  const EASYBUY_CONTACT = "9629872987";
  const phoneDigits = (p) => EASYBUY_CONTACT.replace(/\D/g, "");
  const phoneForCall = (p) => {
    const d = phoneDigits(p);
    return d ? (d.length === 10 ? "+91" + d : "+" + d) : "";
  };
  const save = () => {
    localStorage.setItem("eb_cart", JSON.stringify(cart));
    localStorage.setItem("eb_wish", JSON.stringify(wishlist));
    localStorage.setItem("eb_orders", JSON.stringify(orders));
    updateCount();
    // buyer-sync.js listens for this to store the cart/wishlist in the MySQL database.
    window.dispatchEvent(new Event("easybuy:state-changed"));
  };
  // Small bridge used by js/buyer-sync.js (cart/wishlist saved in MySQL per buyer account).
  window.EasyBuyState = {
    getCart: () => cart.map((x) => ({ id: String(x.id), qty: Number(x.qty) || 1 })),
    getWishlist: () => wishlist.map(String),
    setState(next) {
      if (Array.isArray(next.cart)) cart = next.cart.map((x) => ({ id: String(x.id), qty: Math.max(1, Number(x.qty) || 1) }));
      if (Array.isArray(next.wishlist)) wishlist = [...new Set(next.wishlist.map(String))];
      try {
        localStorage.setItem("eb_cart", JSON.stringify(cart));
        localStorage.setItem("eb_wish", JSON.stringify(wishlist));
      } catch (_) {}
      updateCount();
      if (/^#(cart|wishlist|checkout)/.test(location.hash)) route(false);
    },
    reset() {
      cart = []; wishlist = []; orders = [];
      ["eb_cart", "eb_wish", "eb_orders"].forEach((k) => { try { localStorage.removeItem(k); } catch (_) {} });
      updateCount();
    },
  };
  function updateCount() {
    $("#cartCount").textContent = cart.reduce((a, b) => a + b.qty, 0);
  }
  function go(hash) {
    location.hash = hash;
  }
  function loader() {
    const l = $("#loading");
    if (!l) return;
    l.classList.remove("hidden");
    l.classList.add("eb-transition-loading");
    const label = $("#loaderLabel");
    if (label) label.textContent = "EASYBUY · MOVING TO YOUR NEXT PAGE";
    clearTimeout(window.ebPageLoaderTimer);
    window.ebPageLoaderTimer = setTimeout(() => {
      l.classList.add("hidden");
      l.classList.remove("eb-transition-loading");
    }, 700);
  }
  function img(p, cls = "") {
    const fallback =
      {
        Calculators: "images/categories/calculators.svg",
        Books: "images/categories/books.svg",
        Bags: "images/categories/bags.svg",
        Electronics: "images/categories/electronics.svg",
        "Lab Equipment": "images/categories/lab-equipment.svg",
        "Stationery Kits": "images/categories/stationery.svg",
        "T-Shirts": "images/categories/clothing.svg",
        Accessories: "images/categories/accessories.svg",
      }[p.category] || "images/categories/accessories.svg";
    return `<img data-eb-product-image="${p.id}" class="${cls}" src="${p.image}" alt="${p.name}" loading="lazy" onerror="if(this.dataset.ebFallback){this.onerror=null;this.style.visibility='hidden'}else{this.dataset.ebFallback='1';this.onerror=null;this.src='${fallback}'}">`;
  }
  function card(p) {
    return `<article class="product-card"><div class="product-image-wrap">${img(p, "product-image")}<span class="tag">${p.condition.split(" · ")[0]}</span><button type="button" class="heart" data-wish="${p.id}" aria-pressed="${wishlist.includes(String(p.id))}" aria-label="${wishlist.includes(String(p.id)) ? "Remove from wishlist" : "Add to wishlist"}">${wishlist.includes(String(p.id)) ? "♥" : "♡"}</button></div><div class="product-name">${p.name}</div><div class="product-category">${p.category}</div><div class="rating">★ ${p.rating} <span style="color:#94a0b2">(${p.reviews} reviews)</span></div><div class="price-row"><span class="price">${money(p.price)}</span><span class="oldprice">${money(p.oldPrice)}</span><span class="discount">${Math.round((1 - p.price / p.oldPrice) * 100)}% off</span></div><div class="sellerline">📍 ${p.college}</div><div class="sellerline eb-seller-name">👤 Published by ${escapeHtml(p.seller_name || p.sellerName || getDisplaySellerName())}</div><div class="eb-availability ${Number(p.stock ?? 1) > 0 ? "available" : "unavailable"}">${Number(p.stock ?? 1) > 0 ? "● Available" : "● Out of stock"}${Number(p.stock ?? 1) > 0 ? ` · ${Number(p.stock ?? 1)} available` : ""}</div><div class="card-actions"><button class="addbtn" data-add="${p.id}" ${Number(p.stock ?? 1) <= 0 ? "disabled" : ""}><span class="eb-add-cart-icon">🛒</span> Add to cart</button><button class="viewbtn" data-view="${p.id}">View product</button></div><div class="eb-contact-actions"><a href="tel:${phoneForCall(p)}" class="eb-call-seller" aria-label="Call EasyBuy contact">☎ Call Now</a></div></article>`;
  }
  function sectionHead(title, sub, link = "View all products", hash = "#shop") {
    return `<div class="sectionhead"><div><h2>${title}</h2><p>${sub}</p></div><a class="textlink" href="${hash}">${link} →</a></div>`;
  }
  function home() {
    const featured = products.slice(0, 8);
    app.innerHTML = `<section class="eb-carousel" id="ebCarousel" aria-label="EasyBuy featured categories"><div class="eb-slides"><article class="eb-slide active" style="--slide-image:url('images/A4 Notebook Set.jpg')"><div class="eb-slide-copy"><span class="eyebrow">✦ MADE FOR CAMPUS LIFE</span><h1>Buy &amp; Sell <span>Everything</span><br>You Need!</h1><p>Books, stationery, electronics, lab equipment, fashion and more — all in one place.</p><div class="hero-actions"><a class="primary" href="#shop">🛒 Shop Now</a><a class="secondary" href="">▦ Start Selling</a></div></div><div class="eb-slide-art"><img src="images/A4 Notebook Set.jpg" alt="Student notebook set"></div></article><article class="eb-slide" style="--slide-image:url('images/Black Ballpoint Pens.jpg')"><div class="eb-slide-copy"><span class="eyebrow">📚 BOOKS · NOTES · IDEAS</span><h1>Make every <span>class count.</span></h1><p>Find affordable notebooks, reference books and stationery from fellow students.</p><div class="hero-actions"><a class="primary" href="#shop?category=Stationery%20Kits">Explore Stationery ↗</a><a class="secondary" href="#shop?category=Books">Browse Books</a></div></div><div class="eb-slide-art"><img src="images/Black Ballpoint Pens.jpg" alt="Stationery pens"></div></article><article class="eb-slide" style="--slide-image:url('images/Power Bank.jpg')"><div class="eb-slide-copy"><span class="eyebrow">✦ LEARN · BUILD · CREATE</span><h1>Study smarter with <span>student tech.</span></h1><p>Discover calculators, electronics and lab essentials at student-friendly prices.</p><div class="hero-actions"><a class="primary" href="#shop?category=Electronics">Shop Electronics ↗</a><a class="secondary" href="#shop?category=Calculators">Calculators</a></div></div><div class="eb-slide-art"><img src="images/Power Bank.jpg" alt="Portable power bank"></div></article><article class="eb-slide" style="--slide-image:url('images/Classic Campus T-shirt.jpg')"><div class="eb-slide-copy"><span class="eyebrow">✦ STYLE · COMFORT · YOU</span><h1>Campus style, <span>your budget.</span></h1><p>Browse everyday wear, bags and accessories from your student community.</p><div class="hero-actions"><a class="primary" href="#shop?category=T-Shirts">Shop Fashion ↗</a><a class="secondary" href="#shop?category=Bags">Browse Bags</a></div></div><div class="eb-slide-art"><img src="images/Classic Campus T-shirt.jpg" alt="Campus T-shirt"></div></article><article class="eb-slide" style="--slide-image:url('images/Anti-splash Backpack.jpg')"><div class="eb-slide-copy"><span class="eyebrow">✦ JOIN THE STUDENT COMMUNITY</span><h1>Good finds. <span>Better deals.</span></h1><p>Buy, sell and reuse campus essentials — all in one marketplace.</p><div class="hero-actions"><a class="primary" href="#shop">Shop Now ↗</a><a class="secondary" href="">Open Seller Studio</a></div><div class="hero-mini-trust">✓ Student community &nbsp; · &nbsp; ✓ Affordable finds &nbsp; · &nbsp; ✓ Reuse more</div></div><div class="eb-slide-art"><img src="images/Anti-splash Backpack.jpg" alt="Student backpack"></div></article></div><button class="eb-carousel-arrow prev" type="button" aria-label="Previous slide">‹</button><button class="eb-carousel-arrow next" type="button" aria-label="Next slide">›</button><div class="eb-carousel-dots" aria-label="Choose slide"><button class="active" aria-label="Slide 1"></button><button aria-label="Slide 2"></button><button aria-label="Slide 3"></button><button aria-label="Slide 4"></button><button aria-label="Slide 5"></button></div><span class="eb-slide-count">1/5</span></section><section class="section"><div class="wrap">${sectionHead("Shop by category", "Find what you need for your next class.")}<div class="category-grid">${[
      ["Books", "📚", "Textbooks & guides"],
      ["Stationery Kits", "✏️", "Classroom basics"],
      ["Calculators", "🧮", "Maths essentials"],
      ["Lab Equipment", "🧪", "Practical essentials"],
      ["Electronics", "🎧", "Tech for study"],
      ["Accessories", "🎒", "Daily campus life"],
      ["T-Shirts", "👕", "Everyday wear"],
      ["Bags", "👜", "Carry it all"],
    ]
      .map(
        (c, i) =>
          `<a class="category" href="#shop?category=${encodeURIComponent(c[0])}"><img src="${products[[1, 5, 0, 4, 3, 11, 9, 2][i]].image}" onerror="this.onerror=null;this.src='images/categories/${["books", "stationery", "calculators", "lab-equipment", "electronics", "accessories", "clothing", "bags"][i]}.svg'" alt="${c[0]}"><div><strong>${c[0]}</strong><small>${c[2]} →</small></div></a>`,
      )
      .join(
        "",
      )}</div></div></section><section class="section"><div class="wrap"><div class="deals"><div><span class="eyebrow" style="background:#ffffff1c;color:#fff">CAMPUS DEALS</span><h2>Small prices. Big semester energy.</h2><p>Pre-loved finds and affordable new essentials.</p></div><div class="deal-clock"><div class="timebox"><span id="hh">08</span><small>HOURS</small></div><div class="timebox"><span id="mm">24</span><small>MIN</small></div><div class="timebox"><span id="ss">59</span><small>SEC</small></div></div><a href="#shop" class="primary" style="background:#fff;color:#183c70;position:relative;z-index:2">Shop deals →</a></div></div></section><section class="section"><div class="wrap">${sectionHead("Picked for student life", "Popular essentials at approachable prices.")}<div class="product-grid">${featured.map(card).join("")}</div></div></section><section class="section"><div class="wrap"><div class="campus-band"><div><h3>Got something you no longer use?</h3><p>List textbooks, gadgets, and campus essentials for other students.</p></div><a class="primary" href="#sell">List a product free ↗</a></div></div></section>`;
    startClock();
    initEasyBuyCarousel();
  }
  function startClock() {
    let end = Date.now() + 8 * 3600000 + 24 * 60000 + 59000;
    setInterval(() => {
      let s = Math.max(0, Math.floor((end - Date.now()) / 1000));
      if ($("#hh")) {
        $("#hh").textContent = String(Math.floor(s / 3600)).padStart(2, "0");
        $("#mm").textContent = String(Math.floor((s % 3600) / 60)).padStart(
          2,
          "0",
        );
        $("#ss").textContent = String(s % 60).padStart(2, "0");
      }
    }, 1000);
  }
  function shop() {
    const params = new URLSearchParams(location.hash.split("?")[1] || "");
    let category = params.get("category") || "All";
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">THE CAMPUS MARKETPLACE</span><h1>Find your next good thing.</h1><p style="color:var(--muted)">Affordable products listed by students. Tap a product to view full details.</p><div class="filters"><input id="shopSearch" placeholder="Search name, category or college…"><select id="catFilter"><option>All</option>${[...new Set(products.map((p) => p.category))].map((c) => `<option ${c === category ? "selected" : ""}>${c}</option>`).join("")}</select><select id="conditionFilter"><option value="All">Any condition</option><option>First-hand</option><option>Second-hand</option></select><select id="sortFilter"><option value="featured">Recommended</option><option value="low">Price: low to high</option><option value="high">Price: high to low</option><option value="rating">Top rated</option></select></div><p id="resultCount" style="color:var(--muted);font-size:13px"></p><div class="product-grid" id="shopGrid"></div></div>`;
    const render = () => {
      let q = $("#shopSearch").value.toLowerCase(),
        c = $("#catFilter").value,
        cond = $("#conditionFilter").value,
        sort = $("#sortFilter").value;
      let list = products.filter(
        (p) =>
          (c === "All" || p.category === c) &&
          (cond === "All" || p.condition.startsWith(cond)) &&
          [p.name, p.category, p.college, p.description]
            .join(" ")
            .toLowerCase()
            .includes(q),
      );
      if (sort === "low") list.sort((a, b) => a.price - b.price);
      if (sort === "high") list.sort((a, b) => b.price - a.price);
      if (sort === "rating") list.sort((a, b) => b.rating - a.rating);
      $("#resultCount").textContent = `${list.length} products found`;
      $("#shopGrid").innerHTML = list.length
        ? list.map(card).join("")
        : '<div class="empty">No products found. Try another search or category.</div>';
    };
    ["shopSearch", "catFilter", "conditionFilter", "sortFilter"].forEach((id) =>
      $("#" + id).addEventListener("input", render),
    );
    render();
  }
  function detail(id) {
    const p = products.find((x) => x.id === id);
    if (!p) {
      home();
      return;
    }
    rotation = 0;
    const colleges = [
      ...new Set(products.map((x) => x.college).filter(Boolean)),
    ].sort();
    const campusKey = "eb_product_campus_" + p.id;
    const savedCampus = localStorage.getItem(campusKey) || "";
    const years = [
      "First Year",
      "Second Year",
      "Third Year",
      "Fourth Year",
      "Final Year",
      "Other",
    ];
    const departments = [
      "Computer Science",
      "Information Technology",
      "Electronics & Communication",
      "Electrical & Electronics",
      "Mechanical Engineering",
      "Civil Engineering",
      "Biotechnology",
      "Physics",
      "Chemistry",
      "Commerce",
      "Business Administration",
      "Arts & Humanities",
      "Other",
    ];
    app.innerHTML = `<div class="wrap"><div style="padding-top:25px;color:var(--muted);font-size:13px"><a href="#shop">Shop</a> / ${p.category} / ${p.name}</div><div class="detail-grid"><div class="detail-visual">${img(p, "detail-product")}<div class="rotate-controls"><button id="rotateLeft">↶ Rotate left</button><button id="rotateRight">Rotate right ↷</button><button id="resetRotate">Reset</button></div></div><div class="detail-info"><span class="eyebrow">${p.condition}</span><h1>${p.name}</h1><div class="rating">★ ${p.rating} · ${p.reviews} student reviews</div><div class="price-row"><span class="price">${money(p.price)}</span><span class="oldprice">${money(p.oldPrice)}</span><span class="discount">${Math.round((1 - p.price / p.oldPrice) * 100)}% off</span></div><p class="sellerline eb-seller-name">👤 Published by ${escapeHtml(p.seller_name || p.sellerName || getDisplaySellerName())}</p>${p.pickup_location ? `<section class="eb-panel" style="margin:14px 0;padding:14px"><h3>📍 Seller pickup location</h3><p>${escapeHtml(p.pickup_location)}</p><div class="eb-action-row"><a class="secondary" target="_blank" rel="noopener noreferrer" href="${escapeHtml(p.pickup_map_url || ("https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(p.pickup_location + " " + (p.college || ""))))}">Open pickup map ↗</a><a class="primary" href="#messages?product=${encodeURIComponent(p.id)}&to=${encodeURIComponent(p.seller_email || "")}&name=${encodeURIComponent(p.seller_name || p.sellerName || "Seller")}">Ask seller about pickup</a></div><small>Meet at a public campus location and confirm the pickup time with the seller.</small></section>` : `<section class="eb-panel" style="margin:14px 0;padding:14px"><h3>📍 Pickup location not added yet</h3><p>Message the seller to ask for the public pickup point and map link.</p><a class="primary" href="#messages?product=${encodeURIComponent(p.id)}&to=${encodeURIComponent(p.seller_email || "")}&name=${encodeURIComponent(p.seller_name || p.sellerName || "Seller")}">Ask seller for pickup location</a></section>`}<p>${p.description}</p><p>${p.subtitle}. Student-listed campus essential, priced with student budgets in mind.</p><div class="specs">${Object.entries(
      p.specs,
    )
      .map(
        ([k, v]) =>
          `<div class="specrow"><span>${k}</span><strong>${v}</strong></div>`,
      )
      .join(
        "",
      )}<div class="specrow"><span>Stock status</span><strong class="${Number(p.stock ?? 1) > 0 ? "eb-stock-in" : "eb-stock-out"}">${Number(p.stock ?? 1) > 0 ? `${Number(p.stock)} available` : "Out of stock"}</strong></div><div class="specrow"><span>Category</span><strong>${p.category}</strong></div><div class="specrow"><span>Product ID</span><strong>${p.id}</strong></div>${p.available_sizes ? `<div class="specrow"><span>Available sizes</span><strong>${escapeHtml(p.available_sizes)}</strong></div>` : ""}${p.measurements ? `<div class="specrow"><span>Measurements</span><strong>${escapeHtml(p.measurements)}</strong></div>` : ""}${p.customization_options ? `<div class="specrow"><span>Customization</span><strong>${escapeHtml(p.customization_options)}</strong></div>` : ""}</div><div class="detail-actions"><button class="primary" data-add="${p.id}" ${Number(p.stock ?? 1) <= 0 ? "disabled" : ""}><span class="eb-add-cart-icon">🛒</span> ${Number(p.stock ?? 1) <= 0 ? "Out of stock" : "Add to cart"}</button><button class="secondary" data-buy="${p.id}" ${Number(p.stock ?? 1) <= 0 ? "disabled" : ""}>${Number(p.stock ?? 1) <= 0 ? "Out of stock" : "Buy now →"}</button><button class="secondary" data-wish="${p.id}">${wishlist.includes(String(p.id)) ? "♥ Saved" : "♡ Wishlist"}</button></div><div class="eb-contact-actions eb-detail-contact"><a href="tel:${phoneForCall(p)}" class="eb-call-seller" aria-label="Call EasyBuy contact">☎ Call Now</a></div><div class="detail-message-cta"><a class="primary" href="#messages?product=${encodeURIComponent(p.id)}&to=${encodeURIComponent(p.seller_email || "")}&name=${encodeURIComponent(p.seller_name || p.sellerName || "Seller")}">✉ Message about this product</a><span>Ask a question about this item and view database-confirmed replies in Messages.</span></div><p style="font-size:12px">Safety tip: meet in a public campus location, inspect the item, and avoid paying before verifying it.</p></div></div>
<section class="eb-panel eb-product-campus"><div class="eb-campus-heading"><span class="eyebrow">CAMPUS AVAILABILITY</span><h2>📍 Is this product available at your college?</h2><p>Seller-listed location: <strong>${p.college || "Not provided"}</strong>. This is based on the listing, not live stock verification.</p></div><div class="eb-campus-form"><div class="field"><label for="ebBuyerCollege">Your college</label><select id="ebBuyerCollege"><option value="">Choose your college</option>${colleges.map((c) => `<option value="${c.replace(/&/g, "&amp;").replace(/"/g, "&quot;")}" ${c === savedCampus ? "selected" : ""}>${c}</option>`).join("")}<option value="__other__">Other / outside listed colleges</option></select></div><div class="field"><label for="ebBuyerCollegeOther">Other college / location</label><input id="ebBuyerCollegeOther" placeholder="Enter your college or current location"></div><div class="field"><label for="ebBuyerDepartment">Department</label><select id="ebBuyerDepartment"><option value="">Choose department</option>${departments.map((d) => `<option>${d}</option>`).join("")}</select></div><div class="field"><label for="ebBuyerCourse">Course / programme</label><input id="ebBuyerCourse" placeholder="e.g. B.Sc Computer Science, B.E CSE"></div><div class="field"><label for="ebBuyerYear">Year / standard</label><select id="ebBuyerYear"><option value="">Choose year / standard</option>${years.map((y) => `<option>${y}</option>`).join("")}<option>Class 6</option><option>Class 7</option><option>Class 8</option><option>Class 9</option><option>Class 10</option><option>Class 11</option><option>Class 12</option></select></div><div class="field"><label for="ebBuyerClass">Class / section (optional)</label><input id="ebBuyerClass" placeholder="e.g. II-B, Section A"></div><div class="field"><label for="ebBuyerName">Your name (optional)</label><input id="ebBuyerName" placeholder="Name for campus hand-off"></div></div><div id="ebCampusStatus" class="eb-campus-status" role="status" aria-live="polite"><strong>Choose your college</strong><span>We will compare it with the seller-listed college.</span></div><div class="eb-action-row"><button id="ebCheckCampus" class="primary" type="button">Check campus availability</button><button id="ebCampusDirections" class="secondary" type="button">Open college map ↗</button></div><p class="eb-help">If you are outside the seller's college, EasyBuy marks it as “Outside college / Fall-out” and suggests checking a public meeting point or delivery with the seller. The site cannot confirm physical inventory unless the seller confirms it.</p></section>
<section class="section">${sectionHead("You may also like", "More affordable campus essentials")}<div class="product-grid">${products
      .filter((x) => x.category === p.category && x.id !== p.id)
      .slice(0, 4)
      .map(card)
      .join("")}</div></section></div>`;
    const image = $(".detail-product");
    const update = () =>
      (image.style.transform = `rotateY(${rotation}deg) rotateX(${Math.sin((rotation * Math.PI) / 180) * 4}deg)`);
    $("#rotateLeft").onclick = () => {
      rotation -= 30;
      update();
    };
    $("#rotateRight").onclick = () => {
      rotation += 30;
      update();
    };
    $("#resetRotate").onclick = () => {
      rotation = 0;
      update();
    };
    image.addEventListener("pointermove", (e) => {
      if (e.pointerType === "mouse") {
        let r = image.getBoundingClientRect();
        image.style.transform = `rotateY(${((e.clientX - r.left) / r.width - 0.5) * 18 + rotation}deg) rotateX(${((e.clientY - r.top) / r.height - 0.5) * -12}deg)`;
      }
    });
    image.addEventListener("pointerleave", update);
    const college = $("#ebBuyerCollege"),
      other = $("#ebBuyerCollegeOther"),
      status = $("#ebCampusStatus");
    function checkCampus() {
      const chosen =
        college.value === "__other__" ? other.value.trim() : college.value;
      if (!chosen) {
        status.className = "eb-campus-status is-warning";
        status.innerHTML =
          "<strong>Please choose or enter your college</strong><span>We need a college/location to compare availability.</span>";
        return;
      }
      localStorage.setItem(campusKey, chosen);
      const same = chosen.toLowerCase() === (p.college || "").toLowerCase();
      status.className =
        "eb-campus-status " + (same ? "is-match" : "is-outside");
      status.innerHTML = same
        ? `<strong>✓ Seller-listed at your college</strong><span>${chosen} matches the seller-listed college. Confirm the product is still available with the seller before ordering.</span>`
        : `<strong>↗ Outside college / Fall-out</strong><span>Your selected location is ${chosen}; seller lists this product at ${p.college || "an unspecified college"}. Contact the seller to agree on delivery or a safe public hand-off.</span>`;
      localStorage.setItem(
        "eb_buyer_profile",
        JSON.stringify({
          college: chosen,
          department: $("#ebBuyerDepartment").value,
          course: $("#ebBuyerCourse").value,
          year: $("#ebBuyerYear").value,
          classSection: $("#ebBuyerClass").value,
          name: $("#ebBuyerName").value,
        }),
      );
    }
    $("#ebCheckCampus").onclick = checkCampus;
    college.addEventListener("change", () => {
      other.style.display = college.value === "__other__" ? "" : "none";
      if (college.value && college.value !== "__other__") checkCampus();
    });
    other.style.display = college.value === "__other__" ? "" : "none";
    $("#ebCampusDirections").onclick = () => {
      const chosen =
        college.value === "__other__"
          ? other.value.trim()
          : college.value || p.college || "";
      location.hash = "#location?destination=" + encodeURIComponent(chosen);
    };
    if (savedCampus) checkCampus();
  }
  function add(id) {
    const p = products.find((x) => String(x.id) === String(id));
    if (!p) return;
    const stock = Math.max(0, Number(p.stock ?? 1));
    if (stock <= 0) {
      toast(`${p.name} is out of stock.`);
      return;
    }
    let it = cart.find((x) => String(x.id) === String(id));
    if (it && Number(it.qty) >= stock) {
      toast(`Only ${stock} unit${stock === 1 ? "" : "s"} available for ${p.name}.`);
      return;
    }
    if (it) it.qty++;
    else cart.push({ id: p.id, qty: 1 });
    save();
    document.querySelectorAll("[data-add]").forEach((b) => {
      if (String(b.dataset.add) === String(id)) {
        b.classList.remove("eb-cart-added");
        void b.offsetWidth;
        b.classList.add("eb-cart-added");
      }
    });
    const basket = document.querySelector(".eb-cart-icon");
    if (basket) {
      basket.classList.remove("eb-cart-bounce");
      void basket.offsetWidth;
      basket.classList.add("eb-cart-bounce");
    }
    toast(`${p.name} added to cart 🛒`);
  }
  function wish(id) {
    id = String(id ?? "").trim();
    if (!id) { toast("Could not identify this product. Please refresh and try again."); return; }
    const product = products.find((item) => String(item.id) === id);
    if (!product) { toast("Product not found. Please refresh the catalogue."); return; }
    const alreadySaved = wishlist.includes(id);
    wishlist = alreadySaved
      ? wishlist.filter((savedId) => String(savedId) !== id)
      : [...wishlist, id];
    try { localStorage.setItem("eb_wish", JSON.stringify(wishlist)); }
    catch (_) { toast("Wishlist could not be saved by this browser."); return; }
    updateCount();
    window.dispatchEvent(new Event("easybuy:state-changed"));
    toast(alreadySaved ? "Removed from wishlist" : "Added to wishlist");
    // Keep every matching heart in sync, including the product detail button.
    document.querySelectorAll("[data-wish]").forEach((button) => {
      if (String(button.dataset.wish) !== id) return;
      const saved = wishlist.includes(id);
      button.textContent = button.classList.contains("heart") ? (saved ? "♥" : "♡") : (saved ? "♥ Saved" : "♡ Wishlist");
      button.setAttribute("aria-pressed", String(saved));
      button.setAttribute("aria-label", saved ? "Remove from wishlist" : "Add to wishlist");
    });
    if ((location.hash || "").slice(1).split("?")[0] === "wishlist") wishlistPage();
  }
  function discover() {
    const picks = [...products]
      .sort((a, b) => (Number(b.rating) || 0) - (Number(a.rating) || 0))
      .slice(0, 12);
    const categoryTiles = [
      ["Books", "📚", "Textbooks and guides"],
      ["Stationery Kits", "✏️", "Pens, notebooks and class essentials"],
      ["Calculators", "🧮", "Scientific and desk calculators"],
      ["Lab Equipment", "🧪", "Practical and lab items"],
      ["Electronics", "🎧", "Study tech and accessories"],
      ["Accessories", "🎒", "Everyday campus essentials"],
      ["T-Shirts", "👕", "Campus clothing"],
      ["Bags", "👜", "Backpacks and carry bags"],
    ];
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">DISCOVER EASYBUY</span><h1>Discover your next campus essential.</h1><p style="color:var(--muted)">Explore hand-picked products here, or browse categories separately below.</p><section class="section"><div class="sectionhead"><div><h2>Discover products</h2><p>Browse popular student listings.</p></div><a class="textlink" href="#shop">All products →</a></div><div class="product-grid">${picks.map(card).join("")}</div></section><section class="section"><div class="sectionhead"><div><h2>Browse categories</h2><p>Choose a category to filter the catalogue.</p></div></div><div class="category-grid">${categoryTiles.map((c) => `<a class="category" href="#shop?category=${encodeURIComponent(c[0])}"><div class="discover-category-icon">${c[1]}</div><div><strong>${c[0]}</strong><small>${c[2]} →</small></div></a>`).join("")}</div></section></div>`;
  }
  function cartPage() {
    if (!cart.length) {
      app.innerHTML = `<div class="wrap page-title"><h1>Your cart</h1><div class="empty"><div style="font-size:50px">🛒</div><h2>Your cart is waiting for a good find.</h2><p>Add a product and it will appear here with its exact image.</p><a class="primary" href="#shop">Explore products</a></div></div>`;
      return;
    }
    let subtotal = cart.reduce(
      (s, it) =>
        s + (products.find((p) => p.id === it.id)?.price || 0) * it.qty,
      0,
    );
    app.innerHTML = `<div class="wrap page-title"><h1>Your cart</h1><p style="color:var(--muted)">Review your products, then choose how you want to pay.</p><div class="cart-layout"><div>${cart
      .map((it) => {
        let p = products.find((x) => x.id === it.id);
        if (!p) return "";
        return `<div class="cart-item">${img(p)}<div class="cart-item-info"><strong>${p.name}</strong><div style="color:var(--muted);font-size:12px">${p.category} · ${p.condition}</div><div class="price">${money(p.price)}</div><div class="qty"><button data-qty="${p.id}" data-delta="-1" aria-label="Decrease quantity">−</button><strong>${it.qty}</strong><button data-qty="${p.id}" data-delta="1" aria-label="Increase quantity" ${Number(it.qty) >= Number(p.stock ?? 1) ? "disabled title='Maximum stock reached'" : ""}>+</button><small class="eb-cart-stock ${Number(p.stock ?? 1) > 0 ? "" : "unavailable"}">${Number(p.stock ?? 1) > 0 ? `${Number(p.stock)} in stock` : "Out of stock"}</small><button data-remove="${p.id}" style="background:none;color:#d35454;width:auto">Remove</button></div></div></div>`;
      })
      .join(
        "",
      )}</div><aside class="summary"><h3>Order summary</h3><div class="sumrow"><span>Subtotal</span><strong>${money(subtotal)}</strong></div><div class="sumrow"><span>Student delivery</span><strong>Arrange on campus</strong></div><div class="sumrow sumtotal"><span>Total</span><span>${money(subtotal)}</span></div><button class="primary" id="checkout" style="width:100%;margin-top:15px">Continue to payment →</button><p style="font-size:11px;color:var(--muted)">Cash on Delivery only. Delivery charges depend on your address and order value.</p></aside></div></div>`;
    $("#checkout").onclick = () => go("#checkout");
  }
  function checkoutPage() {
    if (!cart.length) {
      app.innerHTML = `<div class="wrap page-title"><h1>Checkout</h1><div class="empty">Your cart is empty. <a href="#shop">Shop now</a></div></div>`;
      return;
    }
    const subtotal = cart.reduce((sum, it) => sum + (products.find((p) => String(p.id) === String(it.id))?.price || 0) * it.qty, 0);
    const deliveryFee = (address, speed) => (subtotal >= 1500 ? 0 : (/college|campus|hostel|nearby/i.test(address) ? 25 : 60)) + (speed === "fast" ? 49 : 0);
    const standardDates = dateRange(12, 14), fastDates = dateRange(5, 7);
    const initialFee = deliveryFee("", "standard");
    app.innerHTML = `<div class="wrap page-title"><a class="textlink" href="#cart">← Back to cart</a><h1>Checkout</h1><p style="color:var(--muted)">Enter delivery details. Cash on Delivery is the only payment method available in EasyBuy.</p><div class="cart-layout"><form class="formcard" id="paymentForm"><h2>Delivery details</h2><div class="formgrid"><div class="field"><label for="payName">Full name</label><input id="payName" name="name" required maxlength="100" autocomplete="name" placeholder="Your name"></div><div class="field"><label for="payPhone">Mobile number</label><input id="payPhone" name="phone" required inputmode="tel" pattern="[0-9 +()-]{10,16}" autocomplete="tel" placeholder="10-digit mobile number"></div><div class="field" style="grid-column:1/-1"><label for="payAddress">Delivery address / college and meeting spot</label><textarea id="payAddress" name="address" required maxlength="400" placeholder="College, area, hostel or delivery address"></textarea></div></div><h2 style="margin-top:24px">Delivery speed</h2><div class="eb-panel" style="padding:16px;margin:10px 0"><label style="display:flex;gap:10px;align-items:flex-start;margin:10px 0"><input type="radio" name="deliverySpeed" value="standard" checked><span><strong>Standard delivery · 12–14 days</strong><br><small>Estimated ${standardDates.label} · Charge: <b id="standardDeliveryOptionFee">${initialFee ? money(initialFee) : "Free"}</b></small></span></label><label style="display:flex;gap:10px;align-items:flex-start;margin:10px 0"><input type="radio" name="deliverySpeed" value="fast"><span><strong>⚡ Fast delivery · 5–7 days</strong><br><small>Estimated ${fastDates.label} · Charge: <b id="fastDeliveryOptionFee">${deliveryFee("", "fast") ? money(deliveryFee("", "fast")) : "Free"}</b></small></span></label><p id="deliveryEstimate" class="eb-help">Estimated delivery: ${standardDates.label}. Actual delivery depends on the seller and delivery location.</p></div><h2 style="margin-top:24px">Payment method</h2><div class="eb-panel" style="padding:16px;margin:10px 0"><strong>💵 Cash on Delivery (COD)</strong><p style="font-size:13px;margin:8px 0 0;color:var(--muted)">Pay the seller in cash when you receive your order. Online payment is not available inside this app. If you prefer GPay/UPI, contact the seller directly and arrange it with them outside EasyBuy; the app will not process or verify that payment.</p></div><input type="hidden" name="paymentMethod" value="Cash on Delivery"><div class="sumrow"><span>Subtotal</span><strong>${money(subtotal)}</strong></div><div class="sumrow"><span>Delivery charge</span><strong id="deliveryFeeValue">${initialFee ? money(initialFee) : "Free"}</strong></div><div class="sumrow sumtotal"><span>Total</span><strong id="checkoutTotal">${money(subtotal + initialFee)}</strong></div><button class="primary" type="submit" style="width:100%;margin-top:18px">Place COD order →</button><p style="font-size:11px;color:var(--muted);margin-top:12px">Delivery charge is estimated from the address and order value: nearby campus/hostel ₹25, other addresses ₹60, and free delivery for orders of ₹1,500 or more. The final charge is shown before placing the order.</p></form><aside class="summary"><h3>Order summary</h3>${cart.map((it) => { const p = products.find((x) => String(x.id) === String(it.id)); return p ? `<div class="sumrow" style="align-items:center;gap:10px"><div style="flex:1"><span>${p.name}</span><div class="qty" style="margin-top:6px"><button type="button" data-checkout-qty="${p.id}" data-delta="-1" aria-label="Decrease ${p.name} quantity">−</button><strong>${it.qty}</strong><button type="button" data-checkout-qty="${p.id}" data-delta="1" aria-label="Increase ${p.name} quantity" ${Number(it.qty) >= Number(p.stock ?? 1) ? "disabled title='Maximum stock reached'" : ""}>+</button></div></div><strong>${money(p.price * it.qty)}</strong></div>` : ""; }).join("")}<div class="sumrow"><span>Subtotal</span><strong>${money(subtotal)}</strong></div><div class="sumrow"><span>Delivery</span><strong id="summaryDelivery">${initialFee ? money(initialFee) : "Free"}</strong></div><div class="sumrow sumtotal"><span>Total</span><strong id="summaryTotal">${money(subtotal + initialFee)}</strong></div></aside></div></div>`;
    const addressInput = $("#payAddress");
    const selectedSpeed = () => document.querySelector('input[name="deliverySpeed"]:checked')?.value || "standard";
    function refreshDelivery() {
      const speed = selectedSpeed(), fee = deliveryFee(addressInput.value, speed), total = subtotal + fee;
      const standardFee = deliveryFee(addressInput.value, "standard"), fastFee = deliveryFee(addressInput.value, "fast");
      $("#standardDeliveryOptionFee").textContent = standardFee ? money(standardFee) : "Free";
      $("#fastDeliveryOptionFee").textContent = fastFee ? money(fastFee) : "Free";
      $("#deliveryFeeValue").textContent = fee ? money(fee) : "Free";
      $("#summaryDelivery").textContent = fee ? money(fee) : "Free";
      $("#checkoutTotal").textContent = $("#summaryTotal").textContent = money(total);
      $("#deliveryEstimate").textContent = speed === "fast" ? `Estimated delivery: ${fastDates.label} (5–7 days). Actual delivery depends on the seller and location.` : `Estimated delivery: ${standardDates.label} (12–14 days). Actual delivery depends on the seller and location.`;
    }
    addressInput.addEventListener("input", refreshDelivery);
    document.querySelectorAll('input[name="deliverySpeed"]').forEach((radio) => radio.addEventListener("change", refreshDelivery));
    $("#paymentForm").addEventListener("submit", async (e) => {
      e.preventDefault();
      if (!e.target.reportValidity()) return;
      const f = new FormData(e.target), email = sessionStorage.getItem("easybuy_js_session_v1");
      if (!email) { toast("Please login before placing an order."); go("#login"); return; }
      const customer = { name: String(f.get("name")).trim(), phone: String(f.get("phone")).trim(), address: String(f.get("address")).trim() };
      const speed = selectedSpeed(), estimate = speed === "fast" ? fastDates : standardDates;
      const payload = { email, customer, paymentMethod: "Cash on Delivery", deliverySpeed: speed, estimatedDeliveryStart: estimate.start, estimatedDeliveryEnd: estimate.end, items: cart.map((it) => { const p = products.find((x) => String(x.id) === String(it.id)); return { id: String(it.id), qty: Number(it.qty), price: Number(p?.price || 0), name: String(p?.name || it.id), category: String(p?.category || "Accessories"), image: String(p?.image || ""), stock: Number(p?.stock ?? 1) }; }) };
      const btn = e.target.querySelector("[type=submit]"); btn.disabled = true; btn.textContent = "Saving order…";
      try {
        const response = await fetch("api-orders.php", { method: "POST", credentials: "same-origin", headers: { "Content-Type": "application/json" }, body: JSON.stringify(payload) });
        const result = await response.json();
        if (!response.ok || !result.ok) throw new Error(result.error || "Order could not be saved");
        const order = { ...result.order, items: payload.items, total: result.order.total, customer };
        payload.items.forEach((orderedItem) => { const liveMatch = String(orderedItem.id).match(/^LIVE-(\d+)$/); if (!liveMatch) return; const listed = products.find((item) => String(item.id) === String(orderedItem.id)); if (listed) listed.stock = Math.max(0, Number(listed.stock ?? 0) - Number(orderedItem.qty || 0)); });
        orders.unshift(order); cart = []; save();
        go("#order-success?order=" + encodeURIComponent(result.order.orderNo || result.order.order_code || ""));
      } catch (err) { toast("Order not saved: " + err.message); btn.disabled = false; btn.textContent = "Place COD order →"; }
    });
  }
  async function cancelOrderFromHistory(code, button) {
    const email = sessionStorage.getItem("easybuy_js_session_v1") || "";
    if (!email) {
      toast("Please sign in to view your orders.");
      return;
    }
    if (
      !confirm(
        "Cancel order " + code + "? This is only available before shipping.",
      )
    )
      return;
    button.disabled = true;
    try {
      const r = await fetch("api-orders.php", {
        method: "PATCH",
        credentials: "same-origin",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          action: "cancel",
          email,
          orderCode: code,
          reason: "Cancelled from My Orders",
        }),
      });
      const d = await r.json();
      if (!r.ok || !d.ok) throw new Error(d.error || "Could not cancel order");
      toast(d.message || "Order cancelled");
      ordersPage();
    } catch (e) {
      toast(e.message);
    } finally {
      button.disabled = false;
    }
  }
  document.addEventListener("click", (e) => {
    const b = e.target.closest("[data-cancel-order]");
    if (b) {
      e.preventDefault();
      cancelOrderFromHistory(b.dataset.cancelOrder, b);
    }
  });
  function sell() {
    app.innerHTML = `<div class="wrap page-title"><h1>Sell to your campus.</h1><p style="color:var(--muted)">Publish your product and it will appear in the EasyBuy catalogue and your listing history on this browser.</p><form class="formcard" id="sellForm"><div class="formgrid"><div class="field"><label>Product name</label><input name="name" required maxlength="100" placeholder="e.g. Physics textbook"></div><div class="field"><label>Category</label><select name="category">${[...new Set(products.map((p) => p.category))].map((c) => `<option>${c}</option>`).join("")}</select></div><div class="field"><label>Price (₹)</label><input name="price" type="number" min="1" max="100000" required placeholder="150"></div><div class="field"><label>Condition</label><select name="condition"><option>Second-hand · Very good</option><option>Second-hand · Good</option><option>First-hand · New</option></select></div><div class="field"><label>College</label><input name="college" required maxlength="100" placeholder="Your college name"></div><div class="field"><label>Contact handle (optional)</label><input name="contact" maxlength="100" placeholder="Student contact handle"></div></div><div class="field"><label>Product photo</label><input name="imageFile" id="sellImage" type="file" accept="image/jpeg,image/png,image/webp,image/gif" required><small style="color:var(--muted)">Upload a clear real photo of the item you are selling. JPG, PNG, WEBP or GIF; maximum 1.5 MB.</small><img id="sellPreview" alt="Selected product preview" style="display:none;max-width:180px;max-height:180px;object-fit:contain;border-radius:12px"></div><div class="field"><label>Description</label><textarea name="description" required maxlength="1200" placeholder="Describe condition, age, included items…"></textarea></div><button class="primary" type="submit">Publish product ↗</button><p style="font-size:12px;color:var(--muted)">This JavaScript-only version saves products in this browser. They will appear in Shop after publishing, but not on other devices.</p></form><div id="myListings"></div></div>`;
    let selectedImage = "";
    const fileInput = $("#sellImage");
    fileInput.onchange = () => {
      const file = fileInput.files && fileInput.files[0];
      if (!file) {
        selectedImage = "";
        $("#sellPreview").style.display = "none";
        return;
      }
      if (!/^image\/(jpeg|png|webp|gif)$/.test(file.type)) {
        toast("Please choose a JPG, PNG, WEBP or GIF image");
        fileInput.value = "";
        return;
      }
      if (file.size > 1500000) {
        toast("Please choose an image smaller than 1.5 MB");
        fileInput.value = "";
        return;
      }
      const reader = new FileReader();
      reader.onload = () => {
        selectedImage = String(reader.result || "");
        $("#sellPreview").src = selectedImage;
        $("#sellPreview").style.display = "block";
      };
      reader.readAsDataURL(file);
    };
    $("#sellForm").onsubmit = (e) => {
      e.preventDefault();
      const f = new FormData(e.target),
        name = String(f.get("name") || "").trim(),
        price = Number(f.get("price"));
      if (!name || !Number.isFinite(price) || price < 1) {
        toast("Enter a product name and valid price");
        return;
      }
      if (!selectedImage) {
        toast("Please upload a product photo before publishing");
        return;
      }
      const id =
          "user-" + Date.now() + "-" + Math.random().toString(36).slice(2, 7),
        category = String(f.get("category")),
        condition = String(f.get("condition")),
        college = String(f.get("college") || "").trim(),
        description = String(f.get("description") || "").trim(),
        fallback =
          "images/categories/" +
          ({
            Electronics: "electronics",
            Books: "books",
            "Stationery Kits": "stationery",
            Calculators: "calculators",
            "Lab Equipment": "lab-equipment",
            Accessories: "accessories",
            "T-Shirts": "clothing",
            Bags: "bags",
          }[category] || "accessories") +
          ".svg";
      const listing = {
        id,
        name,
        category,
        price,
        oldPrice: price,
        condition,
        college,
        seller_name: getDisplaySellerName(),
        contact: String(f.get("contact") || ""),
        description,
        image: selectedImage || fallback,
        date: new Date().toLocaleString(),
        createdAt: Date.now(),
      };
      let mine;
      try {
        mine = JSON.parse(localStorage.getItem("eb_listings") || "[]");
        if (!Array.isArray(mine)) mine = [];
        mine.unshift(listing);
        localStorage.setItem("eb_listings", JSON.stringify(mine));
      } catch (err) {
        toast("Storage is full. Try a smaller product image.");
        return;
      }
      products.unshift({
        id,
        name,
        category,
        price,
        oldPrice: price,
        condition,
        college,
        seller_name: listing.seller_name,
        contact: listing.contact,
        description,
        subtitle: "Student listing",
        image: listing.image,
        rating: 5,
        reviews: 0,
        stock: 1,
        specs: { Seller: "Student listing", Condition: condition },
      });
      e.target.reset();
      selectedImage = "";
      $("#sellPreview").style.display = "none";
      renderMine();
      toast(
        "Product published! It is now available in Shop and product search.",
      );
    };
    function renderMine() {
      const mine = (() => {
        try {
          return JSON.parse(localStorage.getItem("eb_listings") || "[]");
        } catch (_) {
          return [];
        }
      })();
      $("#myListings").innerHTML = mine.length
        ? `<h2 style="margin-top:30px">Your published products</h2>` +
          mine
            .map(
              (x) =>
                `<div class="cart-item"><img src="${x.image || "images/categories/accessories.svg"}" alt="${x.name}" onerror="this.onerror=null;this.src='images/categories/accessories.svg'"><div class="cart-item-info"><strong>${x.name}</strong><div>${x.category} · ${x.condition} · ${x.college}</div><div class="sellerline">👤 Published by ${escapeHtml(x.seller_name || getDisplaySellerName())}</div><b>${money(x.price)}</b><div style="color:var(--muted);font-size:12px">Published ${x.date || ""}</div><a class="textlink" href="#product?id=${encodeURIComponent(x.id)}">View product →</a></div></div>`,
            )
            .join("")
        : '<div class="empty" style="margin-top:25px">You have not published any products yet.</div>';
    }
    renderMine();
  }
  async function trackingPage(orderNo) {
    const email = sessionStorage.getItem("easybuy_js_session_v1");
    if (!email) {
      go("#login");
      return;
    }
    app.innerHTML = `<div class="wrap page-title"><a class="textlink" href="#orders">← My Orders</a><h1>Track your order</h1><p>Loading order details…</p></div>`;
    try {
      const r = await fetch(
        `api-orders.php?email=${encodeURIComponent(email)}`,
        { credentials: "same-origin" },
      );
      const raw = await r.text();
      let d;
      try { d = JSON.parse(raw); }
      catch (_) {
        const preview = raw.replace(/\s+/g, " ").slice(0, 220);
        throw new Error(`Tracking API returned non-JSON (HTTP ${r.status}). Check /ready/api-health.php and PHP error log. Response: ${preview || "empty response"}`);
      }
      if (!r.ok || !d.ok) throw new Error(d.error || `Could not load orders (HTTP ${r.status})`);
      if (!orderNo) {
        const list = Array.isArray(d.orders) ? d.orders : [];
        app.innerHTML = `<div class="wrap page-title"><a class="textlink" href="#orders">← My Orders</a><span class="eyebrow">ORDER TRACKING</span><h1>Choose an order to track</h1><p style="color:var(--muted)">Select one of your orders to see shipping status, shipper name and tracking updates.</p>${list.length ? `<div class="eb-my-products-list">${list.map((item) => `<article class="cart-item"><div class="cart-item-info"><strong>Order ${escapeHtml(item.order_code || item.orderNo || item.id)}</strong><p>Status: ${escapeHtml(item.status || "Placed")} · ${new Date(item.created_at || item.date).toLocaleDateString("en-IN")}</p><p>Total: ${money(Number(item.total || 0))}</p><button type="button" class="primary" data-track-order="${escapeHtml(item.order_code || item.orderNo || item.id)}">Track this order →</button></div></article>`).join("")}</div>` : `<div class="empty"><h2>No orders yet</h2><p>Place an order first, then you can track it here.</p><a class="primary" href="#shop">Browse products</a></div>`}</div>`;
        return;
      }
      const o = d.orders.find(
        (x) =>
          String(x.order_code || x.orderNo) === String(orderNo) ||
          String(x.id) === String(orderNo),
      );
      if (!o) {
        app.innerHTML = `<div class="wrap page-title"><h1>Order not found</h1><p>This order is not available in your account.</p><a class="primary" href="#orders">Back to My Orders</a></div>`;
        return;
      }
      const stages = ["Placed", "Confirmed", "Shipped", "Delivered"];
      const current = stages.indexOf(o.status);
      const isCancelled = o.status === "Cancelled";
      app.innerHTML = `<div class="wrap page-title"><a class="textlink" href="#orders">← My Orders</a><span class="eyebrow">ORDER TRACKING</span><h1>${o.order_code || o.orderNo}</h1><p>Placed ${new Date(o.created_at || o.date).toLocaleString()}</p><section class="eb-panel" style="margin:22px 0"><h2>Status timeline</h2><div class="eb-tracking-timeline">${stages.map((x, i) => `<div class="eb-track-step ${i <= current ? "done" : ""}"><span>${i < current ? "✓" : i + 1}</span><strong>${x}</strong></div>`).join("")}</div><p><strong>Current status:</strong> ${o.status}</p>${(o.estimated_delivery_start || o.estimatedDeliveryStart) && (o.estimated_delivery_end || o.estimatedDeliveryEnd) ? `<div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:12px;padding:16px;margin:16px 0"><h3 style="margin:0 0 8px">📦 Expected delivery</h3><p style="font-size:18px;font-weight:800;margin:0">${new Date((o.estimated_delivery_start || o.estimatedDeliveryStart) + "T12:00:00").toLocaleDateString("en-IN", {day:"numeric",month:"long",year:"numeric"})} – ${new Date((o.estimated_delivery_end || o.estimatedDeliveryEnd) + "T12:00:00").toLocaleDateString("en-IN", {day:"numeric",month:"long",year:"numeric"})}</p><p style="margin:6px 0 0">Delivery speed: ${(o.delivery_speed || o.deliverySpeed) === "fast" ? "⚡ Fast delivery (5–7 days)" : "Standard delivery (12–14 days)"}</p></div>` : `<p class="eb-help">Expected delivery dates are not available for this older order.</p>`}${isCancelled ? '<p class="eb-help">This order was cancelled. Check My Orders for details.</p>' : ""}<p>${o.customer_name || o.customer?.name || ""} · ${o.customer_phone || o.customer?.phone || ""}</p><p>${o.delivery_address || o.customer?.address || ""}</p></section>${o.deliveryOtp ? `<section class="eb-panel" style="margin:18px 0;border:1px solid #2874f0"><h2>🔐 Delivery OTP</h2><p>Show this code to the seller only when you receive the product.</p><div style="font-size:32px;font-weight:800;letter-spacing:8px;color:#185adb">${o.deliveryOtp}</div><p class="eb-help">Demo delivery code. SMS delivery is not configured in this project.</p></section>` : ""}${o.deliveryOtpVerified ? '<section class="eb-panel"><h2>✓ Product received</h2><p>Your delivery OTP was verified. EasyBuy has saved a delivery confirmation message.</p></section>' : ""}<section class="eb-panel"><h2>Products</h2>${(o.items || []).map((it) => `<div class="cart-item"><img src="${it.image || "images/categories/accessories.svg"}" alt="" onerror="this.src='images/categories/accessories.svg'"><div class="cart-item-info"><strong>${it.name || it.product_name}</strong><p>${it.category || ""} · Qty ${it.qty || it.quantity}</p><b>${money(Number(it.price || it.unit_price) * (Number(it.qty || it.quantity) || 1))}</b></div></div>`).join("")}<h2>Total: ${money(o.total)}</h2><p>Payment: ${o.payment_method || o.paymentMethod} · ${o.payment_status || o.paymentStatus}</p><a class="primary" href="api-invoice.php?email=${encodeURIComponent(email)}&order=${encodeURIComponent(o.order_code || o.orderNo)}">⬇ Download Invoice PDF</a></section><section class="eb-panel" style="margin-top:20px"><h2>Shipping & tracking</h2><p><strong>Shipper:</strong> ${escapeHtml(o.shipperName || "Not assigned yet")}</p><p><strong>Tracking number:</strong> ${escapeHtml(o.trackingNumber || "Not available")}</p>${getCourierTrackingUrl(o.trackingUrl) ? `<p><a class="primary" target="_blank" rel="noopener noreferrer" href="${escapeHtml(getCourierTrackingUrl(o.trackingUrl))}">Open courier tracking ↗</a></p>` : (o.trackingUrl ? `<p class="eb-help">Courier tracking link is not valid. Seller must enter the courier company's real website URL (not an EasyBuy localhost tracking link).</p>` : "")}<h3>Tracking updates</h3>${(o.tracking || []).map((t) => `<p><strong>${escapeHtml(t.status)}</strong> · ${new Date(t.created_at).toLocaleString()}<br>${escapeHtml(t.note || "")}</p>`).join("") || "<p>Order created successfully.</p>"}</section>${o.status === "Delivered" && !o.returnRequest ? `<section class="eb-panel" style="margin-top:20px"><h2>Return request (within 48 hours)</h2><p>Received: ${o.receivedAt ? new Date(o.receivedAt.replace(" ","T")).toLocaleString("en-IN") : "Delivery confirmed"}. Return eligibility is checked by the server.</p><form id="ebReturnForm"><label>Reason for return<textarea name="reason" minlength="5" maxlength="500" required placeholder="Tell us why you want to return this item"></textarea></label><button class="primary">Submit return request</button><p id="ebReturnNotice" role="status"></p></form></section>` : o.returnRequest ? `<section class="eb-panel" style="margin-top:20px"><h2>Return & refund status</h2><p><strong>${escapeHtml(o.returnRequest.status)}</strong> · ${escapeHtml(o.returnRequest.reason)}</p><p>Refund amount: ${money(Number(o.returnRequest.refund_amount || 0))}</p><h3>Refund update history</h3>${(o.returnHistory || []).length ? (o.returnHistory || []).map(h => `<p><strong>${escapeHtml(h.status)}</strong> · ${new Date(h.created_at).toLocaleString("en-IN")}<br>${escapeHtml(h.note || "Status updated")}</p>`).join("") : `<p class="eb-help">Request created · ${new Date(o.returnRequest.created_at).toLocaleString("en-IN")}. Further updates will appear here.</p>`}</section>` : ""}${o.status === "Delivered" ? `<section class="eb-panel" style="margin-top:20px"><h2>Rate your purchase</h2>${(o.items || []).map(it => { const existing=(o.feedback||[]).find(f=>String(f.product_code)===String(it.id)); return `<form class="ebFeedbackForm" data-product-code="${escapeHtml(it.id)}" style="border-top:1px solid #e5e7eb;padding:12px 0"><strong>${escapeHtml(it.name || it.product_name)}</strong>${existing ? `<p>Saved rating: ${"★".repeat(Number(existing.rating))}${"☆".repeat(5-Number(existing.rating))} · ${escapeHtml(existing.comment || "")}</p>` : `<label>Rating <select name="rating" required><option value="">Choose stars</option><option value="1">1 star</option><option value="2">2 stars</option><option value="3">3 stars</option><option value="4">4 stars</option><option value="5">5 stars</option></select></label><label>Feedback <textarea name="comment" maxlength="1000" placeholder="Share your experience"></textarea></label><button class="secondary">Save rating</button>`}</form>`; }).join("")}<p id="ebFeedbackNotice" role="status"></p></section>` : ""}</div>`;
      const returnForm = document.querySelector("#ebReturnForm");
      returnForm?.addEventListener("submit", async (ev) => { ev.preventDefault(); const notice=document.querySelector("#ebReturnNotice"); try { const rr=await fetch("api-order-features.php",{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json"},body:JSON.stringify({action:"return_request",email,orderCode:o.order_code||o.orderNo,reason:new FormData(returnForm).get("reason")})}); const rd=await rr.json(); if(!rr.ok||!rd.ok) throw new Error(rd.error||"Return request failed"); notice.textContent=rd.message; trackingPage(orderNo); } catch(err) { notice.textContent=err.message; } });
      document.querySelectorAll(".ebFeedbackForm").forEach(form => form.addEventListener("submit", async ev => { ev.preventDefault(); const fd=new FormData(form); try { const rr=await fetch("api-order-features.php",{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json"},body:JSON.stringify({action:"feedback",email,orderCode:o.order_code||o.orderNo,productCode:form.dataset.productCode,rating:fd.get("rating"),comment:fd.get("comment")})}); const rd=await rr.json(); if(!rr.ok||!rd.ok) throw new Error(rd.error||"Feedback failed"); document.querySelector("#ebFeedbackNotice").textContent=rd.message; trackingPage(orderNo); } catch(err) { document.querySelector("#ebFeedbackNotice").textContent=err.message; } }));
    } catch (e) {
      app.innerHTML = `<div class="wrap page-title"><h1>Tracking unavailable</h1><p>${e.message}. Make sure XAMPP MySQL is running and the database is configured.</p><a class="primary" href="#orders">Back to My Orders</a></div>`;
    }
  }
  function orderSuccessPage(orderCode) {
    const email = sessionStorage.getItem("easybuy_js_session_v1") || "";
    app.innerHTML = `<div class="wrap page-title"><section class="eb-panel" style="max-width:760px;margin:30px auto;text-align:center;padding:clamp(24px,5vw,54px)"><div style="width:84px;height:84px;border-radius:50%;display:grid;place-items:center;background:#dcfce7;color:#15803d;font-size:48px;font-weight:900;margin:0 auto 20px">✓</div><span class="eyebrow">EASYBUY ORDER CONFIRMATION</span><h1 style="margin:10px 0">Order placed successfully!</h1><p style="color:var(--muted)">Your order has been saved. Keep your order ID for tracking.</p><div style="display:inline-block;background:#f1f5f9;border-radius:12px;padding:14px 22px;margin:14px 0"><small style="display:block;color:var(--muted)">ORDER ID</small><strong style="font-size:20px">${String(orderCode || "").replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[c])}</strong></div><p id="ebSuccessDetails" style="color:var(--muted)">Loading saved order details…</p><div class="eb-action-row" style="justify-content:center;margin-top:22px"><a class="primary" href="#orders">View My Orders →</a><a class="secondary" href="#shop">Continue shopping</a></div></section></div>`;
    if (!email || !orderCode) {
      $("#ebSuccessDetails").textContent = "Order confirmed.";
      return;
    }
    fetch(`api-orders.php?email=${encodeURIComponent(email)}`, {
      credentials: "same-origin",
    })
      .then((r) => r.json())
      .then((d) => {
        const o = (d.orders || []).find(
          (x) => (x.order_code || x.orderNo) === orderCode,
        );
        if (o && $("#ebSuccessDetails"))
          $("#ebSuccessDetails").textContent =
            `${(o.items || []).length} item(s) · Total ${money(Number(o.total) || 0)} · Payment: ${o.payment_method || o.paymentMethod || "—"}`;
      })
      .catch(() => {
        if ($("#ebSuccessDetails"))
          $("#ebSuccessDetails").textContent =
            "Order saved. You can review its details in My Orders.";
      });
  }
  function ordersPage() {
    const email = sessionStorage.getItem("easybuy_js_session_v1") || "";
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">ORDER CENTRE</span><h1>My Orders</h1><p style="color:var(--muted)">View product details, follow delivery progress, and download your invoice.</p><div id="ebOrdersList">Loading saved orders…</div></div>`;
    const render = (list) => {
      orders = list;
      save();
      const box = $("#ebOrdersList");
      if (!box) return;
      box.innerHTML = list.length
        ? list
            .map((o) => {
              const code = o.order_code || o.orderNo || o.id;
              const items = o.items || [];
              const first = items[0] || {};
              const firstId = first.id || first.product_code || "";
              return `<article class="eb-panel" style="margin:16px 0"><div class="sectionhead"><div><span class="eyebrow">ORDER ID</span><h2>${code}</h2><p>${new Date(o.created_at || o.date || Date.now()).toLocaleString()}</p>${(o.estimated_delivery_start || o.estimatedDeliveryStart) ? `<p><strong>📦 Expected delivery:</strong> ${new Date((o.estimated_delivery_start || o.estimatedDeliveryStart) + "T12:00:00").toLocaleDateString("en-IN", {day:"numeric",month:"short",year:"numeric"})} – ${new Date((o.estimated_delivery_end || o.estimatedDeliveryEnd) + "T12:00:00").toLocaleDateString("en-IN", {day:"numeric",month:"short",year:"numeric"})} · ${(o.delivery_speed || o.deliverySpeed) === "fast" ? "⚡ Fast" : "Standard"}</p>` : ""}</div><strong class="eb-order-status">${o.status || "Placed"}</strong></div><div>${items.map((it) => `<div class="cart-item"><img src="${it.image || "images/categories/accessories.svg"}" alt="" onerror="this.src='images/categories/accessories.svg'"><div class="cart-item-info"><strong>${it.name || it.product_name || it.id}</strong><div>${it.category || ""} · Qty ${it.qty || it.quantity || 1}</div><b>${money(Number(it.price || it.unit_price || 0) * Number(it.qty || it.quantity || 1))}</b></div></div>`).join("")}</div><div class="sumrow sumtotal"><span>Order total</span><strong>${money(o.total)}</strong></div><p>Payment: ${o.payment_method || o.paymentMethod || "—"} · ${o.payment_status || o.paymentStatus || "—"}</p><div class="eb-action-row"><button class="primary" type="button" data-track-order="${code}">Track Order</button>${firstId ? `<a class="secondary" href="#product?id=${encodeURIComponent(firstId)}">View Product</a>` : ""}<a class="secondary" href="api-invoice.php?email=${encodeURIComponent(email)}&order=${encodeURIComponent(code)}">⬇ Download Invoice PDF</a>${["Placed", "Confirmed"].includes(o.status) ? `<button class="secondary" type="button" data-cancel-order="${code}">Cancel order</button>` : ""}</div></article>`;
            })
            .join("")
        : '<div class="empty">No database orders found yet. Place an order after setting up MySQL.</div>';
    };
    fetch(`api-orders.php?email=${encodeURIComponent(email)}`, {
      credentials: "same-origin",
    })
      .then((r) => r.json())
      .then((d) => {
        if (!d.ok) throw new Error(d.error || "Failed");
        render(d.orders || []);
      })
      .catch(() => render(orders.filter((o) => o.orderNo || o.order_code)));
  }
  function toast(msg) {
    let t = $("#toast");
    if (!t) {
      t = document.createElement("div");
      t.id = "toast";
      t.style.cssText =
        "position:fixed;bottom:22px;left:50%;transform:translateX(-50%);z-index:10000;background:#14213d;color:white;padding:13px 19px;border-radius:12px;box-shadow:0 10px 35px #14213d33;font-weight:700;font-size:13px";
      document.body.append(t);
    }
    t.textContent = msg;
    t.style.opacity = "1";
    clearTimeout(window.ebToastTimer);
    window.ebToastTimer = setTimeout(() => (t.style.opacity = "0"), 2200);
  }
  function wishlistPage() {
    const saved = wishlist
      .map((id) => products.find((p) => String(p.id) === String(id)))
      .filter(Boolean);
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">YOUR SAVED FINDS</span><h1>My Wishlist</h1><p style="color:var(--muted)">Products you save will be waiting here when you need them.</p>${saved.length ? `<div class="sectionhead"><div><h2>Saved products</h2><p>${saved.length} product${saved.length === 1 ? "" : "s"} in your wishlist</p></div><button class="secondary" id="clearWishlist" type="button">Clear wishlist</button></div><div class="product-grid">${saved.map(card).join("")}</div>` : `<div class="empty"><div style="font-size:50px">♡</div><h2>Your wishlist is empty</h2><p>Tap the heart on any product to save it here.</p><a class="primary" href="#shop">Explore products</a></div>`}</div>`;
    const clear = $("#clearWishlist");
    if (clear)
      clear.addEventListener("click", () => {
        wishlist = [];
        save();
        wishlistPage();
        toast("Wishlist cleared");
      });
  }
  function myProductsPage() {
    const mine = readArray("eb_listings");
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">SELLER STUDIO</span><h1>My Products</h1><p style="color:var(--muted)">Products you have published from this browser.</p><div class="eb-action-row"><a class="primary" href="#sell">＋ Sell a product</a><a class="secondary" href="">Open Seller Dashboard</a></div>${mine.length ? `<div class="sectionhead"><div><h2>Your published listings</h2><p>${mine.length} product${mine.length === 1 ? "" : "s"}</p></div></div><div class="eb-my-products-list">${mine.map((x) => `<article class="cart-item"><img src="${x.image || "images/categories/accessories.svg"}" alt="${String(x.name || "Product").replace(/[&<>"]/g, "")}" onerror="this.onerror=null;this.src='images/categories/accessories.svg'"><div class="cart-item-info"><strong>${String(x.name || "Untitled product")}</strong><div>${String(x.category || "") } · ${String(x.condition || "")}</div><b>${money(Number(x.price) || 0)}</b><div style="color:var(--muted);font-size:12px">Published ${String(x.date || "")}</div><a class="textlink" href="#product?id=${encodeURIComponent(x.id || "")}">View product →</a></div></article>`).join("")}</div>` : `<div class="empty"><h2>No products published yet</h2><p>Start by adding your first campus listing.</p><a class="primary" href="#sell">Sell a product</a></div>`}</div>`;
  }
  function recordProductHistory(id) {
    if (id === undefined || id === null || String(id) === "") return;
    let history = [];
    try {
      const stored = JSON.parse(
        localStorage.getItem("eb_product_history") || "[]",
      );
      if (Array.isArray(stored)) history = stored.map(String);
    } catch (_) {}
    history = [String(id), ...history.filter((x) => x !== String(id))].slice(
      0,
      24,
    );
    try {
      localStorage.setItem("eb_product_history", JSON.stringify(history));
    } catch (_) {}
  }
  function productHistoryPage() {
    let ids = [];
    try {
      const stored = JSON.parse(
        localStorage.getItem("eb_product_history") || "[]",
      );
      ids = Array.isArray(stored) ? stored.map(String) : [];
    } catch (_) {
      ids = [];
    }
    const seen = ids
      .map((id) => products.find((p) => String(p.id) === id))
      .filter(Boolean);
    app.innerHTML = `<section class="section"><div class="wrap"><div class="page-title"><span class="eyebrow">YOUR ACTIVITY</span><h1>Product History</h1><p style="color:var(--muted)">Recently viewed products are saved on this device.</p></div><div class="sectionhead"><div><h2>Recently viewed</h2><p>${seen.length} product${seen.length === 1 ? "" : "s"} in your history</p></div>${seen.length ? '<button class="secondary" id="clearProductHistory" type="button">Clear history</button>' : ""}</div>${seen.length ? `<div class="product-grid">${seen.map(card).join("")}</div>` : `<div class="eb-history-empty"><div class="eb-history-icon">◷</div><h3>No product history yet</h3><p>Open any product from Shop and it will appear here, so you can find it again easily.</p><a class="primary" href="#shop">Explore products</a></div>`}</div></section>`;
    const clear = $("#clearProductHistory");
    if (clear)
      clear.addEventListener("click", () => {
        localStorage.removeItem("eb_product_history");
        productHistoryPage();
        toast("Product history cleared");
      });
  }
  async function messagesPage() {
    const params = new URLSearchParams(location.hash.split("?")[1] || "");
    const productId = params.get("product") || "";
    const product = products.find(x => String(x.id) === productId);
    const to = params.get("to") || (product && product.seller_email) || "";
    const sellerName = params.get("name") || (product && (product.seller_name || product.sellerName)) || "Seller";
    const key = "eb_buyer_email";
    const savedEmail = localStorage.getItem(key) || "";
    app.innerHTML = `<div class="wrap page-title"><span class="eyebrow">EASYBUY MESSAGES</span><h1>Message the seller</h1><p>Ask about product details, pickup point, map location, or refund updates. Messages are saved in the EasyBuy database.</p>${product ? `<section class="eb-panel"><strong>${escapeHtml(product.name)}</strong><p>${escapeHtml(product.college || "College not provided")}</p></section>` : ""}<form class="formcard" id="buyerMessageForm"><div class="field"><label>Your email</label><input type="email" name="email" required value="${escapeHtml(savedEmail)}" placeholder="you@example.com"></div><div class="field"><label>Seller email</label><input type="email" name="to" required value="${escapeHtml(to)}" placeholder="Seller email from product listing" ${to ? "readonly" : ""}></div><div class="field"><label>Message</label><textarea name="body" minlength="2" maxlength="5000" required placeholder="Hi, can you share the public pickup location and Google Maps link?"></textarea></div><button class="primary" type="submit">Send message</button><p id="buyerMessageNotice" role="status"></p></form><section class="eb-panel" style="margin-top:18px"><div class="sectionhead"><div><h2>Conversation history</h2><p>Enter your email above to load saved messages.</p></div><button class="secondary" id="loadBuyerMessages" type="button">Refresh messages</button></div><div id="buyerMessageHistory">No messages loaded yet.</div></section></div>`;
    const form = document.querySelector("#buyerMessageForm");
    async function loadHistory() {
      const email = String(form.elements.email.value || "").trim().toLowerCase();
      if (!email) return;
      try {
        const r = await fetch(`api-messages.php?email=${encodeURIComponent(email)}`, {credentials:"same-origin", headers:{Accept:"application/json"}});
        const d = await r.json(); if (!r.ok || !d.ok) throw new Error(d.error || "Could not load messages");
        const relevant = (d.messages || []).filter(m => !to || m.sender_email === to || m.recipient_email === to);
        document.querySelector("#buyerMessageHistory").innerHTML = relevant.length ? relevant.map(m => `<article style="border-bottom:1px solid #e5e7eb;padding:10px 0"><strong>${escapeHtml(m.sender_role === "seller" ? "Seller" : "You")}</strong><small> · ${new Date(m.created_at).toLocaleString("en-IN")}</small><p>${escapeHtml(m.body)}</p></article>`).join("") : "No messages yet for this seller.";
      } catch (err) { document.querySelector("#buyerMessageHistory").textContent = err.message; }
    }
    document.querySelector("#loadBuyerMessages").addEventListener("click", loadHistory);
    form.addEventListener("submit", async ev => {
      ev.preventDefault(); const b=form.querySelector("button[type=submit]"); b.disabled=true;
      const email=String(form.elements.email.value||"").trim().toLowerCase(); localStorage.setItem(key,email);
      try {
        const r=await fetch("api-messages.php",{method:"POST",credentials:"same-origin",headers:{"Content-Type":"application/json",Accept:"application/json"},body:JSON.stringify({email,to:String(form.elements.to.value||"").trim().toLowerCase(),body:String(form.elements.body.value||"").trim(),productCode:productId,threadKey:""})});
        const d=await r.json(); if(!r.ok||!d.ok) throw new Error(d.error||"Message could not be sent");
        document.querySelector("#buyerMessageNotice").textContent="Message sent and saved."; form.elements.body.value=""; await loadHistory();
      } catch(err) { document.querySelector("#buyerMessageNotice").textContent=err.message; } finally { b.disabled=false; }
    });
    await loadHistory();
  }
  function route(showLoader = true) {
    let hash = location.hash || "#home";
    let [path] = hash.slice(1).split("?");
    // Authentication routes are rendered only by auth.js. Without this guard,
    // the marketplace router can replace the login form with the home page.
    if (["login", "signup", "account", "logout"].includes(path)) return;
    if (path === "refunds") return;
    if (showLoader) loader();
    if (path === "messages") messagesPage();
    else if (path === "shop") shop();
    else if (path === "discover") discover();
    else if (path === "cart") cartPage();
    else if (path === "wishlist") wishlistPage();
    else if (path === "checkout") checkoutPage();
    else if (path === "order-success")
      orderSuccessPage(
        new URLSearchParams(hash.split("?")[1] || "").get("order") || "",
      );
    else if (path === "sell") sell();
    else if (path === "my-products") myProductsPage();
    else if (path === "orders") ordersPage();
    else if (path === "tracking")
      trackingPage(
        new URLSearchParams(hash.split("?")[1] || "").get("order") || "",
      );
    else if (path === "product-history") productHistoryPage();
    else if (path === "product") {
      const viewedId = new URLSearchParams(hash.split("?")[1] || "").get("id");
      if (viewedId) recordProductHistory(viewedId);
      detail(viewedId);
    } else home();
    initEasyBuyCarousel();
    updateCount();
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
  document.addEventListener("click", (e) => {
    const target = e.target instanceof Element ? e.target : e.target?.parentElement;
    if (!target) return;
    const tr = target.closest("[data-track-order]");
    if (tr) {
      e.preventDefault();
      go("#tracking?order=" + encodeURIComponent(tr.dataset.trackOrder));
      return;
    }
    let a = target.closest("[data-add]");
    if (a) {
      e.preventDefault();
      add(a.dataset.add);
      return;
    }
    let w = target.closest("[data-wish]");
    if (w) {
      e.preventDefault();
      e.stopPropagation();
      wish(w.dataset.wish);
      return;
    }
    let v = target.closest("[data-view]");
    if (v) {
      e.preventDefault();
      const target = "#product?id=" + encodeURIComponent(v.dataset.view);
      if (String(v.dataset.view).startsWith("LIVE-")) fetch("api-product-view.php", { method: "POST", credentials: "same-origin", headers: { "Content-Type": "application/json", "Accept": "application/json" }, body: JSON.stringify({ productId: String(v.dataset.view) }) }).catch(() => {});
      if (location.hash === target) {
        recordProductHistory(v.dataset.view);
        detail(v.dataset.view);
        window.scrollTo({ top: 0, behavior: "smooth" });
      } else go(target);
      return;
    }
    let cq = target.closest("[data-checkout-qty]");
    if (cq) {
      const item = cart.find((x) => String(x.id) === String(cq.dataset.checkoutQty));
      const product = products.find((x) => String(x.id) === String(cq.dataset.checkoutQty));
      if (!item || !product) return;
      const nextQty = Number(item.qty) + Number(cq.dataset.delta);
      const stock = Math.max(0, Number(product.stock ?? 1));
      if (nextQty > stock) { toast(`Only ${stock} unit${stock === 1 ? "" : "s"} available.`); return; }
      if (nextQty <= 0) cart = cart.filter((x) => x !== item); else item.qty = nextQty;
      const form = document.querySelector("#paymentForm");
      const values = form ? Object.fromEntries(new FormData(form).entries()) : {};
      save();
      checkoutPage();
      const newForm = document.querySelector("#paymentForm");
      if (newForm) {
        Object.entries(values).forEach(([key, value]) => { const field = newForm.elements.namedItem(key); if (!field) return; if (field instanceof RadioNodeList) { [...field].forEach((el) => { if (el.value === value) el.checked = true; }); } else field.value = value; });
        newForm.querySelector('input[name="deliverySpeed"]:checked')?.dispatchEvent(new Event("change", { bubbles: true }));
        newForm.querySelector('[name="address"]')?.dispatchEvent(new Event("input", { bubbles: true }));
      }
      return;
    }
    let q = target.closest("[data-qty]");
    if (q) {
      let it = cart.find((x) => String(x.id) === String(q.dataset.qty));
      const p = products.find((x) => String(x.id) === String(q.dataset.qty));
      if (!it || !p) return;
      const nextQty = Number(it.qty) + Number(q.dataset.delta);
      const stock = Math.max(0, Number(p.stock ?? 1));
      if (nextQty > stock) {
        toast(`Only ${stock} unit${stock === 1 ? "" : "s"} available.`);
        return;
      }
      if (nextQty <= 0) cart = cart.filter((x) => x !== it);
      else it.qty = nextQty;
      save();
      cartPage();
      return;
    }
    let r = e.target.closest("[data-remove]");
    if (r) {
      cart = cart.filter((x) => x.id !== r.dataset.remove);
      save();
      cartPage();
      return;
    }
    let b = e.target.closest("[data-buy]");
    if (b) {
      const id = b.dataset.buy;
      const product = products.find((p) => String(p.id) === String(id));
      if (product && Number(product.stock ?? 1) > 0) {
        cart = [{ id: product.id, qty: 1 }];
        save();
        go("#checkout");
      } else toast("This product is out of stock.");
    }
  });
  window.addEventListener("hashchange", () => route());
  $("#navSearch").addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      go("#shop");
      setTimeout(() => {
        if ($("#shopSearch")) {
          $("#shopSearch").value = e.target.value;
          $("#shopSearch").dispatchEvent(new Event("input"));
        }
      }, 120);
    }
  });
  updateCount();
  route(false);
  // Auto-rotating homepage category carousel; pause while hovered/focused.
  function initEasyBuyCarousel() {
    const root = document.querySelector("#ebCarousel");
    if (!root || root.dataset.ready) return;
    root.dataset.ready = "1";
    const slides = [...root.querySelectorAll(".eb-slide")],
      dots = [...root.querySelectorAll(".eb-carousel-dots button")];
    if (window.ebCarouselTimer) clearInterval(window.ebCarouselTimer);
    let idx = 0;
    const show = (n) => {
      idx = (n + slides.length) % slides.length;
      slides.forEach((el, i) => el.classList.toggle("active", i === idx));
      dots.forEach((el, i) => el.classList.toggle("active", i === idx));
      const count = root.querySelector(".eb-slide-count");
      if (count) count.textContent = idx + 1 + "/" + slides.length;
    };
    const start = () => {
      clearInterval(window.ebCarouselTimer);
      window.ebCarouselTimer = setInterval(() => show(idx + 1), 4000);
    };
    root.querySelector(".prev")?.addEventListener("click", () => {
      show(idx - 1);
      start();
    });
    root.querySelector(".next")?.addEventListener("click", () => {
      show(idx + 1);
      start();
    });
    dots.forEach((d, i) =>
      d.addEventListener("click", () => {
        show(i);
        start();
      }),
    );
    root.addEventListener("mouseenter", () =>
      clearInterval(window.ebCarouselTimer),
    );
    root.addEventListener("mouseleave", start);
    root.addEventListener("focusin", () =>
      clearInterval(window.ebCarouselTimer),
    );
    root.addEventListener("focusout", start);
    show(0);
    start();
  }
  initEasyBuyCarousel();
  document.addEventListener("click", (e) => {
    const a = e.target.closest("[data-contact-missing]");
    if (a) {
      e.preventDefault();
      alert(
        "Seller contact number is not available for this listing yet. Please open View product or message the seller if contact details are shown.",
      );
    }
  });
  // Load seller-published database products into the same catalogue used by cart and checkout.
  // IDs are returned as LIVE-<database id>, which api-orders.php maps back to products.seller_id.
  fetch("api-products.php", {
    credentials: "same-origin",
    headers: { Accept: "application/json" },
  })
    .then((r) =>
      r.ok ? r.json() : Promise.reject(new Error("Live catalogue unavailable")),
    )
    .then((d) => {
      if (!d || !d.ok || !Array.isArray(d.products)) return;
      let changed = false;
      d.products.forEach((p) => {
        const existing = products.find((item) => String(item.id) === String(p.id));
        if (existing) {
          existing.stock = Number(p.stock ?? 0);
          existing.price = Number(p.price) || 0;
          if (p.oldPrice !== undefined && p.oldPrice !== null) existing.oldPrice = Number(p.oldPrice) || 0;
          if (p.seller_name) existing.seller_name = p.seller_name;
          if (p.seller_email) existing.seller_email = p.seller_email;
          if (p.contact) existing.contact = p.contact;
          existing.name = String(p.name || existing.name);
          existing.image = String(p.image || existing.image);
          existing.category = String(p.category || existing.category);
          existing.condition = String(p.condition || existing.condition);
          existing.college = String(p.college || existing.college);
          existing.pickup_location = String(p.pickup_location || existing.pickup_location || "");
          existing.pickup_map_url = String(p.pickup_map_url || existing.pickup_map_url || "");
        } else {
          products.push({
            ...p,
            id: String(p.id),
            price: Number(p.price) || 0,
            oldPrice: Number(p.oldPrice ?? p.price) || 0,
            stock: Number(p.stock ?? 1),
            image: String(p.image || "images/categories/accessories.svg"),
            condition: String(p.condition || "Second-hand · Good"),
            college: String(p.college || "Student seller"),
            rating: Number(p.rating) || 0,
            reviews: Number(p.reviews) || 0,
          });
          changed = true;
        }
      });
      // Re-render current view so updated database stock and sold-out states are visible.
      route(false);
    })
    .catch(() => {
      /* Keep the existing catalogue usable when MySQL is unavailable. */
    });
})();


/* ===== js/live-catalog.js ===== */
// Merge server-published seller listings into the existing EasyBuy catalogue.
// Existing bundled products and buyer-side features remain intact.
(async function () {
  try {
    const response = await fetch("api-products.php", {
      credentials: "same-origin",
      headers: { Accept: "application/json" },
    });
    if (!response.ok) return;
    const data = await response.json();
    if (!data.ok || !Array.isArray(data.products)) return;
    const products = window.EASYBUY_PRODUCTS;
    if (!Array.isArray(products)) return;
    for (const live of data.products) {
      const id = String(live.id);
      const index = products.findIndex((p) => String(p.id) === id);
      if (index >= 0) products[index] = { ...products[index], ...live };
      else products.unshift(live);
    }
    // Re-render current page so listings published by sellers appear without a reload.
    window.dispatchEvent(
      new CustomEvent("easybuy:live-catalog-loaded", {
        detail: { count: data.products.length },
      }),
    );
    if (location.hash === "#shop" || location.hash.startsWith("#shop?"))
      window.dispatchEvent(new HashChangeEvent("hashchange"));
    else if (!location.hash || location.hash === "#home")
      window.dispatchEvent(new HashChangeEvent("hashchange"));
  } catch (error) {
    // Keep the original catalogue usable if the local API/database is not configured yet.
    console.warn(
      "EasyBuy live catalogue unavailable; showing bundled catalogue.",
      error,
    );
  }
})();


/* ===== js/features.js ===== */
(() => {
  "use strict";
  const $ = (s) => document.querySelector(s),
    app = $("#app"),
    products = window.EASYBUY_PRODUCTS || [];
  const categoryOrder = [
    "Books",
    "Stationery Kits",
    "Calculators",
    "Lab Equipment",
    "Electronics",
    "Accessories",
    "T-Shirts",
    "Bags",
  ];
  const categories = categoryOrder.filter((c) =>
    products.some((p) => p.category === c),
  );
  const colleges = [
    "SASTRA University",
    "Anna University",
    "Indian Institute of Technology Madras (IIT Madras)",
    "SRM Institute of Science and Technology",
    "VIT Chennai",
    "University of Madras",
    "Saveetha Institute of Medical and Technical Sciences",
    "Annamalai University",
    "Bharathiar University",
    "Bharathidasan University",
    "Hindustan Institute of Technology and Science",
    "Vel Tech University",
    "Chennai Institute of Technology",
    "Rajalakshmi Engineering College",
    "Sri Sairam Engineering College",
    "R.M.K. Engineering College",
    "Madras Institute of Technology (MIT Chennai)",
    "PSG College of Technology",
    "Kumaraguru College of Technology",
    "Coimbatore Institute of Technology",
    "Loyola College Chennai",
    "Presidency College Chennai",
    "Ethiraj College for Women",
    "DG Vaishnav College",
    "Ambattur, Chennai",
  ];
  const esc = (s) =>
    String(s ?? "").replace(
      /[&<>"']/g,
      (c) =>
        ({
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': "&quot;",
          "'": "&#39;",
        })[c],
    );
  const stored = (k, def) => {
    try {
      return JSON.parse(localStorage.getItem(k) || JSON.stringify(def));
    } catch {
      return def;
    }
  };
  function addShell() {
    if ($("#ebFloatingCategories")) return;
    const wrap = document.createElement("div");
    wrap.id = "ebFloatingCategories";
    wrap.className = "eb-floating-categories";
    wrap.innerHTML = `<button id="ebFloatingToggle" class="eb-floating-toggle" type="button" aria-expanded="false" aria-controls="ebFloatingPanel"><span>☷</span><span>Categories</span><span class="eb-floating-chevron">⌄</span></button><div id="ebFloatingPanel" class="eb-floating-panel" hidden><div class="eb-floating-panel-title">Shop by category</div>${categories.map((c) => `<a href="#shop?category=${encodeURIComponent(c)}"><span class="eb-cat-emoji">${{ Electronics: "🎧", Books: "📚", "Stationery Kits": "✏️", Calculators: "🧮", "Lab Equipment": "🧪", Accessories: "🎒", "T-Shirts": "👕", Bags: "👜" }[c] || "🛍️"}</span><span>${esc(c)}</span><span class="eb-side-arrow">›</span></a>`).join("")}<div class="eb-floating-shortcuts" aria-label="Marketplace navigation">
<a href="#home"><span>⌂</span> Home</a>
<a href="#shop"><span>▦</span> All Categories</a>
<a href="#sell"><span>＋</span> Sell Product</a>
<a href="#tracking"><span>⌖</span> Tracking</a>
<a href="#orders"><span>▤</span> Orders</a>
<a href="#location"><span>📍</span> Location / Pickup</a>
<a href="#account"><span>♙</span> My Account</a>
<a href="#orders"><span>◷</span> Order History</a>
<a href="#messages"><span>✉</span> Buyer / Seller Messages</a>
<a href="#refunds"><span>↩</span> Refund Requests</a>
<a href="#logout"><span>↪</span> Logout</a>
</div></div>`;
    document.body.append(wrap);
    const btn = $("#ebFloatingToggle"),
      panel = $("#ebFloatingPanel");
    const close = () => {
      panel.hidden = true;
      btn.setAttribute("aria-expanded", "false");
      wrap.classList.remove("expanded");
    };
    btn.addEventListener("click", () => {
      const opening = panel.hidden;
      panel.hidden = !opening;
      btn.setAttribute("aria-expanded", String(opening));
      wrap.classList.toggle("expanded", opening);
    });
    panel
      .querySelectorAll("a")
      .forEach((a) => a.addEventListener("click", close));
    document.addEventListener("click", (e) => {
      if (!wrap.contains(e.target)) close();
    });
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") close();
    });
  }
  function pageHead(kicker, title, desc) {
    return `<div class="wrap page-title"><span class="eyebrow">${kicker}</span><h1>${title}</h1><p style="color:var(--muted)">${desc}</p></div>`;
  }
  function mapsSearchUrl(place) {
    return (
      "https://www.google.com/maps/search/?api=1&query=" +
      encodeURIComponent(place)
    );
  }
  function directionsUrl(origin, destination, mode = "driving") {
    return (
      "https://www.google.com/maps/dir/?api=1&origin=" +
      encodeURIComponent(origin) +
      "&destination=" +
      encodeURIComponent(destination) +
      "&travelmode=" +
      encodeURIComponent(mode)
    );
  }
  function collegeOptions() {
    return (
      '<option value="">Choose a college / place</option>' +
      colleges
        .map((c) => `<option value="${esc(c)}">${esc(c)}</option>`)
        .join("")
    );
  }
  function locationPage() {
    app.innerHTML =
      pageHead(
        "LIVE CAMPUS MAP",
        "College location & directions",
        "Enter a starting point and college. The map geocodes both places and calculates route distance when a routing service supports the selected mode.",
      ) +
      `<div class="wrap"><div class="eb-feature-grid"><section class="eb-panel"><h2>📍 Route planner</h2><form id="ebMapForm"><div class="field"><label for="ebCollege">College / destination</label><select id="ebCollege">${collegeOptions()}</select></div><div class="field"><label for="ebCustomPlace">Or enter exact destination</label><input id="ebCustomPlace" placeholder="College name, campus gate or address"></div><div class="field"><label for="ebOrigin">Starting point</label><input id="ebOrigin" placeholder="Your current location or address" required></div><div class="field"><label for="ebTravelMode">Travel mode</label><select id="ebTravelMode"><option value="driving">🚗 Car / bike (road route)</option><option value="cycling">🚲 Cycle</option><option value="walking">🚶 Walk</option><option value="transit">🚌 Bus / public transport</option></select></div><div class="eb-action-row"><button class="primary" type="submit">Calculate route ↗</button><button class="secondary" id="ebUseLocation" type="button">Use my location</button></div><p class="eb-help" id="ebLocationMsg">Enter your starting point and choose your college. Browser location requires permission.</p><div id="ebRouteSummary" class="eb-route-summary" hidden></div></form></section><section class="eb-panel eb-map-panel"><div id="ebLeafletMap" class="eb-leaflet-map" role="region" aria-label="Interactive college route map"></div><div class="eb-action-row"><a id="ebOpenMap" class="primary" href="https://www.openstreetmap.org/" target="_blank" rel="noopener">Open map ↗</a><a id="ebGetDirections" class="secondary" href="https://www.google.com/maps" target="_blank" rel="noopener">Step-by-step directions ↗</a></div><p class="eb-help">Map data © OpenStreetMap contributors. Route availability depends on public routing servers.</p></section></div><section class="eb-panel eb-college-list"><h2>Popular college destinations</h2><p class="eb-help">Choose a destination, then enter your origin or use device location.</p><div class="eb-college-chips">${colleges
        .slice(0, 16)
        .map(
          (c) =>
            `<button type="button" class="eb-college-chip" data-college="${esc(c)}">${esc(c)}</button>`,
        )
        .join("")}</div></section></div>`;
    const sel = $("#ebCollege"),
      custom = $("#ebCustomPlace"),
      origin = $("#ebOrigin"),
      mode = $("#ebTravelMode"),
      msg = $("#ebLocationMsg"),
      summary = $("#ebRouteSummary");
    let map = null,
      routeLayer = null,
      startMarker = null,
      endMarker = null,
      leafletReady = false;
    const loadCss = () =>
      new Promise((resolve) => {
        if (document.querySelector("link[data-eb-leaflet]")) return resolve();
        const l = document.createElement("link");
        l.rel = "stylesheet";
        l.href = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.css";
        l.dataset.ebLeaflet = "1";
        l.onload = resolve;
        l.onerror = resolve;
        document.head.append(l);
      });
    const loadJs = () =>
      new Promise((resolve, reject) => {
        if (window.L) return resolve();
        const s = document.createElement("script");
        s.src = "https://unpkg.com/leaflet@1.9.4/dist/leaflet.js";
        s.onload = resolve;
        s.onerror = () => reject(Error("Map library could not load"));
        document.head.append(s);
      });
    async function initMap() {
      try {
        await loadCss();
        await loadJs();
        map = L.map("ebLeafletMap").setView([13.0827, 80.2707], 10);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
          maxZoom: 19,
          attribution: "&copy; OpenStreetMap contributors",
        }).addTo(map);
        leafletReady = true;
        setTimeout(() => map.invalidateSize(), 100);
      } catch (e) {
        $("#ebLeafletMap").innerHTML =
          '<div class="eb-map-fallback">Map could not load. Use the directions link below or check internet access.</div>';
      }
    }
    initMap();
    async function geocode(q) {
      if (/^\s*-?\d+(?:\.\d+)?\s*,\s*-?\d+(?:\.\d+)?\s*$/.test(q)) {
        const a = q.split(",").map(Number);
        return { lat: a[0], lon: a[1], name: q };
      }
      const u =
        "https://nominatim.openstreetmap.org/search?" +
        new URLSearchParams({ q, format: "jsonv2", limit: "1" });
      const r = await fetch(u, { headers: { Accept: "application/json" } });
      if (!r.ok)
        throw Error("Location search service unavailable (" + r.status + ")");
      const a = await r.json();
      if (!a.length)
        throw Error("Could not find: " + q + ". Add the city or full address.");
      return {
        lat: Number(a[0].lat),
        lon: Number(a[0].lon),
        name: a[0].display_name,
      };
    }
    const wait = (ms) => new Promise((r) => setTimeout(r, ms));
    async function routeBetween(a, b, profile) {
      const host =
        profile === "driving"
          ? "https://router.project-osrm.org/route/v1/driving/"
          : profile === "cycling"
            ? "https://routing.openstreetmap.de/routed-bike/route/v1/driving/"
            : "https://routing.openstreetmap.de/routed-foot/route/v1/driving/";
      const u =
        host +
        `${a.lon},${a.lat};${b.lon},${b.lat}?overview=full&geometries=geojson&steps=false`;
      const r = await fetch(u);
      if (!r.ok) throw Error("Route service unavailable");
      const d = await r.json();
      if (d.code !== "Ok" || !d.routes?.length)
        throw Error("No route found for this travel mode");
      return d.routes[0];
    }
    function mapsDirections(o, d, m) {
      const gm =
        m === "transit"
          ? "transit"
          : m === "walking"
            ? "walking"
            : m === "cycling"
              ? "bicycling"
              : "driving";
      return (
        "https://www.google.com/maps/dir/?api=1&origin=" +
        encodeURIComponent(o) +
        "&destination=" +
        encodeURIComponent(d) +
        "&travelmode=" +
        gm
      );
    }
    async function showMap() {
      const dest = custom.value.trim() || sel.value,
        orig = origin.value.trim(),
        m = mode.value;
      if (!dest || !orig) {
        msg.textContent = "Please enter both starting point and destination.";
        return;
      }
      msg.textContent = "Finding both places…";
      summary.hidden = true;
      $("#ebGetDirections").href = mapsDirections(orig, dest, m);
      $("#ebOpenMap").href =
        "https://www.openstreetmap.org/search?query=" +
        encodeURIComponent(dest);
      try {
        const a = await geocode(orig);
        await wait(1100);
        const b = await geocode(dest);
        if (!leafletReady) await new Promise((r) => setTimeout(r, 500));
        if (leafletReady) {
          if (startMarker) map.removeLayer(startMarker);
          if (endMarker) map.removeLayer(endMarker);
          if (routeLayer) map.removeLayer(routeLayer);
          startMarker = L.marker([a.lat, a.lon])
            .addTo(map)
            .bindPopup("Starting point");
          endMarker = L.marker([b.lat, b.lon])
            .addTo(map)
            .bindPopup("College / destination");
          map.fitBounds(
            [
              [a.lat, a.lon],
              [b.lat, b.lon],
            ],
            { padding: [30, 30] },
          );
        }
        if (m === "transit") {
          msg.textContent =
            "Both places found. Public bus/transit route and live schedules are available in Google Maps.";
          summary.hidden = false;
          summary.innerHTML =
            "<strong>Public transport route</strong><p>Open step-by-step directions to see available bus/train connections and current travel estimates.</p>";
          return;
        }
        msg.textContent = "Calculating " + m + " route…";
        const rt = await routeBetween(a, b, m);
        const km = rt.distance / 1000,
          min = rt.duration / 60;
        if (leafletReady) {
          routeLayer = L.geoJSON(rt.geometry, {
            style: { color: "#2563eb", weight: 5, opacity: 0.85 },
          }).addTo(map);
          map.fitBounds(routeLayer.getBounds(), { padding: [30, 30] });
        }
        summary.hidden = false;
        summary.innerHTML = `<div class="eb-route-metrics"><div><small>Route distance</small><strong>${km.toFixed(1)} km</strong></div><div><small>Estimated time</small><strong>${Math.round(min)} min</strong></div></div><p>${esc(m === "driving" ? "Road route" : m === "cycling" ? "Cycling route" : "Walking route")} from ${esc(a.name)} to ${esc(b.name)}. Estimate may change with traffic, route conditions and map data.</p>`;
        msg.textContent =
          "Route calculated successfully. For turn-by-turn directions, open Google Maps.";
      } catch (e) {
        msg.textContent =
          e.message + " You can still open Google Maps for directions.";
        summary.hidden = false;
        summary.innerHTML =
          "<strong>Route estimate unavailable</strong><p>Use the step-by-step directions button. Public geocoding/routing services can be temporarily rate-limited.</p>";
      }
    }
    $("#ebMapForm").addEventListener("submit", (e) => {
      e.preventDefault();
      showMap();
    });
    sel.addEventListener("change", () => {
      if (sel.value) {
        custom.value = "";
      }
    });
    custom.addEventListener("input", () => {
      if (custom.value.trim()) sel.value = "";
    });
    $("#ebUseLocation").addEventListener("click", () => {
      if (!navigator.geolocation) {
        msg.textContent =
          "This browser does not support location. Type your starting point instead.";
        return;
      }
      msg.textContent = "Requesting location permission…";
      navigator.geolocation.getCurrentPosition(
        (pos) => {
          origin.value =
            pos.coords.latitude.toFixed(6) +
            "," +
            pos.coords.longitude.toFixed(6);
          msg.textContent =
            "Current location added. Choose a destination and calculate route.";
        },
        (err) => {
          msg.textContent =
            err.code === 1
              ? "Location permission denied. Type your starting point manually."
              : "Could not get location. Allow location permission or type your starting point.";
        },
        { enableHighAccuracy: true, timeout: 12000, maximumAge: 60000 },
      );
    });
    document.querySelectorAll("[data-college]").forEach((b) =>
      b.addEventListener("click", () => {
        sel.value = colleges.includes(b.dataset.college)
          ? b.dataset.college
          : "";
        custom.value = b.dataset.college;
        if (sel.value) custom.value = "";
        msg.textContent =
          "Destination selected. Enter starting point and calculate route.";
        window.scrollTo({ top: 0, behavior: "smooth" });
      }),
    );
  }
  function trackingPage() {
    const orders = stored("eb_orders", []);
    app.innerHTML =
      pageHead(
        "ORDER CENTER",
        "Track your order",
        "Order confirmation, order number and campus hand-off progress for orders created in this browser.",
      ) +
      `<div class="wrap"><div class="eb-panel"><div class="eb-tracking-top"><div><h2>📦 Your orders</h2><p class="eb-help">Status is stored in this browser. It is not a courier tracking feed or seller-confirmed update.</p></div><a href="#orders" class="secondary">View all orders</a></div>${
        orders.length
          ? orders
              .map((o, i) => {
                const items = (o.items || [])
                  .map((it) => {
                    const p = products.find((x) => x.id === it.id);
                    return `${esc(p?.name || it.id)} × ${Number(it.qty) || 1}`;
                  })
                  .join(" · ");
                const status = esc(o.status || "Order confirmed");
                const orderNo = esc(
                  o.orderNo || "EB-" + String(Date.now()).slice(-6 - i),
                );
                return `<article class="eb-order-card"><div class="eb-order-icon">📦</div><div class="eb-order-info"><div class="eb-order-line"><strong>Order #${orderNo}</strong><span class="eb-status">✓ ${status}</span></div><p>${items || "Order items"}</p><p class="eb-help">Placed: ${esc(o.date || "Date unavailable")}</p><strong>₹${Number(o.total || 0).toLocaleString("en-IN")}</strong><div class="eb-confirmed-banner"><span class="eb-confirmed-tick">✓</span><div><strong>Order confirmed</strong><small>Your order has been received successfully.</small></div></div><div class="eb-packing-card"><span class="eb-packing-icon">📦</span><div><strong>Your order is being packed</strong><small>We are preparing your items for the campus hand-off.</small></div></div><div class="eb-progress"><span class="done">✓ Order confirmed</span><span class="done">✓ Packing</span><span>○ Ready for hand-off</span></div><a class="textlink" href="#location">Open college map & directions →</a></div></article>`;
              })
              .join("")
          : '<div class="eb-empty"><div>🛍️</div><h3>No orders to track yet</h3><p>Place an order from your cart and its confirmation will appear here.</p><a class="primary" href="#shop">Browse products</a></div>'
      }</div><div class="eb-panel eb-track-help"><h2>Need to meet the seller?</h2><p>Use the college map to choose a public meeting spot and open route directions.</p><a class="primary" href="#location">Choose college & get directions ↗</a></div></div>`;
  }
  function wikiPage() {
    app.innerHTML =
      pageHead(
        "WIKIPEDIA API",
        "Explore a topic",
        "Search Wikipedia for product background, technology concepts, and study topics.",
      ) +
      `<div class="wrap"><form id="ebWikiForm" class="eb-panel"><label for="ebWikiQuery"><strong>Search Wikipedia</strong></label><div class="eb-wiki-search"><input id="ebWikiQuery" placeholder="e.g. Scientific calculator, computer networks" required><button class="primary" type="submit">Search ↗</button></div><p class="eb-help">Results are retrieved live from the Wikipedia public API. Internet access is required.</p></form><div id="ebWikiResults" class="eb-wiki-results"></div></div>`;
    const form = $("#ebWikiForm"),
      input = $("#ebWikiQuery"),
      results = $("#ebWikiResults");
    const search = async (q) => {
      results.innerHTML = '<div class="eb-panel">Searching Wikipedia…</div>';
      try {
        const url =
          "https://en.wikipedia.org/w/api.php?action=query&generator=search&gsrsearch=" +
          encodeURIComponent(q) +
          "&gsrnamespace=0&gsrlimit=8&prop=pageimages%7Cextracts&piprop=thumbnail&pithumbsize=240&exintro=1&explaintext=1&exsentences=3&format=json&origin=*";
        const r = await fetch(url);
        if (!r.ok) throw new Error("Wikipedia request failed");
        const data = await r.json();
        const pages = Object.values(data.query?.pages || {}).sort(
          (a, b) => (a.index || 0) - (b.index || 0),
        );
        if (!pages.length) {
          results.innerHTML =
            '<div class="eb-empty"><h3>No results found</h3><p>Try a shorter keyword.</p></div>';
          return;
        }
        results.innerHTML = pages
          .map(
            (p) =>
              `<article class="eb-wiki-card">${p.thumbnail?.source ? `<img src="${esc(p.thumbnail.source)}" alt="" loading="lazy">` : ""}<div><h3><a href="https://en.wikipedia.org/?curid=${encodeURIComponent(p.pageid)}" target="_blank" rel="noopener">${esc(p.title)} ↗</a></h3><p>${esc(p.extract || "Open the article to read more.")}</p><a class="textlink" href="https://en.wikipedia.org/?curid=${encodeURIComponent(p.pageid)}" target="_blank" rel="noopener">Read article →</a></div></article>`,
          )
          .join("");
      } catch (e) {
        results.innerHTML =
          '<div class="eb-empty"><h3>Could not load Wikipedia</h3><p>Check your internet connection, then search again.</p><button class="secondary" id="ebWikiRetry" type="button">Try again</button></div>';
        $("#ebWikiRetry")?.addEventListener("click", () =>
          search(input.value.trim()),
        );
      }
    };
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const q = input.value.trim();
      if (q) search(q);
    });
    const initial = new URLSearchParams(location.hash.split("?")[1] || "").get(
      "q",
    );
    if (initial) {
      input.value = initial;
      search(initial);
    }
  }
  function supportPage(kind) {
    const title =
      kind === "help"
        ? "Help centre"
        : kind === "contact"
          ? "Contact EasyBuy"
          : "Share feedback";
    const intro =
      kind === "help"
        ? "Quick answers for shopping, selling, images and campus meet-ups."
        : kind === "contact"
          ? "Use the support form to prepare a message for the EasyBuy project maintainer."
          : "Tell us what works well and what should improve.";
    if (kind === "help") {
      app.innerHTML =
        pageHead("SUPPORT", title, intro) +
        `<div class="wrap"><div class="eb-panel"><h3>How do product images load?</h3><p>Books search Google Books for cover thumbnails. Other categories search Wikimedia Commons. Results load when product cards appear on screen and are cached in this browser.</p><h3>Why can a product keep its local image?</h3><p>If the public API has no relevant result, internet access is blocked, or the API is temporarily limited, EasyBuy keeps the product-specific bundled fallback rather than displaying a misleading image.</p><h3>How do I track an order?</h3><p>Open Orders, then Track order. Order confirmation and packing status are currently stored in this browser; they are not a courier feed.</p><h3>How do I get directions to a college?</h3><p>Open College route map, enter your starting point, choose a college and travel mode, then calculate the route. Bus/train schedules open in Google Maps.</p><h3>How do I sell an item?</h3><p>Open Sell, enter accurate item details, choose a clear product photo and publish. In this JavaScript build, listings are saved in this browser only.</p><a class="primary" href="#feedback">Send feedback ↗</a></div></div>`;
      return;
    }
    if (kind === "contact") {
      app.innerHTML =
        pageHead("SUPPORT", title, intro) +
        `<div class="wrap"><form id="ebContactForm" class="eb-panel"><div class="field"><label>Your email (optional)</label><input id="ebContactEmail" type="email" placeholder="you@example.com"></div><div class="field"><label>Topic</label><select id="ebContactTopic"><option>Product image issue</option><option>Order / tracking question</option><option>Seller / listing issue</option><option>Website feedback</option><option>Other</option></select></div><div class="field"><label>Message</label><textarea id="ebContactMessage" required maxlength="2000" placeholder="Describe how we can help…"></textarea></div><button class="primary" type="submit">Prepare support message ↗</button><p class="eb-help">This static-site package has no configured support inbox or server endpoint. The button opens your email app with the message prepared; set the project maintainer's address in the mailto target before publishing.</p></form></div>`;
      $("#ebContactForm").addEventListener("submit", (e) => {
        e.preventDefault();
        const body =
          "From: " +
          $("#ebContactEmail").value +
          "\nTopic: " +
          $("#ebContactTopic").value +
          "\n\n" +
          $("#ebContactMessage").value;
        const subject = "EasyBuy support: " + $("#ebContactTopic").value;
        const a = document.createElement("a");
        a.href =
          "mailto:?subject=" +
          encodeURIComponent(subject) +
          "&body=" +
          encodeURIComponent(body);
        a.click();
      });
      return;
    }
    app.innerHTML =
      pageHead("YOUR VOICE", title, intro) +
      `<div class="wrap"><form id="ebFeedbackForm" class="eb-panel"><div class="field"><label>How was your experience?</label><select id="ebFeedbackRating"><option>Excellent</option><option>Good</option><option>Okay</option><option>Needs improvement</option></select></div><div class="field"><label>Feedback</label><textarea id="ebFeedbackText" required maxlength="2000" placeholder="Tell us what to improve…"></textarea></div><button class="primary" type="submit">Save feedback ↗</button><p class="eb-help">Feedback is saved in this browser. A shared feedback inbox requires a configured server/API endpoint.</p></form><div id="ebFeedbackSaved"></div></div>`;
    $("#ebFeedbackForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const items = stored("eb_feedback", []);
      items.unshift({
        rating: $("#ebFeedbackRating").value,
        message: $("#ebFeedbackText").value.trim(),
        date: new Date().toISOString(),
      });
      try {
        localStorage.setItem("eb_feedback", JSON.stringify(items));
        $("#ebFeedbackSaved").innerHTML =
          '<div class="eb-panel"><strong>✓ Feedback saved in this browser.</strong></div>';
        e.target.reset();
      } catch (_) {
        $("#ebFeedbackSaved").textContent =
          "Browser storage is full; feedback was not saved.";
      }
    });
  }
  function showFeatureRoute() {
    const path = (location.hash || "#home").slice(1).split("?")[0];
    if (path === "location") {
      locationPage();
      return true;
    }
    if (path === "tracking") {
      trackingPage();
      return true;
    }
    if (path === "wikipedia") {
      wikiPage();
      return true;
    }
    if (path === "help" || path === "contact" || path === "feedback") {
      supportPage(path);
      return true;
    }
    return false;
  }
  // The old floating shortcut panel duplicated the main navigation; keep one menu only.
  window.addEventListener("hashchange", () => {
    if (showFeatureRoute()) window.scrollTo({ top: 0, behavior: "smooth" });
  });
  if (showFeatureRoute()) {
  } else if (!location.hash) location.hash = "#home";
})();


/* ===== js/auth.js ===== */
/* EasyBuy buyer authentication: server-side PHP + MySQL sessions (auth.php). Profile/cart/wishlist: api-buyer-data.php. */
(() => {
  "use strict";
  const $ = (s) => document.querySelector(s);
  const app = $("#app");
  let currentUser = null, csrf = "", requestedSell = false;
  const esc = (s) => String(s ?? "").replace(/[&<>"']/g, c => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]));
  async function api(action, data) {
    const authEndpoint = data && ["login","register","logout"].includes(action) ? `buyer-${action}.php` : "auth.php";
    const response = await fetch(authEndpoint + (data ? "" : "?role=buyer&action="+encodeURIComponent(action)), {
      method: data ? "POST" : "GET", credentials: "same-origin",
      headers: data ? {"Content-Type":"application/json","X-CSRF-Token":csrf} : {"Accept":"application/json"},
      body: data ? JSON.stringify({...data,action,role:"buyer"}) : undefined
    });
    const raw = await response.text();
    let result;
    try { result = JSON.parse(raw); }
    catch (_) {
      const looksHtml = /^\s*<!doctype html|^\s*<html/i.test(raw);
      throw new Error(looksHtml
        ? "The authentication URL returned an HTML page instead of JSON. Upload the buyer authentication files to the same project folder and check the hosting PHP configuration."
        : "The authentication server returned an invalid response. Check PHP error logs and api-config.php.");
    }
    if (!response.ok || !result.ok) throw new Error(result.error || "Buyer account request failed.");
    if (result.csrf) csrf=result.csrf;
    return result;
  }
  async function dataApi(data) {
    const response = await fetch("api-buyer-data.php", {
      method: "POST", credentials: "same-origin",
      headers: {"Content-Type":"application/json","X-CSRF-Token":csrf}, body: JSON.stringify(data)
    });
    const raw = await response.text();
    let result;
    try { result = JSON.parse(raw); }
    catch (_) { throw new Error("The buyer-data API returned an invalid response. Check api-buyer-data.php, PHP error logs, and database settings."); }
    if (!response.ok || !result.ok) throw new Error(result.error || "Could not save to the database.");
    return result;
  }
  const QUESTIONS=["What is your favourite colour?","What was the name of your first school?","What is your favourite food?","What is your childhood nickname?"];
  function updateMenu() {
    document.querySelectorAll("[data-auth-only]").forEach(el => el.hidden=!currentUser);
    document.querySelectorAll("[data-guest-nav]").forEach(el => el.hidden=!!currentUser);
    document.documentElement.classList.toggle("eb-auth-pending",!currentUser && !["login","signup","forgot-password"].includes((location.hash||"#login").slice(1).split("?")[0]));
    window.dispatchEvent(new Event("easybuy:auth-changed"));
  }
  function authShell(kicker,title,subtitle,inner) {
    app.innerHTML=`<section class="eb-auth-wrap"><div class="eb-auth-card"><a class="logo eb-auth-logo" href="#login">easy<b>buy.</b></a><div class="eb-auth-kicker">${kicker}</div><h1>${title}</h1><p class="eb-auth-sub">${subtitle}</p><div id="ebAuthMessage" class="eb-auth-message" role="status" aria-live="polite"></div>${inner}<p class="eb-auth-hint" style="margin-top:18px">Your buyer account is securely stored in the EasyBuy MySQL database.</p></div></section>`;
  }
  function message(t,ok=false){const el=$("#ebAuthMessage");if(el){el.textContent=t;el.className="eb-auth-message "+(ok?"success":"error");}}
  // Older modules (messages, contact) read the signed-in buyer from these browser keys; mirror the database account there.
  function syncLegacyEmail(){
    try{
      const key="easybuy_js_users_v1";let users=[];try{users=JSON.parse(localStorage.getItem(key)||"[]");}catch(_){}
      if(!Array.isArray(users))users=[];
      users=users.filter(u=>!(u&&u.db&&(!currentUser||String(u.email).toLowerCase()!==String(currentUser.email).toLowerCase())));
      if(currentUser){
        sessionStorage.setItem("easybuy_js_session_v1",currentUser.email);
        const i=users.findIndex(u=>u&&String(u.email).toLowerCase()===String(currentUser.email).toLowerCase());
        const rec={name:currentUser.name,email:currentUser.email,db:true};
        if(i>=0)users[i]={...users[i],name:rec.name};else users.push(rec);
      } else sessionStorage.removeItem("easybuy_js_session_v1");
      localStorage.setItem(key,JSON.stringify(users));
    }catch(_){}
  }
  function loginPage(){
    authShell("WELCOME BACK","Login to EasyBuy","Sign in to continue to the campus marketplace.",`<form id="ebLoginForm" class="eb-auth-form"><label>Email address<input name="email" type="email" autocomplete="email" required maxlength="254" placeholder="you@example.com"></label><label>Password<input name="password" type="password" autocomplete="current-password" required minlength="8"></label><button class="primary" type="submit">Login ↗</button></form><p class="eb-auth-switch"><a href="#forgot-password">Forgot password?</a></p><p class="eb-auth-switch">New to EasyBuy? <a href="#signup">Create an account</a></p>`);
    $("#ebLoginForm").addEventListener("submit",async e=>{e.preventDefault();const f=e.currentTarget,b=f.querySelector("button");b.disabled=true;message("Checking your account…");try{const r=await api("login",{email:f.elements.email.value.trim().toLowerCase(),password:f.elements.password.value});currentUser=r.buyer;syncLegacyEmail();document.body.classList.remove("eb-guest-mode");updateMenu();location.hash=requestedSell?"#sell":"#home";}catch(err){message(err.message);}finally{b.disabled=false;}});
  }
  function signupPage(){
    authShell("JOIN EASYBUY","Create your account","Create a buyer account to access the marketplace.",`<form id="ebSignupForm" class="eb-auth-form"><label>Your name<input name="name" required minlength="2" maxlength="80" autocomplete="name"></label><label>Email address<input name="email" type="email" required maxlength="254" autocomplete="email"></label><label>Password<input name="password" type="password" required minlength="8" autocomplete="new-password"></label><label>Confirm password<input name="confirm_password" type="password" required minlength="8" autocomplete="new-password"></label><label>Security question (for password recovery)<select name="security_question" required>${QUESTIONS.map(q=>`<option>${q}</option>`).join("")}</select></label><label>Your answer<input name="security_answer" required minlength="2" maxlength="120" autocomplete="off"></label><button class="primary" type="submit">Create account ↗</button></form><p class="eb-auth-switch">Already registered? <a href="#login">Login</a></p>`);
    $("#ebSignupForm").addEventListener("submit",async e=>{e.preventDefault();const f=e.currentTarget,b=f.querySelector("button");if(f.elements.password.value!==f.elements.confirm_password.value){message("Passwords do not match.");return;}b.disabled=true;message("Creating your account…");try{const r=await api("register",{name:f.elements.name.value.trim(),email:f.elements.email.value.trim().toLowerCase(),password:f.elements.password.value,security_question:f.elements.security_question.value,security_answer:f.elements.security_answer.value});currentUser=r.buyer;syncLegacyEmail();document.body.classList.remove("eb-guest-mode");updateMenu();location.hash=requestedSell?"#sell":"#home";}catch(err){message(err.message);}finally{b.disabled=false;}});
  }
  function forgotPasswordPage(){
    authShell("ACCOUNT RECOVERY","Reset your password","Enter your account email, then answer the security question you chose when you registered.",`<form id="ebRecoverForm" class="eb-auth-form"><label>Email address<input name="email" type="email" required maxlength="254" autocomplete="email"></label><button class="primary" type="submit">Continue ↗</button></form><p class="eb-auth-switch"><a href="#login">Back to login</a></p>`);
    $("#ebRecoverForm").addEventListener("submit",async e=>{e.preventDefault();const f=e.currentTarget;if(f.dataset.step==="2")return;const b=f.querySelector("button");const email=f.elements.email.value.trim().toLowerCase();b.disabled=true;message("Checking…");
      try{const r=await api("recover_question",{email});message("");f.dataset.step="2";
        f.innerHTML=`<p><strong>${esc(r.question)}</strong></p><label>Your answer<input name="security_answer" required autocomplete="off" maxlength="120"></label><label>New password<input name="new_password" type="password" required minlength="8" autocomplete="new-password"></label><label>Confirm new password<input name="confirm_password" type="password" required minlength="8" autocomplete="new-password"></label><button class="primary" type="submit">Reset password ↗</button>`;
        f.onsubmit=async ev=>{ev.preventDefault();if(f.elements.new_password.value!==f.elements.confirm_password.value){message("Passwords do not match.");return;}const bb=f.querySelector("button");bb.disabled=true;
          try{const rr=await api("recover_reset",{email,security_answer:f.elements.security_answer.value,new_password:f.elements.new_password.value});message(rr.message+" Redirecting to login…",true);setTimeout(()=>{location.hash="#login";},1800);}catch(err){message(err.message);bb.disabled=false;}};
      }catch(err){message(err.message);b.disabled=false;}});
  }
  function accountPage(){
    if(!currentUser){location.hash="#login";return;}
    authShell("YOUR PROFILE","My Account","Your EasyBuy buyer account details.",`<div class="eb-profile"><div class="eb-profile-avatar">${esc((currentUser.name||"U").trim().charAt(0).toUpperCase())}</div><div><h2>${esc(currentUser.name)}</h2><p>${esc(currentUser.email)}</p></div></div><div class="eb-profile-details"><div><span>Account status</span><strong>Logged in</strong></div><div><span>Member since</span><strong>${esc(currentUser.created_at||"Registered")}</strong></div></div><h2 style="margin-top:24px">Profile &amp; delivery details</h2><form id="ebProfileForm" class="eb-auth-form"><label>Full name<input name="name" required minlength="2" maxlength="80" autocomplete="name" value="${esc(currentUser.name)}"></label><label>Phone number<input name="phone" type="tel" maxlength="24" autocomplete="tel" value="${esc(currentUser.phone||"")}"></label><label>College / campus<input name="college" maxlength="100" value="${esc(currentUser.college||"")}"></label><label>City<input name="city" maxlength="80" autocomplete="address-level2" value="${esc(currentUser.city||"")}"></label><label>PIN code<input name="pincode" maxlength="12" autocomplete="postal-code" value="${esc(currentUser.pincode||"")}"></label><label>Delivery address<input name="address" maxlength="500" autocomplete="street-address" value="${esc(currentUser.address||"")}"></label><button class="primary" type="submit">Save profile</button></form><h2 style="margin-top:24px">Change password</h2><form id="ebChangePasswordForm" class="eb-auth-form"><label>Current password<input name="current_password" type="password" required autocomplete="current-password"></label><label>New password<input name="new_password" type="password" minlength="8" required autocomplete="new-password"></label><label>Confirm new password<input name="confirm_password" type="password" minlength="8" required autocomplete="new-password"></label><button class="primary" type="submit">Update password</button></form><div class="eb-auth-actions"><a class="primary" href="#sell">＋ Sell a product</a><button class="secondary" id="ebLogoutBtn" type="button">Logout</button></div><a class="eb-auth-back" href="#home">← Back to marketplace</a>`);
    $("#ebLogoutBtn").addEventListener("click",logout);
    $("#ebProfileForm").addEventListener("submit",async e=>{e.preventDefault();const f=e.currentTarget,b=f.querySelector("button");b.disabled=true;try{const r=await dataApi({action:"save_profile",name:f.elements.name.value.trim(),phone:f.elements.phone.value.trim(),college:f.elements.college.value.trim(),city:f.elements.city.value.trim(),pincode:f.elements.pincode.value.trim(),address:f.elements.address.value.trim()});currentUser={...currentUser,...r.profile};syncLegacyEmail();window.dispatchEvent(new Event("easybuy:profile-changed"));message(r.message||"Profile saved.",true);}catch(err){message(err.message);}finally{b.disabled=false;}});
    $("#ebChangePasswordForm").addEventListener("submit",async e=>{e.preventDefault();const f=e.currentTarget;if(f.elements.new_password.value!==f.elements.confirm_password.value){message("Passwords do not match.");return;}try{const r=await api("change_password",{current_password:f.elements.current_password.value,new_password:f.elements.new_password.value});message(r.message,true);f.reset();}catch(err){message(err.message);}});
  }
  async function logout(){try{await api("logout",{});}catch(e){}currentUser=null;csrf="";syncLegacyEmail();if(window.EasyBuyState)window.EasyBuyState.reset();document.body.classList.add("eb-guest-mode");updateMenu();requestedSell=false;location.hash="#login";}
  async function renderRoute(){
    const path=(location.hash||"").slice(1).split("?")[0];
    if(path==="logout"){await logout();return true;}
    try{const r=await api("me");currentUser=r.buyer||null;csrf=r.csrf||"";}catch(e){currentUser=null;csrf="";}
    syncLegacyEmail();updateMenu();
    if(!currentUser){document.body.classList.add("eb-guest-mode");if(path==="signup"){signupPage();return true;}if(path==="forgot-password"){forgotPasswordPage();return true;}if(path!=="login")location.hash="#login";loginPage();return true;}
    document.body.classList.remove("eb-guest-mode");
    if(path==="login"||path==="signup"){location.hash="#home";return true;}
    if(path==="account"){accountPage();return true;}
    return false;
  }
  window.EasyBuyAuth={renderRoute,refresh:async()=>{try{const r=await api("me");currentUser=r.buyer||null;csrf=r.csrf||"";}catch(e){currentUser=null;}syncLegacyEmail();return currentUser;},isLoggedIn:()=>!!currentUser,getBuyer:()=>currentUser,getCsrf:()=>csrf};
  window.addEventListener("hashchange",()=>{renderRoute().then(handled=>{if(handled)window.scrollTo({top:0,behavior:"smooth"});});});
  (async()=>{await renderRoute();document.documentElement.classList.remove("eb-auth-pending");const loader=$("#loading");if(loader){loader.classList.add("hidden");loader.classList.remove("eb-transition-loading");}if(!location.hash||location.hash==="#")location.hash=currentUser?"#home":"#login";})();
})();


/* ===== js/buyer-sync.js ===== */
/* EasyBuy buyer data sync: profile, cart and wishlist live in MySQL (api-buyer-data.php).
 * The storefront (app.js) still works from in-memory state; this file loads the saved state after login,
 * saves every change back to the database, pre-fills checkout from the profile and routes #seller to the Seller Studio. */
(() => {
  "use strict";
  const boot = window.EASYBUY_BOOT || {};
  const sellerUrl = (boot.routes && boot.routes.seller) || "";
  let syncedFor = null, ready = false, timer = null, profile = null;
  const last = { cart: "", wish: "" };
  const auth = () => window.EasyBuyAuth;
  const state = () => window.EasyBuyState;

  async function request(body, keepalive = false) {
    const response = await fetch("api-buyer-data.php", {
      method: "POST", credentials: "same-origin", keepalive,
      headers: { "Content-Type": "application/json", Accept: "application/json", "X-CSRF-Token": auth().getCsrf() },
      body: JSON.stringify(body),
    });
    const data = await response.json();
    if (!response.ok || !data.ok) throw new Error(data.error || "Could not sync with the database.");
    return data;
  }

  async function start(buyer) {
    if (!state()) return;
    syncedFor = buyer.email; ready = false;
    try {
      // Union of what the browser holds (items added before login) and what the database already has.
      const data = await request({ action: "merge", cart: state().getCart(), wishlist: state().getWishlist() });
      if (syncedFor !== buyer.email) return; // logged out / switched account meanwhile
      profile = data.profile || buyer;
      last.cart = JSON.stringify(data.cart); last.wish = JSON.stringify(data.wishlist);
      state().setState({ cart: data.cart, wishlist: data.wishlist });
      ready = true;
      prefillCheckout();
    } catch (err) {
      console.warn("EasyBuy: could not load cart/wishlist from the database.", err);
    }
  }

  function onAuthChanged() {
    const buyer = auth() && auth().getBuyer && auth().getBuyer();
    if (buyer && buyer.email !== syncedFor) start(buyer);
    else if (!buyer && syncedFor) { syncedFor = null; ready = false; profile = null; last.cart = last.wish = ""; }
  }

  async function push(keepalive = false) {
    clearTimeout(timer); timer = null;
    if (!ready || !state() || !auth() || !auth().getBuyer()) return;
    const cart = state().getCart(), wishlist = state().getWishlist();
    const cartJson = JSON.stringify(cart), wishJson = JSON.stringify(wishlist);
    try {
      if (cartJson !== last.cart) { await request({ action: "set_cart", items: cart }, keepalive); last.cart = cartJson; }
      if (wishJson !== last.wish) { await request({ action: "set_wishlist", ids: wishlist }, keepalive); last.wish = wishJson; }
    } catch (err) {
      console.warn("EasyBuy: cart/wishlist were not saved to the database.", err);
    }
  }

  function prefillCheckout() {
    const form = document.querySelector("#paymentForm");
    if (!form || !profile || form.dataset.ebPrefilled) return;
    const set = (name, value) => {
      const el = form.elements[name];
      if (el && !el.value && value) { el.value = value; el.dispatchEvent(new Event("input", { bubbles: true })); }
    };
    set("name", profile.name);
    set("phone", profile.phone);
    set("address", [profile.address, profile.city, profile.pincode].filter(Boolean).join(", "));
    form.dataset.ebPrefilled = "1";
  }

  window.addEventListener("easybuy:auth-changed", onAuthChanged);
  window.addEventListener("easybuy:profile-changed", () => { if (auth() && auth().getBuyer()) profile = auth().getBuyer(); });
  window.addEventListener("easybuy:state-changed", () => { if (ready) { clearTimeout(timer); timer = setTimeout(() => push(), 500); } });
  window.addEventListener("pagehide", () => { if (timer) push(true); });
  document.addEventListener("visibilitychange", () => { if (document.visibilityState === "hidden" && timer) push(true); });
  window.addEventListener("load", onAuthChanged);

  const app = document.querySelector("#app");
  if (app) new MutationObserver(prefillCheckout).observe(app, { childList: true, subtree: true });

  // Seller routing: #seller (or #seller-studio) opens the Seller Studio.
  const routeSeller = () => { if (/^#seller(-studio)?$/.test(location.hash)) location.href = sellerUrl; };
  window.addEventListener("hashchange", routeSeller);
  routeSeller();
})();


/* ===== js/contact-refund.js ===== */
/* EasyBuy contact + refund-request demo. Browser storage only; not a live AI, payment gateway, or shared inbox. */
(() => {
  "use strict";
  const app = document.querySelector("#app");
  const esc = (s) =>
    String(s ?? "").replace(
      /[&<>"']/g,
      (c) =>
        ({
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': "&quot;",
          "'": "&#39;",
        })[c],
    );
  const read = (key, fallback = []) => {
    try {
      const v = JSON.parse(
        localStorage.getItem(key) || JSON.stringify(fallback),
      );
      return v ?? fallback;
    } catch {
      return fallback;
    }
  };
  const write = (key, value) => {
    try {
      localStorage.setItem(key, JSON.stringify(value));
      return true;
    } catch {
      return false;
    }
  };
  const currentUser = () => {
    const email = sessionStorage.getItem("easybuy_js_session_v1");
    if (!email) return null;
    return (
      read("easybuy_js_users_v1", []).find((u) => u.email === email) || null
    );
  };
  const money = (n) => "₹" + Number(n || 0).toLocaleString("en-IN");
  const pageHead = (k, t, d) =>
    `<div class="wrap page-title"><span class="eyebrow">${k}</span><h1>${t}</h1><p style="color:var(--muted)">${d}</p></div>`;
  function requireUser() {
    if (!currentUser()) {
      location.hash = "#login";
      return null;
    }
    return currentUser();
  }
  function getProductOptions() {
    const products = window.EASYBUY_PRODUCTS || [];
    const listings = read("eb_listings", []).map((p, i) => ({
      ...p,
      id: p.id || "user-" + i,
    }));
    const all = [...products, ...listings];
    return (
      '<option value="">Select a product (optional)</option>' +
      all
        .map(
          (p) =>
            `<option value="${esc(p.id)}">${esc(p.name || "Product")} · ${esc(p.category || "Marketplace")}</option>`,
        )
        .join("")
    );
  }
  function messagePage() {
    const user = requireUser();
    if (!user) return;
    const messages = read("eb_student_messages", []).filter(
      (m) => m.from === user.email || m.to === user.email,
    );
    app.innerHTML =
      pageHead(
        "STUDENT MESSAGING",
        "AI Chat Assistant",
        "Choose your language, send a message, and watch the assistant prepare a helpful reply with a typing animation.",
      ) +
      `<div class="wrap eb-contact-layout"><section class="eb-panel eb-contact-form-panel"><h2>✉️ New message</h2><form id="ebMessageForm"><div class="field"><label for="ebMsgTo">Recipient email</label><input id="ebMsgTo" type="email" required maxlength="180" placeholder="student@example.com"></div><div class="field"><label for="ebMsgProduct">Product</label><select id="ebMsgProduct">${getProductOptions()}</select></div><div class="field"><label for="ebMsgTopic">What do you want to discuss?</label><select id="ebMsgTopic"><option value="availability">Check product availability</option><option value="condition">Ask about product condition</option><option value="pickup">Arrange a campus pickup</option><option value="order">Ask about an order</option><option value="custom">Other question</option></select></div><div class="field"><label for="ebMsgLanguage">🌐 Reply language</label><select id="ebMsgLanguage"><option value="en">English</option><option value="ta">தமிழ் (Tamil)</option><option value="tanglish">Tanglish (Tamil + English)</option><option value="hi">हिन्दी (Hindi)</option></select><p class="eb-help">The assistant's demo reply will use this language.</p></div><div class="eb-helper-box"><strong>✨ AI message helper</strong><p>Prepare a polite message draft in your selected language. A demo assistant reply appears after you send it.</p><button class="secondary" type="button" id="ebMakeDraft">✨ Generate message</button><div id="ebDraftLoading" class="eb-typing" hidden><span></span><span></span><span></span><small>Preparing your message…</small></div></div><div class="field"><label for="ebMsgBody">Your message</label><textarea id="ebMsgBody" rows="5" maxlength="2000" required placeholder="Write your message…"></textarea></div><button class="primary" id="ebSendMessage" type="submit">Send message ↗</button><p class="eb-help">Messages are stored locally for this view and submitted to the EasyBuy message database for the selected recipient. Seller must sign in to reply.</p><div id="ebMsgStatus" class="eb-inline-status" role="status"></div></form></section><section class="eb-panel eb-contact-history"><h2>💬 Chat history</h2><div id="ebMessageList">${messageList(messages, user.email)}</div><div id="ebAiLoading" class="eb-ai-loading" hidden><div class="eb-ai-avatar">✨</div><div><strong>EasyBuy AI</strong><p>Thinking of a helpful reply</p><div class="eb-typing"><span></span><span></span><span></span></div></div></div></section></div>`;
    const requestedProduct = new URLSearchParams(
      location.hash.split("?")[1] || "",
    ).get("product");
    if (requestedProduct) {
      const productSelect = document.querySelector("#ebMsgProduct");
      if (productSelect) {
        productSelect.value = requestedProduct;
      }
    }
    const lang = () => document.querySelector("#ebMsgLanguage").value;
    const topic = () => document.querySelector("#ebMsgTopic").value;
    const productName = () => {
      const el = document.querySelector("#ebMsgProduct");
      return el.selectedOptions[0]?.textContent || "this product";
    };
    document.querySelector("#ebMakeDraft").addEventListener("click", () => {
      const loading = document.querySelector("#ebDraftLoading");
      const btn = document.querySelector("#ebMakeDraft");
      loading.hidden = false;
      btn.disabled = true;
      setTimeout(() => {
        const t = topic(),
          p = productName(),
          l = lang();
        const drafts = {
          en: {
            availability: `Hi! I'm interested in ${p}. Is it still available? Thank you.`,
            condition: `Hi! Could you please tell me more about the condition of ${p}? Thank you.`,
            pickup: `Hi! When and where would be a good time to pick up ${p}? Thank you.`,
            order: `Hi! Could you please share an update about my order for ${p}? Thank you.`,
            custom: `Hi! I have a question about ${p}. Could you please help me? Thank you.`,
          },
          ta: {
            availability: `வணக்கம்! ${p} இன்னும் விற்பனைக்கு இருக்கிறதா? நன்றி.`,
            condition: `வணக்கம்! ${p} எந்த நிலையில் இருக்கிறது என்று கொஞ்சம் விவரமாகச் சொல்ல முடியுமா? நன்றி.`,
            pickup: `வணக்கம்! ${p}-ஐ எப்போது, எங்கே வந்து வாங்கிக்கொள்ளலாம்? நன்றி.`,
            order: `வணக்கம்! ${p} தொடர்பான எனது ஆர்டர் நிலையைத் தெரிவிக்க முடியுமா? நன்றி.`,
            custom: `வணக்கம்! ${p} பற்றி ஒரு கேள்வி உள்ளது. உதவ முடியுமா? நன்றி.`,
          },
          tanglish: {
            availability: `Hi! ${p} innum available-ah irukka? Please sollunga. Thanks!`,
            condition: `Hi! ${p} condition eppadi irukku? Konjam details share pannunga. Thanks!`,
            pickup: `Hi! ${p} pickup panna eppo, enga meet pannalaam? Thanks!`,
            order: `Hi! ${p} order status pathi update share pannunga. Thanks!`,
            custom: `Hi! ${p} pathi oru question irukku. Help pannunga please. Thanks!`,
          },
          hi: {
            availability: `नमस्ते! क्या ${p} अभी उपलब्ध है? कृपया बताएं। धन्यवाद।`,
            condition: `नमस्ते! क्या आप ${p} की स्थिति के बारे में थोड़ा बता सकते हैं? धन्यवाद।`,
            pickup: `नमस्ते! ${p} लेने के लिए कब और कहाँ मिल सकते हैं? धन्यवाद।`,
            order: `नमस्ते! क्या आप ${p} के मेरे ऑर्डर का अपडेट दे सकते हैं? धन्यवाद।`,
            custom: `नमस्ते! मुझे ${p} के बारे में एक सवाल पूछना है। कृपया मदद करें। धन्यवाद।`,
          },
        };
        document.querySelector("#ebMsgBody").value = (drafts[l] || drafts.en)[
          t
        ];
        loading.hidden = true;
        btn.disabled = false;
        document.querySelector("#ebMsgBody").focus();
      }, 900);
    });
    document.querySelector("#ebMessageForm").addEventListener("submit", (e) => {
      e.preventDefault();
      const to = document.querySelector("#ebMsgTo").value.trim().toLowerCase();
      if (to === user.email) {
        document.querySelector("#ebMsgStatus").textContent =
          "Choose another student as the recipient.";
        return;
      }
      const all = read("eb_student_messages", []);
      const item = {
        id: "msg-" + Date.now() + "-" + Math.random().toString(36).slice(2, 7),
        from: user.email,
        fromName: user.name,
        to,
        productId: document.querySelector("#ebMsgProduct").value,
        productName: productName(),
        topic: topic(),
        body: document.querySelector("#ebMsgBody").value.trim(),
        language: lang(),
        createdAt: new Date().toISOString(),
        read: false,
      };
      all.unshift(item);
      if (!write("eb_student_messages", all)) {
        document.querySelector("#ebMsgStatus").textContent =
          "Could not save message. Browser storage may be full.";
        return;
      }
      fetch("api-messages.php", {
        method: "POST",
        credentials: "same-origin",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          email: user.email,
          to,
          body: item.body,
          productCode: item.productId,
          threadKey: item.id,
        }),
      })
        .then(async (r) => {
          const d = await r.json();
          if (!r.ok || !d.ok)
            throw new Error(d.error || "Message could not be delivered");
          const st = document.querySelector("#ebMsgStatus");
          if (st)
            st.textContent =
              "Message delivered to EasyBuy database. The seller can reply from Seller Studio.";
        })
        .catch((err) => {
          const st = document.querySelector("#ebMsgStatus");
          if (st)
            st.textContent =
              "Message saved locally, but database delivery failed: " +
              err.message;
        });
      document.querySelector("#ebMsgStatus").textContent =
        "Sending message to seller…";
      document.querySelector("#ebMsgBody").value = "";
      document.querySelector("#ebSendMessage").disabled = true;
      document.querySelector("#ebAiLoading").hidden = false;
      renderMessages(user);
      setTimeout(() => {
        const replies = {
          en: {
            availability: `Thanks for your interest in ${item.productName || "this product"}! Please check with the seller to confirm availability before arranging pickup.`,
            condition: `Thanks for asking! Please request recent photos and details from the seller, and confirm the condition before purchasing.`,
            pickup: `Thanks! Please agree on a public campus meeting point and a convenient time with the seller.`,
            order: `Thanks for reaching out! Please check your My Orders page for the latest status and contact the seller if you need more details.`,
            custom: `Thanks for your message! Please share any extra details so the buyer or seller can help you better.`,
          },
          ta: {
            availability: `${item.productName || "இந்தப் பொருள்"} மீது ஆர்வம் காட்டியதற்கு நன்றி! வாங்க வருவதற்கு முன் விற்பனையாளரிடம் இது இன்னும் கிடைக்கிறதா என்று உறுதிப்படுத்திக்கொள்ளுங்கள்.`,
            condition: `கேட்டதற்கு நன்றி! வாங்குவதற்கு முன் பொருளின் சமீபத்திய புகைப்படங்கள் மற்றும் நிலை விவரங்களை விற்பனையாளரிடம் கேட்டுத் தெரிந்துகொள்ளுங்கள்.`,
            pickup: `நன்றி! விற்பனையாளருடன் பாதுகாப்பான பொது இடத்தையும் உங்களுக்கு ஏற்ற நேரத்தையும் முன்கூட்டியே முடிவு செய்யுங்கள்.`,
            order: `தொடர்பு கொண்டதற்கு நன்றி! சமீபத்திய நிலையை அறிய My Orders பக்கத்தைப் பாருங்கள். கூடுதல் விவரங்களுக்கு விற்பனையாளரைத் தொடர்புகொள்ளலாம்.`,
            custom: `உங்கள் செய்திக்கு நன்றி! வாங்குபவர் அல்லது விற்பனையாளர் உதவ, தேவையான கூடுதல் விவரங்களைப் பகிருங்கள்.`,
          },
          tanglish: {
            availability: `Interest-ku thanks! ${item.productName || "Indha product"} available-ah irukka nu seller-kitta confirm pannitu pickup arrange pannunga.`,
            condition: `Kettadhukku thanks! Buy panradhukku munnaadi latest photos-um condition details-um seller-kitta check pannunga.`,
            pickup: `Thanks! Seller-oda safe public place-um convenient time-um munnaadiye decide pannunga.`,
            order: `Message pannadhukku thanks! Latest status-ku My Orders page check pannunga; extra details-ku seller-a contact pannalaam.`,
            custom: `Thanks for your message! Buyer/seller help panna konjam extra details share pannunga.`,
          },
          hi: {
            availability: `रुचि दिखाने के लिए धन्यवाद! खरीदने या मिलने से पहले विक्रेता से उपलब्धता की पुष्टि कर लें।`,
            condition: `पूछने के लिए धन्यवाद! खरीदने से पहले विक्रेता से हाल की तस्वीरें और वस्तु की स्थिति की जानकारी माँगें।`,
            pickup: `धन्यवाद! विक्रेता के साथ किसी सुरक्षित सार्वजनिक स्थान और सुविधाजनक समय पर मिलने की योजना बनाएँ।`,
            order: `संपर्क करने के लिए धन्यवाद! नवीनतम स्थिति के लिए My Orders पेज देखें और ज़रूरत हो तो विक्रेता से संपर्क करें।`,
            custom: `आपके संदेश के लिए धन्यवाद! खरीदार या विक्रेता आपकी बेहतर मदद कर सकें, इसके लिए कुछ और जानकारी साझा करें।`,
          },
        };
        const chosen =
          (replies[item.language] || replies.en)[item.topic] ||
          replies.en.custom;
        const updated = read("eb_student_messages", []);
        updated.unshift({
          id: "ai-" + Date.now(),
          from: "easybuy-ai@assistant.local",
          fromName: "EasyBuy AI",
          to: user.email,
          productId: item.productId,
          productName: item.productName,
          topic: item.topic,
          body: chosen,
          language: item.language,
          aiReply: true,
          replyTo: item.id,
          createdAt: new Date().toISOString(),
          read: true,
        });
        write("eb_student_messages", updated);
        const loader = document.querySelector("#ebAiLoading");
        if (loader) loader.hidden = true;
        const send = document.querySelector("#ebSendMessage");
        if (send) send.disabled = false;
        const status = document.querySelector("#ebMsgStatus");
        if (status)
          status.textContent =
            "AI reply ready! (Demo response — no live AI connection.)";
        renderMessages(user);
      }, 1700);
    });
  }
  function messageList(messages, email) {
    if (!messages.length)
      return '<p class="eb-help">No messages yet. Send one to start a chat.</p>';
    return messages
      .slice(0, 30)
      .map(
        (m) =>
          `<article class="eb-message-card ${m.aiReply ? "eb-ai-message" : ""}"><div class="eb-message-meta"><strong>${m.aiReply ? "✨ EasyBuy AI" : m.from === email ? "You → " + esc(m.to) : esc(m.fromName || m.from) + " → You"}</strong><time>${esc(new Date(m.createdAt).toLocaleString())}</time></div>${m.productName ? `<p class="eb-message-product">${esc(m.productName)}</p>` : ""}<p>${esc(m.body)}</p><span class="eb-message-status">${m.aiReply ? "Assistant · demo reply" : m.dbMessage ? "Saved to EasyBuy message database" : m.from === email ? "Pending delivery · saved in this browser" : "Saved in this browser"}</span></article>`,
      )
      .join("");
  }
  function renderMessages(user) {
    const box = document.querySelector("#ebMessageList");
    if (!box) return;
    const localRows = () =>
      read("eb_student_messages", []).filter(
        (m) => m.from === user.email || m.to === user.email,
      );
    const paint = (rows) => {
      if (box) box.innerHTML = messageList(rows, user.email);
    };
    paint(localRows());
    // Merge server messages with browser messages. Replacing the local list with DB-only
    // messages used to hide the demo reply immediately after it was created.
    fetch("api-messages.php?email=" + encodeURIComponent(user.email), {
      credentials: "same-origin",
    })
      .then(async (r) => {
        const d = await r.json();
        if (!r.ok || !d.ok)
          throw new Error(d.error || "Message history unavailable");
        return d;
      })
      .then((d) => {
        const dbRows = (d.messages || []).map((m) => ({
          id: "db-" + m.id,
          from: m.sender_email,
          fromName: m.sender_role === "seller" ? "Seller" : m.sender_email,
          to: m.recipient_email,
          productId: m.product_code || "",
          productName: m.product_code || "",
          body: m.body,
          createdAt: m.created_at,
          aiReply: false,
          dbMessage: true,
        }));
        const merged = [...dbRows, ...localRows()];
        const seen = new Set();
        const unique = merged.filter((m) => {
          const key = [
            String(m.from || "").toLowerCase(),
            String(m.to || "").toLowerCase(),
            String(m.body || "").trim(),
          ].join("|");
          if (seen.has(key)) return false;
          seen.add(key);
          return true;
        });
        unique.sort(
          (a, b) => new Date(a.createdAt || 0) - new Date(b.createdAt || 0),
        );
        paint(unique);
      })
      .catch(() => {
        /* Local chat remains visible when PHP/database is unavailable. */
      });
  }
  function refundsPage() {
    const user = requireUser();
    if (!user) return;
    const orders = read("eb_orders", []);
    const requests = read("eb_refund_requests", []).filter(
      (r) => r.email === user.email,
    );
    const eligible = orders.filter(
      (o) =>
        !["Refund requested", "Refunded", "Cancelled"].includes(
          String(o.status || ""),
        ),
    );
    app.innerHTML =
      pageHead(
        "PAYMENT SUPPORT",
        "Refund requests",
        "Submit a refund request for an order and track its request status. Actual payment refunds require a connected payment provider and server verification.",
      ) +
      `<div class="wrap eb-contact-layout"><section class="eb-panel"><h2>↩ Request a refund</h2>${eligible.length ? `<form id="ebRefundForm"><div class="field"><label for="ebRefundOrder">Order</label><select id="ebRefundOrder" required><option value="">Choose an order</option>${eligible.map((o, i) => `<option value="${i}">${esc(o.id || o.orderId || "Order " + (o.date || i + 1))} · ${money(o.total)} · ${esc(o.status || "Submitted")}</option>`).join("")}</select></div><div class="field"><label for="ebRefundReason">Reason</label><select id="ebRefundReason" required><option value="">Choose a reason</option><option>Item not as described</option><option>Item damaged or faulty</option><option>Order cancelled</option><option>Seller did not respond</option><option>Duplicate payment concern</option><option>Other</option></select></div><div class="field"><label for="ebRefundDetails">Details (optional)</label><textarea id="ebRefundDetails" rows="4" maxlength="1500" placeholder="Explain the issue and any steps already taken…"></textarea></div><button class="primary" type="submit">Submit refund request ↗</button><p class="eb-help">This records a request only. It does not initiate or confirm a bank/Razorpay refund.</p><div id="ebRefundStatus" class="eb-inline-status" role="status"></div></form>` : '<div class="eb-empty-note">No eligible orders were found in this browser. Place a demo order first, or check your order history.</div>'}</section><section class="eb-panel"><h2>📋 Your refund requests</h2><div id="ebRefundList">${refundList(requests)}</div></section></div>`;
    const form = document.querySelector("#ebRefundForm");
    if (form)
      form.addEventListener("submit", (e) => {
        e.preventDefault();
        const idx = Number(document.querySelector("#ebRefundOrder").value);
        const order = eligible[idx];
        if (!order) {
          document.querySelector("#ebRefundStatus").textContent =
            "Please choose a valid order.";
          return;
        }
        const all = read("eb_refund_requests", []);
        if (
          all.some(
            (r) =>
              r.email === user.email &&
              String(r.orderKey) ===
                String(order.id || order.orderId || order.date) &&
              !["Rejected", "Closed"].includes(r.status),
          )
        ) {
          document.querySelector("#ebRefundStatus").textContent =
            "A request already exists for this order.";
          return;
        }
        const request = {
          id: "RF-" + Date.now().toString(36).toUpperCase(),
          email: user.email,
          orderKey: order.id || order.orderId || order.date || String(idx),
          orderLabel:
            order.id || order.orderId || "Order " + (order.date || idx + 1),
          amount: Number(order.total) || 0,
          reason: document.querySelector("#ebRefundReason").value,
          details: document.querySelector("#ebRefundDetails").value.trim(),
          status: "Request submitted",
          createdAt: new Date().toISOString(),
        };
        all.unshift(request);
        if (!write("eb_refund_requests", all)) {
          document.querySelector("#ebRefundStatus").textContent =
            "Could not save request. Browser storage may be full.";
          return;
        }
        document.querySelector("#ebRefundStatus").textContent =
          "Refund request saved locally. No money has been refunded.";
        document.querySelector("#ebRefundList").innerHTML = refundList(
          all.filter((r) => r.email === user.email),
        );
        form.reset();
      });
  }
  function refundList(requests) {
    if (!requests.length)
      return '<p class="eb-help">You have not submitted any refund requests yet.</p>';
    return requests
      .map(
        (r) =>
          `<article class="eb-message-card"><div class="eb-message-meta"><strong>${esc(r.id)}</strong><span class="eb-refund-status">${esc(r.status)}</span></div><p><strong>${esc(r.orderLabel)}</strong> · ${money(r.amount)}</p><p>${esc(r.reason)}</p>${r.details ? `<p>${esc(r.details)}</p>` : ""}<time>${esc(new Date(r.createdAt).toLocaleString())}</time></article>`,
      )
      .join("");
  }
  function route() {
    const path = (location.hash || "").slice(1).split("?")[0];
    if (path === "messages") {
      messagePage();
      return;
    }
    if (path === "refunds") {
      refundsPage();
      return;
    }
  }
  window.addEventListener("hashchange", route);
  if (
    ["messages", "refunds"].includes(
      (location.hash || "").slice(1).split("?")[0],
    )
  )
    route();
})();


/* ===== js/pro-enhancements.js ===== */
/* EasyBuy product enhancements: API-backed Discover and persistent chat UI. */
(() => {
  "use strict";
  const $ = (s, root = document) => root.querySelector(s);
  const esc = (s) =>
    String(s ?? "").replace(
      /[&<>"']/g,
      (c) =>
        ({
          "&": "&amp;",
          "<": "&lt;",
          ">": "&gt;",
          '"': "&quot;",
          "'": "&#39;",
        })[c],
    );
  const currentEmail = () =>
    (sessionStorage.getItem("easybuy_js_session_v1") || "")
      .trim()
      .toLowerCase();
  const userList = () => {
    try {
      return JSON.parse(localStorage.getItem("easybuy_js_users_v1") || "[]");
    } catch {
      return [];
    }
  };
  const currentUser = () =>
    userList().find(
      (u) => String(u.email || "").toLowerCase() === currentEmail(),
    ) || null;
  const app = () => $("#app");
  function discoverPage() {
    const host = app();
    if (!host) return;
    host.innerHTML = `<section class="eb-research-page"><div class="eb-research-hero"><span class="eb-research-kicker">EASYBUY · DISCOVER</span><h1>Research smarter.</h1><p>Search the web for study resources, product knowledge, and useful references.</p>
 <form id="ebResearchForm" class="eb-research-form"><label class="sr-only" for="ebResearchQuery">Research topic</label><input id="ebResearchQuery" name="q" maxlength="160" minlength="2" required placeholder="Try “Python programming for beginners”"><button type="submit">⌕ Research</button></form>
 <p class="eb-research-note">Uses free Wikipedia search by default, or broader web results when a Brave API key is configured. Every result links to its source.</p></div>
 <div class="eb-research-results-wrap"><div class="eb-research-toolbar"><div><span class="eyebrow">WEB RESEARCH</span><h2 id="ebResearchHeading">Explore a topic</h2></div><span id="ebResearchCount" class="eb-research-count"></span></div>
 <div id="ebResearchStatus" class="eb-research-status" role="status" aria-live="polite">Enter a topic above to see source-linked results.</div><div id="ebResearchResults" class="eb-research-results"></div></div></section>`;
    const form = $("#ebResearchForm"),
      input = $("#ebResearchQuery"),
      status = $("#ebResearchStatus"),
      results = $("#ebResearchResults"),
      heading = $("#ebResearchHeading"),
      count = $("#ebResearchCount");
    async function search(q) {
      heading.textContent = "Results for “" + q + "”";
      count.textContent = "";
      results.innerHTML = "";
      status.className = "eb-research-status is-loading";
      status.innerHTML =
        '<span class="eb-spinner"></span> Searching trusted web sources…';
      form.querySelector("button").disabled = true;
      try {
        const r = await fetch("api-discover.php?q=" + encodeURIComponent(q), {
          headers: { Accept: "application/json" },
          credentials: "same-origin",
        });
        const d = await r.json();
        if (!r.ok || !d.ok)
          throw new Error(d.error || "Research search failed.");
        if (!d.results.length) {
          status.className = "eb-research-status";
          status.textContent =
            "No results found for this topic. Try different keywords.";
          return;
        }
        status.className = "eb-research-status is-success";
        status.textContent =
          "Search complete. Open a source to read the full article.";
        count.textContent = d.results.length + " sources";
        if (d.note) {
          const note = document.createElement("p");
          note.className = "eb-research-note";
          note.textContent = d.note;
          status.appendChild(note);
        }
        results.innerHTML = d.results
          .map(
            (x, i) =>
              `<article class="eb-research-card"><span class="eb-research-index">${String(i + 1).padStart(2, "0")}</span><div class="eb-research-card-body"><h3><a href="${esc(x.url)}" target="_blank" rel="noopener noreferrer">${esc(x.title)}</a></h3><p>${esc(x.summary || "No summary provided by the source.")}</p><a class="eb-source-link" href="${esc(x.url)}" target="_blank" rel="noopener noreferrer"><span>↗</span> ${esc(x.source || x.url)}</a></div></article>`,
          )
          .join("");
      } catch (err) {
        status.className = "eb-research-status is-error";
        status.innerHTML = `<span>${esc(err.message || "Could not complete the search.")}</span> <button type="button" id="ebResearchRetry">Try again</button>`;
        $("#ebResearchRetry")?.addEventListener("click", () => search(q));
      } finally {
        form.querySelector("button").disabled = false;
      }
    }
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      const q = input.value.trim();
      if (q.length < 2) {
        status.className = "eb-research-status is-error";
        status.textContent = "Please enter at least 2 characters.";
        return;
      }
      search(q);
    });
    const initial = new URLSearchParams(location.hash.split("?")[1] || "").get(
      "q",
    );
    if (initial) {
      input.value = initial;
      search(initial);
    }
  }
  const savedReplies = [
    ["Availability", "Hi! Is this item still available? Please let me know."],
    [
      "Condition",
      "Hi! Could you share more details about the item’s condition and any defects?",
    ],
    [
      "Pickup",
      "Hi! What public campus location and time would work for pickup?",
    ],
    ["Price", "Hi! Is the listed price negotiable? Thank you."],
  ];
  function messagesPage() {
    const host = app();
    if (!host) return;
    const user = currentUser();
    if (!user) {
      host.innerHTML = `<div class="wrap page-title"><h1>Messages</h1><div class="empty"><h2>Sign in to message students</h2><p>Log in first so your conversation can be associated with your account.</p><a class="primary" href="#login">Go to login</a></div></div>`;
      return;
    }
    host.innerHTML = `<section class="eb-chat-page eb-wa-page"><div class="eb-wa-shell">
  <aside class="eb-wa-sidebar"><div class="eb-wa-sidebar-head"><div class="eb-wa-profile"><span class="eb-wa-my-avatar">${esc((user.name || user.email || "Y").slice(0, 1).toUpperCase())}</span><div><strong>EasyBuy Chat</strong><small>Student marketplace</small></div></div><button type="button" id="ebWaNew" class="eb-wa-new" title="Start a new chat" aria-label="Start a new chat">＋</button></div>
   <div class="eb-wa-search"><span>⌕</span><input id="ebWaSearch" type="search" placeholder="Search conversations"></div>
   <div id="ebWaContacts" class="eb-wa-contacts"><div class="eb-wa-list-empty"><span class="eb-spinner"></span> Loading chats…</div></div>
   <div class="eb-wa-new-form" id="ebWaNewForm" hidden><div class="eb-wa-form-head"><strong>Start a new chat</strong><button type="button" id="ebWaCancelNew" aria-label="Cancel">×</button></div><label for="ebWaTo">Recipient email</label><input id="ebWaTo" type="email" maxlength="254" placeholder="student@example.com"><label for="ebWaProduct">Product ID (optional)</label><input id="ebWaProduct" maxlength="80" placeholder="Product ID"><label for="ebWaQuick">Quick reply</label><select id="ebWaQuick"><option value="">Choose saved reply…</option>${savedReplies.map((x, i) => `<option value="${i}">${esc(x[0])}</option>`).join("")}</select><button type="button" id="ebWaStart" class="eb-wa-start">Open chat</button><p id="ebWaNewError"></p></div>
  </aside>
  <section class="eb-wa-conversation"><header class="eb-wa-chat-head" id="ebWaChatHead"><div class="eb-wa-chat-placeholder-avatar">✉</div><div><strong>Select a conversation</strong><small>Your buyer and seller messages</small></div><button type="button" id="ebWaRefresh" title="Refresh chats" aria-label="Refresh chats">↻</button></header>
   <div class="eb-wa-messages" id="ebWaMessages"><div class="eb-wa-welcome"><div class="eb-wa-welcome-mark">EB</div><h2>Buy. Sell. Chat.</h2><p>Choose a conversation on the left or start a new chat with a student.</p><span>🔒 Messages are saved through the EasyBuy server.</span></div></div>
   <form class="eb-wa-composer" id="ebWaComposer"><button type="button" id="ebWaQuickButton" title="Saved replies" aria-label="Saved replies">☰</button><textarea id="ebWaBody" rows="1" maxlength="5000" placeholder="Type a message" disabled required></textarea><button type="submit" id="ebWaSend" disabled aria-label="Send message">➤</button><div id="ebWaStatus" role="status" aria-live="polite"></div></form>
   <div class="eb-wa-quick-replies" id="ebWaQuickReplies" hidden>${savedReplies.map((x, i) => `<button type="button" data-reply="${i}">${esc(x[0])}</button>`).join("")}</div>
  </section></div></section>`;
    const contacts = $("#ebWaContacts"),
      messages = $("#ebWaMessages"),
      body = $("#ebWaBody"),
      composer = $("#ebWaComposer"),
      status = $("#ebWaStatus");
    let rows = [],
      groups = [],
      activeKey = "",
      activeRecipient = "",
      activeProduct = "",
      busy = false;
    const email = String(user.email || "").toLowerCase();
    const fmtTime = (v) => {
      const d = new Date(v);
      return isNaN(d)
        ? ""
        : d.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" });
    };
    const fmtDay = (v) => {
      const d = new Date(v);
      return isNaN(d)
        ? ""
        : d.toLocaleDateString([], {
            month: "short",
            day: "numeric",
            year:
              d.getFullYear() !== new Date().getFullYear()
                ? "numeric"
                : undefined,
          });
    };
    function groupRows(all) {
      const map = new Map();
      all.forEach((m) => {
        const sender = String(m.sender_email || "").toLowerCase(),
          recipient = String(m.recipient_email || "").toLowerCase();
        const other = sender === email ? recipient : sender;
        const product = String(m.product_code || "");
        const key = [other, product].join("|");
        if (!map.has(key)) map.set(key, { key, other, product, messages: [] });
        map.get(key).messages.push(m);
      });
      return [...map.values()].sort(
        (a, b) =>
          new Date(b.messages[b.messages.length - 1].created_at) -
          new Date(a.messages[a.messages.length - 1].created_at),
      );
    }
    function paintContacts() {
      const term = ($("#ebWaSearch").value || "").trim().toLowerCase();
      const shown = groups.filter((g) =>
        (g.other + " " + g.product + " " + (g.messages.at(-1)?.body || ""))
          .toLowerCase()
          .includes(term),
      );
      if (!shown.length) {
        contacts.innerHTML = `<div class="eb-wa-list-empty"><strong>${term ? "No matching chats" : "No chats yet"}</strong><p>${term ? "Try another search." : "Click ＋ to message a buyer or seller."}</p></div>`;
        return;
      }
      contacts.innerHTML = shown
        .map((g) => {
          const last = g.messages[g.messages.length - 1] || {
            body: "Start a new conversation",
            created_at: "",
          };
          const mine = String(last.sender_email || "").toLowerCase() === email;
          return `<button type="button" class="eb-wa-contact ${g.key === activeKey ? "active" : ""}" data-thread="${esc(g.key)}"><span class="eb-wa-contact-avatar">${esc((g.other || "?").slice(0, 1).toUpperCase())}</span><span class="eb-wa-contact-copy"><span class="eb-wa-contact-line"><strong>${esc(g.other)}</strong><time>${esc(fmtTime(last.created_at))}</time></span><span class="eb-wa-contact-preview">${mine ? "You: " : ""}${esc(last.body || "")}</span><span class="eb-wa-contact-product">${g.product ? "Product · " + esc(g.product) : "EasyBuy conversation"}</span></span></button>`;
        })
        .join("");
    }
    function paintConversation() {
      const g = groups.find((x) => x.key === activeKey);
      if (!g) {
        $("#ebWaChatHead").innerHTML =
          '<button type="button" class="eb-wa-back" id="ebWaBackChat" aria-label="Back to chats">‹</button><div class="eb-wa-chat-placeholder-avatar">✉</div><div><strong>Select a conversation</strong><small>Your buyer and seller messages</small></div><button type="button" id="ebWaRefresh" title="Refresh chats" aria-label="Refresh chats">↻</button>';
        $("#ebWaRefresh").addEventListener("click", refresh);
        $("#ebWaBackChat").addEventListener("click", () =>
          host
            .querySelector(".eb-wa-shell")
            ?.classList.remove("eb-wa-show-chat"),
        );
        messages.innerHTML =
          '<div class="eb-wa-welcome"><div class="eb-wa-welcome-mark">EB</div><h2>Buy. Sell. Chat.</h2><p>Choose a conversation on the left or start a new chat with a student.</p><span>🔒 Messages are saved through the EasyBuy server.</span></div>';
        body.disabled = true;
        $("#ebWaSend").disabled = true;
        return;
      }
      activeRecipient = g.other;
      activeProduct = g.product;
      const last = g.messages[g.messages.length - 1];
      $("#ebWaChatHead").innerHTML =
        `<button type="button" class="eb-wa-back" id="ebWaBackChat" aria-label="Back to chats">‹</button><span class="eb-wa-contact-avatar large">${esc((g.other || "?").slice(0, 1).toUpperCase())}</span><div class="eb-wa-chat-person"><strong>${esc(g.other)}</strong><small>${g.product ? "Product ID · " + esc(g.product) : "EasyBuy private conversation"}</small></div><button type="button" id="ebWaRefresh" title="Refresh chats" aria-label="Refresh chats">↻</button>`;
      $("#ebWaRefresh").addEventListener("click", refresh);
      $("#ebWaBackChat").addEventListener("click", () =>
        host.querySelector(".eb-wa-shell")?.classList.remove("eb-wa-show-chat"),
      );
      messages.innerHTML =
        `<div class="eb-wa-date-chip">${esc(fmtDay(g.messages[0].created_at))}</div>` +
        g.messages
          .map((m) => {
            const mine = String(m.sender_email || "").toLowerCase() === email;
            return `<div class="eb-wa-message-row ${mine ? "outgoing" : "incoming"}"><article class="eb-wa-bubble"><p>${esc(m.body)}</p><time>${esc(fmtTime(m.created_at))} ${mine ? '<span aria-label="sent">✓✓</span>' : ""}</time></article></div>`;
          })
          .join("");
      messages.scrollTop = messages.scrollHeight;
      body.disabled = false;
      $("#ebWaSend").disabled = false;
    }
    function selectThread(key) {
      activeKey = key;
      const g = groups.find((x) => x.key === key);
      if (g) {
        activeRecipient = g.other;
        activeProduct = g.product;
        $("#ebWaTo").value = g.other;
        $("#ebWaProduct").value = g.product;
      }
      host.querySelector(".eb-wa-shell")?.classList.add("eb-wa-show-chat");
      paintContacts();
      paintConversation();
      status.textContent = "";
    }
    async function refresh() {
      try {
        const r = await fetch(
          "api-messages.php?email=" + encodeURIComponent(email),
          {
            credentials: "same-origin",
            headers: { Accept: "application/json" },
          },
        );
        const d = await r.json();
        if (!r.ok || !d.ok)
          throw new Error(d.error || "Could not load messages.");
        rows = d.messages || [];
        groups = groupRows(rows);
        paintContacts();
        if (activeKey && !groups.some((g) => g.key === activeKey))
          activeKey = "";
        if (!activeKey && groups.length) activeKey = groups[0].key;
        paintContacts();
        paintConversation();
      } catch (err) {
        contacts.innerHTML = `<div class="eb-wa-list-empty error"><strong>Could not load chats</strong><p>${esc(err.message || "Database connection failed.")}</p><button type="button" id="ebWaRetry">Try again</button></div>`;
        $("#ebWaRetry")?.addEventListener("click", refresh);
      }
    }
    contacts.addEventListener("click", (e) => {
      const b = e.target.closest("[data-thread]");
      if (b) selectThread(b.dataset.thread);
    });
    $("#ebWaSearch").addEventListener("input", paintContacts);
    $("#ebWaNew").addEventListener("click", () => {
      $("#ebWaNewForm").hidden = false;
      $("#ebWaTo").focus();
    });
    $("#ebWaCancelNew").addEventListener("click", () => {
      $("#ebWaNewForm").hidden = true;
      $("#ebWaNewError").textContent = "";
    });
    $("#ebWaStart").addEventListener("click", () => {
      const to = $("#ebWaTo").value.trim().toLowerCase(),
        product = $("#ebWaProduct").value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(to) || to === email) {
        $("#ebWaNewError").textContent =
          "Enter a valid email different from your own.";
        return;
      }
      activeRecipient = to;
      activeProduct = product;
      activeKey = [to, product].join("|");
      if (!groups.some((g) => g.key === activeKey))
        groups.unshift({ key: activeKey, other: to, product, messages: [] });
      paintContacts();
      host.querySelector(".eb-wa-shell")?.classList.add("eb-wa-show-chat");
      $("#ebWaChatHead").innerHTML =
        `<button type="button" class="eb-wa-back" id="ebWaBackChat" aria-label="Back to chats">‹</button><span class="eb-wa-contact-avatar large">${esc(to.slice(0, 1).toUpperCase())}</span><div class="eb-wa-chat-person"><strong>${esc(to)}</strong><small>${product ? "Product ID · " + esc(product) : "New EasyBuy conversation"}</small></div><button type="button" id="ebWaRefresh" title="Refresh chats">↻</button>`;
      $("#ebWaRefresh").addEventListener("click", refresh);
      $("#ebWaBackChat").addEventListener("click", () =>
        host.querySelector(".eb-wa-shell")?.classList.remove("eb-wa-show-chat"),
      );
      messages.innerHTML =
        '<div class="eb-wa-welcome compact"><h2>Start the conversation</h2><p>Say hello to ' +
        esc(to) +
        ".</p></div>";
      body.disabled = false;
      $("#ebWaSend").disabled = false;
      $("#ebWaNewForm").hidden = true;
      body.focus();
    });
    $("#ebWaQuickButton").addEventListener("click", () => {
      $("#ebWaQuickReplies").hidden = !$("#ebWaQuickReplies").hidden;
    });
    $("#ebWaQuickReplies").addEventListener("click", (e) => {
      const b = e.target.closest("[data-reply]");
      if (!b) return;
      body.value = savedReplies[Number(b.dataset.reply)]?.[1] || "";
      $("#ebWaQuickReplies").hidden = true;
      body.focus();
    });
    $("#ebWaQuick").addEventListener("change", (e) => {
      const item = savedReplies[Number(e.target.value)];
      if (item) {
        body.value = item[1];
        $("#ebWaNewError").textContent =
          "Quick reply added. Open the chat to send it.";
      }
    });
    composer.addEventListener("submit", async (e) => {
      e.preventDefault();
      if (busy) return;
      const text = body.value.trim();
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        status.className = "is-error";
        status.textContent = "Your login email is unavailable. Please log out and sign in again.";
        return;
      }
      if (!activeRecipient || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(activeRecipient)) {
        status.textContent = "Choose a conversation or enter a valid recipient email first.";
        return;
      }
      if (activeRecipient.toLowerCase() === email) {
        status.className = "is-error";
        status.textContent = "Enter the other student’s email, not your own.";
        return;
      }
      if (!text) {
        status.textContent = "Type a message first.";
        return;
      }
      busy = true;
      $("#ebWaSend").disabled = true;
      status.className = "is-loading";
      status.textContent = "Sending…";
      try {
        const payload = {
          email,
          to: activeRecipient,
          body: text,
          productCode: activeProduct || "",
        };
        const r = await fetch("api-messages.php", {
          method: "POST",
          credentials: "same-origin",
          headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
          },
          body: JSON.stringify(payload),
        });
        const d = await r.json();
        if (!r.ok || !d.ok)
          throw new Error(d.error || "Message could not be saved.");
        body.value = "";
        status.className = "is-sent";
        status.textContent = "Message sent";
        await refresh();
        activeKey = [activeRecipient, activeProduct].join("|");
        paintContacts();
        paintConversation();
      } catch (err) {
        status.className = "is-error";
        status.textContent =
          "Not sent: " + (err.message || "Server or database error.");
      } finally {
        busy = false;
        $("#ebWaSend").disabled = !activeRecipient;
        body.focus();
      }
    });
    refresh();
    if (window.ebChatPoll) clearInterval(window.ebChatPoll);
    window.ebChatPoll = setInterval(() => {
      if (location.hash.startsWith("#messages")) refresh();
      else clearInterval(window.ebChatPoll);
    }, 12000);
  }
  function routeEnhancements() {
    const path = (location.hash || "#home").slice(1).split("?")[0];
    if (path === "discover") discoverPage();
    if (path === "messages") messagesPage();
  }
  window.addEventListener("hashchange", routeEnhancements);
  if (document.readyState === "loading")
    document.addEventListener("DOMContentLoaded", routeEnhancements);
  else routeEnhancements();
})();


/* ===== js/navigation-upgrade.js ===== */
(() => {
  const toggle = document.getElementById("ebMenuToggle");
  const nav = document.getElementById("ebNavPanel");
  if (!toggle || !nav) return;
  const sessionKeys = [
    "easybuy_js_session_v1",
    "eb_user",
    "easybuy_user",
    "eb_session",
  ];
  function hasLogin() {
    for (const key of sessionKeys) {
      try {
        // The JavaScript login stores its active session in sessionStorage as an email string.
        const value =
          key === "easybuy_js_session_v1"
            ? sessionStorage.getItem(key) || localStorage.getItem(key)
            : localStorage.getItem(key);
        if (value && value !== "null" && value !== "undefined") {
          // The local EasyBuy demo session stores a plain email, not JSON.
          if (key === "easybuy_js_session_v1" && typeof value === "string" && value.includes("@")) return true;
          const parsed = JSON.parse(value);
          if (
            typeof parsed === "object" &&
            parsed &&
            (parsed.email || parsed.id || parsed.user || parsed.role)
          )
            return true;
          if (typeof parsed === "string" && parsed.length > 2) return true;
        }
      } catch (_) {}
    }
    return false;
  }
  function syncNav() {
    const loggedIn = hasLogin();
    nav.querySelectorAll("[data-auth-only]").forEach((el) => {
      el.hidden = !loggedIn;
    });
    nav.querySelectorAll("[data-guest-nav]").forEach((el) => {
      el.hidden = loggedIn;
    });
    // Categories stays public; the expanded private menus only appear for a detected session.
  }
  toggle.addEventListener("click", () => {
    const open = nav.classList.toggle("eb-nav-visible");
    toggle.setAttribute("aria-expanded", String(open));
    toggle.setAttribute(
      "aria-label",
      open ? "Close navigation menu" : "Open navigation menu",
    );
    toggle.textContent = open ? "✕" : "☰";
  });
  const menuButtons = [...nav.querySelectorAll("[data-menu-parent]")];
  function closeDropdowns(except = null) {
    nav.querySelectorAll(".eb-nav-group.eb-open").forEach((group) => {
      if (group === except) return;
      group.classList.remove("eb-open");
      group.querySelector("[data-menu-parent]")?.setAttribute("aria-expanded", "false");
    });
  }
  menuButtons.forEach((button) => {
    button.addEventListener("click", (event) => {
      event.stopPropagation();
      const group = button.closest(".eb-nav-group");
      const open = !group.classList.contains("eb-open");
      closeDropdowns(group);
      group.classList.toggle("eb-open", open);
      button.setAttribute("aria-expanded", String(open));
    });
  });
  // Close dropdowns when the user taps anywhere outside the open menu.
  document.addEventListener("click", (event) => {
    if (!nav.contains(event.target)) closeDropdowns();
    else if (!event.target.closest(".eb-nav-group")) closeDropdowns();
  });
  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
      closeDropdowns();
      nav.classList.remove("eb-nav-visible");
      toggle.setAttribute("aria-expanded", "false");
      toggle.textContent = "☰";
    }
  });
  nav.addEventListener("click", (event) => {
    const link = event.target.closest("a");
    if (link) {
      nav
        .querySelectorAll("a")
        .forEach((a) => a.removeAttribute("aria-current"));
      link.setAttribute("aria-current", "page");
      nav.classList.remove("eb-nav-visible");
      toggle.setAttribute("aria-expanded", "false");
      toggle.textContent = "☰";
    }
  });
  // Lightweight cart micro-interaction when the visible count changes.
  const count = document.getElementById("cartCount");
  if (count && window.MutationObserver) {
    new MutationObserver(() => {
      const cart = count.closest(".cartbtn") || count;
      cart.classList.remove("eb-cart-bump");
      void cart.offsetWidth;
      cart.classList.add("eb-cart-bump");
    }).observe(count, { childList: true, characterData: true, subtree: true });
  }
  window.addEventListener("storage", syncNav);
  window.addEventListener("easybuy:auth-changed", syncNav);
  window.addEventListener("hashchange", () => {
    const current = (location.hash || "#home").split("?")[0];
    nav.querySelectorAll('a[href^="#"]').forEach((a) => {
      if (a.getAttribute("href") === current)
        a.setAttribute("aria-current", "page");
      else a.removeAttribute("aria-current");
    });
  });
  window.addEventListener("hashchange", syncNav);
  syncNav();
})();


/* ===== js/analytics-tracker.js ===== */
(function () {
  try {
    var scripts = document.getElementsByTagName('script');
    var own = null;
    for (var i = 0; i < scripts.length; i++) if ((scripts[i].src || '').indexOf('analytics-tracker.js') !== -1) own = scripts[i];
    if (!own) return;
    var root = own.src.split('js/analytics-tracker.js')[0];
    var basePath = new URL(root).pathname;
    var page = window.location.pathname.indexOf(basePath) === 0 ? window.location.pathname.slice(basePath.length - 1) : window.location.pathname;
    if (window.location.hash) page += window.location.hash;
    if (/\/admin\//i.test(page)) return;
    fetch(root + 'api-track.php', {method:'POST', headers:{'Content-Type':'application/json'}, credentials:'same-origin', keepalive:true, body:JSON.stringify({page:page})}).catch(function(){});
  } catch (e) {}
})();


</script>
</body>

</html>

HTML;
$headPos = stripos($buyerPage, '</head>');
if ($headPos !== false) $buyerPage = substr($buyerPage, 0, $headPos) . $bootTag . substr($buyerPage, $headPos);
header('Content-Type: text/html; charset=utf-8');
header('Cache-Control: no-store');
echo $buyerPage;
