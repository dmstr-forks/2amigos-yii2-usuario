<?php

namespace Da\User\Controller\api\v1;

use Da\User\Event\FormEvent;
use Da\User\Form\LoginForm;
use Da\User\Traits\ContainerAwareTrait;
use eluhr\restApiUtils\filters\ApiResponseFilter;
use Yii;
use yii\filters\Cors;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * @property \Da\User\Module $module
 */
class SecurityController extends Controller
{
    use ContainerAwareTrait;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['rest-filter'] = [
            'class' => ApiResponseFilter::class
        ];
        $behaviors['cors-filter'] = [
            'class' => Cors::class,
        ];
        return $behaviors;
    }

    protected function verbs()
    {
        $verbs = parent::verbs();
        $verbs['login'] = ['POST'];
        return $verbs;
    }

    public function beforeAction($action)
    {
        if (!$this->module->enableRestApiLogin) {
            throw new NotFoundHttpException(Yii::t('usuario', 'The requested page does not exist.'));
        }
        return parent::beforeAction($action);
    }

    public function actionLogin()
    {
        /** @var LoginForm $form */
        $form = $this->make(LoginForm::class);
        $form->setScenario('api');

        /** @var \Da\User\Event\FormEvent $event */
        $event = $this->make(FormEvent::class, [$form]);

        $load = $form->load($this->request->post(), '');
        $validate = $form->validate();

        if ($load) {
            $this->trigger(FormEvent::EVENT_BEFORE_LOGIN, $event);
        }

        if ($load && $validate) {
            $this->updateUserLoginInfo($form->getUser());
            $this->trigger(FormEvent::EVENT_AFTER_LOGIN, $event);
        }

        if ($load && !$validate) {
            $this->trigger(FormEvent::EVENT_FAILED_LOGIN, $event);
        }

        return $form;
    }

    protected function updateUserLoginInfo($user)
    {
        if ($user) {
            $user->updateAttributes([
                'last_login_at' => time(),
                'last_login_ip' => $this->module->disableIpLogging ? '127.0.0.1' : $this->request->getUserIP(),
            ]);
        }
    }
}
