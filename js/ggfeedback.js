console.log('Работает файл по активации окна ввода');
setInterval(checkTextarea, 1000);
function checkTextarea() {
    console.log('Работает функция просмотра окна');
    let textareaValue = document.getElementById('message__for__me').value;
    let button = document.getElementById('send__message');

    if (textareaValue.length > 0) {
      button.disabled = false; // Активируем кнопку
    } else {
      button.disabled = true; // Дезактивируем кнопку
    }
  }
