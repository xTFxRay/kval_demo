function toggleInputFields() {
    const garaza = document.getElementById('garaza-q').value;
    const garazaSize = document.getElementById('garaza');
    const stavvieta = document.getElementById('stavvieta-q').value;
    const stavvietaSize = document.getElementById('stavvieta');

    if (garaza === 'yes') {
        garazaSize.classList.remove('hidden');
    } else {
        garazaSize.classList.add('hidden');
        document.getElementById('garaza').value = ''; 
    }

   
    if (stavvieta === 'yes') {
        stavvietaSize.classList.remove('hidden');
    } else {
        stavvietaSize.classList.add('hidden');
        document.getElementById('stavvieta').value = ''; 
    }
}

let subMenu = document.querySelector(".sub-menu");

function toggleMenu(){
    subMenu.classList.toggle("open-menu");
}


function toggleCardNumberField() {
    var paymentMethod = document.getElementById('payment').value;
    var creditCardField = document.getElementById('credit_card_field');
    
    if (paymentMethod === 'credit_card') {
        creditCardField.style.display = 'block'; 
    } else {
        creditCardField.style.display = 'none';  
    }
}


function popup() {
    document.getElementById('popup').style.display = 'flex';
}

document.querySelector('.close').onclick = function () {
    document.getElementById('popup').style.display = 'none';
};

window.onclick = function (event) {
    if (event.target.id === 'popup') {
        document.getElementById('popup').style.display = 'none';
    }
};



