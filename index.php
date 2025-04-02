<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age = 0");
header("Cache-Control: post-check = 0, pre-check = 0, false");
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reimbursement Expense Receipt</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #8ec5fc, #e0c3fc);
            background-image: url('DENR.png');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .container {
            max-width: 700px;
            width: 100%;
            padding: 30px 40px;
            border-radius: 12px;
            background-color: rgba(255, 255, 255, 0.85);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            z-index: 1;
        }

        .container .title {
            font-size: 30px;
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .User {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 20px;
        }

        .input-class {
            width: calc(50% - 10px);
        }

        .details {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"],
        input[type="date"] {
            width: 100%;
            height: 40px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .button {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button input[type="submit"],
        .button input[type="reset"] {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button input[type="submit"] {
            background-color: green;
            color: white;
        }

        .button input[type="reset"] {
            background-color: green;
            color: white;
        }

        .button input[type="submit"]:hover {
            background-color: blue;
        }

        .button input[type="reset"]:hover {
            background-color: #e53935;
        }

        /* Mobile responsiveness */
        @media (max-width: 500px) and (max-height: 500px){
            .input-class {
                width: 100%;
            }  
        }

    </style>

</head>
<body>

<div class="container">
    <div class="title">Reimbursement Expense Receipt</div>
    <form id="form" action="pdf.php" method="POST">
        <div class="User">
            <div class="input-class">
                <span class="details">Entity Name:</span>
                <input type="text" name="entityname" placeholder="Enter entity name" required>
            </div>

            <div class="input-class">
                <span class="details">Fund Cluster:</span>
                <input type="text" name="fundcluster" placeholder="Enter Fund Cluster" required>
            </div>

            <div class="input-class">
                <span class="details">Date:</span>
                <input type="date" name="date" placeholder="Enter Date" required>
            </div>

            <div class="input-class">
                <span class="details">RER No.:</span>
                <input type="text" name="rerno" placeholder="Enter RER No" required>
            </div>

            <div class="input-class">
                <span class="details">Received from:</span>
                <input type="text" name="receivedfrom" placeholder="Enter Name" required>
            </div>

            <div class="input-class">
                <span class="details">Office Designation:</span>
                <input type="text" name="officedesignation" placeholder="Enter Office Designation" required>
            </div>

            <div class="input-class">
                <span class="details">The amount (in words):</span>
                <input type="text" name="words" placeholder="Enter Amount in Words" required>
            </div>

            <div class="input-class">
                <span class="details">The amount (in figures):</span>
                <input type="text" name="figures" placeholder="Enter Amount in Figures" oninput="formatNumber(this)" required>
            </div>

            <div class="input-class">
                <span class="details">In payment:</span>
                <input type="text" name="inpayment" placeholder="For" required>
            </div>

            <div class="input-class">
                <span class="details">Payee Name/Signature:</span>
                <input type="text" name="payeename" placeholder="Enter Name/Signature" required>
            </div>

            <div class="input-class">
                <span class="details">Payee Address:</span>
                <input type="text" name="payeeaddress" placeholder="Enter Payee Address" required>
            </div>

            <div class="input-class">
                <span class="details">Witness Name/Signature:</span>
                <input type="text" name="witnessname" placeholder="Enter Name/Signature" required>
            </div>

            <div class="input-class">
                <span class="details">Witness Address:</span>
                <input type="text" name="witnessaddress" placeholder="Enter Witness Address" required>
            </div>
        </div>

        <div class="button">
            <input type="submit" id="Submit" name="Submit" value="Submit">
            <input type="reset" value="Reset" name="reset">
        </div>
    </form>
</div>

<script>
  if(window.history.replaceState){
  window.history.replaceState(null, null, window.location.href);
}
window.addEventListener("pageshow", function(event){
    if (event.persisted){
        window.location.reload();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const textInputs = document.querySelectorAll("input[type='text']");
    
    textInputs.forEach(input => {
        input.addEventListener("input", function () {
            // Get the current value, capitalize the first letter, and make the rest lowercase
            let value = this.value;
            if (value.length > 0) {
                // Capitalize the first letter and lowercase the rest
                this.value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded"), function(){
    const inputs = document.querySelectorAll("input, textarea, select");
    const inputArray = Array.from(inputs);
    document.addEventListener("keydown", function(event){
        let currentIndex = inputArray.indexOf(document.activeElement);

    if (event.key === "ArrowDown" || event.key === "Enter"){
        event.preventDefault();
        if(currentIndex < inputArray.length - 1){
            inputArray[currentIndex + 1].focus();
        }

    }else if (event.key === "ArrowUp"){
        event.preventDefault();
        if(currentIndex > 0){
            inputArray[currentIndex - 1].focus();

        } 
    
    }else if (event.key === "ArrowRight"){
        event.preventDefault();
        if(currentIndex < inputArray.length - 1) {
            inputArray[currentIndex + 1].focus();
        }

    }else if (event.key === "ArrowLeft"){
        event.preventDefault();
        if(currentIndex > 0){
            inputArray[currentIndex - 1].focus();

        } 
    }
    });
}

function formatNumber(input) {
    let value = input.value.replace(/[^0-9.]/g, '');
    if (!isNaN(value) && value !== "") {
        let formattedValue = Number(value).toLocaleString('en-US');
        input.value = formattedValue;
    }
}
</script>

</body>
</html>