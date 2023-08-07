console.log('работает второй файл JS 2');
let onepump;
let grouppump;
let trans;
let pezo;
let debit;
let radius;
let time;

let notcorrectdata = 'некорректные данные';



function zamena(){
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
         inputs[i].value = inputs[i].value.replace(/\,/g, '.');
}
}


document.querySelectorAll
//функция для вычисление одиночной
function calculateone() {
  zamena();
  console.log('Запустилось вычисление');
  coef = document.getElementsByClassName('in')[0].value;
  width = document.getElementsByClassName('in')[1].value;
  pezo = document.getElementsByClassName('in')[2].value;
  debit = document.getElementsByClassName('in')[3].value;
  radius = document.getElementsByClassName('in')[4].value;
  time = document.getElementsByClassName('in')[5].value;
  console.log(coef, width, pezo, debit, radius, time);
  // onepump = debit / 4 / 3.14 / trans * Math.log(2.25 * pezo * time / radius / radius);
  onepump = width - Math.sqrt(width * width - debit / 2 / 3.14 / coef * Math.log(2.25 * pezo * time / radius / radius))
  console.log(onepump);
  if (isNaN(onepump) || onepump == Infinity || onepump == - Infinity) {
      document.getElementById('resultone').innerHTML = 'некорректные данные';
      document.getElementById('resultone').style.color = '#9C0000';
  } else {
    document.getElementById('resultone').innerHTML = String (onepump.toFixed(3));
    document.getElementById('resultone').style.color = 'black';
  }
  if ( (width * width) < (debit / 2 / 3.14 / coef * Math.log(2.25 * pezo * time / radius / radius)) ) {
     document.getElementById('resultone').innerHTML = 'Осушение пласта';
     document.getElementById('resultone').style.color = '#9C0000';
  }
  // else {
  //   document.getElementById('resultone').innerHTML = String (onepump.toFixed(3));
  //   document.getElementById('resultone').style.color = 'black';
  // }

}



//на;имаем на кнопку одиночной
var buttonone = document.getElementById('buttonone');
buttonone.onclick = function() {calculateone()}


//делаем видимые первые две строки
//таблицы вычисления групповой по дефолту
let tablerow = document.getElementsByClassName('tablerow');
tablerow[0].style.display = 'block';
tablerow[1].style.display = 'block';

//Выбираем количество скважин в групповой
let quan;
quan = document.getElementById('selectquan');
quan.onchange = function(){
  let down = document.getElementById('resulttwo');
  let q = Number(quan.value);
  console.log('поменял на ' + (q));
  for (let k = 2; k <= q; k++){
    tablerow[k].style.display = 'block';
    console.log('Открылось');
  };
  for (let l = q+1; l <tablerow.length; l++ ){
    tablerow[l].style.display = 'none';
    console.log('Закрылось nahui');
    // let inputs = document.querySelectorAll('.tablerow:nth-child(' + (l+1) + ') input');
    // for (let j = 0; j < inputs.length; j++) {
    //   inputs[j].value = '';
    //   }
  };
  down.scrollIntoView({ behavior: 'smooth' });
}
//вычисление групповой
var buttontwo = document.getElementById('button2');
buttontwo.onclick = function () {
    console.log('запустилось вычисление групповой');
    calculateone();
    grouppump = onepump;
    var len = document.getElementsByClassName('intable').length;
    var data = document.getElementsByClassName('intable');
    for (let i = 0; i<quan.value*2; i=i+2) {
          if (data[i].value!='' || data[i+1].value !='') {
            var q = data[i].value;
            var r = data[i+1].value;
            // grouppump = grouppump + q / 4 / 3.14 / trans * Math.log(2.25 * pezo * time / r / r);
            onewell = (width - Math.sqrt(width * width - q / 2 / 3.14 / coef * Math.log(2.25 * pezo * time / r / r)))
            if (onewell > 0) {
              grouppump = grouppump + onewell;
            }
            if (width * width < q / 2 / 3.14 / coef * Math.log(2.25 * pezo * time / r / r)) {
              grouppump = width + 1;
            }
            console.log(grouppump);
          }
          }
    if (isNaN(grouppump) || grouppump == Infinity || grouppump == - Infinity) {
        document.getElementById('resulttwo').innerHTML ='некорректные данные';
        document.getElementById('resulttwo').style.color = '#9C0000';
        } else {
          document.getElementById('resulttwo').innerHTML = String (grouppump.toFixed(3));
          document.getElementById('resulttwo').style.color = 'black';
        }
    if (grouppump > width) {
      document.getElementById('resulttwo').innerHTML ='Осушение пласта';
      document.getElementById('resulttwo').style.color = '#9C0000';
    }
    }
var buttonreport = document.getElementById('report');
buttonreport.onclick = function() {
  console.log('Запросили отчет');
  document.getElementById('reporterror').innerHTML ='Авторизуйтесь для формирования отчета';
}
