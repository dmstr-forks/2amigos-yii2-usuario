<?php
namespace Da\User\Factory;

use Da\User\Model\Token;
use Yii;


class TokenFactory
{

    /**
     * @param $userId
     *
     * @return Token
     */
    public static function makeConfirmationToken($userId)
    {
        $token = self::make($userId, Token::TYPE_CONFIRMATION);

        $token->save(false);

        return $token;

    }

    /**
     * @param $userId
     *
     * @return Token
     */
    public static function makeConfirmNewMailToken($userId)
    {
        $token = self::make($userId, Token::TYPE_CONFIRM_NEW_EMAIL);

        $token->save(false);

        return $token;
    }

    /**
     * @param $userId
     *
     * @return Token
     */
    public static function makeRecoveryToken($userId)
    {
        $token = self::make($userId, Token::TYPE_RECOVERY);

        $token->save(false);

        return $token;
    }

    /**
     * @param $userId
     * @param $type
     *
     * @return Token
     */
    protected static function make($userId, $type)
    {
        return Yii::$container->get(Token::class, ['user_id' => $userId, 'type' => $type]);
    }

}