<?php
/**
 * Created by PhpStorm.
 * User: skat
 * Date: 03.12.18
 * Time: 15:31
 */

namespace common\services;

use common\models\Settings;
use common\models\User;
use Yii;
use common\classes\SendMail;
use common\models\History;
use common\models\Balance;
use common\models\BalanceCash;
use yii\db\Exception;


class AuthService
{


   public function login($email)
   {
       $user = User::findByEmail($email);
       return Yii::$app->user->login($user);
   }



   public function signup($form,$referer)
   {
       $user = User::create($form->email,$form->password);
       $this->requestEmailConfirm($referer,$user->auth_key,$user->email);
   }



   public function emailConfirm($user,$ref)
   {
      if($ref)
      {
          $this->handleReferalLink($ref);
      }

      $this->activateUser($user);
   }



   public function requestPasswordReset($email)
   {
       $user = User::findByEmail($email);
       $user->generatePasswordResetToken();
       $user->save();

       $link = "https://{$_SERVER['HTTP_HOST']}/reset-password?token={$user->password_reset_token}";

       SendMail::create()->setSMTPConfig(Yii::$app->params['smtp-config'])
           ->addAddress($email)
           ->setSubject('Behance Space восстановление пароля')
           ->setBody("<p>Для восстановление пароля перейдите по ссылке:</p>
                                <p><a href=\'{$link}\'>{$link}</a></p>")
           ->setFrom(Yii::$app->params['smtp-config']['username'], 'BS')
           ->isHTML()
           ->send();
   }



   public function resetPassword($user,$password)
   {
       $user = User::findByPasswordResetToken($user->password_reset_token);
       $user->password_hash = Yii::$app->security->generatePasswordHash($password);
       $user->save();
   }



   private function handleReferalLink($refHash)
   {
       if($referer = User::findByRefHash($refHash))
       {
           $refererBalance = Balance::findOne(['user_id'=>$referer->id]);
           $refererBalance->addBalance(Settings::getSetting('referal_likes'),Settings::getSetting('referal_views'));

           History::create(
               $referer->id,
               History::TRANSFER_TO_BALANCE,
               Settings::getSetting('referal_likes'),
               Settings::getSetting('referal_views'),
               "Начислено ".Settings::getSetting('referal_likes')
               ." лайков и ".Settings::getSetting('referal_views')." просмотров за регестрацию по реферальной ссылке"
           );
       }
   }



   private function activateUser($user)
   {
       $auth = Yii::$app->authManager;
       $authorRole = $auth->getRole('user');
       $auth->assign($authorRole, $user->id);

       Balance::create($user->id,Settings::getSetting('reg_bonus_likes'),Settings::getSetting('reg_bonus_views'));
       BalanceCash::create($user->id, 0);

       User::updateAll(['status'=>User::STATUS_ACTIVATED],['id'=>$user->id]);
   }



   private function requestEmailConfirm($referer,$key,$email)
   {
       $link = "https://{$_SERVER['HTTP_HOST']}/account-confirm?key={$key}";

       if($referer)
       {
           $link.="&ref={$referer}";
       }

       SendMail::create()->setSMTPConfig(Yii::$app->params['smtp-config'])
           ->addAddress($email)
           ->setSubject('Behance Space подтвердите аккаунт')
           ->setBody("<p>Для подтверждения аккаунта перейдите по ссылке:</p>
                                <p><a href=\'{$link}\'>{$link}</a></p>")
           ->setFrom(Yii::$app->params['smtp-config']['username'], 'BS')
           ->isHTML()
           ->send();
   }
}