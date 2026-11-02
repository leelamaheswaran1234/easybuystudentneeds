<?php
require __DIR__ . '/api-config.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="theme-color" content="#1749b5">
    <title>EasyBuy Seller Studio</title>
    <style>
* {
    box-sizing: border-box
}

body {
    margin: 0;
    background: #f4f7fc;
    color: #15223a;
    font: 15px/1.5 Inter, Segoe UI, Arial, sans-serif
}

header {
    height: 72px;
    background: #fff;
    border-bottom: 1px solid #e2e8f3;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 max(5vw, 20px);
    position: sticky;
    top: 0;
    z-index: 2
}

.brand {
    font-weight: 900;
    font-size: 22px;
    color: #15223a;
    text-decoration: none
}

.brand span {
    color: #2459cf
}

.brand small {
    font-size: 12px;
    color: #68758b;
    font-weight: 600;
    margin-left: 12px
}

.back {
    color: #2459cf;
    text-decoration: none;
    font-weight: 700
}

main {
    max-width: 1240px;
    margin: 34px auto;
    padding: 0 22px
}

.auth {
    display: grid;
    grid-template-columns: 1fr minmax(300px, 430px);
    gap: 50px;
    align-items: center;
    min-height: 68vh
}

.intro h1,
.dashhead h1 {
    font-size: clamp(30px, 4vw, 48px);
    line-height: 1.1;
    margin: 12px 0
}

.intro p,
.dashhead p,
.muted {
    color: #66738a
}

.intro ul {
    list-style: none;
    padding: 0;
    line-height: 2.3
}

.eyebrow {
    font-size: 11px;
    letter-spacing: 2px;
    color: #2459cf;
    font-weight: 900
}

.panel,
.stats article {
    background: white;
    border: 1px solid #e3eaf5;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 8px 30px #1a37620a
}

.tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 22px;
    background: #f1f5fb;
    padding: 5px;
    border-radius: 10px
}

.tabs button {
    width: 50%;
    border: 0;
    padding: 11px;
    border-radius: 8px;
    background: transparent;
    color: #64738b;
    font-weight: 800;
    cursor: pointer
}

.tabs button.active {
    background: white;
    color: #2459cf;
    box-shadow: 0 2px 7px #162b5012
}

label {
    display: block;
    font-weight: 700;
    font-size: 13px;
    margin: 15px 0;
    color: #283852
}

input,
select,
textarea {
    display: block;
    width: 100%;
    font: inherit;
    margin-top: 7px;
    padding: 12px;
    border: 1px solid #d8e1ef;
    border-radius: 9px;
    background: #fff;
    color: #15223a
}

input:focus,
select:focus,
textarea:focus {
    outline: 2px solid #b8ccff;
    border-color: #2459cf
}

.primary,
.outline {
    border-radius: 9px;
    padding: 12px 17px;
    font: inherit;
    font-weight: 800;
    cursor: pointer
}

.primary {
    border: 0;
    background: #2459cf;
    color: #fff;
    width: 100%;
    margin-top: 10px
}

.primary:disabled {
    opacity: .55
}

.outline {
    background: #fff;
    border: 1px solid #cbd7ea;
    color: #2459cf
}

.notice {
    font-size: 13px;
    color: #c0392b;
    min-height: 18px
}

.dashhead,
.listHead {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px
}

.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin: 24px 0
}

.stats article small {
    display: block;
    color: #68758b
}

.stats strong {
    font-size: 32px;
    color: #2459cf
}

.columns {
    display: grid;
    grid-template-columns: minmax(300px, .9fr) minmax(350px, 1.1fr);
    gap: 20px;
    align-items: start
}

.columns h2 {
    margin: 0 0 5px
}

.two {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px
}

#preview {
    max-width: 160px;
    max-height: 140px;
    object-fit: contain;
    border-radius: 10px;
    margin: 10px 0
}

.listing {
    display: grid;
    grid-template-columns: 76px 1fr auto;
    gap: 13px;
    padding: 14px 0;
    border-bottom: 1px solid #edf1f7;
    align-items: center
}

.listing img {
    width: 76px;
    height: 76px;
    object-fit: cover;
    border-radius: 10px;
    background: #f3f6fb
}

.listing strong {
    display: block
}

.listing small {
    display: block;
    color: #68758b
}

.pill {
    font-size: 11px;
    font-weight: 800;
    border-radius: 20px;
    padding: 4px 8px;
    background: #e8f7ee;
    color: #167847
}

.pill.off {
    background: #fff0e5;
    color: #9c4d0b
}

.listing button {
    display: block;
    margin-top: 6px;
    font-size: 12px;
    padding: 6px 9px
}

footer {
    text-align: center;
    padding: 28px;
    color: #748198;
    font-size: 12px
}

.globalNotice {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #15223a;
    color: white;
    border-radius: 10px;
    padding: 13px 18px;
    max-width: 90vw;
    display: none;
    box-shadow: 0 10px 30px #0002
}

[hidden] {
    display: none !important
}

@media(max-width:850px) {

    .auth,
    .columns {
        grid-template-columns: 1fr;
        gap: 20px
    }

    .auth {
        padding: 20px 0
    }

    .intro h1 {
        font-size: 34px
    }

    .stats {
        gap: 8px
    }

    .stats article {
        padding: 14px
    }

    .stats strong {
        font-size: 25px
    }

    .listing {
        grid-template-columns: 60px 1fr
    }

    .listing img {
        width: 60px;
        height: 60px
    }

    .listing>div:last-child {
        grid-column: 2
    }

    .dashhead {
        align-items: flex-start
    }

    .two {
        grid-template-columns: 1fr 1fr
    }
}

.contact-panel {
    display: grid;
    grid-template-columns: 1fr minmax(280px, 440px);
    gap: 24px;
    align-items: center;
    margin: 20px 0
}

.contact-panel h2 {
    margin: 0 0 6px
}

.contact-panel p {
    margin: 5px 0
}

.contact-form label {
    margin-top: 0
}

.contact-form .primary {
    width: auto;
    margin-top: 0
}

.contact-form .notice {
    margin: 8px 0 0;
    min-height: 0
}

.contact-form .notice:empty {
    display: none
}

@media(max-width:850px) {
    .contact-panel {
        grid-template-columns: 1fr;
        gap: 8px
    }
}

/* Seller inbox: clean, WhatsApp-inspired message cards */
#sellerMessages {
    min-width: 0
}

.seller-chat-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(min(100%, 390px), 1fr));
    gap: 16px;
    margin-top: 18px
}

.seller-chat-card {
    min-width: 0;
    background: #fff;
    border: 1px solid #e1e8f3;
    border-radius: 16px;
    padding: 18px;
    box-shadow: 0 5px 18px rgba(25, 55, 100, .045);
    transition: border-color .18s, box-shadow .18s
}

.seller-chat-card:focus-within {
    border-color: #a9c2ff;
    box-shadow: 0 8px 24px rgba(36, 89, 207, .09)
}

.seller-chat-head {
    display: flex;
    align-items: center;
    gap: 11px;
    padding-bottom: 14px;
    border-bottom: 1px solid #edf1f7
}

.seller-chat-avatar {
    width: 42px;
    height: 42px;
    flex: 0 0 42px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background: #e8efff;
    color: #2459cf;
    font-size: 16px;
    font-weight: 900
}

.seller-chat-person {
    display: flex;
    flex-direction: column;
    min-width: 0;
    flex: 1
}

.seller-chat-person strong {
    font-size: 13px;
    overflow-wrap: anywhere;
    color: #182641
}

.seller-chat-person small {
    font-size: 11px;
    color: #7b879a;
    margin-top: 3px
}

.seller-chat-role {
    font-size: 10px;
    font-weight: 800;
    white-space: nowrap;
    padding: 5px 8px;
    border-radius: 20px
}

.seller-chat-role.buyer {
    background: #edf3ff;
    color: #2459cf
}

.seller-chat-role.seller {
    background: #e7f8ef;
    color: #16734a
}

.seller-chat-bubble {
    position: relative;
    max-width: 94%;
    width: fit-content;
    padding: 12px 14px;
    border-radius: 4px 14px 14px 14px;
    font-size: 14px;
    line-height: 1.6;
    white-space: pre-wrap;
    overflow-wrap: anywhere;
    margin: 16px 0 20px
}

.seller-chat-bubble.incoming {
    background: #f0f4fa;
    color: #283852
}

.seller-chat-bubble.outgoing {
    margin-left: auto;
    background: #e5f8ed;
    color: #174c35;
    border-radius: 14px 4px 14px 14px
}

.seller-reply-form {
    border-top: 1px solid #edf1f7;
    padding-top: 14px
}

.seller-reply-form>label {
    font-size: 12px;
    color: #56657c;
    margin: 0 0 8px
}

.seller-reply-compose {
    display: flex;
    align-items: stretch;
    gap: 9px
}

.seller-reply-compose textarea {
    resize: vertical;
    min-height: 48px;
    max-height: 150px;
    margin: 0;
    background: #f9fbff;
    border-color: #dce5f2;
    border-radius: 11px;
    padding: 12px;
    flex: 1;
    min-width: 0;
    font-size: 13px
}

.seller-send-btn {
    align-self: stretch;
    width: auto;
    min-width: 94px;
    margin: 0;
    border: 0;
    border-radius: 11px;
    padding: 0 15px;
    background: #2459cf;
    color: #fff;
    font-weight: 800;
    font-size: 13px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px
}

.seller-send-btn:hover {
    background: #1749b5
}

.seller-send-btn:disabled {
    opacity: .6;
    cursor: wait
}

.seller-send-btn span {
    font-size: 17px
}

.seller-reply-hint {
    display: block;
    color: #8994a5;
    font-size: 11px;
    margin-top: 8px
}

.reply-error .seller-reply-hint {
    color: #bd3131
}

.reply-success .seller-reply-hint {
    color: #16804d
}

.seller-empty-chat {
    padding: 38px 20px;
    text-align: center;
    border: 1px dashed #d6e0ef;
    background: #f9fbff;
    border-radius: 15px;
    color: #6b7890
}

.seller-empty-chat>span {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #e9efff;
    color: #2459cf;
    display: grid;
    place-items: center;
    margin: 0 auto 12px;
    font-size: 22px
}

.seller-empty-chat strong {
    display: block;
    color: #20304b;
    font-size: 15px
}

.seller-empty-chat p {
    font-size: 13px;
    max-width: 390px;
    margin: 7px auto 0
}

.seller-empty-chat.error {
    border-color: #f0c7c7;
    background: #fffafa
}

.seller-empty-chat.error>span {
    display: none
}

.seller-empty-chat.error strong {
    color: #b42323
}

.seller-empty-chat .outline {
    margin-top: 12px
}

@media(max-width:520px) {
    .seller-chat-card {
        padding: 13px
    }

    .seller-chat-role {
        font-size: 9px;
        padding: 4px 6px
    }

    .seller-reply-compose {
        flex-direction: column
    }

    .seller-send-btn {
        min-height: 44px;
        width: 100%
    }
}


.sales-stats {
    grid-template-columns: repeat(4, minmax(0, 1fr));
    margin: 18px 0 10px;
}
.sales-stats article {
    background: #f7faff;
    border: 1px solid #e0e9fb;
    border-radius: 12px;
    padding: 16px;
}
.sales-stats strong {
    display: block;
    font-size: clamp(20px, 2.2vw, 30px);
    overflow-wrap: anywhere;
}
.seller-sales-panel { margin: 20px 0; }
@media (max-width: 760px) {
    .sales-stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
}

</style>
</head>

<body>
    <header><a class="brand" href="index.php">Easy<span>Buy</span> <small>Seller Studio</small></a><a class="back" href="index.php">Buyer website ↗</a></header>
    <main>
        <section id="authView" class="auth">
            <div class="intro"><span class="eyebrow">SELL ON EASYBUY</span>
                <h1>Your campus store, in one place.</h1>
                <p>Create a seller account to publish real listings shared with buyers on this EasyBuy installation. Your products and photos are stored on the server database, not just your browser.</p>
                <ul>
                    <li>✓ Publish and manage listings</li>
                    <li>✓ Shared catalogue across devices</li>
                    <li>✓ Seller account with password hashing</li>
                </ul>
            </div>
            <div class="panel">
                <div class="tabs"><button id="loginTab" class="active">Sign in</button><button id="registerTab">Create account</button></div>
                <form id="authForm"><label id="nameWrap" hidden>Full name<input name="name" maxlength="80" autocomplete="name"></label><div id="securityWrap" hidden><label>Security question<select name="security_question"><option value="">Choose a question</option><option value="What is your favourite colour?">What is your favourite colour?</option><option value="What was the name of your first school?">What was the name of your first school?</option><option value="What is your favourite food?">What is your favourite food?</option><option value="What is your childhood nickname?">What is your childhood nickname?</option></select></label><label>Security answer<input name="security_answer" maxlength="120" autocomplete="off" placeholder="Remember your answer"></label><small>Use an answer you can remember. It is stored as a hash.</small></div><label>Email address<input type="email" name="email" required autocomplete="email"></label><label>Password<input type="password" name="password" minlength="8" required autocomplete="current-password"></label><button class="primary" id="authSubmit">Sign in</button>
                    <p class="notice" id="authNotice" role="status"></p>
                    <p style="margin:12px 0 0;text-align:right"><a href="seller-forgot-password.php" style="color:#1749b5;font-weight:700;text-decoration:none">Forgot password?</a></p>
                </form>
            </div>
        </section>
        <section id="dashboard" hidden>
            <div class="dashhead">
                <div><span class="eyebrow">SELLER DASHBOARD</span>
                    <h1>Hello, <span id="sellerName">seller</span></h1>
                    <p>Manage your published products and keep your campus catalogue up to date.</p>
                    <div class="seller-account-actions" style="display:flex;gap:10px;flex-wrap:wrap;margin-top:14px;">
                        <a href="seller-change-password.html" class="outline" style="display:inline-flex;align-items:center;justify-content:center;padding:10px 16px;border:1px solid #1749b5;border-radius:9px;color:#1749b5;text-decoration:none;font-weight:700;background:#fff;">🔒 Change / Update Password</a>
                    </div>
                </div><button id="logout" class="outline">Sign out</button>
            </div>
            <div class="stats">
                <article><small>Total listings</small><strong id="totalCount">0</strong></article>
                <article><small>Live listings</small><strong id="liveCount">0</strong></article>
                <article><small>Removed listings</small><strong id="removedCount">0</strong></article>
            </div>
            <section class="panel seller-sales-panel" aria-labelledby="salesTitle">
                <div class="listHead"><div><h2 id="salesTitle">Sales & earnings</h2><p class="muted">Calculated from your products in customer orders. Only delivered orders count as completed sales.</p></div><button id="refreshOrdersTop" class="outline" type="button">Refresh sales</button></div>
                <div class="stats sales-stats">
                    <article><small>Completed sales</small><strong id="salesCompleted">₹0</strong></article>
                    <article><small>Pending order value</small><strong id="salesPending">₹0</strong></article>
                    <article><small>Units sold</small><strong id="salesUnits">0</strong></article>
                    <article><small>Total orders</small><strong id="salesOrderCount">0</strong></article>
                </div>
                <p id="salesBreakdown" class="muted" role="status">Sales totals will appear when order data loads.</p>
            </section>
            <section class="panel contact-panel">
                <div>
                    <h2>Seller contact details</h2>
                    <p class="muted">Your number appears with your live products so buyers can call you directly.</p>
                </div>
                <form id="contactForm" class="contact-form"><label>Mobile number<input id="sellerPhone" name="phone" type="tel" inputmode="tel" autocomplete="tel" maxlength="24" placeholder="9876543210" required></label><button class="primary" id="saveContact" type="submit">Save contact number</button>
                    <p id="contactNotice" class="notice" role="status"></p>
                </form>
            </section>
            <div class="panel" style="margin:20px 0">
                <div class="listHead">
                    <div>
                        <h2>Product history</h2>
                        <p class="muted">Publish, republish, unpublish and order activity.</p>
                    </div><button id="refreshHistory" class="outline" type="button">Refresh history</button>
                </div>
                <div id="productHistory">
                    <p class="muted">Loading history…</p>
                </div>
            </div>
            <div class="panel" style="margin:20px 0">
                <div class="listHead">
                    <div>
                        <h2>Customer orders & tracking</h2>
                        <p class="muted">Update order status; buyers see these updates in My Orders.</p>
                    </div><button id="refreshOrders" class="outline" type="button">Refresh orders</button>
                </div>
                <div id="sellerOrders">
                    <p class="muted">Loading orders…</p>
                </div>
            </div>
            <div class="panel" style="margin:20px 0">
                <div class="listHead">
                    <div>
                        <h2>Buyer messages</h2>
                        <p class="muted">Messages sent through the database-backed inbox.</p>
                    </div><button id="refreshMessages" class="outline" type="button">Refresh messages</button>
                </div>
                <div id="sellerMessages">
                    <p class="muted">Loading messages…</p>
                </div>
            </div>
            <div class="columns">
                <section class="panel">
                    <h2>Publish a product</h2>
                    <p class="muted">Use your own product photo and accurate condition/price.</p>
                    <form id="productForm" enctype="multipart/form-data"><label>Product name<input name="name" maxlength="100" required placeholder="e.g. BCA Java textbook"></label>
                        <div class="two"><label>Category<select name="category" required>
                                    <option>Books</option>
                                    <option>Stationery Kits</option>
                                    <option>Calculators</option>
                                    <option>Lab Equipment</option>
                                    <option>Electronics</option>
                                    <option>Accessories</option>
                                    <option>T-Shirts</option>
                                    <option>Bags</option>
                                </select></label><label>Price (₹)<input type="number" name="price" min="1" max="100000" step="0.01" required></label></div>
                        <div class="two"><label>Condition<select name="condition">
                                    <option>Second-hand · Very good</option>
                                    <option>Second-hand · Good</option>
                                    <option>First-hand · New</option>
                                </select></label><label>Available quantity<input type="number" name="stock" min="1" max="999" value="1" required></label></div><label>College / campus<input name="college" maxlength="100" required placeholder="College name"></label><label>Description<textarea name="description" rows="4" maxlength="2000" placeholder="Condition, edition, included accessories…"></textarea></label><label>Product photo (JPG, PNG, WEBP; max 4 MB)<input type="file" name="photo" accept="image/jpeg,image/png,image/webp" required></label><img id="preview" alt="Selected product preview" hidden><button class="primary">Publish listing</button>
                        <p id="productNotice" class="notice" role="status"></p>
                    </form>
                </section>
                <section class="panel">
                    <div class="listHead">
                        <div>
                            <h2>Your listings</h2>
                            <p class="muted">Changes appear in the shared catalogue.</p>
                        </div><button id="refresh" class="outline">Refresh</button>
                    </div>
                    <div id="listingList">
                        <p class="muted">Loading listings…</p>
                    </div>
                </section>
            </div>
        </section>
        <div id="globalNotice" class="globalNotice" role="status"></div>
    </main>
    <footer>EasyBuy Seller Studio · Secure server-side sessions · Never share your password.</footer>
    
    
<script>
(() => {
  "use strict";
  const $ = (s) => document.querySelector(s);
  let mode = "login",
    csrf = "";
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
  async function api(url, opts = {}, retryCsrf = true) {
    const requestOpts = { credentials: "same-origin", ...opts };
    const r = await fetch(url, requestOpts);
    let d;
    const raw = await r.text();
    try {
      d = JSON.parse(raw);
    } catch {
      const preview = raw.replace(/\s+/g, " ").slice(0, 220);
      throw Error(`Server returned non-JSON (HTTP ${r.status}). Check api-config.php and the PHP error log. Response: ${preview || "empty response"}`);
    }
    // Refresh the seller session token once when a hosting/session refresh made
    // the page's token stale. Do not retry login or other requests without a token.
    if (r.status === 419 && retryCsrf && requestOpts.headers && requestOpts.headers["X-CSRF-Token"]) {
      const meResponse = await fetch("seller-auth.php?action=me", { credentials: "same-origin", headers: { "Accept": "application/json" } });
      const meRaw = await meResponse.text();
      let me;
      try { me = JSON.parse(meRaw); } catch { me = null; }
      if (me && me.ok && me.seller && me.csrf) {
        csrf = me.csrf;
        const headers = new Headers(requestOpts.headers);
        headers.set("X-CSRF-Token", csrf);
        return api(url, { ...requestOpts, headers }, false);
      }
      throw Error("Your seller session has expired. Please sign in again.");
    }
    if (!r.ok || d.ok === false) throw Error(d.error || "Request failed");
    return d;
  }
  function notice(id, msg) {
    $(id).textContent = msg || "";
  }
  function setMode(m) {
    mode = m;
    $("#loginTab").classList.toggle("active", m === "login");
    $("#registerTab").classList.toggle("active", m === "register");
    $("#nameWrap").hidden = m !== "register";
    $("#nameWrap input").required = m === "register";
    $("#securityWrap").hidden = m !== "register";
    $("#securityWrap select").required = m === "register";
    $("#securityWrap input").required = m === "register";
    $("#authSubmit").textContent =
      m === "login" ? "Sign in" : "Create seller account";
    $("#authForm [name=password]").autocomplete =
      m === "login" ? "current-password" : "new-password";
    notice("#authNotice", "");
  }
  $("#loginTab").onclick = () => setMode("login");
  $("#registerTab").onclick = () => setMode("register");
  $("#authForm").onsubmit = async (e) => {
    e.preventDefault();
    const b = $("#authSubmit");
    b.disabled = true;
    notice("#authNotice", "Please wait…");
    try {
      const d = await api(`seller-${mode}.php`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          action: mode,
          ...Object.fromEntries(new FormData(e.target)),
        }),
      });
      csrf = d.csrf;
      showDashboard(d.seller);
    } catch (err) {
      notice("#authNotice", err.message);
    } finally {
      b.disabled = false;
    }
  };
  function showDashboard(s) {
    $("#authView").hidden = true;
    $("#dashboard").hidden = false;
    $("#sellerName").textContent = s.name;
    $("#sellerPhone").value = s.phone || "";
    loadListings();
    loadProductHistory();
    loadSellerOrders();
    loadSellerMessages();
  }
  async function loadListings() {
    const box = $("#listingList");
    box.innerHTML = '<p class="muted">Loading…</p>';
    try {
      const d = await api("api-my-products.php");
      const ps = d.products;
      $("#totalCount").textContent = ps.length;
      $("#liveCount").textContent = ps.filter(
        (p) => p.status === "active",
      ).length;
      $("#removedCount").textContent = ps.filter(
        (p) => p.status !== "active",
      ).length;
      box.innerHTML = ps.length
        ? ps
            .map(
              (p) =>
                `<div class="listing"><img src="${esc(p.image)}" alt="${esc(p.name)}" loading="lazy" onerror="this.onerror=null;this.style.display='none'"><div><strong>${esc(p.name)}</strong><small>${esc(p.category)} · ${esc(p.condition)} · ₹${Number(p.price).toLocaleString("en-IN")}</small><small>${esc(p.college)} · Stock ${Number(p.stock)} · Views ${Number(p.views || 0)}</small><small class="seller-product-rating">${Number(p.reviews || 0) ? `${'★'.repeat(Math.max(0, Math.min(5, Math.round(Number(p.rating) || 0))))}${'☆'.repeat(5-Math.max(0, Math.min(5, Math.round(Number(p.rating) || 0))))} ${Number(p.rating).toFixed(1)} · ${Number(p.reviews)} rating(s)` : '☆☆☆☆☆ No ratings yet'}</small><span class="pill ${p.status === "active" ? "" : "off"}">${esc(p.status)}</span></div><div>${p.status === "active" ? `<button class="outline" data-action="remove" data-id="${p.id}">Unpublish</button>` : `<button class="outline" data-action="restore" data-id="${p.id}">Republish</button>`}</div></div>`,
            )
            .join("")
        : '<p class="muted">No listings yet. Publish your first product.</p>';
    } catch (e) {
      box.innerHTML = `<p class="notice">${esc(e.message)}</p>`;
    }
  }
  $("#contactForm").onsubmit = async (e) => {
    e.preventDefault();
    const b = $("#saveContact");
    b.disabled = true;
    notice("#contactNotice", "Saving contact number…");
    try {
      const d = await api("api-profile.php", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({ phone: $("#sellerPhone").value.trim() }),
      });
      $("#sellerPhone").value = d.phone || "";
      notice("#contactNotice", "✓ " + d.message);
    } catch (err) {
      notice("#contactNotice", err.message);
    } finally {
      b.disabled = false;
    }
  };
  $("#listingList").onclick = async (e) => {
    const b = e.target.closest("[data-action]");
    if (!b) return;
    b.disabled = true;
    try {
      await api("api-my-products.php", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({
          action: b.dataset.action,
          id: Number(b.dataset.id),
        }),
      });
      await loadListings();
    } catch (e) {
      alert(e.message);
    } finally {
      b.disabled = false;
    }
  };
  $("#productForm").onsubmit = async (e) => {
    e.preventDefault();
    const b = e.submitter;
    b.disabled = true;
    notice("#productNotice", "Publishing to the shared catalogue…");
    try {
      const fd = new FormData(e.target);
      const d = await api("api-products.php", {
        method: "POST",
        headers: { "X-CSRF-Token": csrf },
        body: fd,
      });
      notice("#productNotice", d.message);
      e.target.reset();
      $("#preview").hidden = true;
      await loadListings();
    } catch (err) {
      notice("#productNotice", err.message);
    } finally {
      b.disabled = false;
    }
  };
  const photoInput = $("#productForm [name=photo]");
  const previewImage = $("#preview");
  let previewObjectUrl = null;
  const showPhotoPreview = () => {
    const f = photoInput.files && photoInput.files[0];
    if (previewObjectUrl) { URL.revokeObjectURL(previewObjectUrl); previewObjectUrl = null; }
    if (!f) { previewImage.hidden = true; previewImage.removeAttribute("src"); return; }
    if (!/^image\/(jpeg|png|webp)$/.test(f.type) || f.size > 4 * 1024 * 1024) {
      notice("#productNotice", f.size > 4 * 1024 * 1024 ? "Photo must be 4 MB or smaller." : "Choose a JPG, PNG or WEBP image.");
      photoInput.value = ""; previewImage.hidden = true; previewImage.removeAttribute("src"); return;
    }
    previewObjectUrl = URL.createObjectURL(f);
    previewImage.onload = () => { previewImage.hidden = false; notice("#productNotice", "Photo ready to publish."); };
    previewImage.onerror = () => { previewImage.hidden = true; notice("#productNotice", "Could not preview this image. Choose another photo."); };
    previewImage.src = previewObjectUrl;
  };
  photoInput.addEventListener("change", showPhotoPreview);
  photoInput.addEventListener("input", showPhotoPreview);
  $("#refresh").onclick = loadListings;
  $("#logout").onclick = async () => {
    try {
      await api("seller-logout.php", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({ action: "logout" }),
      });
    } catch {}
    $("#dashboard").hidden = true;
    $("#authView").hidden = false;
    setMode("login");
  };
  async function loadProductHistory() {
    const box = $("#productHistory");
    if (!box) return;
    try {
      const d = await api("api-my-products.php?history=1");
      box.innerHTML = d.history.length
        ? d.history
            .map(
              (h) =>
                `<article class="listing"><div><strong>${esc(h.product_name)}</strong><small>${esc(h.action)} · ${esc(h.details)}</small><small>${esc(h.created_at)}</small></div></article>`,
            )
            .join("")
        : '<p class="muted">No product activity recorded yet. New publishing and order events will appear here.</p>';
    } catch (e) {
      box.innerHTML = `<p class="notice">${esc(e.message)}</p>`;
    }
  }
  async function loadSellerOrders() {
    const box = $("#sellerOrders");
    if (!box) return;
    try {
      await api("api-order-features.php", { method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf }, body: JSON.stringify({ action: "sync_refund_messages" }) });
      const d = await api("api-orders.php?seller=1");
      const sellerOrders = Array.isArray(d.orders) ? d.orders : [];
      const money = (n) => "₹" + Number(n || 0).toLocaleString("en-IN", { maximumFractionDigits: 2 });
      const valueOf = (o) => (o.items || []).reduce((sum, item) => sum + (Number(item.price || 0) * Number(item.qty || 0)), 0);
      const deliveredOrders = sellerOrders.filter(o => String(o.status).toLowerCase() === "delivered");
      const pendingOrders = sellerOrders.filter(o => ["placed", "confirmed", "shipped"].includes(String(o.status).toLowerCase()));
      const completedValue = deliveredOrders.reduce((sum, o) => sum + valueOf(o), 0);
      const pendingValue = pendingOrders.reduce((sum, o) => sum + valueOf(o), 0);
      const unitsSold = deliveredOrders.reduce((sum, o) => sum + (o.items || []).reduce((n, item) => n + Number(item.qty || 0), 0), 0);
      if ($("#salesCompleted")) $("#salesCompleted").textContent = money(completedValue);
      if ($("#salesPending")) $("#salesPending").textContent = money(pendingValue);
      if ($("#salesUnits")) $("#salesUnits").textContent = String(unitsSold);
      if ($("#salesOrderCount")) $("#salesOrderCount").textContent = String(sellerOrders.length);
      if ($("#salesBreakdown")) $("#salesBreakdown").textContent = `${deliveredOrders.length} completed order(s) · ${pendingOrders.length} pending/in-progress order(s) · Cancelled orders excluded. Values are item subtotals for your products, excluding delivery charges.`;
      box.innerHTML = sellerOrders.length
        ? sellerOrders
            .map(
              (o) =>
                `<article class="listing"><div><strong>${esc(o.order_code)} · ${esc(o.customer_name)}</strong><small>${esc(o.customer_phone)} · ${esc(o.delivery_address)}</small><small>${(o.items || []).map((i) => esc(i.name) + " × " + Number(i.qty)).join(", ")}</small><small>Total ₹${Number(o.total).toLocaleString("en-IN")} · ${esc(o.payment_status)}</small><span class="pill">${esc(o.status)}</span></div><div><select data-order-status="${o.id}" aria-label="Update order status"><option ${o.status === "Placed" ? "selected" : ""}>Placed</option><option ${o.status === "Confirmed" ? "selected" : ""}>Confirmed</option><option ${o.status === "Shipped" ? "selected" : ""}>Shipped</option><option ${o.status === "Cancelled" ? "selected" : ""}>Cancelled</option></select><button class="outline" data-save-order="${o.id}">Save status</button>${o.status === "Shipped" ? `<form data-otp-form="${o.id}" style="margin-top:10px;display:flex;gap:6px;flex-wrap:wrap"><input name="otp" inputmode="numeric" maxlength="6" pattern="[0-9]{6}" placeholder="Customer delivery OTP" required style="width:150px"><button class="outline">Verify & mark delivered</button></form>` : ""}${["Confirmed","Shipped"].includes(o.status) ? `<form data-shipper-form="${o.id}" style="margin-top:10px;display:grid;gap:6px"><input name="shipperName" maxlength="100" placeholder="Shipper / courier name" required value="${esc(o.shipper_name || "")}"><input name="trackingNumber" maxlength="100" placeholder="Tracking number" value="${esc(o.tracking_number || "")}"><input name="trackingUrl" type="url" maxlength="500" placeholder="Courier tracking URL (e.g. https://courier-site/track)" value="${esc(o.tracking_url || "")}"><button class="outline">Save shipper & tracking</button></form>` : ""}${o.returnRequest ? `<div class="seller-refund-panel" style="margin-top:10px;border:1px solid #dbe5f5;border-radius:12px;padding:12px;background:#f8fbff"><strong>↩ Return & refund process</strong><p><b>Current status:</b> <span class="pill">${esc(o.returnRequest.status)}</span></p><small><b>Customer reason:</b> ${esc(o.returnRequest.reason)}</small><small><b>Refund amount:</b> ₹${Number(o.returnRequest.refund_amount || 0).toLocaleString("en-IN")}</small><div class="seller-refund-steps" style="display:flex;gap:6px;flex-wrap:wrap;margin:8px 0">${["Requested","Approved","Refunded"].map(st => `<span style="padding:4px 8px;border-radius:20px;background:${(o.returnHistory||[]).some(h=>h.status===st) || o.returnRequest.status===st ? '#dff7e8' : '#eef2f7'};font-size:12px">${(o.returnHistory||[]).some(h=>h.status===st) || o.returnRequest.status===st ? '✓ ' : ''}${st}</span>`).join("")}${o.returnRequest.status === "Rejected" ? '<span style="padding:4px 8px;border-radius:20px;background:#fee2e2;font-size:12px">Rejected</span>' : ""}</div><strong>Update history</strong>${(o.returnHistory || []).length ? (o.returnHistory || []).map(h => `<small>${esc(h.status)} · ${esc(h.created_at)} — ${esc(h.note || "")}</small>`).join("") : `<small>Request created · ${esc(o.returnRequest.created_at || "")}</small>`}${o.returnRequest.status === "Requested" ? `<button class="outline" data-return-status="Approved" data-return-id="${o.returnRequest.id}">Approve return</button><button class="outline" data-return-status="Rejected" data-return-id="${o.returnRequest.id}">Reject return</button>` : ""}${o.returnRequest.status === "Approved" ? `<button class="outline" data-return-status="Refunded" data-return-id="${o.returnRequest.id}">Mark refund processed</button>` : ""}</div>` : ""}${(o.feedback||[]).length ? `<div style="margin-top:10px;border-top:1px solid #ddd;padding-top:10px"><strong>⭐ Customer product ratings</strong>${(o.feedback||[]).map(f=>`<small>${'★'.repeat(Number(f.rating)||0)}${'☆'.repeat(5-(Number(f.rating)||0))} · ${Number(f.rating)||0}/5${f.comment ? ' — '+esc(f.comment) : ''}</small>`).join('')}</div>` : ""}</div></article>`,
            )
            .join("")
        : '<p class="muted">No database orders for your products yet.</p>';
    } catch (e) {
      box.innerHTML = `<p class="notice">${esc(e.message)}</p>`;
    }
  }
  async function loadSellerMessages() {
    const box = $("#sellerMessages");
    if (!box) return;
    try {
      const d = await api("api-messages.php?seller=1");
      const messages = d.messages || [];
      box.innerHTML = messages.length
        ? `<div class="seller-chat-list">${messages
            .map((m) => {
              const buyer =
                m.sender_role === "buyer" ? m.sender_email : m.recipient_email;
              const mine = m.sender_role !== "buyer";
              const date = new Date(m.created_at);
              const stamp = Number.isNaN(date.getTime())
                ? esc(m.created_at)
                : date.toLocaleString("en-IN", {
                    day: "2-digit",
                    month: "short",
                    hour: "2-digit",
                    minute: "2-digit",
                  });
              const isRefund = /refund|return request/i.test(String(m.body || ""));
              return `<article class="seller-chat-card ${isRefund ? "seller-refund-message" : ""}"><div class="seller-chat-head"><span class="seller-chat-avatar">${esc((buyer.split("@")[0] || "B").slice(0, 1).toUpperCase())}</span><div class="seller-chat-person"><strong>${esc(buyer)}</strong><small>${isRefund ? "↩ REFUND / RETURN REQUEST · " : ""}${esc(m.product_code || (m.order_id ? "Order " + m.order_id : "General enquiry"))} · ${stamp}</small></div><span class="seller-chat-role ${mine ? "seller" : "buyer"}">${isRefund ? "Refund alert" : mine ? "Your reply" : "Buyer message"}</span></div><div class="seller-chat-bubble ${mine ? "outgoing" : "incoming"}">${esc(m.body)}</div><form class="seller-reply-form" data-reply-form="${m.id}" data-to="${esc(buyer)}" data-thread="${esc(m.thread_key || "thread-" + m.id)}" data-product="${esc(m.product_code || "")}" data-order="${esc(m.order_id || "")}"><label for="seller-reply-${m.id}">Reply to buyer</label><div class="seller-reply-compose"><textarea id="seller-reply-${m.id}" name="body" maxlength="5000" rows="2" required placeholder="Type a helpful reply…"></textarea><button class="seller-send-btn" aria-label="Send reply" title="Send reply">Send <span aria-hidden="true">➤</span></button></div><small class="seller-reply-hint">Your reply will be saved to the message database.</small></form></article>`;
            })
            .join("")}</div>`
        : '<div class="seller-empty-chat"><span>✉</span><strong>No buyer messages yet</strong><p>When a buyer contacts you about a product or order, the conversation will appear here.</p></div>';
    } catch (e) {
      box.innerHTML = `<div class="seller-empty-chat error"><strong>Could not load messages</strong><p>${esc(e.message)}</p><button class="outline" type="button" id="retrySellerMessages">Try again</button></div>`;
      $("#retrySellerMessages")?.addEventListener("click", loadSellerMessages);
    }
  }
  $("#refreshHistory")?.addEventListener("click", loadProductHistory);
  $("#refreshOrders")?.addEventListener("click", loadSellerOrders);
  $("#refreshOrdersTop")?.addEventListener("click", loadSellerOrders);
  $("#refreshMessages")?.addEventListener("click", loadSellerMessages);
  $("#sellerOrders")?.addEventListener("click", async (e) => {
    const rb = e.target.closest("[data-return-status]");
    if (!rb) return;
    rb.disabled = true;
    try {
      const d = await api("api-order-features.php", { method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf }, body: JSON.stringify({ action: "return_status", returnId: Number(rb.dataset.returnId), status: rb.dataset.returnStatus }) });
      notice("#globalNotice", d.message || "Return status updated."); await loadSellerOrders();
    } catch (err) { notice("#globalNotice", err.message); rb.disabled = false; }
  });
  $("#sellerOrders")?.addEventListener("click", async (e) => {
    const b = e.target.closest("[data-save-order]");
    if (!b) return;
    const id = b.dataset.saveOrder,
      sel = $(`[data-order-status="${id}"]`);
    b.disabled = true;
    try {
      await api("api-orders.php", {
        method: "PATCH",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({ orderId: Number(id), status: sel.value }),
      });
      notice("#globalNotice", "Order status updated.");
      await loadSellerOrders();
    } catch (err) {
      notice("#globalNotice", err.message);
    } finally {
      b.disabled = false;
    }
  });
  $("#sellerOrders")?.addEventListener("submit", async (e) => {
    const form = e.target.closest("[data-shipper-form]");
    if (!form) return;
    e.preventDefault();
    const b = form.querySelector("button"), fd = new FormData(form);
    b.disabled = true;
    try {
      const d = await api("api-order-features.php", { method: "POST", headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf }, body: JSON.stringify({ action: "shipper_update", orderId: Number(form.dataset.shipperForm), shipperName: fd.get("shipperName"), trackingNumber: fd.get("trackingNumber"), trackingUrl: fd.get("trackingUrl") }) });
      notice("#globalNotice", d.message || "Tracking saved."); await loadSellerOrders();
    } catch (err) { notice("#globalNotice", err.message); }
    finally { b.disabled = false; }
  });
  $("#sellerOrders")?.addEventListener("submit", async (e) => {
    const form = e.target.closest("[data-otp-form]");
    if (!form) return;
    e.preventDefault();
    const b = form.querySelector("button");
    b.disabled = true;
    try {
      const d = await api("api-orders.php", {
        method: "PATCH",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({
          action: "verify_delivery_otp",
          orderId: Number(form.dataset.otpForm),
          otp: form.elements.otp.value.trim(),
        }),
      });
      notice("#globalNotice", d.message || "Delivery confirmed.");
      await loadSellerOrders();
    } catch (err) {
      notice("#globalNotice", err.message);
    } finally {
      b.disabled = false;
    }
  });
  $("#sellerMessages")?.addEventListener("submit", async (e) => {
    const form = e.target.closest("[data-reply-form]");
    if (!form) return;
    e.preventDefault();
    const b = form.querySelector("button"),
      field = form.elements.body,
      original = b.innerHTML;
    b.disabled = true;
    b.innerHTML = "Sending…";
    form.classList.remove("reply-error", "reply-success");
    try {
      await api("api-messages.php", {
        method: "POST",
        headers: { "Content-Type": "application/json", "X-CSRF-Token": csrf },
        body: JSON.stringify({
          to: form.dataset.to,
          body: field.value.trim(),
          threadKey: form.dataset.thread,
          productCode: form.dataset.product || "",
          orderId: form.dataset.order || null,
        }),
      });
      field.value = "";
      form.classList.add("reply-success");
      notice("#globalNotice", "✓ Reply sent and saved.");
      await loadSellerMessages();
    } catch (err) {
      form.classList.add("reply-error");
      let status = form.querySelector(".seller-reply-hint");
      if (status) status.textContent = "Not sent: " + err.message;
      notice("#globalNotice", "Reply was not sent. Please try again.");
    } finally {
      if (b.isConnected) {
        b.disabled = false;
        b.innerHTML = original;
      }
    }
  });
  async function boot() {
    try {
      const d = await api("seller-auth.php?action=me");
      if (d.seller) {
        csrf = d.csrf;
        showDashboard(d.seller);
      } else setMode("login");
    } catch (e) {
      notice("#authNotice", e.message);
    }
  }
  boot();
  if (window.ebSellerMessagePoll) clearInterval(window.ebSellerMessagePoll);
  window.ebSellerMessagePoll = setInterval(() => {
    if (!$("#dashboard").hidden) loadSellerMessages();
  }, 12000);
})();

</script>
<script>
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
