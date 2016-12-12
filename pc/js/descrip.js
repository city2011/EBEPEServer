//下一个div 
function next() {
    var arr = document.getElementById('tdBjzbsx').getElementsByTagName('div');
    console.log(arr);
    for (i = 0; i < arr.length - 1; i++) {
        if (arr[i].style.display == "block" || arr[i].style.display == "") {
            arr[i + 1].style.display = "block";
            arr[i].style.display = "none";
            break;
        }
    }
}

//上一个div 
function back() {
    var arr = document.getElementById('tdBjzbsx').getElementsByTagName('div');
    for (i = 0; i < arr.length; i++) {
        if (arr[i].style.display == "block" || arr[i].style.display == "") {
            arr[i - 1].style.display = "block";
            arr[i].style.display = "none";
            break;
        }
    }
}
