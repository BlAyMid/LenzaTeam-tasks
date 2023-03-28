const form = document.getElementById('input');
const inp = document.getElementById('input-data-number-input');

// Проверяем фокус на поле с номером для автоматического добавления + вне зависимости от содержимого
inp.addEventListener('focus', _ => {
    // Если там ничего нет или есть, но левое
    // То вставляем знак плюса как значение
    if(!/^\+\d*$/.test(inp.value)) {
        inp.value = '+';
    }
});

//Слушатель на нажатие клавиши, производящее символьное значение с целью отключения
inp.addEventListener('keypress', e => {
    // Отменяем ввод не цифр
    if(!/\d/.test(e.key)) {
        e.preventDefault();
    }
});

//Функция валидации для проверки формы
function validation(form) {
    let result = true;
    const allInputs = form.querySelectorAll('input');

    //Функция для удаления ошибок
    function removeError(input) {
        const parent = input.parentNode;
        if (parent.classList.contains('error')) {
            parent.querySelector('.error-label').remove();
            parent.classList.remove('error');
        }
    }

    //Функция для создания ошибок
    function createError(input, text) {
        const parent = input.parentNode;
        const errorLabel = document.createElement('label');

        errorLabel.classList.add('error-label');
        errorLabel.textContent = text;

        parent.classList.add('error');

        parent.append(errorLabel);
    }

    //Находим все инпуты из формы для проверки на соответствие условиям ниже
    for (const input of allInputs) {
        removeError(input);
        if (input.dataset.minLength) {
            if (input.value.length < input.dataset.minLength) {
                removeError(input);
                createError(input, `Минимальное кол-во символов: ${input.dataset.minLength}`);
                result = false;
            }
        }

        //Проверка поля phone number на соответствие коду страны +7
        if (input.dataset.number) {
            let number = input.value;
            if (number[1] !== "7") {
                removeError(input);
                createError(input, `Номер должен начинаться с ${input.dataset.number}`);
                result = false;
            }
        }

        //Проверка поля email на специальный символ
        if (input.dataset.symbol) {
            let mail = input.value;
            if (mail.indexOf('@') === -1) {
                removeError(input);
                createError(input, `Адрес должен содержать ${input.dataset.symbol}`);
                result = false;
            }
        }

        //Проверка всех полей, которые требуют проверки на пустые поля
        if (input.dataset.required == "true") {
            if (input.value == "") {
                removeError(input);
                createError(input, 'Поле не заполнено!');
                result = false;
            }
        }
    }
    return result;
}

//Слушатель на submit формы с запуском валидации
form.addEventListener('submit', function(event) {
    event.preventDefault();
    if (validation(this) == true) {
        alert('Форма успешно отправлена!');
    }

})