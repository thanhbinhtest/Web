$(document).ready(function(){
    chartProductSelled();

// Hàm chartProductSelled - thực hiện chức năng chính của hàm chartProductSelled
    function chartProductSelled()
    {
// Khởi tạo biến arrProductSelled
        let arrProductSelled = new Array();
// Khởi tạo biến arrMonth
        let arrMonth = new Array();

        $.post("Home/chartProductSelled", function(data){
// Khởi tạo biến obj
            let obj = JSON.parse(data);

            obj.forEach(element => {
                arrProductSelled.push(element.total);
                arrMonth.push(changedMonth(element.month));
            });

            
// Khởi tạo biến datas
            let datas = {
                labels: arrMonth,
                datasets: [
                    {
                        label: 'Product Selled',
                        backgroundColor: "red",
                        borderColor: 'red',
                        data: arrProductSelled,
                    },
                ],
            }
            
// Khởi tạo biến config
            let config = {
                type: 'line',
                data: datas,
                tension: 0.4
            }
            
// Khởi tạo biến canvas
            let canvas = document.querySelector('.canvas');
// Khởi tạo biến chart
            let chart = new Chart(canvas, config);
        })

    }

// Hàm changedMonth - thực hiện chức năng chính của hàm changedMonth
    function changedMonth(value)
    {
// Khởi tạo biến month
        let month = "";

        switch(value)
        {
            case '1': month = "January";
                break;
            case '2': month = "February";
                break;
            case '3': month = "March";
                break;
            case '4': month = "April";
                break;
            case '5': month = "May";
                break;
            case '6': month = "June";
                break;
            case '7': month = "July";
                break;
            case '8': month = "August";
                break;
            case '9': month = "September";
                break;
            case '10': month = "October";
                break;
            case '11': month = "November";
                break;
            case '12': month = "December";
                break;
        }

        return month;
    }
})
