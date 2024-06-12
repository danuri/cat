! function() {
    var a, o, s, d, t, n, e, l, r, i, m, c = document.querySelector(".navbar-menu").innerHTML,
        u = 5,
        g = "en",
        b = localStorage.getItem("language");

    function y() {
        f(null === b ? g : b);
        var e = document.getElementsByClassName("language");
        e && Array.from(e).forEach(function(t) {
            t.addEventListener("click", function(e) {
                f(t.getAttribute("data-lang"))
            })
        })
    }

    function f(e) {
        document.getElementById("header-lang-img") && ("en" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/us.svg" : "sp" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/spain.svg" : "gr" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/germany.svg" : "it" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/italy.svg" : "ru" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/russia.svg" : "ch" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/china.svg" : "fr" == e ? document.getElementById("header-lang-img").src = "assets/images/flags/french.svg" : "ar" == e && (document.getElementById("header-lang-img").src = "assets/images/flags/ae.svg"), localStorage.setItem("language", e), null == (b = localStorage.getItem("language")) && f(g), (e = new XMLHttpRequest).open("GET", "assets/lang/" + b + ".json"), e.onreadystatechange = function() {
            var a;
            4 === this.readyState && 200 === this.status && (a = JSON.parse(this.responseText), Object.keys(a).forEach(function(t) {
                var e = document.querySelectorAll("[data-key='" + t + "']");
                Array.from(e).forEach(function(e) {
                    e.textContent = a[t]
                })
            }))
        }, e.send())
    }

    function h() {
        var e;
        document.querySelectorAll(".navbar-nav .collapse") && (e = document.querySelectorAll(".navbar-nav .collapse"), Array.from(e).forEach(function(t) {
            var a = new bootstrap.Collapse(t, {
                toggle: !1
            });
            t.addEventListener("show.bs.collapse", function(e) {
                e.stopPropagation();
                var e = t.parentElement.closest(".collapse");
                e ? (e = e.querySelectorAll(".collapse"), Array.from(e).forEach(function(e) {
                    e = bootstrap.Collapse.getInstance(e);
                    e !== a && e.hide()
                })) : (e = function(e) {
                    for (var t = [], a = e.parentNode.firstChild; a;) 1 === a.nodeType && a !== e && t.push(a), a = a.nextSibling;
                    return t
                }(t.parentElement), Array.from(e).forEach(function(e) {
                    2 < e.childNodes.length && e.firstElementChild.setAttribute("aria-expanded", "false");
                    e = e.querySelectorAll("*[id]");
                    Array.from(e).forEach(function(e) {
                        e.classList.remove("show"), 2 < e.childNodes.length && (e = e.querySelectorAll("ul li a"), Array.from(e).forEach(function(e) {
                            e.hasAttribute("aria-expanded") && e.setAttribute("aria-expanded", "false")
                        }))
                    })
                }))
            }), t.addEventListener("hide.bs.collapse", function(e) {
                e.stopPropagation();
                e = t.querySelectorAll(".collapse");
                Array.from(e).forEach(function(e) {
                    (childCollapseInstance = bootstrap.Collapse.getInstance(e)).hide()
                })
            })
        }))
    }

    function p(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                o = e.offsetWidth,
                n = e.offsetHeight;
            if (e.offsetParent)
                for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function E() {
        "vertical" == document.documentElement.getAttribute("data-layout") && (document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = c), document.getElementById("scrollbar").setAttribute("data-simplebar", ""), document.getElementById("scrollbar").classList.add("h-100")), "horizontal" == document.documentElement.getAttribute("data-layout") && k()
    }

    function v() {
        feather.replace();
        var e = document.documentElement.clientWidth,
            e = (e < 1025 && 767 < e ? ("vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "sm"), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.add("open")) : 1025 <= e ? ("vertical" == sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size")), document.querySelector(".hamburger-icon") && document.querySelector(".hamburger-icon").classList.remove("open")) : e <= 767 && (document.body.classList.remove("vertical-sidebar-enable"), "horizontal" != sessionStorage.getItem("data-layout") && document.documentElement.setAttribute("data-sidebar-size", "lg"), document.querySelector(".hamburger-icon")) && document.querySelector(".hamburger-icon").classList.add("open"), document.querySelectorAll("#navbar-nav > li.nav-item"));
        Array.from(e).forEach(function(e) {
            e.addEventListener("click", S.bind(this), !1), e.addEventListener("mouseover", S.bind(this), !1)
        })
    }

    function S(e) {
        if (e.target && e.target.matches("a.nav-link span"))
            if (0 == p(e.target.parentElement.nextElementSibling)) {
                e.target.parentElement.nextElementSibling.classList.add("dropdown-custom-right"), e.target.parentElement.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
                var t = e.target.parentElement.nextElementSibling;
                Array.from(t.querySelectorAll(".menu-dropdown")).forEach(function(e) {
                    e.classList.add("dropdown-custom-right")
                })
            } else if (1 == p(e.target.parentElement.nextElementSibling) && 1848 <= window.innerWidth)
            for (var a = document.getElementsByClassName("dropdown-custom-right"); 0 < a.length;) a[0].classList.remove("dropdown-custom-right");
        if (e.target && e.target.matches("a.nav-link"))
            if (0 == p(e.target.nextElementSibling)) {
                e.target.nextElementSibling.classList.add("dropdown-custom-right"), e.target.parentElement.parentElement.parentElement.classList.add("dropdown-custom-right");
                t = e.target.nextElementSibling;
                Array.from(t.querySelectorAll(".menu-dropdown")).forEach(function(e) {
                    e.classList.add("dropdown-custom-right")
                })
            } else if (1 == p(e.target.nextElementSibling) && 1848 <= window.innerWidth)
            for (a = document.getElementsByClassName("dropdown-custom-right"); 0 < a.length;) a[0].classList.remove("dropdown-custom-right")
    }

    function I() {
        var e = document.documentElement.clientWidth;
        767 < e && document.querySelector(".hamburger-icon").classList.toggle("open"), "horizontal" === document.documentElement.getAttribute("data-layout") && (document.body.classList.contains("menu") ? document.body.classList.remove("menu") : document.body.classList.add("menu")), "vertical" === document.documentElement.getAttribute("data-layout") && (e < 1025 && 767 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "sm" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "") : document.documentElement.setAttribute("data-sidebar-size", "sm")) : 1025 < e ? (document.body.classList.remove("vertical-sidebar-enable"), "lg" == document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm") : document.documentElement.setAttribute("data-sidebar-size", "lg")) : e <= 767 && (document.body.classList.add("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", "lg")))
    }

    function w() {
        document.addEventListener("DOMContentLoaded", function() {
            var e = document.getElementsByClassName("code-switcher");
            Array.from(e).forEach(function(a) {
                a.addEventListener("change", function() {
                    var e = a.closest(".card"),
                        t = e.querySelector(".live-preview"),
                        e = e.querySelector(".code-view");
                    a.checked ? (t.classList.add("d-none"), e.classList.remove("d-none")) : (t.classList.remove("d-none"), e.classList.add("d-none"))
                })
            }), feather.replace()
        }), window.addEventListener("resize", v), v(), Waves.init(), document.addEventListener("scroll", function() {
            var e;
            (e = document.getElementById("page-topbar")) && (50 <= document.body.scrollTop || 50 <= document.documentElement.scrollTop ? e.classList.add("topbar-shadow") : e.classList.remove("topbar-shadow"))
        }), window.addEventListener("load", function() {
            var e;
            document.documentElement.getAttribute("data-layout");
            A(), (e = document.getElementsByClassName("vertical-overlay")) && Array.from(e).forEach(function(e) {
                e.addEventListener("click", function() {
                    document.body.classList.remove("vertical-sidebar-enable"), document.documentElement.setAttribute("data-sidebar-size", sessionStorage.getItem("data-sidebar-size"))
                })
            }), B()
        }), document.getElementById("topnav-hamburger-icon") && document.getElementById("topnav-hamburger-icon").addEventListener("click", I);
        var e = sessionStorage.getItem("defaultAttribute");
        JSON.parse(e), document.documentElement.clientWidth
    }

    function A() {
        var e = "/" == location.pathname ? "index.html" : location.pathname.substring(1);
        (e = e.substring(e.lastIndexOf("/") + 1)) && (e = document.getElementById("navbar-nav").querySelector('[href="' + e + '"]')) && (e.classList.add("active"), e = e.closest(".collapse.menu-dropdown")) && (e.classList.add("show"), e.parentElement.children[0].classList.add("active"), e.parentElement.children[0].setAttribute("aria-expanded", "true"), e.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.closest(".collapse").classList.add("show"), e.parentElement.closest(".collapse").previousElementSibling && e.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse.menu-dropdown")) && (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").classList.add("show"), e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling) && (e.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active"), "horizontal" == document.documentElement.getAttribute("data-layout")) && e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse") && e.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.parentElement.closest(".collapse").previousElementSibling.classList.add("active")
    }

    function p(e) {
        if (e) {
            var t = e.offsetTop,
                a = e.offsetLeft,
                o = e.offsetWidth,
                n = e.offsetHeight;
            if (e.offsetParent)
                for (; e.offsetParent;) t += (e = e.offsetParent).offsetTop, a += e.offsetLeft;
            return t >= window.pageYOffset && a >= window.pageXOffset && t + n <= window.pageYOffset + window.innerHeight && a + o <= window.pageXOffset + window.innerWidth
        }
    }

    function L() {
        var e = document.querySelectorAll(".counter-value");

        function s(e) {
            return e.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }
        e && Array.from(e).forEach(function(n) {
            ! function e() {
                var t = +n.getAttribute("data-target"),
                    a = +n.innerText,
                    o = t / 250;
                o < 1 && (o = 1), a < t ? (n.innerText = (a + o).toFixed(0), setTimeout(e, 1)) : n.innerText = s(t), s(n.innerText)
            }()
        })
    }

    function k() {
        document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = c), document.getElementById("scrollbar").removeAttribute("data-simplebar"), document.getElementById("navbar-nav").removeAttribute("data-simplebar"), document.getElementById("scrollbar").classList.remove("h-100");
        var a = u,
            o = document.querySelectorAll("ul.navbar-nav > li.nav-item"),
            n = "",
            s = "";
        Array.from(o).forEach(function(e, t) {
            t + 1 === a && (s = e), a < t + 1 && (n += e.outerHTML, e.remove()), t + 1 === o.length && s.insertAdjacentHTML && s.insertAdjacentHTML("afterend", '<li class="nav-item">\t\t\t\t\t\t<a class="nav-link" href="#sidebarMore" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMore">\t\t\t\t\t\t\t<i class="las la-briefcase"></i> More\t\t\t\t\t\t</a>\t\t\t\t\t\t<div class="collapse menu-dropdown" id="sidebarMore"><ul class="nav nav-sm flex-column">' + n + "</ul></div>\t\t\t\t\t</li>")
        })
    }

    function z(e) {
        "vertical" == e ? (document.querySelector(".navbar-menu") && (document.querySelector(".navbar-menu").innerHTML = c), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "block", document.getElementById("sidebar-view").style.display = "block", document.getElementById("sidebar-color").style.display = "block", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "block"), document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block"), E(), A(), B(), T()) : "horizontal" == e && (k(), document.getElementById("theme-settings-offcanvas") && (document.getElementById("sidebar-size").style.display = "none", document.getElementById("sidebar-view").style.display = "none", document.getElementById("sidebar-color").style.display = "none", document.getElementById("sidebar-img") && (document.getElementById("sidebar-img").style.display = "none"), document.getElementById("layout-position").style.display = "block", document.getElementById("layout-width").style.display = "block"), A())
    }

    function B() {
        document.getElementById("vertical-hover").addEventListener("click", function() {
            "sm-hover" === document.documentElement.getAttribute("data-sidebar-size") ? document.documentElement.setAttribute("data-sidebar-size", "sm-hover-active") : (document.documentElement.getAttribute("data-sidebar-size"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"))
        })
    }

    function x(e) {
        if (e == e) {
            switch (e["data-layout"]) {
                case "vertical":
                    q("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), z("vertical"), h();
                    break;
                case "horizontal":
                    q("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), z("horizontal");
                    break;
                default:
                    "vertical" == sessionStorage.getItem("data-layout") && sessionStorage.getItem("data-layout") ? (q("data-layout", "vertical"), sessionStorage.setItem("data-layout", "vertical"), document.documentElement.setAttribute("data-layout", "vertical"), z("vertical"), h()) : "horizontal" == sessionStorage.getItem("data-layout") && (q("data-layout", "horizontal"), sessionStorage.setItem("data-layout", "horizontal"), document.documentElement.setAttribute("data-layout", "horizontal"), z("horizontal"))
            }
            switch (e["data-topbar"]) {
                case "light":
                    q("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light");
                    break;
                case "dark":
                    q("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark");
                    break;
                default:
                    "dark" == sessionStorage.getItem("data-topbar") ? (q("data-topbar", "dark"), sessionStorage.setItem("data-topbar", "dark"), document.documentElement.setAttribute("data-topbar", "dark")) : (q("data-topbar", "light"), sessionStorage.setItem("data-topbar", "light"), document.documentElement.setAttribute("data-topbar", "light"))
            }
            switch (e["data-layout-style"]) {
                case "default":
                    q("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default");
                    break;
                case "detached":
                    q("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached");
                    break;
                default:
                    "detached" == sessionStorage.getItem("data-layout-style") ? (q("data-layout-style", "detached"), sessionStorage.setItem("data-layout-style", "detached"), document.documentElement.setAttribute("data-layout-style", "detached")) : (q("data-layout-style", "default"), sessionStorage.setItem("data-layout-style", "default"), document.documentElement.setAttribute("data-layout-style", "default"))
            }
            switch (e["data-sidebar-size"]) {
                case "lg":
                    q("data-sidebar-size", "lg"), document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg");
                    break;
                case "sm":
                    q("data-sidebar-size", "sm"), document.documentElement.setAttribute("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm");
                    break;
                case "md":
                    q("data-sidebar-size", "md"), document.documentElement.setAttribute("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md");
                    break;
                case "sm-hover":
                    q("data-sidebar-size", "sm-hover"), document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover");
                    break;
                default:
                    "sm" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "sm"), q("data-sidebar-size", "sm"), sessionStorage.setItem("data-sidebar-size", "sm")) : "md" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "md"), q("data-sidebar-size", "md"), sessionStorage.setItem("data-sidebar-size", "md")) : "sm-hover" == sessionStorage.getItem("data-sidebar-size") ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), q("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover")) : (document.documentElement.setAttribute("data-sidebar-size", "lg"), q("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"))
            }
            switch (e["data-layout-mode"]) {
                case "light":
                    q("data-layout-mode", "light"), document.documentElement.setAttribute("data-layout-mode", "light"), sessionStorage.setItem("data-layout-mode", "light");
                    break;
                case "dark":
                    q("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), sessionStorage.setItem("data-layout-mode", "dark");
                    break;
                default:
                    sessionStorage.getItem("data-layout-mode") && "dark" == sessionStorage.getItem("data-layout-mode") ? (sessionStorage.setItem("data-layout-mode", "dark"), document.documentElement.setAttribute("data-layout-mode", "dark"), q("data-layout-mode", "dark")) : (sessionStorage.setItem("data-layout-mode", "light"), document.documentElement.setAttribute("data-layout-mode", "light"), q("data-layout-mode", "light"))
            }
            switch (e["data-layout-width"]) {
                case "fluid":
                    q("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), sessionStorage.setItem("data-layout-width", "fluid");
                    break;
                case "boxed":
                    q("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), sessionStorage.setItem("data-layout-width", "boxed");
                    break;
                default:
                    "boxed" == sessionStorage.getItem("data-layout-width") ? (sessionStorage.setItem("data-layout-width", "boxed"), document.documentElement.setAttribute("data-layout-width", "boxed"), q("data-layout-width", "boxed")) : (sessionStorage.setItem("data-layout-width", "fluid"), document.documentElement.setAttribute("data-layout-width", "fluid"), q("data-layout-width", "fluid"))
            }
            switch (e["data-sidebar"]) {
                case "light":
                    q("data-sidebar", "light"), sessionStorage.setItem("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light");
                    break;
                case "dark":
                    q("data-sidebar", "dark"), sessionStorage.setItem("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark");
                    break;
                default:
                    sessionStorage.getItem("data-sidebar") && "light" == sessionStorage.getItem("data-sidebar") ? (sessionStorage.setItem("data-sidebar", "light"), q("data-sidebar", "light"), document.documentElement.setAttribute("data-sidebar", "light")) : "dark" == sessionStorage.getItem("data-sidebar") && (sessionStorage.setItem("data-sidebar", "dark"), q("data-sidebar", "dark"), document.documentElement.setAttribute("data-sidebar", "dark"))
            }
            switch (e["data-layout-position"]) {
                case "fixed":
                    q("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed");
                    break;
                case "scrollable":
                    q("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable");
                    break;
                default:
                    sessionStorage.getItem("data-layout-position") && "scrollable" == sessionStorage.getItem("data-layout-position") ? (q("data-layout-position", "scrollable"), sessionStorage.setItem("data-layout-position", "scrollable"), document.documentElement.setAttribute("data-layout-position", "scrollable")) : (q("data-layout-position", "fixed"), sessionStorage.setItem("data-layout-position", "fixed"), document.documentElement.setAttribute("data-layout-position", "fixed"))
            }
        }
    }

    function T() {
        setTimeout(function() {
            var e, t, a = document.getElementById("navbar-nav");
            a && (a = a.querySelector(".nav-item .active"), 300 < (e = a ? a.offsetTop : 0)) && (t = document.getElementsByClassName("app-menu") ? document.getElementsByClassName("app-menu")[0] : "") && t.querySelector(".simplebar-content-wrapper") && setTimeout(function() {
                t.querySelector(".simplebar-content-wrapper").scrollTop = 330 == e ? e + 85 : e
            }, 0)
        }, 250)
    }

    function q(t, a) {
        Array.from(document.querySelectorAll("input[name=" + t + "]")).forEach(function(e) {
            a == e.value ? e.checked = !0 : e.checked = !1, e.addEventListener("change", function() {
                document.documentElement.setAttribute(t, e.value), sessionStorage.setItem(t, e.value), y(), "data-layout-width" == t && "boxed" == e.value ? (document.documentElement.setAttribute("data-sidebar-size", "sm-hover"), sessionStorage.setItem("data-sidebar-size", "sm-hover"), document.getElementById("sidebar-size-small-hover").checked = !0) : "data-layout-width" == t && "fluid" == e.value && (document.documentElement.setAttribute("data-sidebar-size", "lg"), sessionStorage.setItem("data-sidebar-size", "lg"), document.getElementById("sidebar-size-default").checked = !0), "data-layout" == t && ("vertical" == e.value ? (z("vertical"), h(), feather.replace()) : "horizontal" == e.value && (document.getElementById("sidebarimg-none") && document.getElementById("sidebarimg-none").click(), z("horizontal"), feather.replace()))
            })
        })
    }

    function C(e, t, a, o) {
        var n = document.getElementById(a);
        o.setAttribute(e, t), n && document.getElementById(a).click()
    }

    function F() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.body.classList.remove("fullscreen-enable")
    }

    function N() {
        var e;
        "horizontal" !== document.documentElement.getAttribute("data-layout") && (document.getElementById("navbar-nav") && (e = new SimpleBar(document.getElementById("navbar-nav"))) && e.getContentElement(), document.getElementsByClassName("twocolumn-iconview")[0] && (e = new SimpleBar(document.getElementsByClassName("twocolumn-iconview")[0])) && e.getContentElement(), clearTimeout(m))
    }
    sessionStorage.getItem("defaultAttribute") ? ((a = {})["data-layout"] = sessionStorage.getItem("data-layout"), a["data-sidebar-size"] = sessionStorage.getItem("data-sidebar-size"), a["data-layout-mode"] = sessionStorage.getItem("data-layout-mode"), a["data-layout-width"] = sessionStorage.getItem("data-layout-width"), a["data-sidebar"] = sessionStorage.getItem("data-sidebar"), a["data-layout-position"] = sessionStorage.getItem("data-layout-position"), a["data-layout-style"] = sessionStorage.getItem("data-layout-style"), a["data-topbar"] = sessionStorage.getItem("data-topbar"), x(a)) : (l = document.documentElement.attributes, a = {}, Array.from(l).forEach(function(e) {
        var t;
        e && e.nodeName && "undefined" != e.nodeName && (t = e.nodeName, a[t] = e.nodeValue, sessionStorage.setItem(t, e.nodeValue))
    }), sessionStorage.setItem("defaultAttribute", JSON.stringify(a)), x(a), (l = document.querySelector('.btn[data-bs-target="#theme-settings-offcanvas"]')) && l.click()), o = document.getElementById("search-close-options"), s = document.getElementById("search-dropdown"), (d = document.getElementById("search-options")) && (d.addEventListener("focus", function() {
        0 < d.value.length ? (s.classList.add("show"), o.classList.remove("d-none")) : (s.classList.remove("show"), o.classList.add("d-none"))
    }), d.addEventListener("keyup", function(e) {
        var n, t;
        0 < d.value.length ? (s.classList.add("show"), o.classList.remove("d-none"), n = d.value.toLowerCase(), t = document.getElementsByClassName("notify-item"), Array.from(t).forEach(function(e) {
            var t, a, o = "";
            e.querySelector("h6") ? (t = e.getElementsByTagName("span")[0].innerText.toLowerCase(), o = (a = e.querySelector("h6").innerText.toLowerCase()).includes(n) ? a : t) : e.getElementsByTagName("span") && (o = e.getElementsByTagName("span")[0].innerText.toLowerCase()), o && (e.style.display = o.includes(n) ? "block" : "none")
        })) : (s.classList.remove("show"), o.classList.add("d-none"))
    }), o.addEventListener("click", function() {
        d.value = "", s.classList.remove("show"), o.classList.add("d-none")
    }), document.body.addEventListener("click", function(e) {
        "search-options" !== e.target.getAttribute("id") && (s.classList.remove("show"), o.classList.add("d-none"))
    })), t = document.getElementById("search-close-options"), n = document.getElementById("search-dropdown-reponsive"), e = document.getElementById("search-options-reponsive"), t && n && e && (e.addEventListener("focus", function() {
        0 < e.value.length ? (n.classList.add("show"), t.classList.remove("d-none")) : (n.classList.remove("show"), t.classList.add("d-none"))
    }), e.addEventListener("keyup", function() {
        0 < e.value.length ? (n.classList.add("show"), t.classList.remove("d-none")) : (n.classList.remove("show"), t.classList.add("d-none"))
    }), t.addEventListener("click", function() {
        e.value = "", n.classList.remove("show"), t.classList.add("d-none")
    }), document.body.addEventListener("click", function(e) {
        "search-options" !== e.target.getAttribute("id") && (n.classList.remove("show"), t.classList.add("d-none"))
    })), (l = document.querySelector('[data-toggle="fullscreen"]')) && l.addEventListener("click", function(e) {
        e.preventDefault(), document.body.classList.toggle("fullscreen-enable"), document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement ? document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen && document.webkitCancelFullScreen() : document.documentElement.requestFullscreen ? document.documentElement.requestFullscreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)
    }), document.addEventListener("fullscreenchange", F), document.addEventListener("webkitfullscreenchange", F), document.addEventListener("mozfullscreenchange", F), r = document.getElementsByTagName("HTML")[0], (i = document.querySelectorAll(".light-dark-mode")) && i.length && i[0].addEventListener("click", function(e) {
        r.hasAttribute("data-layout-mode") && "dark" == r.getAttribute("data-layout-mode") ? C("data-layout-mode", "light", "layout-mode-light", r) : C("data-layout-mode", "dark", "layout-mode-dark", r)
    }), w(), L(), E(), [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function(e) {
        return new bootstrap.Tooltip(e)
    }), [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function(e) {
        return new bootstrap.Popover(e)
    }), document.getElementById("reset-layout") && document.getElementById("reset-layout").addEventListener("click", function() {
        sessionStorage.clear(), window.location.reload()
    }), i = document.querySelectorAll("[data-choices]"), Array.from(i).forEach(function(e) {
        var t = {},
            a = e.attributes;
        a["data-choices-groups"] && (t.placeholderValue = "This is a placeholder set in the config"), a["data-choices-search-false"] && (t.searchEnabled = !1), a["data-choices-search-true"] && (t.searchEnabled = !0), a["data-choices-removeItem"] && (t.removeItemButton = !0), a["data-choices-sorting-false"] && (t.shouldSort = !1), a["data-choices-sorting-true"] && (t.shouldSort = !0), a["data-choices-multiple-remove"] && (t.removeItemButton = !0), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-limit"] && (t.maxItemCount = a["data-choices-limit"].value.toString()), a["data-choices-editItem-true"] && (t.maxItemCount = !0), a["data-choices-editItem-false"] && (t.maxItemCount = !1), a["data-choices-text-unique-true"] && (t.duplicateItemsAllowed = !1), a["data-choices-text-disabled-true"] && (t.addItems = !1), a["data-choices-text-disabled-true"] ? new Choices(e, t).disable() : new Choices(e, t)
    }), i = document.querySelectorAll("[data-provider]"), Array.from(i).forEach(function(e) {
        var t, a, o;
        "flatpickr" == e.getAttribute("data-provider") ? (o = e.attributes, (t = {}).disableMobile = "true", o["data-date-format"] && (t.dateFormat = o["data-date-format"].value.toString()), o["data-enable-time"] && (t.enableTime = !0, t.dateFormat = o["data-date-format"].value.toString() + " H:i"), o["data-altFormat"] && (t.altInput = !0, t.altFormat = o["data-altFormat"].value.toString()), o["data-minDate"] && (t.minDate = o["data-minDate"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-maxDate"] && (t.maxDate = o["data-maxDate"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-deafult-date"] && (t.defaultDate = o["data-deafult-date"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-multiple-date"] && (t.mode = "multiple", t.dateFormat = o["data-date-format"].value.toString()), o["data-range-date"] && (t.mode = "range", t.dateFormat = o["data-date-format"].value.toString()), o["data-inline-date"] && (t.inline = !0, t.defaultDate = o["data-deafult-date"].value.toString(), t.dateFormat = o["data-date-format"].value.toString()), o["data-disable-date"] && ((a = []).push(o["data-disable-date"].value), t.disable = a.toString().split(",")), o["data-week-number"] && ((a = []).push(o["data-week-number"].value), t.weekNumbers = !0), flatpickr(e, t)) : "timepickr" == e.getAttribute("data-provider") && (a = {}, (o = e.attributes)["data-time-basic"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i"), o["data-time-hrs"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.time_24hr = !0), o["data-min-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-min-time"].value.toString()), o["data-max-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.minTime = o["data-max-time"].value.toString()), o["data-default-time"] && (a.enableTime = !0, a.noCalendar = !0, a.dateFormat = "H:i", a.defaultDate = o["data-default-time"].value.toString()), o["data-time-inline"] && (a.enableTime = !0, a.noCalendar = !0, a.defaultDate = o["data-time-inline"].value.toString(), a.inline = !0), flatpickr(e, a))
    }), Array.from(document.querySelectorAll('.dropdown-menu a[data-bs-toggle="tab"]')).forEach(function(e) {
        e.addEventListener("click", function(e) {
            e.stopPropagation(), bootstrap.Tab.getInstance(e.target).show()
        })
    }), y(), h(), T(), window.addEventListener("resize", function() {
        m && clearTimeout(m), m = setTimeout(N, 2e3)
    })
}();
var mybutton = document.getElementById("back-to-top");

function scrollFunction() {
    100 < document.body.scrollTop || 100 < document.documentElement.scrollTop ? mybutton.style.display = "block" : mybutton.style.display = "none"
}

function topFunction() {
    document.body.scrollTop = 0, document.documentElement.scrollTop = 0
}
mybutton && (window.onscroll = function() {
    scrollFunction()
}); // This is just a sample script. Paste your real code (javascript or HTML) here.

if ('this_is' == /an_example/) {
    of_beautifier();
} else {
    var a = b ? (c % d) : e[f];
}
