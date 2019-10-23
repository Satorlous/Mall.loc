<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */

class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $fullname;
    public $image;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'email'], 'trim'],
            [['fullname', 'username', 'email', 'password', 'image'], 'required', 'message' => 'Заполните поле'],
            ['fullname', 'match', 'pattern' => '/^[а-яё ]+$/ui', 'message' => 'ФИО должно содержать только символы кириллицы и пробел!'],
            ['fullname', 'string', 'min' => 3, 'max' => 255, 'tooShort' => 'ФИО должно содержать минимум 3 символа!'],

            ['username', 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Пользователь с таким именем уже зарегистрирован!'],
            ['username', 'string', 'min' => 2, 'max' => 255, 'tooShort' => 'Никнейм должен содержать минимум 2 символа!'],

            ['email', 'email', 'message' => 'Неверная e-mail форма.'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Такой e-mail адрес уже зарегистрирован!'],

            ['password', 'string', 'min' => 6, 'tooShort' => 'Пароль должен содержать минимум 6 символов!'],
            ['password', 'match', 'pattern' => '/^[a-z]+$/ui', 'message' => 'Пароль должен содержать символы латиницы!'],
            ['password', 'match', 'pattern' => '/(?=.*[a-z])(?=.*[A-Z])/', 'message' => 'Пароль должен содержать символы верхнего и нижнего регистра!'],
            ['password_repeat', 'required', 'message' => 'Заполните поле'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>'Пароли не совпадают!'],

            ['image', 'image', 'extensions' => 'png', 'maxSize' => 1024 * 1024, 'message' => 'Размер файла не должен превышать 1МБ']
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->image = $this->image;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }

    public function upload()
    {
        $this->image->saveAs("uploads/{$this->image->baseName}.{$this->image->extension}");
    }
}
