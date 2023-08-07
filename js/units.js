console.log('работает файл JS перевод единиц');

function zamena(){
    let inputs = document.getElementsByTagName('input');
    for (let i = 0; i < inputs.length; i++) {
         inputs[i].value = inputs[i].value.replace(/\,/g, '.');
  }
}
function unitsQ(i) {
  console.log('Пошла функция пересчета кнопки ' + i);
  zamena();
  let inputQ = Number(document.getElementsByClassName('units__input')[i].value);
  let volumeunitinput = Number(document.getElementsByClassName("units__start")[i*2].value);
  let timeunitinput = Number(document.getElementsByClassName("units__start")[i*2+1].value);
  let volumeunitoutput = Number(document.getElementsByClassName("units__end")[i*2].value);
  let timeunitoutput = Number(document.getElementsByClassName("units__end")[i*2+1].value);
  // console.log(inputQ + volumeunit + timeunit);
  let result = inputQ * volumeunitinput / timeunitinput / volumeunitoutput * timeunitoutput;
  console.log('Результат: ' + result);
  if (isNaN(result)) {
    document.getElementsByClassName('units__error')[i].style.display='block';
  } else {
    document.getElementsByClassName('units__error')[i].style.display='none';
    result = result.toFixed(6);
    result = result.replace(/\.?0+$/, '');
    document.getElementsByClassName('units__output')[i].value = result;
  }
}
