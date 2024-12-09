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



function toggleFields() {
    var zogsUzst = document.getElementById('zoga-uzstadisana').value;
    var celinsUzst = document.getElementById('celins').value; 
    var zaliensUzst = document.getElementById('zaliens').value;

    var zogsField = document.getElementById('platiba');
    if (zogsUzst === 'Jā') {
        zogsField.style.display = 'block';
    } else {
        zogsField.style.display = 'none';
    }

    var celinaField = document.getElementById('celina_uzstadisana'); 
    if (celinsUzst === 'Jā') {
        celinaField.style.display = 'block';
    } else {
        celinaField.style.display = 'none';
    }

    var zaliensField = document.getElementById('zaliena_ierikosana');
    if (zaliensUzst === 'Jā') {
        zaliensField.style.display = 'block';
    } else {
        zaliensField.style.display = 'none';
    }
}


window.onload = function() {
    toggleCardNumberField();  
    document.getElementById('zoga-uzstadisana').addEventListener('change', toggleFields);
    document.getElementById('celins').addEventListener('change', toggleFields); 
    document.getElementById('zaliens').addEventListener('change', toggleFields);
};


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



