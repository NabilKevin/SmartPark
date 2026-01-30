<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.6.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.6.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Register user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                                <a href="#authentication-POSTapi-login">Login user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-me">
                                <a href="#authentication-GETapi-me">Get current user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Logout user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-PUTapi-update-profile">
                                <a href="#authentication-PUTapi-update-profile">Update profile</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-dashboard" class="tocify-header">
                <li class="tocify-item level-1" data-unique="dashboard">
                    <a href="#dashboard">Dashboard</a>
                </li>
                                    <ul id="tocify-subheader-dashboard" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="dashboard-GETapi-dashboard-summary">
                                <a href="#dashboard-GETapi-dashboard-summary">Dashboard Summary</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-parking-book" class="tocify-header">
                <li class="tocify-item level-1" data-unique="parking-book">
                    <a href="#parking-book">Parking Book</a>
                </li>
                                    <ul id="tocify-subheader-parking-book" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="parking-book-GETapi-parking-histories">
                                <a href="#parking-book-GETapi-parking-histories">Get parking history</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-book-POSTapi-book">
                                <a href="#parking-book-POSTapi-book">Create parking book</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-book-POSTapi-checkout--id-">
                                <a href="#parking-book-POSTapi-checkout--id-">Checkout parking</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-book-POSTapi-dashboard-parking-books">
                                <a href="#parking-book-POSTapi-dashboard-parking-books">Create parking booking</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-book-POSTapi-dashboard-parking-books-relocate">
                                <a href="#parking-book-POSTapi-dashboard-parking-books-relocate">Relocate parking booking</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-book-POSTapi-dashboard-parking-books-cancel">
                                <a href="#parking-book-POSTapi-dashboard-parking-books-cancel">Cancel parking booking</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-parking-lot" class="tocify-header">
                <li class="tocify-item level-1" data-unique="parking-lot">
                    <a href="#parking-lot">Parking Lot</a>
                </li>
                                    <ul id="tocify-subheader-parking-lot" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="parking-lot-POSTapi-dashboard-parking-lots">
                                <a href="#parking-lot-POSTapi-dashboard-parking-lots">Create Parking Lot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-lot-PUTapi-dashboard-parking-lots--id-">
                                <a href="#parking-lot-PUTapi-dashboard-parking-lots--id-">Update Parking Lot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-lot-GETapi-dashboard-parking-lots-all">
                                <a href="#parking-lot-GETapi-dashboard-parking-lots-all">Get Parking Lots</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-lot-GETapi-dashboard-parking-lots">
                                <a href="#parking-lot-GETapi-dashboard-parking-lots">Get Parking Lots Only</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-lot-POSTapi-dashboard-parking-lots-deactivate--id-">
                                <a href="#parking-lot-POSTapi-dashboard-parking-lots-deactivate--id-">Delete Parking Lot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-lot-POSTapi-dashboard-parking-lots-activate--id-">
                                <a href="#parking-lot-POSTapi-dashboard-parking-lots-activate--id-">Activate Parking Lot</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-parking-lot-user" class="tocify-header">
                <li class="tocify-item level-1" data-unique="parking-lot-user">
                    <a href="#parking-lot-user">Parking Lot (User)</a>
                </li>
                                    <ul id="tocify-subheader-parking-lot-user" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="parking-lot-user-GETapi-parking-lots">
                                <a href="#parking-lot-user-GETapi-parking-lots">Get parking lots</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-parking-spot" class="tocify-header">
                <li class="tocify-item level-1" data-unique="parking-spot">
                    <a href="#parking-spot">Parking Spot</a>
                </li>
                                    <ul id="tocify-subheader-parking-spot" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="parking-spot-POSTapi-dashboard-parking-spots">
                                <a href="#parking-spot-POSTapi-dashboard-parking-spots">Create a new parking spot.</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-spot-PUTapi-dashboard-parking-spots--id-">
                                <a href="#parking-spot-PUTapi-dashboard-parking-spots--id-">Update Parking Spot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-spot-GETapi-dashboard-parking-spots">
                                <a href="#parking-spot-GETapi-dashboard-parking-spots">Get Parking Spots</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-spot-POSTapi-dashboard-parking-spots-activate--id-">
                                <a href="#parking-spot-POSTapi-dashboard-parking-spots-activate--id-">Activate Parking Spot</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="parking-spot-POSTapi-dashboard-parking-spots-deactivate--id-">
                                <a href="#parking-spot-POSTapi-dashboard-parking-spots-deactivate--id-">Deactivate Parking Spot</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-parking-spot-user" class="tocify-header">
                <li class="tocify-item level-1" data-unique="parking-spot-user">
                    <a href="#parking-spot-user">Parking Spot (User)</a>
                </li>
                                    <ul id="tocify-subheader-parking-spot-user" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="parking-spot-user-GETapi-parking-spots--id-">
                                <a href="#parking-spot-user-GETapi-parking-spots--id-">Get parking spots by parking lot</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-user-management" class="tocify-header">
                <li class="tocify-item level-1" data-unique="user-management">
                    <a href="#user-management">User Management</a>
                </li>
                                    <ul id="tocify-subheader-user-management" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="user-management-POSTapi-dashboard-users">
                                <a href="#user-management-POSTapi-dashboard-users">Create User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-management-PUTapi-dashboard-users--id-">
                                <a href="#user-management-PUTapi-dashboard-users--id-">Update User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-management-DELETEapi-dashboard-users--id-">
                                <a href="#user-management-DELETEapi-dashboard-users--id-">Delete User</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="user-management-GETapi-dashboard-users">
                                <a href="#user-management-GETapi-dashboard-users">Get Users</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: January 30, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authentication">Authentication</h1>

    

                                <h2 id="authentication-POSTapi-register">Register user</h2>

<p>
</p>



<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"qkunze@example.com\",
    \"username\": \"consequatur\",
    \"password\": \"O[2UZ5ij-e\\/dl4m{o,\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "qkunze@example.com",
    "username": "consequatur",
    "password": "O[2UZ5ij-e\/dl4m{o,"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;username&quot;: &quot;admin&quot;,
    &quot;email&quot;: &quot;admin@mail.com&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-register"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="O[2UZ5ij-e/dl4m{o,"
               data-component="body">
    <br>
<p>min:8 confirmed Example: <code>O[2UZ5ij-e/dl4m{o,</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-login">Login user</h2>

<p>
</p>



<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"admin\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "admin",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;token&quot;: &quot;1|xxxxxxxxxxxxxxxx&quot;,
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;username&quot;: &quot;admin&quot;,
        &quot;email&quot;: &quot;admin@mail.com&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid username or password&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-login"
               value="admin"
               data-component="body">
    <br>
<p>Username user. Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="password123"
               data-component="body">
    <br>
<p>Password user. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-GETapi-me">Get current user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/me" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/me"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-me">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;username&quot;: &quot;admin&quot;,
    &quot;email&quot;: &quot;admin@mail.com&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-me" data-method="GET"
      data-path="api/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-me"
                    onclick="tryItOut('GETapi-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-me"
                    onclick="cancelTryOut('GETapi-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-logout">Logout user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">true</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-PUTapi-update-profile">Update profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-update-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/update-profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"consequatur\",
    \"email\": \"qkunze@example.com\",
    \"role\": \"admin\",
    \"password\": \"O[2UZ5ij-e\\/dl4m{o,\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/update-profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "consequatur",
    "email": "qkunze@example.com",
    "role": "admin",
    "password": "O[2UZ5ij-e\/dl4m{o,"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-update-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;username&quot;: &quot;new_username&quot;,
    &quot;email&quot;: &quot;new@mail.com&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-update-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-update-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-update-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-update-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-update-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-update-profile" data-method="PUT"
      data-path="api/update-profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-update-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-update-profile"
                    onclick="tryItOut('PUTapi-update-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-update-profile"
                    onclick="cancelTryOut('PUTapi-update-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-update-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/update-profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-update-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-update-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="PUTapi-update-profile"
               value="consequatur"
               data-component="body">
    <br>
<p>Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-update-profile"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="PUTapi-update-profile"
               value="admin"
               data-component="body">
    <br>
<p>Example: <code>admin</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>admin</code></li> <li><code>user</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-update-profile"
               value="O[2UZ5ij-e/dl4m{o,"
               data-component="body">
    <br>
<p>confirmed min:8 Example: <code>O[2UZ5ij-e/dl4m{o,</code></p>
        </div>
        </form>

                <h1 id="dashboard">Dashboard</h1>

    

                                <h2 id="dashboard-GETapi-dashboard-summary">Dashboard Summary</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil ringkasan data dashboard seperti:</p>
<ul>
<li>Total user</li>
<li>Jumlah booking aktif</li>
<li>Statistik parking lot &amp; parking spot</li>
<li>Persentase okupansi, tersedia, dan rusak</li>
</ul>

<span id="example-requests-GETapi-dashboard-summary">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/summary" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/summary"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-summary">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;Dashboard summary retrieved successfully&quot;,
    &quot;data&quot;: {
        &quot;totalUsers&quot;: 120,
        &quot;activeBookings&quot;: 15,
        &quot;totalParkingLots&quot;: 3,
        &quot;occupancyRate&quot;: 45.5,
        &quot;availableRate&quot;: 48,
        &quot;brokenRate&quot;: 6.5,
        &quot;lotOccupancy&quot;: [
            {
                &quot;name&quot;: &quot;Basement A&quot;,
                &quot;available&quot;: 20,
                &quot;occupied&quot;: 25,
                &quot;broken&quot;: 5
            },
            {
                &quot;name&quot;: &quot;Outdoor Area&quot;,
                &quot;available&quot;: 10,
                &quot;occupied&quot;: 8,
                &quot;broken&quot;: 2
            }
        ]
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-summary" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-summary"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-summary"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-summary" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-summary">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-summary" data-method="GET"
      data-path="api/dashboard/summary"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-summary', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-summary"
                    onclick="tryItOut('GETapi-dashboard-summary');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-summary"
                    onclick="cancelTryOut('GETapi-dashboard-summary');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-summary"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/summary</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-summary"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="parking-book">Parking Book</h1>

    

                                <h2 id="parking-book-GETapi-parking-histories">Get parking history</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil riwayat parkir user (booking &amp; walk-in).
Mendukung pagination atau limit data terakhir.</p>

<span id="example-requests-GETapi-parking-histories">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/parking-histories?perPage=17&amp;limit=17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/parking-histories"
);

const params = {
    "perPage": "17",
    "limit": "17",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-parking-histories">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 12,
            &quot;status&quot;: &quot;completed&quot;,
            &quot;type&quot;: &quot;walk_in&quot;,
            &quot;booked_at&quot;: &quot;2026-02-01 09:00:00&quot;,
            &quot;checkin_at&quot;: &quot;2026-02-01 09:05:00&quot;,
            &quot;checked_at&quot;: &quot;2026-02-01 11:00:00&quot;,
            &quot;parking_spot&quot;: {
                &quot;spot_number&quot;: &quot;A001&quot;,
                &quot;parking_lot&quot;: {
                    &quot;name&quot;: &quot;Basement A&quot;
                }
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 3,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 25
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-parking-histories" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-parking-histories"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-parking-histories"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-parking-histories" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-parking-histories">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-parking-histories" data-method="GET"
      data-path="api/parking-histories"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-parking-histories', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-parking-histories"
                    onclick="tryItOut('GETapi-parking-histories');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-parking-histories"
                    onclick="cancelTryOut('GETapi-parking-histories');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-parking-histories"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/parking-histories</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-parking-histories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-parking-histories"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-parking-histories"
               value="17"
               data-component="query">
    <br>
<p>Jumlah data per halaman. Default: 10 Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="GETapi-parking-histories"
               value="17"
               data-component="query">
    <br>
<p>Ambil data terakhir tanpa pagination. Contoh: 3 Example: <code>17</code></p>
            </div>
                </form>

                    <h2 id="parking-book-POSTapi-book">Create parking book</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Membuat booking parkir atau walk-in.
User hanya boleh parkir atau booking 1x dalam 1 hari.</p>

<span id="example-requests-POSTapi-book">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/book" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"parking_spot_id\": 5,
    \"type\": \"walk_in\",
    \"start_at\": \"2026-02-01 10:00:00\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/book"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parking_spot_id": 5,
    "type": "walk_in",
    "start_at": "2026-02-01 10:00:00"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-book">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking booked successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 15,
        &quot;user_id&quot;: 3,
        &quot;parking_spot_id&quot;: 5,
        &quot;type&quot;: &quot;walk_in&quot;,
        &quot;status&quot;: &quot;active&quot;,
        &quot;booked_at&quot;: &quot;2026-02-01 09:10:00&quot;,
        &quot;checkin_at&quot;: &quot;2026-02-01 09:10:00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking spot is not available&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;You already booked or park today!&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-book" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-book"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-book"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-book" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-book">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-book" data-method="POST"
      data-path="api/book"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-book', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-book"
                    onclick="tryItOut('POSTapi-book');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-book"
                    onclick="cancelTryOut('POSTapi-book');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-book"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/book</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-book"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-book"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parking_spot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parking_spot_id"                data-endpoint="POSTapi-book"
               value="5"
               data-component="body">
    <br>
<p>ID parking spot. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="type"                data-endpoint="POSTapi-book"
               value="walk_in"
               data-component="body">
    <br>
<p>Jenis booking. Example: <code>walk_in</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>walk_in</code></li> <li><code>booking</code></li></ul>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_at</code></b>&nbsp;&nbsp;
<small>datetime</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_at"                data-endpoint="POSTapi-book"
               value="2026-02-01 10:00:00"
               data-component="body">
    <br>
<p>required_if:type,booking Format: Y-m-d H:i:s. Example: <code>2026-02-01 10:00:00</code></p>
        </div>
        </form>

                    <h2 id="parking-book-POSTapi-checkout--id-">Checkout parking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Digunakan saat user keluar dari area parkir.
Hanya bisa dilakukan jika status masih active.</p>

<span id="example-requests-POSTapi-checkout--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/checkout/12" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/checkout/12"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-checkout--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Checkout successful&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 12,
        &quot;status&quot;: &quot;completed&quot;,
        &quot;checked_at&quot;: &quot;2026-02-01 12:15:00&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;You already checked out or book cancelled&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-checkout--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-checkout--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-checkout--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-checkout--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-checkout--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-checkout--id-" data-method="POST"
      data-path="api/checkout/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-checkout--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-checkout--id-"
                    onclick="tryItOut('POSTapi-checkout--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-checkout--id-"
                    onclick="cancelTryOut('POSTapi-checkout--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-checkout--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/checkout/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-checkout--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-checkout--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-checkout--id-"
               value="12"
               data-component="url">
    <br>
<p>ID parking book. Example: <code>12</code></p>
            </div>
                    </form>

                    <h2 id="parking-book-POSTapi-dashboard-parking-books">Create parking booking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-dashboard-parking-books">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-books" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"parking_spot_id\": 3,
    \"user_id\": 3,
    \"start_at\": \"2026-01-30 10:00:00\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-books"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parking_spot_id": 3,
    "user_id": 3,
    "start_at": "2026-01-30 10:00:00"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-books">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
 &quot;id&quot;: 10,
 &quot;status&quot;: &quot;booked&quot;,
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking spot is not available&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-books" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-books"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-books"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-books" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-books">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-books" data-method="POST"
      data-path="api/dashboard/parking-books"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-books', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-books"
                    onclick="tryItOut('POSTapi-dashboard-parking-books');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-books"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-books');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-books"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-books</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parking_spot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parking_spot_id"                data-endpoint="POSTapi-dashboard-parking-books"
               value="3"
               data-component="body">
    <br>
<p>Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-dashboard-parking-books"
               value="3"
               data-component="body">
    <br>
<p>Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="start_at"                data-endpoint="POSTapi-dashboard-parking-books"
               value="2026-01-30 10:00:00"
               data-component="body">
    <br>
<p>Example: <code>2026-01-30 10:00:00</code></p>
        </div>
        </form>

                    <h2 id="parking-book-POSTapi-dashboard-parking-books-relocate">Relocate parking booking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-dashboard-parking-books-relocate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-books/relocate" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"relocate_reason\": \"Spot maintenance\",
    \"parking_book_id\": 5,
    \"to_parking_spot_id\": 8
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-books/relocate"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "relocate_reason": "Spot maintenance",
    "parking_book_id": 5,
    "to_parking_spot_id": 8
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-books-relocate">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 2,
    &quot;status&quot;: &quot;active&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-books-relocate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-books-relocate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-books-relocate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-books-relocate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-books-relocate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-books-relocate" data-method="POST"
      data-path="api/dashboard/parking-books/relocate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-books-relocate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-books-relocate"
                    onclick="tryItOut('POSTapi-dashboard-parking-books-relocate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-books-relocate"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-books-relocate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-books-relocate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-books/relocate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-books-relocate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-books-relocate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>relocate_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="relocate_reason"                data-endpoint="POSTapi-dashboard-parking-books-relocate"
               value="Spot maintenance"
               data-component="body">
    <br>
<p>Example: <code>Spot maintenance</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parking_book_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parking_book_id"                data-endpoint="POSTapi-dashboard-parking-books-relocate"
               value="5"
               data-component="body">
    <br>
<p>Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>to_parking_spot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="to_parking_spot_id"                data-endpoint="POSTapi-dashboard-parking-books-relocate"
               value="8"
               data-component="body">
    <br>
<p>Example: <code>8</code></p>
        </div>
        </form>

                    <h2 id="parking-book-POSTapi-dashboard-parking-books-cancel">Cancel parking booking</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-dashboard-parking-books-cancel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-books/cancel" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"reason\": \"Change of plan\",
    \"parking_book_id\": 5
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-books/cancel"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "reason": "Change of plan",
    "parking_book_id": 5
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-books-cancel">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;cancellation_type&quot;: &quot;user_cancelled&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-books-cancel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-books-cancel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-books-cancel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-books-cancel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-books-cancel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-books-cancel" data-method="POST"
      data-path="api/dashboard/parking-books/cancel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-books-cancel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-books-cancel"
                    onclick="tryItOut('POSTapi-dashboard-parking-books-cancel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-books-cancel"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-books-cancel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-books-cancel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-books/cancel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-books-cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-books-cancel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="reason"                data-endpoint="POSTapi-dashboard-parking-books-cancel"
               value="Change of plan"
               data-component="body">
    <br>
<p>Example: <code>Change of plan</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parking_book_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parking_book_id"                data-endpoint="POSTapi-dashboard-parking-books-cancel"
               value="5"
               data-component="body">
    <br>
<p>Example: <code>5</code></p>
        </div>
        </form>

                <h1 id="parking-lot">Parking Lot</h1>

    

                                <h2 id="parking-lot-POSTapi-dashboard-parking-lots">Create Parking Lot</h2>

<p>
</p>

<p>Membuat parking lot baru beserta parking spots otomatis.</p>

<span id="example-requests-POSTapi-dashboard-parking-lots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-lots" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"consequatur\",
    \"capacity\": 17,
    \"prefix\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "consequatur",
    "capacity": 17,
    "prefix": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-lots">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;Basement A&quot;,
    &quot;capacity&quot;: 50,
    &quot;available_spots&quot;: 50,
    &quot;prefix&quot;: &quot;A&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Validation error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-lots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-lots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-lots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-lots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-lots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-lots" data-method="POST"
      data-path="api/dashboard/parking-lots"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-lots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-lots"
                    onclick="tryItOut('POSTapi-dashboard-parking-lots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-lots"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-lots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-lots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-lots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-dashboard-parking-lots"
               value="consequatur"
               data-component="body">
    <br>
<p>Nama parking lot. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity"                data-endpoint="POSTapi-dashboard-parking-lots"
               value="17"
               data-component="body">
    <br>
<p>Kapasitas parking lot. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prefix</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prefix"                data-endpoint="POSTapi-dashboard-parking-lots"
               value="consequatur"
               data-component="body">
    <br>
<p>Prefix kode spot. Contoh: A, B1 Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="parking-lot-PUTapi-dashboard-parking-lots--id-">Update Parking Lot</h2>

<p>
</p>

<p>Mengubah data parking lot (capacity dan/atau prefix).</p>

<span id="example-requests-PUTapi-dashboard-parking-lots--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/dashboard/parking-lots/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"consequatur\",
    \"capacity\": 17,
    \"prefix\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "consequatur",
    "capacity": 17,
    "prefix": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-dashboard-parking-lots--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;name&quot;: &quot;Basement A&quot;,
    &quot;capacity&quot;: 60,
    &quot;available_spots&quot;: 30
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cannot reduce capacity below number of occupied spots&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-dashboard-parking-lots--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-dashboard-parking-lots--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-dashboard-parking-lots--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-dashboard-parking-lots--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-dashboard-parking-lots--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-dashboard-parking-lots--id-" data-method="PUT"
      data-path="api/dashboard/parking-lots/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-dashboard-parking-lots--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-dashboard-parking-lots--id-"
                    onclick="tryItOut('PUTapi-dashboard-parking-lots--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-dashboard-parking-lots--id-"
                    onclick="cancelTryOut('PUTapi-dashboard-parking-lots--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-dashboard-parking-lots--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/dashboard/parking-lots/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking lot. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Nama baru parking lot. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="17"
               data-component="body">
    <br>
<p>Kapasitas baru parking lot. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>prefix</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="prefix"                data-endpoint="PUTapi-dashboard-parking-lots--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Prefix baru parking spot. Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="parking-lot-GETapi-dashboard-parking-lots-all">Get Parking Lots</h2>

<p>
</p>

<p>Mengambil daftar parking lot dengan pagination, filter, dan statistik.</p>

<span id="example-requests-GETapi-dashboard-parking-lots-all">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/parking-lots/all?perPage=17&amp;search=consequatur&amp;status=consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots/all"
);

const params = {
    "perPage": "17",
    "search": "consequatur",
    "status": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-parking-lots-all">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;totalActiveLots&quot;: 3,
    &quot;totalActiveCapacity&quot;: 120,
    &quot;totalAvailableSpots&quot;: 45,
    &quot;occupancyRate&quot;: 62.5,
    &quot;activeLotWithAvailableSpace&quot;: 2,
    &quot;activeLotWithFullyOccupied&quot;: 1,
    &quot;parkingLots&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Basement A&quot;,
                &quot;capacity&quot;: 50,
                &quot;available_spots&quot;: 20,
                &quot;occupancy&quot;: 60
            }
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-parking-lots-all" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-parking-lots-all"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-parking-lots-all"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-parking-lots-all" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-parking-lots-all">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-parking-lots-all" data-method="GET"
      data-path="api/dashboard/parking-lots/all"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-parking-lots-all', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-parking-lots-all"
                    onclick="tryItOut('GETapi-dashboard-parking-lots-all');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-parking-lots-all"
                    onclick="cancelTryOut('GETapi-dashboard-parking-lots-all');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-parking-lots-all"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/parking-lots/all</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-parking-lots-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-parking-lots-all"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-dashboard-parking-lots-all"
               value="17"
               data-component="query">
    <br>
<p>Jumlah data per halaman. Default: 10 Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-dashboard-parking-lots-all"
               value="consequatur"
               data-component="query">
    <br>
<p>Pencarian berdasarkan nama parking lot. Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-dashboard-parking-lots-all"
               value="consequatur"
               data-component="query">
    <br>
<p>Filter status parking lot. Contoh: active, inactive Example: <code>consequatur</code></p>
            </div>
                </form>

                    <h2 id="parking-lot-GETapi-dashboard-parking-lots">Get Parking Lots Only</h2>

<p>
</p>

<p>Mengambil daftar parking lot (tanpa statistik).</p>

<span id="example-requests-GETapi-dashboard-parking-lots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/parking-lots" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-parking-lots">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Basement A&quot;,
            &quot;capacity&quot;: 50,
            &quot;available_spots&quot;: 20,
            &quot;occupancy&quot;: 60
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-parking-lots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-parking-lots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-parking-lots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-parking-lots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-parking-lots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-parking-lots" data-method="GET"
      data-path="api/dashboard/parking-lots"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-parking-lots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-parking-lots"
                    onclick="tryItOut('GETapi-dashboard-parking-lots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-parking-lots"
                    onclick="cancelTryOut('GETapi-dashboard-parking-lots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-parking-lots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/parking-lots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="parking-lot-POSTapi-dashboard-parking-lots-deactivate--id-">Delete Parking Lot</h2>

<p>
</p>

<p>Menonaktifkan parking lot (soft delete).</p>

<span id="example-requests-POSTapi-dashboard-parking-lots-deactivate--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-lots/deactivate/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"deactivated_reason\": \"vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots/deactivate/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "deactivated_reason": "vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-lots-deactivate--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking lot deactivated successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cannot delete parking lot with occupied or reserved spots&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-lots-deactivate--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-lots-deactivate--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-lots-deactivate--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-lots-deactivate--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-lots-deactivate--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-lots-deactivate--id-" data-method="POST"
      data-path="api/dashboard/parking-lots/deactivate/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-lots-deactivate--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-lots-deactivate--id-"
                    onclick="tryItOut('POSTapi-dashboard-parking-lots-deactivate--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-lots-deactivate--id-"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-lots-deactivate--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-lots-deactivate--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-lots/deactivate/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-lots-deactivate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-lots-deactivate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-dashboard-parking-lots-deactivate--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking lot. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deactivated_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deactivated_reason"                data-endpoint="POSTapi-dashboard-parking-lots-deactivate--id-"
               value="vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Example: <code>vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury</code></p>
        </div>
        </form>

                    <h2 id="parking-lot-POSTapi-dashboard-parking-lots-activate--id-">Activate Parking Lot</h2>

<p>
</p>

<p>Mengaktifkan kembali parking lot yang nonaktif.</p>

<span id="example-requests-POSTapi-dashboard-parking-lots-activate--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-lots/activate/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-lots/activate/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-lots-activate--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking lot activated successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking lot is already active&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-lots-activate--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-lots-activate--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-lots-activate--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-lots-activate--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-lots-activate--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-lots-activate--id-" data-method="POST"
      data-path="api/dashboard/parking-lots/activate/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-lots-activate--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-lots-activate--id-"
                    onclick="tryItOut('POSTapi-dashboard-parking-lots-activate--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-lots-activate--id-"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-lots-activate--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-lots-activate--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-lots/activate/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-lots-activate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-lots-activate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-dashboard-parking-lots-activate--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking lot. Example: <code>17</code></p>
            </div>
                    </form>

                <h1 id="parking-lot-user">Parking Lot (User)</h1>

    

                                <h2 id="parking-lot-user-GETapi-parking-lots">Get parking lots</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil daftar parking lot untuk user.
Mendukung pencarian, filter status, pagination, dan limit.</p>

<span id="example-requests-GETapi-parking-lots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/parking-lots?search=Basement&amp;status=open&amp;perPage=10&amp;limit=3" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/parking-lots"
);

const params = {
    "search": "Basement",
    "status": "open",
    "perPage": "10",
    "limit": "3",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-parking-lots">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Basement A&quot;,
            &quot;capacity&quot;: 50,
            &quot;available_spots&quot;: 10,
            &quot;status&quot;: &quot;active&quot;,
            &quot;created_at&quot;: &quot;2026-02-01 08:00:00&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;last_page&quot;: 5,
        &quot;per_page&quot;: 10,
        &quot;total&quot;: 50
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Basement A&quot;,
        &quot;capacity&quot;: 50,
        &quot;available_spots&quot;: 10,
        &quot;status&quot;: &quot;active&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-parking-lots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-parking-lots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-parking-lots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-parking-lots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-parking-lots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-parking-lots" data-method="GET"
      data-path="api/parking-lots"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-parking-lots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-parking-lots"
                    onclick="tryItOut('GETapi-parking-lots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-parking-lots"
                    onclick="cancelTryOut('GETapi-parking-lots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-parking-lots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/parking-lots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-parking-lots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-parking-lots"
               value="Basement"
               data-component="query">
    <br>
<p>Filter berdasarkan nama parking lot. Example: <code>Basement</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-parking-lots"
               value="open"
               data-component="query">
    <br>
<p>Filter status parking lot. Example: <code>open</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>full</code></li> <li><code>open</code></li></ul>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-parking-lots"
               value="10"
               data-component="query">
    <br>
<p>Jumlah data per halaman (pagination). Default: 10. Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="limit"                data-endpoint="GETapi-parking-lots"
               value="3"
               data-component="query">
    <br>
<p>Ambil data tanpa pagination (misalnya untuk homepage). Example: <code>3</code></p>
            </div>
                </form>

                <h1 id="parking-spot">Parking Spot</h1>

    

                                <h2 id="parking-spot-POSTapi-dashboard-parking-spots">Create a new parking spot.</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Endpoint ini digunakan untuk membuat parking spot dengan dua mode:</p>
<ul>
<li>walk_in</li>
<li>booking</li>
</ul>

<span id="example-requests-POSTapi-dashboard-parking-spots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-spots" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"custom_number\": [
        73
    ],
    \"start_number\": 45,
    \"amount\": 56,
    \"parking_lot_id\": 1,
    \"name\": \"A-01\",
    \"mode\": \"walk_in\",
    \"capacity\": 10,
    \"booking_limit\": 5,
    \"is_active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-spots"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "custom_number": [
        73
    ],
    "start_number": 45,
    "amount": 56,
    "parking_lot_id": 1,
    "name": "A-01",
    "mode": "walk_in",
    "capacity": 10,
    "booking_limit": 5,
    "is_active": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-spots">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: true,
    &quot;message&quot;: &quot;Parking spot berhasil dibuat&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;A-01&quot;,
        &quot;mode&quot;: &quot;walk_in&quot;,
        &quot;capacity&quot;: 10,
        &quot;booking_limit&quot;: null,
        &quot;is_active&quot;: true
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;status&quot;: false,
    &quot;message&quot;: &quot;Validation error&quot;,
    &quot;errors&quot;: {
        &quot;capacity&quot;: [
            &quot;Capacity wajib diisi untuk mode walk_in&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-spots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-spots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-spots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-spots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-spots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-spots" data-method="POST"
      data-path="api/dashboard/parking-spots"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-spots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-spots"
                    onclick="tryItOut('POSTapi-dashboard-parking-spots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-spots"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-spots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-spots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-spots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>custom_number</code></b>&nbsp;&nbsp;
<small>integer[]</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="custom_number[0]"                data-endpoint="POSTapi-dashboard-parking-spots"
               data-component="body">
        <input type="number" style="display: none"
               name="custom_number[1]"                data-endpoint="POSTapi-dashboard-parking-spots"
               data-component="body">
    <br>
<p>Must be at least 1.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>start_number</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="start_number"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="45"
               data-component="body">
    <br>
<p>This field is required when <code>custom_number</code> is not present. This field is required when <code>amount</code> is present. Must be at least 1. Example: <code>45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>amount</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="amount"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="56"
               data-component="body">
    <br>
<p>This field is required when <code>custom_number</code> is not present. This field is required when <code>start_number</code> is present. Must be at least 1. Example: <code>56</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>parking_lot_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="parking_lot_id"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="1"
               data-component="body">
    <br>
<p>ID parking lot. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="A-01"
               data-component="body">
    <br>
<p>Nama parking spot. Example: <code>A-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mode</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mode"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="walk_in"
               data-component="body">
    <br>
<p>Mode parking spot (walk_in|booking). Example: <code>walk_in</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>capacity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="capacity"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="10"
               data-component="body">
    <br>
<p>Jumlah kapasitas slot.
Wajib diisi jika mode = walk_in. Example: <code>10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>booking_limit</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="booking_limit"                data-endpoint="POSTapi-dashboard-parking-spots"
               value="5"
               data-component="body">
    <br>
<p>Batas maksimal booking per hari.
Wajib diisi jika mode = booking. Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-dashboard-parking-spots" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="POSTapi-dashboard-parking-spots"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-dashboard-parking-spots" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="POSTapi-dashboard-parking-spots"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>optional
Status parking spot (aktif / nonaktif).
Default: true Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="parking-spot-PUTapi-dashboard-parking-spots--id-">Update Parking Spot</h2>

<p>
</p>

<p>Mengubah data parking spot.</p>

<span id="example-requests-PUTapi-dashboard-parking-spots--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/dashboard/parking-spots/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"number\": 17,
    \"status\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-spots/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "number": 17,
    "status": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-dashboard-parking-spots--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;spot_number&quot;: &quot;A015&quot;,
    &quot;status&quot;: &quot;occupied&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking spot A015 already exists in this parking lot&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-dashboard-parking-spots--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-dashboard-parking-spots--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-dashboard-parking-spots--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-dashboard-parking-spots--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-dashboard-parking-spots--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-dashboard-parking-spots--id-" data-method="PUT"
      data-path="api/dashboard/parking-spots/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-dashboard-parking-spots--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-dashboard-parking-spots--id-"
                    onclick="tryItOut('PUTapi-dashboard-parking-spots--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-dashboard-parking-spots--id-"
                    onclick="cancelTryOut('PUTapi-dashboard-parking-spots--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-dashboard-parking-spots--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/dashboard/parking-spots/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-dashboard-parking-spots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-dashboard-parking-spots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-dashboard-parking-spots--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking spot. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>number</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="number"                data-endpoint="PUTapi-dashboard-parking-spots--id-"
               value="17"
               data-component="body">
    <br>
<p>Nomor baru spot (tanpa prefix). Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="PUTapi-dashboard-parking-spots--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Status baru. Contoh: available, occupied, reserved Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="parking-spot-GETapi-dashboard-parking-spots">Get Parking Spots</h2>

<p>
</p>

<p>Mengambil daftar parking spot dengan pagination, filter, dan ringkasan status.</p>

<span id="example-requests-GETapi-dashboard-parking-spots">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/parking-spots?perPage=17&amp;search=consequatur&amp;lot=17&amp;status=consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-spots"
);

const params = {
    "perPage": "17",
    "search": "consequatur",
    "lot": "17",
    "status": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-parking-spots">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;current_page&quot;: 1,
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;spot_number&quot;: &quot;A001&quot;,
                &quot;status&quot;: &quot;available&quot;,
                &quot;parking_lot&quot;: {
                    &quot;id&quot;: 1,
                    &quot;name&quot;: &quot;Basement A&quot;
                }
            }
        ]
    },
    &quot;summary&quot;: {
        &quot;available&quot;: 12,
        &quot;occupied&quot;: 8
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-parking-spots" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-parking-spots"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-parking-spots"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-parking-spots" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-parking-spots">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-parking-spots" data-method="GET"
      data-path="api/dashboard/parking-spots"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-parking-spots', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-parking-spots"
                    onclick="tryItOut('GETapi-dashboard-parking-spots');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-parking-spots"
                    onclick="cancelTryOut('GETapi-dashboard-parking-spots');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-parking-spots"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/parking-spots</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-parking-spots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-parking-spots"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-dashboard-parking-spots"
               value="17"
               data-component="query">
    <br>
<p>Jumlah data per halaman. Default: 10 Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-dashboard-parking-spots"
               value="consequatur"
               data-component="query">
    <br>
<p>Pencarian berdasarkan nomor spot. Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>lot</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="lot"                data-endpoint="GETapi-dashboard-parking-spots"
               value="17"
               data-component="query">
    <br>
<p>Filter berdasarkan parking_lot_id. Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-dashboard-parking-spots"
               value="consequatur"
               data-component="query">
    <br>
<p>Filter status spot. Contoh: available, occupied, reserved, inactive Example: <code>consequatur</code></p>
            </div>
                </form>

                    <h2 id="parking-spot-POSTapi-dashboard-parking-spots-activate--id-">Activate Parking Spot</h2>

<p>
</p>

<p>Mengaktifkan kembali parking spot yang nonaktif.</p>

<span id="example-requests-POSTapi-dashboard-parking-spots-activate--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-spots/activate/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-spots/activate/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-spots-activate--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;spot_number&quot;: &quot;A005&quot;,
    &quot;status&quot;: &quot;available&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Cannot restore parking spot because its parking lot is inactive&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-spots-activate--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-spots-activate--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-spots-activate--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-spots-activate--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-spots-activate--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-spots-activate--id-" data-method="POST"
      data-path="api/dashboard/parking-spots/activate/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-spots-activate--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-spots-activate--id-"
                    onclick="tryItOut('POSTapi-dashboard-parking-spots-activate--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-spots-activate--id-"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-spots-activate--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-spots-activate--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-spots/activate/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-spots-activate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-spots-activate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-dashboard-parking-spots-activate--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking spot. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="parking-spot-POSTapi-dashboard-parking-spots-deactivate--id-">Deactivate Parking Spot</h2>

<p>
</p>

<p>Menonaktifkan parking spot (soft delete).</p>

<span id="example-requests-POSTapi-dashboard-parking-spots-deactivate--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/parking-spots/deactivate/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"deactivated_reason\": \"vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/parking-spots/deactivate/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "deactivated_reason": "vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-parking-spots-deactivate--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Parking spot deactivated successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Only available or broken parking spots can be deactived&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-parking-spots-deactivate--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-parking-spots-deactivate--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-parking-spots-deactivate--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-parking-spots-deactivate--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-parking-spots-deactivate--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-parking-spots-deactivate--id-" data-method="POST"
      data-path="api/dashboard/parking-spots/deactivate/{id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-parking-spots-deactivate--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-parking-spots-deactivate--id-"
                    onclick="tryItOut('POSTapi-dashboard-parking-spots-deactivate--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-parking-spots-deactivate--id-"
                    onclick="cancelTryOut('POSTapi-dashboard-parking-spots-deactivate--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-parking-spots-deactivate--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/parking-spots/deactivate/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-parking-spots-deactivate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-parking-spots-deactivate--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="POSTapi-dashboard-parking-spots-deactivate--id-"
               value="17"
               data-component="url">
    <br>
<p>ID parking spot. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>deactivated_reason</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="deactivated_reason"                data-endpoint="POSTapi-dashboard-parking-spots-deactivate--id-"
               value="vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury"
               data-component="body">
    <br>
<p>Must be at least 10 characters. Example: <code>vmqeopfuudtdsufvyvddqamniihfqcoynlazghdtqtqxbajwbpilpmufinllwloauydlsmsjury</code></p>
        </div>
        </form>

                <h1 id="parking-spot-user">Parking Spot (User)</h1>

    

                                <h2 id="parking-spot-user-GETapi-parking-spots--id-">Get parking spots by parking lot</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil daftar parking spot berdasarkan parking lot tertentu,
dilengkapi dengan summary ketersediaan spot.</p>

<span id="example-requests-GETapi-parking-spots--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/parking-spots/1?search=A01&amp;status=available&amp;perPage=10" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/parking-spots/1"
);

const params = {
    "search": "A01",
    "status": "available",
    "perPage": "10",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-parking-spots--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;parkingSpots&quot;: {
        &quot;data&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;parking_lot_id&quot;: 1,
                &quot;spot_number&quot;: &quot;A001&quot;,
                &quot;status&quot;: &quot;available&quot;,
                &quot;created_at&quot;: &quot;2026-02-01 08:00:00&quot;
            }
        ],
        &quot;meta&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 3,
            &quot;per_page&quot;: 10,
            &quot;total&quot;: 25
        }
    },
    &quot;summary&quot;: {
        &quot;total&quot;: 30,
        &quot;available&quot;: 10,
        &quot;occupied&quot;: 15,
        &quot;reserved&quot;: 5
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: false,
    &quot;message&quot;: &quot;Parking lot not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-parking-spots--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-parking-spots--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-parking-spots--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-parking-spots--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-parking-spots--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-parking-spots--id-" data-method="GET"
      data-path="api/parking-spots/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-parking-spots--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-parking-spots--id-"
                    onclick="tryItOut('GETapi-parking-spots--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-parking-spots--id-"
                    onclick="cancelTryOut('GETapi-parking-spots--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-parking-spots--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/parking-spots/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-parking-spots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-parking-spots--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-parking-spots--id-"
               value="1"
               data-component="url">
    <br>
<p>ID parking lot. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-parking-spots--id-"
               value="A01"
               data-component="query">
    <br>
<p>Filter berdasarkan nomor spot. Example: <code>A01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-parking-spots--id-"
               value="available"
               data-component="query">
    <br>
<p>Filter status parking spot. Example: <code>available</code></p>
Must be one of:
<ul style="list-style-type: square;"><li><code>available</code></li> <li><code>occupied</code></li> <li><code>reserved</code></li> <li><code>broken</code></li></ul>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-parking-spots--id-"
               value="10"
               data-component="query">
    <br>
<p>Jumlah data per halaman. Default: 10. Example: <code>10</code></p>
            </div>
                </form>

                <h1 id="user-management">User Management</h1>

    

                                <h2 id="user-management-POSTapi-dashboard-users">Create User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Membuat user baru.</p>

<span id="example-requests-POSTapi-dashboard-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/dashboard/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"consequatur\",
    \"email\": \"qkunze@example.com\",
    \"password\": \"O[2UZ5ij-e\\/dl4m{o,\",
    \"role\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "consequatur",
    "email": "qkunze@example.com",
    "password": "O[2UZ5ij-e\/dl4m{o,",
    "role": "consequatur"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-dashboard-users">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 10,
    &quot;username&quot;: &quot;newuser&quot;,
    &quot;email&quot;: &quot;new@mail.com&quot;,
    &quot;role&quot;: &quot;user&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-dashboard-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-dashboard-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-dashboard-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-dashboard-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-dashboard-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-dashboard-users" data-method="POST"
      data-path="api/dashboard/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-dashboard-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-dashboard-users"
                    onclick="tryItOut('POSTapi-dashboard-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-dashboard-users"
                    onclick="cancelTryOut('POSTapi-dashboard-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-dashboard-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/dashboard/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-dashboard-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-dashboard-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-dashboard-users"
               value="consequatur"
               data-component="body">
    <br>
<p>Username user. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-dashboard-users"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Email user. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-dashboard-users"
               value="O[2UZ5ij-e/dl4m{o,"
               data-component="body">
    <br>
<p>min:8 Password user. Example: <code>O[2UZ5ij-e/dl4m{o,</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-dashboard-users"
               value="consequatur"
               data-component="body">
    <br>
<p>Role user (admin/user). Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="user-management-PUTapi-dashboard-users--id-">Update User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Memperbarui data user.</p>

<span id="example-requests-PUTapi-dashboard-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/dashboard/users/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"consequatur\",
    \"email\": \"qkunze@example.com\",
    \"role\": \"consequatur\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/users/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "consequatur",
    "email": "qkunze@example.com",
    "role": "consequatur"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-dashboard-users--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;username&quot;: &quot;updated_name&quot;,
    &quot;email&quot;: &quot;updated@mail.com&quot;,
    &quot;role&quot;: &quot;admin&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-dashboard-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-dashboard-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-dashboard-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-dashboard-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-dashboard-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-dashboard-users--id-" data-method="PUT"
      data-path="api/dashboard/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-dashboard-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-dashboard-users--id-"
                    onclick="tryItOut('PUTapi-dashboard-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-dashboard-users--id-"
                    onclick="cancelTryOut('PUTapi-dashboard-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-dashboard-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/dashboard/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-dashboard-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-dashboard-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-dashboard-users--id-"
               value="17"
               data-component="url">
    <br>
<p>ID user. Example: <code>17</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="PUTapi-dashboard-users--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Username user. Example: <code>consequatur</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-dashboard-users--id-"
               value="qkunze@example.com"
               data-component="body">
    <br>
<p>Email user. Example: <code>qkunze@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="PUTapi-dashboard-users--id-"
               value="consequatur"
               data-component="body">
    <br>
<p>Role user. Example: <code>consequatur</code></p>
        </div>
        </form>

                    <h2 id="user-management-DELETEapi-dashboard-users--id-">Delete User</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Menghapus user berdasarkan ID.</p>

<span id="example-requests-DELETEapi-dashboard-users--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/dashboard/users/17" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/users/17"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-dashboard-users--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;success&quot;: true
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-dashboard-users--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-dashboard-users--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-dashboard-users--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-dashboard-users--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-dashboard-users--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-dashboard-users--id-" data-method="DELETE"
      data-path="api/dashboard/users/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-dashboard-users--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-dashboard-users--id-"
                    onclick="tryItOut('DELETEapi-dashboard-users--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-dashboard-users--id-"
                    onclick="cancelTryOut('DELETEapi-dashboard-users--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-dashboard-users--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/dashboard/users/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-dashboard-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-dashboard-users--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-dashboard-users--id-"
               value="17"
               data-component="url">
    <br>
<p>ID user. Example: <code>17</code></p>
            </div>
                    </form>

                    <h2 id="user-management-GETapi-dashboard-users">Get Users</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil daftar user dengan pagination, pencarian, dan filter role.</p>

<span id="example-requests-GETapi-dashboard-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/users?perPage=17&amp;search=consequatur&amp;role=consequatur" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/users"
);

const params = {
    "perPage": "17",
    "search": "consequatur",
    "role": "consequatur",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-users">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;current_page&quot;: 1,
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;username&quot;: &quot;john_doe&quot;,
            &quot;email&quot;: &quot;john@mail.com&quot;,
            &quot;role&quot;: &quot;user&quot;,
            &quot;created_at&quot;: &quot;2024-01-01T10:00:00Z&quot;
        }
    ],
    &quot;per_page&quot;: 10,
    &quot;total&quot;: 25
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-users" data-method="GET"
      data-path="api/dashboard/users"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-users"
                    onclick="tryItOut('GETapi-dashboard-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-users"
                    onclick="cancelTryOut('GETapi-dashboard-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perPage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perPage"                data-endpoint="GETapi-dashboard-users"
               value="17"
               data-component="query">
    <br>
<p>Jumlah data per halaman. Default: 10 Example: <code>17</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>search</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="search"                data-endpoint="GETapi-dashboard-users"
               value="consequatur"
               data-component="query">
    <br>
<p>Cari berdasarkan username. Example: <code>consequatur</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="GETapi-dashboard-users"
               value="consequatur"
               data-component="query">
    <br>
<p>Filter berdasarkan role (admin, user). Example: <code>consequatur</code></p>
            </div>
                </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
