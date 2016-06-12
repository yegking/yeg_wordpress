(function () {
    var F = 8;
    var B = window.dui || {}, e = "dui-dialog",
        x = [],
        t = null,
        f = ($.browser.msie && $.browser.version === "6.0") ? true : false,//判断当前浏览器是否是IE6
        D = "ontouchstart" in window,// 原生JavaScript判断是否Touch屏幕
        d = {}, r = {}, E = "j_close_dialog",
        c = "dui-dialog",
        m = "dui-dialog-close",
        a = "dui-dialog-shd",
        q = "dui-dialog-content",
        n = "dui-dialog-iframe",
        j = "dui-dialog-msk",
        p = "确定",
        b = "取消",
        w = "提示",
        l = "下载中，请稍候...",
        i = '<div id="{ID}" class="' + c + ' {CLS}" style="{CSS_ISHIDE}">                <span class="' + a + '"></span>                <div class="' + q + '">                    {BN_CLOSE}                    {TITLE}                    <div class="bd">{BODY}</div>                </div>            </div>',
        g = '<a href="#" class="' + E + " " + m + '">X</a>',
        k = '<div class="hd"><h3>{TITLE}</h3></div>',
        y = '<iframe class="' + n + '"></iframe>',
        u = '<div class="' + j + '"></div>',
        o = {
            confirm: {//confirm() 方法用于显示一个带有指定消息和 OK 及取消按钮的对话框。
                text: p,
                method: function (G) {
                    G.close()
                }
            },
            cancel: {//cancel()取消窗口
                text: b,
                method: function (G) {
                    G.close()
                }
            }
        },
        C = {
            url: "",
            nodeId: "",
            cls: "",
            content: "",
            title: w,
            width: 0,
            height: 0,
            visible: false,
            modal: false,
            iframe: false,
            maxWidth: 960,
            autoupdate: false,
            cache: true,
            buttons: [],
            callback: null,
            dataType: "text",
            isStick: false,
            isHideClose: false,
            isHideTitle: false
        },
        h = function (J, I) {
            var G = {}, H;
            for (H in I) {
                if (I.hasOwnProperty(H)) {//hasOwnProperty(propertyName)函数的返回值为Boolean类型。如果对象object具有名称为propertyName的属性，则返回true，否则返回false。
                    G[H] = J[H] === undefined ? I[H] : J[H]
                }
            }
            return G
        },
        A = function (L) {
            var I = L.elements,
                H = 0,
                J, K = [],
                G = {
                    "select-one": function (M) {
                        return encodeURIComponent(M.name) + "=" + encodeURIComponent(M.options[M.selectedIndex].value)//encodeURIComponent可把字符串作为URI 组件进行编码
                    },
                        "select-multiple": function (P) {
                        var O = 0,
                            N, M = [];
                        for (; N = P.options[O++];) {
                            if (N.selected) {
                                M.push(encodeURIComponent(P.name) + "=" + encodeURIComponent(N.value))
                            }
                        }
                        return M.join("&")
                    },
                    radio: function (M) {
                        if (M.checked) {
                            return encodeURIComponent(M.name) + "=" + encodeURIComponent(M.value)
                        }
                    },
                    checkbox: function (M) {
                        if (M.checked) {
                            return encodeURIComponent(M.name) + "=" + encodeURIComponent(M.value)
                        }
                    }
                };
            for (; J = I[H++];) {
                if (G[J.type]) {
                    K.push(G[J.type](J))//push() 方法可向数组的末尾添加一个或多个元素，并返回新的长度
                } else {
                    K.push(encodeURIComponent(J.name) + "=" + encodeURIComponent(J.value))
                }
            }
            return K.join("&").replace(/\&{2,}/g, "&")
        },
        v = function (G) {
            var H = G || {};
            this.config = h(H, C);
            this.init()//初始化自己
        };
    v.prototype = {//A的prototype为B的一个实例，可以理解A将B中的方法和属性全部克隆了一遍(原型)
        init: function () {
            if (!this.config) {
                return
            }
            this.render();//render就是渲染的意思
            this.bind();//bind()方法用于将一个处理程序附加到每个匹配元素的事件上并返回jQuery对象
            return this
        },
        render: function (J) {
            var G = this.config,
                L = G.nodeId || e + x.length;
            x.push(L);
            var I = $("body"),
                K = I.find("." + j),
                H = typeof G.content === "object" ? $(G.content).html() : G.content;
            I.append(i.replace("{ID}", L).replace("{CSS_ISHIDE}", G.visible ? "" : "visibility:hidden;top:-999em;left:-999em;").replace("{CLS}", G.cls).replace("{TITLE}", k.replace("{TITLE}", G.title)).replace("{BN_CLOSE}", g).replace("{BODY}", H || J || ""));
            if (G.modal && !K.length) {
                I.append(u);
                this.msk = $("." + j)
            } else {
                this.msk = K.eq(0)
            }
            this.nodeId = L;
            this.node = $("#" + L);
            this.title = $(".hd", this.node);
            this.body = $(".bd", this.node);
            this.btnClose = $("." + m, this.node);
            this.shadow = $("." + a, this.node);
            this.iframe = $("." + n, this.node);
            this.set(G);
            return this
        },
        bind: function () {
            var G = this;
            if (!f) {
                $(window).bind({
                    resize: s(function () {
                        G.updatePosition()
                    }, "pos"),
                    scroll: s(function () {
                        G.updatePosition()
                    }, "pos")
                })
            }
            G.node.delegate("." + E, "click", function (H) {
                G.close();
                H.preventDefault()
            });
            G.node.find("." + m).bind("click", function (H) {
                G.close();
                H.preventDefault()
            });
            $("body").keypress(function (H) {//当按钮被按下时，会发生该事件
                if (H.keyCode === 27) {
                    G.close()
                }
            });
            return this
        },
        updateSize: function () {
            var I = this.node.width(),
                J, G = $(window).width(),
                K = $(window).height(),
                H = this.config;
            $(".bd", this.node).css({
                height: "auto",
                "overflow-x": "visible",
                "overflow-y": "visible"
            });
            J = this.node.height();
            var L = 2 * F;
            H.maxWidth = Math.min(H.maxWidth, G - L);
            if (I > H.maxWidth) {
                I = H.maxWidth;
                this.node.css("width", I + "px")
            }
            if (J > K) {
                $(".bd", this.node).css({
                    height: (K - 150) + "px",
                    "overflow-x": "hidden",
                    "overflow-y": "auto"
                })
            }
            J = this.node.height();
            this.shadow.width(I);
            this.shadow.height(J);
            this.iframe.width(I + L).height(J + L);
            return this
        },
        updatePosition: function () {
            if (this.config.isStick) {
                return
            }
            var G = this.node.width(),
                I = this.node.height(),
                J = $(window),
                H = f ? J.scrollTop() : 0;
            this.node.css({
                left: Math.floor(J.width() / 2 - G / 2) + "px",
                top: Math.floor(J.height() / 2 - I / 2 - F) + H + "px"
            });
            return this
        },
        set: function (L) {
            var N, Q, H, I, G = this.nodeId,
                O = this.nodeId || O,
                J = [],
                K = this,
                P = function (R) {
                    J.push(0);
                    return G + "-" + R + "-" + J.length
                };
            if (!L) {
                return this
            }
            if (L.width) {
                this.node.css("width", L.width + "px");
                this.config.width = L.width
            }
            if (L.height) {
                this.node.css("height", L.height + "px");
                this.config.height = L.height
            }
            if ($.isArray(L.buttons) && L.buttons[0]) {
                I = $(".ft", this.node);
                H = [];
                $(L.buttons).each(function () {
                    var S = arguments[1],
                        R = P("bn");
                    if (typeof S === "string") {
                        S = o[S]
                    }
                    if (!S.text) {
                        return
                    }
                    if (S.href) {
                        H.push('<a class="' + (S.cls || "") + '" id="' + R + '" href="' + S.href + '">' + S.text + "</a> ")
                    } else {
                        H.push('<span class="bn-flat ' + (S.cls || "") + '"><input type="button" id="' + R + '" class="' + O + '-bn" value="' + S.text + '" /></span> ')
                    }
                    r[R] = S.method
                });
                if (!I[0]) {
                    I = this.body.parent().append('<div class="ft">' + H.join("") + "</div>")
                } else {
                    I.html(H.join(""))
                }
                this.footer = $(".ft", this.node);
                $(".ft input, .ft a", this.node).click(function (T) {
                    var S = this.id && r[this.id];
                    if (S) {
                        var R = S.call(this, K)
                    }
                    if (R) {
                        T.preventDefault();
                        if (typeof R == "string") {
                            alert(R)
                        }
                    }
                })
            } else {
                this.footer = $(".ft", this.node);
                this.footer.html("")
            }
            if (typeof L.isHideClose !== "undefined") {
                if (L.isHideClose) {
                    this.btnClose.hide()
                } else {
                    this.btnClose.show()
                }
                this.config.isHideClose = L.isHideClose
            }
            if (typeof L.isHideTitle !== "undefined") {
                if (L.isHideTitle) {
                    this.title.hide()
                } else {
                    this.title.show()
                }
                this.config.isHideTitle = L.isHideTitle
            }
            if (L.title) {
                this.setTitle(L.title);
                this.config.title = L.title
            }
            if (typeof L.iframe !== "undefined") {
                if (!L.iframe) {
                    this.iframe.hide()
                } else {
                    if (!this.iframe[0]) {
                        this.node.prepend(y);
                        this.iframe = $("." + n, this.node)
                    } else {
                        this.iframe.show()
                    }
                }
                this.config.iframe = L.iframe
            }
            if (L.content) {
                this.body.html(typeof L.content === "object" ? $(L.content).html() : L.content);
                this.config.content = L.content
            }
            if (L.url) {
                if (L.cache && d[L.url]) {
                    if (L.dataType === "text" || !L.dataType) {
                        this.setContent(d[L.url])
                    }
                    if (L.callback) {
                        L.callback(d[L.url], this)
                    }
                } else {
                    if (L.dataType === "json") {
                        this.setContent(l);
                        if (this.footer) {
                            this.footer.hide()
                        }
                        $.getJSON(L.url, function (R) {
                            K.footer.show();
                            d[L.url] = R;
                            if (L.callback) {
                                L.callback(R, K)
                            }
                        })
                    } else {
                        this.setContent(l);
                        if (this.footer) {
                            this.footer.hide()
                        }
                        $.ajax({
                            url: L.url,
                            dataType: L.dataType,
                            success: function (R) {
                                d[L.url] = R;
                                if (K.footer) {
                                    K.footer.show()
                                }
                                K.setContent(R);
                                if (L.callback) {
                                    L.callback(R, K)
                                }
                            }
                        })
                    }
                }
            }
            var M = L.position;
            if (M) {
                this.node.css({
                    left: M[0] + "px",
                    top: M[1] + "px"
                })
            }
            if (typeof L.autoupdate === "boolean") {
                this.config.autoupdate = L.autoupdate
            }
            if (typeof L.isStick === "boolean") {
                if (L.isStick) {
                    this.node.css("position", "absolute")
                } else {
                    this.node.css("position", "fixed")
                }
                this.config.isStick = L.isStick
            }
            return this.update()
        },
        update: function () {
            this.updateSize();
            this.updatePosition();
            return this
        },
        setContent: function (G) {
            this.body.html(G);
            return this.update()
        },
        setTitle: function (G) {
            $("h3", this.title).html(G);
            return this
        },
        submit: function (I) {
            var G = this,
                H = $("form", this.node);
            H.submit(function (M) {//getAttribute() 方法返回指定属性名的属性值。
                M.preventDefault();//取消事件的默认动作
                var J = this.getAttribute("action", 2),
                    K = this.getAttribute("method") || "get",
                    L = A(this);
                $[K.toLowerCase()](J, L, function (N) {
                    if (I) {
                        I(N)
                    }
                }, "json")
            });
            H.submit()
        },
        open: function () {
            this.node.appendTo("body").css("visibility", "visible").show();
            var H = this,
                G = this.config,
                I = H.body[0];
            H.contentHeight = I.offsetHeight;
            this.watcher = !G.autoupdate ? 0 : setInterval(function () {
                if (I.offsetHeight === H.contentHeight) {
                    return
                }
                H.update();
                H.contentHeight = I.offsetHeight
            }, 100);
            if (G.modal) {
                this.msk.show().css({
                    height: $(document).height()
                })
            }
            return this
        },
        close: function () {
            this.node.hide();
            this.msk.hide();
            this.node.trigger("dialog:close", this);
            clearInterval(this.watcher);
            return this
        }
    };
    B.Dialog = function (G, H) {
        if (!H && t) {
            return G ? t.set(G) : t
        }
        if (!t && !H) {
            t = new v(G);
            return t
        }
        return new v(G)
    };
    window.dui = B;
    var z = {};

    function s(G, H) {
        return function () {
            var K = z[H];
            var J = arguments;
            var I = this;
            if (K) {
                clearTimeout(K)
            }
            z[H] = setTimeout(function () {
                G.apply(I, arguments)
            }, 300)
        }
    }
})();