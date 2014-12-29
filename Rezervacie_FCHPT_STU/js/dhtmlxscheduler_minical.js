/*
dhtmlxScheduler v.4.1.0 Stardard

This software is covered by GPL license. You also can obtain Commercial or Enterprise license to use it in non-GPL project - please contact sales@dhtmlx.com. Usage without proper license is prohibited.

(c) Dinamenta, UAB.
*/
scheduler.templates.calendar_month = scheduler.date.date_to_str("%F %Y"), scheduler.templates.calendar_scale_date = scheduler.date.date_to_str("%D"), scheduler.templates.calendar_date = scheduler.date.date_to_str("%d"), scheduler.config.minicalendar = {
    mark_events: !0
}, scheduler._synced_minicalendars = [], scheduler.renderCalendar = function(e, t, s) {
    var a = null,
        r = e.date || scheduler._currentDate();
    if ("string" == typeof r && (r = this.templates.api_date(r)), t) a = this._render_calendar(t.parentNode, r, e, t), scheduler.unmarkCalendar(a);
    else {
        var d = e.container,
            n = e.position;
        if ("string" == typeof d && (d = document.getElementById(d)), "string" == typeof n && (n = document.getElementById(n)), n && "undefined" == typeof n.left) {
            var i = getOffset(n);
            n = {
                top: i.top + n.offsetHeight,
                left: i.left
            }
        }
        d || (d = scheduler._get_def_cont(n)), a = this._render_calendar(d, r, e), a.onclick = function(e) {
            e = e || event;
            var t = e.target || e.srcElement;
            if (-1 != t.className.indexOf("dhx_month_head")) {
                var s = t.parentNode.className;
                if (-1 == s.indexOf("dhx_after") && -1 == s.indexOf("dhx_before")) {
                    var a = scheduler.templates.xml_date(this.getAttribute("date"));
                    a.setDate(parseInt(t.innerHTML, 10)), scheduler.unmarkCalendar(this), scheduler.markCalendar(this, a, "dhx_calendar_click"), this._last_date = a, this.conf.handler && this.conf.handler.call(scheduler, a, this)
                }
            }
        }
    }
    if (scheduler.config.minicalendar.mark_events)
        for (var l = scheduler.date.month_start(r), o = scheduler.date.add(l, 1, "month"), _ = this.getEvents(l, o), h = this["filter_" + this._mode], c = 0; c < _.length; c++) {
            var u = _[c];
            if (!h || h(u.id, u)) {
                var f = u.start_date;
                for (f.valueOf() < l.valueOf() && (f = l), f = scheduler.date.date_part(new Date(f.valueOf())); f < u.end_date && (this.markCalendar(a, f, "dhx_year_event"), f = this.date.add(f, 1, "day"), !(f.valueOf() >= o.valueOf())););
            }
        }
    return this._markCalendarCurrentDate(a), a.conf = e, e.sync && !s && this._synced_minicalendars.push(a), a
}, scheduler._get_def_cont = function(e) {
    return this._def_count || (this._def_count = document.createElement("DIV"), this._def_count.className = "dhx_minical_popup", this._def_count.onclick = function(e) {
        (e || event).cancelBubble = !0
    }, document.body.appendChild(this._def_count)), this._def_count.style.left = e.left + "px", this._def_count.style.top = e.top + "px", this._def_count._created = new Date, this._def_count
}, scheduler._locateCalendar = function(e, t) {
    if ("string" == typeof t && (t = scheduler.templates.api_date(t)), +t > +e._max_date || +t < +e._min_date) return null;
    for (var s = e.childNodes[2].childNodes[0], a = 0, r = new Date(e._min_date); + this.date.add(r, 1, "week") <= +t;) r = this.date.add(r, 1, "week"), a++;
    var d = scheduler.config.start_on_monday,
        n = (t.getDay() || (d ? 7 : 0)) - (d ? 1 : 0);
    return s.rows[a].cells[n].firstChild
}, scheduler.markCalendar = function(e, t, s) {
    var a = this._locateCalendar(e, t);
    a && (a.className += " " + s)
}, scheduler.unmarkCalendar = function(e, t, s) {
    if (t = t || e._last_date, s = s || "dhx_calendar_click", t) {
        var a = this._locateCalendar(e, t);
        a && (a.className = (a.className || "").replace(RegExp(s, "g")))
    }
}, scheduler._week_template = function(e) {
    for (var t = e || 250, s = 0, a = document.createElement("div"), r = this.date.week_start(scheduler._currentDate()), d = 0; 7 > d; d++) this._cols[d] = Math.floor(t / (7 - d)), this._render_x_header(d, s, r, a), r = this.date.add(r, 1, "day"), t -= this._cols[d], s += this._cols[d];
    return a.lastChild.className += " dhx_scale_bar_last", a
}, scheduler.updateCalendar = function(e, t) {
    e.conf.date = t, this.renderCalendar(e.conf, e, !0)
}, scheduler._mini_cal_arrows = ["&nbsp", "&nbsp"], scheduler._render_calendar = function(e, t, s, a) {
    var r = scheduler.templates,
        d = this._cols;
    this._cols = [];
    var n = this._mode;
    this._mode = "calendar";
    var i = this._colsS;
    this._colsS = {
        height: 0
    };
    var l = new Date(this._min_date),
        o = new Date(this._max_date),
        _ = new Date(scheduler._date),
        h = r.month_day,
        c = this._ignores_detected;
    this._ignores_detected = 0, r.month_day = r.calendar_date, t = this.date.month_start(t);
    var u, f = this._week_template(e.offsetWidth - 1 - this.config.minicalendar.padding);
    if (a ? u = a : (u = document.createElement("DIV"), u.className = "dhx_cal_container dhx_mini_calendar"), u.setAttribute("date", this.templates.xml_format(t)), u.innerHTML = "<div class='dhx_year_month'></div><div class='dhx_year_week'>" + f.innerHTML + "</div><div class='dhx_year_body'></div>", u.childNodes[0].innerHTML = this.templates.calendar_month(t), s.navigation)
        for (var v = function(e, t) {
                var s = scheduler.date.add(e._date, t, "month");
                scheduler.updateCalendar(e, s), scheduler._date.getMonth() == e._date.getMonth() && scheduler._date.getFullYear() == e._date.getFullYear() && scheduler._markCalendarCurrentDate(e)
            }, g = ["dhx_cal_prev_button", "dhx_cal_next_button"], m = ["left:1px;top:2px;position:absolute;", "left:auto; right:1px;top:2px;position:absolute;"], p = [-1, 1], x = function(e) {
                return function() {
                    if (s.sync)
                        for (var t = scheduler._synced_minicalendars, a = 0; a < t.length; a++) v(t[a], e);
                    else v(u, e)
                }
            }, y = 0; 2 > y; y++) {
            var b = document.createElement("DIV");
            b.className = g[y], b.style.cssText = m[y], b.innerHTML = this._mini_cal_arrows[y], u.firstChild.appendChild(b), b.onclick = x(p[y])
        }
    u._date = new Date(t), u.week_start = (t.getDay() - (this.config.start_on_monday ? 1 : 0) + 7) % 7;
    var w = u._min_date = this.date.week_start(t);
    u._max_date = this.date.add(u._min_date, 6, "week"), this._reset_month_scale(u.childNodes[2], t, w);
    for (var E = u.childNodes[2].firstChild.rows, k = E.length; 6 > k; k++) {
        var D = E[E.length - 1];
        E[0].parentNode.appendChild(D.cloneNode(!0));
        var M = parseInt(D.childNodes[D.childNodes.length - 1].childNodes[0].innerHTML);
        M = 10 > M ? M : 0;
        for (var N = 0; N < E[k].childNodes.length; N++) E[k].childNodes[N].className = "dhx_after", E[k].childNodes[N].childNodes[0].innerHTML = scheduler.date.to_fixed(++M)
    }
    return a || e.appendChild(u), u.childNodes[1].style.height = u.childNodes[1].childNodes[0].offsetHeight - 1 + "px", this._cols = d, this._mode = n, this._colsS = i, this._min_date = l, this._max_date = o, scheduler._date = _, r.month_day = h, this._ignores_detected = c, u
}, scheduler.destroyCalendar = function(e, t) {
    !e && this._def_count && this._def_count.firstChild && (t || (new Date).valueOf() - this._def_count._created.valueOf() > 500) && (e = this._def_count.firstChild), e && (e.onclick = null, e.innerHTML = "", e.parentNode && e.parentNode.removeChild(e), this._def_count && (this._def_count.style.top = "-1000px"))
}, scheduler.isCalendarVisible = function() {
    return this._def_count && parseInt(this._def_count.style.top, 10) > 0 ? this._def_count : !1
}, scheduler._attach_minical_events = function() {
    dhtmlxEvent(document.body, "click", function() {
        scheduler.destroyCalendar()
    }), scheduler._attach_minical_events = function() {}
}, scheduler.attachEvent("onTemplatesReady", function() {
    scheduler._attach_minical_events()
}), scheduler.templates.calendar_time = scheduler.date.date_to_str("%d-%m-%Y"), scheduler.form_blocks.calendar_time = {
    render: function() {
        var e = "<input class='dhx_readonly' type='text' readonly='true'>",
            t = scheduler.config,
            s = this.date.date_part(scheduler._currentDate()),
            a = 1440,
            r = 0;
        t.limit_time_select && (r = 60 * t.first_hour, a = 60 * t.last_hour + 1), s.setHours(r / 60), e += " <select>";
        for (var d = r; a > d; d += 1 * this.config.time_step) {
            var n = this.templates.time_picker(s);
            e += "<option value='" + d + "'>" + n + "</option>", s = this.date.add(s, this.config.time_step, "minute")
        }
        e += "</select>";
        scheduler.config.full_day;
        return "<div style='height:30px;padding-top:0; font-size:inherit;' class='dhx_section_time'>" + e + "<span style='font-weight:normal; font-size:10pt;'> &nbsp;&ndash;&nbsp; </span>" + e + "</div>"
    },
    set_value: function(e, t, s) {
        function a(e, t, s) {
            l(e, t, s), e.value = scheduler.templates.calendar_time(t), e._date = scheduler.date.date_part(new Date(t))
        }
        var r, d, n = e.getElementsByTagName("input"),
            i = e.getElementsByTagName("select"),
            l = function(e, t, s) {
                e.onclick = function() {
                    scheduler.destroyCalendar(null, !0), scheduler.renderCalendar({
                        position: e,
                        date: new Date(this._date),
                        navigation: !0,
                        handler: function(t) {
                            e.value = scheduler.templates.calendar_time(t), e._date = new Date(t), scheduler.destroyCalendar(), scheduler.config.event_duration && scheduler.config.auto_end_date && 0 === s && c()
                        }
                    })
                }
            };
        if (scheduler.config.full_day) {
            if (!e._full_day) {
                var o = "<label class='dhx_fullday'><input type='checkbox' name='full_day' value='true'> " + scheduler.locale.labels.full_day + "&nbsp;</label></input>";
                scheduler.config.wide_form || (o = e.previousSibling.innerHTML + o), e.previousSibling.innerHTML = o, e._full_day = !0
            }
            var _ = e.previousSibling.getElementsByTagName("input")[0],
                h = 0 === scheduler.date.time_part(s.start_date) && 0 === scheduler.date.time_part(s.end_date);
            _.checked = h, i[0].disabled = _.checked, i[1].disabled = _.checked, _.onclick = function() {
                if (_.checked === !0) {
                    var t = {};
                    scheduler.form_blocks.calendar_time.get_value(e, t), r = scheduler.date.date_part(t.start_date), d = scheduler.date.date_part(t.end_date), (+d == +r || +d >= +r && (0 !== s.end_date.getHours() || 0 !== s.end_date.getMinutes())) && (d = scheduler.date.add(d, 1, "day"))
                }
                var l = r || s.start_date,
                    o = d || s.end_date;
                a(n[0], l), a(n[1], o), i[0].value = 60 * l.getHours() + l.getMinutes(), i[1].value = 60 * o.getHours() + o.getMinutes(), i[0].disabled = _.checked, i[1].disabled = _.checked
            }
        }
        if (scheduler.config.event_duration && scheduler.config.auto_end_date) {
            var c = function() {
                r = scheduler.date.add(n[0]._date, i[0].value, "minute"), d = new Date(r.getTime() + 60 * scheduler.config.event_duration * 1e3), n[1].value = scheduler.templates.calendar_time(d), n[1]._date = scheduler.date.date_part(new Date(d)), i[1].value = 60 * d.getHours() + d.getMinutes()
            };
            i[0].onchange = c
        }
        a(n[0], s.start_date, 0), a(n[1], s.end_date, 1), l = function() {}, i[0].value = 60 * s.start_date.getHours() + s.start_date.getMinutes(), i[1].value = 60 * s.end_date.getHours() + s.end_date.getMinutes()
    },
    get_value: function(e, t) {
        var s = e.getElementsByTagName("input"),
            a = e.getElementsByTagName("select");
        return t.start_date = scheduler.date.add(s[0]._date, a[0].value, "minute"), t.end_date = scheduler.date.add(s[1]._date, a[1].value, "minute"), t.end_date <= t.start_date && (t.end_date = scheduler.date.add(t.start_date, scheduler.config.time_step, "minute")), {
            start_date: new Date(t.start_date),
            end_date: new Date(t.end_date)
        }
    },
    focus: function() {}
}, scheduler.linkCalendar = function(e, t) {
    var s = function() {
        var s = scheduler._date,
            a = new Date(s.valueOf());
        return t && (a = t(a)), a.setDate(1), scheduler.updateCalendar(e, a), !0
    };
    scheduler.attachEvent("onViewChange", s), scheduler.attachEvent("onXLE", s), scheduler.attachEvent("onEventAdded", s), scheduler.attachEvent("onEventChanged", s), scheduler.attachEvent("onAfterEventDelete", s), s()
}, scheduler._markCalendarCurrentDate = function(e) {
    var t = scheduler._date,
        s = scheduler._mode,
        a = scheduler.date.month_start(new Date(e._date)),
        r = scheduler.date.add(a, 1, "month");
    if ("day" == s || this._props && this._props[s]) a.valueOf() <= t.valueOf() && r > t && scheduler.markCalendar(e, t, "dhx_calendar_click");
    else if ("week" == s)
        for (var d = scheduler.date.week_start(new Date(t.valueOf())), n = 0; 7 > n; n++) a.valueOf() <= d.valueOf() && r > d && scheduler.markCalendar(e, d, "dhx_calendar_click"), d = scheduler.date.add(d, 1, "day")
}, scheduler.attachEvent("onEventCancel", function() {
    scheduler.destroyCalendar(null, !0)
});
//# sourceMappingURL=../sources/ext/dhtmlxscheduler_minical.js.map