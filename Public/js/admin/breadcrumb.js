// Khởi tạo biến realtimeDate
let realtimeDate = function(){
// Khởi tạo biến currentDate
    let currentDate = new Date();
// Khởi tạo biến today
    let today = currentDate.getDate() + "-" + currentDate.getMonth() + "-" + currentDate.getFullYear() + " " + currentDate.getHours() + ":" + currentDate.getMinutes() + ":" + currentDate.getSeconds();;
// Khởi tạo biến dateShow
    let dateShow = document.querySelector('.currentDate');
    dateShow.innerHTML = today;
}

realtimeDate();

setInterval(() => {
    realtimeDate();
},1000);

// Khởi tạo biến url
let url = location.href.split("/")[5];
// Khởi tạo biến toPagination
let toPagination = document.querySelector('.pagination-to');
toPagination.innerHTML = "/ " + url;
