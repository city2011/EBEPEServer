/**
 * Created by city on 2016/11/30.
 */
var se, m = 0,
    h = 0,
    s = 0,
    ss = 1,
    rindex = 0;

var recordt= new Array;

function second() {
    if ((ss % 50) == 0) {
        s += 1;
        ss = 1;
    }
    if (s > 0 && (s % 60) == 0) {
        m += 1;
        s = 0;
    }
    if (m > 0 && (m % 60) == 0) {
        h += 1;
        m = 0;
    }
    t = h + "时" + m + "分" + s + "秒" + ss + "毫秒"; //时分秒运算
    document.getElementById("showtime").value = t; //这有一个给id为showtime的input赋值的语句，可以实现动态计时。
    //其实所谓的动态计时，就是在很短的时间里不停给显示时间的地方更新数值，由于速度很快，这样计时器看起来时刻都在变化。但其实不是的，它从本质上还是静态的，这跟js的伪多线程原理是一样的。
    ss += 1;
}

function startclock() {
    clearInterval(se);
    se = setInterval("second()", 20);
} //这个函数是要放到按钮的click事件上的
function pauseclock() {
    clearInterval(se);
    //document.getElementById("recordtime").value = t;
    recordt[rindex] = t;
    document.getElementById("recordtime").value += recordt[rindex]+"\r\n";
    rindex++;
} //这个函数是要放到按钮的click事件上的
function stopclock() {
    clearInterval(se);
    ss = 1;
    m = h = s = rindex = 0;
    recordt = new Array;
} //这个函数是要放到按钮的click事件上的
function complete(){
    clearInterval(se);
    alert(t);
    localStorage.setItem("readtime",t);
    alert(localStorage.getItem("readtime"));
    window.location.href ='qanda1.html'

}