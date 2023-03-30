<?php
class File {
    public $name; //Имя файла
    public $full_path; //Полный путь к файлу
    public $type; //Тип файла
    public $tmp_name; //Временное имя загруженного файла

    //Функция для загрузки файла на сервер
    public function creatFile() {
        //Получение файла с формы
        $file = $_FILES['form-file'];
        $fileName = $file['name'];
        $newFilePath = __DIR__ . '/uploads/' . $fileName;

        //Расширения файлов, которые можно загружать на сервер
        $allowedExtensions = ['jpg', 'png', 'gif'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        //Проверка на разрешенные критерии
        if (!in_array($extension, $allowedExtensions)) {
            $error = 'Загрузка файлов с таким расширением запрещена!';
            echo $error;
        } elseif ($file['error'] !== UPLOAD_ERR_OK) {
            $error = 'Ошибка при загрузке файла.';
            echo $error;
        } elseif (file_exists($newFilePath)) {
            $error = 'Файл с таким именем уже существует.';
            echo $error;
        } elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
            $error = 'Ошибка при загрузке файла.';
            echo $error;
        } else {
            echo 'Успешная загрузка файла.';
        }
    }

    //Функция для удаления файлов и повторной проверки перед удалением
    public function deleteFile() {
        $dir = __DIR__ . '/uploads/';
        $fileName = $_POST['filename'];

        //По сути здесь мы повторяем код function getData(), был вариант использования $this -> getData()
        //Но мне не понравился такой вариант реализации в связи с визуальной составляющей
        //Повторение используется с целью уточнения, не удалил ли этот файл кто-то, пока вы пытались его найти ;)
        $files = array();
        foreach(glob($dir . '/*') as $file) {
            if (is_file($file)) $files[] = basename($file);
        }

        //Проверка количества файлов на сервере
        if (empty($files[0])) {
            echo 'Сейчас на сервере нет файлов.<br>';
        } else {
            //Перебор массива файлов с целью поиска соответствия с полем ввода имени файла для удаления
            foreach($files as $value)
                if ($value == $fileName) {
                    $path = "$dir"."$fileName";
                    unlink($path);
                    echo 'Ваш запрос был обработан!<br>';
                    break;
                } else {
                    echo 'На сервере нет такого файла.<br>';
                    break;
                }
        }
    }

    public function getData() {
        //Создание массива и директории для загрузки, получение файлов сервера, чтобы показать их на главной странице
        //Так же в случаи отсутствия директории - автоматическое создание, чтобы не породить критическую ошибку уровня E_WARNING
        if (!is_dir(__DIR__ . '/uploads/')) {
            mkdir(__DIR__ . '/uploads/');
            $this->getData();
        } else {
            $dir = __DIR__ . '/uploads/';
            $files = array();
            foreach (glob($dir . '/*') as $file) {
                if (is_file($file)) $files[] = basename($file);
            }

            //Проверка на количество файлов на сервере и вывод имеющихся
            //Здесь могла быть функция для повторной проверки, когда я использовал несколько страниц с целью усложнения
            if (!empty($files[0])) {
                foreach ($files as $value)
                    echo "$value <br>";
            }
        }
    }
}
?>
