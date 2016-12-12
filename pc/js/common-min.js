"use strict";
var API_BASE = 'http://211.87.239.112';
var Gtool = {};
Gtool.msgBox = function(h, i, j) {
    var g = "mb" + Math.floor(Math.random() * 10000) + "_" + Date.now();
    var f = '\n    <div id="' + g + '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">\n        <div class="modal-dialog modal-sm">\n          <div class="modal-content">\n    \n            <div class="modal-header">\n              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>\n              <h4 class="modal-title" id="">' + h + '</h4>\n            </div>\n            <div class="modal-body">\n              ' + i + "\n            </div>\n          </div>\n        </div>\n      </div>\n    ";
    window.top.$("body").append(f);
    return window.top.$("#" + g).modal("show").on("hide.bs.modal", function(a) {
        $("#" + g).next(".modal-backdrop").remove();
        $("#" + g).remove();
        if (typeof j == "function") { j() }
    })
};
Gtool.confirm = function(h, j, i) {
    var f = '<div class="modal-bts text-center"><button class="btn btn-default fc-ok">确定</button>&nbsp;<button class="btn btn-default fc-cancel">取消</button></div>';
    var g = Gtool.msgBox(h, f);
    g.find(".fc-cancel").on("click", function(a) {
        if (typeof i == "function") { i() }
        g.modal("hide")
    });
    g.find(".fc-ok").on("click", function(a) {
        if (typeof j == "function") { j() }
        g.modal("hide")
    })
};
Gtool.errorMsg = [0, "数据库连接失败", 0, 0, "操作失败", "缺少参数", "没有数据", "用户名或密码错误", 0, 0, 0, "字符非法"];
Gtool.formatErrMsg = function(b) {
    return Gtool.errorMsg[b] || "出现未知错误"
};
Gtool.orderState = ["已取消", "待接单", "进行中等待跑客完成", "等待发单人确定", "等待发单人评价", "等待跑客评价", "完成", "订单支付中"];
Gtool.formatState = function(b) {
    return Gtool.orderState[b] || "未知状态"
};
Gtool.orderDif = [0, "超级订单", "普通订单"];
Gtool.formatOrderDif = function(b) {
    return Gtool.orderDif[b] || "未知类型"
};
Gtool.orderOpriority = ["未置顶", "已置顶"];
Gtool.formatOrderOpriority = function(b) {
    return Gtool.orderDif[b] || "未知类型"
};
Gtool.onErrorRemove = function(b) {
    return $(b).remove()
};
Gtool.formatPage = function(c, d) {
    return "当前第<i>" + (c + 1) + "</i>页，共<i>" + (d + 1) + "</i>页"
};
Gtool.lightbox = function(b) { $.colorbox({ href: b, opacity: 0.5, overlayClose: true }) };
Date.prototype.Format = function(e) {
    var f = { "M+": this.getMonth() + 1, "d+": this.getDate(), "h+": this.getHours(), "m+": this.getMinutes(), "s+": this.getSeconds(), "q+": Math.floor((this.getMonth() + 3) / 3), S: this.getMilliseconds() };
    if (/(y+)/.test(e)) { e = e.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length)) }
    for (var d in f) {
        if (new RegExp("(" + d + ")").test(e)) { e = e.replace(RegExp.$1, RegExp.$1.length == 1 ? f[d] : ("00" + f[d]).substr(("" + f[d]).length)) }
    }
    return e
};
$(function() {
    $(window).ajaxError(function(g, h, f, e) {
        if (h.status == 403) { Gtool.msgBox("您的登录会话已失效!", "您的登录会话已失效，请重新登录", function() { window.top.location.href = "login.html" }) }
    });
    $("body").on("click", ".paokecheck-info>ul>li img", function() {
        var b = $(this).attr("src");
        top.Gtool.lightbox(b)
    })
});
