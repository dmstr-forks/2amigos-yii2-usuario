<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Da\User\Query;

use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    /**
     * @param $idOrUsernameOrEmail
     *
     * @return $this
     */
    public function whereIdOrUsernameOrEmail($idOrUsernameOrEmail)
    {
        return filter_var($idOrUsernameOrEmail, FILTER_VALIDATE_INT)
            ? $this->whereId($idOrUsernameOrEmail)
            : $this->whereUsernameOrEmail($idOrUsernameOrEmail);
    }

    /**
     * @param $usernameOrEmail
     *
     * @return $this
     */
    public function whereUsernameOrEmail($usernameOrEmail)
    {
        return filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)
            ? $this->whereEmail($usernameOrEmail)
            : $this->whereUsername($usernameOrEmail);
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function whereEmail($email)
    {
        return $this->andWhere(['email' => $email]);
    }

    /**
     * @param $username
     *
     * @return $this
     */
    public function whereUsername($username)
    {
        return $this->andWhere(['username' => $username]);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function whereId($id)
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $uuid
     *
     * @return $this
     */
    public function whereUuid($uuid)
    {
        return $this->andWhere(['uuid' => $uuid]);
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function whereNotId($id)
    {
        return $this->andWhere(['<>', 'id', $id]);
    }
}
